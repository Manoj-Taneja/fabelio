<?php
include 'config.php';


$sql="select * from qc_2 where scd_end is null and item_id='".$_POST['itemid']."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


$update="update qc_2 set scd_end=now() where scd_end is null and item_id='".$_POST['itemid']."'";
$updateresult=$conn->query($update);

$insert="INSERT INTO `fabelio_warehouse`.`qc_2`( `item_id`, `qc_item_status`, `order_id`, `manual_order_id`, `order_type`, `no_of_days_for_qc`,  `user_id`, `qc_date`, `length`, `width`, `height`, `weight`, `dim_match_website`, `dim_match_drawing`, `dim_not_matching_reason`, `is_level`, `wood_cracked`, `wood_scratch`, `wood_inconsistent`, `wood_peeling_edges`, `wood_good_joints`, `wood_others`, `fabric_torn`, `fabric_bad_stitching`, `fabric_stain`, `fabric_others`, `metal_scratch`, `metal_bad_finishing`, `metal_dent`, `metal_bad_welding`, `metal_others`, `glass_scratch`, `other_failures`, `return_date`,	`method_of_return`,	`tracking_code`, `scd_start`, `date_created`) VALUES 
	(
	 '".$row['item_id']."',
	 'returned',
	 '".$row['order_id']."',
	 '".$row['manual_order_id']."',
	 '".$row['order_type']."',
	 '".$row['no_of_days_for_qc']."',
	 '".$row['user_id']."',
	 curdate(),
	 '".$row['length']."',
	 '".$row['width']."',
	 '".$row['height']."',
	 '".$row['weight']."',
	 '".$row['dim_match_website']."',
	 '".$row['dim_match_drawing']."',
	 '".$row['dim_not_matching_reason']."',
	 '".$row['is_level']."',
	 '".$row['wood_cracked']."',
	 '".$row['wood_scratch']."',
	 '".$row['wood_inconsistent']."',
	 '".$row['wood_peeling_edges']."',
	 '".$row['wood_good_joints']."',
	 '".$row['wood_others']."',
	 '".$row['fabric_torn']."',
	 '".$row['fabric_bad_stitching']."',
	 '".$row['fabric_stain']."',
	 '".$row['fabric_others']."',
	 '".$row['metal_scratch']."',
	 '".$row['metal_bad_finishing']."',
	 '".$row['metal_dent']."',
	 '".$row['metal_bad_welding']."',
	 '".$row['metal_others']."',
	 '".$row['glass_scratch']."',
	 '".$row['other_failures']."',
	 str_to_date('".$_POST['returndate']."','%m/%d/%Y'),
	 '".$_POST['method']."',
	 '".$_POST['trackingcode']."',
	  now(),
	  now())";

$insertresult=$conn->query($insert);
header('Location: qcnow.php'); 
exit();


?>