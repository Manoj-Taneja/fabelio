<?php

/* @var $this Mage_Catalog_Model_Resource_Setup */

$this->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'deliverytime', array(
    'group'                         => 'General',
    'input'                         => 'text',
    'type'                          => 'text',
    'label'                         => 'Delivery time',
    'visible'                       => true,
    'required'                      => false,
    'user_defined'                  => false,
    'searchable'                    => false,
    'filterable'                    => false,
    'comparable'                    => false,
    'visible_on_front'              => false,
    'visible_in_advanced_search'    => false,
    'is_html_allowed_on_front'      => false,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
));

$this->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'deliverytime_backorder', array(
    'group'                         => 'General',
    'input'                         => 'text',
    'type'                          => 'text',
    'label'                         => 'Delivery time when out of stock',
    'visible'                       => true,
    'required'                      => false,
    'user_defined'                  => false,
    'searchable'                    => false,
    'filterable'                    => false,
    'comparable'                    => false,
    'visible_on_front'              => false,
    'visible_in_advanced_search'    => false,
    'is_html_allowed_on_front'      => false,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE
));