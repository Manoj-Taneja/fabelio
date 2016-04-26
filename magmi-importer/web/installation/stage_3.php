<?php 
/*
	File: 	stage_3.php 
	Version: 1.0

*/
function step_3(){

	// Assume the worst
	$errors =  true;
	$required_css_class =  "";

	if ( isset( $_POST['submit'] ) && $_POST['submit'] == "Install!" ) {
	
		$database_host		= isset( $_POST['database_host'] )? trim( $_POST['database_host'] ) : "";
		$database_port		= isset( $_POST['database_port'] )? trim( $_POST['database_port'] ) : 3306;
		$database_name		= isset( $_POST['database_name'] )? trim( $_POST['database_name'] ) : "";
		$database_username	= isset( $_POST['database_username'] )? trim( $_POST['database_username'] ) : "";
		$database_password	= isset( $_POST['database_password'] )? trim( $_POST['database_password'] ) : "";
		$database_prefix	= isset( $_POST['database_prefix'] )? trim( $_POST['database_prefix'] ) : "";
		
		$admin_name			= isset($_POST['admin_name'] ) ? trim( $_POST['admin_name'] ) : "";
		$admin_password		= isset( $_POST['admin_password'] ) ? trim( $_POST['admin_password'] ) : "";

		if ( 
			empty($admin_name) || 
			empty($admin_password) || 
			empty($database_name) || 
			empty($database_username) || 
			empty($database_password)
			) {
			echo '<div class="warning"><span style="font-weight:bold;">Oh Snap!</span> All fields in <strong>Red</strong> are required! Please check the values and re-enter them if needed.</div><br />';
			
			$required_css_class =  "value_required";
			
		} else {
			// Yay we have data!
			$errors =  false;
			
			
			// get current directory 
			$full_dir 	=  dirname(__FILE__);	// /httpdocs/magmi-importer/web/installation
			$temp 		= explode('/', $full_dir);
			array_pop($temp);
			$web_dir	= implode('/', $temp );	// /httpdocs/magmi-importer/web/
			array_pop($temp);
			$magmi_dir	= implode('/', $temp );	// /httpdocs/magmi-importer/
			array_pop($temp);
			$root_dir	= implode('/', $temp );	// /httpdocs/
			
			
			// make magmi.ini 
			$ini_file = '[DATABASE]
connectivity = "net"
host = "' . $database_host . '"
port = "' . $database_port . '"
unix_socket = "/var/lib/mysql/mysql.sock"
dbname = "' . $database_name . '"
user = "' . $database_username . '"
password = "' . $database_password . '"
table_prefix = "' . $database_prefix . '"
[MAGENTO]
version = "1.7.x"
basedir = "../.."
[GLOBAL]
step = "0.5"
multiselect_sep = ","
dirmask = "755"
filemask = "644"
';
			
			// Try writing it
			if( file_put_contents( $magmi_dir . "/conf/magmi.ini", $ini_file ) === false ) {
				// Crap an error
				$errors =  true;
			}
			
			// update login.php 
			//echo $web_dir . "/login.php";
			$login 	= file_get_contents( $web_dir . "/login.php" );
			$login	= str_replace( "%admin_name%", 		$admin_name, 		$login );
			$login	= str_replace( "%admin_password%", 	$admin_password, 	$login );
			
			if( file_put_contents( $web_dir . "/login.php", $login ) === false ) {
				// Crap an error
				$errors =  true;
			}
			
			// And write the installed.txt file too
			if( file_put_contents( $web_dir . "/installed.txt", "1" ) === false ) {
				// Crap an error
				$errors =  true;
			}
			
			if( !$errors ) {
				header("Location: index.php?step=4");
			} else {
				echo '<div class="warning">Oh dear something bad happened</div>';
			}
		}
	} else {
		// loaded on next stage
		
		$errors = false;
		$admin_name = "";
		$admin_password = "";
		
		if( isset( $_POST['admin_name'] ) && trim( $_POST['admin_name'] ) != "" && !empty( $_POST['admin_name'] ) )
			$admin_name = $_POST['admin_name'];
			
		if( isset( $_POST['admin_password'] ) && trim( $_POST['admin_password'] ) != "" && !empty( $_POST['admin_password'] ) )
			$admin_password = $_POST['admin_password'];
		
		// load up the data file and 
		$full_dir 	=  dirname(__FILE__);	// /httpdocs/magmi-importer/web/installation
		$temp 		= explode('/', $full_dir);
		array_pop($temp);
		$web_dir	= implode('/', $temp );	// /httpdocs/magmi-importer/web/
		array_pop($temp);
		$magmi_dir	= implode('/', $temp );	// /httpdocs/magmi-importer/
		array_pop($temp);
		$root_dir	= implode('/', $temp );	// /httpdocs/
	
		try {
			
			// Prepare details for checking
			$xml		= simplexml_load_file( $root_dir . "/app/etc/local.xml" );

			$database_host		= $xml->global->resources->default_setup->connection->host;
			$database_name		= $xml->global->resources->default_setup->connection->dbname;
			$database_username	= $xml->global->resources->default_setup->connection->username;
			$database_password	= $xml->global->resources->default_setup->connection->password;
			$database_prefix	= "";
			$database_port		= 3306; // Force this to begin with

			if(isset( $xml->global->resources->db->table_prefix ) && !empty( $xml->global->resources->db->table_prefix ) )
				$database_prefix	= $xml->global->resources->db->table_prefix;
			
			// Sort out the host & port if using a non standard port or if manually set
			if( strpos($database_host, ':') !== FALSE ) {
				$temp 			= explode( ':',  $database_host);
				$database_host = $temp[0];
				$database_port = $temp[1];
			}
		
		} catch (Exception $e) {
		
			$errors = true;

		}
	
	}
?>
	<form class="install-step" method="post" action="index.php?step=3">
		<div class="actions-bg-left">
		<div class="actions-bg-right">
		<div class="actions-bg-top">
		<div class="actions-bg-bottom">
		<div class="actions-top-left">
		<div class="actions-top-right">
		<div class="actions-bottom-left">
		<div class="actions-bottom-right">
		<div class="step_content">
		<h1>Confirm database details</h1>
		<p>These details have been taken from your /app/etc/local.xml file.</p>
		<p>
			<label for="database_host">Database Host<span class="field-required">*</span></label>
			<input type="text" name="database_host" class="<?php echo $required_css_class; ?>" value='<?php echo $database_host; ?>' size="30">
		</p>
		<p>
			<label for="database_port">Database Port<span class="field-required">*</span></label>
			<input type="text" name="database_port" class="<?php echo $required_css_class; ?>" size="30" value="<?php echo $database_port; ?>">
		</p>
		<p>
			<label for="database_name">Database Name<span class="field-required">*</span></label>
			<input type="text" name="database_name" class="<?php echo $required_css_class; ?>" size="30" value="<?php echo $database_name; ?>">
		</p>
		<p>
			<label for="database_username">Database Username<span class="field-required">*</span></label>
			<input type="text" name="database_username" class="<?php echo $required_css_class; ?>" size="30" value="<?php echo $database_username; ?>">
		</p>
		<p>
			<label for="database_password">Database Password<span class="field-required">*</span></label>
			<input type="text" name="database_password" class="<?php echo $required_css_class; ?>" size="30" value="<?php echo $database_password; ?>">
		</p>
		<p>
			<label for="database_prefix">Database Prefix</label>
			<input type="text" name="database_prefix" size="30" value="<?php echo $database_prefix; ?>">
		</p>
		<br/>
		<h1>Your login details</h1>
		
		<p>Enter a username and password. These details will be used to help <strong>secure</strong> magmi.</p>
		<p>
			<label for="username">Login Name<span class="field-required">*</span></label>
			<input type="text" name="admin_name" size="30" class="<?php echo $required_css_class; ?>" value="<?php echo $admin_name; ?>">
		</p>
		<p>
			<label for="password">Password<span class="field-required">*</span></label>
			<input name="admin_password" type="text" size="30" maxlength="15" class="<?php echo $required_css_class; ?>" value="<?php echo $admin_password; ?>">
		</p>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		<p>
			<div class="next-step">
				<input type="submit" class="next-install" name="submit" value="Install!"/>
			</div>
		</p>
	</form>
<?php
}