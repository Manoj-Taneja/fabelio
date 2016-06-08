<?php
require 'Mage/Checkout/controllers/OnepageController.php';
class Fabmod_Checkout_OnepageController extends Mage_Checkout_OnepageController
{
    /**
     * Checkout page
     */
    public function indexAction()
    {
        if (!Mage::helper('checkout')->canOnepageCheckout()) {
            Mage::getSingleton('checkout/session')->addError($this->__('The onepage checkout is disabled.'));
            $this->_redirect('checkout/cart');
            return;
        }
        
        Mage::getSingleton('core/session')->unsShippingAmount();
        Mage::getSingleton('core/session')->unsShippingDescription();
        $quote = $this->getOnepage()->getQuote();
        if (!$quote->hasItems() || $quote->getHasError()) {
            $this->_redirect('checkout/cart');
            return;
        }
        if (!$quote->validateMinimumAmount()) {
            $error = Mage::getStoreConfig('sales/minimum_order/error_message') ?
                Mage::getStoreConfig('sales/minimum_order/error_message') :
                Mage::helper('checkout')->__('Subtotal must exceed minimum order amount');

            Mage::getSingleton('checkout/session')->addError($error);
            $this->_redirect('checkout/cart');
            return;
        }
        Mage::getSingleton('checkout/session')->setCartWasUpdated(false);
        Mage::getSingleton('customer/session')->setBeforeAuthUrl(Mage::getUrl('*/*/*', array('_secure' => true)));
        $this->getOnepage()->initCheckout();
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->getLayout()->getBlock('head')->setTitle($this->__('Checkout'));
        $this->renderLayout();
    }
    
    
    
    public function saveOrderAction()
    {
       
        if (!$this->_validateFormKey()) {
            $this->_redirect('*/*');
            return;
        }
       
        if ($this->_expireAjax()) {
            return;
        }

        $result = array();
        try {
            $requiredAgreements = Mage::helper('checkout')->getRequiredAgreementIds();
            $requiredAgreements = false;
            if ($requiredAgreements) {
                $postedAgreements = array_keys($this->getRequest()->getPost('agreement', array()));
                $diff = array_diff($requiredAgreements, $postedAgreements);
                if ($diff) {
                    $result['success'] = false;
                    $result['error'] = true;
                    $result['error_messages'] = $this->__('Please agree to all the terms and conditions before placing the order.');
                    $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
                    return;
                }
            }

            $data = $this->getRequest()->getPost('payment', array());
            if ($data) {
                $data['checks'] = Mage_Payment_Model_Method_Abstract::CHECK_USE_CHECKOUT
                    | Mage_Payment_Model_Method_Abstract::CHECK_USE_FOR_COUNTRY
                    | Mage_Payment_Model_Method_Abstract::CHECK_USE_FOR_CURRENCY
                    | Mage_Payment_Model_Method_Abstract::CHECK_ORDER_TOTAL_MIN_MAX
                    | Mage_Payment_Model_Method_Abstract::CHECK_ZERO_TOTAL;
                $this->getOnepage()->getQuote()->getPayment()->importData($data);
            }

            $this->getOnepage()->saveOrder();
            Mage::getSingleton('core/session')->unsShippingAmount();
            Mage::getSingleton('core/session')->unsShippingDescription();
            $redirectUrl = $this->getOnepage()->getCheckout()->getRedirectUrl();
            $result['success'] = true;
            $result['error']   = false;
        } catch (Mage_Payment_Model_Info_Exception $e) {
            $message = $e->getMessage();
            if (!empty($message)) {
                $result['error_messages'] = $message;
            }
            $result['goto_section'] = 'review';
            $result['update_section'] = array(
                'name' => 'review',
                'html' => $this->_getReviewHtml()
            );
        } catch (Mage_Core_Exception $e) {
            Mage::logException($e);
            Mage::helper('checkout')->sendPaymentFailedEmail($this->getOnepage()->getQuote(), $e->getMessage());
            $result['success'] = false;
            $result['error'] = true;
            $result['error_messages'] = $e->getMessage();

            $gotoSection = $this->getOnepage()->getCheckout()->getGotoSection();
            if ($gotoSection) {
                $result['goto_section'] = $gotoSection;
                $this->getOnepage()->getCheckout()->setGotoSection(null);
            }
            $updateSection = $this->getOnepage()->getCheckout()->getUpdateSection();
            if ($updateSection) {
                if (isset($this->_sectionUpdateFunctions[$updateSection])) {
                    $updateSectionFunction = $this->_sectionUpdateFunctions[$updateSection];
                    $result['update_section'] = array(
                        'name' => $updateSection,
                        'html' => $this->$updateSectionFunction()
                    );
                }
                $this->getOnepage()->getCheckout()->setUpdateSection(null);
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::helper('checkout')->sendPaymentFailedEmail($this->getOnepage()->getQuote(), $e->getMessage());
            $result['success']  = false;
            $result['error']    = true;
            $result['error_messages'] = $this->__('There was an error processing your order. Please contact us or try again later.');
        }
        //$this->getOnepage()->getQuote()->save();
        /**
         * when there is redirect to third party, we don't want to save order yet.
         * we will save the order in return action.
         */
        if (isset($redirectUrl)) {
            $result['redirect'] = $redirectUrl;
            $this->getOnepage()->getQuote()->setIsActive(1) ;
        }
        $this->getOnepage()->getQuote()->save();
        
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
    
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
                        $result['allow_sections'] = array('review');
                        $result['goto_section'] = 'review';
                        $result['update_section'] = array(
                            'name' => 'review',
                            'html' => $this->_getReviewHtml()
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
                
                $result['goto_section'] = 'review';
                $result['update_section'] = array(
                    'name' => 'review',
                    'html' => $this->_getReviewHtml()
                );
               
            }            
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
    
    
    public function updateOrderReviewAction(){
       
        if ($this->_expireAjax()) {
            return;
        }
            $return_array = array();
            $shipping_amount_array = array();
            $shipping_amount = 0;
            $_coreHelper = Mage::helper('core');
            $items = Mage::getSingleton('checkout/session')->getQuote();
            $id=$_POST['pk'];
            Mage::getSingleton('core/session')->set($shippingPrice);
            $flatrate_model = Mage::getModel('shipping/carrier_flatrate');
            $result = $flatrate_model->collectRates($items, $id);
            $shipping_amount_array = Mage::getSingleton('core/session')->getShippingAmount();           
            $shipping_amount = array_sum($shipping_amount_array);
            Mage::getSingleton('checkout/session')->getQuote()->getShippingAddress()->setShippingAmount($shipping_amount);
            Mage::getSingleton('checkout/session')->getQuote()->setShippingAmount($shipping_amount);
            $totals = Mage::getSingleton('checkout/session')->getQuote()->getTotals();
            Mage::getSingleton('checkout/session')->getQuote()->save();
            $subtotal = round($totals["subtotal"]->getValue());
            $grandtotal = round($totals["grand_total"]->getValue());
            $grandtotal_final = 0;
            $grandtotal_final = $grandtotal + $shipping_amount;
            Mage::getSingleton('checkout/session')->getQuote()->setGrandTotal($grandtotal);
            $return_html ='<tr class="first">
                                <td colspan="4" class="a-right" style="">Subtotal</td>
                                <td class="a-right last" style="">
                                    <span class="price">'.$_coreHelper->formatPrice($subtotal, false).'</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="a-right" style="">
                                    Shipping &amp; Handling        </td>
                                <td class="a-right last" style="">
                                    '.$_coreHelper->formatPrice($shipping_amount, false).'    </td>
                            </tr>
                            <tr class="last">
                            <td colspan="4" class="a-right" style="">
                                <strong>Grand Total</strong>
                            </td>
                            <td class="a-right last" style="">
                                <strong>'.$_coreHelper->formatPrice($grandtotal_final, false).'</strong>
                            </td>
                            </tr>';
             $shipping_method_html = 'Shipping &amp; Handling - Express '.$_coreHelper->formatPrice($shipping_amount, false).' ';
             $return_array['subtotal_string']=$return_html;
             $return_array['shipping_method']=$shipping_method_html;
             $return_array_string = json_encode($return_array);
            echo $return_array_string;
            exit;
    }
    
    
    protected function _getReviewHtml()
    {
        
        return $this->getLayout()->getBlock('root');
    }
    
    protected function _getReviewNewHtml()
    {
        
        return $this->getLayout()->getBlock('root')->toHtml();
    }
    
    public function goPaymentAction(){
     
        if ($this->_expireAjax()) {
            return;
        }
         $result['goto_section'] = 'payment';
                    $result['update_section'] = array(
                        'name' => 'payment-method',
                        'html' => $this->_getPaymentMethodsHtml()
                    );
                    $result = Mage::helper('core')->jsonEncode($result);
                   
                    echo $result;
                    exit;
    }
    
    /**
     * Save payment ajax action
     *
     * Sets either redirect or a JSON response
     */
    public function savePaymentAction()
    {
        if ($this->_expireAjax()) {
            return;
        }
        try {
            if (!$this->getRequest()->isPost()) {
                $this->_ajaxRedirectResponse();
                return;
            }
            
            $data = $this->getRequest()->getPost('payment', array());
            $result = $this->getOnepage()->savePayment($data);

            // get section and redirect data
            $redirectUrl = $this->getOnepage()->getQuote()->getPayment()->getCheckoutRedirectUrl();
            if (empty($result['error']) && !$redirectUrl) {
                $this->loadLayout('checkout_onepage_review');
                $result['goto_section'] = 'review';
                $result['update_section'] = array(
                    'name' => 'review',
                    'html' => $this->_getReviewNewHtml()
                );
            }
            if ($redirectUrl) {
                $result['redirect'] = $redirectUrl;
            }
        } catch (Mage_Payment_Exception $e) {
            if ($e->getFields()) {
                $result['fields'] = $e->getFields();
            }
            $result['error'] = $e->getMessage();
        } catch (Mage_Core_Exception $e) {
            $result['error'] = $e->getMessage();
        } catch (Exception $e) {
            Mage::logException($e);
            $result['error'] = $this->__('Unable to set Payment Method.');
        }
      
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
    
    
    
  
    
    
     /**
     * Order success action
     */
    public function successAction()
    {
        $session = $this->getOnepage()->getCheckout();
        
        if (!$session->getLastSuccessQuoteId()) {
            $this->_redirect('checkout/cart');
            return;
        }

        $lastQuoteId = $session->getLastQuoteId();
        $lastOrderId = $session->getLastOrderId();
        $lastRecurringProfiles = $session->getLastRecurringProfileIds();
        if (!$lastQuoteId || (!$lastOrderId && empty($lastRecurringProfiles))) {
            $this->_redirect('checkout/cart');
            return;
        }

        /* Start CPS action checkout */
        $cps = $_COOKIE['priceareacashback_id'];

        @session_start();
        if(!empty($cps)){

            $order = Mage::getModel('sales/order')->load($lastOrderId);
            $orderData = $order->getData();

            /* START Insert to  table sales_flat_order */

            $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
            $connection->beginTransaction();
            $__fields = array();
            $__fields['cbpa'] = $cps;
            $__where = $connection->quoteInto('entity_id =?', $orderData['entity_id']);
            $connection->update('sales_flat_order', $__fields, $__where);
            $connection->commit();

            /* END Insert to  table sales_flat_order */

            $grandTotal = $orderData['grand_total'];

            $valCashback = $grandTotal * (3/100);
            /* Mengambil Value Cookie */
            $idTrans = $cps;

            /* Menghapus Cookie */
            setcookie("priceareacashback_id", "", time() - (86400*30));
            $link = 'http://api.pricearea.com/push.php';
            $apiKEY = '123123123';
            $apiAPP = 'APP01';
            /* Mengirim data ke API Pricearea.com menggunakan curl pada PHP */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $link);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "app_key=".$apiKEY."&app_id=".$apiAPP."&value=".$lastOrderId."&cashback=".$valCashback."&idtracking=".$idTrans."&action=checkout");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            /* umpan balik dari request API disimpan pada variable result */
            $result = curl_exec($ch);
            curl_close($ch);
        }

        /* End CPS action checkout */

        $session->clear();
        $this->loadLayout();
        $this->_initLayoutMessages('checkout/session');
        Mage::dispatchEvent('checkout_onepage_controller_success_action', array('order_ids' => array($lastOrderId)));
        $this->renderLayout();
    }
    
}

