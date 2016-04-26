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
 * Form Block
 *
 * @category Mage
 * @package  Mage_Hellopay
 * @name     Mage_Hellopay_Block_Standard_Form
 * @author   Hello Pay <info@hellopay.com>
 */


class Mage_Hellopay_Block_Standard_Form extends Mage_Payment_Block_Form
{


    protected function _construct()
    {
        $this->setTemplate('hellopay/standard/form.phtml');
        parent::_construct();

    }//end _construct()


}//end class
