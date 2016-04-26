<?php 
	ob_start();
	session_start(); 
	// Includes
	include('functions.php');
	include('stage_1.php');
	include('stage_2.php');
	include('stage_3.php');
	include('stage_4.php');
?>
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
<div class="wrapper">
<div class="bottom-wrapper">
<div class="container_12 page">
	<div class="grid_12 header">
		<a href="#">
			<div class="header-left"> </div>
		</a>
	</div>
<div class="magmi-content">
<?php
// Get the step
$step = ( isset($_GET['step'] ) && $_GET['step'] != '') ? $_GET['step'] : 0;
// Which step?
switch( $step ){
	case '1':
		// Make sure we're not trying to reinstall
		( check_installed_file_exists() ? header('Location: ../magmi.php') : "" );
		// Show progress bar
		show_progress(1);
		// Show the step
		step_1();
	break;
	
	case '2':
		// Make sure we're not trying to reinstall
		( check_installed_file_exists() ? header('Location: ../magmi.php') : "" );
		show_progress(2);
		step_2();
	break;
	
	case '3':
		// Make sure we're not trying to reinstall
		( check_installed_file_exists() ? header('Location: ../magmi.php') : "" );
		show_progress(3);
		step_3();
	break;
	
	case '4':
		show_progress(4);
		step_4();
	break;
	
	default:
		// Make sure we're not trying to reinstall
		( check_installed_file_exists() ? header('Location: ../magmi.php') : "" );
		show_progress(1);
		step_1();
}

?>

</div>
</div><!-- /actions -->
<div style="clear:both;"></div>
</div><!-- /container -->	
	<div class="grid_12 footer">
		<!--<a href="#">-->
			<div class="footer-left"> </div>
			<div class="footer-right">
				<div class="designed-by">
					<a class="desined_by" target="_blank" href="http://dzine-hub.com">Designed by <img style="vertical-align:middle;" src="images/dz_logo.jpg"/></a>
				</div>
			</div>
		<!--</a>-->
	</div>
	<div style="clear:both;"></div>

</div>
</div>
</body>
</html>