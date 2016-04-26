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
 * Supplier Adminhtml Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Block_Adminhtml_Importexport_Edit_Form extends Mage_ImportExport_Block_Adminhtml_Import_Edit_Form
{
     /**
     * Add fieldset
     *
     * @return Mage_ImportExport_Block_Adminhtml_Import_Edit_Form
     */
    protected function _prepareForm()
    {
        parent::_prepareForm();
        
        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/validate'),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => Mage::helper('inventoryplus')->__('Import Settings')));
        $fieldset->addField('entity', 'select', array(
            'name'     => 'entity',
            'title'    => Mage::helper('inventoryplus')->__('Entity Type'),
            'label'    => Mage::helper('inventoryplus')->__('Entity Type'),
            'required' => true,
            'values'   => Mage::getModel('importexport/source_import_entity')->toOptionArray()
        ));
        $fieldset->addField('behavior', 'select', array(
            'name'     => 'behavior',
            'title'    => Mage::helper('inventoryplus')->__('Import Behavior'),
            'label'    => Mage::helper('inventoryplus')->__('Import Behavior'),
            'required' => true,
            'values'   => Mage::getModel('importexport/source_import_behavior')->toOptionArray()
        ));
        
        $fieldset->addField('warehouse', 'select', array(
            'name'     => 'warehouse',
            'title'    => Mage::helper('inventoryplus')->__('Warehouses'),
            'label'    => Mage::helper('inventoryplus')->__('Warehouses'),
            'required' => true,
            'values'   => Mage::helper('inventoryplus/warehouse')->getAllWarehouseNameEnable()
        ));
        
        $fieldset->addField(Mage_ImportExport_Model_Import::FIELD_NAME_SOURCE_FILE, 'file', array(
            'name'     => Mage_ImportExport_Model_Import::FIELD_NAME_SOURCE_FILE,
            'label'    => Mage::helper('inventoryplus')->__('Select File to Import'),
            'title'    => Mage::helper('inventoryplus')->__('Select File to Import'),
            'required' => true
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        
    }
}