<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Full Page Cache
 * @version   1.0.1
 * @build     360
 * @copyright Copyright (C) 2015 Mirasvit (http://mirasvit.com/)
 */



abstract class Mirasvit_Fpc_Model_Container_Abstract
{
    const CONTAINER_ID_PREFIX = 'FPC_CONTAINER';
    const HTML_NAME_PATTERN = '/<\[!--\{(.*?)\}--\]>/i';
    const EMPTY_VALUE = 'empty';

    protected $_definition = null;
    protected static $_layoutXml = null;
    protected $_hash = null;

    public function __construct($definition, $block)
    {
        $this->_definition = $definition;

        $this->_definition['block_name'] = $block->getNameInLayout();

        $this->_definition['layout'] = Mage::helper('fpc/layout')->generateBlockLayoutXML($block->getNameInLayout());

        return $this;
    }

    public function getDefinition()
    {
        return $this->_definition;
    }

    public function getBlockReplacerHtml($html)
    {
        return $this->_getStartReplacerTag().$html.$this->_getEndReplacerTag();
    }

    protected function _getStartReplacerTag()
    {
        return '<[!--{'.$this->getDefinitionHash().'}--]>';
    }

    protected function _getEndReplacerTag()
    {
        return '<[!--/{'.$this->getDefinitionHash().'}--]>';
    }

    public function getDefinitionHash()
    {
        if ($this->_hash == null) {
            $this->_hash = $this->_definition['block'].'_'.($this->_definition['block_name']);
        }

        return $this->_hash;
    }

    public function saveToCache($content)
    {
        $pattern = '/'.preg_quote($this->_getStartReplacerTag(), '/').'(.*?)'.preg_quote($this->_getEndReplacerTag(), '/').'/ims';
        ini_set('pcre.backtrack_limit', 100000000);

        $matches = array();
        preg_match($pattern, $content, $matches);
        if (isset($matches[1])) {
            $this->saveCache($matches[1]);
        }

        return $this;
    }

    public function applyToContent(&$content)
    {
        $pattern = '/'.preg_quote($this->_getStartReplacerTag(), '/').'(.*?)'.preg_quote($this->_getEndReplacerTag(), '/').'/ims';
        $html = $this->getBlockHtml();

        if ($html !== false) {
            ini_set('pcre.backtrack_limit', 100000000);
            $content = preg_replace($pattern, str_replace('$', '\\$', $html), $content, 1);

            return true;
        } else {
            return false;
        }
    }

    public function getBlockHtml()
    {
        $startTime = microtime(true);
        $html = $this->loadCache();

        if ($html) {
            Mage::helper('fpc/debug')->appendDebugInformationToBlock($html, $this, 1, $startTime);
        } else {
            if ($this->inApp()) {
                return false;
            } else {
                $html = Mage::helper('fpc/layout')->renderBlock($this->_definition);
                $this->saveCache($html);
            }
        }

        if ($html == self::EMPTY_VALUE) {
            $html = '';
        }

        return $html;
    }

    public function inApp()
    {
        return isset($this->_definition['in_app']) && $this->_definition['in_app'] == true;
    }

    protected function _getCacheId()
    {
        if ($this->_getIdentifier()) {
            return self::CONTAINER_ID_PREFIX.'_'.md5($this->getDefinitionHash().($this->_getIdentifier()));
        }

        return false;
    }

    protected function _getIdentifier()
    {
        return false;
    }

    public function getCacheId()
    {
        return $this->_getCacheId();
    }

    public function saveCache($blockContent)
    {
        $cacheId = $this->_getCacheId();
        if ($cacheId !== false) {
            $this->_saveCache($blockContent, $cacheId);
        }

        return $this;
    }

    public function loadCache()
    {
        $id = $this->_getCacheId();

        return Mirasvit_Fpc_Model_Cache::getCacheInstance()->load($id);
    }

    protected function _saveCache($data, $id, $tags = array(), $lifetime = null)
    {
        $tags[] = Mirasvit_Fpc_Model_Processor::CACHE_TAG;
        if (is_null($lifetime)) {
            $lifetime = $this->_definition['cache_lifetime'] ?
                $this->_definition['cache_lifetime'] : false;
        }

        if (!$lifetime) {
            $lifetime = Mage::getSingleton('fpc/config')->getLifetime();
        }

        if ($data == '') {
            $data = ' ';
        }

        Mirasvit_Fpc_Model_Cache::getCacheInstance()->save($data, $id, $tags, $lifetime);

        return $this;
    }

    public function getDependenceHash($dependences)
    {
        $hash = array();

        if (!is_array($dependences)) {
            $dependences = explode(',', $dependences);
        }

        foreach ($dependences as $dependence) {
            $hash[] = $dependence;
            switch ($dependence) {
                case 'customer':
                    $customer = Mage::getSingleton('customer/session');
                    $hash[] = $customer->getCustomerId();
                    break;

                case 'customer_group':
                    $customer = Mage::getSingleton('customer/session');
                    $hash[] = $customer->getCustomerGroupId();
                    break;

                case 'logged_in':
                    $loggedIn = Mage::getSingleton('customer/session')->isLoggedIn();
                    $hash[] = (string) $loggedIn;
                    break;

                case 'cart':
                    $checkout = Mage::getSingleton('checkout/session');
                    foreach ($checkout->getQuote()->getAllItems() as $item) {
                        $hash[] = $item->getId().'/'.$item->getQty();
                    }
                    break;

                case 'compare':
                    $items = Mage::helper('catalog/product_compare')->getItemCollection();
                    foreach ($items as $item) {
                        $hash[] = $item->getId();
                    }
                    break;

                case 'wishlist':
                    $wishlistHelper = Mage::helper('wishlist');

                    if ($wishlistHelper->hasItems()) {
                        $items = $wishlistHelper->getItemCollection();
                        foreach ($items as $item) {
                            $hash[] = $item->getId();
                        }
                    }
                    break;

                case 'product':
                    if (Mage::registry('current_product')) {
                        $hash[] = Mage::registry('current_product')->getId();
                    } elseif (Mage::registry('current_product_id')) {
                        $hash[] = Mage::registry('current_product_id');
                    }
                    break;

                case 'category':
                    if (Mage::registry('current_category')) {
                        $hash[] = Mage::registry('current_category')->getId();
                    } elseif (Mage::registry('current_category_id')) {
                        $hash[] = Mage::registry('current_category_id');
                    }
                    break;

                case 'store':
                    $hash[] = Mage::app()->getStore()->getCode();
                    break;

                case 'currency':
                    $hash[] = Mage::app()->getStore()->getCurrentCurrencyCode();
                    break;

                case 'locale':
                    $hash[] = Mage::app()->getLocale()->getLocaleCode();
                    break;

                case 'rotator':
                    $hash[] = 'rotator_'.rand(0, 10);
                    break;

                case 'is_home':
                    if (Mage::getBlockSingleton('page/html_header')->getIsHomePage()) {
                        $hash[] = 'home';
                    }
                    break;

                case 'allow_save_cookies':
                    if (version_compare(Mage::getVersion(), '1.7.0.1', '>=')) {
                        $hash[] = Mage::helper('core/cookie')->isUserNotAllowSaveCookie();
                    }
                    break;

                case 'ow_cookie_notice':
                    if (isset($_COOKIE) && isset($_COOKIE['ow_cookie_notice'])) {
                        $hash[] = $_COOKIE['ow_cookie_notice'];
                    }
                    break;

                case 'get':
                    $hash[] = implode('', $_GET);
                    break;

                case 'mobile':
                    foreach (Mage::getSingleton('fpc/config')->getUserAgentSegmentation() as $segment) {
                        if (preg_match($segment['useragent_regexp'], Mage::helper('core/http')->getHttpUserAgent())) {
                            $hash[] = implode('', $segment['cache_group']);
                        }
                    }
                    break;

                case 'amasty_preorder':
                    $preorder = false;
                    if (Mage::registry('current_product')) {
                        $product = Mage::registry('current_product');
                    } elseif (Mage::registry('current_product_id')) {
                        $product = Mage::getModel('catalog/product')->load(Mage::registry('current_product_id'));
                    }
                    if ($product) {
                        $preorder = Mage::helper('ampreorder')->getIsProductPreorder($product);
                    }
                    $currentUrl = Mage::helper('core/url')->getCurrentUrl();
                    $currentUrl = strtok($currentUrl, '?');
                    if ($preorder) {
                        $hash[] = $product->getId().$currentUrl;
                    } else {
                        $hash[] = $currentUrl;
                    }
                    break;

                case 'secure':
                    $hash[] = Mage::app()->getStore()->isCurrentlySecure();
                    break;

                case 'package_name':
                    $hash[] = Mage::getSingleton('core/design_package')->getPackageName();
                    break;

                default:
                    break;
            }
        }

        return implode(' | ', $hash);
    }
}
