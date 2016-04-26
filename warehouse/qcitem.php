<?php

session_start();

include 'config.php';

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


?>

<div class="modal-dialog">
	<div class="modal-content" style="padding: 15px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">QC Item - <?php echo $_GET['itemid'] ; ?></h4>
		</div>
		<div class="modal-body" >
		<form class="form-horizontal" action="input_qcitem.php" method="post" enctype="multipart/form-data">
			
			<div class="form-group">
		        <input class="form-control" id="orderid" type="hidden" name="orderid" value="<?php echo $ordernumber ; ?>" >
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
		        <input class="form-control" id="sku" type="text" name="sku" value="<?php echo $sku; ?>" readonly="readonly" >
			</div>

			<div class="form-group">
		        <label for="productname" class="control-label">Product Name</label> 
		        <input class="form-control" id="productname" type="text" name="productname" value="<?php echo $productname; ?>" readonly="readonly">
			</div>

			<div class="form-group">
		        <label for="orderidshow" class="control-label">Order ID</label> 
		        <input class="form-control" id="orderidshow" type="text" name="orderid" value="<?php if(!strcmp($ordertype,'B2B')){ echo $manualordernumber; } else { echo $ordernumber; } ?>" readonly="readonly" >
			</div>

			<div class="form-group">
		        <label for="ordertype" class="control-label">Order Type</label> 
		        <input class="form-control" id="ordertype" type="text" name="ordertype" value="<?php echo $ordertype; ?>" readonly="readonly" >
			</div>

			<div class="form-group">
					<label for="location" class="control-label">Location</label> 
					<input type="number" min="0" step="1" id="location" class="form-control" name="location"  >
			</div>

			<div class="form-group">
		        <label for="length" class="control-label">Length</label> 
		        <input class="form-control" id="length" type="number" min="0" step="0.01" name="length" required>
			</div>

			<div class="form-group">
		        <label for="width" class="control-label">Width</label> 
		        <input class="form-control" id="width" type="number" min="0" step="0.01" name="width" required>
			</div>

			<div class="form-group">
		        <label for="height" class="control-label">Height</label> 
		        <input class="form-control" id="height" type="number" min="0" step="0.01" name="height" required>
			</div>

			<div class="form-group">
		        <label for="weight" class="control-label">Weight</label> 
		        <input class="form-control" id="weight" type="number" min="0" step="0.01" name="weight" required>
			</div>

			<div class="form-group">
				<label for="dimensionsmatch" class="control-label">Dimensions match with Website? </label>
				<input type="checkbox" name="dimensionsmatch" class="pull-right">
			</div>

			<div class="form-group">
				<label for="productlevel" class="control-label">Product is level on the floor? </label>
				<input type="checkbox" name="productlevel" class="pull-right">
			</div>

			<div class="form-group">
				<label for="dimensions_match_tech_drawing" class="control-label">Dimensions match with Tech drawing ?</label>
				<input type="checkbox" id="dimensions_match_tech_drawing" name="dimensions_match_tech_drawing" class="pull-right" onchange="dimensions_match_tech_drawing_changed()">
			</div>

			<div class="form-group">
		            <div id="tech_draw_not_match_reason" >
		                <label for="tech_draw_not_match_reason" class="control-label">If Dimensions doesn't match, then what is the problem ?</label>
		                <textarea id="tech_draw_not_match_reason" name="tech_draw_not_match_reason" cols="66" rows="5"></textarea>
		            </div>
		    </div>

		    <div class="well" style="border-radius: 5px;  background: #FAFAFA;">
		    <center><legend>Wood</legend></center>
		    <center>Quality check for wood</center>
		    <br>

		    <div class="form-group">
				<label for="cracked" class="control-label">Cracked ? </label>
				<input type="checkbox" name="cracked" class="pull-right">
			</div>

			<div class="form-group">
				<label for="scratchwood" class="control-label">Scratch on surface ? </label>
				<input type="checkbox" name="scratchwood" class="pull-right">
			</div>

			<div class="form-group">
				<label for="inconsistentwood" class="control-label">Inconsistent wood grain ? </label>
				<input type="checkbox" name="inconsistentwood" class="pull-right">
			</div>

			<div class="form-group">
				<label for="edgespeeling" class="control-label">Edges Peeling off ? </label>
				<input type="checkbox" name="edgespeeling" class="pull-right">
			</div>

			<div class="form-group">
				<label for="jointnotgood" class="control-label">Joints/Bonds not good ? </label>
				<input type="checkbox" name="jointnotgood" class="pull-right">
			</div>

			<div class="form-group">
				<label for="otherswood" class="control-label"> Others ? </label>
				<input type="checkbox" name="otherswood" class="pull-right">
			</div>
			</div>

			<div class="well" style="border-radius: 5px;  background: #FAFAFA;">
			<center><legend>Fabric QC</legend></center>
		    <center>Quality check on Fabric (if any)</center>
		    <br>

		    <div class="form-group">
				<label for="torn" class="control-label">Torn ? </label>
				<input type="checkbox" name="torn" class="pull-right">
			</div>

			<div class="form-group">
				<label for="badstitching" class="control-label">Bad Stitching ? </label>
				<input type="checkbox" name="badstitching" class="pull-right">
			</div>

			<div class="form-group">
				<label for="stain" class="control-label">Stain ? </label>
				<input type="checkbox" name="stain" class="pull-right">
			</div>

			<div class="form-group">
				<label for="othersfabric" class="control-label"> Others ? </label>
				<input type="checkbox" name="othersfabric" class="pull-right">
			</div>
			</div>

			<div class="well" style="border-radius: 5px;  background: #FAFAFA;">
			<center><legend>Metal</legend></center>
		    <center>Quality check on metal (if any)</center>
		    <br>

		    <div class="form-group">
				<label for="scratchmetal" class="control-label">Scratch on surface ? </label>
				<input type="checkbox" name="scratchmetal" class="pull-right">
			</div>

		    <div class="form-group">
				<label for="badfinishing" class="control-label">Bad Finishing ? </label>
				<input type="checkbox" name="badfinishing" class="pull-right">
			</div>

		    <div class="form-group">
				<label for="dent" class="control-label">Dent ? </label>
				<input type="checkbox" name="dent" class="pull-right">
			</div>

			<div class="form-group">
				<label for="badwelding" class="control-label">Bad Welding ? </label>
				<input type="checkbox" name="badwelding" class="pull-right">
			</div>

			<div class="form-group">
				<label for="othersmetal" class="control-label"> Others ? </label>
				<input type="checkbox" name="othersmetal" class="pull-right">
			</div>
			</div>

			<div class="well" style="border-radius: 5px;  background: #FAFAFA;">
			<center><legend>Glass</legend></center>
		    <center>Quality check on glass (if any)</center>
		    <br>

		    <div class="form-group">
				<label for="scratchglass" class="control-label">Scratch/Crack ? </label>
				<input type="checkbox" name="scratchglass" class="pull-right">
			</div>
			</div>

			<center><legend>Other QC Failures noticed</legend></center>
		    <br>

		    <div class="form-group">
		        <label for="otherconcern" class="control-label">Any other concerns about the item</label>
		        <textarea id="otherconcern" name="otherconcern" cols="64" rows="5" ></textarea>
		    </div>

		    <div class="form-group">
		            <label for="qc_fail" class="control-label">Item Status</label>
		                <div class="pull-right">
		                    <label class="radio-inline">
		                    <input type="radio" name="itemstatus" id="itemstatus" value="pass" checked> QC Pass
		                    </label>
		                    <label class="radio-inline">
		                    <input type="radio" name="itemstatus" id="itemstatus" value="return"> QC Fail - Return to supplier
		                    </label>
		                    <label class="radio-inline">
		                    <input type="radio" name="itemstatus" id="itemstatus" value="repair"> QC Fail - Repair
		                    </label>
		                </div>
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



