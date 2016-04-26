<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

/**
 * Cms page edit form main tab
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class Amasty_Xlanding_Block_Adminhtml_Page_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        /* @var $model Amasty_Xlanding_Model_Page */
        $model = Mage::registry('amlanding_page');
        
        /* @var $helper Amasty_Xlanding_Helper_Data */
        $helper = Mage::helper('amlanding');


        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>$helper->__('Page Information')));

        if ($model->getPageId()) {
            $fieldset->addField('page_id', 'hidden', array(
                'name' => 'page_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => $helper->__('Page Name'),
            'title'     => $helper->__('Page Name'),
            'required'  => true,
        ));

        $fieldset->addField('identifier', 'text', array(
            'name'      => 'identifier',
            'label'     => $helper->__('URL Key'),
            'title'     => $helper->__('URL Key'),
            'required'  => true,
            'class'     => 'validate-identifier',
            'note'      => $helper->__('Relative to Website Base URL'),
        ));

        /**
         * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {           
            
                $fieldset->addField('store_id', 'multiselect', array(
            'label'     => $helper->__('Stores'),
            'name'      => 'stores[]',
            'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm()            
        ));  
        }
        else {
            $fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
            $model->setStoreId(Mage::app()->getStore(true)->getId());
        }

        $fieldset->addField('is_active', 'select', array(
            'label'     => $helper->__('Status'),
            'title'     => $helper->__('Page Status'),
            'name'      => 'is_active',
            'required'  => true,
            'options'   => $helper->getAvailableStatuses()
        ));

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
