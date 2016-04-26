<?php
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('marketplace/methods'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('supplier_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'SUPPLIER ID')
    ->addColumn('flat_rate_available', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
        'nullable'  => false,
    ))
    ->addColumn('flat_rate_fee', Varien_Db_Ddl_Table::TYPE_DECIMAL, array(5,2), array(
        'nullable'  => false,
    ))
    ->addColumn('table_rate_available', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
        'nullable'  => false,
    ))
    ->addColumn('table_rate_fee', Varien_Db_Ddl_Table::TYPE_DECIMAL, array(5,2), array(
        'nullable'  => false,
    ))
    ->addColumn('table_rate_condition', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
        'nullable'  => false,
    ))
    ->addColumn('free_shipping', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
        'nullable'  => false,
    ));
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($installer->getTable('marketplace/rates'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('supplier_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'SUPPLIER ID')
    ->addColumn('rate_data', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ));
$installer->getConnection()->createTable($table);

$installer->endSetup();
