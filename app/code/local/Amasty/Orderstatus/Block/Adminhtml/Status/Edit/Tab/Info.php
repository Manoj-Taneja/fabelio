<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Block_Adminhtml_Status_Edit_Tab_Info extends Mage_Adminhtml_Block_Widget_Form
{				
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

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('amorderstatus')->__('Status Information')));

        $fieldset->addField('status', 'text',
            array(
                'name'  => 'status',
                'label' => Mage::helper('amorderstatus')->__('Status Name'),
                'id'    => 'status',
                'class' => 'required-entry',
                'required' => true,
            )
        );
        
        foreach (Mage::getConfig()->getNode('global/sales/order/states')->children() as $state => $node) {
            $label = Mage::helper('amorderstatus')->__(trim( (string) $node->label ) );;
            $states[] = array('value' => $state, 'label' => $label);
        }
        $fieldset->addField('parent_state', 'multiselect', array(
            'name'      => 'parent_state',
            'label'     => Mage::helper('amorderstatus')->__('Order States To Apply Status To'),
            'title'     => Mage::helper('amorderstatus')->__('Order States To Apply Status To'),
            'values'    => $states,
        ));
        
        $fieldset->addField('is_active', 'select', array(
            'label'     => Mage::helper('amorderstatus')->__('Enabled'),
            'name'      => 'is_active',
            'required'  => true,
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

        if ($statusId) {
            $form->setValues($statusModel->getData());
        }
        $this->setForm($form);
    }
}