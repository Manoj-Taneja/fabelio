<?php
error_reporting(E_ALL);
require_once(getcwd() . '/../app/Mage.php');
//Mage::setIsDeveloperMode(true);
Mage::app();
?>

<head>
  <meta charset="UTF-8">
  <title>Po Order</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.datatables.net/release-datatables/extensions/TableTools/css/dataTables.tableTools.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <p>&nbsp;</p> 
  <div class="container">
  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#new-po" role="tab" data-toggle="tab">New</a></li>
    <li><a href="#saved-po" role="tab" data-toggle="tab">Saved</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="new-po">
      <form class="new-po-form panel panel-default">
      <table class="table table-striped new-po-table table-hover">
        <thead>
          <tr>
            <td colspan=2> 
              <div class="prod-search-wrap pull-right">

                <div class="input-group">

                  <input id="product" class="form-control product-search" type="text" placeholder="Product Name Search">
                  <div class="input-group-btn" data-toggle="buttons">
                    <label class="btn btn-default">
                      <input name="prod_type" type="radio" value="simple">
                      Simple SKU
                    </label>
                    <label class="btn btn-default active">
                      <input name="prod_type" type="radio" value="configurable" checked>
                      Config SKU
                    </label>
                  </div>

                </div>


              </div>
            </td>
          </tr>
          <tr>
            <th>Product</th>
            <th width=1>Price</th>
          </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
          <tr>
            <td>
              <select name="seller_id" class="form-control" required>
                <option value="">Supplier Name</option>
                <?php
                $suppliers = Mage::getModel('inventorypurchasing/supplier')->getCollection();
                foreach($suppliers as $supplier){
                  echo "<option value='{$supplier->getSupplierId()}'>{$supplier->getSupplierName()}</option>";
                }
?>
              </select>
            </td>
            <td>
            <label>Preferred Supplier ?<input type="checkbox" name="preferred_supplier" class="preferred_supplier"></label>
            </td>
            <td width=1>
              <input type="submit" class="btn btn-primary btn-block save-po" value="Save" style="width: 150px;">
            </td>
          </tr>
        </tfoot>
      </table>
      </form>
      <div class="alert alert-success success_msg" id="success_msg" style="display:none;"><p></p></div>
      <div class="alert alert-danger error_msg" id="error_msg" style="display:none;"><p></p></div>
    </div>
    <div class="tab-pane" id="saved-po">
      <table id="saved-po-table"  class="table table-hover saved-po-table">
        <thead>
          <tr>
            <th>SKU</th>
            <th>Product</th>
            <th>Seller</th>
            <th>Price</th>
            <th>Preferred</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
  </div>
<div class="modal fade update-po-modal" id="update-po-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="update-price-label"></h4>
      </div>
      <div class="modal-body">
        <form class='edit_purchase_price'>
        </form>  
    </div>
    </div>
</div>
</div>

<script>
  <?php
  $supplierModel = Mage::getModel('inventorypurchasing/supplier')->getCollection();
  $data = $supplierModel->toArray();
  ?>
  var suppliers = <?php echo json_encode($data['items']); ?>;
</script>
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://www.datatables.net/release-datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="js/script.js"></script>


<!--<p>&nbsp;</p>

  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Add PO Order</h3>
      </div>
      <div class="panel-body">
        <form class="form-inline po-form" action="./save.php">
          <div class="form-group">
             <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Search</button>
                </span>
              <input type="text" class="form-control" placeholder="Product Name">

          </div>
          <div class="form-group">
            <select name="seller_name" id="seller_name" placeholder='Seller Name' >
                <?php                
                  $supplierModel = Mage::getModel('inventorypurchasing/supplier')
                    ->getCollection()->addFieldToSelect('supplier_name');
                 echo $supplierModel;
                 // $data = $supplierModel->toArray();
                 // echo json_encode($data['items']);
                 
                ?>
              </select>  
          </div>
          <div class="form-group">
            <label class="sr-only" for="price">Price</label>
            <input id="price" class="form-control" type="text" placeholder="Price" name="price">
          </div>
          <input type="submit" value="Save" class="btn btn-default">
        </form>

      <table class="table table-striped price-table">
        <thead>
          <tr>
            <th>SKU</th>
            <th>Product</th>
            <th>Seller</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table> 
   </div>
</div>-->
</body>
</html>
