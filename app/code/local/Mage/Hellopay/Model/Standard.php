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
 * helloPay Standard Model
 *
 * @category Mage
 * @package  Mage_Hellopay
 * @name     Mage_Hellopay_Model_Standard
 * @author   Hello Pay <info@hellopay.com>
 * @license  GPLv2
 */

require_once __DIR__.'/../src/HelloPay/autoload.php';

class Mage_Hellopay_Model_Standard extends Mage_Payment_Model_Method_Abstract
{
    protected $_code          = 'hellopay_standard';
    protected $_formBlockType = 'hellopay/standard_form';

    protected $_isGateway         = false;
    protected $_canAuthorize      = true;
    protected $_canCapture        = true;
    protected $_canCapturePartial = false;
    protected $_canRefund         = false;
    protected $_canVoid           = false;
    protected $_canUseInternal    = false;
    protected $_canUseCheckout    = true;
    protected $_canUseForMultishipping = false;

    protected $countryCode = '';
    protected $sslEnabled  = true;
    protected $apiUrl      = '';
    protected $api_key     = '';
    protected $_order      = null;


    public function __construct()
    {
        $this->api_key = $this->getConfigData('api_key');
        $this->apiUrl  = $this->getApiUrl();
        if($this->api_key) {
            // Shop config and requests setup for helloPay gateway
            $this->helloPay = new HelloPay\HelloPay(
                [
                 'shopConfig' => $this->api_key,
                 'apiUrl'     => $this->apiUrl,
                ]
            );

            $this->httpClient = new HelloPay\HttpClients\HelloPayCurlHttpClient(isset($this->sslEnabled) ? $this->sslEnabled : true);
        }

    }//end __construct()


    /**
     * Get helloPay API URL
     *
     * @return string helloPay URL
     */


    public function getApiUrl()
    {
        return $this->getConfigData('merchant_api_url');

    }//end getApiUrl()


    /**
     * Get Config model
     *
     * @return object Mage_Hellopay_Model_Config
     */
    public function getConfig()
    {
        return Mage::getSingleton('hellopay/config');

    }//end getConfig()


    /**
     * Return debug flag
     *
     * @return boolean
     */
    public function getDebug()
    {
        return $this->getConfig()->getDebug();

    }//end getDebug()


    /**
     * Return cart order id
     *
     * @return int
     */
    public function getOrderId()
    {
        return Mage::getSingleton('checkout/session')->getLastRealOrderId();

    }//end getOrderId()


    /**
     *  Returns Target URL
     *
     * @return string Target URL
     */
    public function getHellopayUrl()
    {
        $this->storeCurrencyCode = Mage::app()->getStore()->getBaseCurrencyCode();

        // get order country id
        $order_id = $this->getOrderId();
        $order    = Mage::getModel('sales/order')->loadByIncrementId($order_id);
        $merchantReferenceId = $order_id;
        $data = [];
        $data['priceAmount']         = Mage::helper('core')->currency($order->getGrandTotal(), false, false);
        $data['priceCurrency']       = $this->storeCurrencyCode;
        $data['description']         = "helloPay purchase create";
        $data['merchantReferenceId'] = $merchantReferenceId;
        $data['purchaseReturnUrl']   = $this->getSuccessURL();
        $data['purchaseCallbackUrl'] = $this->getCallbackURL();

        $data['shopConfig'] = $this->api_key;
        $data['apiUrl']     = $this->apiUrl;

        $data['basket'] = [];
        $data['basket']['basketItems'] = [];

        $items     = $order->getAllItems();
        $itemcount = count($items);

        foreach ($items as $itemId => $item)
        {
            $full_product = Mage::getModel('catalog/product')->load($item->getProductId());
            if($item->getPrice() > 0) {
                $data['basket']['basketItems'][] = array(
                                                    'name'      => $item->getName(),
                                                    'quantity'  => round($item->getQtyOrdered()),
                                                    'amount'    => round($item->getPrice() * $item->getQtyOrdered()),
                                                    'taxAmount' => 0,
                                                    'currency'  => $this->storeCurrencyCode,
                                                    'imageUrl'  => $full_product->getImageUrl(),
                                                   );
            }
        }

        $shipping_address = $order->getShippingAddress();
        $billing_address  = $order->getBillingAddress();
        if(!$shipping_address) {
            $shipping_address = $billing_address;
        }

        $totalAmount = ($order->getBaseShippingAmount() + $order->getSubtotal());
        $data['basket']['shipping']    = Mage::helper('core')->currency($order->getBaseShippingAmount(), false, false);
        $data['basket']['totalAmount'] = Mage::helper('core')->currency($totalAmount, false, false);
        $data['basket']['currency']    = $this->storeCurrencyCode;

        $data['billingAddress']['name']         = $billing_address->getFirstname().' '.$billing_address->getLastname();
        $data['billingAddress']['firstName']    = $billing_address->getFirstname();
        $data['billingAddress']['lastName']     = $billing_address->getLastname();
        $data['billingAddress']['addressLine1'] = $billing_address->getStreet(1);
        $data['billingAddress']['addressLine2'] = $billing_address->getStreet(2);
        $data['billingAddress']['province']     = $billing_address->getRegion();
        $data['billingAddress']['city']         = $billing_address->getCity();
        $data['billingAddress']['country']      = $billing_address->getCountry_id();
        $data['billingAddress']['mobilePhoneNumber'] = $billing_address->getTelephone();
        $data['billingAddress']['houseNumber']       = "";
        $data['billingAddress']['district']          = "";
        $data['billingAddress']['zip'] = $billing_address->getPostcode();

        $data['shippingAddress']['name']         = $shipping_address->getFirstname().' '.$shipping_address->getLastname();
        $data['shippingAddress']['firstName']    = $shipping_address->getFirstname();
        $data['shippingAddress']['lastName']     = $shipping_address->getLastname();
        $data['shippingAddress']['addressLine1'] = $billing_address->getStreet(1);
        $data['shippingAddress']['addressLine2'] = $billing_address->getStreet(2);
        $data['shippingAddress']['province']     = $shipping_address->getRegion();
        $data['shippingAddress']['city']         = $shipping_address->getCity();
        $data['shippingAddress']['country']      = $shipping_address->getCountry_id();
        $data['shippingAddress']['mobilePhoneNumber'] = $shipping_address->getTelephone();
        $data['shippingAddress']['houseNumber']       = "";
        $data['shippingAddress']['district']          = "";
        $data['shippingAddress']['zip'] = $shipping_address->getPostcode();

        $data['consumerData']['mobilePhoneNumber'] = $billing_address->getTelephone();
        $data['consumerData']['emailAddress']      = $billing_address->getEmail();
        $data['consumerData']['country']           = $billing_address->getCountry_id();
        $data['consumerData']['language']          = Mage::app()->getLocale()->getLocaleCode();
        $data['consumerData']['dateOfBirth']       = "";
        $data['consumerData']['gender']            = "";
        $data['consumerData']['ipAddress']         = Mage::helper('core/http')->getRemoteAddr();
        $data['consumerData']['name']      = $billing_address->getFirstname().' '.$billing_address->getLastname();
        $data['consumerData']['firstName'] = $billing_address->getFirstname();
        $data['consumerData']['lastName']  = $billing_address->getLastname();

        $data['additionalData']['platform'] = "Magento";

        try {
            $response = $this->helloPay->createPurchase($data);
            // Save purchase id in session variable
            $session = Mage::getSingleton("core/session",  array("name" => "frontend"));
            $session->setData("hpPurchaseId", $response->getpurchaseId());

            $dataView = array();
            if ($response) {
                $dataView['result']   = 'success';
                $dataView['redirect'] = $response->getCheckoutUrl();
                $dataView['messages'] = $this->helloPay->getLastMessage();
            } else {
                $dataView['result']   = 'failure';
                $dataView['messages'] = $this->helloPay->getLastMessage();
            }
        } catch (\HelloPay\Exceptions\HelloPaySDKException $e) {
            $dataView['result']   = 'failure';
            $dataView['messages'] = __('There was an error while creating new purchase. Please contact support team.');
        }

        return $dataView;

    }//end getHellopayUrl()


    /**
     *  Return URL for helloPay success response
     *
     * @return string URL
     */
    protected function getSuccessURL()
    {
        return Mage::getUrl('hellopay/standard/response');

    }//end getSuccessURL()


    /**
     *  Return URL for helloPay calback response
     *
     * @return string URL
     */
    protected function getCallbackURL()
    {
        $secretToken = $this->getConfigData('secret_token');
        return Mage::getUrl('hellopay/standard/callback/').'?token='.$secretToken;

    }//end getCallbackURL()


    /**
     * Transaction unique ID sent to helloPay and sent back by helloPay for order restore
     * Using created order ID
     *
     * @return string Transaction unique number
     */
    protected function getVendorTxCode()
    {
        return $this->getOrder()->getRealOrderId();

    }//end getVendorTxCode()


    /**
     *  Returns cart formatted
     *  String format:
     *  Number of lines:Name1:Quantity1:CostNoTax1:Tax1:CostTax1:Total1:Name2:Quantity2:CostNoTax2...
     *
     * @return string Formatted cart items
     */
    protected function getFormattedCart()
    {
        $order = Mage::getModel('sales/order')->loadByIncrementId($order_id);
        // $order->getSubtotal() ; $order->getGrandTotal() ;
        $items = $order->getAllItems();

        $resultParts = array();
        $totalLines  = 0;
        if ($items) {
            foreach($items as $item) {
                if ($item->getParentItem()) {
                    continue;
                }

                $quantity = $item->getQtyOrdered();

                $cost        = Mage::helper('core')->currency(($item->getBasePrice() - $item->getBaseDiscountAmount()), false, false);
                $tax         = Mage::helper('core')->currency($item->getBaseTaxAmount(), false, false);
                $costPlusTax = Mage::helper('core')->currency(($cost + $tax / $quantity), false, false);

                $totalCostPlusTax = Mage::helper('core')->currency(($quantity * $cost + $tax), false, false);

                $resultParts[] = str_replace(':', ' ', $item->getName());
                $resultParts[] = $quantity;
                $resultParts[] = $cost;
                $resultParts[] = $tax;
                $resultParts[] = $costPlusTax;
                $resultParts[] = $totalCostPlusTax;
                $totalLines++;
                // counting actual formatted items
            }//end foreach
        }//end if

        // add delivery
        $shipping = $this->getOrder()->getBaseShippingAmount();
        if ((int) $shipping > 0) {
            $totalLines++;
            $resultParts = array_merge($resultParts, array('Shipping', '', '', '', '', Mage::helper('core')->currency($shipping, false, false)));
        }

        $result = $totalLines.':'.implode(':', $resultParts);
        return $result;

    }//end getFormattedCart()


    /**
     *  Form block description
     *
     * @return object
     */
    public function createFormBlock($name)
    {
        $block = $this->getLayout()->createBlock('hellopay/form_standard', $name);
        $block->setMethod($this->_code);
        $block->setPayment($this->getPayment());
        return $block;

    }//end createFormBlock()


    /**
     *  Return Order Place Redirect URL
     *
     * @return string Order Redirect URL
     */
    public function getOrderPlaceRedirectUrl()
    {
        return Mage::getUrl('hellopay/standard/redirect');

    }//end getOrderPlaceRedirectUrl()


    /**
     *  Extract possible response values into array from query string
     *
     * @param  string Query string i.e. var1=value1&var2=value3...
     * @return array
     */
    protected function getToken($queryString)
    {

        // List the possible tokens
        $Tokens = array(
                   "Status",
                   "StatusDetail",
                   "VendorTxCode",
                   "VPSTxId",
                   "TxAuthNo",
                   "Amount",
                   "AVSCV2",
                   "AddressResult",
                   "PostCodeResult",
                   "CV2Result",
                   "GiftAid",
                  );

        // Initialise arrays
        $output      = array();
        $resultArray = array();

        // Get the next token in the sequence
        $c = count($Tokens);
        for ($i = ($c - 1); $i >= 0 ; $i--){
            // Find the position in the string
            $start = strpos($queryString, $Tokens[$i]);
            // If it's present
            if ($start !== false) {
                // Record position and token name
                $resultArray[$i]['start'] = $start;
                $resultArray[$i]['token'] = $Tokens[$i];
            }
        }

        // Sort in order of position
        sort($resultArray);

        // Go through the result array, getting the token values
        $c = count($resultArray);
        for ($i = 0; $i < $c; $i++){
            // Get the start point of the value
            $valueStart = ($resultArray[$i]['start'] + strlen($resultArray[$i]['token']) + 1);
            // Get the length of the value
            if ($i == ($c - 1)) {
                $output[$resultArray[$i]['token']] = substr($queryString, $valueStart);
            } else {
                $valueLength = ($resultArray[($i + 1)]['start'] - $resultArray[$i]['start'] - strlen($resultArray[$i]['token']) - 2);
                $output[$resultArray[$i]['token']] = substr($queryString, $valueStart, $valueLength);
            }
        }

        return $output;

    }//end getToken()


    /**
     *  Return Standard Checkout Form Fields for request to helloPay
     *
     * @return array Array of hidden form fields
     */
    public function getStandardCheckoutFormFields()
    {
        $order         = $this->getOrder();
        $amount        = $order->getBaseGrandTotal();
        $description   = Mage::app()->getStore()->getName().' '.' payment';
        $transactionId = $this->getVendorTxCode();

        $fields = array(
                   'total'        => Mage::helper('core')->currency($amount, false, false),
                   'memo'         => $description,
                   'success_url'  => $this->getSuccessURL(),
                   'callback_url' => $this->getCallbackURL(),
                   'merchant_ref' => $transactionId,
                  );
        return $fields;

    }//end getStandardCheckoutFormFields()


}//end class
