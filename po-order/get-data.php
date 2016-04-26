<?php
error_reporting(E_ALL);
require_once(getcwd() . '/../app/Mage.php');
//Mage::setIsDeveloperMode(true);
Mage::app();
$productName = trim(@$_GET['product']);
if($productName){
  $product_collection = Mage::getResourceModel('catalog/product_collection')
    ->addAttributeToSelect('*')
    ->addAttributeToFilter('type_id', @$_GET['prod_type'])
    //->setPageSize(10)
    ->addAttributeToFilter('name', array('like' => '%'. $productName .'%'))
    ->load();
  echo json_encode($product_collection->toArray());
}

if(@$_GET['seller']){
  $supplierModel = Mage::getModel('inventorypurchasing/supplier')
    //->addAttributeToFilter('supplier_name', array('like' => '%'. @$_GET['supplier'] .'%'))
    ->getCollection();

  $data = $supplierModel->toArray();
  echo json_encode($data['items']);
}


