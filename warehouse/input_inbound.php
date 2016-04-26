<?php

include 'config.php';
include 'header.php';

if(!isset($_SESSION['inbound_input'])){
	$_SESSION['inbound_input']=1;
}
?>

<style type="text/css">
	tfoot input {
	        width: 100%;
	        padding: 3px;
	        box-sizing: border-box;
	    }
	td {
		font-size:12px;
	}
	th {
		font-size:13px;
	}
	div.DTTT_container {
	  float:none;
	  text-align:center;
	}
	
	div.container{
		width: 80%;
	}
</style>

<?php

$sql="select max(MID(item_id,LENGTH(item_id) - LOCATE('-', REVERSE(item_id))+2,length(item_id))) as count from inbound_form where sku='".$_POST['sku']."'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$count=$row['count'];
// if($_SESSION['inbound_input']==1){

	$target_dir = "delivery_receipts/";
	$target_file = $target_dir . basename($_FILES["delivery_receipt"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_FILES["delivery_receipt"]["name"])&&$_FILES["delivery_receipt"]["name"]!=''){
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["delivery_receipt"]["tmp_name"]);
		    if($check !== false) {
		      //  echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		if (file_exists($target_file)) {
			echo "<br>";
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		} 
		if ($_FILES["delivery_receipt"]["size"] > 500000) {
			echo "<br>";
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		} 

		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "<br>";
		    echo $imageFileType."  Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		} 
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["delivery_receipt"]["tmp_name"], $target_file)) {
		    	$uploadOk = 1;
		      //  echo "The file ". basename( $_FILES["delivery_receipt"]["name"]). " has been uploaded.";
		    } else {
		    	$uploadOk = 0;
		    	echo "<br>";
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	} 
	if($uploadOk==1){
?>
		<div class="head">
		<center><legend>Inbound Items</legend> </center>
		</div>
		<div class="container" >
			<table id="inbound" class="table table-hover table-bordered" cellspacing="0" width="100%"> 
			<thead>
			<tr>
			    <th>Item ID</th>
			    <th>SKU</th>
			    <th>Product Name</th>
			    <th >Order Number</th>
		  	</tr>
		  	</thead>
		  	<tfoot>
			<tr>
			    <th>Item ID</th>
			    <th>SKU</th>
			    <th>Product Name</th>
			    <th >Order Number</th>
		  	</tr>
		  	</tfoot>
		  	<tbody>
		 <?php
			for($i=0;$i<$_POST['quantity'];$i++)
			{

				$item=$i+1;
				$id=$count+$item;
				$itemid=$_POST['sku']."-".$id;

				if(isset($_POST['have_receipt']))
				{
					$have_receipt=1;
				}else {
					$have_receipt=0;
				}
				if(isset($_POST['match_ordered']))
				{
					$match_ordered=1;
				}else {
					$match_ordered=0;
				}
				if($_POST['itemstatus-'.$item]=="pass"){
					$itemstatus=1;
				}else{
					$itemstatus=0;
				}
				if($_POST['order_type'][$i]=='Supply') {
			  				$orderid=0; 
			  				$manualorder=0;
			  			} 
					if($_POST['order_type'][$i]=='B2B' ){
			 				$orderid=0; 
			  				$manualorder=$_POST['manualorder'][$i];
			  			}
			 		if($_POST['order_type'][$i]=='Demand') {
							$orderid=$_POST['orderid'][$i]; 
			  				$manualorder=0;
			  			}
				
				$sql="INSERT INTO `fabelio_warehouse`.`inbound_form`
				(`item_id`,`entry_datetime`,`inbound_date`,`user_id`,`po_number`,`order_type`,`supplier_id`,`product_name`,`sku`,`order_id`,`manual_order_id`,`delivery_receipt`,`receipt_file`,`dr_matches_delivery`,`item_status`,`reject_reason`,`date_created`)
				VALUES
				('".$itemid."',now(),str_to_date('".$_POST['inbound_date']."','%m/%d/%Y'),'0','".$_POST['poid']."','".$_POST['order_type'][$i]."','".$_POST['supplier']."','".$_POST['productname']."','".$_POST['sku']."','".$orderid."','".$manualorder."','".$have_receipt."','".$_FILES["delivery_receipt"]["name"]."','".$match_ordered."','".$itemstatus."','".$_POST['reject_reason'][$i]."',now())"; 

				$result = $conn->query($sql);	
			?>

			  	<tr>
			  		<td><?php echo $itemid ; ?></td>
			  		<td><?php echo $_POST['sku']; ?></td>
			  		<td><?php echo $_POST['productname']; ?></td>
			  		<td><?php 
			  		if($_POST['order_type'][$i]=='Supply') {
			  				echo "" ; 
			  			} 
					if($_POST['order_type'][$i]=='B2B' ){
			 				echo $manualorder;
			  			}
			 		if($_POST['order_type'][$i]=='Demand') {
							echo $orderid;
			  			} ?>
			  		</td>
			  	</tr>

		<?php } ?>

			</tbody>
		</table>
	</div>
</body>
</html>
<?php	
	}
// }
// else {
// 	echo "Already Input";
// }

$_SESSION['inbound_input']=0;


?>

<script type="text/javascript">

$(document).ready(function() {
    // DataTable
    // $.fn.dataTable.TableTools.defaults.aButtons = [ "csv", "pdf" ];
    // $.fn.dataTable.TableTools.defaults.sSwfPath = "../blah/swf/copy_csv_xls_pdf.swf";

    var table = $('#inbound').DataTable({
    	fixedHeader: true,
	    dom: "<'row'<'col-sm-4'l><'col-sm-4'T><'col-sm-4'f>>R" +
		     "<'row'<'col-sm-12'tr>>" +
		     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
		tableTools: {
            "sSwfPath": "bootstrap/datatable/swf/copy_csv_xls_pdf.swf",
            "aButtons": [ "csv", "pdf" ]
        }
		});
 	

} );
</script>