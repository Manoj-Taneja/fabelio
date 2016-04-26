<?php

session_start();
include 'config.php';

$sql="select a.item_id,b.sku,b.product_name,c.supplier_name,b.po_number,b.order_type,b.order_id,d.increment_id,b.manual_order_id from qc_2 a left join inbound_form b on a.item_id=b.item_id left join fabelio.erp_inventory_supplier c on b.supplier_id=c.supplier_id left join fabelio.sales_flat_order d on d.entity_id=b.order_id where a.qc_item_status='return'";

$result = $conn->query($sql);
$count = $result->num_rows;
?>

<!DOCTYPE html>
<html>

<?php include 'header.php'; ?>
<body>
<center>
<legend>QC Fail: Return To Supplier</legend>
<div class="container">
<div class="table-responsive">
	<br>
	<table class="table table-hover table-bordered">
	<tr>
	    <th>Item ID</th>
	    <th>SKU</th>
	    <th>Product Name</th>
	    <th>Supplier Name</th>
	    <th>PO Number</th>
	    <th>Return Date</th>
	    <th>Method Of Return</th>
	    <th>Shipment Tracking Code</th>
	    <th>Item Status</th>
	    <th>Submit</th>
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
			
			<td id="returndate-<?php echo $i; ?>" class="col-md-3" contenteditable='true'>
				<div class='input-group date' id='datetimepicker-<?php echo $i; ?>'>
					<input type='text' class="form-control" name="returndate-<?php echo $i; ?>"  id="returndatepick-<?php echo $i; ?>"/>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
         	</td>
			<td id="method-<?php echo $i; ?>"  class="col-md-3">
				<select name="methodselect-<?php echo $i; ?>" class="form-control" id="methodselect-<?php echo $i; ?>" onmouseup="returnmethod(this.value, <?php echo $i; ?>)">
					<option value='1'>Supplier Pickup</option> 
			        <option value='2'>Own Fleet</option> 
			        <option value='3'>3PL</option>   
		         </select>
			</td>
			<td id="trackingcode-<?php echo $i; ?>"  class="col-md-3" contenteditable='false'></td>
			<td id="itemstatus-<?php echo $i; ?>"  class="col-md-3">
				<select name="itemstatusselect-<?php echo $i; ?>" class="form-control" id="itemstatusselect-<?php echo $i; ?>">
					<option value='return'>Return to Supplier</option> 
			        <option value='returned'>Supplier Returned</option> 
		         </select>
			</td>
			<td><a class="btn btn-primary btn-sm" role="button" onclick="submit(<?php echo $i; ?>)" >Return to Supplier</a></td>
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

<?php 
for($i=0;$i<$count;$i++){
echo "<script type=\"text/javascript\">
	$(function () {
	$('#datetimepicker-".$i."').datetimepicker({
   	pickTime: false
 		});
	});
	</script>";
}
?>

<script type="text/javascript">

function submit(str){
	console.log($('#returndatepick-'+str).val());
	window.location.replace("http://"+<?php echo json_encode($host); ?>+"/warehouse/input_qcreturn.php?itemid="+document.getElementById("itemid-"+str).innerHTML+"&sku="+document.getElementById("sku-"+str).innerHTML+"&productname="+document.getElementById("productname-"+str).innerHTML+"&itemstatus="+document.getElementById("itemstatusselect-"+str).value+"&returndate="+$('#returndatepick-'+str).val()+"&method="+document.getElementById("methodselect-"+str).value+"&trackingcode="+document.getElementById("trackingcode-"+str).innerHTML);
}

function returnmethod(method,str){
	
	if(method=="3"){
	
		document.getElementById('trackingcode-'+str).setAttribute("contenteditable", true);
	} else{
		document.getElementById('trackingcode-'+str).innerHTML="";
		document.getElementById('trackingcode-'+str).setAttribute("contenteditable", false);
	}

}

</script>


