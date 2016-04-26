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



class Mirasvit_Fpc_Model_Processor
{
    const NO_CACHE_COOKIE = 'NO_CACHE';
    const CACHE_TAG = 'FPC';
    const REQUEST_ID_PREFIX = 'FPC_REQUEST_';
    const DEBUG_LOG = 'fpc_debug.log';
    const MAX_NUMBER_OF_TAGS = 100;

    protected $_requestId = null;
    protected $_requestCacheId = null;
    protected $_requestTags = null;
    protected $_updateCache = null;
    protected $_canProcessRequest = null;
    protected $_containers = array();
    protected $_isServed = false;

    protected $_storage = null;

    public function __construct()
    {
        $_SERVER['FPC_TIME'] = microtime(true);
        $this->_requestTags = array(self::CACHE_TAG);
    }

    public function prepareHtml($observer)
    {
        if (!$this->canProcessRequest(Mage::app()->getRequest()) && !$this->isRedirect()) {
            $response = Mage::app()->getResponse();
            if ($response) {
                $content = $response->getBody();
                $this->_clearMarkup($content);
                $response->setBody($content);
            }
        }

        return;
    }

    public function isRedirect()
    {
        foreach (Mage::app()->getResponse()->getHeaders() as $header) {
            if ($header['name'] == 'Location') {
                return true;
            }
        }

        return false;
    }

    public function serveResponse($observer)
    {
        if (!$this->canProcessRequest(Mage::app()->getRequest())) {
            return false;
        }

        $cacheId = $this->getRequestCacheId();

        $this->_storage = Mage::getModel('fpc/storage');
        $this->_storage->setCacheId($cacheId);
        if ($this->_storage->load()) {
            $this->_processActions();

            $response = Mage::app()->getResponse();
            $content = $this->_storage->getResponse()->getBody();
            $storageContainers = $this->_storage->getContainers();

            if ($this->_storage->getCurrentCategory()) {
                if (!Mage::registry('current_category_id')) {
                    Mage::register('current_category_id', $this->_storage->getCurrentCategory());
                }
                if (Mage::helper('mstcore')->isModuleInstalled('Mirasvit_Seo')) {
                    $category = Mage::getModel('catalog/category')->load($this->_storage->getCurrentCategory());
                    if (!Mage::registry('current_category')) {
                        Mage::register('current_category', $category);
                    }
                    if (!Mage::registry('current_entity_key')) {
                        Mage::register('current_entity_key', $category->getPath());
                    }
                }
            }

            if ($this->_storage->getCurrentProduct()) {
                if (!Mage::registry('current_product_id')) {
                    Mage::register('current_product_id', $this->_storage->getCurrentProduct());
                }
                if (Mage::helper('mstcore')->isModuleInstalled('Mirasvit_Seo')) {
                    $product = Mage::getModel('catalog/product')->load($this->_storage->getCurrentProduct());
                    if (!Mage::registry('current_product')) {
                        Mage::register('current_product', $product);
                    }
                    // if (!Mage::registry('product')) {
                    //     Mage::register('product', $product);
                    // }
                }
            }

            // restore design settings
            Mage::getSingleton('core/design_package')->setTheme('layout', $this->_storage->getThemeLayout())
                ->setTheme('template', $this->_storage->getThemeTemplate())
                ->setTheme('skin', $this->_storage->getThemeSkin())
                ->setTheme('locale', $this->_storage->getThemeLocale());

            $containers = array();
            preg_match_all(
                Mirasvit_Fpc_Model_Container_Abstract::HTML_NAME_PATTERN,
                $content, $containers, PREG_PATTERN_ORDER
            );
            $containers = array_unique($containers[1]);
            for ($i = 0; $i < count($containers); $i++) {
                if (isset($containers[$i])) {
                    $definition = $containers[$i];
                    if (isset($storageContainers[$definition])) {
                        $container = $storageContainers[$definition];

                        if (!$container->inApp()) {
                            $this->_loadRegisters($this->_storage);
                        }

                        // if cache for current block not exists, we render whole page (and save updated block to cache)
                        if (!$container->applyToContent($content)
                            && strpos($definition, 'page/switch') === false //if block "page/switch" exist, but empty, we will not render whole page
                            && strpos($definition, 'reports/product_viewed') === false) {
                            // echo $definition;
                            // die('x');
                            Mage::unregister('current_category');
                            Mage::unregister('current_entity_key');
                            Mage::unregister('current_product');

                            return;
                        }
                    }
                }
            }

            $this->_clearMarkup($content);

            if ($formKey = Mage::getSingleton('core/session')->getFormKey()) {
                $content = preg_replace('/<input type="hidden" name="form_key" value="(.*?)" \\/>/i', '<input type="hidden" name="form_key" value="'.$formKey.'" />', $content);
                $content = preg_replace('/<input name="form_key" type="hidden" value="(.*?)" \\/>/i', '<input name="form_key" type="hidden" value="'.$formKey.'" />', $content);
                $content = preg_replace('/\\/form_key\\/(.*?)\\//i', '/form_key/'.$formKey.'/', $content);
            }

            Mage::helper('fpc/debug')->appendDebugInformation($content, 1);

            $response->setBody($content);

            foreach ($this->_storage->getResponse()->getHeaders() as $header) {
                if ($header['name'] != 'Location') {
                    $response->setHeader($header['name'], $header['value'], $header['replace']);
                }
            }

            $this->_isServed = true;
            $response->sendResponse();

            Mage::getSingleton('fpc/log')->log($cacheId, 1);

            exit;
        }
    }

    public function cacheResponse($observer)
    {
        $request = Mage::app()->getRequest();
        $response = Mage::app()->getResponse();

        if ($this->canProcessRequest($request) && !$this->_isServed) {
            $this->_storage = Mage::getModel('fpc/storage');

            $this->_processActions();

            $cacheId = $this->getRequestCacheId();

            $this->_storage->setCacheId($cacheId);
            $this->_storage->setCacheTags($this->getRequestTags());
            $this->_storage->setCacheLifetime($this->getConfig()->getLifetime());
            $this->_storage->setContainers($this->_containers);
            $this->_storage->setResponse($response);

            if (Mage::registry('current_category')) {
                $this->_storage->setCurrentCategory(Mage::registry('current_category')->getId());
            }
            if (Mage::registry('current_product')) {
                $this->_storage->setCurrentProduct(Mage::registry('current_product')->getId());
            }
            if (Mage::getSingleton('cms/page')->getId()) {
                $this->_storage->setCurrentCmsPage(Mage::getSingleton('cms/page')->getId());
            }

            // save design settings
            $design = Mage::getSingleton('core/design_package');
            $this->_storage->setThemeLayout($design->getTheme('layout'))
                ->setThemeTemplate($design->getTheme('template'))
                ->setThemeSkin($design->getTheme('skin'))
                ->setThemeLocale($design->getTheme('locale'));

            try {
                $response->setHeader('Fpc-Cache-Id', $cacheId, true);
            } catch (Exception $e) {
            }

            $this->_storage->save();

            $content = $response->getBody();

            $containers = array();
            preg_match_all(
                Mirasvit_Fpc_Model_Container_Abstract::HTML_NAME_PATTERN,
                $content, $containers, PREG_PATTERN_ORDER
            );
            $containers = array_unique($containers[1]);
            for ($i = 0; $i < count($containers); $i++) {
                if (isset($containers[$i])) {
                    $definition = $containers[$i];
                    if (isset($this->_containers[$definition])) {
                        $container = $this->_containers[$definition];
                        $container->saveToCache($content);
                    }
                }
            }

            $this->_clearMarkup($content);

            Mage::helper('fpc/debug')->appendDebugInformation($content, 0);

            $response->setBody($content);

            if ($this->getConfig()->isDebugLogEnabled()) {
                Mage::log('Cache URL: '.Mage::helper('fpc')->getNormlizedUrl(), null, self::DEBUG_LOG);
            }

            Mage::getSingleton('fpc/log')->log($cacheId, 0);
        }
    }

    public function markContainer($observer)
    {
        if (!$this->canProcessRequest(Mage::app()->getRequest())) {
            return false;
        }

        $block = $observer->getEvent()->getBlock();
        $transport = $observer->getEvent()->getTransport();
        $containers = $this->getConfig()->getContainers();
        $blockType = $block->getType();
        $blockName = $block->getNameInLayout();
        $applyBlock = false;

        if (isset($containers[$blockType][$blockName])) {
            if (!empty($containers[$blockType][$blockName]['name'])
                && $containers[$blockType][$blockName]['name'] != $block->getNameInLayout()) {
                return false;
            }

            $definition = $containers[$blockType][$blockName];
            $applyBlock = true;
        } elseif (isset($containers[$blockType]) && !empty($containers[$blockType]['container'])) {
            if (!empty($containers[$blockType]['name'])
                && $containers[$blockType]['name'] != $block->getNameInLayout()) {
                return false;
            }

            $definition = $containers[$blockType];
            $applyBlock = true;
        }

        if ($applyBlock) {
            $container = new $definition['container']($definition, $block);

            $replacerHtml = $container->getBlockReplacerHtml($transport->getHtml());

            $transport->setHtml($replacerHtml);

            $this->_containers[$container->getDefinitionHash()] = $container;
        }
    }

    protected function _getRequestId()
    {
        if ($this->_requestId == null) {
            $del = ' | ';
            $url = Mage::helper('fpc')->getNormlizedUrl();

            $this->_requestId = $url
                .$del.Mage::getDesign()->getPackageName()
                .$del.Mage::getDesign()->getTheme('layout')
                .$del.Mage::app()->getStore()->getCode()
                .$del.Mage::app()->getLocale()->getLocaleCode()
                .$del.Mage::app()->getStore()->getCurrentCurrencyCode()
                .$del.Mage::getSingleton('customer/session')->getCustomerGroupId()
                .$del.intval(Mage::app()->getRequest()->getParam('ajax'))
                .$del.intval(Mage::app()->getRequest()->isXmlHttpRequest())
                .$del.Mage::app()->getStore()->isCurrentlySecure()
                .$del.Mage::app()->getStore()->getStoreId()
                .$del.Mage::getSingleton('core/design_package')->getTheme('frontend')
                .$del.Mage::getSingleton('core/design_package')->getPackageName();

            $request = Mage::app()->getRequest();
            $action = $request->getModuleName().'/'.$request->getControllerName().'_'.$request->getActionName();

            switch ($action) {
                case 'catalog/category_view':
                case 'splash/page_view':
                    $data = Mage::getSingleton('catalog/session')->getData();
                    $params = array();
                    $paramsMap = array(
                        'display_mode' => 'mode',
                        'limit_page' => 'limit',
                        'sort_order' => 'order',
                        'sort_direction' => 'dir',
                    );
                    foreach ($paramsMap as $sessionParam => $queryParam) {
                        if (isset($data[$sessionParam])) {
                            $params[] = $queryParam.'_'.$data[$sessionParam];
                        }
                    }
                    $this->_requestId .= $del.implode($del, $params);
                    break;
            }

            foreach ($this->getConfig()->getUserAgentSegmentation() as $segment) {
                if (preg_match($segment['useragent_regexp'], Mage::helper('core/http')->getHttpUserAgent())) {
                    $this->_requestId .= $del.$segment['cache_group'];
                }
            }

            $this->_requestId = strtolower($this->_requestId);

            if ($this->getConfig()->isDebugLogEnabled()) {
                Mage::log('Reqeust ID: '.$this->_requestId, null, self::DEBUG_LOG);
            }
        }

        return $this->_requestId;
    }

    public function getRequestCacheId()
    {
        if ($this->_requestCacheId == null) {
            $this->_requestCacheId = self::REQUEST_ID_PREFIX.md5($this->_getRequestId());
        }

        return $this->_requestCacheId;
    }

    public function addRequestTag($tags)
    {
        if (count($this->_requestTags) > self::MAX_NUMBER_OF_TAGS) {
            return $this;
        }

        if (!is_array($tags)) {
            $tags = array($tags);
        }

        foreach ($tags as $tag) {
            $this->_requestTags[] = $tag;
        }

        return $this;
    }

    public function getCache()
    {
        return Mirasvit_Fpc_Model_Cache::getCacheInstance();
    }

    public function getConfig()
    {
        return Mage::getSingleton('fpc/config');
    }

    /**
     * Check if this request are allowed for process.
     *
     * @return bool
     */
    public function canProcessRequest($request = null)
    {
        if ($this->_canProcessRequest !== null) {
            return $this->_canProcessRequest;
        }

        $response = Mage::app()->getResponse();
        if ($response->getHttpResponseCode() != 200) {
            $this->_canProcessRequest = false;

            return $this->_canProcessRequest;
        }

        if ($this->isRedirect()) {
            $this->_canProcessRequest = false;

            return $this->_canProcessRequest;
        }

        if ($request && $request->getActionName() == 'noRoute') {
            $this->_canProcessRequest = false;

            return $this->_canProcessRequest;
        }

        if ($request) {
            if (Mage::helper('mstcore')->isModuleInstalled('Fishpig_NoBots')) {
                if (($bot = Mage::helper('nobots')->getBot(false)) !== false) {
                    if ($bot->isBanned()) {
                        $this->_canProcessRequest = false;

                        return $this->_canProcessRequest;
                    }
                }
            }
        }

        $result = Mage::app()->useCache('fpc');

        if ($result) {
            $result = !isset($_GET['no_cache']);
        }

        if ($result) {
            $result = !(count($_POST) > 0);
        }

        if ($result) {
            $result = Mage::app()->getStore()->getId() != 0;
        }

        if ($result) {
            $result = $this->getConfig()->getCacheEnabled(Mage::app()->getStore()->getId());
        }

        if ($result && isset($_GET) && isset($_GET['no_cache'])) {
            $result = false;
        }

        if ($result) {
            $regExps = $this->getConfig()->getAllowedPages();
            if (count($regExps) > 0) {
                $result = false;
            }
            foreach ($regExps as $exp) {
                if (preg_match($exp, Mage::helper('fpc')->getNormlizedUrl())) {
                    $result = true;
                }
            }
        }

        if ($result) {
            $regExps = $this->getConfig()->getIgnoredPages();
            foreach ($regExps as $exp) {
                if (preg_match($exp, Mage::helper('fpc')->getNormlizedUrl())) {
                    $result = false;
                }
            }
        }

        if ($request) {
            $action = $request->getModuleName().'/'.$request->getControllerName().'_'.$request->getActionName();
            if ($result && count($this->getConfig()->getCacheableActions())) {
                $result = in_array($action, $this->getConfig()->getCacheableActions());
            }
        }

        if ($result && isset($_GET)) {
            $maxDepth = $this->getConfig()->getMaxDepth();
            $result = count($_GET) <= $maxDepth;
        }

        $messageTotal = Mage::getSingleton('core/session')->getMessages()->count()
                + Mage::getSingleton('checkout/session')->getMessages()->count()
                + Mage::getSingleton('customer/session')->getMessages()->count()
                + Mage::getSingleton('catalog/session')->getMessages()->count();

        if ($result && $messageTotal) {
            $result = false;
        }

        $this->_canProcessRequest = $result;

        return $this->_canProcessRequest;
    }

    public function getRequestTags()
    {
        $this->_requestTags = array_unique($this->_requestTags);
        foreach ($this->_requestTags as $idx => $tag) {
            $this->_requestTags[$idx] = strtoupper($tag);
        }

        return $this->_requestTags;
    }

    protected function _clearMarkup(&$content)
    {
        $content = preg_replace('/<\[!--\{(.*?)\}--\]>/', '', $content);
        $content = preg_replace('/<\[!--\/\{(.*?)\}--\]>/', '', $content);
        $content = str_replace('?___SID=U', '', $content);

        return $this;
    }

    protected function _processActions()
    {
        $config = $this->getConfig();
        $request = Mage::app()->getRequest();
        $key = $request->getModuleName()
            .'_'.$request->getControllerName()
            .'_'.$request->getActionName();
        $params = new Varien_Object($request->getParams());

        if (($actions = $config->getNode('actions/'.$key)) != null) {
            foreach ($actions->children() as $action) {
                $class = (string) $action->class;
                $method = (string) $action->method;
                if (!$class) {
                    call_user_func(array($this, $method), $params);
                } else {
                    call_user_func(array($class, $method), $params);
                }
            }
        }
    }

    protected function saveSessionVariables()
    {
        $data = Mage::getSingleton('catalog/session')->getData();
        $params = array();
        $paramsMap = array(
            'display_mode',
            'limit_page',
            'sort_order',
            'sort_direction',
        );
        if ($this->_storage->getCacheId()) {
            // need restore
            foreach ($paramsMap as $sessionParam) {
                if ($this->_storage->hasData('catalog_session_'.$sessionParam)) {
                    $value = $this->_storage->getData('catalog_session_'.$sessionParam);
                    Mage::getSingleton('catalog/session')->setData($sessionParam, $value);
                }
            }
        } else {
            // need save
            foreach ($paramsMap as $sessionParam) {
                if (isset($data[$sessionParam])) {
                    $this->_storage->setData('catalog_session_'.$sessionParam, $data[$sessionParam]);
                }
            }
        }
    }

    protected function _loadRegisters($storage)
    {
        if ($storage->getCurrentCategory() && !Mage::registry('current_category')) {
            $category = Mage::getModel('catalog/category')->load($storage->getCurrentCategory());
            Mage::register('current_category', $category);
            Mage::register('current_entity_key', $category->getPath());
        }

        if ($storage->getCurrentProduct() && !Mage::registry('current_product')) {
            $product = Mage::getModel('catalog/product')->load($storage->getCurrentProduct());
            Mage::register('current_product', $product);
        }

        return $this;
    }
}
