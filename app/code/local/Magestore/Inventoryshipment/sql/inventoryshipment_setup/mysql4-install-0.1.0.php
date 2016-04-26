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
 * @package     Magestore_Inventoryshipment
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */
/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * create inventoryshipment table
 */
$installer->run("

");
/* update shipping progesss
 * 
 */

$resource = Mage::getSingleton('core/resource');
$writeConnection = $resource->getConnection('core_write');

$readConnection = $resource->getConnection('core_read');

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
        } else if($order['status'] == 'canceled') {
            $shipping_progress = 3;
        } else if($order['status'] == 'closed'){
            $shipping_progress = 4;
        } else{
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

$installer->endSetup();

