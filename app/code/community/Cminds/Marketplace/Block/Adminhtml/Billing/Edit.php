<?php

class Cminds_Marketplace_Block_Adminhtml_Billing_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'marketplace';
        $this->_controller = 'adminhtml_billing';
        $this->_mode = 'edit';
    }

    public function getHeaderText()
    {
        if (Mage::registry('payment_data') && Mage::registry('payment_data')->getId())
        {
            return Mage::helper('marketplace')->__('Edit Payment for Supplier "%s" in Order "%s"', $this->escapeHtml(Mage::registry('payment_data')->getSupplierId()), $this->escapeHtml(Mage::registry('payment_data')->getOrderId()));
        } else {
            return Mage::helper('marketplace')->__('New Payment');
        }
    }

}