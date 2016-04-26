<?php
class Cminds_Marketplace_Block_Adminhtml_Customer_Edit extends Mage_Adminhtml_Block_Customer_Edit {
    public function __construct()
    {
        parent::__construct();

        if($this->isSupplier()) {
            $this->_updateButton('save', 'label', Mage::helper('customer')->__('Save Supplier'));
            $this->_updateButton('save', 'label', Mage::helper('customer')->__('Save Supplier'));
            $this->_updateButton('delete', 'label', Mage::helper('customer')->__('Delete Supplier'));
            $this->_removeButton('order');
        }
    }

    protected function isSupplier() {
        return Mage::helper('marketplace')->isSupplier(Mage::registry('current_customer')->getId());
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array($this->_objectId => $this->getRequest()->getParam($this->_objectId), 'supplier' => $this->isSupplier()));
    }

    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
        return $this->getUrl('*/' . $this->_controller . '/save', array('supplier' => $this->isSupplier()));
    }
}