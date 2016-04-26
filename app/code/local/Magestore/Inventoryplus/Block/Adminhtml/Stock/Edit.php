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
 * Warehouse Edit Block
 * 
 * @category     Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Block_Adminhtml_Stock_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();
        $source = $this->getRequest()->getParam('id');       
        
        $this->_objectId = 'id';
        $this->_blockGroup = 'inventoryplus';
        $this->_controller = 'adminhtml_stock';
        $showcustomer_url = Mage::helper('adminhtml')->getUrl('inventoryplusadmin/adminhtml_stock/showcustomer');
      
        $admin = Mage::getSingleton('admin/session')->getUser();                
        $this->_removeButton('delete');
        $this->_removeButton('reset');
        $this->_removeButton('back');    
        $this->_removeButton('save');     
        
        $this->setTemplate('inventoryplus/stock/content-header.phtml');
        $this->_formScripts[] = "            
            function toggleEditor() {
                if (tinyMCE.getInstanceById('inventory_content') == null)
                    tinyMCE.execCommand('mceAddControl', false, 'inventory_content');
                else
                    tinyMCE.execCommand('mceRemoveControl', false, 'inventory_content');
            }                   
                        
        ";        
    }

    /**
     * get text to show in header when edit an item
     *
     * @return string
     */
    public function getHeaderText() {        
        return Mage::helper('inventoryplus')->__('Manage Stock');
    }
        
}
