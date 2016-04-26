<?php
$installer = $this;
$installer->startSetup();
$entity = $this->getEntityTypeId('customer');

$table = $installer->getConnection()
    ->newTable($installer->getTable('marketplace/supplier_to_category'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('supplier_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'SUPPLIER ID')
    ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'category_id');
$installer->getConnection()->createTable($table);
$installer->endSetup();