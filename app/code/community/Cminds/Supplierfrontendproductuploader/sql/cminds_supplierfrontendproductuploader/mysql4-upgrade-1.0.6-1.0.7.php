<?php
$installer = $this;
$installer->startSetup();
$collection = Mage::getModel('catalog/category')->getCollection();

foreach($collection as $category) {
    $category->setData('available_for_supplier', 1);
    $category->save();
}

$installer->endSetup();