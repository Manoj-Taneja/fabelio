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

/**
 * Supplier Adminhtml Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_purchaseorder';
        $this->_blockGroup = 'inventorypurchasing';
        $this->_headerText = Mage::helper('inventorypurchasing')->__('Manage Purchase Orders');
        $this->_addButtonLabel = Mage::helper('inventorypurchasing')->__('Create Purchase Order');
        parent::__construct();
        if(!Mage::helper('inventorypurchasing')->getWarehouseByAdmin()){
            $this->_removeButton('add');
        }
    }
    
    
    public function getWarehouseIdsForPurchase() {
        $warehouseIds = $this->getRequest()->getParam('warehouse_ids', null);
        if (!$warehouseIds) {
            $warehouseIds = Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('id'))->getWarehouseId();
        }
        $warehouseIds = explode(',', $warehouseIds);
        return $warehouseIds;
    }

    public function getWarehouseNameById($warehouseId) {
        return Mage::getModel('inventoryplus/warehouse')->load($warehouseId)->getWarehouseName();
    }

    public function getWarehouseList() {
        $warehouseIds = $this->getWarehouseIdsForPurchase();
        $numberWarehouses = count($warehouseIds);
        $warehouseNames = '';
        $i = 1;
        foreach ($warehouseIds as $warehouseId) {
            if (($numberWarehouses > 1) && ($i > 1)) {
                if ($i == $numberWarehouses) {
                    $warehouseNames .= Mage::helper('inventorypurchasing')->__(' and ');
                } else {
                    $warehouseNames .= ', ';
                }
            }
            $warehouseNames .= '<b>' . $this->getWarehouseNameById($warehouseId) . '</b>';
            $i++;
        }
        return $warehouseNames;
    }

    public function getPurhcaseOrderHistory($id) {
        return Mage::getModel('inventorypurchasing/purchaseorder_history')->load($id);
    }

    public function getPurchaseOrderContentByHistoryId($id) {
        $collection = Mage::getModel('inventorypurchasing/purchaseorder_historycontent')
                ->getCollection()
                ->addFieldToFilter('purchase_order_history_id', $id);
        return $collection;
    }

}