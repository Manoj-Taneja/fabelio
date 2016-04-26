<!DOCTYPE html>
<html>
<body>

<?php
include 'config.php';

if(isset($_POST["quantity"])){
    $quantity=$_POST["quantity"];
}

parse_str($_SERVER['QUERY_STRING']);
$sku = $product['product_sku'];
$name = $product['product_name'];


$sql="select a.entity_id,a.increment_id from fabelio.sales_flat_order a inner join fabelio.sales_flat_order_item b on a.entity_id = b.order_id where (a.status='processing' or a.status='processing_manufacturing23' or a.status='processing_poraised') and b.sku='".$sku."'";

$result = mysqli_query($conn,$sql);
?>

<div class="form-group">
    <label for="sku" class="control-label">SKU</label> 
    <input class="form-control" id="sku" type="text" value="<?php echo $sku; ?>" placeholder="<?php echo $sku; ?>" name="sku" readonly="readonly">
</div>

    <input class="form-control" id="productname" type="hidden" value="<?php echo $name; ?>" name="productname" >
<?php 
for($i=1;$i<=$quantity;$i++){
 ?>
<center><legend>Item - <?php echo $i; ?></legend></center>
<div class="form-group" id="manualorderdiv-<?php echo $i; ?>">
        <label for="manualorder" class="control-label">Manual Order Number (B2B)</label> 
        <input class="form-control" id="manualorder-<?php echo $i; ?>" type="text" name="manualorder[]" onkeyup="manual_order(this.value,<?php echo $i; ?>)" >
</div>

<?php
if ($result->num_rows > 0) {
    mysqli_data_seek($result, 0);
    ?> 
    <div class="form-group" id="ordernumberdiv-<?php echo $i; ?>">
        <label for="orderid" class="control-label">Order Number</label>
        <select name="orderid[]" onchange="showorder(this.value,<?php echo $i; ?>)" class="form-control" id="ordernumber-<?php echo $i; ?>">
        <option value="">Select Order Number</option>
            <?php
            while($row = $result->fetch_assoc()) { ?>

                <option value='<?php echo $row["entity_id"]; ?>'><?php echo $row["increment_id"]; ?></option>    
            
            <?php  } ?>
         </select>
    </div>

    <div class="form-group">
        <label for="ordertype" class="control-label">Order Type</label> 
        <input class="form-control" id="ordertype-<?php echo $i; ?>" type="text" value="Supply" placeholder="Supply" name="order_type[]" readonly="readonly">
    </div>
   

<?php 
} 

else {?>
    <div class="form-group">
        <label for="ordertype" class="control-label">Order Type</label> 
        <input class="form-control" id="ordertype-<?php echo $i; ?>" type="text" value="Supply" placeholder="Supply" name="order_type[]" readonly="readonly">
    </div>
    
<?php }

?>
        <div class="form-group">
            <label for="qc_fail" class="control-label">Item Status</label>
                <div class="pull-right">
                    <label class="radio-inline">
                    <input type="radio" name="itemstatus-<?php echo $i; ?>" id="itemstatus-<?php echo $i; ?>" onclick="reject(this.value,<?php echo $i; ?>)" value="pass" checked> Ready for QC
                    </label>
                    <label class="radio-inline">
                    <input type="radio" name="itemstatus-<?php echo $i; ?>" id="itemstatus-<?php echo $i; ?>" value="fail" onclick="reject(this.value,<?php echo $i; ?>)"> Rejected Inbound
                    </label>
                </div>
        </div>

        <div class="form-group">
            <div id="reject-<?php echo $i; ?>" style="display: none;">
                <label for="reason" class="control-label">QC Fail Reason</label>
                <textarea id="reason-<?php echo $i; ?>" name="reject_reason[]" cols="78" rows="5" name="reason" ></textarea>
            </div>
        </div>
<?php 
} 
?>
<?php
mysqli_close($conn);
?>
</body>
</html>
