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
 * Redirect to helloPay
 *
 * @category Mage
 * @package  Mage_Hellopay
 * @name     Mage_Hellopay_Block_Standard_Redirect
 * @author   Hello Pay <info@hellopay.com>
 */

class Mage_Hellopay_Block_Standard_Redirect extends Mage_Core_Block_Abstract
{


    protected function _toHtml()
    {
        $standard     = Mage::getModel('hellopay/standard');
        $form         = new Varien_Data_Form();
        $checkout_url = (object) $standard->getHellopayUrl();
        if($checkout_url->result == 'success') {
            $form->setAction($checkout_url->redirect)
                ->setId('hellopay_standard_checkout')
                ->setName('hellopay_standard_checkout')
                ->setMethod('POST')
                ->setUseContainer(true);
            foreach ($standard->setOrder($this->getOrder())->getStandardCheckoutFormFields() as $field => $value) {
                $form->addField($field, 'hidden', array('name' => $field, 'value' => $value));
            }

            $html  = '<html><body>';
            $html .= $this->__('You will be redirected to helloPay in a few seconds.');
            $html .= $form->toHtml();
            $html .= '<script type="text/javascript">document.getElementById("hellopay_standard_checkout").submit();</script>';
            $html .= '</body></html>';
        }
        else{
            Mage::getSingleton('core/session')->addNotice($checkout_url->messages);
            $html  = '<html><body>';
            $html .= $this->__($checkout_url->messages);
            $html .= $form->toHtml();
            $html .= '<script type="text/javascript">history.back();</script>';
            $html .= '</body></html>';
        }//end if

        return $html;

    }//end _toHtml()


}//end class
