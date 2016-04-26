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
class Magestore_Inventoryplus_Helper_Stock extends Mage_Core_Helper_Abstract
{

    public function getWarehouse() {
        $adminId = Mage::getSingleton('admin/session')->getUser()->getId();
        if(Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse')){
            $warehouseId = Mage::getModel('admin/session')->getData('stock_warehouse_id');
			if($warehouseId==0){return Mage::getModel('inventoryplus/warehouse')->load(0);} //Magnus - all warehouse
            if($warehouseId){
                    return Mage::getModel('inventoryplus/warehouse')
                        ->load($warehouseId);
            }else{
                $allWarehouseEnable = Mage::helper('inventoryplus/warehouse')->getWarehouseEnable();
                if($allWarehouseEnable){
                    foreach($allWarehouseEnable as $warehouseId){
                        Mage::getModel('admin/session')->setData('stock_warehouse_id',$warehouseId);
                        return Mage::getModel('inventoryplus/warehouse')
                            ->load($warehouseId);
                    }
                }else{
                    return false;
                }
            }         
        }else{
            return Mage::getModel('inventoryplus/warehouse')->getCollection()->getFirstItem();
        }
        return false;
    }   
}