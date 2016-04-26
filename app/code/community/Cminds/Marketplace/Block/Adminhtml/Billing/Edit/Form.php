<?php

class Cminds_Marketplace_Block_Adminhtml_Billing_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        if (Mage::registry('payment_data')){
            $data = Mage::registry('payment_data')->getData();
        } else {
            $data = array();
        }

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ));

        $form->setUseContainer(true);

        $this->setForm($form);

        $fieldset = $form->addFieldset('payment_form', array(
            'legend' =>Mage::helper('marketplace')->__('Payment Info')
        ));

        $fieldset->addField('id', 'hidden', array(
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'id',
        ));

        $fieldset->addField('amount', 'text', array(
            'label'     => Mage::helper('marketplace')->__('Amount'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'amount',
        ));

        $fieldset->addField('payment_date', 'date', array(
            'label'     => Mage::helper('marketplace')->__('Payment Date'),
            'class'     => 'required-entry',
            'required'  => true,
            'image'              => $this->getSkinUrl('images/grid-cal.gif'),
            'name'      => 'payment_date',
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)

        ));

        $form->setValues($data);

        return parent::_prepareForm();
    }
}