<!DOCTYPE html>
<html>
<body>

<?php
include 'config.php';

$po = intval($_GET['po']);

$sql="SELECT product_name,product_sku FROM fabelio.erp_inventory_purchase_order_product WHERE qty_recieved<qty and purchase_order_id = '".$po."'";
$result = mysqli_query($conn,$sql);
?>

<div class="form-group">
    <label for="product" class="control-label">Product</label>
    <select id="product" name="product" onchange="showproduct(this.value)" class="form-control">
    <option value="">Select product</option>
        <?php
        while($row = $result->fetch_assoc()) {
        ?>
        <option value='<?php echo http_build_query(array('product' => $row)); ?>'><?php echo $row["product_name"]?></option>
        <?php       
        }
        ?>
     </select>
</div>

<div class="form-group">
            <label for="quantity" class="control-label">Quantity</label> 
            <input class="form-control" id="quantity" type="number" min="0" name="quantity" value="1" onchange="update_quantity(this.value)" >
</div>

<?php

mysqli_close($conn);
?>
</body>
</html>