<?php

include 'config.php';
include 'header.php';

$sql="select a.sku,a.product_name,a.po_number,b.supplier_name,a.order_type,a.order_id,a.manual_order_id from inbound_form a join fabelio.erp_inventory_purchase_order b on a.po_number=b.purchase_order_id where a.item_id='".$_GET['itemid']."'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sku=$row['sku'];
$productname=$row['product_name'];
$ponumber=$row['po_number'];
$suppliername=$row['supplier_name'];
$ordertype=$row['order_type'];
$manualordernumber=$row['manual_order_id'];
$ordernumber=$row['order_id'];

$sql="select a.entity_id,a.increment_id from fabelio.sales_flat_order a inner join fabelio.sales_flat_order_item b on a.entity_id = b.order_id where (a.status='processing' or a.status='processing_manufacturing23' or a.status='processing_poraised') and b.sku='".$sku."'";

$result = $conn->query($sql);

if(!strcmp($_GET['change'],'return')) {
	
?>

<div class="col-md-6 col-md-offset-3" style="border-radius: 5px;  background: #F8F8F8; padding: 2px;">
	<div style="background: #FFFFFF;">
		<legend><center>Return Item - <?php echo $_GET['itemid'] ; ?></center></legend>
	</div>
	<div style="background: #FFFFFF; padding: 20px;">
		<form class="form-horizontal" action="input_qcreturn.php" method="post" enctype="multipart/form-data">
			
			<div class="form-group">
		        <input class="form-control" id="orderid" type="hidden" name="orderid" value="<?php echo $ordernumber ; ?>">
			</div>

			<div class="form-group">
		        <input class="form-control" id="manualorderid" type="hidden" name="manualorderid" value="<?php echo $manualordernumber ; ?>">
			</div>

			<div class="form-group">
		        <label for="itemid" class="control-label">Item ID</label> 
		        <input class="form-control" id="itemid" type="text" name="itemid" readonly="readonly" value="<?php echo $_GET['itemid'] ; ?>">
			</div>

			<div class="form-group">
		        <label for="sku" class="control-label">SKU</label> 
		        <input class="form-control" id="sku" type="text" name="sku" readonly="readonly" value="<?php echo $sku ; ?>">
			</div>

			<div class="form-group">
		        <label for="productname" class="control-label">Product Name</label> 
		        <input class="form-control" id="productname" type="text" name="productname" readonly="readonly" value="<?php echo $productname ; ?>">
			</div>

			<div class="form-group">
		        <label for="suppliername" class="control-label">Supplier Name</label> 
		        <input class="form-control" id="suppliername" type="text" name="suppliername" readonly="readonly" value="<?php echo $suppliername ; ?>">
			</div>

			<div class="form-group">
		        <label for="ponumber" class="control-label">PO Number</label> 
		        <input class="form-control" id="ponumber" type="text" name="ponumber" readonly="readonly" value="<?php echo $ponumber ; ?>">
			</div>

			<div class="form-group">
				<label for="date" class="control-label">Return Date</label>
		 		<div class='input-group date' id='datetimepicker'>
					<input type='text' class="form-control" name="returndate" required/>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>

			<div class="form-group">
				<label for="method" class="control-label">Method Of Return</label> 
				<select name="method" class="form-control" id="method" onchange="returnmethod(this.value)">
						<option value='1'>Supplier Pickup</option> 
				        <option value='2'>Own Fleet</option> 
				        <option value='3'>3PL</option>   
			    </select>
		    </div>

		    <div class="form-group" id="shipmenttrackingcodediv" style="display:none;">
		        <label for="trackingcode" class="control-label">Shipment Tracking Code</label> 
		        <input class="form-control" id="trackingcode" type="text" name="trackingcode">
			</div>

		    <div class="form-group">
	             <center><button id="submit" name="submit" class="btn btn-primary">Submit</button></center>
	         </div>
        	</div>
		</form>
	</div>
</div>
<?php
}
if(!strcmp($_GET['change'],'status')) {
	?>
	<div class="modal-dialog">
	<div class="modal-content" style="padding: 15px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Change Item Status - <?php echo $_GET['itemid'] ; ?></h4>
		</div>
		<div class="modal-body" >

			<form class="form-horizontal" action="input_qcpass.php?change=status&itemid=<?php echo $_GET['itemid'] ; ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
		        <label id="statuslabel" >Select Item Status</label>
				<select name="itemstatusselect" class="form-control" id="itemstatusselect">
					<option value='pass'>QC Pass</option>
			        <option value='repair'>QC Fail: Repair</option>
		         </select>
				</div>	

				<div class="modal-footer">
					<center>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-default" name="submit" >Submit</button>
					</center>
				</div>

				</form>
			</div>
		</div>
</div>

<?php
}
if(!strcmp($_GET['change'],'order')) {
	?>
	<div class="modal-dialog">
	<div class="modal-content" style="padding: 15px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Change Order Number - <?php echo $_GET['itemid'] ; ?></h4>
		</div>
		<div class="modal-body" >

			<form class="form-horizontal" action="input_qcpass.php?change=order&itemid=<?php echo $_GET['itemid'] ; ?>	" method="post" enctype="multipart/form-data">
			<div class="form-group">
					<label for="ordertypeitem" class="control-label">Order Type</label>
						<select name="ordertype" class="form-control" id="ordertype" onchange="ordertypechanged(this.value)">
							<option value='Supply'>Supply</option> 
					        <option value='Demand'>Demand</option> 
					        <option value='B2B'>B2B</option>  
			         	</select>
				</div>

				<div class="form-group" id="ordernumberselectdiv" style="display:none"> 
				<label id="ordernumberselect" >Order Number</label>
				<select name="ordernumberselect" class="form-control" id="ordernumberselect" >
		            <?php
		            while($row = $result->fetch_assoc()) { ?>
		                <option value='<?php echo $row["entity_id"]; ?>'><?php echo $row["increment_id"]; ?>
		                </option>    
		            
		            <?php  } ?>
	         	</select>
	         	</div>

	         	<div class="form-group" id="manualordernumberdiv" style="display:none">
			        <label for="manualordernumber" class="control-label">Manual Order Number (if B2B) </label> 
			        <input class="form-control" id="manualordernumber" type="text" name="manualordernumber" >
				</div>

				<div class="modal-footer">
					<center>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-default" name="submit" >Submit</button>
					</center>
				</div>

				</form>
			</div>
		</div>
</div>
<?php
}
?>








<script type="text/javascript">

$(function () {
			$('#datetimepicker').datetimepicker({
        	pickTime: false
       		});
		});


function returnmethod(str){
	
	if(str=="3"){
	
		document.getElementById('shipmenttrackingcodediv').style.display="block";
	} else{
		document.getElementById('shipmenttrackingcodediv').style.display="none";
	}

}

</script>