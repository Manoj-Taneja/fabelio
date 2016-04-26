<!DOCTYPE html>
<html>
	<head>
		<title>Magmi Installation Script - <?php echo $version; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="css/960gs.css"></link>
		<link rel="stylesheet" href="css/reset.css"></link>
		<link rel="stylesheet" href="css/custom.css?<?php echo rand(1, 25555555);?>"></link>
		<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js"></script>
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<META HTTP-EQUIV="Cache-control" CONTENT="no-cache">
		<META HTTP-EQUIV="Expires" CONTENT="0">
	</head>
<body>
<div class="container_12">

	<div class="grid_12 header">
		A header here :)
	</div>

<?php
// Get the step
$step = ( isset($_GET['step'] ) && $_GET['step'] != '') ? $_GET['step'] : 0;
// Which step?
switch( $step ){
	case '1':
		show_progress(1);
		step_1();
	break;
	
	case '2':
		show_progress(2);
		step_2();
	break;
	
	case '3':
		show_progress(3);
		step_3();
	break;
	
	case '4':
		show_progress(4);
		step_4();
	break;
	
	default:
		show_progress(1);
		step_1();
}

function show_progress( $step ) {
?>
	<div class="grid_2 progress">
		
		This is the side menu and we are at stage <?php echo $step; ?>.
		
		<div class="stage <?php ( $step == 1 ? print ' stage_on' : '') ?>">
			Stage 1
		</div>
		
		<div class="stage <?php ( $step == 2 ? print ' stage_on' : '') ?>">
			Stage 2
		</div>
		
		<div class="stage <?php ( $step == 3 ? print ' stage_on' : '') ?>">
			Stage 3
		</div>
		
		<div class="stage <?php ( $step == 4 ? print ' stage_on' : '') ?>">
			Stage 4
		</div>

	</div><!-- /progress -->

	<div class="grid_9 actions">

<?php
}
function step_1(){ 
	if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['agree'] ) ){
		header('Location: index.php?step=2');
		exit;
	}
	if( $_SERVER['REQUEST_METHOD'] == 'POST' && !isset( $_POST['agree'] ) ){
		echo '<div class="warning">You must agree to the license.</div>';
}
?>
	<p>Our LICENSE will go here.</p>
	<form action="index.php?step=1" method="post">
		<p>I agree to the license
		<input type="checkbox" name="agree" />
		</p>
		<input type="submit" value="Continue" />
	</form>
<?php 
}
function step_2(){

	$pre_error = "";

	// get current directory 
	$full_dir 	=  dirname(__FILE__);	// /httpdocs/magmi-importer/web/installation
	$temp 		= explode('/', $full_dir);
	array_pop($temp);
	$web_dir	= implode('/', $temp );	// /httpdocs/magmi-importer/web/
	array_pop($temp);
	$magmi_dir	= implode('/', $temp );	// /httpdocs/magmi-importer/
	array_pop($temp);
	$root_dir	= implode('/', $temp );	// /httpdocs/
	
	
	/*
	echo "Full: $full_dir <br />";
	echo "web_dir: $web_dir <br />";
	echo "root_dir: $root_dir <br />";
	*/

	if( $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] == '' ) {
		// progress
		header('Location: index.php?step=3');
		exit;
	}
	
	// Make array of checks
	$checks	= array(
	
		'php'		=> 1,
		'php_fgc'	=> 1,
		'php_fpc'	=> 1,
		'php_slf'	=> 1,
		'local_xml'	=> 1,
		'session'	=> 1,
		'mysql'		=> 1,
		'php'		=> 1,
		'web_dir'	=> 1,
		'login_php'	=> 1,
		'magmi_ini'	=> 1,
	
	
	);
	
	// Show warnings
	if( $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] != '' )
		echo '<div class="warning">' . $_POST['pre_error'] . '</div>';
	
	// Checks
	if( phpversion() < '5.0') {
		$pre_error = 'You need to use PHP5 or above for our site!<br />';
		$checks['php']		= 0;
	}
	

	// is file_get_contents() allowed
	if( !function_exists( 'file_get_contents' ) ) {
		$pre_error = 'PHP function file_get_contents() now allowed! />';
		$checks['php_fgc']		= 0;
	}
	// is file_put_contents() allowed
	if( !function_exists( 'file_put_contents' ) ) {
		$pre_error = 'PHP function file_put_contents() now allowed! />';
		$checks['php_fpc']		= 0;
	}
	// is simplexml_load_file() allowed
	if( !function_exists( 'simplexml_load_file' ) ) {
		$pre_error = 'PHP function simplexml_load_file() now allowed! />';
		$checks['php_slf']		= 0;
	}
	// app/etc/local.xml
	if( !file_exists( $root_dir . "/app/etc/local.xml" ) || !is_readable( $root_dir . "/app/etc/local.xml" ) ) {
		$pre_error = 'Your app/etc/local.xml file was not found!<br />';
		$checks['local_xml']		= 0;
	}
	/*
	// Needed for login
	if( function_exists ('session_start') ) {
		$pre_error .= 'Our site will not work with session.auto_start enabled!<br />';
		$checks['session']		= 0;
	}
	*/
	// Daft check!
	if( !extension_loaded('mysql') ) {
		$pre_error .= 'MySQL extension needs to be loaded for our site to work!<br />';
		$checks['mysql']		= 0;
	}
	// main directory for htaccess file
	if( !is_writable( $web_dir . '/' ) ) {
		$pre_error .= '/web/ is not writeable<br />';
		$checks['web_dir']		= 0;
	}
	// main head file to append password to
	if( !is_writable( $web_dir . '/login.php' ) ) {
		$pre_error .= '/web/login.php is not writeable<br />';
		$checks['login_php']		= 0;
	}
	// magmi.ini file
	if( !is_writable( $magmi_dir . '/conf/magmi.ini' ) ) {
		$pre_error .= '/conf/magmi.ini is not writeable<br />';
		$checks['magmi_ini']		= 0;
	}
  ?>
	<table width="70%">
		<tr>
			<th>Setting Name</th>
			<th>Required Value</th>
			<th>Value</th>
			<th>Ok?</th>
		</tr>
		<tr>
			<td>PHP Version:</td>
			<td>5.0+</td>
			<td><?php echo phpversion(); ?></td>
			<td class="setting_<?php echo $checks['php'] ? 'ok' : 'bad'; ?>"><?php echo ($checks['php']) ? 'Ok' : 'Not Ok'; ?></td>
		</tr>
		<tr>
			<td>Function: file_get_contents()</td>
			<td>Enabled</td>
			<td><?php echo $checks['php_fgc'] ? 'Enabled' : 'Disabled' ?></td>
			<td class="setting_<?php echo $checks['php_fgc'] ? 'ok' : 'bad'; ?>"><?php echo $checks['php_fgc'] ? 'Ok' : 'Not Ok'; ?></td>
		</tr>
		<tr>
			<td>Function: file_put_contents ()</td>
			<td>Enabled</td>
			<td><?php echo $checks['php_fpc'] ? 'Enabled' : 'Disabled' ?></td>
			<td class="setting_<?php echo $checks['php_fpc'] ? 'ok' : 'bad'; ?>"><?php echo $checks['php_fpc'] ? 'Ok' : 'Not Ok'; ?></td>
		</tr>
		<tr>
			<td>Function: simplexml_load_file()</td>
			<td>Enabled</td>
			<td><?php echo $checks['php_slf'] ? 'Enabled' : 'Disabled' ?></td>
			<td class="setting_<?php echo $checks['php_slf'] ? 'ok' : 'bad'; ?>"><?php echo $checks['php_slf'] ? 'Ok' : 'Not Ok'; ?></td>
		</tr>
		<tr>
			<td>Local.xml</td>
			<td>Found</td>
			<td><?php echo $checks['local_xml'] ? 'Found' : 'Not Found'; ?></td>
			<td class="setting_<?php echo $checks['local_xml'] ? 'ok' : 'bad'; ?>"><?php echo $checks['local_xml'] ? 'Ok' : 'Not Ok'; ?></td>
		</tr>
		<!--
		<tr>
			<td>Session Auto Start:</td>
			<td>Off</td>
			<td><?php echo ( $checks['session'] ) ? 'On' : 'Off'; ?></td>
			<td class="setting_<?php echo !$checks['session'] ? 'ok' : 'bad'; ?>"><?php echo ( !$checks['session'] ) ? 'Ok' : 'Not Ok'; ?></td>
		</tr>
		-->
		<tr>
			<td>MySQL:</td>
			<td>Enabled</td>
			<td><?php echo $checks['mysql'] ? 'Enabled' : 'Disabled'; ?></td>
			<td class="setting_<?php echo $checks['mysql'] ? 'ok' : 'bad'; ?>"><?php echo $checks['mysql'] ? 'Ok' : 'Not Ok'; ?></td>
		</tr>
		<tr>
			<td>Magmi Web Directory:</td>
			<td>Writable</td>
			<td><?php echo $checks['web_dir'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['web_dir'] ? 'ok' : 'bad'; ?>"><?php echo $checks['web_dir'] ? 'Ok' : 'Not Ok'; ?></td>
		</tr>
		<tr>
			<td>login.php file</td>
			<td>Writable</td>
			<td><?php echo $checks['login_php'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['login_php'] ? 'ok' : 'bad'; ?>"><?php echo $checks['login_php'] ? 'Ok' : 'Not Ok'; ?></td>
		</tr>
		<tr>
			<td>magmi.ini file</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_ini'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_ini'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_ini'] ? 'Ok' : 'Not Ok'; ?></td>
		</tr>
	</table>
	<form action="index.php?step=2" method="post">
		<input type="hidden" name="pre_error" id="pre_error" value="<?php echo $pre_error;?>" />
		<!-- <input type="hidden" name="root_dir" id="root_dir" value="<?php echo $root_dir;?>" /> -->
		<input type="submit" name="continue" value="Continue" />
	</form>
<?php
}
function step_3(){

	if ( isset( $_POST['submit'] ) && $_POST['submit'] == "Install!" ) {
	
		$database_host		= isset($_POST['database_host'])?$_POST['database_host']:"";
		$database_port		= isset($_POST['database_port'])?$_POST['database_port']:3306;
		$database_name		= isset($_POST['database_name'])?$_POST['database_name']:"";
		$database_username	= isset($_POST['database_username'])?$_POST['database_username']:"";
		$database_password	= isset($_POST['database_password'])?$_POST['database_password']:"";
		$database_prefix	= isset($_POST['database_prefix'])?$_POST['database_prefix']:"";
		
		$admin_name			= isset($_POST['admin_name'])?$_POST['admin_name']:"";
		$admin_password		= isset($_POST['admin_password'])?$_POST['admin_password']:"";

		if ( 
			empty($admin_name) || 
			empty($admin_password) || 
			empty($database_name) || 
			empty($database_username) || 
			empty($database_password)
			) {
			echo '<div class="warning">All fields are required! Please re-enter.</div><br />';
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
			$ini_file = '
[DATABASE]
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
			if( file_put_contents( $magmi_dir . "/conf/magmi.ini" ) === false ) {
				// Crap an error
				$errors =  true;
			}
			
			// update login.php 
			$login 	= file_get_contents( $web_dir . "/login.php" );
			$login	= str_replace( "%admin_name%", 		$admin_name, 		$login );
			$login	= str_replace( "%admin_password%", 	$admin_password, 	$login );
			
			if( file_put_contents( $web_dir . "/login.php" ) === false ) {
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
		
		if( isset( $_POST['admin_name'] ) && trim( $_POST['admin_name'] != "" ) )
			$admin_name = $_POST['admin_name'];
			
		if( isset( $_POST['admin_password'] ) && trim( $_POST['admin_password'] != "" ) )
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
			$database_port		= 3306;

			if(isset( $xml->global->resources->db->table_prefix ) && $xml->global->resources->db->table_prefix != "")
				$database_prefix	= $xml->global->resources->db->table_prefix;
			
			// Sort out the host
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
	<form method="post" action="index.php?step=3">
		<p>Confirm database details:</p>
		<br/>
		<p>
			<input type="text" name="database_host" value='<?php echo $database_host; ?>' size="30">
			<label for="database_host">Database Host</label>
		</p>
		<p>
			<input type="text" name="database_port" size="30" value="<?php echo $database_port; ?>">
			<label for="database_port">Database Port</label>
		</p>
		<p>
			<input type="text" name="database_name" size="30" value="<?php echo $database_name; ?>">
			<label for="database_name">Database Name</label>
		</p>
		<p>
			<input type="text" name="database_username" size="30" value="<?php echo $database_username; ?>">
			<label for="database_username">Database Username</label>
		</p>
		<p>
			<input type="text" name="database_password" size="30" value="<?php echo $database_password; ?>">
			<label for="database_password">Database Password</label>
		</p>
		<p>
			<input type="text" name="database_prefix" size="30" value="<?php echo $database_prefix; ?>">
			<label for="database_prefix">Database Prefix</label>
		</p>
		<br/>
		<p>Your login details:</p>
		<br/>
		<p>
			<input type="text" name="admin_name" size="30" value="<?php echo $admin_name; ?>">
			<label for="username">Login Name</label>
		</p>
		<p>
			<input name="admin_password" type="text" size="30" maxlength="15" value="<?php echo $admin_password; ?>">
			<label for="password">Password</label>
		</p>
		<p>
			<input type="submit" name="submit" value="Install!">
		</p>
	</form>
<?php
}
function step_4(){

?>
	<h3>Congratulations!</h3>
	<p>Magmi has been installed &amp; configured</p>
	<p>You can now <a href="../magmi.php">login here</a> </p>
	
	
<?php 
}
?>
	</div><!-- /actions -->
	
	<div class="grid_12 footer">
		A footer here :)
	</div>
	
</div><!-- /container -->
</body>
</html>
