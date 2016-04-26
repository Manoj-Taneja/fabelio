<?php

session_start();
include 'config.php';

$conn = new mysqli($servername, $username, $password,$dbname);


$sql="select a.item_id,b.sku,b.product_name,c.supplier_name,b.po_number,b.order_type,b.order_id,d.increment_id,b.manual_order_id from qc_2 a left join inbound_form b on a.item_id=b.item_id left join fabelio.erp_inventory_supplier c on b.supplier_id=c.supplier_id left join fabelio.sales_flat_order d on d.entity_id=b.order_id where a.qc_item_status='pass'";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>

<?php include 'header.php'; ?>
<body>
<center>
<legend>QC Passed Items</legend>
<div class="container">
<div class="table-responsive">
	<br>
	<table class="table table-hover table-bordered">
	<tr>
	    <th>Item ID</th>
	    <th>SKU</th>
	    <th>Product Name</th>
	    <th>Supplier</th>
	    <th>PO Number</th>
	    <th>Item Status</th>
	    <th>Order Type/Order Number</th>
	    <th>Manual Order Number</th>
	    <th>Edit</th>
  	</tr>
  	
  		<?php
  			$i=0;
			while($row = $result->fetch_assoc()) {
			?>
			<tr>
			<td id="itemid-<?php echo $i; ?>"  ><?php echo $row['item_id'] ;?></td>
			<td id="sku-<?php echo $i; ?>"><?php echo $row['sku'] ;?></td>
			<td id="productname-<?php echo $i; ?>" ><?php echo $row['product_name'] ;?></td>
			<td id="suppliername-<?php echo $i; ?>" ><?php echo $row['supplier_name'] ;?></td>
			<td id="ponumber-<?php echo $i; ?>"><?php echo $row['po_number'] ;?></td>
			<td id="itemstatus-<?php echo $i; ?>"  class="col-md-2">
				<center><label id="statuslabel-<?php echo $i; ?>" >Select Item Status</label></center>
				<select name="itemstatusselect-<?php echo $i; ?>" class="form-control" id="itemstatusselect-<?php echo $i; ?>">
					<option value='qcpass'>QC Pass</option> 
			        <option value='ready'>Ready To Ship</option> 
			        <option value='repair'>QC Fail: Repair</option>
			        <option value='return'>QC Fail: Return To Supplier</option>     
		         </select>
			</td>
			<?php 
				$sql1="select a.entity_id,a.increment_id from fabelio.sales_flat_order a inner join fabelio.sales_flat_order_item b on a.entity_id = b.order_id where (a.status='processing' or a.status='processing_manufacturing23' or a.status='processing_poraised') and b.sku='".$row['sku']."'";
				//echo $sql1;
				$result1 = mysqli_query($conn,$sql1);

			?>
			<td id="ordernumber-<?php echo $i; ?>" class="col-md-3" >
				<center><label id="orderlabel-<?php echo $i; ?>" ><?php echo $row['order_type'] ;?></label></center>
				<select name="ordernumberselect-<?php echo $i; ?>" class="form-control" id="ordernumberselect-<?php echo $i; ?>"  onchange='orderchanged(<?php echo $i; ?>)' style="visibility: <?php if(!strcmp($row['order_type'],'B2B')){ echo 'hidden'; } else {echo 'visible';}  ?>">
				<option value='<?php if(!strcmp($row["order_type"],"Demand")){ echo $row["order_id"]; } else {echo "";}  ?>'><?php if($row["order_type"]=="Demand"){ echo $row["increment_id"]; } else {echo "";} ?>
		                </option> 
		            <?php
		            while($row1 = $result1->fetch_assoc()) { ?>
		                <option value='<?php echo $row1["entity_id"]; ?>'><?php echo $row1["increment_id"]; ?>
		                </option>    
		            
		            <?php  } ?>
		             <option value='supply'>Supply
		                </option>    
	         	</select>
         	</td>
			<td id="manualordernumber-<?php echo $i; ?>" contenteditable='true' onkeyup="manualorder(<?php echo $i; ?>)" ><?php echo $row['manual_order_id'] ;?></td>
			
			<td><a class="btn btn-primary btn-sm" role="button" onclick="submit(<?php echo $i; ?>)" >Submit</a></td>
			</tr>
			<?php
			$i++;       
		    }
		 	?>
  	
	</table>
</div>
</div>
</center> 
</body>
</html>


<script>

	function submit(str){
		window.location.replace("http://"+<?php echo json_encode($host); ?>+"/warehouse/input_qcpass.php?itemid="+document.getElementById("itemid-"+str).innerHTML+"&sku="+document.getElementById("sku-"+str).innerHTML+"&productname="+document.getElementById("productname-"+str).innerHTML+"&itemstatus="+document.getElementById("itemstatusselect-"+str).value+"&ordertype="+document.getElementById("orderlabel-"+str).innerHTML+"&ordernumber="+document.getElementById("ordernumberselect-"+str).value+"&manualordernumber="+document.getElementById("manualordernumber-"+str).innerHTML);
	}

	function manualorder(str){

		if(document.getElementById("manualordernumber-"+str).innerHTML!=""){

			document.getElementById("orderlabel-"+str).innerHTML="B2B";
			document.getElementById("ordernumberselect-"+str).style.visibility='hidden';

		}else {
			document.getElementById("ordernumberselect-"+str).style.visibility='visible';
			if(document.getElementById("ordernumberselect-"+str).value=="supply"||document.getElementById("ordernumberselect-"+str).value==""){
				document.getElementById("orderlabel-"+str).innerHTML="Supply";
			}
			else {
				document.getElementById("orderlabel-"+str).innerHTML="Demand";
			}
		}
	}

	function orderchanged(str){
		if(document.getElementById("ordernumberselect-"+str).value=="supply"||document.getElementById("ordernumberselect-"+str).value==""){

			document.getElementById("orderlabel-"+str).innerHTML="Supply";
			
		} else {
			document.getElementById("orderlabel-"+str).innerHTML="Demand";

		}

	}
</script>

