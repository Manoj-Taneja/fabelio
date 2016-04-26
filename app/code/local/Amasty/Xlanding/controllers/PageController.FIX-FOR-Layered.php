<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */


class Amasty_Xlanding_PageController extends Mage_Core_Controller_Front_Action
{
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
        
        

        $opt = $page->getAttributesAsArray();
        Mage::register('amlanding_attributes', $opt);
        
        $this->loadLayout();
        
        $this->enableLayeredNavigation();
        
        /*
         * Apply custom template and layout update if set
         */
		$root = $this->getLayout()->getBlock('root');
		if ($root) {
			$pageLayout = $page->getRootTemplate();
			if ($pageLayout != 'empty') {
	            $this->getLayout()->helper('page/layout')->applyTemplate($pageLayout);
			}
			
			$layoutUpdate = $page->getLayoutUpdateXml();
			if ($layoutUpdate != '') {
				$this->loadLayoutUpdates();
        		$this->getLayout()->getUpdate()->addUpdate($layoutUpdate);
        		$this->generateLayoutXml()->generateLayoutBlocks();
			}
		}
		
    	/*
         * Set Meta Information If Set
         */
		$head = $this->getLayout()->getBlock('head');
		if ($page->getMetaTitle() != '') {
			$head->setTitle($this->trim($page->getMetaTitle()));
		}
		if ($page->getMetaKeywords() != '') { 
			$head->setDescription($this->trim($page->getMetaKeywords()));
		}
		if ($page->getMetaDescription() != '') {
            $head->setKeywords($this->trim($page->getMetaDescription()));
		}

		/*
		 * Set Custom Column Count
		 */
		$list = $this->getLayout()->getBlock('product_list');
		if ($list) {
			$list->setColumnCount($page->getColumnsCount() > 0 ? $page->getColumnsCount() : $hlp->getColumnCount());
		}

		if ($topBlock = $page->getLayoutStaticTop()) {
			$this->getLayout()->getBlock('content')->insert($this->getLayout()
                    ->createBlock('cms/block')
                    ->setBlockId($topBlock));	
		}
		
    	if ($bottomBlock = $page->getLayoutStaticBottom()) {
			$this->getLayout()->getBlock('content')->append($this->getLayout()
                    ->createBlock('cms/block')
                    ->setBlockId($bottomBlock));	
		}
		
		$this->includeNavigation($page);
		$this->renderLayout();
    }
    
    
    /**
     * Include Navigation on landing page?
     * 
     * @var $page Amasty_Xlanding_Model_Page
     */
    private function includeNavigation($page)
    {
    	if ($page->getIncludeNavigation() === Amasty_Xlanding_Model_Source_Navigation::INCLUDE_NO || 'true' != (string)Mage::getConfig()->getNode('modules/Amasty_Shopby/active')) {
    		return;
    	}
    	
    	$block = $this->getLayout()->getBlock('amshopby.navleft');
    	$classExists = class_exists('Amasty_Shopby_Block_Catalog_Layer_View') && ('true' == (string)Mage::getConfig()->getNode('modules/Amasty_Shopby/active'));
    	
    	if (!$block && $classExists) {
			$block = $this->getLayout()->createBlock(
				'Amasty_Shopby_Block_Catalog_Layer_View',
				'amshopby.navleft',
				array(
					'template' => 'catalog/layer/view.phtml',
				)
			);
			
			$blockPlacement = $page->getIncludeNavigation();
			
			$container = $this->getLayout()->getBlock($blockPlacement);
			if ($container) {
				$container->insert($block);
			}
			
			$blocks = array(
            array(
                'name' => 'Amasty_Shopby_Block_Catalog_Layer_View_Top',
                'alias' => 'amshopby.navtop',
                'template' => 'amshopby/view_top.phtml',
                'placement' => 'content'
            ),
            array(
                'name' => 'Amasty_Shopby_Block_Top',
                'alias' => 'amshopby.top',
                'template' => 'amshopby/top.phtml',
                'placement' => 'content'
            ),
            
    	);
    	
    	
    	foreach ($blocks as $item) {
            if (!class_exists($item['name'])) {
                continue;
            }
            
            $block = $this->getLayout()->createBlock(
				$item['name'],
				$item['alias'],
				array(
					'template' => $item['template']
				)
			);
			
			$container = $this->getLayout()->getBlock($item['placement']);
			if ($container) {
				$container->insert($block);
			}
    	}
    	
    	
    	
			return;
    	}
    	
    	
    	
    	
    	/*
    	 * Default Navigation
    	 */
    	$block = $this->getLayout()->getBlock('catalog.leftnav');
    	if (!$block) {
	    	$block = $this->getLayout()->createBlock(
			'Mage_Catalog_Block_Layer_View',
				'catalog.leftnav',
				array(
					'template' => 'catalog/layer/view.phtml',
				)
			);
			
			$blockPlacement = $page->getIncludeNavigation();
			
			$container = $this->getLayout()->getBlock($blockPlacement);
			if ($container) {
				$container->insert($block);
			}
    	}
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
