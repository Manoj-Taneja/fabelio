<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */


class Amasty_Xlanding_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{
    /**
     * Initialize Controller Router
     *
     * @param Varien_Event_Observer $observer
     */
    public function initControllerRouters($observer)
    {
        /* @var $front Mage_Core_Controller_Varien_Front */
        $front = $observer->getEvent()->getFront();
        $front->addRouter('amlanding', $this);
    }

    /**
     * Validate and Match Cms Page and modify request
     *
     * @param Zend_Controller_Request_Http $request
     * @return bool
     */
    public function match(Zend_Controller_Request_Http $request)
    {
     	if (Mage::app()->getStore()->isAdmin()) {
            return false;
        }
        
    	$pathInfo = $request->getPathInfo();
        // remove suffix if any
        $suffix = Mage::helper('amlanding/url')->getSuffix();
        if ($suffix && '/' != $suffix){
            $pathInfo = str_replace($suffix, '', $pathInfo);
        }
        
        $pathInfo = explode('/', trim($pathInfo, '/ '), 2);
        $identifier = $pathInfo[0];
        $params     = (isset($pathInfo[1]) ? $pathInfo[1] : '');
        
        
		/* @var $page Amasty_Xlanding_Model_Page */
        $page   = Mage::getModel('amlanding/page');
        $pageId = $page->checkIdentifier($identifier, Mage::app()->getStore()->getId());
        if (!$pageId) {
            return false;
        }
        

        $params = trim($params, '/ ');
        if ($params){
            $params = explode('/', $params);
            Mage::register('amshopby_current_params', $params);
        }

        $request->setModuleName('amlanding')
            ->setControllerName('page')
            ->setActionName('view')
            ->setParam('page_id', $pageId)
            ->setParam('am_landing', $identifier)
        ;
            
        return true;
    }
}
