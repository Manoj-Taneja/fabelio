<?php
$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->addColumn($installer->getTable('eav/attribute_set'),
        'available_for_supplier',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
            'length' => 1,
            'nullable' => false,
            'default' => 0,
            'comment' => 'Set available for supplier'
        )
    );

$installer->endSetup();