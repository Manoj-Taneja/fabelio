<?php
error_reporting(E_ALL);
require_once(getcwd() . '/../app/Mage.php');
Mage::app();
$collection = Mage::getModel('inventorypurchasing/supplier')->getCollection();
foreach($collection as $item){
  echo  $item->getData('city');//."--->".$item->getData('telephone');
  echo "<br>";
}
