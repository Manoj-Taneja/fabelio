<?php
class Cminds_Marketplace_Block_Supplier_Rate_List extends Mage_Core_Block_Template {
    public function _construct() {
        $this->setTemplate('marketplace/customer/account/ratelist.phtml');
    }

    public function getCustomer() {
    	
    	if(Mage::getSingleton('customer/session')->isLoggedIn()) {
    		return Mage::getModel('customer/customer')->load(Mage::getSingleton('customer/session')->getId());
		}

		throw new Exception("No customer");
    }

    public function getAvailableSuppliers() {
    	$s = Mage::getModel('marketplace/torate')
    		->getCollection()
	    	->addFieldToFilter('main_table.customer_id', $this->getCustomer()->getId());

    	return $s;
    }
}