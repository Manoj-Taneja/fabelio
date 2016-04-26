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


class AW_Rma_Block_Adminhtml_Reason_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('awrmaReasonForm');
    }

    protected function _prepareForm()
    {
        if (Mage::getSingleton('adminhtml/session')->getAWRMAReasonFormData()) {
            $data = Mage::getSingleton('adminhtml/session')->getAWRMAReasonFormData(true);
        } else {
            $data = Mage::registry('awrmaformdatareason');
        }

        $reasonSaveUrl = $this->getUrl(
            'awrma_admin/adminhtml_reason/save', array('id' => $this->getRequest()->getParam('id'))
        );
        $_form = new Varien_Data_Form(
            array(
                'id'     => 'edit_form',
                'action' => $reasonSaveUrl,
                'method' => 'post'
            )
        );

        $_fieldset = $_form->addFieldset(
            'reason_fieldset',
            array(
                'legend' => $this->__('Reason Information')
            )
        );

        $_fieldset->addField(
            'name', 'text',
            array(
                'name'     => 'name',
                'label'    => $this->__('Name'),
                'required' => true
            )
        );

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

        $_fieldset->addField(
            'sort', 'text',
            array(
                'name'     => 'sort',
                'label'    => Mage::helper('awrma')->__('Sort Order'),
                'required' => true
            )
        );

        $_fieldset->addField(
            'enabled', 'select',
            array(
                'name'   => 'enabled',
                'label'  => Mage::helper('awrma')->__('Enabled'),
                'values' => Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray()
            )
        );

        $_form->setValues($data);
        $_form->setUseContainer(true);
        $this->setForm($_form);

        return parent::_prepareForm();
    }
}