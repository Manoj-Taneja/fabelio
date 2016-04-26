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
 * Inventory Helper
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Helper_Warehouse extends Mage_Core_Helper_Abstract
{
     public function getCountryList() {
        $result = array();
        $collection = Mage::getModel('directory/country')->getCollection();
        foreach ($collection as $country) {
            $cid = $country->getId();
            $cname = $country->getName();
            $result[$cid] = $cname;
        }
        return $result;
    }
    
    public function getCountryListHash() {
        $options = array();
        foreach ($this->getCountryList() as $value => $label) {
            if ($label)
                $options[] = array(
                    'value' => $value,
                    'label' => $label
                );
        }
        return $options;
    }
    
    public function canAdjust($adminId, $warehouseId) {
        if ($warehouseId) {
            $assignmentCollection = Mage::getModel('inventoryplus/warehouse_permission')
                    ->getCollection()
                    ->addFieldToFilter('warehouse_id', $warehouseId)
                    ->addFieldToFilter('admin_id', $adminId);
            if ($assignmentCollection->getSize()) {
                $assignment = $assignmentCollection->getFirstItem();
                if ($assignment->getCanAdjust()) {
                    return true;
                }
            }
        } else {
            return true;
        }
        return false;
    }
    
    public function canSendAndRequest($adminId, $warehouseId) {
        if ($warehouseId) {
            $assignmentCollection = Mage::getModel('inventoryplus/warehouse_permission')
                    ->getCollection()
                    ->addFieldToFilter('warehouse_id', $warehouseId)
                    ->addFieldToFilter('admin_id', $adminId);
            if ($assignmentCollection->getSize()) {
                $assignment = $assignmentCollection->getFirstItem();
                if ($assignment->getCanSendRequestStock()) {
                    return true;
                }
            }
        } else {
            return true;
        }
        return false;
    }
    
    public function canEdit($adminId, $warehouseId) {
        if ($warehouseId) {
            $assignmentCollection = Mage::getModel('inventoryplus/warehouse_permission')
                    ->getCollection()
                    ->addFieldToFilter('warehouse_id', $warehouseId)
                    ->addFieldToFilter('admin_id', $adminId);
            if ($assignmentCollection->getSize()) {
                $assignment = $assignmentCollection->getFirstItem();
                if ($assignment->getCanEditWarehouse()) {
                    return true;
                }
            }
        } else {
            return true;
        }
        return false;
    }
    
    public function getProductSkuByProductId($productId)
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $sql = 'SELECT distinct(`sku`) from ' . $resource->getTableName("catalog_product_entity") . ' WHERE (entity_id = '.$productId.')';
        $result = $readConnection->fetchOne($sql);
        return $result;
    }
    
    public function deleteWarehouseProducts($warehouse, $list){
        $warehouseProducts = Mage::getModel('inventoryplus/warehouse_product')
                ->getCollection()
                ->addFieldToFilter('warehouse_id', $warehouse->getId())
                ->addFieldToFilter('product_id', array('nin'=>$list));
        $warehouseProductSkus = '';
        if($warehouseProducts->getSize()){
            $i = 0;
            foreach($warehouseProducts as $wp){
                if($i!=0)
                    $warehouseProductSkus .= ', ';
                $warehouseProductSkus .= $this->getProductSkuByProductId($wp->getId());
                if($wp->getTotalQty() == 0)
                    $wp->delete();
            }
        }
        return $warehouseProductSkus;
    }
    
    //check warehouse has not any product => can delete warehouse
    public function canDelete($warehouseId){
        $warehouseProducts = Mage::getModel('inventoryplus/warehouse_product')
                ->getCollection()
                ->addFieldToFilter('warehouse_id',$warehouseId)
                ->addFieldToFilter('total_qty', array('gt'=>'0'));
        if($warehouseProducts->getSize()){
            return false;
        }
        return true;
    }
    
    public function getAllWarehouseName() {
        $warehouses = array();
        $model = Mage::getModel('inventoryplus/warehouse');
        $collection = $model->getCollection();
        foreach ($collection as $warehouse) {
            $warehouses[$warehouse->getId()] = $warehouse->getWarehouseName();
        }
        return $warehouses;
    }
    
    //get all warehouse can edit
    public function getWarehouseEnable()
    {
        $adminId = Mage::getSingleton('admin/session')->getUser()->getId();
        $warehouseIds = array();
        $warehousePermission = Mage::getModel('inventoryplus/warehouse_permission')
                                    ->getCollection()
                                    ->addFieldToFilter('admin_id',$adminId)
                                    ->addFieldToFilter('can_edit_warehouse',1);
        foreach($warehousePermission as $warehouse)
            $warehouseIds[] = $warehouse->getWarehouseId();
        return $warehouseIds;
    }
    
     //get warehouse by product id
    public function getWarehouseByProductId($productId,$checkqtyZero = true) {
        if($checkqtyZero == true){
            $warehouseProducts = Mage::getModel('inventoryplus/warehouse_product')
                ->getCollection()
                ->addFieldToFilter('product_id', $productId)
                ->addFieldToFilter('total_qty', array('gt' => 0));
        }
        else{
            $warehouseProducts = Mage::getModel('inventoryplus/warehouse_product')
                ->getCollection()
                ->addFieldToFilter('product_id', $productId);
        }
        if (count($warehouseProducts)) {
            return $warehouseProducts;
        } else {
            return null;
        }
    }
    
    public function checkWarehouseAvailableProduct($warehouseId, $productId, $qty) {
        $warehouseProductModel = Mage::getModel('inventoryplus/warehouse_product')->getCollection()
                ->addFieldToFilter('warehouse_id', $warehouseId)
                ->addFieldToFilter('product_id', $productId)
                ->addFieldToFilter('total_qty', array('gteq' => $qty));
        if ($warehouseProductModel->getFirstItem()->getData()) {
            return true;
        } else {
            return false;
        }
    }
    
    /*
     * get the firrst warehouse ha most this product
     */

    public function getFirstWarehouseHaveMostOfAProduct($productId) {

        $warehouseProductModel = Mage::getModel('inventoryplus/warehouse_product')->getCollection()
                ->addFieldToFilter('product_id', $productId)
                ->setOrder('total_qty', 'DESC');
        if (count($warehouseProductModel) > 1) {
            $warehouseProductModel = Mage::getModel('inventoryplus/warehouse_product')->getCollection()
                    ->addFieldToFilter('product_id', $productId)
                    ->setOrder('total_qty', 'DESC');
        }
        if ($warehouseProductModel->getFirstItem()->getData()) {
            $warehouseId = $warehouseProductModel->getFirstItem()->getWarehouseId();
        } else {
            $allWarehouse = $this->getAllWarehouseNameEnable();
            foreach ($allWarehouse as $warehouseIdKey => $warehouseNameValue) {
                if ($warehouseNameValue != '') {
                    $warehouseId = $warehouseIdKey;
                    break;
                }
            }
        }
        return $warehouseId;
    }
    
    public function checkTheFirstWarehouseAvailableProduct($productId, $minQty, $orderId) {
        $warehouseOrder = Mage::getModel('inventoryplus/warehouse_order')->getCollection()
                ->addFieldToFilter('order_id', $orderId)
                ->addFieldToFilter('product_id', $productId);
        $firstWarehouse = $warehouseOrder->getFirstItem()->getWarehouseId();

        $warehouseProductModel = Mage::getModel('inventoryplus/warehouse_product')->getCollection()
                ->addFieldToFilter('product_id', $productId)
                ->addFieldToFilter('warehouse_id', $firstWarehouse)
                ->addFieldToFilter('total_qty', array('gteq' => $minQty))
                ->setOrder('total_qty', 'DESC');

        if ($warehouseProductModel->getFirstItem()->getData()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function selectboxWarehouseShipmentByPid($productId, $minQty, $orderItemId, $orderId = null) {
        $warehouseOrder = Mage::getModel('inventoryplus/warehouse_order')->getCollection()
                ->addFieldToFilter('order_id', $orderId)
                ->addFieldToFilter('product_id', $productId);



        $allWarehouse = $this->getAllWarehouseNameEnable();
        $warehouseProductModel = Mage::getModel('inventoryplus/warehouse_product')->getCollection()
                ->addFieldToFilter('product_id', $productId)
                ->setOrder('total_qty', 'DESC');
        $warehouseHaveProduct = array();
        $return = "<select class='warehouse-shipment' name='warehouse-shipment[items][$orderItemId]' onchange='changeviewwarehouse(this,$orderItemId);' id='warehouse-shipment[items][$orderItemId]'>";
        $firstWarehouse = $warehouseOrder->getFirstItem()->getWarehouseId();
        foreach ($warehouseProductModel as $model) {
            $warehouseId = $model->getWarehouseId();
            if(!isset($allWarehouse[$warehouseId]))
                continue;
            $warehouseName = $allWarehouse[$warehouseId];
            $productQty = $model->getTotalQty();
            if ($warehouseName != '') {
                if (!$firstWarehouse)
                    $firstWarehouse = $warehouseId;
                $return .= "<option value='$warehouseId' ";
                if ($warehouseId == $firstWarehouse) {
                    $return .= ' selected';
                }
                $return .= ">$warehouseName($productQty product(s))</option>";
                $warehouseHaveProduct[] = $allWarehouse[$warehouseId];
            }
        }
        foreach ($allWarehouse as $warehouseIdKey => $warehouseNameValue) {
            if ($warehouseNameValue != '') {
                if (in_array($allWarehouse[$warehouseIdKey], $warehouseHaveProduct) == false) {
                    if (!$firstWarehouse)
                        $firstWarehouse = $warehouseIdKey;
                    $return .= "<option value='$warehouseIdKey' ";
                    $return .= ">$warehouseNameValue(0 product(s))</option>";
                }
            }
        }

        $return .= "</select><br />";
        $return .= "<div style='float:right;'><a id='view_warehouse-shipment[items][$orderItemId]' target='_blank' href='" . Mage::getBlockSingleton('inventoryplus/adminhtml_warehouse')->getUrl('inventoryplusadmin/adminhtml_warehouse/edit') . 'id/' . $firstWarehouse . "'>" . $this->__('view') . "</a></div>";
        return $return;
    }
    
    public function getAllWarehouseNameEnable() {
        $warehouses = array();
        $model = Mage::getModel('inventoryplus/warehouse');
        $collection = $model->getCollection()
                ->addFieldToFilter('status', 1);
        foreach ($collection as $warehouse) {
            $warehouses[$warehouse->getId()] = $warehouse->getWarehouseName();
        }
        return $warehouses;
    }
    
    /*
     * get warehouse name by warehouse id in model inventory/warehouse
     */

    public function getWarehouseNameByWarehouseId($warehouseId) {
        $warehouseModel = Mage::getModel('inventoryplus/warehouse')->load($warehouseId);
        $warehouseName = $warehouseModel->getWarehouseName();
        return $warehouseName;
    }
    
    public function getOnHoldQty($product_id , $warehouse_id){
        $resource = Mage::getModel('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $sql = 'SELECT SUM(qty) as `on_hold` FROM '.$resource->getTableName('inventoryplus/warehouse_order').
                ' WHERE product_id = '.$product_id;
        if($warehouse_id != 0){
            $sql .= ' AND warehouse_id = '.$warehouse_id;
        }       
        $result = $readConnection->fetchAll($sql);
        if($result[0]['on_hold'] == null){
            return 0;
        } else return $result[0]['on_hold'];
    }    
}