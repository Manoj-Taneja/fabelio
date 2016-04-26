<?php
error_reporting(E_ALL);
require_once(getcwd() . '/../app/Mage.php');
//Mage::setIsDeveloperMode(true);
Mage::app();

$conn = new mysqli("localhost", "root", "504633", "fl_custom");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

function save($data) {
  global $conn;

  $id = @$data['id'];
  $productId = @$data['product_id'];
  $sellerId = @$data['seller_id'];
  $productName = @$data['product_name'];
  $sellerName = @$data['seller_name'];
  $price = @$data['price'];
  if(@$data['preferred_supplier']){
    $preferred_supplier=1;
  }else{
     $preferred_supplier=0;
  }
  $result = false;
  if($act = @$data['action'] && $id =  @$data['id']) {
    switch($act){
      case 'delete':
        $query = "delete from po_seller where id=$id";
        $res = Array();
        if($conn->query($query)) {
          $res['success'] = true;
        }else{
          $res['error'] = true;
        }
        echo json_encode($res);
        die;
        break;
    }
  }

  if($id){
    $updateSet = [];
    if($productId) $updateSet[] = " product_id='$productId' ";
    if($sellerId) $updateSet[] = " supplier_id='$sellerId' ";
    if($productName) $updateSet[] = " product_name='$productName' ";
    if($sellerName) $updateSet[] = " supplier_name='$sellerName' ";
    if($price) $updateSet[] = " price='$price' ";
     $updateSet[] = " preferred_supplier='$preferred_supplier' ";
    if(count($updateSet)>1){
      $query = "UPDATE po_seller set ";
      $query .= join(',', $updateSet);
      $query .= " WHERE id=$id ";
      $res = $conn->query($query);
      echo json_encode($res);
    }

  }else{
    $i=0;
    $j=0;
    $supplierId = @$data['seller_id'];
    if(@$data["price"] && $supplierId){
      $price = array_filter(@$data["price"]);
      $supplier = Mage::getModel('inventorypurchasing/supplier')->load($supplierId);
      if(!$supplier){
        $res = Array();
        $res['error'] = 'Invalid supplier';
        echo json_encode($res);
        die;
      }
      $supplierName = $supplier->getSupplierName();
      $res = Array();
      foreach($price as $prodId => $p){
        $productName = Mage::getModel('catalog/product')->load($prodId)->getName();
        $query = "INSERT INTO po_seller (supplier_id, supplier_name, product_id, product_name, price ,preferred_supplier) VALUES(?, ?, ?,?,?,?)";
        $statement = $conn->prepare($query);
        ////bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
        $statement->bind_param('ssssss', $supplierId, $supplierName, $prodId, $productName, $p, $preferred_supplier);
        $result = $statement->execute();
        if($result){
          $i++;
          $res[$prodId] = $conn->insert_id;
        }else{
          $j++;
          $res[$prodId] = false;
        }
      }
      $res['success_inserted_items']=$i;
      $res['fail_inserted_items']=$j;

      echo json_encode($res);
      die;
    }
  }

}

function get($data) {
  global $conn;

  $product_name = @$data['product_name'];
  $seller_name = @$data['seller_name'];
  $price = @$data['price'];

  $query = "select * from po_seller";

  $querySet = [];
  if($product_name) $querySet[] = " product_name like \"%$product_name%\" ";
  if($seller_name) $querySet[] = " supplier_name like \"%$seller_name%\" ";
  if($price) $querySet[] = " price='$price' ";

  if(count($querySet)>0){
    $query .= " where ";
    $query .= join(' or ', $querySet);
  }

  //echo $query; die;

  $result = $conn->query($query);

  if($result){
    $data = [];
    while ($row = $result->fetch_assoc()) {
      $row['formated_price'] = Mage::helper('core')->currency($row['price'], true, false);
      $_product = Mage::getModel('catalog/product')->load($row['product_id']);
      $row['sku'] = $_product->getSku();
      $data[] = $row;
    }
    echo json_encode(Array(
      'success'=> true,
      'data'   => $data
    ));
    die;
  } else {
    echo json_encode(Array(
      'error'=> 'Error : ('. $conn->errno .') '. $conn->error,
    ));
    die;
  }

}


if(!empty($_POST)) {
  save($_POST);
  die;
}

if(!empty($_GET)) {
  get($_GET);
  die;
}

