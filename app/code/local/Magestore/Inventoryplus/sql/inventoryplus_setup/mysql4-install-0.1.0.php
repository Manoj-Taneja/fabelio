<?php

/**
 * Magestore
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */
/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * create inventory table
 */

 
if (Mage::helper('core')->isModuleEnabled('Magestore_Inventory')){
    $sqlAddColumn = "
drop procedure if exists AddColumnUnlessExists;
create procedure AddColumnUnlessExists(
	IN dbName tinytext,
	IN tableName tinytext,
	IN fieldName tinytext,
	IN fieldDef text)
begin
	IF NOT EXISTS (
		SELECT * FROM information_schema.COLUMNS
		WHERE column_name=fieldName
		and table_name=tableName
		and table_schema=dbName
		)
	THEN
		set @ddl=CONCAT('ALTER TABLE ',tableName,
			' ADD COLUMN ',fieldName,' ',fieldDef);
		prepare stmt from @ddl;
		execute stmt;
	END IF;
end
";

$sqlChangeColumnName = "
drop procedure if exists ChangeColumnNameUnlessExists;
create procedure ChangeColumnNameUnlessExists(
	IN dbName tinytext,
	IN tableName tinytext,
	IN oldName tinytext,
	IN newName tinytext,
	IN fieldDef text,
        IN updateData tinytext,
        IN fieldValue tinytext,
        IN fieldCondition text
        )
begin
	IF EXISTS (
		SELECT * FROM information_schema.COLUMNS
		WHERE column_name=oldName
		and table_name=tableName
		and table_schema=dbName
		)
	THEN
		set @ddl=CONCAT('ALTER TABLE ',tableName,
			' CHANGE ',oldName,' ',newName,' ',fieldDef);
		prepare stmt from @ddl;
		execute stmt;
        ELSE
            IF NOT EXISTS(
		SELECT * FROM information_schema.COLUMNS
		WHERE column_name=newName
		and table_name=tableName
		and table_schema=dbName
		)
            THEN
                set @ddl=CONCAT('ALTER TABLE ',tableName,
			' ADD ',newName,' ',fieldDef);
		prepare stmt from @ddl;
		execute stmt;
                    IF updateData = 'UPDATE' THEN 
                        set @str=CONCAT('UPDATE ',tableName,
			' SET ',newName,' = ',fieldValue,' WHERE ',fieldCondition);
                        prepare strtmt from @str;
                        execute strtmt;       
                    END IF;
            END IF;
	END IF;
end
";

$sqlUpdateValue = "
drop procedure if exists UpdateValueByFieldColumnUnlessExists;
create procedure UpdateValueByFieldColumnUnlessExists(
	IN dbName tinytext,
	IN tableName tinytext,
	IN fieldName tinytext,	
	IN fieldValue tinytext,
        IN fieldCondition text)
begin
	IF EXISTS (
		SELECT * FROM information_schema.COLUMNS
		WHERE column_name=fieldName
		and table_name=tableName
		and table_schema=dbName
		)
	THEN        
		set @ddl=CONCAT('UPDATE ',tableName,
			' SET ',fieldName,' = ',fieldValue,' WHERE ',fieldCondition);
		prepare stmt from @ddl;
		execute stmt;        
	END IF;
end
"; 

$sqlUpdateDefaultValue = "
drop procedure if exists UpdateValueDefaultColumnUnlessExists;
create procedure UpdateValueDefaultColumnUnlessExists(
	IN dbName tinytext,
	IN tableName tinytext,
	IN fieldName tinytext,	
	IN valueField tinytext)
begin
	IF EXISTS (
		SELECT * FROM information_schema.COLUMNS
		WHERE column_name=fieldName
		and table_name=tableName
		and table_schema=dbName
		)
	THEN        
		set @ddl=CONCAT('UPDATE ',tableName,
			' SET ',fieldName,' = ',valueField);
		prepare stmt from @ddl;
		execute stmt;        
	END IF;
end
"; 

$write = Mage::getSingleton('core/resource')->getConnection('core_write');
$write->exec($sqlAddColumn);
$write->exec($sqlChangeColumnName);
$write->exec($sqlUpdateValue);
$write->exec($sqlUpdateDefaultValue);
     $installer->run("
         CREATE TABLE IF NOT EXISTS {$this->getTable('erp_inventory_warehouse')} (
                `warehouse_id` int(11) unsigned NOT NULL auto_increment,
                `warehouse_name` varchar(255) NOT NULL,
                `manager_name` varchar(255) NOT NULL,
                `manager_email` varchar(255) default NULL,
                `telephone` varchar(50) default NULL,
                `street` text,
                `city` varchar(255) default NULL,
                `country_id` char(3) default '',
                `state` varchar(255) default NULL,
                `state_id` int(11) NULL,
                `postcode` varchar(255) default NULL,	
                `created_by` varchar(255) default NULL,
                `created_at` date default NULL,
                `updated_by` varchar(255) default NULL,
                `updated_at` date default NULL,
                `status` tinyint(1) NOT NULL,	
                PRIMARY KEY  (`warehouse_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


        CREATE TABLE IF NOT EXISTS {$this->getTable('erp_inventory_warehouse_product')} (
                `warehouse_product_id` int(11) unsigned NOT NULL auto_increment,
                `warehouse_id` int(11) unsigned NOT NULL,
                `product_id` int(11) unsigned NOT NULL,
                `total_qty` decimal(10,0) default '0',
                `available_qty` decimal(10,0) default '0',
                PRIMARY KEY  (`warehouse_product_id`),
                UNIQUE KEY `warehouse_id` (`warehouse_id`,`product_id`),
                INDEX (`warehouse_id`),
                INDEX (`product_id`),
                FOREIGN KEY (`warehouse_id`) REFERENCES {$this->getTable('erp_inventory_warehouse')}(`warehouse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (`product_id`) REFERENCES {$this->getTable('catalog/product')}(`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        
        CREATE TABLE IF NOT EXISTS {$this->getTable('erp_inventory_warehouse_order')} (
                `warehouse_order_id` int(11) unsigned NOT NULL auto_increment,
                `warehouse_id` int(11) unsigned NOT NULL,
                `order_id` int(11) unsigned NOT NULL,
                `item_id` int(11) unsigned NOT NULL,
                `product_id` int(11) unsigned NOT NULL,
                `qty` decimal(10,0) default '0',
                PRIMARY KEY  (`warehouse_order_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        
        CREATE TABLE IF NOT EXISTS {$this->getTable('erp_inventory_adjuststock')} (
                `adjuststock_id` int(11) unsigned NOT NULL auto_increment,
                `warehouse_id` int(11) unsigned NOT NULL,
                `warehouse_name` varchar(255) NOT NULL,
                `reason` text NOT NULL,
                `created_by` varchar(255) default NULL,
                `created_at` date default NULL,
                `confirmed_by` varchar(255) default NULL,
                `confirmed_at` date default NULL,
                `status` tinyint(1) NOT NULL,	
                PRIMARY KEY(`adjuststock_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        
        CREATE TABLE IF NOT EXISTS {$this->getTable('erp_inventory_adjuststock_product')} (
                `adjuststock_product_id` int(11) unsigned NOT NULL auto_increment,
                `adjuststock_id` int(11) unsigned  NOT NULL,
                `product_id` int(11) unsigned  NOT NULL,
                `old_qty` decimal(10,0) default '0',
                `suggest_qty` decimal(10,0) default '0',
                `adjust_qty` decimal(10,0) default '0',
                PRIMARY KEY  (`adjuststock_product_id`),
                INDEX(`adjuststock_id`),
                FOREIGN KEY (`adjuststock_id`) REFERENCES {$this->getTable('erp_inventory_adjuststock')}(`adjuststock_id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   
        call AddColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse')}', 'created_at', 'date default NULL');
        call AddColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse')}', 'updated_by', 'varchar(255) default NULL');
        call AddColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse')}', 'updated_at', 'date default NULL');
    

        call ChangeColumnNameUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse')}', 'name', 'warehouse_name','varchar(255) NOT NULL', null, null, null);
        call ChangeColumnNameUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse_product')}', 'qty', 'total_qty','decimal(10,0) default 0', null, null, null);
        call ChangeColumnNameUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse_product')}', 'qty_available', 'available_qty','decimal(10,0) default 0', 'UPDATE' , 'total_qty' ,'warehouse_product_id = warehouse_product_id');
       call AddColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse_product')}', 'created_at', 'datetime default NULL');
    call AddColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse_product')}', 'updated_at', 'datetime default NULL');
        
    call UpdateValueDefaultColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse_product')}', 'created_at', 'now()');    
    call UpdateValueDefaultColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse_product')}', 'updated_at', 'now()');    
             
    call UpdateValueDefaultColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse')}', 'created_at', 'now()');    
    
    CREATE TABLE IF NOT EXISTS  {$this->getTable('erp_inventory_warehouse_permission')}(
                `warehouse_permission_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `warehouse_id` int(11) unsigned NOT NULL,
                `admin_id` int(11) unsigned NOT NULL,
                `can_edit_warehouse` tinyint(1) NOT NULL,
                `can_adjust` tinyint(1) NOT NULL,
                INDEX (`warehouse_id`),
                INDEX (`admin_id`),
                PRIMARY KEY(`warehouse_permission_id`),
                FOREIGN KEY (`warehouse_id`) REFERENCES {$this->getTable('erp_inventory_warehouse')}(`warehouse_id`) ON DELETE CASCADE ON UPDATE CASCADE
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;


        call AddColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse_order')}', 'item_id', 'int(11) unsigned NOT NULL');


    CREATE TABLE IF NOT EXISTS {$this->getTable('erp_inventory_warehouse_shipment')} (
                `warehouse_shipment_id` int(11) unsigned NOT NULL auto_increment,
                `warehouse_id` int(11) unsigned  NOT NULL,
                `warehouse_name` varchar(255) NOT NULL,
                `shipment_id` int(11) unsigned  NOT NULL,
                `order_id` int(11) unsigned  NOT NULL,
                `item_id` int(11) unsigned  NOT NULL,
                `product_id` int(11) unsigned  NOT NULL,
                `qty_shipped` int(11) NOT NULL default '0',
                `qty_refunded` int(11) NOT NULL default '0',
                `subtotal_shipped` decimal(12,4) unsigned NOT NULL default 0,
                PRIMARY KEY  (warehouse_shipment_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        
    call AddColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_warehouse_shipment')}', 'subtotal_shipped', 'decimal(12,4) unsigned NOT NULL default 0');


    CREATE TABLE IF NOT EXISTS {$this->getTable('erp_inventory_warehouse_history')} (
            `warehouse_history_id` int(11) unsigned NOT NULL auto_increment,
            `warehouse_id` int(11) unsigned NOT NULL,
            `time_stamp` datetime,
            `create_by` varchar(255) NOT NULL,
            INDEX (`warehouse_id`),
            FOREIGN KEY (`warehouse_id`) REFERENCES {$this->getTable('erp_inventory_warehouse')}(`warehouse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
            PRIMARY KEY  (`warehouse_history_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


    CREATE TABLE IF NOT EXISTS {$this->getTable('erp_inventory_warehouse_history_content')} (
            `warehouse_history_content_id` int(11) unsigned NOT NULL auto_increment,
            `warehouse_history_id` int(11) unsigned NOT NULL,
            `field_name` varchar(255) NOT NULL,
            `old_value` text,
            `new_value` text,
            INDEX (`warehouse_history_id`),
            FOREIGN KEY (`warehouse_history_id`) REFERENCES {$this->getTable('erp_inventory_warehouse_history')}(`warehouse_history_id`) ON DELETE CASCADE ON UPDATE CASCADE,
            PRIMARY KEY  (`warehouse_history_content_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        call AddColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_adjuststock')}', 'confirmed_by', 'varchar(255) default NULL');
        call AddColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_adjuststock')}', 'confirmed_at', 'date default NULL');
        call AddColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_adjuststock')}', 'status', 'tinyint(1) NOT NULL default 0');
          
        call UpdateValueDefaultColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_adjuststock')}', 'status', 1);
       
        call ChangeColumnNameUnlessExists(Database(), '{$this->getTable('erp_inventory_adjuststock')}', 'create_by', 'created_by','varchar(255) NOT NULL', null, null, null);
            
        call UpdateValueByFieldColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_adjuststock')}', 'confirmed_by', 'created_by','adjuststock_id = adjuststock_id');
        call UpdateValueByFieldColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_adjuststock')}', 'confirmed_at', 'created_at','adjuststock_id = adjuststock_id');
           
    
        call AddColumnUnlessExists(Database(), '{$this->getTable('erp_inventory_adjuststock_product')}', 'suggest_qty', 'decimal(10,0) default 0');
           
        call ChangeColumnNameUnlessExists(Database(), '{$this->getTable('erp_inventory_adjuststock_product')}', 'adjuststockproduct_id', 'adjuststock_product_id','int(11) unsigned NOT NULL auto_increment', null, null, null);
            
  
        CREATE TABLE IF NOT EXISTS {$this->getTable('erp_inventory_products')} (
                `inventory_product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `product_id` int(11) unsigned NOT NULL,
                `cost_price` decimal(12,4) unsigned NOT NULL default '0.0000',
                `last_update` datetime default NULL,
                INDEX (`product_id`),
                UNIQUE (`product_id`),
                PRIMARY KEY(`inventory_product_id`),
                FOREIGN KEY (`product_id`) REFERENCES {$this->getTable('catalog/product')}(`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;

        CREATE TABLE IF NOT EXISTS  {$this->getTable('erp_inventory_warehouse_history')} (
            `warehouse_history_id` int(11) unsigned NOT NULL auto_increment,
            `warehouse_id` int(11) unsigned NOT NULL,
            `time_stamp` datetime,
            `create_by` varchar(255) NOT NULL,
            INDEX (`warehouse_id`),
            FOREIGN KEY (`warehouse_id`) REFERENCES {$this->getTable('erp_inventory_warehouse')}(`warehouse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
            PRIMARY KEY  (`warehouse_history_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;



    CREATE TABLE IF NOT EXISTS {$this->getTable('erp_inventory_warehouse_history_content')} (
            `warehouse_history_content_id` int(11) unsigned NOT NULL auto_increment,
            `warehouse_history_id` int(11) unsigned NOT NULL,
            `field_name` varchar(255) NOT NULL,
            `old_value` text,
            `new_value` text,
            INDEX (`warehouse_history_id`),
            FOREIGN KEY (`warehouse_history_id`) REFERENCES {$this->getTable('erp_inventory_warehouse_history')}(`warehouse_history_id`) ON DELETE CASCADE ON UPDATE CASCADE,
            PRIMARY KEY  (`warehouse_history_content_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        
        CREATE TABLE IF NOT EXISTS  {$this->getTable('erp_inventory_checkupdate')} (
            `checkupdate_id` int(11) unsigned NOT NULL auto_increment,
            `version` varchar(255),
            `inserted_data` int(11),   
            PRIMARY KEY  (`checkupdate_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        INSERT INTO {$this->getTable('erp_inventory_checkupdate')} (`version`,`inserted_data`) VALUES ('1.0',0);

    ");
            
            
}else{
    
    $installer->run("
   
DROP TABLE IF EXISTS {$this->getTable('erp_inventory_warehouse')};
CREATE TABLE {$this->getTable('erp_inventory_warehouse')} (
	`warehouse_id` int(11) unsigned NOT NULL auto_increment,
	`warehouse_name` varchar(255) NOT NULL,
	`manager_name` varchar(255) NOT NULL,
	`manager_email` varchar(255) default NULL,
	`telephone` varchar(50) default NULL,
	`street` text,
	`city` varchar(255) default NULL,
	`country_id` char(3) default '',
	`state` varchar(255) default NULL,
	`state_id` int(11) NULL,
	`postcode` varchar(255) default NULL,	
	`created_by` varchar(255) default NULL,
	`created_at` date default NULL,
	`updated_by` varchar(255) default NULL,
	`updated_at` date default NULL,
	`status` tinyint(1) NOT NULL,	
	PRIMARY KEY  (`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('erp_inventory_warehouse_product')};
CREATE TABLE {$this->getTable('erp_inventory_warehouse_product')} (
	`warehouse_product_id` int(11) unsigned NOT NULL auto_increment,
	`warehouse_id` int(11) unsigned NOT NULL,
	`product_id` int(11) unsigned NOT NULL,
	`total_qty` decimal(10,0) default '0',
	`available_qty` decimal(10,0) default '0',
	`created_at` datetime default NULL,
	`updated_at` datetime default NULL,
	PRIMARY KEY  (`warehouse_product_id`),
	UNIQUE KEY `warehouse_id` (`warehouse_id`,`product_id`),
	INDEX (`warehouse_id`),
	INDEX (`product_id`),
	FOREIGN KEY (`warehouse_id`) REFERENCES {$this->getTable('erp_inventory_warehouse')}(`warehouse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (`product_id`) REFERENCES {$this->getTable('catalog/product')}(`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   

DROP TABLE IF EXISTS {$this->getTable('erp_inventory_warehouse_permission')};		
CREATE TABLE {$this->getTable('erp_inventory_warehouse_permission')}(
	`warehouse_permission_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`warehouse_id` int(11) unsigned NOT NULL,
	`admin_id` int(11) unsigned NOT NULL,
	`can_edit_warehouse` tinyint(1) NOT NULL,
	`can_adjust` tinyint(1) NOT NULL,
	INDEX (`warehouse_id`),
	INDEX (`admin_id`),
	PRIMARY KEY(`warehouse_permission_id`),
	FOREIGN KEY (`warehouse_id`) REFERENCES {$this->getTable('erp_inventory_warehouse')}(`warehouse_id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('erp_inventory_warehouse_order')};
CREATE TABLE {$this->getTable('erp_inventory_warehouse_order')} (
	`warehouse_order_id` int(11) unsigned NOT NULL auto_increment,
	`warehouse_id` int(11) unsigned NOT NULL,
	`order_id` int(11) unsigned NOT NULL,
	`item_id` int(11) unsigned NOT NULL,
	`product_id` int(11) unsigned NOT NULL,
	`qty` decimal(10,0) default '0',
	PRIMARY KEY  (`warehouse_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('erp_inventory_warehouse_shipment')};
CREATE TABLE {$this->getTable('erp_inventory_warehouse_shipment')} (
	`warehouse_shipment_id` int(11) unsigned NOT NULL auto_increment,
	`warehouse_id` int(11) unsigned  NOT NULL,
	`warehouse_name` varchar(255) NOT NULL,
	`shipment_id` int(11) unsigned  NOT NULL,
	`order_id` int(11) unsigned  NOT NULL,
	`item_id` int(11) unsigned  NOT NULL,
	`product_id` int(11) unsigned  NOT NULL,
	`qty_shipped` int(11) NOT NULL default '0',
	`qty_refunded` int(11) NOT NULL default '0',
	`subtotal_shipped` decimal(12,4) unsigned NOT NULL default 0,
	PRIMARY KEY  (warehouse_shipment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('erp_inventory_warehouse_history')};
CREATE TABLE {$this->getTable('erp_inventory_warehouse_history')} (
    `warehouse_history_id` int(11) unsigned NOT NULL auto_increment,
    `warehouse_id` int(11) unsigned NOT NULL,
    `time_stamp` datetime,
    `create_by` varchar(255) NOT NULL,
    INDEX (`warehouse_id`),
    FOREIGN KEY (`warehouse_id`) REFERENCES {$this->getTable('erp_inventory_warehouse')}(`warehouse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY  (`warehouse_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('erp_inventory_warehouse_history_content')};
CREATE TABLE {$this->getTable('erp_inventory_warehouse_history_content')} (
    `warehouse_history_content_id` int(11) unsigned NOT NULL auto_increment,
    `warehouse_history_id` int(11) unsigned NOT NULL,
    `field_name` varchar(255) NOT NULL,
    `old_value` text,
    `new_value` text,
    INDEX (`warehouse_history_id`),
    FOREIGN KEY (`warehouse_history_id`) REFERENCES {$this->getTable('erp_inventory_warehouse_history')}(`warehouse_history_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY  (`warehouse_history_content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('erp_inventory_adjuststock')};
CREATE TABLE {$this->getTable('erp_inventory_adjuststock')} (
	`adjuststock_id` int(11) unsigned NOT NULL auto_increment,
	`warehouse_id` int(11) unsigned NOT NULL,
	`warehouse_name` varchar(255) NOT NULL,
	`reason` text NOT NULL,
	`created_by` varchar(255) default NULL,
	`created_at` date default NULL,
	`confirmed_by` varchar(255) default NULL,
	`confirmed_at` date default NULL,
	`status` tinyint(1) NOT NULL,	
	PRIMARY KEY(`adjuststock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('erp_inventory_adjuststock_product')};
CREATE TABLE {$this->getTable('erp_inventory_adjuststock_product')} (
	`adjuststock_product_id` int(11) unsigned NOT NULL auto_increment,
	`adjuststock_id` int(11) unsigned  NOT NULL,
	`product_id` int(11) unsigned  NOT NULL,
	`old_qty` decimal(10,0) default '0',
	`suggest_qty` decimal(10,0) default '0',
	`adjust_qty` decimal(10,0) default '0',
	PRIMARY KEY  (`adjuststock_product_id`),
	INDEX(`adjuststock_id`),
	FOREIGN KEY (`adjuststock_id`) REFERENCES {$this->getTable('erp_inventory_adjuststock')}(`adjuststock_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS {$this->getTable('erp_inventory_products')};		
CREATE TABLE {$this->getTable('erp_inventory_products')} (
	`inventory_product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`product_id` int(11) unsigned NOT NULL,
	`cost_price` decimal(12,4) unsigned NOT NULL default '0.0000',
	`last_update` datetime default NULL,
	INDEX (`product_id`),
	UNIQUE (`product_id`),
	PRIMARY KEY(`inventory_product_id`),
	FOREIGN KEY (`product_id`) REFERENCES {$this->getTable('catalog/product')}(`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

        CREATE TABLE IF NOT EXISTS  {$this->getTable('erp_inventory_checkupdate')} (
            `checkupdate_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `version` varchar(255),
            `inserted_data` int(11),   
            PRIMARY KEY  (`checkupdate_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        INSERT INTO {$this->getTable('erp_inventory_checkupdate')} (`version`,`inserted_data`) VALUES ('1.0', 1);
    ");

    $resource = Mage::getSingleton('core/resource');
    $writeConnection = $resource->getConnection('core_write');
    $readConnection = $resource->getConnection('core_read');

    //create defautl warehouse
    $countryDefault = Mage::getStoreConfig('general/country/default');
    $warehouse = Mage::getModel('inventoryplus/warehouse');
    $warehouse->setWarehouseName('Default')
            ->setStatus(1)
            ->setCreatedBy(Mage::helper('inventoryplus')->__('Automatically created'))
            ->setCreatedAt(now())
            ->setCountryId($countryDefault)
            ->save();

    if ($warehouse->getId()) {
        $adminIds = Mage::getModel('admin/user')->getCollection()->getAllIds();
        foreach ($adminIds as $adminId) {
            $permission = Mage::getModel('inventoryplus/warehouse_permission');
            $permission->setData('warehouse_id', $warehouse->getId())
                    ->setData('admin_id', $adminId)
                    ->setData('can_edit_warehouse', 1)
                    ->setData('can_adjust', 1);
            try {
                $permission->save();
            } catch (Exception $e) {

            }
        }

        
    }

	/*
    //Check exists column shipping_progress
    $result = $readConnection->fetchAll("SHOW COLUMNS FROM " . $resource->getTableName('sales/order') . " LIKE 'shipping_progress'");
    if (count($result) == 0) {
        $writeConnection->query("ALTER TABLE " . $resource->getTableName('sales/order') . " ADD COLUMN `shipping_progress` TINYINT(2) NULL DEFAULT '0';");
    }

    $orders = $readConnection->fetchAll("SELECT `total_qty_ordered`,`entity_id`,`status` FROM `" . $this->getTable('sales/order') . "`");
	$countUpdate = 0;
	$update_sql = '';
    foreach ($orders as $order) {
		$countUpdate++;
        $orderId = $order['entity_id'];
        if ($order['status'] == 'complete') {
            $shipping_progress = 2;
        } else {
            $total_qty_order = $order['total_qty_ordered'];
            $total_qty_shipped = array();
            $order_items = $readConnection->fetchAll("SELECT `qty_shipped`,`qty_ordered`,`product_type`,`parent_item_id` FROM `" . $this->getTable('sales/order_item') . "` WHERE (order_id = $orderId)");
            foreach ($order_items as $c) {
                if ($c['parent_item_id'] == null) {
                    if ($c['product_type'] == 'virtual' || $c['product_type'] == 'downloadable') {
                        $total_qty_order += -(int) $c['qty_ordered'];
                    }
                    $total_qty_shipped[] = $c['qty_shipped'];
                }
            }
            $total_products_shipped = array_sum($total_qty_shipped);
            //end get total qty shipped
            //set status for shipment
            if ($total_qty_order == 0) {
                $shipping_progress = 2;
            } else {
                if ((int) $total_products_shipped == 0) {
                    $shipping_progress = 0;
                } elseif ((int) $total_products_shipped < (int) $total_qty_order) {
                    $shipping_progress = 1;
                } elseif ((int) $total_products_shipped == (int) $total_qty_order) {
                    $shipping_progress = 2;
                }
            }
        }
        $update_sql .= 'UPDATE ' . $this->getTable('sales/order') . ' 
                                SET `shipping_progress` = \'' . $shipping_progress . '\'
                                     WHERE `entity_id` =' . $orderId . ';';
		 if ($countUpdate == 900) {
			$writeConnection->query($update_sql);
			$update_sql = '';
			$countUpdate = 0;
		}
        // $writeConnection->query($update_sql);
    }
	if (!empty($update_sql)) {
		$writeConnection->query($update_sql);
	}
	*/
}
$installer->endSetup();

