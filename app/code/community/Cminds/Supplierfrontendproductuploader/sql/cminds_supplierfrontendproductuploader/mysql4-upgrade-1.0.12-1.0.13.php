<?php
$installer = $this;
$installer->startSetup();

$entity = $this->getEntityTypeId('customer');

$this->addAttribute($entity, 'notification_product_ordered', array(
    'type' => 'int',
    'label' => 'Send notification when product was ordered',
    'input' => 'text',
    'visible' => TRUE,
    'required' => FALSE,
    'default_value' => 'default',
    'adminhtml_only' => '1'
));

$this->addAttribute($entity, 'notification_product_approved', array(
    'type' => 'int',
    'label' => 'Send notification when product was ordered',
    'input' => 'text',
    'visible' => TRUE,
    'required' => FALSE,
    'default_value' => 'default',
    'adminhtml_only' => '1'
));

$installer->endSetup();