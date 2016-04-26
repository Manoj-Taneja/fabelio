<?php
include 'config.php';
include 'header.php';

$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['dimensionsmatch'])){
	$dimensionsmatch=1;
}else{
	$dimensionsmatch=0;
}
if(isset($_POST['productlevel'])){
	$productlevel=1;
}else{
	$productlevel=0;
}
if(isset($_POST['dimensions_match_tech_drawing'])){
	$dimensions_match_tech_drawing=1;
}else{
	$dimensions_match_tech_drawing=0;
}
if(isset($_POST['cracked'])){
	$cracked=1;
}else{
	$cracked=0;
}
if(isset($_POST['scratchwood'])){
	$scratchwood=1;
}else{
	$scratchwood=0;
}
if(isset($_POST['inconsistentwood'])){
	$inconsistentwood=1;
}else{
	$inconsistentwood=0;
}
if(isset($_POST['edgespeeling'])){
	$edgespeeling=1;
}else{
	$edgespeeling=0;
}
if(isset($_POST['jointnotgood'])){
	$jointnotgood=1;
}else{
	$jointnotgood=0;
}
if(isset($_POST['otherswood'])){
	$otherswood=1;
}else{
	$otherswood=0;
}
if(isset($_POST['torn'])){
	$torn=1;
}else{
	$torn=0;
}
if(isset($_POST['badstitching'])){
	$badstitching=1;
}else{
	$badstitching=0;
}
if(isset($_POST['stain'])){
	$stain=1;
}else{
	$stain=0;
}
if(isset($_POST['othersfabric'])){
	$othersfabric=1;
}else{
	$othersfabric=0;
}
if(isset($_POST['scratchmetal'])){
	$scratchmetal=1;
}else{
	$scratchmetal=0;
}
if(isset($_POST['badfinishing'])){
	$badfinishing=1;
}else{
	$badfinishing=0;
}
if(isset($_POST['dent'])){
	$dent=1;
}else{
	$dent=0;
}
if(isset($_POST['badwelding'])){
	$badwelding=1;
}else{
	$badwelding=0;
}
if(isset($_POST['othersfabric'])){
	$othersfabric=1;
}else{
	$othersfabric=0;
}
if(isset($_POST['scratchglass'])){
	$scratchglass=1;
}else{
	$scratchglass=0;
}
if(isset($_POST['othersmetal'])){
	$othersmetal=1;
}else{
	$othersmetal=0;
}

$sql="INSERT INTO `fabelio_warehouse`.`qc_2`( `item_id`, `qc_item_status`, `order_id`, `manual_order_id`, `order_type`, `no_of_days_for_qc`, `user_id`, `qc_date`, `length`, `width`, `height`, `weight`, `dim_match_website`, `is_level`, `dim_match_drawing`, `dim_not_matching_reason`, `wood_cracked`, `wood_scratch`, `wood_inconsistent`, `wood_peeling_edges`, `wood_good_joints`, `wood_others`, `fabric_torn`, `fabric_bad_stitching`, `fabric_stain`, `fabric_others`, `metal_scratch`, `metal_bad_finishing`, `metal_dent`, `metal_bad_welding`, `metal_others`, `glass_scratch`, `other_failures`, `scd_start`, `date_created`) VALUES ( '".$_POST['itemid']."','".$_POST['itemstatus']."','". $_POST['orderid']."','". $_POST['manualorderid']."','". $_POST['ordertype']."', '1', '1', curdate(),'". $_POST['length']."','". $_POST['width']."','". $_POST['height']."','". $_POST['weight']."', '".$dimensionsmatch."','".$productlevel."','".$dimensions_match_tech_drawing."','". $_POST['tech_draw_not_match_reason']."','". $cracked."','". $scratchwood."','". $inconsistentwood."','". $edgespeeling."','". $jointnotgood."','". $otherswood."','". $torn."','". $badstitching."','". $stain."','". $othersfabric."','". $scratchmetal."','". $badfinishing."','". $dent."','". $badwelding."','". $othersmetal."','". $scratchglass."','". $_POST['otherconcern']."', now(), now())";

$result = $conn->query($sql);
header('Location: qcnow.php');  
exit(); 


?>