<?php
include 'config.php';
include 'header.php';

$_SESSION['inbound_input']=1;
$_SESSION['quantity']=1;

$sql="select supplier_id,supplier_name from fabelio.erp_inventory_supplier";
$result = $conn->query($sql);


?>
<style type="text/css">
	.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>

<div class="col-md-6 col-md-offset-3" style="border-radius: 5px;  background: #F8F8F8; padding: 5px;">
	<div style="background: #FFFFFF;">
		<legend><center>Inbound Form</center></legend>
	</div>
<div style="background: #FFFFFF; padding: 20px;">
<form class="form-horizontal" action="input_inbound.php" method="post" enctype="multipart/form-data">

	<div class="form-group" id="supplier_select">
	<label for="supplier" class="control-label">Supplier</label>
		<select id="supplier" name="supplier" onchange="showsupplier(this.value)" class="form-control">
		<option value="">Select Supplier</option>
			<?php
			while($row = $result->fetch_assoc()) {
			?>
			<option value='<?php echo $row["supplier_id"]?>'><?php echo $row["supplier_name"]?></option>
			<?php       
		    }
		 	?>
		 </select>

	</div>
	<div class="form-group">
			<label for="date" class="control-label">Inbound Date</label>
	 		<div class='input-group date' id='datetimepicker'>
				<input type='text' class="form-control" name="inbound_date" required/>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>

		<div class="form-group">
			<label for="match_ordered" class="control-label">Delivery Receipt matches with ordered items ?</label>
			<input type="checkbox" name="match_ordered" data-style="btn-group-sm pull-right" data-reverse>
		</div>

		<div class="form-group">
			<label for="have_receipt" class="control-label">Have Delivery Receipt from Supplier ?</label>
			<input type="checkbox" id="have_receipt" name="have_receipt" data-style="btn-group-sm pull-right" onchange="uploadreceipt()" data-reverse>
		</div>

		<div class="form-group">
			<div id="upload_receipt" style="display: none;">
				<label for="delivery_receipt" class="control-label">Upload Delivery Receipt Image</label>
				<input id="input-id" class="file" type="file" name="delivery_receipt" data-preview-file-type="text">
			</div>
		</div>

	<div id="supplier_details"></div>
	<div id="po_details"></div>
	<div id="product_details"></div>
	<div id="inbound_data" style="visibility: hidden;">
		
		<div id="submit" style="visibility: hidden;">
			<center>
			<input type="submit" class="btn btn-default" name="submit" value="Submit" >
			</center>
		</div>
	</div>
</form>
</div>
</div>
</body>
</html>

<script>
$(':checkbox').checkboxpicker();

function update_quantity(str){
	if(str==""){
    		alert("Please enter a valid quantity to continue");
    		document.getElementById("submit").style.visibility = "hidden";
    	}  
    if(document.getElementById("product")!=null){

	    if(document.getElementById("product").value==""){
	    	return;
	    }
	    else {
	    	showproduct(document.getElementById("product").value);
	    }
	}
}

function uploadreceipt(){
	if(document.getElementById("have_receipt").checked==true){
		document.getElementById("upload_receipt").style.display = "inline";
		$('#input-id').fileinput('enable');
		}
	else{
		document.getElementById("upload_receipt").style.display = "none";
		$('#input-id').fileinput('reset');
	}
}

function reject(str,num) {
if(str == "fail"){	  
		document.getElementById("reject-"+num).style.display = "inline";
		document.getElementById("reason-"+num).required = true;
	}
	else {
		document.getElementById("reject-"+num).style.display = "none";
		document.getElementById("reason-"+num).required = false;
	}
};

function manual_order(str,num){
	if(str == ""){	  
		document.getElementById("ordertype-"+num).placeholder = "Supply";
        document.getElementById("ordertype-"+num).value = "Supply";
        if(document.getElementById("ordernumber-"+num)!=null){
        	document.getElementById("ordernumberdiv-"+num).style.display= "block";
        }
	}
	else {
		document.getElementById("ordertype-"+num).placeholder = "B2B";
        document.getElementById("ordertype-"+num).value = "B2B";
        if(document.getElementById("ordernumber-"+num)!=null){
        	document.getElementById("ordernumberdiv-"+num).style.display = "none";
        }
	}
}

function showsupplier(str) {
	$('#qc_fail').prop('checked', false);
	$('#have_receipt').prop('checked', false);
	document.getElementById("product_details").innerHTML = "";
	document.getElementById("po_details").innerHTML = "";
	document.getElementById("inbound_data").style.visibility = "hidden";
	document.getElementById("submit").style.visibility = "hidden";
    if (str == "") {
        document.getElementById("supplier_details").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("supplier_details").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getsupplier.php?supplier="+str,true);
        xmlhttp.send();
    }
}

function showpo(str) {
	$('#qc_fail').prop('checked', false);
	document.getElementById("product_details").innerHTML = "";
	document.getElementById("inbound_data").style.visibility = "hidden";
	document.getElementById("submit").style.visibility = "hidden";
    if (str == "") {
        document.getElementById("po_details").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("po_details").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getpo.php?po="+str,true);
        xmlhttp.send();
    }
}
function showproduct(str) {
	
	document.getElementById("submit").style.visibility = "visible";

    if (str == ""||document.getElementById("quantity").value==""||document.getElementById("quantity").value=="0") {
    	
        document.getElementById("product_details").innerHTML = "";
        document.getElementById("submit").style.visibility = "hidden";
        document.getElementById("inbound_data").style.visibility = "hidden";
        if(document.getElementById("quantity").value==""||document.getElementById("quantity").value=="0"){
    		alert("Please enter a valid quantity to continue");
    	}        
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("product_details").innerHTML = xmlhttp.responseText;
                document.getElementById("inbound_data").style.visibility = "visible";
            }
        }
        xmlhttp.open("GET","getproduct.php?"+str+"&quantity="+document.getElementById("quantity").value,true);
        xmlhttp.send();
    }
}

function showorder(str,num){
	if (str == "") {
		document.getElementById("manualorderdiv-"+num).style.display = "block";
        document.getElementById("ordertype-"+num).placeholder = "Supply";
        document.getElementById("ordertype-"+num).value = "Supply";
        return;
    }
    else {
    	document.getElementById("manualorderdiv-"+num).style.display = "none";
    	document.getElementById("manualorder-"+num).value = "";
    	document.getElementById("manualorder-"+num).placeholder ="";
    	document.getElementById("ordertype-"+num).placeholder = "Demand";
        document.getElementById("ordertype-"+num).value = "Demand";
        return;
    }

}

</script>

<script type="text/javascript">
		$(function () {
			$('#datetimepicker').datetimepicker({
        	pickTime: false,
            useCurrent: true
       		});
		});
</script>
<?php
$conn->close();

?>