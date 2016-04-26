<?php
include 'config.php';


$sql="select * from qc_2 where scd_end is null and item_id='".$_GET['itemid']."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

switch ($_GET['change']){
    case "status":

        if($row['qc_item_status']==$_POST['itemstatusselect']){
            header('Location: qcnow.php');   
            exit();
        }

        $update="update qc_2 set scd_end=now() where scd_end is null and item_id='".$_GET['itemid']."'";
        $updateresult=$conn->query($update);

        $insert="INSERT INTO `fabelio_warehouse`.`qc_2`( `item_id`, `qc_item_status`, `order_id`, `manual_order_id`, `order_type`, `no_of_days_for_qc`, `user_id`, `qc_date`, `length`, `width`, `height`, `weight`, `dim_match_website`, `dim_match_drawing`, `dim_not_matching_reason`, `is_level`, `wood_cracked`, `wood_scratch`, `wood_inconsistent`, `wood_peeling_edges`, `wood_good_joints`, `wood_others`, `fabric_torn`, `fabric_bad_stitching`, `fabric_stain`, `fabric_others`, `metal_scratch`, `metal_bad_finishing`, `metal_dent`, `metal_bad_welding`, `metal_others`, `glass_scratch`, `other_failures`, `scd_start`, `date_created`) VALUES ( '".$row['item_id']."','".$_POST['itemstatusselect']."','".$row['order_id']."','".$row['manual_order_id']."','".$row['order_type']."','".$row['no_of_days_for_qc']."','".$row['user_id']."','".$row['qc_date']."','".$row['length']."','".$row['width']."','".$row['height']."','".$row['weight']."','".$row['dim_match_website']."','".$row['dim_match_drawing']."','".$row['dim_not_matching_reason']."','".$row['is_level']."','".$row['wood_cracked']."','".$row['wood_scratch']."','".$row['wood_inconsistent']."','".$row['wood_peeling_edges']."','".$row['wood_good_joints']."','".$row['wood_others']."','".$row['fabric_torn']."','".$row['fabric_bad_stitching']."','".$row['fabric_stain']."','".$row['fabric_others']."','".$row['metal_scratch']."','".$row['metal_bad_finishing']."','".$row['metal_dent']."','".$row['metal_bad_welding']."','".$row['metal_others']."','".$row['glass_scratch']."','".$row['other_failures']."', now(), now())";
        $insertresult=$conn->query($insert);
        header('Location: qcnow.php');  
        exit(); 
        break;

    case "order":

        switch ($_POST['ordertype']) {
            case "B2B":
                if($row['manual_order_id']==$_POST['manualordernumber']){
                    header('Location: qcnow.php');   
                    exit();
                }
                $manualordernumber=$_POST['manualordernumber'];
                $ordernumber="";
                break;
            case "Demand":
            if($row['order_id']==$_POST['ordernumberselect']){
                    header('Location: qcnow.php');  
                    exit(); 
                }
                $manualordernumber="";
                $ordernumber=$_POST['ordernumberselect'];
                break;
            case "Supply":
            if($row['order_type']==$_POST['ordertype']){
                    header('Location: qcnow.php'); 
                    exit();  
                }
                $manualordernumber="";
                $ordernumber="";
                break;
            }

        $update="update qc_2 set scd_end=now() where scd_end is null and item_id='".$_GET['itemid']."'";
        $updateresult=$conn->query($update);
        

        $insert="INSERT INTO `fabelio_warehouse`.`qc_2`( `item_id`, `qc_item_status`, `order_id`, `manual_order_id`, `order_type`, `no_of_days_for_qc`, `user_id`, `qc_date`, `length`, `width`, `height`, `weight`, `dim_match_website`, `dim_match_drawing`, `dim_not_matching_reason`, `is_level`, `wood_cracked`, `wood_scratch`, `wood_inconsistent`, `wood_peeling_edges`, `wood_good_joints`, `wood_others`, `fabric_torn`, `fabric_bad_stitching`, `fabric_stain`, `fabric_others`, `metal_scratch`, `metal_bad_finishing`, `metal_dent`, `metal_bad_welding`, `metal_others`, `glass_scratch`, `other_failures`, `scd_start`, `date_created`) VALUES ( '".$row['item_id']."','".$row['qc_item_status']."','".$ordernumber."','".$manualordernumber."','".$_POST['ordertype']."','".$row['no_of_days_for_qc']."','".$row['user_id']."','".$row['qc_date']."','".$row['length']."','".$row['width']."','".$row['height']."','".$row['weight']."','".$row['dim_match_website']."','".$row['dim_match_drawing']."','".$row['dim_not_matching_reason']."','".$row['is_level']."','".$row['wood_cracked']."','".$row['wood_scratch']."','".$row['wood_inconsistent']."','".$row['wood_peeling_edges']."','".$row['wood_good_joints']."','".$row['wood_others']."','".$row['fabric_torn']."','".$row['fabric_bad_stitching']."','".$row['fabric_stain']."','".$row['fabric_others']."','".$row['metal_scratch']."','".$row['metal_bad_finishing']."','".$row['metal_dent']."','".$row['metal_bad_welding']."','".$row['metal_others']."','".$row['glass_scratch']."','".$row['other_failures']."', now(), now())";

        $insertresult=$conn->query($insert);
        header('Location: qcnow.php'); 
        exit();
        break;
}

?>