<?php
$installer = $this;
$installer->startSetup();

$entity = $this->getEntityTypeId('customer');
$this->addAttribute($entity, 'supplier_name_new', array(
    'type' => 'text',
    'label' => 'Supplier Name After Change',
    'input' => 'text',
    'visible' => TRUE,
    'required' => FALSE,
    'default_value' => '',
));

$this->addAttribute($entity, 'supplier_description_new', array(
    'type' => 'text',
    'label' => 'Supplier Description After Change',
    'input' => 'textarea',
    'visible' => TRUE,
    'required' => FALSE,
    'default_value' => '',
));

$installer->endSetup();
