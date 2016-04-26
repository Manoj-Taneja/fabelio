<?php
class Tatvic_Uaee_Block_Uaee extends Mage_Core_Block_Template
{
    public function getAccountId()
    {
        return Mage::getStoreConfig('tatvic_uaee/general/account_id');
    }
	public function isActive()
    {
        if(Mage::getStoreConfigFlag('tatvic_uaee/general/enable')
            ){
                return true;
        }
        return false;
    }
	public function getBrandAttr(){
		
		return Mage::getStoreConfig('tatvic_uaee/ecommerce/brand') != "" ? Mage::getStoreConfig('tatvic_uaee/ecommerce/brand') : "";
	}
    public function isEcommerce()
    {
        $successPath =  Mage::getStoreConfig('tatvic_uaee/ecommerce/success_url') != "" ? Mage::getStoreConfig('tatvic_uaee/ecommerce/success_url') : '/checkout/onepage/success';
        if(Mage::getStoreConfigFlag('tatvic_uaee/general/enable')
            && strpos($this->getRequest()->getPathInfo(), $successPath) !== false){
                return true;
        }
        return false;
    }
    public function isCheckout()
    {
        $checkoutPath =  Mage::getStoreConfig('tatvic_uaee/ecommerce/checkout_url') != "" ?  Mage::getStoreConfig('tatvic_uaee/ecommerce/checkout_url') : '/checkout/onepage';
        if(Mage::getStoreConfigFlag('tatvic_uaee/general/enable')
            && strpos($this->getRequest()->getPathInfo(), $checkoutPath) !== false){
            return true;
        }
        return false;
    }
    public function getTransactionIdField()
    {
        return 'entity_id';
    }
    public function getProduct()
    {
        return Mage::registry('current_product');
    }
    public function getHomeId()
    {
        return Mage::getStoreConfig('tatvic_uaee/ecommerce/home_id') != '' ? Mage::getStoreConfig('tatvic_uaee/ecommerce/home_id') : '';
    }
}

