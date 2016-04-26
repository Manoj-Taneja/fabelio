<?php
/**
 * Mexbs_Shipping_Block_Checkout_Onepage_Billing
 * class that is used for overriding the checkout billing block
 */
class Mexbs_Shipping_Block_Checkout_Onepage_Billing extends Mage_Checkout_Block_Onepage_Billing
{
    /**
     * retrieves whether the currently set address is valid
     *
     * @return bool
     */
    public function isValidAddress()
    {
        return Mage::helper("mexbs_shipping")->isValidAddress($this->getAddress(), 'billing');
    }
}