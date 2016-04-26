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
class Magestore_Inventorypurchasing_Block_Adminhtml_Paymentterm_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'inventorypurchasing';
        $this->_controller = 'adminhtml_paymentterm';

        $this->_updateButton('save', 'label', Mage::helper('inventorypurchasing')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('inventorypurchasing')->__('Delete'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
            var id = '" . $this->getRequest()->getParam('id', null) . "';
            function toggleEditor() {
                if (tinyMCE.getInstanceById('inventory_content') == null)
                    tinyMCE.execCommand('mceAddControl', false, 'inventory_content');
                else
                    tinyMCE.execCommand('mceRemoveControl', false, 'inventory_content');
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
            
            function showhistory(paymentTermHistoryId){
                var url = '" . $this->getUrl('inventorypurchasingadmin/adminhtml_paymentterms/showhistory') . "';               
                var paymentTermHistoryId = paymentTermHistoryId;                
                var url = url+'paymentTermHistoryId/'+paymentTermHistoryId;
                TINY.box.show(url,1, 800, 400, 1);
            }  
        ";
    }

    /**
     * get text to show in header when edit an item
     *
     * @return string
     */
    public function getHeaderText() {
        if (Mage::registry('paymentterm_data')
                && Mage::registry('paymentterm_data')->getId()
        ) {
            return Mage::helper('inventorypurchasing')->__("Edit Payment Term '%s'", $this->htmlEscape(Mage::registry('paymentterm_data')->getPaymentTermName())
            );
        }
        return Mage::helper('inventorypurchasing')->__('Add Payment Term');
    }

}