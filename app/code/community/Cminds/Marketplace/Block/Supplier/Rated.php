<?php
class Cminds_Marketplace_Block_Supplier_Rated extends Mage_Core_Block_Template {
    public function _construct() {
        $this->setTemplate('marketplace/customer/account/rated.phtml');
    }

    public function getCustomer() {

        if(Mage::getSingleton('customer/session')->isLoggedIn()) {
            return Mage::getModel('customer/customer')->load(Mage::getSingleton('customer/session')->getId());
        }

        throw new Exception("No customer");
    }

    public function getRates() {
        $s = Mage::getModel('marketplace/rating')
            ->getCollection()
            ->addFieldToFilter('customer_id', $this->getCustomer()->getId());

        return $s;
    }
}