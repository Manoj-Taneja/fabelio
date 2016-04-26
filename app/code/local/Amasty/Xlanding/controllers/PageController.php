<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */


class Amasty_Xlanding_PageController extends Mage_Core_Controller_Front_Action
{
    protected function _initCatagory($category)
    {
        Mage::dispatchEvent('catalog_controller_category_init_before', array('controller_action' => $this));

        if (!Mage::helper('catalog/category')->canShow($category)) {
            return false;
        }
        Mage::getSingleton('catalog/session')->setLastVisitedCategoryId($category->getId());
        Mage::register('current_category', $category);
        Mage::register('current_entity_key', $category->getPath());

        try {
            Mage::dispatchEvent(
                'catalog_controller_category_init_after',
                array(
                    'category' => $category,
                    'controller_action' => $this
                )
            );
        } catch (Mage_Core_Exception $e) {
            Mage::logException($e);
            return false;
        }

        return $category;
    }
    /**
     * View CMS page action
     *
     */
    public function viewAction()
    {
    	/* @var $hlp Amasty_Xlanding_Helper_Data */
    	$hlp = Mage::helper('amlanding');
    	
        $pageId = $this->getRequest()
            ->getParam('page_id', null);
		
        /* @var $page Amasty_Xlanding_Model_Page */    
        $page = Mage::getModel('amlanding/page')->load($pageId);
        if (!$page) {
        	return;
        }
        
        /*
         * Store page for future to use in helper
         */
        Mage::register('amlanding_page', $page);
        
        $page->applyPageRules();

        $this->_initCatagory(Mage::getSingleton('catalog/layer')->getCurrentCategory());

        $this->loadLayout();
        
        $this->enableLayeredNavigation();
        
        /*
         * Apply custom template and layout update if set
         */
        $root = $this->getLayout()->getBlock('root');
        if ($root) {
          $this->_applyLayoutUpdate($page);

          $pageLayout = $page->getRootTemplate();
          if ($pageLayout != 'empty') {
            $this->getLayout()->helper('page/layout')->applyTemplate($pageLayout);
          }
        }
		
    	  /*
         * Set Meta Information If Set
         */
        $head = $this->getLayout()->getBlock('head');

        $url = Mage::getBaseUrl() . $page->getIdentifier() . Mage::getStoreConfig('catalog/seo/category_url_suffix'); 
        $head->addLinkRel('canonical', $url);

        if ($page->getMetaTitle() != '') {
            $head->setTitle($this->trim($page->getMetaTitle()));
        }
        if ($page->getMetaKeywords() != '') { 
            $head->setKeywords($this->trim($page->getMetaKeywords()));
        }
        if ($page->getMetaDescription() != '') {
            $head->setDescription($this->trim($page->getMetaDescription()));
        }

        $toolbar = $this->getLayout()->getBlock('product_list_toolbar');

        if ($toolbar instanceof Amasty_Xlanding_Block_Catalog_Product_List_Toolbar) {
            $pager = $toolbar->getAmastyPager();
            $this->_handlePrevNextTags($pager);
        }

        /*
         * Set Custom Column Count
         */
        $list = $this->getLayout()->getBlock('product_list');

        if ($list) {
          $list->setColumnCount($page->getColumnsCount() > 0 ? $page->getColumnsCount() : $hlp->getColumnCount());
        }

        if ($topBlock = $page->getLayoutStaticTop()) {
          $this->getLayout()->getBlock('content')->insert(
            $this->getLayout()
              ->createBlock('cms/block')
              ->setBlockId($topBlock)
          );	
        }

        if ($page->getLayoutHeading() != '' ||
          $page->getLayoutFile() != '' ||
          $page->getLayoutDescription()
        ) { 
          $this->getLayout()->getBlock('content')->insert(
            $this->getLayout()->createBlock('amlanding/custom')
          );
        }

        $this->getLayout()->getBlock('content')->append(
          $this->getLayout()->createBlock('amlanding/extracats')
        );

        if ($page->getLayoutFooter()) {
          $this->getLayout()->getBlock('content')->append($this->getLayout()->createBlock('amlanding/footer'));
        }

        if ($bottomBlock = $page->getLayoutStaticBottom()) {
          $this->getLayout()->getBlock('content')->append(
            $this->getLayout()
              ->createBlock('cms/block')
              ->setBlockId($bottomBlock)
          );	
        }
        $this->_moveNavigation($page);

        if ('true' === (string)Mage::getConfig()->getNode('modules/Amasty_Shopby/active')){
            Mage::getSingleton('amshopby/observer')->handleLayoutRender();
        }	

        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('checkout/session');
        $this->renderLayout();
    }
    
    protected function _handlePrevNextTags($pager)
    {
        if ($pager) {
            $head = $this->getLayout()->getBlock('head');

            if (!$pager->isFirstPage()) {
                $head->addLinkRel('prev', $pager->getPreviousPageUrl());
            }

            if (!$pager->isLastPage()) {
                $head->addLinkRel('next', $pager->getNextPageUrl());
            };
        }

    }
    
    protected function _applyLayoutUpdate($page)
    {
        $layoutUpdate = $page->getLayoutUpdateXml();
        
        if ($page->getIncludeNavigation()) {
            $layoutUpdate .= $this->_getNaviationLayoutXml();
        }
        
        if ($layoutUpdate != '') {
            $this->loadLayoutUpdates();
            $this->getLayout()->getUpdate()->addUpdate($layoutUpdate);
            $this->generateLayoutXml()->generateLayoutBlocks();
        }
    }
    
    protected function _shopbyEnabled(){
        return 'true' === (string)Mage::getConfig()->getNode('modules/Amasty_Shopby/active');
    }
    
    protected function _getNaviationLayoutXml(){
        $ret = '';
        
        if (!$this->_shopbyEnabled()){
            $ret .= '<block type="catalog/layer_view" name="catalog.leftnav" before="-" after="currency" template="catalog/layer/view.phtml">
                <block type="core/text_list" name="catalog.leftnav.state.renderers" as="state_renderers" />
            </block>';
        } else {
            $ret .= '<block type="amshopby/catalog_layer_view" name="amshopby.navleft" before="-" template="catalog/layer/view.phtml"/>
            <reference name="content">
                <block type="amshopby/catalog_layer_view_top" name="amshopby.navtop" before="-" template="amasty/amshopby/view_top.phtml"/>
            </reference>
            ';
        }
        
        return $ret;
    }
    
    
    protected function _moveNavigation($page){
        $leftnav = null;
        
        if ($this->_shopbyEnabled()){
            $leftnav = $this->getLayout()->getBlock('amshopby.navleft');
        }
        
        if (!$leftnav)
            $leftnav = $this->getLayout()->getBlock('catalog.leftnav');
                
        $blockPlacement = $page->getIncludeNavigation();

        $container = $this->getLayout()->getBlock($blockPlacement);

        if ($container)
            $container->insert($leftnav);
    }
    
    /**
     * Enable layered navigation block if seo links is on
     * @return void|boolean
     */
    private function enableLayeredNavigation()
    {
    	if (!Mage::helper('amlanding')->seoLinksActive()) {
    		return false;
    	}
    	
    	$categoryId = (int) Mage::app()->getStore()->getRootCategoryId();
        if (!$categoryId) {
            $this->_forward('noRoute'); 
            return;
        }

        $category = Mage::getModel('catalog/category')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($categoryId);
            
        if (!Mage::registry('current_category'))
            Mage::register('current_category', $category);

        Mage::getSingleton('catalog/session')->setLastVisitedCategoryId($category->getId());  
          
        // need to prepare layer params
        try {
            Mage::dispatchEvent('catalog_controller_category_init_after', 
                array('category' => $category, 'controller_action' => $this));
        } catch (Mage_Core_Exception $e) {
            Mage::logException($e);
            return;
        }
    }
    
	private function trim($str)
    {
        $str = strip_tags($str);
        $str = str_replace('"', '', $str);
        return trim($str, " -");
    } 
}
