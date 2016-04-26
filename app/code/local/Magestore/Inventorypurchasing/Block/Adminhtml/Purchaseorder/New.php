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
 * Inventory Supplier Edit Block
 * 
 * @category     Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_New extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'inventorypurchasing';
        $this->_controller = 'adminhtml_purchaseorder';
        $this->removeButton('save');

        $this->_formScripts[] = "           		   		   
                Event.observe('currency', 'change', function() {
                    var base_currency = \"" . Mage::app()->getStore()->getBaseCurrencyCode() . "\";
                    var select_currency = $('currency').value;
                    var change_rate = $('change_rate').value;
                    var comment = '(1 '+ base_currency +' = ' + change_rate +' ' +select_currency +')';
                    $('change_rate_comment').innerHTML = comment;					
                });	
                
                Event.observe('change_rate', 'change', function() {
                    var base_currency = \"" . Mage::app()->getStore()->getBaseCurrencyCode() . "\";
                    var select_currency = $('currency').value;
                    var change_rate = $('change_rate').value;
                    var comment = '(1 '+ base_currency +' = ' + change_rate +' ' +select_currency +')';
                    $('change_rate_comment').innerHTML = comment;					
                });			  
        ";
    }

    /**
     * get text to show in header when edit an item
     *
     * @return string
     */
    public function getHeaderText() {
        if (Mage::registry('purchaseorder_data')
                && Mage::registry('purchaseorder_data')->getId()
        ) {
            return Mage::helper('inventorypurchasing')->__("Edit Order No. '%s'", $this->htmlEscape(Mage::registry('purchaseorder_data')->getBillName())
            );
        }
        return Mage::helper('inventorypurchasing')->__('Add New Purchase Order');
    }

}