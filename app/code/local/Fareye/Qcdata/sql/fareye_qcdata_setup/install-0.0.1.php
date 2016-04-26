<?php
$this->startSetup();
$table = new Varien_Db_Ddl_Table();

$table->setName($this->getTable('qcdata/data'));

$table->addColumn(
  'id',
  Varien_Db_Ddl_Table::TYPE_INTEGER,
  10,
  array(
    'auto_increment' => true,
    'unsigned' => true,
    'nullable'=> false,
    'primary' => true
  )
);

$table->addColumn(
  'created_at',
  Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
  null,
  array (
    'nullable' => false,
    'default'  => Varien_Db_Ddl_Table::TIMESTAMP_INIT,
  ),
  'datetime when we receive data'
);

$table->addColumn(
  'updated_at',
  Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
  null,
  array(
    'nullable' => false,
  ),
  'datetime when we processed data'
);

$table->addColumn(
  'data',
  Varien_Db_Ddl_Table::TYPE_TEXT,
  null,
  array(
    'nullable' => false,
  ),
  'data in json string format'
);

$table->addColumn(
  'status',
  Varien_Db_Ddl_Table::TYPE_BOOLEAN,
  null,
  array(
    'nullable' => false,
    'default'  => false,
  ),
  'check if data is producessed'
);


$table->setOption('type', 'InnoDB');
$table->setOption('charset', 'utf8');
$this->getConnection()->createTable($table);



$posttable = new Varien_Db_Ddl_Table();
$posttable->setName($this->getTable('qcdata/postdata'));

$posttable->addColumn(
  'id',
  Varien_Db_Ddl_Table::TYPE_INTEGER,
  10,
  array(
    'auto_increment' => true,
    'unsigned' => true,
    'nullable'=> false,
    'primary' => true
  )
);

$posttable->addColumn(
  'purchaseorder_id',
  Varien_Db_Ddl_Table::TYPE_INTEGER,
  10,
  array(
    'nullable' => false,
    'unsigned' => true
  )
);
$posttable->addColumn(
  'created_at',
  Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
  null,
  array (
    'nullable' => false,
    'default'  => Varien_Db_Ddl_Table::TIMESTAMP_INIT,
  ),
  'datetime when we receive data'
);

$posttable->addColumn(
  'fareye_referenceno',
  Varien_Db_Ddl_Table::TYPE_TEXT,
  null,
  array(
    'nullable' => false,
  )
);


$posttable->addColumn(
  'sku',
  Varien_Db_Ddl_Table::TYPE_TEXT,
  null,
  array(
    'nullable' => false,
  )
);
$posttable->addColumn(
  'qc_status',
  Varien_Db_Ddl_Table::TYPE_TEXT,
  null,
  array(
    'nullable' => false,
  ),
  'status of qc3 phase'
);


$posttable->addColumn(
  'comment',
  Varien_Db_Ddl_Table::TYPE_TEXT,
  null,
  array(
    'nullable' => false,
  ),
  'comment contains information of order_id'
);


$posttable->setOption('type', 'InnoDB');
$posttable->setOption('charset', 'utf8');
$this->getConnection()->createTable($posttable);
$this->endSetup();



