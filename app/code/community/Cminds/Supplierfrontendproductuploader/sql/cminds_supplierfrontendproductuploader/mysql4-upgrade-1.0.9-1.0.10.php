<?php
$installer = $this;
$installer->startSetup();

$db = Mage::getSingleton('core/resource')->getConnection('core_write');
$table_prefix = Mage::getConfig()->getTablePrefix();

$entity = $this->getEntityTypeId('catalog_product');

$this->addAttribute($entity, 'supplier_actived_product', array(
    'type' => 'int',
    'backend' => '',
    'frontend' => '',
    'label' => '',
    'frontend_input' => 'text',
    'visible' => false,
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
