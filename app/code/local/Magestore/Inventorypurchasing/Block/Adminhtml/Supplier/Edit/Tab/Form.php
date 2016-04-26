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
class Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * prepare tab form's information
     *
     * @return Magestore_Inventory_Block_Adminhtml_Supplier_Edit_Tab_Form
     */
    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        if (Mage::getSingleton('adminhtml/session')->getInventorypurchasingSupplierData()) {
            $data = Mage::getSingleton('adminhtml/session')->getInventorypurchasingSupplierData();
            Mage::getSingleton('adminhtml/session')->setInventorypurchasingSupplierData(null);
        } elseif (Mage::registry('inventorypurchasing_supplier_data')) {
            $data = Mage::registry('inventorypurchasing_supplier_data')->getData();
        }
        $fieldset = $form->addFieldset('supplier_form', array(
            'legend' => Mage::helper('inventorypurchasing')->__('General Information')
        ));

        if ($this->getRequest()->getParam('id'))
            $fieldset->addField('created_by', 'label', array(
                'label' => Mage::helper('inventorypurchasing')->__('Created by'),
            ));

        $fieldset->addField('supplier_name', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Supplier Name '),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'supplier_name',
        ));

        $fieldset->addField('contact_name', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Contact Person'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'contact_name',
        ));

        $fieldset->addField('supplier_email', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Email'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'supplier_email',
        ));

        $fieldset->addField('telephone', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Telephone'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'telephone',
        ));
        $fieldset->addField('fax', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Fax'),
            'required' => false,
            'name' => 'fax',
        ));
        $fieldset->addField('street', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Street'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'street',
        ));
        $fieldset->addField('city', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('City'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'city',
        ));
        $fieldset->addField('country_id', 'select', array(
            'label' => Mage::helper('inventorypurchasing')->__('Country'),
            'required' => true,
            'name' => 'country_id',
            'values' => Mage::helper('inventoryplus/warehouse')->getCountryListHash(),
        ));

        $fieldset->addField('stateEl', 'note', array(
            'label' => Mage::helper('inventorypurchasing')->__('State/Province'),
            'name' => 'stateEl',
            'required' => false,
            'text' => $this->getLayout()->createBlock('inventorypurchasing/adminhtml_supplier_region')->setTemplate('inventorypurchasing/supplier/region.phtml')->toHtml(),
        ));

        $fieldset->addField('postcode', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Zip/Postal Code'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'postcode',
        ));

        $fieldset->addField('website', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Website'),
            'required' => false,
            'name' => 'website',
        ));
        $fieldset->addField('description', 'editor', array(
            'name' => 'description',
            'label' => Mage::helper('inventorypurchasing')->__('Description'),
            'title' => Mage::helper('inventorypurchasing')->__('Description'),
            'style' => 'width:274px; height:200px;',
            'wysiwyg' => false,
            'required' => false,
        ));

        $fieldset->addField('supplier_status', 'select', array(
            'label' => Mage::helper('inventorypurchasing')->__('Status'),
            'name' => 'supplier_status',
            'values' => Mage::getSingleton('inventorypurchasing/status')->getOptionHash(),
        ));

        $purchasingFieldset = $form->addFieldset('purchasing_form', array(
            'legend' => Mage::helper('inventorypurchasing')->__('Purchasing')
        ));

        $purchasingFieldset->addField('ship_via', 'select', array(
            'label' => Mage::helper('inventorypurchasing')->__('Shipping via'),
            'name' => 'ship_via',
            'values' => Mage::helper('inventorypurchasing/purchaseorder')->getShippingMethodForSupplier(),
        ));
        $purchasingFieldset->addField('payment_term', 'select', array(
            'label' => Mage::helper('inventorypurchasing')->__('Payment terms'),
            'name' => 'payment_term',
            'values' => Mage::helper('inventorypurchasing/purchaseorder')->getPaymentTermsForSupplier(),
        ));

        Mage::dispatchEvent('supplier_form_after', array('form' => $form));

        $form->setValues($data);
        return parent::_prepareForm();
    }

}
