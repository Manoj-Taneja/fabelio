<?php
$installer = $this;
$installer->startSetup();

$db = Mage::getSingleton('core/resource')->getConnection('core_write');
$table_prefix = Mage::getConfig()->getTablePrefix();

$entity = $this->getEntityTypeId('customer');

$this->addAttribute($entity, 'percentage_fee', array(
    'type' => 'text',
    'label' => __('Sales Percentage Fee'),
    'input' => 'text',
    'visible' => TRUE,
    'required' => FALSE,
    'default_value' => 1,
    'adminhtml_only' => '1'
));

Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'percentage_fee')
    ->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit','checkout_register'))
    ->save();

$installer->endSetup();
