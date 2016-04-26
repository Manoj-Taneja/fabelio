<?php

session_start();
include 'config.php';

$sql="select a.sku,a.product_name,a.po_number,b.supplier_name,a.order_type,a.order_id,a.manual_order_id from inbound_form a join fabelio.erp_inventory_purchase_order b on a.po_number=b.purchase_order_id where a.item_id='".$_GET['itemid']."'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sku=$row['sku'];

$sql="select a.entity_id,a.increment_id from fabelio.sales_flat_order a inner join fabelio.sales_flat_order_item b on a.entity_id = b.order_id where (a.status='processing' or a.status='processing_manufacturing23' or a.status='processing_poraised') and b.sku='".$sku."'";

$result = $conn->query($sql);
if(!strcmp($_GET['change'],'status')) {

?>

<div class="modal-dialog">
	<div class="modal-content" style="padding: 15px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Change Item Status - <?php echo $_GET['itemid'] ; ?></h4>
		</div>
		<div class="modal-body" >

			<form class="form-horizontal" action="input_qcpass.php?change=status&itemid=<?php echo $_GET['itemid'] ; ?>" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to submit?');">
				<div class="form-group">
		        <label id="statuslabel" >Select Item Status</label>
				<select name="itemstatusselect" class="form-control" id="itemstatusselect">			   
			        <option value='repair'>QC Fail: Repair</option>
			        <option value='return'>QC Fail: Return To Supplier</option>     
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

else {
	?>
<div class="modal-dialog">
	<div class="modal-content" style="padding: 15px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Change Order Number - <?php echo $_GET['itemid'] ; ?></h4>
		</div>
		<div class="modal-body" >

			<form class="form-horizontal" action="input_qcpass.php?change=order&itemid=<?php echo $_GET['itemid'] ; ?>	" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to submit?');">
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