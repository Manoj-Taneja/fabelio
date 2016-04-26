<div class="wrapper">
	<div class="magmi-page">
		<div class="header-container">
			<div class="header">
<?php
	require_once("header.php");
	require_once("../engines/magmi_utilityengine.php");
?>

<script type="text/javascript">

	updatePanel=function(pclass,pparams)
	{
		params={
			engine:'magmi_utilityengine:Magmi_UtilityEngine',
			pluginclass:pclass,
			plugintype:'utilities',
			profile:'__utilities__'};
		getPluginParams(params,pparams);
		
		new Ajax.Updater("pluginoptions:"+pclass,"ajax_pluginconf.php",{parameters:params});
	};

	getPluginParams=function(pclass,pcontainer)
	{
		Object.extend(pcontainer,$(pclass+"_params").serialize(true));
	}
	
	runUtility=function(pclass)
	{
		var pparams={
				engine:'magmi_utilityengine:Magmi_UtilityEngine',
				pluginclass:pclass,	
				};
		getPluginParams(pclass,pparams);
		
		new Ajax.Updater("plugin_run:"+pclass+"_res",
						 "magmi_run.php",
						 {parameters:pparams,
						  onComplete:function(){
			  				$$(".pluginrun_results").each(function(el){el.hide();});
							$("plugin_run:"+pclass).show();
			  				updatePanel(pclass);}
						});
	};
	
	togglePanel=function(pclass)
	{
		var target="pluginoptions:"+pclass;
		$(target).toggle();
		$("plugin_run:"+pclass).hide();
	};
</script>
			</div>
		</div>
	<div class="magmi-content utility">
		<div class="container_12" style="margin:40px 0 0 0;">
			<div class="grid_12">
				<div class="warning_msg"><strong>Warning:</strong><br />Make sure that you <strong>completely understand</strong> the utilities that are on this page before executing any of them.
				<br />
				You have the potential here to delete ALL your products from your system and that may not be desirable.</div>
			</div>
		</div>
	
		<div class="container_12" style="margin:0 auto;">
			<div class="grid_12">
				<a href="magmi.php" class="back-to-magmi">
				&lt;&lt; Back to Magmi Config Interface
				</a>
			</div>
		</div>
		<div class="container_12">
		<div class="grid_12  omega subtitle">
			<h3>Magmi Utilities</h3>
		</div>
		<?php 
			$mmi=new Magmi_UtilityEngine();
			$mmi->initialize();
			$mmi->initPlugins();
			$mmi->createPlugins("__utilities__",null);
			$plist=$mmi->getPluginInstances("utilities");
		 ?>
		<?php foreach($plist as $pinst)
		{
			$pclass=$pinst->getPluginClass();
			$pinfo=$pinst->getPluginInfo();
			$info=$pinst->getShortDescription();
		?>
		<div class="grid_12 col utility" >
			<h3 class="pluginname"><?php echo $pinfo["name"]." v".$pinfo["version"];?></h3>
			<?php 
			?>
			<div>
			<div class="plugindescription">
				<?php if($info!==null){?>
					<?php echo $info?>
				<?php }?>
			</div>		
			<div class="plugininfo" style="float:right">
				<a href="javascript:togglePanel('<?php echo $pclass?>')">Options</a>
			</div>
			</div>
			
			<div class="pluginoptionpanel" id="pluginoptions:<?php echo $pclass?>" style="display:none; clear:both;">
					
				<form id="<?php echo $pclass?>_params">
					<?php echo $pinst->getOptionsPanel()->getHtml()?>
				</form>
			</div>
			
			<div id="plugin_run:<?php echo $pclass?>" class="pluginrun_results" style="display:none">
				<h3><?php echo $pinfo["name"]." v".$pinfo["version"];?> Results</h3>
				<div id="plugin_run:<?php echo $pclass?>_res"></div>
			</div>
			
			<div class="separator"></div>
			<div class="utility_run actionbutton" >
				<a id="plrun_<?php echo $pclass?>" href="javascript:runUtility('<?php echo $pclass?>')">Run Utility</a>
			</div>
		</div>
		<?php }?>
	</div>
	<div class="container_12" style="margin:0 auto;">
		<div class="grid_12">
			<a href="magmi.php" class="back-to-magmi">
			&lt;&lt; Back to Magmi Config Interface
			</a>
		</div>
	</div>
	</div>

	<div class="footer">
		<img id="Image-Maps_6201312110558078" src="images/footer.jpg" usemap="#Image-Maps_6201312110558078" border="0" width="980" height="133" alt="" />
	</div>
</div>
</div>



<map id="_Image-Maps_6201312110558078" name="Image-Maps_6201312110558078">
<area shape="rect" coords="885,102,974,128" target="_blank" href="http://www.dzine-hub.com/" alt="dZine-Hub Creation" title="dZine-Hub Creation"    />
<area shape="rect" coords="8,32,209,109" target="_blank" href="#" alt="UnderstandingE" title="UnderstandingE"    />
</map>
<script type="text/javascript">
	var warntargets=[];
	<?php $warn=$pinst->getWarning();
	if($warn!=null)
	{
		$pclass=$pinst->getPluginClass();?>
		warntargets.push({target:'plrun_<?php echo $pclass?>',msg:'<?php echo $warn?>'});
	<?php 	
	}?>
	warntargets.each(function(it){
		$(it.target).observe('click',function(ev){
			var res=confirm(it.msg);
			if(res==false)
			{
				Event.stop(ev);
				return;
			}
		})});

</script>
<?php require_once("footer.php");?>
