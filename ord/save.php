<?php
require_once getcwd() . '/../app/Mage.php';
Mage::app();

//Mage::getSingleton('core/session', array('name'=>'adminhtml'));
//$session = Mage::getSingleton('admin/session');
//if(!$session->isLoggedIn()){
//  echo json_encode(Array("error" => "not loggedin"));
//  die;
//}

if(empty($_POST)){
  echo json_encode(Array("error" => "not data posted"));
  die;
}

$ordId = trim($_POST['increment_id']);
if(!$ordId){
  echo json_encode(Array("error" => "No increment_id"));
  die;
}else{
  $json = Array("increment_id" => $ordId);
}

$newOrdData = Array(
  "city" => trim($_POST['city']),
  "street" => trim($_POST['street']),
  "region" => trim($_POST['region']),
);


if(!$newOrdData['city']){
  $json['error'] = "City empty";
  echo json_encode($json);
  die;
}

if(!$newOrdData['region']){
  $json['error'] = "Region empty";
  echo json_encode($json);
  die;
}

try{

  $orderModel = Mage::getModel('sales/order');
  $ord = $orderModel->loadByIncrementId($ordId);

  if(!$ord || !$ord->getId()){
    $json['error'] = "Order not found";
    echo json_encode($json);
    die;
  }

  $shippingAddress = $ord->getShippingAddress();
  $billingAddress = $ord->getBillingAddress();

  if(!$shippingAddress){
    $json['error'] = "invalid Shipping address";
    echo json_encode($json);
    die;
  }

  if(!$billingAddress){
    $json['error'] = "invalid Billing address";
    echo json_encode($json);
    die;
  }

  $ordShipping = Mage::getModel('sales/order_address')->load($shippingAddress->getId());
  $ordBilling = Mage::getModel('sales/order_address')->load($billingAddress->getId());

  $oldOrdData = Array(
    "region" => $ordShipping->getData('region'),
    "city"   => $ordShipping->getData('city'),
    "street" => $ordShipping->getData('street'),
  );

  $ordShipping->setData('region', $newOrdData['region']);
  $ordShipping->setData('city',   $newOrdData['city']);
  $ordShipping->setData('street', $newOrdData['street']);
  $ordShipping->save();

  echo json_encode(array_merge($json, Array(
    "saved"      => true,
    "newOrdData" => $newOrdData,
    "oldOrdData" => $oldOrdData,
  )));

}catch(Exception $e) {
  $json['error']      = $e->getMessage();
  $json['newOrdData'] = $newOrdData;
  echo json_encode($json);
  die;
}


