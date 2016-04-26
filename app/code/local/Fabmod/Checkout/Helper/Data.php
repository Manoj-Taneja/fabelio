<?php
class Fabmod_Checkout_Helper_Data extends Mage_Core_Helper_Abstract 
{
    const XML_HIDE_SHIPPING_PATH = 'checkout/options/hide_shipping';
    const XML_DEFAULT_SHIPPING_PATH = 'checkout/options/default_shipping';
    public function getHideShipping()
    {
        if (!Mage::getStoreConfigFlag(self::XML_HIDE_SHIPPING_PATH)){
            return false;
        }
        if (!$this->getDefaultShippingMethod()){
            return false;
        }
        return true;
    }
    public function getDefaultShippingMethod()
    {
        return Mage::getStoreConfig(self::XML_DEFAULT_SHIPPING_PATH);
    }
}
