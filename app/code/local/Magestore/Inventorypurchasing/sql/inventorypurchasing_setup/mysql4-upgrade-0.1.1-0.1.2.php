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
 * @category 	Magestore
 * @package 	Magestore_Inventorysupplier
 * @copyright 	Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license 	http://www.magestore.com/license-agreement.html
 */
/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$installer->run("
");
$resource = Mage::getSingleton('core/resource');
$writeConnection = $resource->getConnection('core_write');
$readConnection = $resource->getConnection('core_read');
//Check exists column barcode
    $result = $readConnection->fetchAll("SHOW COLUMNS FROM " .$this->getTable('erp_inventory_delivery') . " LIKE 'barcode'");
    if (count($result) == 0) {
        $writeConnection->query("ALTER TABLE " . $this->getTable('erp_inventory_delivery') . "  ADD `barcode` varchar(255) NOT NULL default '';");
    }
$installer->endSetup();
