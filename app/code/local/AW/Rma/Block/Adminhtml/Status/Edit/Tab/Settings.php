<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Rma
 * @version    1.5.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Rma_Block_Adminhtml_Status_Edit_Tab_Settings extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $data =  Mage::registry('awrmaformdatatype');
        if (Mage::getSingleton('adminhtml/session')->getAWRMAFormData()) {
            $data = Mage::getSingleton('adminhtml/session')->getAWRMAFormData(TRUE);
        }
        if (!is_object($data)) {
            $data = new Varien_Object($data);
        }

        $_form = new Varien_Data_Form();
        $this->setForm($_form);
        $_fieldset = $_form->addFieldset(
            'type_fieldset',
            array(
                'legend' => $this->__('Status Information')
            )
        );

        $_fieldset->addField(
            'name', 'text',
            array(
                'name'     => 'name[]',
                'label'    => $this->__('Name'),
                'required' => true,
            )
        );

        $_fieldset->addField(
            'resolve', 'select',
            array(
                'name'     => 'resolve',
                'label'    => $this->__('Resolve RMA after obtaining status'),
                'required' => TRUE,
                'values'   => Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray(),
            )
        );

        if (!$data || !in_array($data->getId(), Mage::helper('awrma/status')->getUneditedStatus())) {
            if (!Mage::app()->isSingleStoreMode()) {
                $_fieldset->addField(
                    'store', 'multiselect',
                    array(
                        'name'     => 'store[]',
                        'label'    => $this->__('Store View'),
                        'required' => true,
                        'values'   => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
                    )
                );
            } else {
                if (isset($data['store'])) {
                    if (is_array($data['store'])) {
                        if (isset($data['store'][0])) {
                            $data['store'] = $data['store'][0];
                        } else {
                            $data['store'] = '';
                        }
                    }
                }
                $_fieldset->addField(
                    'store', 'hidden',
                    array(
                        'name'  => 'store[]',
                        'value' => Mage::app()->getStore(true)->getId(),
                    )
                );
            }
        }

        $_fieldset->addField(
            'sort', 'text',
            array(
                'name'     => 'sort',
                'label'    => Mage::helper('awrma')->__('Sort Order'),
                'required' => true,
            )
        );
        $_form->setValues($data);
    }
}