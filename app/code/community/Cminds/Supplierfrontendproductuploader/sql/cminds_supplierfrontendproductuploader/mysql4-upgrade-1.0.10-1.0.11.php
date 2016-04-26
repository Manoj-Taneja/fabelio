<?php
$installer = $this;
$installer->startSetup();

$db = Mage::getSingleton('core/resource')->getConnection('core_write');
$table_prefix = Mage::getConfig()->getTablePrefix();

$entity = $this->getEntityTypeId('catalog_product');

$this->addAttribute($entity, 'frontendproduct_product_status', array(
    'type' => 'int',
    'backend' => '',
    'frontend' => '',
    'label' => 'User Actived',
    'input' => 'select',
    'source' => 'supplierfrontendproductuploader/source_approved',
    'visible' => true,
    'required' => false,
    'user_defined' => false,
    'default' => 1,
    'searchable' => false,
    'filterable' => false,
    'comparable' => false,
    'visible_on_front' => false,
    'visible_in_advanced_search' => false,
));

$installer->endSetup();
