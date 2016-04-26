<?php
require 'Mage/Checkout/controllers/OnepageController.php';
class Fabmod_Checkout_OnepageController extends Mage_Checkout_OnepageController
{
    public function saveBillingAction()
    {
        if (!Mage::helper('fabmod_checkout')->getHideShipping()){
            parent::saveBillingAction();
            return;
        }

        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('billing', array());
            $customerAddressId = $this->getRequest()->getPost('billing_address_id', false);

            if (isset($data['email'])) {
                $data['email'] = trim($data['email']);
            }
            $result = $this->getOnepage()->saveBilling($data, $customerAddressId);

            if (!isset($result['error'])) {
                /* check quote for virtual */
                if ($this->getOnepage()->getQuote()->isVirtual()) {
                    $result['goto_section'] = 'payment';
                    $result['update_section'] = array(
                        'name' => 'payment-method',
                        'html' => $this->_getPaymentMethodsHtml()
                    );
                } elseif (isset($data['use_for_shipping']) && $data['use_for_shipping'] == 1) {
                    //add default shipping method

                if($data['region_id'] == 489){
                  $result = $this->getOnepage()->saveShippingMethod('tablerate_bestway');
                }else{
                  $data = Mage::helper('fabmod_checkout')->getDefaultShippingMethod();
                  $result = $this->getOnepage()->saveShippingMethod($data);
                }
                  $this->getOnepage()->getQuote()->save();
                    /*
                    $result will have erro data if shipping method is empty
                    */
                    if(!$result) {
                        Mage::dispatchEvent('checkout_controller_onepage_save_shipping_method',
                            array('request'=>$this->getRequest(),
                                'quote'=>$this->getOnepage()->getQuote()));
                        $this->getOnepage()->getQuote()->collectTotals();
                        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));

                        $result['goto_section'] = 'payment';
                        $result['update_section'] = array(
                            'name' => 'payment-method',
                            'html' => $this->_getPaymentMethodsHtml()
                        );
                    }


                    $result['allow_sections'] = array('shipping');
                    $result['duplicateBillingInfo'] = 'true';
                } else {
                    $result['goto_section'] = 'shipping';
                }
            }

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
    public function saveShippingAction()
    {
        if (!Mage::helper('fabmod_checkout')->getHideShipping()){
            parent::saveShippingAction();
            return;
        }
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('shipping', array());
            $customerAddressId = $this->getRequest()->getPost('shipping_address_id', false);
            $result = $this->getOnepage()->saveShipping($data, $customerAddressId);

            if($data['region_id'] == 489){
              $result = $this->getOnepage()->saveShippingMethod('tablerate_bestway');
            }else{
              $data = Mage::helper('fabmod_checkout')->getDefaultShippingMethod();
              $result = $this->getOnepage()->saveShippingMethod($data);
            }
            $this->getOnepage()->getQuote()->save();

            if (!isset($result['error'])) {
                $result['goto_section'] = 'payment';
                $result['update_section'] = array(
                    'name' => 'payment-method',
                    'html' => $this->_getPaymentMethodsHtml()
                );
            }
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
}

