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
 * helloPay Configuration Model
 *
 * @category Mage
 * @package  Mage_Hellopay
 * @name     Mage_Hellopay_Model_Config
 * @author   Hello Pay <info@hellopay.com>
 */

class Mage_Hellopay_Model_Config extends Varien_Object
{


    /**
     *  Return config var
     *
     * @param  string Var key
     * @param  string Default value for non-existing key
     * @return mixed
     */
    public function getConfigData($key, $default=false)
    {
        if (!$this->hasData($key)) {
             $value = Mage::getStoreConfig('payment/hellopay_standard/'.$key);
            if (is_null($value) || false === $value) {
                $value = $default;
            }

            $this->setData($key, $value);
        }

        return $this->getData($key);

    }//end getConfigData()


    /**
     *  Return Store description sent to helloPay
     *
     * @return string Description
     */
    public function getDescription()
    {
        return $this->getConfigData('description');

    }//end getDescription()


    /**
     *  Return helloPay merchant password
     *
     * @return string Merchant password
     */
    public function getVendorPassword()
    {
        return $this->getConfigData('vendor_password');

    }//end getVendorPassword()


    /**
     *  Return working mode (see SELF::MODE_* constants)
     *
     * @return string Working mode
     */
    public function getMode()
    {
        return $this->getConfigData('mode');

    }//end getMode()


    /**
     *  Return new order status
     *
     * @return string New order status
     */
    public function getNewOrderStatus()
    {
        return $this->getConfigData('order_status');

    }//end getNewOrderStatus()


    /**
     *  Return debug flag
     *
     * @return boolean Debug flag (0/1)
     */
    public function getDebug()
    {
        return $this->getConfigData('debug_flag');

    }//end getDebug()


    /**
     *  Return key for simple XOR crypt, using Vendor encrypted password by helloPay
     *
     * @return string Key for simple XOR crypt
     */
    public function getCryptKey()
    {
        return $this->getVendorPassword();

    }//end getCryptKey()


    /**
     * Returns status of vendore notification
     *
     * @return bool
     */
    public function getVendorNotification()
    {
        return $this->getConfigData('vendor_notification');

    }//end getVendorNotification()


}//end class
