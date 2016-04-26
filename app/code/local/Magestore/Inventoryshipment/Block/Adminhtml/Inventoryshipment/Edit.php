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

/**
 * Inventoryshipment Edit Block
 * 
 * @category     Magestore
 * @package     Magestore_Inventoryshipment
 * @author      Magestore Developer
 */
class Magestore_Inventoryshipment_Block_Adminhtml_Inventoryshipment_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        
        $this->_objectId = 'id';
        $this->_blockGroup = 'inventoryshipment';
        $this->_controller = 'adminhtml_inventoryshipment';
        
        $this->_updateButton('save', 'label', Mage::helper('inventoryshipment')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('inventoryshipment')->__('Delete Item'));
        
        $this->_addButton('saveandcontinue', array(
            'label'        => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'    => 'saveAndContinueEdit()',
            'class'        => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('inventoryshipment_content') == null)
                    tinyMCE.execCommand('mceAddControl', false, 'inventoryshipment_content');
                else
                    tinyMCE.execCommand('mceRemoveControl', false, 'inventoryshipment_content');
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
    
    /**
     * get text to show in header when edit an item
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('inventoryshipment_data')
            && Mage::registry('inventoryshipment_data')->getId()
        ) {
            return Mage::helper('inventoryshipment')->__("Edit Item '%s'",
                                                $this->htmlEscape(Mage::registry('inventoryshipment_data')->getTitle())
            );
        }
        return Mage::helper('inventoryshipment')->__('Add Item');
    }
}