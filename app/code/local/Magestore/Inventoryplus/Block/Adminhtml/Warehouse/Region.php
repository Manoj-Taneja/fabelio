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
 * Warehouse Edit Form Content Tab Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Block_Adminhtml_Warehouse_Region extends Mage_Core_Block_Template
{
    public function getWarehouse()
    {
        $id = $this->getRequest()->getParam('id');
        $warehouse = Mage::getModel('inventoryplus/warehouse')->load($id);
        return $warehouse;
    }
    public function getSupplier()
    {
        $id = $this->getRequest()->getParam('id');
        $supplier = Mage::getModel('inventoryplus/supplier')->load($id);
        return $supplier;
    }
    /**
     * check admin can edit warehouse or no
     * @return boolean
     */
    public function canEdit()
    {
        $canEdit = false;
        $warehouse = $this->getWarehouse();
        $admin = Mage::getSingleton('admin/session')->getUser();
        if(Mage::helper('inventoryplus/warehouse')->canEdit($admin->getId(), $warehouse->getId()))
            $canEdit = true;
        return $canEdit;
    }
}