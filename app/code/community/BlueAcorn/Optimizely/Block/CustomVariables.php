<?php
/**
 * @package     BlueAcorn\Optimizely
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_Optimizely_Block_CustomVariables extends Mage_Core_Block_Abstract
{

    protected $_pageType = null;

    /**
     * Get module helper
     *
     * @return Mage_Core_Helper_Abstract
     */
    protected function _helper()
    {
        return Mage::helper('blueacorn_optimizely');
    }

    /**
     * Get current product
     *
     * @return mixed
     */
    protected function _getProduct()
    {
        return Mage::registry('current_product');
    }

    /**
     * Get current category
     *
     * @return mixed
     */
    protected function _getCategory()
    {
        return Mage::registry('current_category');
    }


    protected function _getProductVariables()
    {
        $product = $this->_getProduct();
        if ($product) {


            //calcuate price
            $productType = $this->_clean($product->getTypeId());
            $productPrice = round($product->getMinimalPrice(), 2);

            if ($productPrice == 0) {
                $productPrice = round($product->getPrice(), 2);
            }

            if ($productType == "grouped") {

                $aProductIds = $product->getTypeInstance()->getChildrenIds($product->getId());
                $collection = Mage::getModel('catalog/product')
                    ->getCollection()
                    ->addAttributeToFilter('entity_id', array('in' => $aProductIds))
                    ->addMinimalPrice();

                $productPrice = 0;
                foreach ($collection as $aProduct) {
                    $productPrice += $aProduct->getMinimalPrice();
                }

            } elseif ($productType == "bundle") {
                $priceModel = $product->getPriceModel();

                if (method_exists($priceModel, 'getTotalPrices')) {
                    $productPrice = $priceModel->getTotalPrices($product, null, null, false);
                } else { //getPrices() deprecated in 1.5.1.0
                    $productPrice = $priceModel->getPrices($product, null);
                }

                $productPrice = $productPrice[0];
            }
            //build custom tag array
            $productVariables = array(
                'product_type'  => $productType,
                'product_sku'   => $product->getSku(),
                'product_name'  => $product->getName(),
                'product_price' => $productPrice,
            );

            $customAttributes = $this->_helper()->getCustomAttributes();
            foreach ($customAttributes as $attr) {
                $productVariables[$attr] = $this->_getAttrValue($attr);
            }
        }
        return $productVariables;
    }

    /**
     * Cleans and truncates the value
     *
     * @param mixed $val
     * @return string
     */
    protected function _clean($val)
    {
        if (is_numeric($val)) {
            return round($val, 2);
        }

        $badChars = array("\"", "'", ";", "\n");

        $newString = str_replace($badChars, '', $val);
        $newString = (strlen($newString) < 50) ? $newString : substr($newString, 0, 50);

        return $newString;

    }

    /**
     * Retrieves attribute values
     *
     * @param string $attr
     * @return string
     */
    protected function _getAttrValue($attr)
    {
        $product = $this->_getProduct();
        $value = '';

        switch ($attr) {
            case 'news_from_date':
                $newFromDate = $product->getData('created_at');
                $newFromDate = str_replace("-", "", substr($newFromDate, 0, strpos($newFromDate, " ")));
                $today = date('Ymd');
                if (is_numeric($newFromDate)) {
                    $value = $today - $newFromDate;
                }
                break;
            case 'inventory':
                $value = round(Mage::getSingleton('cataloginventory/stock_item')->loadByProduct($product)->getQty(), 0);
                break;
            default:
                $value = $product->getData($attr);
        }
        return $value;
    }

    /**
     * Get the page type
     *
     * @return string
     */
    protected function _getPageType()
    {
        if ($this->_pageType != NULL) {
            return $this->_pageType;
        }

        $routeName = $this->getRequest()->getRequestedRouteName();
        $actionName = $this->getAction()->getFullActionName();
        $this->_pageType = '';
        if($routeName == 'amlanding'){
           $this->_pageType = 'landing';
        }
        if ($actionName == 'catalog_product_view') {
            $this->_pageType = 'product';

        } elseif ($actionName == 'catalog_category_view') {
            $this->_pageType = 'category';

        } elseif ($this->getRequest()->getPathInfo() == '/') {
            $this->_pageType = 'home';

        } elseif ($routeName == 'cms') {

            $identifier = Mage::getSingleton('cms/page')->getIdentifier();
            if ($identifier == 'home' || $identifier == 'enterprise-home') {
                $this->_pageType = 'home';

            } else {
                $this->_pageType = 'cms';
            }

        } elseif ($routeName == 'checkout' || $routeName == 'onestepcheckout') {

            if ($this->getRequest()->getControllerName() == 'cart') {
                $this->_pageType = 'cart';

            } elseif ($this->getRequest()->getActionName() == 'success') {
                $this->_pageType = 'success';

            } else {
                $this->_pageType = 'checkout';
            }

        } elseif ($routeName == 'customer') {
            $this->_pageType = 'customer';


        } elseif ($routeName == 'catalogsearch') {
            $this->_pageType = 'search';

        }

        return $this->_pageType;
    }

    /**
     * Ouput HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        if ($this->_helper()->isEnabled()) {

            $optimizelyString = "window['optimizely'].push(['%s', '%s', '%s' ]);" . PHP_EOL;

            $html  = "<script>" . PHP_EOL;
            $html .= "window['optimizely'] = window['optimizely'] || [];" . PHP_EOL;

            if ($this->_getPageType()) {
              if($this->_getPageType() == 'landing'){
          //    $html.='window.optimizely.push(["activate", 5379401677]);';
              } 
              if($this->_getPageType() == 'home'){
              $html.='window.optimizely.push(["activate", 5597630009]);';
              } 
              if($this->_getPageType() == 'cart'){
              $html.='window.optimizely.push(["activate", 5597630009]);';
              } 
              $html .= sprintf($optimizelyString, 'customTag', 'page_type', $this->_getPageType());
            }

            //if category
            if ($category = $this->_getCategory()) {
                //$html.='window.optimizely.push(["activate", 5379401677]);';               
                $categoryName = strtolower($category->getName());
                $html .= sprintf($optimizelyString, 'customTag', 'category', $this->_clean($categoryName));
            }

            //if product
            if ($this->_getProduct()) {
              
              // Added by arjun for pre selecte product color in product page
              $_product = Mage::registry('current_product');
              if($_product->isConfigurable()){
                $attributes = $_product->getTypeInstance(true)->getConfigurableAttributesAsArray($_product);
                if('fabric_color'== $attributes[0]['attribute_code']){
//                  $html.='window.optimizely.push(["activate", 5241300806]);';
                }
              }
                  $html.='window.optimizely.push(["activate", 5597630009]);';
              // added by arjun till here.

              foreach ($this->_getProductVariables() as $key => $value) {
                    if ($value) {
                        $html .= sprintf($optimizelyString, 'customTag', $key, $this->_clean($value));
                    }
                }
            }

            //if is success page, add the revenue tracking script
            if ($this->_getPageType() == 'success' && $this->_helper()->isRevenueTrackingEnabled()) {
                $orderId = Mage::getSingleton('checkout/session')->getData('last_order_id');
                $order = Mage::getModel('sales/order')->load($orderId);
                $revenueInCents = ($order->getGrandTotal() * 100);
                $html .= sprintf($optimizelyString, 'trackEvent', 'success_page', $revenueInCents);
            }
            $html .= "</script>" . PHP_EOL;

            return $html;
        }
    }
}
