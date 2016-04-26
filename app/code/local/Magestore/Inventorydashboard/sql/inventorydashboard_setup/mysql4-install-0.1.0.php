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
 * @package     Magestore_Inventorydashboard
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * create inventorydashboard table
 */
$installer->run("

DROP TABLE IF EXISTS {$this->getTable('erp_inventory_dashboard_tab')};

CREATE TABLE {$this->getTable('erp_inventory_dashboard_tab')} (
  `tab_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `position` int(6) NOT NULL,
  PRIMARY KEY (`tab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS {$this->getTable('erp_inventory_dashboard_item')};
CREATE TABLE {$this->getTable('erp_inventory_dashboard_item')} (
  `item_id` int(11) unsigned NOT NULL auto_increment,
  `tab_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL default '',
  `item_column` int(11) NOT NULL,
  `item_row` int(11) NOT NULL,  
  `report_code` varchar(255) NOT NULL default '',
  `chart_code` varchar(255) NOT NULL default '',
  PRIMARY KEY (`item_id`),
  INDEX (`tab_id`),
  FOREIGN KEY (`tab_id`) REFERENCES {$this->getTable('erp_inventory_dashboard_tab')}(`tab_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS {$this->getTable('erp_inventory_dashboard_report_type')};
CREATE TABLE {$this->getTable('erp_inventory_dashboard_report_type')} (
  `report_type_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `report_code` varchar(255) NOT NULL default '',    
  PRIMARY KEY (`report_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO {$this->getTable('erp_inventory_dashboard_report_type')} (name, report_code) VALUES ('Items shipped from warehouse(s)', 'warehouse_shipment');
INSERT INTO {$this->getTable('erp_inventory_dashboard_report_type')} (name, report_code) VALUES ('10 products with the longest storage time', '10_products_with_the_longest_storage_time');
INSERT INTO {$this->getTable('erp_inventory_dashboard_report_type')} (name, report_code) VALUES ('The last 10 stock adjustments', 'last_10_adjuststock');
INSERT INTO {$this->getTable('erp_inventory_dashboard_report_type')} (name, report_code) VALUES ('Purchase Orders sent to supplier(s)', 'supplier_purchase_order');
INSERT INTO {$this->getTable('erp_inventory_dashboard_report_type')} (name, report_code) VALUES ('10 best-seller products', '10_best_seller_products');  
INSERT INTO {$this->getTable('erp_inventory_dashboard_report_type')} (name, report_code) VALUES ('Sales orders in the last 10 days', 'order_in_10days');

    
DROP TABLE IF EXISTS {$this->getTable('erp_inventory_dashboard_chart_type')};
CREATE TABLE {$this->getTable('erp_inventory_dashboard_chart_type')} (
  `chart_type_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `chart_code` varchar(255) NOT NULL default '',    
  PRIMARY KEY (`chart_type_id`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_type')} (name, chart_code) VALUES ('Line Chart', 'chart_line');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_type')} (name, chart_code) VALUES ('Pie Chart', 'chart_pie');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_type')} (name, chart_code) VALUES ('Column Chart', 'chart_column');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_type')} (name, chart_code) VALUES ('Table Chart', 'chart_table');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_type')} (name, chart_code) VALUES ('Bar Basic', 'chart_bar');
    
DROP TABLE IF EXISTS {$this->getTable('erp_inventory_dashboard_chart_report')};
CREATE TABLE {$this->getTable('erp_inventory_dashboard_chart_report')} (
  `chart_report_id` int(11) unsigned NOT NULL auto_increment,
  `report_code` varchar(255) NOT NULL default '',  
  `chart_code` varchar(255) NOT NULL default '',  
  PRIMARY KEY (`chart_report_id`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('order_in_10days', 'chart_line');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('order_in_10days', 'chart_column');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('order_in_10days', 'chart_table');
    
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('warehouse_shipment', 'chart_pie');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('warehouse_shipment', 'chart_column');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('warehouse_shipment', 'chart_table');
    
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('supplier_purchase_order', 'chart_pie');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('supplier_purchase_order', 'chart_column');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('supplier_purchase_order', 'chart_table');
    
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('last_10_adjuststock', 'chart_line');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('last_10_adjuststock', 'chart_column');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('last_10_adjuststock', 'chart_table');

INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('10_best_seller_products', 'chart_table');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('10_best_seller_products', 'chart_bar');
        
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('10_products_with_the_longest_storage_time', 'chart_table');
INSERT INTO {$this->getTable('erp_inventory_dashboard_chart_report')} (report_code, chart_code) VALUES ('10_products_with_the_longest_storage_time', 'chart_bar');    


");

$tab = Mage::getModel('inventorydashboard/tabs')->setData('name','General Information')
                      ->setData('position',1)
                      ->save();
					  
Mage::getModel('inventorydashboard/items')->setData('name','Last orders in 10 days')
                      ->setData('tab_id',$tab->getId())
                      ->setData('item_column',1)
                      ->setData('item_row',1)
                      ->setData('chart_code','chart_line')
                      ->setData('report_code','order_in_10days')
                      ->save();
					  
Mage::getModel('inventorydashboard/items')->setData('name','Total/Amount ship from warehouse')
                      ->setData('tab_id',$tab->getId())
                      ->setData('item_column',2)
                      ->setData('item_row',1)
                      ->setData('chart_code','chart_pie')
                      ->setData('report_code','warehouse_shipment')
                      ->save();		
					  
Mage::getModel('inventorydashboard/items')->setData('name','10 best-seller products')
                      ->setData('tab_id',$tab->getId())
                      ->setData('item_column',3)
                      ->setData('item_row',1)
                      ->setData('chart_code','chart_bar')
                      ->setData('report_code','10_best_seller_products')
                      ->save();
					  
Mage::getModel('inventorydashboard/items')->setData('name','Purchase Orders sent to supplier(s)')
                      ->setData('tab_id',$tab->getId())
                      ->setData('item_column',1)
                      ->setData('item_row',2)
                      ->setData('chart_code','chart_table')
                      ->setData('report_code','supplier_purchase_order')
                      ->save();		
					  
Mage::getModel('inventorydashboard/items')->setData('name','The last 10 stock adjustments')
                      ->setData('tab_id',$tab->getId())
                      ->setData('item_column',2)
                      ->setData('item_row',2)
                      ->setData('chart_code','chart_column')
                      ->setData('report_code','last_10_adjuststock')
                      ->save();

Mage::getModel('inventorydashboard/items')->setData('name','10 products with the longest storage time')
                      ->setData('tab_id',$tab->getId())
                      ->setData('item_column',3)
                      ->setData('item_row',2)
                      ->setData('chart_code','chart_bar')
                      ->setData('report_code','10_products_with_the_longest_storage_time')
                      ->save();
					  
$installer->endSetup();

