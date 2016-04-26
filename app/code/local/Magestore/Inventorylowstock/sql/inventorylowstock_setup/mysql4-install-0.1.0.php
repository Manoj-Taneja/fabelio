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
 * @package     Magestore_Inventorylowstock
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * create inventorylowstock table
 */
$installer->run("        
            DROP TABLE IF EXISTS {$this->getTable('erp_inventory_notification_log')};
            CREATE TABLE {$this->getTable('erp_inventory_notification_log')} (
                `notification_log_id` int(11) unsigned NOT NULL auto_increment,
                `current_time` int(11) unsigned NOT NULL default 0,     
                `current_day` int(11) unsigned NOT NULL default 0, 
                `current_month` int(11) unsigned NOT NULL default 0,
                `last_update` datetime,
                `status` tinyint(1) NOT NULL default '1',
                PRIMARY KEY  (`notification_log_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
          
                
            DROP TABLE IF EXISTS {$this->getTable('erp_inventory_send_email_log')};
            CREATE TABLE {$this->getTable('erp_inventory_send_email_log')} (
                `send_email_log_id` int(11) unsigned NOT NULL auto_increment,
                `sent_at` datetime default NULL,                
                `type` varchar(255) NOT NULL,
                `email_received` varchar(255) NOT NULL,
                `warehouse_name` varchar(255) NOT NULL default '',
                `manager_name` varchar(255) NOT NULL,
                `link` varchar(255) NOT NULL,
                `status` tinyint(1) NOT NULL default '1',
                PRIMARY KEY  (`send_email_log_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            DROP TABLE IF EXISTS {$this->getTable('erp_inventory_notification_product')};
            CREATE TABLE {$this->getTable('erp_inventory_notification_product')} (
                `notification_product_id` int(11) unsigned NOT NULL auto_increment,
                `product_id` int(11) unsigned NOT NULL,	            
                `send_email_log_id` int(11) unsigned NOT NULL,	                 
                `qty_notify` int(11) ,
                `time_notify` datetime default NULL,                
                PRIMARY KEY  (`notification_product_id`),
                FOREIGN KEY (`send_email_log_id`) REFERENCES {$this->getTable('erp_inventory_send_email_log')}(`send_email_log_id`) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (`product_id`) REFERENCES {$this->getTable('catalog_product_entity')}(`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE                
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();

