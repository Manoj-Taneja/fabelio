<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_ShippingPrice
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_ShippingPrice_Helper_Data extends Mage_Core_Helper_Abstract
{
    const BUY_REQUEST_QTY          = 1;
    const CACHE_KEY                = 'aw_shippingprice';
    const CACHE_TAG                = 'aw_shippingprice';
    const CACHE_LIFETIME           = 300;
    const CONTROLLER_PRODUCT_PAGE  = 'product';
    const CONTROLLER_CATEGORY_PAGE = 'category';

    const XML_PATH_STORE_COUNTRY_ID = 'shipping/origin/country_id';
    const XML_PATH_STORE_REGION_ID  = 'shipping/origin/region_id';
    const XML_PATH_STORE_ZIP        = 'shipping/origin/postcode';

    protected $_shippingAddress = array();
    protected $_shippingMethod  = null;
    protected $_productIds      = array();

    public function addProductId($id)
    {
        $this->_productIds[] = $id;
    }

    public function getEncodedProductIds()
    {
        if ($this->_productIds) {
            $data = Zend_Json::encode($this->_productIds);

            return Mage::helper('core')->encrypt($data);
        }
        return false;
    }

    public function getDecodedProductIds($data)
    {
        $result = array();
        if ($data) {
            try {
                $result = Zend_Json::decode(Mage::helper('core')->decrypt($data));
            } catch (Exception $exc) {
                $result = array();
            }
        }
        return $result;
    }

    public function getShippingPrice($productId, $address, $method = null)
    {
        $product = Mage::getModel('catalog/product')->load($productId);
        if ($product->isVirtual() || !$product->isSaleable()) {
            return null;
        }
        $allShippingRates = $this->getGroupedAllShippingRates($product, $address);
        return $this->getMinimalShippingPrice($allShippingRates, $method);
    }

    public function getShippingPriceFromCache($productId, $address, $method)
    {
        $cacheId = $this->_getCacheId($productId, $address, $method);
        return Mage::app()->loadCache($cacheId);
    }

    public function saveShippingPriceToCache($data, $productId, $address, $method)
    {
        $cacheId = $this->_getCacheId($productId, $address, $method);
        return Mage::app()->saveCache($data, $cacheId, array(self::CACHE_TAG), self::CACHE_LIFETIME);
    }

    private function _getCacheId($productId, $address, $method)
    {
        $cacheId = self::CACHE_KEY
            . '_' . Mage::app()->getWebsite()->getId()
            . '_' . $productId
            . '_' . $method
        ;

        foreach ($address as $key => $value) {
            $cacheId .= '_' . $key . '_' . $value;
        }
        return $cacheId;
    }

    public function getMinimalShippingPrice($groupedAllShippingRates, $method = null)
    {
        $prices = array();
        if (($method !== null) && isset($groupedAllShippingRates[$method])) {
            foreach ($groupedAllShippingRates[$method] as $rate) {
                $prices[] = $rate->getPrice();
            }
        } else {
            /* Shipping method is not set, get all prices */
            foreach ($groupedAllShippingRates as $rates) {
                foreach ($rates as $rate) {
                    $prices[] = $rate->getPrice();
                }
            }
        }
        $min = (count($prices)) ? min($prices) : null;
        return $min;
    }

    /**
     * Retrieve all grouped shipping rates
     *
     * @param $product
     * @param $address
     *
     * @return mixed
     */
    public function getGroupedAllShippingRates($product, $address)
    {
        $quote = Mage::getModel('sales/quote');

        $shippingAddress = $quote->getShippingAddress();
        $shippingAddress->addData($address);
        $shippingAddress->setCollectShippingRates(true);

        $buyRequest = Mage::helper('aw_shippingprice/product')->getProductFakeBuyRequest($product);
        $result = $quote->addProduct($product, $buyRequest);

        if (is_string($result)) {
            Mage::throwException($result);
        }

        Mage::dispatchEvent(
            'checkout_cart_product_add_after',
            array(
                 'quote_item' => $result,
                 'product'    => $product,
            )
        );
        $quote->collectTotals();
        return $shippingAddress->getGroupedAllShippingRates();
    }

    /**
     * Get Shipping Address
     * Return format:
     * ['country_id' => 'US', 'region_id' => '12', 'postcode' => string '95131']
     *
     * @return array
     */
    public function getShippingAddress()
    {
        $shippingAddress = Mage::getSingleton('customer/session')->getData('aw_shippingprice_address');
        if (!$shippingAddress && !is_array($shippingAddress)) {
            $customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultShipping();
            if ($customerAddressId) {
                $customerAddress = Mage::getModel('customer/address')->load($customerAddressId);
                $shippingAddress = array(
                    'country_id' => $customerAddress->getCountryId(),
                    'region_id'  => $customerAddress->getRegionId(),
                    'postcode'   => $customerAddress->getPostcode(),
                );
            } else {
                /** a point of departure =  destination */
                $shippingAddress = array(
                    'country_id' => Mage::getStoreConfig(self::XML_PATH_STORE_COUNTRY_ID),
                    'region_id'  => Mage::getStoreConfig(self::XML_PATH_STORE_REGION_ID),
                    'postcode'   => Mage::getStoreConfig(self::XML_PATH_STORE_ZIP),
                );
            }
            Mage::getSingleton('customer/session')->setData('aw_shippingprice_address', $shippingAddress);
        }
        return $shippingAddress;
    }

    public function getShippingMethod()
    {
        return Mage::getStoreConfig('shippingprice/general/shipping_default_method');
    }

    public function getShowOnPageConfig()
    {
        return Mage::getStoreConfig('shippingprice/general/shipping_price_pages');
    }

    public function getIsEnabledConfig()
    {
        return Mage::getStoreConfig('shippingprice/general/enable');
    }

    public function showPriceEnabled()
    {
        if (!$this->getIsEnabledConfig()) {
            return false;
        }

        $showOnPages = array(
            self::CONTROLLER_PRODUCT_PAGE,
            self::CONTROLLER_CATEGORY_PAGE,
        );

        $controllerName = Mage::app()->getRequest()->getControllerName();
        $configPages = $this->getShowOnPageConfig();

        if (!in_array($controllerName, $showOnPages)) {
            return false;
        }

        switch ($configPages) {
            case AW_ShippingPrice_Model_System_Config_Source_Area::CATEGORY_PAGE:
                if ($controllerName == self::CONTROLLER_CATEGORY_PAGE) {
                    return true;
                }
                break;
            case AW_ShippingPrice_Model_System_Config_Source_Area::PRODUCT_PAGE:
                if ($controllerName == self::CONTROLLER_PRODUCT_PAGE) {
                    return true;
                }
                break;
            case AW_ShippingPrice_Model_System_Config_Source_Area::BOTH_CATEGORY_PRODUCT:
                return true;
                break;
            default:
                break;
        }
        return false;
    }
}