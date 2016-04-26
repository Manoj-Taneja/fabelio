<?php
$installer = $this;
$installer->startSetup();

$db = Mage::getSingleton('core/resource')->getConnection('core_write');
$table_prefix = Mage::getConfig()->getTablePrefix();

$customerGroup = Mage::getModel('customer/group');
$customerGroup->load('Supplier', 'customer_group_code');

if(!$customerGroup->getId()) {
    $customerGroup->setCode('Supplier');
    $customerGroup->setTaxClassId(3);
    $customerGroup->save();
}

$coreConfig = new Mage_Core_Model_Config();
$coreConfig->saveConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/supplier_group_id', $customerGroup->getId());
