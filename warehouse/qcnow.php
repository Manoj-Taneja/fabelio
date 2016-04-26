<?php
include 'config.php';
include 'header.php';

$sql="select a.item_id,a.sku,a.product_name,a.order_id,b.increment_id,a.order_type,a.manual_order_id,d.supplier_name from inbound_form a left join fabelio.sales_flat_order b on a.order_id=b.entity_id left join qc_2 c on a.item_id=c.item_id left join fabelio.erp_inventory_supplier d on a.supplier_id=d.supplier_id where a.item_status=1 and c.item_id is null";
$inboundpass = $conn->query($sql);

$sql="select a.item_id,b.sku,b.product_name,c.supplier_name,b.po_number,a.order_type,a.order_id,d.increment_id,a.manual_order_id from qc_2 a left join inbound_form b on a.item_id=b.item_id left join fabelio.erp_inventory_supplier c on b.supplier_id=c.supplier_id left join fabelio.sales_flat_order d on d.entity_id=a.order_id where a.qc_item_status='pass' and a.scd_end is null";

$qcpass = $conn->query($sql);

$sql="select a.item_id,b.sku,b.product_name,c.supplier_name,b.po_number,a.order_type,a.order_id,d.increment_id,a.manual_order_id from qc_2 a left join inbound_form b on a.item_id=b.item_id left join fabelio.erp_inventory_supplier c on b.supplier_id=c.supplier_id left join fabelio.sales_flat_order d on d.entity_id=a.order_id where a.qc_item_status='repair' and a.scd_end is null";

$qcrepair = $conn->query($sql);

$sql="select a.item_id,b.sku,b.product_name,c.supplier_name,b.po_number,a.order_type,a.order_id,d.increment_id,a.manual_order_id from qc_2 a left join inbound_form b on a.item_id=b.item_id left join fabelio.erp_inventory_supplier c on b.supplier_id=c.supplier_id left join fabelio.sales_flat_order d on d.entity_id=a.order_id where a.qc_item_status='return' and a.scd_end is null";

$qcreturn = $conn->query($sql);

$sql="select a.qc_id,a.item_id,b.sku,b.product_name,c.supplier_name,b.po_number,a.order_type,a.order_id,d.increment_id,a.manual_order_id from qc_2 a left join inbound_form b on a.item_id=b.item_id left join fabelio.erp_inventory_supplier c on b.supplier_id=c.supplier_id left join fabelio.sales_flat_order d on d.entity_id=a.order_id where a.qc_item_status='ready' and scd_end is null";

$qcready = $conn->query($sql);

?>
<style type="text/css">

.modal-body{
    height: 500px;
    overflow-y: auto;
}
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

</style>


<html>
<body>

<div class="head">
<center><legend>Items ready for QC</legend> </center>
</div>
<div class="container" width="80%">
	<table id="qcnow" class="table table-hover table-bordered" cellspacing="0" width="100%"> 
	<thead>
	<tr>
	    <th>Item ID</th>
	    <th>SKU</th>
	    <th>Product Name</th>
	    <th>Supplier Name</th>
	    <th>Order Type</th>
	    <th class="col-md-2">Order Number</th>
	    <th class="col-md-2">Item Status</th>
	    <th>Other Options</th>
  	</tr>
  	</thead>
  	<tfoot>
	<tr>
	    <th>Item ID</th>
	    <th>SKU</th>
	    <th>Product Name</th>
	    <th>Supplier Name</th>
	    <th>Order Type</th>
	    <th class="col-md-2">Order Number</th>
	    <th class="col-md-2">Item Status</th>
	    <th>Other Options</th>
  	</tr>
  	</tfoot>
  	
  	<tbody>
  		<?php
  			$i=0;
			while($row = $inboundpass->fetch_assoc()) {
			?>
			<tr>
			<td id="itemid-<?php echo $i; ?>"><?php echo $row['item_id'] ;?></td>
			<td id="sku-<?php echo $i; ?>"><?php echo $row['sku'] ;?></td>
			<td id="productname-<?php echo $i; ?>"><?php echo $row['product_name'] ;?></td>
			<td id="suppliername-<?php echo $i; ?>"><?php echo $row['supplier_name'] ;?></td>
			<td id="ordertype-<?php echo $i; ?>"><?php echo $row['order_type'] ;?></td>
			<td id="orderid-<?php echo $i;  ?>">
			<span class="orderid">
				<?php if($row['order_type']=="B2B"){ echo $row['manual_order_id'] ; } else { echo $row['increment_id'] ; } ?>
			</span>
			</td>
			<td id="itemstatus-<?php echo $i; ?>">
				<span class="itemstatus">Ready for QC</span>
			</td>
			<td id="modal-<?php echo $i; ?>" ><a href="#" id="button-<?php echo $i; ?>" class="btn btn-primary btn-sm" onclick="showmodal(<?php echo $i; ?>,'qcitem','status')" >QC Item</a></td>
			</td>
			</tr>
			<?php 
			$i++;      
		    }
		    ?>
		    <?php
		    while($row = $qcpass->fetch_assoc()){
		    	?>
		    	<tr>
		    	<td id="itemid-<?php echo $i; ?>"><?php echo $row['item_id'] ;?></td>
				<td id="sku-<?php echo $i; ?>"><?php echo $row['sku'] ;?></td>
				<td id="productname-<?php echo $i; ?>"><?php echo $row['product_name'] ;?></td>
				<td id="suppliername-<?php echo $i; ?>"><?php echo $row['supplier_name'] ;?></td>
				<td id="ordertype-<?php echo $i; ?>"><?php echo $row['order_type'] ;?></td>
				<td id="orderid-<?php echo $i;  ?>">
					<span class="orderid">
						<?php if($row['order_type']=="B2B"){ echo $row['manual_order_id'] ; } else { echo $row['increment_id'] ; } ?>
					</span>
					<a href="#" id="button-<?php echo $i; ?>" class="btn btn-sm pull-right" onclick="showmodal(<?php echo $i; ?>,'qcpass','order')" >
					<span class="glyphicon glyphicon-pencil"></span></a>
				</td>
				<td id="itemstatus-<?php echo $i; ?>">
					<span class="itemstatus">QC Pass</span>
					<a href="#" id="button-<?php echo $i; ?>" class="btn btn-sm pull-right" onclick="showmodal(<?php echo $i; ?>,'qcpass','status')" >
					<span class="glyphicon glyphicon-pencil"></a>
				</td>
				<td id="modal-<?php echo $i; ?>" ></td>
				</tr>
			<?php
			$i++;
		    }
		 	?>
		 	<?php
		    while($row = $qcrepair->fetch_assoc()){
		    	?>
		    	<tr>
		    	<td id="itemid-<?php echo $i; ?>"><?php echo $row['item_id'] ;?></td>
				<td id="sku-<?php echo $i; ?>"><?php echo $row['sku'] ;?></td>
				<td id="productname-<?php echo $i; ?>"><?php echo $row['product_name'] ;?></td>
				<td id="suppliername-<?php echo $i; ?>"><?php echo $row['supplier_name'] ;?></td>
				<td id="ordertype-<?php echo $i; ?>"><?php echo $row['order_type'] ;?></td>
				<td id="orderid-<?php echo $i;  ?>">
					<span class="orderid">
						<?php if($row['order_type']=="B2B"){ echo $row['manual_order_id'] ; } else { echo $row['increment_id'] ; } ?>
					</span>
					<a href="#" id="button-<?php echo $i; ?>" class="btn btn-sm pull-right" onclick="showmodal(<?php echo $i; ?>,'qcrepair','order')" >
					<span class="glyphicon glyphicon-pencil"></a>
				</td>
				<td id="itemstatus-<?php echo $i; ?>">
					<span class="itemstatus">Repair</span>
					<a href="#" id="button-<?php echo $i; ?>" class="btn btn-sm pull-right" onclick="showmodal(<?php echo $i; ?>,'qcrepair','status')" ><span class="glyphicon glyphicon-pencil"></a>
				</td>
				<td id="modal-<?php echo $i; ?>" ></td>
				</tr>
			<?php
			$i++;
		    }
		 	?>
		 	<?php
		    while($row = $qcreturn->fetch_assoc()){
		    	?>
		    	<tr>
		    	<td id="itemid-<?php echo $i; ?>"><?php echo $row['item_id'] ;?></td>
				<td id="sku-<?php echo $i; ?>"><?php echo $row['sku'] ;?></td>
				<td id="productname-<?php echo $i; ?>"><?php echo $row['product_name'] ;?></td>
				<td id="suppliername-<?php echo $i; ?>"><?php echo $row['supplier_name'] ;?></td>
				<td id="ordertype-<?php echo $i; ?>"><?php echo $row['order_type'] ;?></td>
				<td id="orderid-<?php echo $i;  ?>">
					<span class="orderid">
						<?php if($row['order_type']=="B2B"){ echo $row['manual_order_id'] ; } else { echo $row['increment_id'] ; } ?>
					</span>
					<a href="#" id="button-<?php echo $i; ?>" class="btn btn-sm pull-right" onclick="showmodal(<?php echo $i; ?>,'qcreturn','order')" >
					<span class="glyphicon glyphicon-pencil"></a>
				</td>
				<td id="itemstatus-<?php echo $i; ?>">
					<span class="itemstatus">Return To Supplier</span>
					<a href="#" id="button-<?php echo $i; ?>" class="btn btn-sm pull-right" onclick="showmodal(<?php echo $i; ?>,'qcreturn','status')" >
					<span class="glyphicon glyphicon-pencil"></a>
				</td>
				<td id="modal-<?php echo $i; ?>" ><a href="#" id="button-<?php echo $i; ?>" class="btn btn-primary btn-sm" onclick="showmodal(<?php echo $i; ?>,'qcreturn','return')" >Return Item</a></td>
				</tr>
			<?php
			$i++;
		    }
		 	?>
		 	<?php
		    while($row = $qcready->fetch_assoc()){
		    	?>
		    	<tr>
		    	<td id="itemid-<?php echo $i; ?>"><?php echo $row['item_id'] ;?></td>
				<td id="sku-<?php echo $i; ?>"><?php echo $row['sku'] ;?></td>
				<td id="productname-<?php echo $i; ?>"><?php echo $row['product_name'] ;?></td>
				<td id="suppliername-<?php echo $i; ?>"><?php echo $row['supplier_name'] ;?></td>
				<td id="ordertype-<?php echo $i; ?>"><?php echo $row['order_type'] ;?></td>
				<td id="orderid-<?php echo $i;  ?>">
					<span class="orderid">
						<?php if($row['order_type']=="B2B"){ echo $row['manual_order_id'] ; } else { echo $row['increment_id'] ; } ?>
					</span>
					<a href="#" id="button-<?php echo $i; ?>" class="btn btn-sm pull-right" onclick="showmodal(<?php echo $i; ?>,'qcready','order')" >
					<span class="glyphicon glyphicon-pencil"></a>
				</td>
				<td id="itemstatus-<?php echo $i; ?>">
					<span class="itemstatus">Ready to Ship</span>
					<a href="#" id="button-<?php echo $i; ?>" class="btn btn-sm pull-right" onclick="showmodal(<?php echo $i; ?>,'qcready','status')" ><span class="glyphicon glyphicon-pencil"></a>
				</td>
				<td id="modal-<?php echo $i; ?>" ><a href="#" id="button-<?php echo $i; ?>" class="btn btn-primary btn-sm" onclick="showmodal(<?php echo $i; ?>,'qcship','')" >Ship Item</a></td>
				</tr>
			<?php
			$i++;
		    }
		 	?>
  	</tbody>

	</table>
</div>
<div id="editor" class="modal fade"></div>


</body>
</html>

<script type="text/javascript">


$(document).ready(function() {
    // DataTable
    
    var table = $('#qcnow').DataTable({
    	fixedHeader: true,
	    "order": [[ 7, "asc" ]],
	    dom: "<'row'<'col-sm-4'l><'col-sm-4'T><'col-sm-4'f>>R" +
		     "<'row'<'col-sm-12'tr>>" +
		     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
		tableTools: {
            "sSwfPath": "bootstrap/datatable/swf/copy_csv_xls_pdf.swf",
            "aButtons": [ "csv", "pdf" ]
        }
		});
 	 // Setup - add a text input to each footer cell
    $('#qcnow tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>

<script type="text/javascript">


function showmodal(str,form,reason){


  if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
                document.getElementById("editor").innerHTML = xmlhttp.responseText;
            }
            
        }

   if(form=="qcreturn"){
		if(reason=="return"){
     	   window.location.replace("http://"+<?php echo json_encode($host); ?>+"/warehouse/qcreturn.php?itemid="+document.getElementById("itemid-"+str).innerHTML+"&change="+reason);
    	}
    	else {
    		xmlhttp.open("GET","qcreturn.php?itemid="+document.getElementById("itemid-"+str).innerHTML+"&change="+reason,true);
    	}
    }

   if(form=="qcitem"){
   	
        xmlhttp.open("GET","qcitem.php?itemid="+document.getElementById("itemid-"+str).innerHTML+"&change="+reason,true);
    }
    if(form=="qcpass"){
    	
        xmlhttp.open("GET","qcpass.php?itemid="+document.getElementById("itemid-"+str).innerHTML+"&change="+reason,true);
    }
    
    if(form=="qcrepair"){
        xmlhttp.open("GET","qcrepair.php?itemid="+document.getElementById("itemid-"+str).innerHTML+"&change="+reason,true);
    }
    if(form=="qcready"){
        xmlhttp.open("GET","qcready.php?itemid="+document.getElementById("itemid-"+str).innerHTML+"&change="+reason,true);
    }
    if(form=="qcship"){
        window.location.replace("http://"+<?php echo json_encode($host); ?>+"/warehouse/qcship.php?itemid="+document.getElementById("itemid-"+str).innerHTML+"&change="+reason);
    }
        xmlhttp.send();
        $("#editor").modal('show');
}
</script>

<script>

function dimensions_match_tech_drawing_changed(){
	
	if(document.getElementById("dimensions_match_tech_drawing").checked==false){	  
			document.getElementById("tech_draw_not_match_reason").style.display = "inline";
			document.getElementById("tech_draw_not_match_reason").required = true;
		}
		else {
			document.getElementById("tech_draw_not_match_reason").style.display = "none";
			document.getElementById("tech_draw_not_match_reason").required = false;
		}
}


function ordertypechanged(str){
	if(str=="Supply"){
		document.getElementById("ordernumberselectdiv").style.display="none";
		document.getElementById("manualordernumberdiv").style.display="none";
		return;
	}
	if(str=="Demand"){
		document.getElementById("ordernumberselectdiv").style.display="block";
		document.getElementById("manualordernumberdiv").style.display="none";
		return;
	}
	if(str=="B2B"){
		document.getElementById("ordernumberselectdiv").style.display="none";
		document.getElementById("manualordernumberdiv").style.display="block";
		return;
	}

}

function itemstatuschanged(str){
if(str=="shipped"){
	document.getElementById("shipmentdetails").style.display="block";
}
else{
	document.getElementById("shipmentdetails").style.display="none";
}
}
</script>

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
			document.getElementById("submit").style.display="inline";
			document.getElementById("replacement").style.display="none";
			document.getElementById("others").style.display="none";
		}
		if (str=="showroom"){
			document.getElementById("customerorder").style.display="none";
			document.getElementById("submit").style.display="inline";
			document.getElementById("replacement").style.display="none";
			document.getElementById("others").style.display="none";
		}
		if (str=="replacement"){
			document.getElementById("customerorder").style.display="none";
			document.getElementById("submit").style.display="inline";
			document.getElementById("replacement").style.display="block";
			document.getElementById("others").style.display="none";
		}
		if (str=="other"){
			document.getElementById("customerorder").style.display="none";
			document.getElementById("submit").style.display="inline";
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


