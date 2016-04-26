<?php
$installer = $this;
$installer->startSetup();

$db = Mage::getSingleton('core/resource')->getConnection('core_write');
$table_prefix = Mage::getConfig()->getTablePrefix();

$entity = $this->getEntityTypeId('catalog_product');

$this->addAttribute($entity, 'admin_product_note', array(
    'type' => 'text',
    'backend' => '',
    'frontend' => '',
    'input' => 'textarea',
    'label' => 'Remark',
    'visible' => true,
    'required' => false,
    'user_defined' => false,
    'default' => 0,
    'searchable' => false,
    'filterable' => false,
    'comparable' => false,
    'visible_on_front' => false,
    'visible_in_advanced_search' => false,
));

$installer->endSetup();
