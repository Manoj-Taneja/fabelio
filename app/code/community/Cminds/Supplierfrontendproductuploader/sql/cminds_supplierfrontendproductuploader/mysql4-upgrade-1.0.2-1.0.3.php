<?php
$installer = $this;
$installer->startSetup();

$db = Mage::getSingleton('core/resource')->getConnection('core_write');
$table_prefix = Mage::getConfig()->getTablePrefix();

$customerGroup = Mage::getModel('customer/group');
$customerGroup->load('Supplier Pro', 'customer_group_code');

if(!$customerGroup->getId()) {
    $customerGroup->setCode('Supplier Pro');
    $customerGroup->setTaxClassId(3);
    $customerGroup->save();
}

$coreConfig = new Mage_Core_Model_Config();
$coreConfig->saveConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/editor_group_id', $customerGroup->getId());

$setName = trim('supplierfrontendproductuploader_product_attributes');
$entityAttributeSetModel = Mage::getModel('eav/entity_attribute_set');
$entityTypeID = Mage::getModel('catalog/product')->getResource()->getTypeId();

$attributeSetId = $installer->getAttributeSet($entityTypeID, $setName, 'attribute_set_id');

if(!$attributeSetId){
    $skeletonId = $installer->getAttributeSet($entityTypeID, 'Default', 'attribute_set_id');
    $entityAttributeSetModel->setEntityTypeId($entityTypeID);
    $entityAttributeSetModel->setAttributeSetName($setName);
    $entityAttributeSetModel->save();
    $entityAttributeSetModel->initFromSkeleton($skeletonId);
    $entityAttributeSetModel->save();
    $newSetId = $entityAttributeSetModel->getId();
} else {
    $newSetId = $attributeSetId;
}

$installer->deleteTableRow(
    'eav/entity_attribute',
    'attribute_id',
    $this->getAttributeId('catalog_product', 'product_construction_source'),
    'attribute_set_id',
    $this->getAttributeSetId('catalog_product', 'Default')
);

$idAttribute = $installer->getAttribute(Mage_Catalog_Model_Product::ENTITY, 'product_construction_source', 'attribute_id');
$newGroupId = $installer->getAttributeGroupId($entityTypeID, $newSetId, 'General');

$installer->addAttributeToSet(Mage_Catalog_Model_Product::ENTITY,$newSetId, $newGroupId, $idAttribute);


$coreConfig = new Mage_Core_Model_Config();
$coreConfig->saveConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/attribute_set', $newSetId);

$installer->endSetup();
