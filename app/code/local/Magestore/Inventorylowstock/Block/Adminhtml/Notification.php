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

/**
 * Inventorylowstock Adminhtml Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventorylowstock
 * @author      Magestore Developer
 */
class Magestore_Inventorylowstock_Block_Adminhtml_Notification extends Mage_Adminhtml_Block_Template
{
    
    public function getSystemNotice1() {
        $messages = array();
        $oldEmailLogs = Mage::getModel('inventorylowstock/sendemaillog')->getCollection()
                                                                        ->addFieldToFilter('status',0)
                                                                        ->addFieldToFilter('type','System');
        if ($oldEmailLogs->getSize()) {
            foreach($oldEmailLogs as $oldEmailLog){
                $url = Mage::helper('adminhtml')->getUrl('inventorylowstockadmin/adminhtml_notificationlog/view', array('id' => $oldEmailLog->getId()));

                $messages[] = $this->__('Your system is running out of stock on some products. ') . '  <a href="' . $url . '">' . $this->__('(Click here)') . '</a>' . $this->__(' to view details.') . '<br/>';
            }
        }

        return $messages;
    }
    
    public function getWarehouseNotice1() {
        $messages = array();
        $oldEmailLogs = Mage::getModel('inventorylowstock/sendemaillog')->getCollection()
                                                                        ->addFieldToFilter('status',0)
                                                                        ->addFieldToFilter('type','Warehouse');
        if ($oldEmailLogs->getSize()) {
            foreach($oldEmailLogs as $oldEmailLog){
                 $url = Mage::helper('adminhtml')->getUrl('inventorylowstockadmin/adminhtml_notificationlog/view', array('id' => $oldEmailLog->getId()));
                $messages[] = $this->__("Warehouse <strong>".$oldEmailLog->getWarehouseName()."</strong> is running out of stock on some products! ") . '  <a href="' . $url . '">' . $this->__('(Click here)') . '</a>'.$this->__('  to view details.').'<br/>';
            }
        }
        return $messages;
    }
    
    public function getSystemNotice() {
        $messages = array();
        $qty_notice = Mage::getStoreConfig('inventoryplus/notice/qty_notice');
        $products = Mage::getModel('catalog/product')->getCollection();
        if (Mage::helper('catalog')->isModuleEnabled('Mage_CatalogInventory')) {
            $products->joinField('qty', 'cataloginventory/stock_item', 'qty', 'product_id=entity_id', '{{table}}.stock_id=1', 'left')
                    ->addFieldToFilter('qty', array('lt' => $qty_notice));
        }
        $str = 'qty%5Bto%5D=' . "$qty_notice" . '&price%5Bcurrency%5D=USD';
        $filter = base64_encode($str);
        $url = Mage::helper('adminhtml')->getUrl('adminhtml/catalog_product/index', array('product_filter' => $filter));
        if ($products->getSize()) {
            $messages[] = $this->__('Your system is running out of stock on some products. ') . '  <a href="' . $url . '">' . $this->__('(Click here)') . '</a>' . $this->__(' to view details.') . '<br/>';
        }

        return $messages;
    }
    
    public function getWarehouseNotice() {
        $messages = array();
        $qty_notice = Mage::getStoreConfig('inventoryplus/notice/qty_notice');
        $warehouses = Mage::getModel('inventoryplus/warehouse')->getCollection();
        $str = 'available_qty%5Bto%5D=' . "$qty_notice";
        $filter = base64_encode($str);
        foreach ($warehouses as $warehouse) {
            $url = Mage::helper('adminhtml')->getUrl("inventoryplusadmin/adminhtml_warehouse/edit", array('filter' => $filter, 'id' => $warehouse->getId(), 'loadptab' => true));
            if ($warehouse->getName() != 'unWarehouse') {
                $warehousename = $warehouse->getWarehouseName();
                $warehouseproducts = Mage::getModel('inventoryplus/warehouse_product')
                        ->getCollection()
                        ->addFieldToFilter('warehouse_id', $warehouse->getId());
                foreach ($warehouseproducts as $warehouseproduct) {
                    $qty = $warehouseproduct->getAvailableQty();
                    if ($qty < $qty_notice) {                        
                        $messages[] = $this->__("Warehouse $warehousename is running out of stock on some products! ") . '  <a href="' . $url . '">' . $this->__('(Click here)') . '</a>'.$this->__('  to view details.').'<br/>';
                        break;
                    }
                }
            }
        }
        return $messages;
    }
    
    public function getBothNotice() {
        $messages = array();
        $warehousenotices = $this->getWarehouseNotice();
        $systemnotices = $this->getSystemNotice();
        foreach ($warehousenotices as $wn) {
            $messages[] = $wn;
        }
        foreach ($systemnotices as $sn) {
            $messages[] = $sn;
        }
        return $messages;
    }
}