<?php
$installer = $this;
$installer->startSetup();

$db = Mage::getSingleton('core/resource')->getConnection('core_write');
$table_prefix = Mage::getConfig()->getTablePrefix();

$entity = $this->getEntityTypeId('catalog_category');

$this->addAttribute($entity, 'available_for_supplier', array(
    'group' => 'General',
    'type' => 'int',
    'backend' => '',
    'frontend' => '',
    'label' => 'Available for Supplier?',
    'input' => 'select',
    'source' => 'eav/entity_attribute_source_boolean',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => true,
    'user_defined' => true,
    'default' => 0,
    'searchable' => false,
    'filterable' => false,
    'comparable' => false,
    'visible_on_front' => true,
    'visible_in_advanced_search' => false,
));

$installer->endSetup();
