<?php
	set_include_path(get_include_path().PATH_SEPARATOR."../inc");
	require_once("magmi_version.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>MAGMI (Magento Mass Importer) by Dweeves - version <?php echo Magmi_Version::$version ?></title>
	<link rel="stylesheet" href="css/960.css"></link>
	<link rel="stylesheet" href="css/reset.css"></link>
	<link rel="stylesheet" href="css/magmi.css"></link>
	<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js"></script>
	<script type="text/javascript" src="js/ScrollBox.js"></script>
	<script type="text/javascript" src="js/magmi_utils.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="shortcut icon" href="favicon.ico" />
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Cache-control" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="0">
	<!--[if IE]>
	<style type="text/css">
    .tabs{
        margin-top:-5px !important;
	}
	.utilities-page {
		margin-top:28px !important;
	}
	</style>
	<![endif]-->
</head>
<body>

