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
class Magestore_Inventoryplus_Block_Adminhtml_Warehouse_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * prepare tab form's information
     *
     * @return Magestore_Inventory_Block_Adminhtml_Inventory_Edit_Tab_Form
     */
    protected function _prepareForm() {

        $form = new Varien_Data_Form();
        $this->setForm($form);

        if (Mage::getSingleton('adminhtml/session')->getWarehouseData()) {
            $data = Mage::getSingleton('adminhtml/session')->getWarehouseData();
            Mage::getSingleton('adminhtml/session')->setWarehouseData(null);
        } elseif (Mage::registry('warehouse_data')) {
            $data = Mage::registry('warehouse_data')->getData();
        }
        $fieldset = $form->addFieldset('warehouse_form', array(
            'legend' => Mage::helper('inventoryplus')->__('Warehouse Information')
        ));
        $adminId = Mage::getSingleton('admin/session')->getUser()->getId();
        $admin = Mage::getModel('admin/user')->load($adminId);
        $roleId = $admin->getRole()->getId();
        $allowAll = false;
        $adminRule = Mage::getModel('admin/rules')->getCollection()
                ->addFieldToFilter('role_id',$roleId)
                ->addFieldToFilter('resource_id','all')
                ->getFirstItem();
        if($adminRule->getPermission() == 'allow'){
            $allowAll = true;
        }
        
        $current_username = $admin->getUsername();
        $warehouse_created_by = $data['created_by'];
        $isCreator = false;
        if ($current_username == $warehouse_created_by) {
            $isCreator = true;
        }
        $users = Mage::getModel('admin/user')->getCollection();
        $adminArray = array();
        foreach ($users as $user) {
            $adminArray[$user->getUsername()] = $user->getFirstname() .' '. $user->getLastname() . ' ('. $user->getEmail().') ';
        }

        if (isset($data['warehouse_id']) && $data['warehouse_id']) {
            $fieldset->addField('created_by', 'label', array(
                'label' => Mage::helper('inventoryplus')->__('Created by'),
            ));
        }
        
        $disabled = true;
        if ($isCreator || !$this->getRequest()->getParam('id')) {
            $disabled = false;
        }
        
        if (isset($data['warehouse_id']) && !$isCreator) {
            $readonly = !Mage::helper('inventoryplus/warehouse')->canEdit($adminId, $data['warehouse_id']);
        } else {
            $readonly = false;
        }
        
        if($allowAll){
            $fieldset->addField('is_root', 'checkbox', array(
                'label' => Mage::helper('inventoryplus')->__('Is Root'),
                'onclick'   => 'this.value = this.checked ? 1 : 0;',
                'checked' => '',
                'name' => 'is_root',
                'title' => Mage::helper('inventoryplus')->__('Set Root Warehouse'),
            ));
            $form->getElement('is_root')->setIsChecked(!empty($data['is_root']));
        }
        
        $fieldset->addField('warehouse_name', 'text', array(
            'label' => Mage::helper('inventoryplus')->__('Warehouse Name'),
            'class' => 'required-entry',
            'required' => true,
            'disabled' => $readonly,
            'name' => 'warehouse_name',
        ));

        $fieldset->addField('manager', 'select', array(
            'label' => Mage::helper('inventoryplus')->__('Manager'),
            'required' => true,
            'name' => 'manager',
            'disabled' => $disabled,
            'values' => $adminArray,
        ));

        $fieldset->addField('telephone', 'text', array(
            'label' => Mage::helper('inventoryplus')->__('Telephone'),
            'required' => true,
            'disabled' => $readonly,
            'name' => 'telephone',
        ));

        $fieldset->addField('street', 'text', array(
            'label' => Mage::helper('inventoryplus')->__('Street'),
            'required' => true,
            'disabled' => $readonly,
            'name' => 'street',
        ));

        $fieldset->addField('city', 'text', array(
            'label' => Mage::helper('inventoryplus')->__('City'),
            'required' => true,
            'disabled' => $readonly,
            'name' => 'city',
        ));

        $fieldset->addField('country_id', 'select', array(
            'label' => Mage::helper('inventoryplus')->__('Country'),
            'required' => true,
            'disabled' => $readonly,
            'name' => 'country_id',
            'values' => Mage::helper('inventoryplus/warehouse')->getCountryListHash(),
        ));

        $fieldset->addField('stateEl', 'note', array(
            'label' => Mage::helper('inventoryplus')->__('State/Province'),
            'name' => 'stateEl',
            'required' => false,
            'disabled' => $readonly,
            'text' => $this->getLayout()->createBlock('inventoryplus/adminhtml_warehouse_region')->setTemplate('inventoryplus/warehouse/region.phtml')->toHtml(),
        ));

        $fieldset->addField('postcode', 'text', array(
            'label' => Mage::helper('inventoryplus')->__('Zip/Postal Code'),
            'required' => true,
            'disabled' => $readonly,
            'name' => 'postcode',
        ));

        $fieldset->addField('latitude', 'hidden', array(
            'label' => Mage::helper('inventoryplus')->__('Latitude'),
            'required' => false,
            'disabled' => $readonly,
            'name' => 'latitude',
        ));

        $fieldset->addField('longitude', 'hidden', array(
            'label' => Mage::helper('inventoryplus')->__('Longitude'),
            'required' => false,
            'disabled' => $readonly,
            'name' => 'longitude',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('inventoryplus')->__('Status'),
            'name' => 'status',
            'required' => true,
            'disabled' => $readonly,
            'values' => Mage::getSingleton('inventoryplus/status')->getOptionHash(),
        ));

        $form->setValues($data);
        return parent::_prepareForm();
    }

}
