<?php
include 'config.php';

$sql="select a.sku,a.product_name,a.po_number,b.supplier_name,c.order_type,c.order_id,c.manual_order_id,c.qc_id from inbound_form a join fabelio.erp_inventory_purchase_order b on a.po_number=b.purchase_order_id join qc_2 c on a.item_id = c.item_id where c.scd_end is null and a.item_id='".$_GET['itemid']."'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sku=$row['sku'];
$ordernumber=$row['order_id'];
$productname=$row['product_name'];
$ponumber=$row['po_number'];
$suppliername=$row['supplier_name'];
$ordertype=$row['order_type'];
$manualordernumber=$row['manual_order_id'];
$ordernumber=$row['order_id'];

$sql="select a.entity_id,a.increment_id from fabelio.sales_flat_order a inner join fabelio.sales_flat_order_item b on a.entity_id = b.order_id where (a.status='processing' or a.status='processing_manufacturing23' or a.status='processing_poraised') and b.sku='".$sku."'";
$sql1="select increment_id from fabelio.sales_flat_order where entity_id='".$ordernumber."'";

$result = mysqli_query($conn,$sql);
$result1 = mysqli_query($conn,$sql1);

if ($result1->num_rows > 0) {
	
	$row1 = $result1->fetch_assoc();
}
else{
	
	$row1['increment_id']="";
}

?>

<!DOCTYPE html>
<html>
<body>
<?php include 'header.php';?>
<div class="col-md-6 col-md-offset-3" style="border-radius: 5px;  background: #F8F8F8; padding: 5px;">
	<div style="background: #FFFFFF;">
		<legend><center>Shipment Form</center></legend>
	</div>
<div style="background: #FFFFFF; padding: 20px;">
<form class="form-horizontal" action="input_qcship.php" method="post" enctype="multipart/form-data">

	<div class="form-group">
    	<input class="form-control" id="qcid" type="hidden" value="<?php echo $row['qc_id']; ?>" name="qcid">
	</div>

	<div class="form-group">
		<label for="itemid" class="control-label">Item ID</label> 
    	<input class="form-control" id="itemid" type="text" value="<?php echo $_GET['itemid']; ?>" placeholder="<?php echo $_GET['itemid']; ?>" name="itemid" readonly="readonly">
	</div>
	<div class="form-group">
		<label for="sku" class="control-label">SKU</label> 
    	<input class="form-control" id="sku" type="text" value="<?php echo $sku ; ?>" placeholder="<?php echo $sku ; ?>" name="sku" readonly="readonly">
	</div>
	<div class="form-group">
		<label for="productname" class="control-label">Product Name</label> 
    	<input class="form-control" id="productname" type="text" value="<?php echo $productname ; ?>" placeholder="<?php echo $productname ; ?>" name="productname" readonly="readonly">
	</div>
	
	<div class="form-group" id="logisticstypediv">
		<label for="logisticstype" class="control-label">Logistics Type</label>
		<select name="logisticstype" class="form-control" id="logisticstype" onchange="showlogisticstype(this.value)">
			<option value='fabelio'>Fabelio</option> 
			<option value='3pl'>3PL</option> 
		</select>
	</div>

	<div id="fabeliologistics" >
		
		<div class="form-group">
			<label for="vehiclenumber" class="control-label">Vehicle Number</label> 
	    	<input class="form-control" id="vehiclenumber" type="text" name="vehiclenumber" >
		</div>
		<div class="form-group">
			<label for="logisticscarrierfabelio" class="control-label">Logistics Carrier</label> 
	    	<input class="form-control" id="logisticscarrierfabelio" type="text" name="logisticscarrierfabelio" value="Fabelio" placeholder="Fabelio" readonly="readonly">
		</div>

	</div>
	<div id="3pllogistics" style="display:none;">
		
		<div class="form-group">
			<label for="airwaybillnumber" class="control-label">Airway Bill Number</label> 
	    	<input class="form-control" id="airwaybillnumber" type="text" name="airwaybillnumber" >
		</div>
		<div class="form-group">
			<label for="3pllogisticsname" class="control-label">3PL Name</label> 
	    	<input class="form-control" id="3pllogisticsname" type="text" name="3pllogisticsname">
		</div>

	</div>
	<div class="form-group" id="reasondiv">
		<label for="reason" class="control-label">Reason</label>
		<select name="reason" class="form-control" id="reason" onchange="showreasondetails(this.value)">
			<option value='order'>Customer Order</option> 
			<option value='showroom'>Fabelio Showroom</option> 
			<option value='replacement'>Temporary Replacement</option>
			<option value='other'>Other</option> 
		</select>
	</div>
	<div id="customerorder" >
		<div class="form-group">
			<label for="manualordernumber" class="control-label">Manual Order Number (B2B)</label> 
			<input class="form-control" id="manualordernumber" type="text" name="manualordernumber" onkeyup="manual_order(this.value)" value="<?php echo $manualordernumber ; ?> " >
		</div>

			<?php
			if ($result->num_rows > 0) {
			    ?> 
			    <div class="form-group" id="ordernumber">
			        <label id ="orderlabel" for="ordernumber" class="control-label">Order Number:<?php echo $row1["increment_id"]; ?> </label>
			        <select name="ordernumber" onchange="showorder(this.value)" class="form-control" id="ordernumber">
			        <option value="<?php echo $row1["increment_id"]; ?>">Change Order Number</option>
			            <?php
			            while($row = $result->fetch_assoc()) { ?>

			                <option value='<?php echo $row["increment_id"]; ?>'><?php echo $row["increment_id"]; ?></option>    
			            
			            <?php  } ?>
			         </select>
			    </div>

			    <div class="form-group">
			        <label for="ordertype" class="control-label">Order Type</label> 
			        <input class="form-control" id="ordertype" type="text" value="<?php echo $ordertype ; ?> " placeholder="<?php echo $ordertype ; ?> " name="ordertype" readonly="readonly">
			    </div>
			   

			<?php 
			} 

			else {?>
			    <div class="form-group">
			        <label for="ordertype" class="control-label">Order Type</label> 
			        <input class="form-control" id="ordertype" type="text" value="<?php echo $ordertype ; ?>" placeholder="<?php echo $ordertype ; ?>" name="ordertype" readonly="readonly">
			    </div>
			    
			<?php }

			?>
		</div>

		
		<div id="replacement" style="display:none;">
			<div class="form-group">
				<label for="reference" class="control-label">Reference</label> 
		    	<input class="form-control" id="reference" type="text" name="reference" >
			</div>
		</div>

		<div id="others" style="display:none;"> 
            <textarea id="others" name="others" cols="76" rows="5" name="others" ></textarea>
		</div>
		<br />
		<div id="submit" style="display: none;">
			<center>
			<input type="submit" class="btn btn-default" name="submit" value="Submit" >
			</center>
		</div>
</form>
</div>
</div>
</body>
</html>

<script type="text/javascript">
	
function showlogisticstype(str){
	if(str=="fabelio"){
		document.getElementById("3pllogistics").style.display="none";
		document.getElementById("fabeliologistics").style.display="block";
	} else if(str=="3pl"){
		
		document.getElementById("fabeliologistics").style.display="none";
		document.getElementById("3pllogistics").style.display="block";
	}
}

	function showreasondetails(str){
		if (str==""){
			document.getElementById("replacement").style.display="none";
			document.getElementById("others").style.display="none";
			document.getElementById("customerorder").style.display="none";
			document.getElementById("submit").style.display="none";
		}
		if (str=="order"){
			document.getElementById("customerorder").style.display="block";
			document.getElementById("submit").style.display="block";
			document.getElementById("replacement").style.display="none";
			document.getElementById("others").style.display="none";
		}
		if (str=="showroom"){
			document.getElementById("customerorder").style.display="none";
			document.getElementById("submit").style.display="block";
			document.getElementById("replacement").style.display="none";
			document.getElementById("others").style.display="none";
		}
		if (str=="replacement"){
			document.getElementById("customerorder").style.display="none";
			document.getElementById("submit").style.display="block";
			document.getElementById("replacement").style.display="block";
			document.getElementById("others").style.display="none";
		}
		if (str=="other"){
			document.getElementById("customerorder").style.display="none";
			document.getElementById("submit").style.display="block";
			document.getElementById("replacement").style.display="none";
			document.getElementById("others").style.display="block";
		}
	}

	function manual_order(str){
		if(str == ""){	  
			document.getElementById("ordertype").placeholder = "Supply";
	        document.getElementById("ordertype").value = "Supply";
	        if(document.getElementById("ordernumber")!=null){
	        	document.getElementById("ordernumber").disabled = false;
	        }
		}
		else {
			document.getElementById("ordertype").placeholder = "B2B";
	        document.getElementById("ordertype").value = "B2B";
	        if(document.getElementById("ordernumber")!=null){
	        	document.getElementById("ordernumber").disabled = true;
	        }
		}
	}

	function showorder(str){
	if (str == "") {
		document.getElementById("orderlabel").innerHTML = "Order Number:"+str;
		document.getElementById("manualorder").disabled = false;
        document.getElementById("ordertype").placeholder = "Supply";
        document.getElementById("ordertype").value = "Supply";
        return;
    }
    else {
    	document.getElementById("orderlabel").innerHTML = "Order Number:"+str;
    	document.getElementById("manualorder").disabled = true;
    	document.getElementById("manualorder").value = "";
    	document.getElementById("manualorder").placeholder ="";
    	document.getElementById("ordertype").placeholder = "Demand";
        document.getElementById("ordertype").value = "Demand";
        return;
    }

}
</script>