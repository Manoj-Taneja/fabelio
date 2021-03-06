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
 * helloPay Session Model
 *
 * @category Mage
 * @package  Mage_Hellopay
 * @name     Mage_Hellopay_Model_Session
 * @author   Hello Pay <info@hellopay.com>
 */

class Mage_Hellopay_Model_Session extends Mage_Core_Model_Session_Abstract
{


    public function __construct()
    {
        $this->init('hellopay');

    }//end __construct()


}
