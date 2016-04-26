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
 * Inventory Supplier Edit Form Content Tab Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventorypurchasing_Block_Adminhtml_Shippingmethod_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * prepare tab form's information
     *
     * @return Magestore_Inventorypurchasing_Block_Adminhtml_Shippingmethod_Edit_Tab_Form
     */
    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        
        if (Mage::getSingleton('adminhtml/session')->getShippingmethodData()) {
            $data = Mage::getSingleton('adminhtml/session')->getShippingmethodData();
            Mage::getSingleton('adminhtml/session')->setShippingmethodData(null);
        } elseif (Mage::registry('shippingmethod_data')) {
            $data = Mage::registry('shippingmethod_data')->getData();
        }
        $fieldset = $form->addFieldset('shippingmethod_form', array(
            'legend' => Mage::helper('inventorypurchasing')->__('General')
                ));

        if ($this->getRequest()->getParam('id'))
            $fieldset->addField('created_by', 'label', array(
                'label' => Mage::helper('inventorypurchasing')->__('Created By'),
            ));

        $fieldset->addField('shipping_method_name', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Shipping Method Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'shipping_method_name',
            'note' => Mage::helper('inventorypurchasing')->__('Shown as an option in "Shipping via" selector when creating purchase order.'),
        ));

        $fieldset->addField('description', 'editor', array(
            'name' => 'description',
            'label' => Mage::helper('inventorypurchasing')->__('Description'),
            'title' => Mage::helper('inventorypurchasing')->__('Description'),
            'style' => 'width:274px; height:200px;',
            'wysiwyg' => false,
            'required' => false,
        ));

        $fieldset->addField('shipping_method_status', 'select', array(
            'label' => Mage::helper('inventorypurchasing')->__('Status'),
            'name' => 'shipping_method_status',
            'values' => array(
                1 => Mage::helper('inventorypurchasing')->__('Active'),
                0 => Mage::helper('inventorypurchasing')->__('Inactive')
            )
        ));

        $form->setValues($data);      
        return parent::_prepareForm();       
    }

}