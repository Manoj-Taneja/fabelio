<?php
$installer = $this;
$installer->startSetup();
$entity = $this->getEntityTypeId('customer');
$installer->updateAttribute($entity,'supplier_profile_approved','source_model','eav/entity_attribute_source_boolean');
$installer->updateAttribute($entity,'supplier_profile_visible','source_model', 'eav/entity_attribute_source_boolean');

$installer->endSetup();