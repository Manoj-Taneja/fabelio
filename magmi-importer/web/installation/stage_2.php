<?php 
/*
	File: 	stage_2.php 
	Version: 1.0

*/
function step_2(){

	$pre_error = "";		// String for error trapping
	$has_errors = false;	// For disabled continue button
	$odd_or_even = 0;		// for switching row colours

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
		'login_php'			=> 1,
		'magmi_ini'			=> 1,
		'magmi_state_dir'	=> 1,
		'magmi_state_file'	=> 1,
		'magmi_trace_file'	=> 1,
		'magmi_conf_dir'	=> 1,
		'magmi_plugin_dir'	=> 1,
		'magmi_plugin_plugins_file'	=> 1,
		'magmi_plugin_catimport_file'	=> 1,
		'magmi_plugin_imageprocessor_file'	=> 1,
		'magmi_plugin_itemindexer_file'	=> 1,
		'magmi_plugin_configurable_file'	=> 1,
		'magmi_plugin_csvdatasource_file'	=> 1,

	);
	// Testing errors
	//$pre_error = 'You need to use PHP5 or above for your site! <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#php" target="_blank">Get Help</a><br />';
	//$checks['php']		= 0;
	
	// Checks
	if( phpversion() < '5.0') {
		$pre_error = '<li>You need to use PHP5 or above for your site! <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#php" target="_blank">Get Help</a></li>';
		$checks['php']		= 0;
	}

	// is file_get_contents() allowed
	if( !function_exists( 'file_get_contents' ) ) {
		$pre_error = '<li>PHP function file_get_contents() is not enabled! <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#php_fgc" target="_blank">Get Help</a></li>';
		$checks['php_fgc']		= 0;
	}
	// is file_put_contents() allowed
	if( !function_exists( 'file_put_contents' ) ) {
		$pre_error = '<li>PHP function file_put_contents() is not enabled! <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#php_fpc" target="_blank">Get Help</a></li>';
		$checks['php_fpc']		= 0;
	}
	// is simplexml_load_file() allowed
	if( !function_exists( 'simplexml_load_file' ) ) {
		$pre_error = '<li>PHP function simplexml_load_file() is not enabled! <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#pgp_slf" target="_blank">Get Help</a></li>';
		$checks['php_slf']		= 0;
	}
	// app/etc/local.xml
	if( !file_exists( $root_dir . "/app/etc/local.xml" ) || !is_readable( $root_dir . "/app/etc/local.xml" ) ) {
		$pre_error = '<li>Your app/etc/local.xml file was not found! <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#local_xml" target="_blank">Get Help</a></li>';
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
		$pre_error .= '<li>MySQL extension needs to be loaded for your site to work! <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#mysql" target="_blank">Get Help</a></li>';
		$checks['mysql']		= 0;
	}
	// main directory for htaccess file
	if( !is_writable( $web_dir . '/' ) ) {
		$pre_error .= '<li>/web/ is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#web_dir" target="_blank">Get Help</a></li>';
		$checks['web_dir']		= 0;
	}
	// main head file to append password to
	if( !is_writable( $web_dir . '/login.php' ) ) {
		$pre_error .= '<li>/web/login.php is not writeable! <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#login_php" target="_blank">Get Help</a></li>';
		$checks['login_php']		= 0;
	}
	
	// plugins dir
	if( !is_writable( $magmi_dir . '/plugins/' ) ) {
		$pre_error .= '<li>/plugins/ folder is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#plugin_dir" target="_blank">Get Help</a></li>';
		$checks['magmi_plugin_dir']		= 0;
	}
	// magmi.ini file
	if( !is_writable( $magmi_dir . '/conf/magmi.ini' ) ) {
		$pre_error .= '<li>/conf/magmi.ini is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#magmi_ini" target="_blank">Get Help</a></li>';
		$checks['magmi_ini']		= 0;
	}
	// /state/ directory
	if( !is_writable( $magmi_dir . '/state/' ) ) {
		$pre_error .= '<li>/state/ directory is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#state_dir" target="_blank">Get Help</a></li>';
		$checks['magmi_state_dir']		= 0;
	}
	// /state/magmistate directory
	if( !is_writable( $magmi_dir . '/state/magmistate' ) ) {
		$pre_error .= '<li>/state/magmistate file is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#state_file" target="_blank">Get Help</a></li>';
		$checks['magmi_state_file']		= 0;
	}
	// /state/trace.txt file
	if( !is_writable( $magmi_dir . '/state/trace.txt' ) ) {
		$pre_error .= '<li>/state/trace.txt file is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#trace_file" target="_blank">Get Help</a></li>';
		$checks['magmi_trace_file']		= 0;
	}
	// /conf/ directory
	if( !is_writable( $magmi_dir . '/conf/' ) ) {
		$pre_error .= '<li>/conf/ directory is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#conf_dir" target="_blank">Get Help</a></li>';
		$checks['magmi_conf_dir']		= 0;
	}
	// /conf/plugins.conf file
	if( !is_writable( $magmi_dir . '/conf/plugins.conf' ) ) {
		$pre_error .= '<li>/conf/plugins.conf file is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#plugin_plugins_file" target="_blank">Get Help</a></li>';
		$checks['magmi_plugin_plugins_file']		= 0;
	}
	// /conf/CategoryImporter.conf file
	if( file_exists( $magmi_dir . '/conf/CategoryImporter.conf' ) && !is_writable( $magmi_dir . '/conf/CategoryImporter.conf' ) ) {
		$pre_error .= '<li>/conf/CategoryImporter.conf is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#plugin_plugins_file" target="_blank">Get Help</a></li>';
		$checks['magmi_plugin_catimport_file']		= 0;
	}
	// /conf/ImageAttributeItemProcessor.conf file
	if( file_exists( $magmi_dir . '/conf/CategoryImporter.conf' ) && !is_writable( $magmi_dir . '/conf/ImageAttributeItemProcessor.conf' ) ) {
		$pre_error .= '<li>/conf/ImageAttributeItemProcessor.conf is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#plugin_imageprocessor_file" target="_blank">Get Help</a></li>';
		$checks['magmi_plugin_imageprocessor_file']		= 0;
	}
	// /conf/ItemIndexer.conf file
	if( file_exists( $magmi_dir . '/conf/CategoryImporter.conf' ) && !is_writable( $magmi_dir . '/conf/ItemIndexer.conf' ) ) {
		$pre_error .= '<li>/conf/ItemIndexer.conf is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#plugin_itemindexer_file" target="_blank">Get Help</a></li>';
		$checks['magmi_plugin_itemindexer_file']		= 0;
	}
	// /conf/Magmi_ConfigurableItemProcessor.conf file
	if( file_exists( $magmi_dir . '/conf/CategoryImporter.conf' ) && !is_writable( $magmi_dir . '/conf/ItemIndexer.conf' ) ) {
		$pre_error .= '<li>/conf/Magmi_ConfigurableItemProcessor.conf is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#plugin_configurable_file" target="_blank">Get Help</a></li>';
		$checks['magmi_plugin_configurable_file']		= 0;
	}
	// /conf/Magmi_CSVDataSource.conf file
	if( file_exists( $magmi_dir . '/conf/CategoryImporter.conf' ) && !is_writable( $magmi_dir . '/conf/Magmi_CSVDataSource.conf' ) ) {
		$pre_error .= '<li>/conf/Magmi_CSVDataSource.conf is not writeable <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#plugin_csvdatasource_file" target="_blank">Get Help</a></li>';
		$checks['magmi_plugin_csvdatasource_file']		= 0;
	}
	
	// Show warning messages
	if( 
		($_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['pre_error'] ) && !empty( $_POST['pre_error'] ) ) || 
		$pre_error != ""
	) {
		if( isset( $_POST['pre_error'] ) && !empty( $_POST['pre_error'] ) ) {
			$pre_error = $_POST['pre_error'];
			// Remove message to stop a loop
			unset( $_POST['pre_error'] );
		} 
		echo '<div class="warning"><span>Oh Snap! Houston we have a problem :(</span><ul>' . $pre_error . '<ul>';
		echo '<h3>YAY! Video Guide :)</h3>';
		echo '<div class="videoholder">Press play on the video below to solve common installation problems<br /><iframe src="//player.vimeo.com/video/82395734" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
		echo '</div>';
		// Remove message to stop a loop
		$pre_error = "";
		$has_errors = true;
	}

  ?>
  	<div class="actions-bg-left">
	<div class="actions-bg-right">
	<div class="actions-bg-top">
	<div class="actions-bg-bottom">
	<div class="actions-top-left">
	<div class="actions-top-right">
	<div class="actions-bottom-left">
	<div class="actions-bottom-right">
	<div class="step_content" style="padding:5px 5px;">
	<table width="100%" class="version-table">
		<tr class="headings">
			<th class="first">Setting Name</th>
			<th>Required Value</th>
			<th>Value</th>
			<th class="last">Ok?</th>
		</tr>
		
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['php']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">PHP Version:</td>
			<td>5.0+</td>
			<td><?php echo phpversion(); ?></td>
			<td class="setting_<?php echo $checks['php'] ? 'ok' : 'bad'; ?>"><?php echo ($checks['php']) ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['php_fgc']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Function: file_get_contents()</td>
			<td>Enabled</td>
			<td><?php echo $checks['php_fgc'] ? 'Enabled' : 'Disabled' ?></td>
			<td class="setting_<?php echo $checks['php_fgc'] ? 'ok' : 'bad'; ?>"><?php echo $checks['php_fgc'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['php_fpc']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Function: file_put_contents ()</td>
			<td>Enabled</td>
			<td><?php echo $checks['php_fpc'] ? 'Enabled' : 'Disabled' ?></td>
			<td class="setting_<?php echo $checks['php_fpc'] ? 'ok' : 'bad'; ?>"><?php echo $checks['php_fpc'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['php_slf']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Function: simplexml_load_file()</td>
			<td>Enabled</td>
			<td><?php echo $checks['php_slf'] ? 'Enabled' : 'Disabled' ?></td>
			<td class="setting_<?php echo $checks['php_slf'] ? 'ok' : 'bad'; ?>"><?php echo $checks['php_slf'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['mysql']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">MySQL:</td>
			<td>Enabled</td>
			<td><?php echo $checks['mysql'] ? 'Enabled' : 'Disabled'; ?></td>
			<td class="setting_<?php echo $checks['mysql'] ? 'ok' : 'bad'; ?>"><?php echo $checks['mysql'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['local_xml']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Local.xml (Magento settings file)</td>
			<td>Found</td>
			<td><?php echo $checks['local_xml'] ? 'Found' : 'Not Found'; ?></td>
			<td class="setting_<?php echo $checks['local_xml'] ? 'ok' : 'bad'; ?>"><?php echo $checks['local_xml'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['web_dir']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Magmi web directory (web/):</td>
			<td>Writable</td>
			<td><?php echo $checks['web_dir'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['web_dir'] ? 'ok' : 'bad'; ?>"><?php echo $checks['web_dir'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_plugin_dir']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Magmi plugins directory (plugins/):</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_plugin_dir'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_plugin_dir'] ? 'ok' : 'bad'; ?>"><?php echo $checks['web_dir'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>

		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_state_dir']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Magmi state directory (state/):</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_state_dir'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_state_dir'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_state_dir'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_state_file']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Magmi state File (state/magmistate):</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_state_file'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_state_file'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_state_file'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_trace_file']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Magmi Trace File (state/trace.txt):</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_trace_file'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_trace_file'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_trace_file'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['login_php']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Magmi login file (web/login.php)</td>
			<td>Writable</td>
			<td><?php echo $checks['login_php'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['login_php'] ? 'ok' : 'bad'; ?>"><?php echo $checks['login_php'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_conf_dir']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Magmi conf directory (conf/):</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_conf_dir'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_conf_dir'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_conf_dir'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>

		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_ini']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">Magmi config file (conf/magmi.ini)</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_ini'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_ini'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_ini'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		
		<?php if( file_exists( $magmi_dir . '/conf/plugins.conf' ) ) { ?>
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_plugin_plugins_file']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">/conf/plugins.conf file</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_plugin_plugins_file'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_plugin_plugins_file'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_plugin_plugins_file'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		<?php } ?>
		
		<?php if( file_exists( $magmi_dir . '/conf/CategoryImporter.conf' ) ) { ?>
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_plugin_catimport_file']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">/conf/CategoryImporter.conf file</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_plugin_catimport_file'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_plugin_catimport_file'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_plugin_catimport_file'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		<?php } ?>
		
		<?php if( file_exists( $magmi_dir . '/conf/ImageAttributeItemProcessor.conf' ) ) { ?>
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_plugin_imageprocessor_file']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">/conf/ImageAttributeItemProcessor.conf file</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_plugin_imageprocessor_file'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_plugin_imageprocessor_file'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_plugin_imageprocessor_file'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		<?php } ?>
		
		<?php if( file_exists( $magmi_dir . '/conf/ItemIndexer.conf' ) ) { ?>
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_plugin_itemindexer_file']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">/conf/ItemIndexer.conf file</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_plugin_itemindexer_file'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_plugin_itemindexer_file'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_plugin_itemindexer_file'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		<?php } ?>
		
		<?php if( file_exists( $magmi_dir . '/conf/Magmi_ConfigurableItemProcessor.conf' ) ) { ?>
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_plugin_configurable_file']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">/conf/Magmi_ConfigurableItemProcessor.conf file</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_plugin_configurable_file'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_plugin_configurable_file'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_plugin_configurable_file'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		<?php } ?>
		
		<?php if( file_exists( $magmi_dir . '/conf/Magmi_CSVDataSource.conf' ) ) { ?>
		<tr class="<?php echo ( $odd_or_even %2 == 0 ? "odd" : "even" ); $odd_or_even++; echo ($checks['magmi_plugin_csvdatasource_file']) ? '' : ' setting_bad_row'; ?>">
			<td class="first">/conf/Magmi_CSVDataSource.conf file</td>
			<td>Writable</td>
			<td><?php echo $checks['magmi_plugin_csvdatasource_file'] ? 'Writable' : 'Unwritable'; ?></td>
			<td class="setting_<?php echo $checks['magmi_plugin_csvdatasource_file'] ? 'ok' : 'bad'; ?>"><?php echo $checks['magmi_plugin_csvdatasource_file'] ? 'OK' : 'NOT OK'; ?></td>
		</tr>
		<?php } ?>
		
		
		
	</table>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<form action="index.php?step=2" method="post">
		<input type="hidden" name="pre_error" id="pre_error" value="<?php echo htmlentities( $pre_error ); ?>" />
		<!-- <input type="hidden" name="root_dir" id="root_dir" value="<?php echo $root_dir;?>" /> -->
		<div class="next-step">
			<input type="submit" class="continue" name="continue" value="" <?php echo ($has_errors ? "disabled" : ""); ?>/>
			<!-- <input type="submit" class="continue" name="continue" value=""/> -->
		</div>
	</form>
<?php
}