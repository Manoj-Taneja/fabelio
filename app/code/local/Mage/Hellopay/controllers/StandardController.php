<?php
/**
 * Copyright 2015 helloPay SINGAPORE PTE. LTD.
 *
 * Plugin Name: helloPay Magento Plugin
 * Plugin URI: https://www.magentocommerce.com/magento-connect/hellopay-magento/
 * Description: helloPay Payment Gateway to pay via Credit Cards securely.
 * Version: 1.0.0
 * PHP Version 5
 * Author: helloPay SINGAPORE PTE. LTD.
 * Author URI: http://hellopay.com.sg
 * License: GPLv2
 * helloPay Standard Front Controller
 *
 * @category Mage
 * @package  Mage_Hellopay
 * @name     Mage_Hellopay_StandardController
 * @author   Hello Pay <info@hellopay.com>
 */

require_once __DIR__.'/../src/HelloPay/autoload.php';

class Mage_Hellopay_StandardController extends Mage_Core_Controller_Front_Action
{
    public $isValidResponse = false;


    /**
     * Get singleton with helloPay strandard
     *
     * @return object
     */
    public function getStandard()
    {
        return Mage::getSingleton('hellopay/standard');

    }//end getStandard()


    /**
     * Get Config model
     *
     * @return object
     */
    public function getConfig()
    {
        return $this->getStandard()->getConfig();

    }//end getConfig()


    /**
     *  Return debug flag
     *
     * @return boolean
     */
    public function getDebug()
    {
        return $this->getStandard()->getDebug();

    }//end getDebug()


    /**
     * When a customer chooses helloPay on Checkout/Payment page
     *
     * @return void
     */
    public function redirectAction()
    {

        $session = Mage::getSingleton('checkout/session');
        $session->setHellopayStandardQuoteId($session->getQuoteId());

        $order = Mage::getModel('sales/order');
        $order->loadByIncrementId($session->getLastRealOrderId());
        $order->addStatusToHistory(
            $order->getStatus(),
            Mage::helper('hellopay')->__('Customer was redirected to helloPay')
        );
        $order->save();

        $this->getResponse()
            ->setBody(
                $this->getLayout()
                    ->createBlock('hellopay/standard_redirect')
                    ->setOrder($order)
                    ->toHtml()
            );

        $session->unsQuoteId();

    }//end redirectAction()


    /**
     *  Success response from helloPay
     *
     * @return void
     */
    public function responseAction()
    {
        // Load session library
        $session = Mage::getSingleton("core/session",  array("name" => "frontend"));

        $this->preResponse();
        if (!$this->isValidResponse) {
            $this->_redirect('');
            return ;
        }

        $order_id = Mage::getModel('hellopay/Standard')
        ->getOrderId();
        if($order_id)
        {
          $newOrderId = Mage::getModel('sales/order')->loadByIncrementId($order_id)->getId();
          Mage::log("inc=".$order_id." order id=".$newOrderId,null,"hellolog.log");
        }
        $HELLOPAY_PURCHASE_ID = $session->getData("hpPurchaseId");
        $status = $this->getRequest()->getParam('paymentStatus');
               if ($newOrderId > 0) {
            switch ($status) {
            case 'Success':
                $this->orderSuccessProcess($order_id);
                break;
            default:
                // Cancelled, Failed , Pending
                // Reopen card if Payment failed or canceled by user.
                $this->addOrderInItems($status);
                break;
            }
        }

    }//end responseAction()


    /**
     *  Save items in cart
     *
     * @param  Mage_Sales_Model_Order $order_id
     * @return void
     */


    public function orderSuccessProcess($order_id)
    {
        // Load session library
        $session = Mage::getSingleton("core/session",  array("name" => "frontend"));
        $HELLOPAY_PURCHASE_ID = $session->getData("hpPurchaseId");
        $session = Mage::getSingleton("core/session",  array("name" => "frontend"));
        try {
            $order = Mage::getModel('sales/order')->loadByIncrementId($order_id);
            if (!$order->getId()) {
                /*
                    * need to have logic when there is no order with the order id from helloPay
                 */
                return false;
            }

            $config        = Mage::getModel('hellopay/Config');
            $this->apiUrl  = $config->getConfigData('merchant_api_url');
            $this->api_key = $config->getConfigData('api_key');

            // Shop config and requests setup for helloPay gateway
            $this->helloPay = new HelloPay\HelloPay(
                [
                 'shopConfig' => $this->api_key,
                 'apiUrl'     => $this->apiUrl,
                ]
            );

            // Get the order status from helloPay
            $order->addStatusToHistory(
                $order->getStatus(),
                Mage::helper('hellopay')->__('Customer successfully returned from helloPay')
            );

            $response = $this->helloPay->getTransactionEvents(
                array(
                 'transactionId'   => $HELLOPAY_PURCHASE_ID,
                 'transactionType' => 'Purchase',
                )
            );

            if ($this->getDebug()) {
                try {
                    Mage::getModel('hellopay/api_debug')
                        ->setResponseBody(json_encode($response, 1))
                        ->save();
                } catch (Exception $e) {
                    Mage::log($e->getMessage(), null, 'hellPaylogs.log', true);
                    Mage::log('#'.$order_id.json_encode($response), null, 'hellPaylogs.log', true);
                }//end try
            }

            $order_base_grand_total = sprintf('%.2f', $order->getBaseGrandTotal());
            if ($order_base_grand_total <= 0 || $order_base_grand_total == null) {
                // cancel order
                $order->cancel();
                $order->addStatusToHistory(
                    $order->getStatus(),
                    Mage::helper('sagepayform')->__('Order total amount does not match helloPay gross total amount')
                );
            }

            if ($response && $response->isCompleted()) {
                $order->sendNewOrderEmail();
                $order->getPayment()->setTransactionId($order_id);
                if ($this->saveInvoice($order)) {
                    $order->setState(Mage_Sales_Model_Order::STATE_COMPLETE, true);
                } else {
                    $newOrderStatus = $this->getConfig()->getNewOrderStatus() ? $this->getConfig()->getNewOrderStatus() : Mage_Sales_Model_Order::STATE_NEW;
                }

                $order->save();
                $session = Mage::getSingleton('checkout/session');
                $session->setQuoteId($session->getHellopayStandardQuoteId(true));
                Mage::getSingleton('checkout/session')->getQuote()->setIsActive(false)->save();
                $this->_redirect('checkout/onepage/success');
            } else if($response && $response->isCommitted()) {
                $order->getPayment()->setTransactionId($order_id);
                if ($this->saveInvoice($order)) {
                    $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
                }

                $order->save();
                $session = Mage::getSingleton('checkout/session');
                $session->setQuoteId($session->getHellopayStandardQuoteId(true));
                Mage::getSingleton('checkout/session')->getQuote()->setIsActive(false)->save();
                $this->_redirect('checkout/onepage/success');
            }  else {
                Mage::getSingleton('core/session')->addSuccess(__('Thank you. Your transaction is under process. We will place order after transaction is confirmed'));
                $this->_redirect('customer/account/');
            }//end if
        } catch (\HelloPay\Exceptions\HelloPaySDKException $e) {
            Mage::getSingleton('core/session')->addNotice(__('helloPay :: ERROR FETCHING TRANSACTION EVENTS! ').$e->getMessage());
        }//end try

    }//end orderSuccessProcess()


    /**
     *  Save items in cart
     *
     * @param  Mage_Sales_Model_Order $order
     * @return void
     */


    public function addOrderInItems($status = 'Failed')
    {
        $order   = Mage::registry('current_order');
        $session = Mage::getSingleton('checkout/session');
        $session->setHellopayStandardQuoteId($session->getQuoteId());

        $order = Mage::getModel('sales/order');
        $order->loadByIncrementId($session->getLastRealOrderId());

        if($status == 'Cancelled') {
            $order_id = Mage::getModel('hellopay/Standard')
            ->getOrderId();
            $order->getPayment()->setTransactionId($order_id);
            $order->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, 'Cancel Transaction.');
            $order->setStatus("canceled");

            $order->save();
            $session = Mage::getSingleton('checkout/session');
            $session->setQuoteId($session->getHellopayStandardQuoteId(true));
            Mage::getSingleton('checkout/session')->getQuote()->setIsActive(false)->save();
        }

        $cart          = Mage::getSingleton('checkout/cart');
        $cartTruncated = false;
        // @var $cart Mage_Checkout_Model_Cart
        $items = $order->getItemsCollection();
        foreach ($items as $item) {
            try {
                $cart->addOrderItem($item);
            } catch (Mage_Core_Exception $e){
                if (Mage::getSingleton('checkout/session')->getUseNotice(true)) {
                    Mage::getSingleton('checkout/session')->addNotice($e->getMessage());
                }
                else {
                    Mage::getSingleton('checkout/session')->addError($e->getMessage());
                }

                $this->_redirect('*/*/history');
            } catch (Exception $e) {
                Mage::getSingleton('checkout/session')->addException(
                    $e,
                    Mage::helper('checkout')->__('Cannot add the item to shopping cart.')
                );
                $this->_redirect('checkout/cart');
            }
        }

        $cart->save();
        Mage::getSingleton('core/session')->addNotice(__('Transaction '.$status.'.'));
        $this->_redirect('checkout/cart');

    }//end addOrderInItems()


    /**
     *  Save invoice for order
     *
     * @param  Mage_Sales_Model_Order $order
     * @return boolean Can save invoice or not
     */
    protected function saveInvoice(Mage_Sales_Model_Order $order)
    {
        if ($order->canInvoice()) {
            $invoice = $order->prepareInvoice();

            $invoice->register()->capture();
            Mage::getModel('core/resource_transaction')
               ->addObject($invoice)
               ->addObject($invoice->getOrder())
               ->save();
            return true;
        }

        return false;

    }//end saveInvoice()


    /**
     *  Callback URL from helloPay
     *
     * @return void
     */
    public function callbackAction()
    {
        // Load Model
        $config   = Mage::getModel('hellopay/Config');
        $Standard = Mage::getModel('hellopay/Standard');
        $token    = $this->getRequest()->getParam('token');

        $this->apiUrl  = $config->getConfigData('merchant_api_url');
        $this->api_key = $config->getConfigData('api_key');
        // Shop config and requests setup for helloPay gateway
        $this->helloPay = new HelloPay\HelloPay(
            [
             'shopConfig' => $this->api_key,
             'apiUrl'     => $this->apiUrl,
            ]
        );

        if($this->getRequest()->isPost()) {
            $postData = file_get_contents('php://input');
            $response = $this->helloPay->parseNotificationPayload($postData);

            if ($response && is_array($response)) {
                foreach ($response as $item) {
                    $this->processResponse($item);
                }
            }
        }

    }//end callbackAction()


    /**
     *  Process Callback Response
     *
     * @param  Response from sever $response
     * @return void
     */
    protected function processResponse($response)
    {

        $order_id = $response->getMerchantReferenceId();
        $order    = Mage::getModel('sales/order')->loadByIncrementId($order_id);

        if ($order->getStatus() != 'complete') {
            $new_status = $response->getNewStatus();
            Mage::log('#'.$order_id.'- callback called status: '.$new_status, null, 'hellPaylogs.log', true);
            $order->getPayment()->setTransactionId($order_id);
            switch ($new_status) {
            case 'Cancelled':
            case 'Failed':
            case 'Expired':
                $order->setData('state', Mage_Sales_Model_Order::STATE_CLOSED, true);
                $order->save();
                if ($this->saveInvoice($order)) {
                    $order->sendNewOrderEmail();
                }

                Mage::log('#'.$order_id.' order has failed.', null, 'hellPaylogs.log', true);
                break;
            case 'Completed':
                $order->setData('state', Mage_Sales_Model_Order::STATE_COMPLETE, true);
                $order->save();

                if ($this->saveInvoice($order)) {
                    $order->sendNewOrderEmail();
                }

                Mage::log('#'.$order_id.' order is complete by callback.', null, 'hellPaylogs.log', true);
                break;
            }//end switch
        }//end if

    }//end processResponse()


    /**
     *  Expected GET HTTP Method
     *
     * @return void
     */
    protected function preResponse()
    {
        $this->responseArr     = $this->getRequest()->getPost();
        $this->isValidResponse = true;

    }//end preResponse()


    /**
     *  Failure Action
     *
     * @return void
     */
    public function failureAction()
    {
        $session = Mage::getSingleton('checkout/session');

        if (!$session->getErrorMessage()) {
            $this->_redirect('checkout/cart');
            return;
        }

        $this->loadLayout();
        $this->_initLayoutMessages('hellopay/session');
        $this->renderLayout();

    }//end failureAction()

}//end class
