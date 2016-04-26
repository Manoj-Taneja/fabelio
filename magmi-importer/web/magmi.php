<?php 
	// Added lines for installation script
	//ini_set("display_errors",1);
	//ini_set("error_reporting",E_ALL);

	//echo phpinfo();
	/*
	if( !is_writable( session_save_path() ) && !is_readable( session_save_path() ) ){
		// Pants, we have a sessions issue. Better let the user know
		?>
		
		<div class="warning_msg">
			<p>
				<strong>Session Path Warning</strong>
				<br/>
				It appears that the session directory used in your hosting is not writable :(
				<br/>				
				Contact your web-hosting provider to ensure that the directory "<?php echo session_save_path(); ?>" is writeable.
			</p>
		</div>
		
		<?php
	}
	*/
	//echo "Howdy!";
	//echo session_save_path();
	ob_start();
	session_start(); 

	define('valid_php', TRUE);
	require_once('login.php'); 
	
	header('Pragma: public');   // required
	header('Expires: 0');    // no cache
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Last-Modified: '.gmdate ('D, d M Y H:i:s').' GMT');
	header('Cache-Control: private',false);
?>
<div class="wrapper">
	<div class="magmi-page">
		<div class="header-container">
			<div class="header">
				<?php 
					require_once("header.php"); 
					require_once("magmi_config.php");
					require_once("magmi_statemanager.php");
					require_once("fshelper.php");
					require_once("magmi_web_utils.php");
				?>
				<ul class="tabs">
					<li>
						<div class="tab_left"></div>
						<a class="tab_middle" href="#tab1" title="Import products into Magento">Import</a>
						<div class="tab_right"></div>
					</li>
					<li>
						<div class="tab_left"></div>
						<a href="#tab2" title="Configuration">Configuration</a>
						<div class="tab_right"></div>
					</li>
					<li>
						<div class="tab_left"></div>
						<a href="http://understandinge.com/guides/magmi/" target="_blank" title="Help">Video Guides</a>
						<div class="tab_right"></div>
					</li>
					<li>
						<div class="tab_left"></div>
						<a href="http://sourceforge.net/apps/mediawiki/magmi/index.php?title=Main_Page" target="_blank" title="Magmi Wiki">Magmi Wiki</a>
						<div class="tab_right"></div>
					</li>
					<li>
						<div class="tab_left"></div>
						<a href="?logout=1" title="Logout">Logout</a>
						<div class="tab_right"></div>
					</li>
				</ul>
			</div>
		</div>
		<div class="magmi-content">
		<div class="tab_container">
			<div id="tab1" class="tab_content">
				<?php
					$badrights=array();
					$postinst="../inc/magmi_postinstall.php";
					if(file_exists($postinst))
					{
					 	require_once("$postinst");
					 	if(function_exists("magmi_post_install"))
					 	{
					 		$result=magmi_post_install();
							if($result["OK"]!="")
							{
								?>
								<div class="container_12" >
								<div class="grid_12 subtitle"><span>Post install procedure</span></div>
								<div class="grid_12 col"><h3>Post install output</h3>
								<div class="mgupload_info" style="margin-top:5px">
								<?php echo $result["OK"]?>
								</div></div></div>
								<?php 
							}
						 	rename($postinst,$postinst.".".strval(time()));
						}
					}
					foreach(array("../state","../conf","../plugins") as $dirname)
					{
						if(!FSHelper::isDirWritable($dirname))
						{
							$badrights[]=$dirname;
						}
					}
					if(count($badrights)==0)
					{
						$state=Magmi_StateManager::getState();
						
						if($state=="running" || (isset($_REQUEST["run"]) && $_REQUEST["run"]=="import"))
						{
							require_once("magmi_import_run.php");		
						}
						else
						{
							Magmi_StateManager::setState("idle",true);
						?>
						<div class="container_12" >
							<div class="subtitle-left"></div>
							<div class="grid_12 subtitle"><span><strong style="color: #000;">Run Magmi</strong></span></div>
							<div class="subtitle-right"></div>
						<?php
							require_once("magmi_config.php");
							require_once("magmi_statemanager.php");
							require_once("dbhelper.class.php");
							$conf=Magmi_Config::getInstance();
							$conf->load();
							$conf_ok=1;
							$profile="";
							if(isset($_REQUEST["profile"]))
							{
								$profile=$_REQUEST["profile"];
							}
							else
							{
								
								if(isset($_SESSION["last_runned_profile"]))
								{
									$profile=$_SESSION["last_runned_profile"];
								}
							}
							if($profile=="")
							{
								$profile="default";
							}
							$eplconf=new EnabledPlugins_Config($profile);
							$eplconf->load();
							if(!$eplconf->hasSection("PLUGINS_DATASOURCES"))
							{
								$conf_ok=0;
							}
							?>
							<?php if(!$conf_ok){?>
								<span class="saveinfo log_warning"><b>No Profile saved yet, Run disabled!!</b></span>
							<?php }?>
							<form method="POST" id="runmagmi" action="magmi.php?ts=<?php echo time() ?>" <?php if(!$conf_ok){?>style="display:none"<?php }?>>
								<input type="hidden" name="run" value="import"></input>
								<input type="hidden" name="logfile" value="<?php echo Magmi_StateManager::getProgressFile()?>"></input>
								<div class="container_12">
									<div class="dash_tabs_left">
									<div class="dash_tabs_right">
							        <div class="dash_tabs_bottom">
						            <div class="dash_tabs_bottom_left">
						            <div class="dash_tabs_bottom_right">
									<div class="grid_12 col" id="directrun">	
										<h3>Directly run magmi with existing profile</h3>
										<div class="formline">
											<span class="label">Run Magmi With Profile:</span>
											<?php $profilelist=$conf->getProfileList(); ?>
											<select name="profile" id="runprofile">
												<option <?php if(null==$profile){?>selected="selected"<?php }?> value="default">Default</option>
												<?php foreach($profilelist as $profilename){?>
												<option <?php if($profilename==$profile){?>selected="selected"<?php }?> value="<?php echo $profilename?>"><?php echo $profilename?></option>
												<?php }?>
											</select>
										<span>using mode:</span>
											<select name="mode" id="mode">
												<option value="update">Update existing items only,skip new ones</option>
												<option value="create">create new items &amp; update existing ones</option>
												<option value="xcreate">create new items only, skip existing ones</option>

											</select>
										<input type="submit" class="run_import" value="" <?php if(!$conf_ok){?>disabled="disabled"<?php }?>></input>
										</div>

									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									
								</div>
							</form>
							<?php require_once("magmi_profile_config.php"); ?>
						<?php
						}
					} else {
					?>
					<div class="container_12">
						<div class="dash_tabs_left">
						<div class="dash_tabs_right">
						<div class="dash_tabs_bottom">
						<div class="dash_tabs_bottom_left">
						<div class="dash_tabs_bottom_right">
						<div class="grid_12 col" id="directrun">
							
									<div class="magmi_error" style="margin-top:5px">
									Directory permissions not compatible with Mass Importer operations
										<ul>
											<?php foreach($badrights as $dirname){
										$trname=str_replace("..","magmi",$dirname);
										?>
											<li>
												<?php echo $trname?> not writable!</li>
											<?php }?>
										</ul>
									</div>
								
						</div>
						</div>
						</div>
						</div>
						</div>
						</div>
						
					</div>
					<?php }	?>
				</div>
			</div>
			<div id="tab2" class="tab_content">
				<?php
					require_once("magmi_config_setup.php");	
				?>
			</div>
		</div>
		</div>
		<div class="footer-container">
			<div class="footer">
				<img id="Image-Maps_6201312110558078" src="images/footer.jpg" usemap="#Image-Maps_6201312110558078" border="0" width="980" height="133" alt="" />
			</div>
		</div>
	</div>
</div>
<map id="_Image-Maps_6201312110558078" name="Image-Maps_6201312110558078">
<area shape="rect" coords="885,102,974,128" target="_blank" href="http://www.dzine-hub.com/" alt="dzine-hub.com" />
<area shape="rect" coords="8,32,209,109" target="_blank" href="#" alt="UnderstandingE" title="UnderstandingE"    />
</map>
<script type="text/javascript">
	var j=jQuery.noConflict();
	j(document).ready(function() {
		//When page loads...
		j(".tab_content").hide();
		j("ul.tabs li:first").addClass("active").show();
		j(".tab_content:first").show();

		//When we Click the tab
		j("ul.tabs li").click(function() {
			j("ul.tabs li").removeClass("active");
			j(this).addClass("active");
			j(".tab_content").hide();

			var activeTab=j(this).find("a").attr("href");
			j(activeTab).show();
		});
	})
</script>