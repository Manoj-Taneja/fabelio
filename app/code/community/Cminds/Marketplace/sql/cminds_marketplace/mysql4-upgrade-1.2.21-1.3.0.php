<?php
$installer = $this;
$installer->startSetup();
$entity = $this->getEntityTypeId('customer');

$table = $installer->getConnection()
    ->newTable($installer->getTable('marketplace/payments'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('supplier_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'SUPPLIER ID')
    ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'order ID')
    ->addColumn('amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, array(5,2), array(
        'nullable'  => false,
    ))
    ->addColumn('payment_date', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
    ));
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($installer->getTable('marketplace/fields'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 64, array(
        'nullable'  => false,
    ))
    ->addColumn('label', Varien_Db_Ddl_Table::TYPE_VARCHAR, 64, array(
        'nullable'  => true,
    ))
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_VARCHAR, 256, array(
        'nullable'  => true,
    ))
    ->addColumn('type', Varien_Db_Ddl_Table::TYPE_VARCHAR, 64, array(
        'nullable'  => false,
    ))
    ->addColumn('is_required', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
        'nullable'  => true,
    ))
    ->addColumn('is_system', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
        'nullable'  => true,
    ))
    ->addColumn('must_be_approved', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
        'nullable'  => true,
    ))
    ->addColumn('is_wysiwyg', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
        'nullable'  => true,
    ))
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, NULL, array(
        'nullable'  => false,
    ));
$installer->getConnection()->createTable($table);


$this->addAttribute($entity, 'custom_fields_values', array(
    'type' => 'text',
    'input' => 'textarea',
    'visible' => false,
    'required' => false,
    'default_value' => '',
));

$this->addAttribute($entity, 'new_custom_fields_values', array(
    'type' => 'text',
    'input' => 'textarea',
    'visible' => false,
    'required' => false,
    'default_value' => '',
));


$table = $installer->getConnection()
    ->newTable($installer->getTable('marketplace/rating'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'customer ID')
    ->addColumn('supplier_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'SUPPLIER ID')
    ->addColumn('rate', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
        'nullable'  => false,
    ))
    ->addColumn('created_on', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
    ));
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($installer->getTable('marketplace/torate'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('supplier_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'SUPPLIER ID')
    ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'ORDER ID')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'PRODUCT ID')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ), 'customer_id');
$installer->getConnection()->createTable($table);
$installer->endSetup();