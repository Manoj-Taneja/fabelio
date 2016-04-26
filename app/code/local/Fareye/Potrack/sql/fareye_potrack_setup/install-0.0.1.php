<?php
$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
  ->newTable($installer->getTable('fareye_potrack/posthook')) 
  ->addColumn('id',Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
      ), 'id') 
  ->addColumn('data', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
    'nullable'  => false,
  ), 'Title')
  ->addColumn('status', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
     'nullable'  => false,
     ), 'status');

$installer->getConnection()->createTable($table);

$installer->endSetup();

