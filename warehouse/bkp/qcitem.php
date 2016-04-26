<?php
include 'header.php';

$host=$_SERVER['HTTP_HOST'];

?>
<div class="col-md-6 col-md-offset-3" style="border-radius: 5px;  background: #F8F8F8; padding: 2px;">
	<div style="background: #FFFFFF;">
		<legend><center>QC Item <?php echo $_GET['itemid'] ; ?></center></legend>
	</div>
<div style="background: #FFFFFF; padding: 20px;">
<form class="form-horizontal" action="input_qcitem.php" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
        <input class="form-control" id="orderid" type="hidden" name="orderid" value="<?php echo $_GET['orderid'] ; ?>">
	</div>

	<div class="form-group">
        <input class="form-control" id="manualorderid" type="hidden" name="manualorderid" value="<?php echo $_GET['manualorderid'] ; ?>">
	</div>

	<div class="form-group">
        <label for="itemid" class="control-label">Item ID</label> 
        <input class="form-control" id="itemid" type="text" name="itemid" readonly="readonly" value="<?php echo $_GET['itemid'] ; ?>">
	</div>

	<div class="form-group">
        <label for="sku" class="control-label">SKU</label> 
        <input class="form-control" id="sku" type="text" name="sku" readonly="readonly" value="<?php echo $_GET['sku'] ; ?>">
	</div>

	<div class="form-group">
        <label for="productname" class="control-label">Product Name</label> 
        <input class="form-control" id="productname" type="text" name="productname" readonly="readonly" value="<?php echo $_GET['productname'] ; ?>">
	</div>

	<div class="form-group">
        <label for="orderidshow" class="control-label">Order ID</label> 
        <input class="form-control" id="orderidshow" type="text" name="orderid" readonly="readonly" value="<?php if($_GET['ordertype']=='B2B'){ echo $_GET['manualorderid'] ; } else { echo $_GET['orderid'] ; } ?>">
	</div>

	<div class="form-group">
        <label for="ordertype" class="control-label">Order Type</label> 
        <input class="form-control" id="ordertype" type="text" name="ordertype" readonly="readonly" value="<?php echo $_GET['ordertype'] ; ?>">
	</div>

	<div class="form-group">
			<label for="location" class="control-label">Location</label> 
			<input type="text" id="location" class="form-control" name="location"  >
	</div>

	<div class="form-group">
        <label for="length" class="control-label">Length</label> 
        <input class="form-control" id="length" type="text" name="length">
	</div>

	<div class="form-group">
        <label for="width" class="control-label">Width</label> 
        <input class="form-control" id="width" type="text" name="width">
	</div>

	<div class="form-group">
        <label for="height" class="control-label">Height</label> 
        <input class="form-control" id="height" type="text" name="height">
	</div>

	<div class="form-group">
        <label for="weight" class="control-label">Weight</label> 
        <input class="form-control" id="weight" type="text" name="weight">
	</div>

	<div class="form-group">
		<label for="dimensionsmatch" class="control-label">Dimensions match with Website? </label>
		<input type="checkbox" name="dimensionsmatch" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="productlevel" class="control-label">Product is level on the floor? </label>
		<input type="checkbox" name="productlevel" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="dimensions_match_tech_drawing" class="control-label">Dimensions match with Tech drawing ?</label>
		<input type="checkbox" id="dimensions_match_tech_drawing" name="dimensions_match_tech_drawing" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
            <div id="tech_draw_not_match_reason" style="display: none;">
                <label for="tech_draw_not_match_reason" class="control-label">If Dimensions dont match what is the problem ?</label>
                <textarea id="tech_draw_not_match_reason" name="tech_draw_not_match_reason" cols="78" rows="5"></textarea>
            </div>
    </div>

    <div class="well" style="border-radius: 5px;  background: #FAFAFA;">
    <center><legend>Wood</legend></center>
    <center>Quality check for wood</center>
    <br>

    <div class="form-group">
		<label for="cracked" class="control-label">Cracked ? </label>
		<input type="checkbox" name="cracked" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="scratchwood" class="control-label">Scratch on surface ? </label>
		<input type="checkbox" name="scratchwood" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="inconsistentwood" class="control-label">Inconsistent wood grain ? </label>
		<input type="checkbox" name="inconsistentwood" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="edgespeeling" class="control-label">Edges Peeling off ? </label>
		<input type="checkbox" name="edgespeeling" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="jointnotgood" class="control-label">Joints/Bonds not good ? </label>
		<input type="checkbox" name="jointnotgood" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="otherswood" class="control-label"> Others ? </label>
		<input type="checkbox" name="otherswood" data-style="btn-group-sm pull-right" data-reverse>
	</div>
	</div>

	<div class="well" style="border-radius: 5px;  background: #FAFAFA;">
	<center><legend>Fabric QC</legend></center>
    <center>Quality check on Fabric (if any)</center>
    <br>

    <div class="form-group">
		<label for="torn" class="control-label">Torn ? </label>
		<input type="checkbox" name="torn" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="badstitching" class="control-label">Bad Stitching ? </label>
		<input type="checkbox" name="badstitching" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="stain" class="control-label">Stain ? </label>
		<input type="checkbox" name="stain" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="othersfabric" class="control-label"> Others ? </label>
		<input type="checkbox" name="othersfabric" data-style="btn-group-sm pull-right" data-reverse>
	</div>
	</div>

	<div class="well" style="border-radius: 5px;  background: #FAFAFA;">
	<center><legend>Metal</legend></center>
    <center>Quality check on metal (if any)</center>
    <br>

    <div class="form-group">
		<label for="scratchmetal" class="control-label">Scratch on surface ? </label>
		<input type="checkbox" name="scratchmetal" data-style="btn-group-sm pull-right" data-reverse>
	</div>

    <div class="form-group">
		<label for="badfinishing" class="control-label">Bad Finishing ? </label>
		<input type="checkbox" name="badfinishing" data-style="btn-group-sm pull-right" data-reverse>
	</div>

    <div class="form-group">
		<label for="dent" class="control-label">Dent ? </label>
		<input type="checkbox" name="dent" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="badwelding" class="control-label">Bad Welding ? </label>
		<input type="checkbox" name="badwelding" data-style="btn-group-sm pull-right" data-reverse>
	</div>

	<div class="form-group">
		<label for="othersmetal" class="control-label"> Others ? </label>
		<input type="checkbox" name="othersmetal" data-style="btn-group-sm pull-right" data-reverse>
	</div>
	</div>

	<div class="well" style="border-radius: 5px;  background: #FAFAFA;">
	<center><legend>Glass</legend></center>
    <center>Quality check on glass (if any)</center>
    <br>

    <div class="form-group">
		<label for="scratchglass" class="control-label">Scratch/Crack ? </label>
		<input type="checkbox" name="scratchglass" data-style="btn-group-sm pull-right" data-reverse>
	</div>
	</div>

	<center><legend>Other QC Failures noticed</legend></center>
    <br>

    <div class="form-group">
        <label for="otherconcern" class="control-label">Any other concerns about the item</label>
        <textarea id="otherconcern" name="otherconcern" cols="78" rows="5" ></textarea>
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
    <div id="submit">
			<center>
			<input type="submit" class="btn btn-default" name="submit" value="Submit" >
			</center>
	</div>
</form>
</div>

<script>
$(':checkbox').checkboxpicker();

$('#dimensions_match_tech_drawing').change(function() {
	
	if(document.getElementById("dimensions_match_tech_drawing").checked==false){	  
			document.getElementById("tech_draw_not_match_reason").style.display = "inline";
			document.getElementById("tech_draw_not_match_reason").required = true;
		}
		else {
			document.getElementById("tech_draw_not_match_reason").style.display = "none";
			document.getElementById("tech_draw_not_match_reason").required = false;
		}
})
</script>
