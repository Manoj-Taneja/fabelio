<!DOCTYPE html>
<html>
<body>

<?php
include 'config.php';

$supplier = intval(@$_GET['supplier']);

$sql="SELECT purchase_order_id FROM fabelio.erp_inventory_purchase_order WHERE status=5 and supplier_id = '".$supplier."'";
$result = mysqli_query($conn,$sql);

?>

<div class="form-group">
    <label for="po" class="control-label">Purchase Order</label>
    <select id="po" name="poid" onchange="showpo(this.value)" class="form-control">
    <option value="">Select Purchase Order</option>
        <?php
        while($row = $result->fetch_assoc()) {
        ?>
        <option value='<?php echo $row['purchase_order_id']; ?>'><?php echo $row["purchase_order_id"]?></option>
        <?php       
        }
        ?>
    </select>
</div>

<?php
mysqli_close($conn);
?>
</body>
</html>
