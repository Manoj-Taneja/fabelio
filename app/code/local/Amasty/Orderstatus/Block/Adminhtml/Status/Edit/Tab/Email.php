<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Block_Adminhtml_Status_Edit_Tab_Email extends Mage_Adminhtml_Block_Widget_Form
{
    const XML_PATH_TEMPLATE_EMAIL = 'global/template/email/';
    
    public function _beforeToHtml() 
    {
        $this->_initForm();
        return parent::_beforeToHtml();
    }
    
    protected function _initForm()
    {
        $statusId = $this->getRequest()->getParam('id');
        if ($statusId) {
            $statusModel = Mage::getModel('amorderstatus/status')->load($statusId);
        }

        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset('email_fieldset', array('legend'=>Mage::helper('amorderstatus')->__('Enable Notifications')));

        $fieldset->addField('notify_by_email', 'select', array(
            'label'     => Mage::helper('amorderstatus')->__('Always Notify Customer By E-mail'),
            'name'      => 'notify_by_email',
            'note'		=> Mage::helper('amorderstatus')->__('If set to `Yes`, customer always gets e-mail notification when order status is set to the current one'),
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('amorderstatus')->__('Yes'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('amorderstatus')->__('No'),
                ),
            ),
        ));
        
        $fieldset   = $form->addFieldset('emailstores_fieldset', array('legend'=>Mage::helper('amorderstatus')->__('Store View E-mail Template')));
        $storeViews = Mage::app()->getStores();
        $options    = Mage::getResourceModel('core/email_template_collection')->load()->toOptionArray();
        array_unshift(
            $options,
            array(
                'value' => 0,
                'label' => Mage::helper('amorderstatus')->__((string)Mage::app()->getConfig()->getNode(self::XML_PATH_TEMPLATE_EMAIL . 'amorderstatus_status_change' . '/label')) 
                                    . ' ' . Mage::helper('amorderstatus')->__('(Default Template From Locale)'), 
            )
        );
        foreach ($storeViews as $storeView) {
            $fieldset->addField('store_template[' . $storeView->getStoreId() . ']', 'select', array(
                'label'     => '"' . $storeView->getName() . '" ' . Mage::helper('amorderstatus')->__('Store Template'),
                'name'      => 'store_template[' . $storeView->getStoreId() . ']',
                'values'    => $options,
            ));
        }

        if ($statusId) {
            $form->setValues($statusModel->getData());
        }
        $this->setForm($form);
    }
}