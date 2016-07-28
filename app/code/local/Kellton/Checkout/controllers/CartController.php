<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Shopping cart controller
 */
require 'Mage/Checkout/controllers/CartController.php';
class Kellton_Checkout_CartController extends Mage_Core_Controller_Front_Action
{
    /**
     * Action list where need check enabled cookie
     *
     * @var array
     */
    protected $_cookieCheckActions = array('add');

    /**
     * Retrieve shopping cart model object
     *
     * @return Mage_Checkout_Model_Cart
     */
    protected function _getCart()
    {
        return Mage::getSingleton('checkout/cart');
    }

    /**
     * Get checkout session model instance
     *
     * @return Mage_Checkout_Model_Session
     */
    protected function _getSession()
    {
        return Mage::getSingleton('checkout/session');
    }

    /**
     * Get current active quote instance
     *
     * @return Mage_Sales_Model_Quote
     */
    protected function _getQuote()
    {
        return $this->_getCart()->getQuote();
    }

    /**
     * Set back redirect url to response
     *
     * @return Mage_Checkout_CartController
     * @throws Mage_Exception
     */
    protected function _goBack()
    {
        $returnUrl = $this->getRequest()->getParam('return_url');
        if ($returnUrl) {

            if (!$this->_isUrlInternal($returnUrl)) {
                throw new Mage_Exception('External urls redirect to "' . $returnUrl . '" denied!');
            }

            $this->_getSession()->getMessages(true);
            $this->getResponse()->setRedirect($returnUrl);
        } elseif (!Mage::getStoreConfig('checkout/cart/redirect_to_cart')
            && !$this->getRequest()->getParam('in_cart')
            && $backUrl = $this->_getRefererUrl()
        ) {
            $this->getResponse()->setRedirect($backUrl);
        } else {
            if (($this->getRequest()->getActionName() == 'add') && !$this->getRequest()->getParam('in_cart')) {
                $this->_getSession()->setContinueShoppingUrl($this->_getRefererUrl());
            }
            $this->_redirect('checkout/cart');
        }
        return $this;
    }

    /**
     * Initialize product instance from request data
     *
     * @return Mage_Catalog_Model_Product || false
     */
    protected function _initProduct()
    {
        $productId = (int) $this->getRequest()->getParam('product');
        if ($productId) {
            $product = Mage::getModel('catalog/product')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($productId);
            if ($product->getId()) {
                return $product;
            }
        }
        return false;
    }

    /**
     * Shopping cart display action
     */
    public function indexAction()
    {
        $cart = $this->_getCart();
         Mage::getSingleton('core/session')->unsShippingAmount();
         Mage::getSingleton('core/session')->unsShippingDescription();
        if ($cart->getQuote()->getItemsCount()) {
            $cart->init();
            $cart->save();

            if (!$this->_getQuote()->validateMinimumAmount()) {
                $minimumAmount = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())
                    ->toCurrency(Mage::getStoreConfig('sales/minimum_order/amount'));

                $warning = Mage::getStoreConfig('sales/minimum_order/description')
                    ? Mage::getStoreConfig('sales/minimum_order/description')
                    : Mage::helper('checkout')->__('Minimum order amount is %s', $minimumAmount);

                $cart->getCheckoutSession()->addNotice($warning);
            }
        }

        // Compose array of messages to add
        $messages = array();
        foreach ($cart->getQuote()->getMessages() as $message) {
            if ($message) {
                // Escape HTML entities in quote message to prevent XSS
                $message->setCode(Mage::helper('core')->escapeHtml($message->getCode()));
                $messages[] = $message;
            }
        }
        $cart->getCheckoutSession()->addUniqueMessages($messages);

        /**
         * if customer enteres shopping cart we should mark quote
         * as modified bc he can has checkout page in another window.
         */
        $this->_getSession()->setCartWasUpdated(true);

        Varien_Profiler::start(__METHOD__ . 'cart_display');
        $this
            ->loadLayout()
            ->_initLayoutMessages('checkout/session')
            ->_initLayoutMessages('catalog/session')
            ->getLayout()->getBlock('head')->setTitle($this->__('Shopping Cart'));
        $this->renderLayout();
        Varien_Profiler::stop(__METHOD__ . 'cart_display');
    }

    /**
     * Add product to shopping cart action
     *
     * @return Mage_Core_Controller_Varien_Action
     * @throws Exception
     */
    public function addAction()
    {
        if (!$this->_validateFormKey()) {
            $this->_goBack();
            return;
        }
        $cart   = $this->_getCart();
        $params = $this->getRequest()->getParams();
        try {
            if (isset($params['qty'])) {
                $filter = new Zend_Filter_LocalizedToNormalized(
                    array('locale' => Mage::app()->getLocale()->getLocaleCode())
                );
                $params['qty'] = $filter->filter($params['qty']);
            }

            $product = $this->_initProduct();
            $related = $this->getRequest()->getParam('related_product');

            /**
             * Check product availability
             */
            if (!$product) {
                $this->_goBack();
                return;
            }

            $cart->addProduct($product, $params);
            if (!empty($related)) {
                $cart->addProductsByIds(explode(',', $related));
            }

            $cart->save();

            $this->_getSession()->setCartWasUpdated(true);

            /**
             * @todo remove wishlist observer processAddToCart
             */
            Mage::dispatchEvent('checkout_cart_add_product_complete',
                array('product' => $product, 'request' => $this->getRequest(), 'response' => $this->getResponse())
            );

            if (!$this->_getSession()->getNoCartRedirect(true)) {
                if (!$cart->getQuote()->getHasError()) {
                    $message = $this->__('%s was added to your shopping cart.', Mage::helper('core')->escapeHtml($product->getName()));
                    $this->_getSession()->addSuccess($message);
                }
                $this->_goBack();
            }
        } catch (Mage_Core_Exception $e) {
            if ($this->_getSession()->getUseNotice(true)) {
                $this->_getSession()->addNotice(Mage::helper('core')->escapeHtml($e->getMessage()));
            } else {
                $messages = array_unique(explode("\n", $e->getMessage()));
                foreach ($messages as $message) {
                    $this->_getSession()->addError(Mage::helper('core')->escapeHtml($message));
                }
            }

            $url = $this->_getSession()->getRedirectUrl(true);
            if ($url) {
                $this->getResponse()->setRedirect($url);
            } else {
                $this->_redirectReferer(Mage::helper('checkout/cart')->getCartUrl());
            }
        } catch (Exception $e) {
            $this->_getSession()->addException($e, $this->__('Cannot add the item to shopping cart.'));
            Mage::logException($e);
            $this->_goBack();
        }
    }

    /**
     * Add products in group to shopping cart action
     */
    public function addgroupAction()
    {
        $orderItemIds = $this->getRequest()->getParam('order_items', array());

        if (!is_array($orderItemIds) || !$this->_validateFormKey()) {
            $this->_goBack();
            return;
        }

        $itemsCollection = Mage::getModel('sales/order_item')
            ->getCollection()
            ->addIdFilter($orderItemIds)
            ->load();
        /* @var $itemsCollection Mage_Sales_Model_Mysql4_Order_Item_Collection */
        $cart = $this->_getCart();
        foreach ($itemsCollection as $item) {
            try {
                $cart->addOrderItem($item, 1);
            } catch (Mage_Core_Exception $e) {
                if ($this->_getSession()->getUseNotice(true)) {
                    $this->_getSession()->addNotice($e->getMessage());
                } else {
                    $this->_getSession()->addError($e->getMessage());
                }
            } catch (Exception $e) {
                $this->_getSession()->addException($e, $this->__('Cannot add the item to shopping cart.'));
                Mage::logException($e);
                $this->_goBack();
            }
        }
        $cart->save();
        $this->_getSession()->setCartWasUpdated(true);
        $this->_goBack();
    }

    /**
     * Action to reconfigure cart item
     */
    public function configureAction()
    {
        // Extract item and product to configure
        $id = (int) $this->getRequest()->getParam('id');
        $quoteItem = null;
        $cart = $this->_getCart();
        if ($id) {
            $quoteItem = $cart->getQuote()->getItemById($id);
        }

        if (!$quoteItem) {
            $this->_getSession()->addError($this->__('Quote item is not found.'));
            $this->_redirect('checkout/cart');
            return;
        }

        try {
            $params = new Varien_Object();
            $params->setCategoryId(false);
            $params->setConfigureMode(true);
            $params->setBuyRequest($quoteItem->getBuyRequest());

            Mage::helper('catalog/product_view')->prepareAndRender($quoteItem->getProduct()->getId(), $this, $params);
        } catch (Exception $e) {
            $this->_getSession()->addError($this->__('Cannot configure product.'));
            Mage::logException($e);
            $this->_goBack();
            return;
        }
    }

    /**
     * Update product configuration for a cart item
     */
    public function updateItemOptionsAction()
    {
        $cart   = $this->_getCart();
        $id = (int) $this->getRequest()->getParam('id');
        $params = $this->getRequest()->getParams();

        if (!isset($params['options'])) {
            $params['options'] = array();
        }
        try {
            if (isset($params['qty'])) {
                $filter = new Zend_Filter_LocalizedToNormalized(
                    array('locale' => Mage::app()->getLocale()->getLocaleCode())
                );
                $params['qty'] = $filter->filter($params['qty']);
            }

            $quoteItem = $cart->getQuote()->getItemById($id);
            if (!$quoteItem) {
                Mage::throwException($this->__('Quote item is not found.'));
            }

            $item = $cart->updateItem($id, new Varien_Object($params));
            if (is_string($item)) {
                Mage::throwException($item);
            }
            if ($item->getHasError()) {
                Mage::throwException($item->getMessage());
            }

            $related = $this->getRequest()->getParam('related_product');
            if (!empty($related)) {
                $cart->addProductsByIds(explode(',', $related));
            }

            $cart->save();

            $this->_getSession()->setCartWasUpdated(true);

            Mage::dispatchEvent('checkout_cart_update_item_complete',
                array('item' => $item, 'request' => $this->getRequest(), 'response' => $this->getResponse())
            );
            if (!$this->_getSession()->getNoCartRedirect(true)) {
                if (!$cart->getQuote()->getHasError()) {
                    $message = $this->__('%s was updated in your shopping cart.', Mage::helper('core')->escapeHtml($item->getProduct()->getName()));
                    $this->_getSession()->addSuccess($message);
                }
                $this->_goBack();
            }
        } catch (Mage_Core_Exception $e) {
            if ($this->_getSession()->getUseNotice(true)) {
                $this->_getSession()->addNotice($e->getMessage());
            } else {
                $messages = array_unique(explode("\n", $e->getMessage()));
                foreach ($messages as $message) {
                    $this->_getSession()->addError($message);
                }
            }

            $url = $this->_getSession()->getRedirectUrl(true);
            if ($url) {
                $this->getResponse()->setRedirect($url);
            } else {
                $this->_redirectReferer(Mage::helper('checkout/cart')->getCartUrl());
            }
        } catch (Exception $e) {
            $this->_getSession()->addException($e, $this->__('Cannot update the item.'));
            Mage::logException($e);
            $this->_goBack();
        }
        $this->_redirect('*/*');
    }

    /**
     * Update shopping cart data action
     */
    public function updatePostAction()
    {
        if (!$this->_validateFormKey()) {
            $this->_redirect('*/*/');
            return;
        }

        $updateAction = (string)$this->getRequest()->getParam('update_cart_action');

        switch ($updateAction) {
            case 'empty_cart':
                $this->_emptyShoppingCart();
                break;
            case 'update_qty':
                $this->_updateShoppingCart();
                break;
            case 'update_qty_ajax':
                $this->_updateShoppingCartAjax();
                break;
            default:
                $this->_updateShoppingCart();
        }

        $this->_goBack();
    }

    /**
     * Update customer's shopping cart
     */
    protected function _updateShoppingCart()
    {
        try {
            $cartData = $this->getRequest()->getParam('cart');
            if (is_array($cartData)) {
                $filter = new Zend_Filter_LocalizedToNormalized(
                    array('locale' => Mage::app()->getLocale()->getLocaleCode())
                );
                foreach ($cartData as $index => $data) {
                    if (isset($data['qty'])) {
                        $cartData[$index]['qty'] = $filter->filter(trim($data['qty']));
                    }
                }
                $cart = $this->_getCart();
                if (! $cart->getCustomerSession()->getCustomer()->getId() && $cart->getQuote()->getCustomerId()) {
                    $cart->getQuote()->setCustomerId(null);
                }

                $cartData = $cart->suggestItemsQty($cartData);
                $cart->updateItems($cartData)
                    ->save();
            }
            $this->_getSession()->setCartWasUpdated(true);
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError(Mage::helper('core')->escapeHtml($e->getMessage()));
        } catch (Exception $e) {
            $this->_getSession()->addException($e, $this->__('Cannot update shopping cart.'));
            Mage::logException($e);
        }
    }

    /**
     * Empty customer's shopping cart
     */
    protected function _emptyShoppingCart()
    {
        try {
            $this->_getCart()->truncate()->save();
            $this->_getSession()->setCartWasUpdated(true);
        } catch (Mage_Core_Exception $exception) {
            $this->_getSession()->addError($exception->getMessage());
        } catch (Exception $exception) {
            $this->_getSession()->addException($exception, $this->__('Cannot update shopping cart.'));
        }
    }

    /**
     * Delete shoping cart item action
     */
    public function deleteAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $this->_getCart()->removeItem($id)
                  ->save();
            } catch (Exception $e) {
                $this->_getSession()->addError($this->__('Cannot remove the item.'));
                Mage::logException($e);
            }
        }
        $this->_redirectReferer(Mage::getUrl('*/*'));
    }
    
    
    
    public function updateCartAjaxAction(){
        
               
            if (!$this->_validateFormKey()) {
                $result['error'] = true;
                $result['success'] = false;
                $result['redirect_url'] = Mage::helper('checkout/cart')->getCartUrl();
            }else{
                $cart_helper = Mage::helper('matrixrate');                
                $cart_response_template = Mage::getConfig()->getBlockClassName('core/template');
                $cart_response_template = new $cart_response_template;
                $item_id = $this->getRequest()->getParam('item_id');
                $qty = $this->getRequest()->getParam('qty');
                $quote = Mage::getSingleton('checkout/session')->getQuote();
                $quote->updateItem($item_id, array( 'qty' => $qty));
                $quote->save();
                $post_array = $this->getRequest()->getPost();  

                $selected_option = array();
                foreach($post_array as $key=>$val){
                    if(is_numeric($key)){
                        $selected_option[$key] = $val;
                    }
                }
                
                $shipping_amount =  $cart_helper->set_matrix_rate($selected_option);
                $matrix_id = $post_array['matrix_item'];
                
                $result['error'] = false;
                $result['success'] = true;
                $cart_response_template->setTemplate('checkout/onepage/review_response.phtml');
                $cart_response_template->setShippingAmount($shipping_amount);
                $cart_response_template->setSelectedOption($selected_option);
                $result['html'] = $cart_response_template->toHtml();
                
            }
            
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }

    
   
    
    
    
    public function deleteAjaxAction()
    {
        if (!$this->_validateFormKey()) {
                $result['error'] = true;
                $result['success'] = false;
                $result['redirect_url'] = Mage::helper('checkout/cart')->getCartUrl();
        }else{
            $cart_helper = Mage::helper('matrixrate');
            $id = (int) $this->getRequest()->getParam('delete_item');
            $cart_response_template = Mage::getConfig()->getBlockClassName('core/template');
            $cart_response_template = new $cart_response_template;

            if ($id) {
                try {
                $this->_getCart()->removeItem($id)->save();
                $post_array = $this->getRequest()->getPost();  

                $selected_option = array();
                foreach($post_array as $key=>$val){
                    if(is_numeric($key)){
                        $selected_option[$key] = $val;
                    }
                }
                
                $shipping_amount =  $cart_helper->set_matrix_rate($selected_option);
                $matrix_id = $post_array['matrix_item'];

                $totals = Mage::getSingleton('checkout/session')->getQuote()->getTotals();


                if(array_key_exists($post_array['matrix_item'], $selected_option)){                
                    $sku_exist = $cart_helper->check_sku_exist($selected_option[$matrix_id]);
                }

                if($sku_exist){
                    $this->_getSession()->getQuote()->setTotalsCollectedFlag(false)->collectTotals();
                    $cart_helper->remove_shipping_amount_from_grand_total($selected_option[$matrix_id],$id);

                }


                    if(Mage::helper('checkout/cart')->getItemsCount() > 0){

                        $result['error'] = false;
                        $result['success'] = true;
                        $cart_response_template->setTemplate('checkout/onepage/review_response.phtml');
                        $cart_response_template->setShippingAmount($shipping_amount);
                        $cart_response_template->setSelectedOption($selected_option);
                        $result['html'] = $cart_response_template->toHtml();
                    }else{
                        $result['error'] = true;
                        $result['success'] = false;
                        $result['redirect_url'] = Mage::helper('checkout/cart')->getCartUrl();
                    }


                } catch (Exception $e) {
                    $result['error'] = true;
                    $result['success'] = false;                
                    $result['error_message'] = $this->__('Cannot remove the item.');
                    $result['redirect_url'] = Mage::helper('checkout/cart')->getCartUrl();

                }
            }
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
    
    #Need to remove this function
    public function getUpdatedCartHtml(){
    }

    /**
     * Initialize shipping information
     */
    public function estimatePostAction()
    {
        $country    = (string) $this->getRequest()->getParam('country_id');
        $postcode   = (string) $this->getRequest()->getParam('estimate_postcode');
        $city       = (string) $this->getRequest()->getParam('estimate_city');
        $regionId   = (string) $this->getRequest()->getParam('region_id');
        $region     = (string) $this->getRequest()->getParam('region');

        $this->_getQuote()->getShippingAddress()
            ->setCountryId($country)
            ->setCity($city)
            ->setPostcode($postcode)
            ->setRegionId($regionId)
            ->setRegion($region)
            ->setCollectShippingRates(true);
        $this->_getQuote()->save();
        $this->_goBack();
    }

    /**
     * Estimate update action
     *
     * @return null
     */
    public function estimateUpdatePostAction()
    {
        $code = (string) $this->getRequest()->getParam('estimate_method');
        if (!empty($code)) {
            $this->_getQuote()->getShippingAddress()->setShippingMethod($code)/*->collectTotals()*/->save();
        }
        $this->_goBack();
    }

    /**
     * Initialize coupon
     */
    public function couponPostAction()
    {
        /**
         * No reason continue with empty shopping cart
         */
        if (!$this->_getCart()->getQuote()->getItemsCount()) {
            $this->_goBack();
            return;
        }

        $couponCode = (string) $this->getRequest()->getParam('coupon_code');
        if ($this->getRequest()->getParam('remove') == 1) {
            $couponCode = '';
        }
        $oldCouponCode = $this->_getQuote()->getCouponCode();

        if (!strlen($couponCode) && !strlen($oldCouponCode)) {
            $this->_goBack();
            return;
        }

        try {
            $codeLength = strlen($couponCode);
            $isCodeLengthValid = $codeLength && $codeLength <= Mage_Checkout_Helper_Cart::COUPON_CODE_MAX_LENGTH;

            $this->_getQuote()->getShippingAddress()->setCollectShippingRates(true);
            $this->_getQuote()->setCouponCode($isCodeLengthValid ? $couponCode : '')
                ->collectTotals()
                ->save();

            if ($codeLength) {
                if ($isCodeLengthValid && $couponCode == $this->_getQuote()->getCouponCode()) {
                    $this->_getSession()->addSuccess(
                        $this->__('Coupon code "%s" was applied.', Mage::helper('core')->escapeHtml($couponCode))
                    );
                } else {
                    $this->_getSession()->addError(
                        $this->__('Coupon code "%s" is not valid.', Mage::helper('core')->escapeHtml($couponCode))
                    );
                }
            } else {
                $this->_getSession()->addSuccess($this->__('Coupon code was canceled.'));
            }

        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()->addError($this->__('Cannot apply the coupon code.'));
            Mage::logException($e);
        }

        $this->_goBack();
    }
    
    
    
    
    public function  couponPostAjaxAction()
    {
        if (!$this->_validateFormKey()) {
                $result['error'] = true;
                $result['success'] = false;
                $result['redirect_url'] = Mage::helper('checkout/cart')->getCartUrl();
        }else{
            $_coreHelper = Mage::helper('core');
            $cart_helper = Mage::helper('matrixrate');
            $cart_response_template = Mage::getConfig()->getBlockClassName('core/template');
            $cart_response_template = new $cart_response_template;
            /**
             * No reason continue with empty shopping cart
             */
            if (!$this->_getCart()->getQuote()->getItemsCount()) {

                $result['error'] = true;
                $result['success'] = false;
            }

            $couponCode = (string) $this->getRequest()->getParam('coupon_code');
            $post_array = $this->getRequest()->getPost();
            if ($this->getRequest()->getParam('remove') == 1) {
                $couponCode = '';
            }
            $oldCouponCode = $this->_getQuote()->getCouponCode();

            if (!strlen($couponCode) && !strlen($oldCouponCode)) {
                $result['error'] = true;
                $result['success'] = false;
            }

            try {
                $codeLength = strlen($couponCode);
                $isCodeLengthValid = $codeLength && $codeLength <= Mage_Checkout_Helper_Cart::COUPON_CODE_MAX_LENGTH;

                $this->_getQuote()->getShippingAddress()->setCollectShippingRates(true);
                $this->_getQuote()->setCouponCode($isCodeLengthValid ? $couponCode : '')
                    ->collectTotals()
                    ->save();
                $selected_option = array();
                foreach($post_array as $key=>$val){
                    if(is_numeric($key)){
                        $selected_option[$key] = $val;
                    }
                }
                if ($codeLength) {
                    if ($isCodeLengthValid && $couponCode == $this->_getQuote()->getCouponCode()) {
    //                    $this->_getSession()->addSuccess(
    //                        $this->__('Coupon code "%s" was applied.', Mage::helper('core')->escapeHtml($couponCode))
    //                    );
                    $result['error'] = false;
                    $result['success'] = true;
                    $totals = Mage::getSingleton('checkout/session')->getQuote()->getTotals();
                    $grandtotal = round($totals["grand_total"]->getValue());
                    $result['grand_total']=$_coreHelper->formatPrice($grandtotal, false)." (".Mage::helper('checkout/cart')->getItemsCount()." Barang)";
                    

                    $shipping_amount =  $cart_helper->set_matrix_rate($selected_option);
                    

                    $cart_response_template->setTemplate('checkout/onepage/review_response.phtml');
                    $cart_response_template->setShippingAmount($shipping_amount);
                    $cart_response_template->setSelectedOption($selected_option);
                    $result['html'] = $cart_response_template->toHtml();
                    } else {
                    Mage::getSingleton('checkout/cart')->getQuote()->setCouponCode("")->collectTotals()->save();
                    $totals = Mage::getSingleton('checkout/session')->getQuote()->getTotals();
                    $grandtotal = round($totals["grand_total"]->getValue());
                    $result['grand_total']=$_coreHelper->formatPrice($grandtotal, false)." (".Mage::helper('checkout/cart')->getItemsCount()." Barang)";
                    $quote = Mage::getSingleton('checkout/session')->getQuote();
                    $totals = Mage::getSingleton('checkout/session')->getQuote()->getTotals();
                    //$coupon_discount_amount = $totals["discount"]->getValue();

                    $shipping_amount =  $cart_helper->set_matrix_rate($selected_option);
                    $result['error'] = true;
                    $result['success'] = false;
                    $cart_response_template->setTemplate('checkout/onepage/review_response.phtml');
                    $cart_response_template->setPostcouponcode($couponCode);
                    $cart_response_template->setShippingAmount($shipping_amount);
                    $cart_response_template->setSelectedOption($selected_option);
                    $result['html'] = $cart_response_template->toHtml();



                    }
                } else {
                   // $this->_getSession()->addSuccess($this->__('Coupon code was canceled.'));
                }

            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $result['error'] = true;
                        $result['success'] = false;
            } catch (Exception $e) {
               // $this->_getSession()->addError($this->__('Cannot apply the coupon code.'));
                Mage::logException($e);
                $result['error'] = true;
                        $result['success'] = false;
            }
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
    
    
}
