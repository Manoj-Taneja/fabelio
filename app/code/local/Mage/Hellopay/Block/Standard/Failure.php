<?php
/**
 * Copyright 2015 helloPay SINGAPORE PTE. LTD.
 *
 * Plugin Name: helloPay Magento Plugin
 * Plugin URI: https://www.magentocommerce.com/magento-connect/hellopay-magento-plugin-1-9-1_2.html
 * Description: helloPay Payment Gateway to pay via Credit Cards securely.
 * Version: 1.0.0
 * Author: helloPay SINGAPORE PTE. LTD.
 * Author URI: http://hellopay.com.sg
 * License: GPLv2
 * Failure Response From helloPay
 *
 * @category Mage
 * @package  Mage_Hellopay
 * @name     Mage_Hellopay_Block_Standard_Failure
 * @author   Hello Pay <info@hellopay.com>
 */

class Mage_Hellopay_Block_Standard_Failure extends Mage_Core_Block_Template
{


    /**
     *  Return StatusDetail field value from Response
     *
     * @return string
     */
    public function getErrorMessage()
    {
        $error = Mage::getSingleton('checkout/session')->getErrorMessage();
        Mage::getSingleton('checkout/session')->unsErrorMessage();
        return $error;

    }//end getErrorMessage()


    /**
     * Get continue shopping url
     */
    public function getContinueShoppingUrl()
    {
        return Mage::getUrl('checkout/cart');

    }//end getContinueShoppingUrl()


}//end class
