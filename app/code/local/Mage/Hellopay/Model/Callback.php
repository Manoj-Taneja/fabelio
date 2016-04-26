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
 * @category  Mage
 * @package   Mage_Hellopay
 * @name      Mage_Hellopay_Model_Callback
 * @author    Hello Pay <info@hellopay.com>
 * @copyright Copyright (c) 20016 helloPay SINGAPORE PTE. LTD. (http://www.hellopay.com.sg)
 * @license   http://opensource.org/licenses/osl-3.0.php
 */

class Mage_Hellopay_Model_Callback
{


    public function getCommentText()
    {
        $configSecretToken = '';
        $configSecretToken = Mage::getStoreConfig('payment/hellopay_standard/secret_token');

        if($configSecretToken == '') {
            $configSecretToken = md5(time());
        }

        return  Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'hellopay/standard/callback/?token='.$configSecretToken;

    }//end getCommentText()


}//end class
