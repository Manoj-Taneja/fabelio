<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
class Amasty_Xlanding_Block_Catalog_Product_List_Toolbar extends Amasty_Xlanding_Block_Catalog_Product_List_Toolbar_Pure
{
 	public function getPagerUrl($params=array())
    {        
    	if ($identifier = Mage::app()->getRequest()->getParam('am_landing')) {
            return Mage::helper('amlanding/url')->getLandingUrl($params);            
    	}
		return parent::getPagerUrl($params);
    } 
    
    public function getPagerHtml()
    {
        $alias = 'product_list_toolbar_pager';
        $oldPager   = $this->getChild($alias);

        if ($oldPager instanceof Varien_Object){
            $newPager = $this->getLayout()->createBlock('amlanding/catalog_pager')
                ->setArea('frontend')
                ->setTemplate($oldPager->getTemplate());
                
            $newPager->assign('_type', 'html')
                     ->assign('_section', 'body');
                     
            $this->setChild($alias, $newPager);
        }
        return parent::getPagerHtml();
    }
    
    public function getCurrentOrder()
    {
        $ret = parent::getCurrentOrder(); 

        $order = $this->getRequest()->getParam($this->getOrderVarName(), null);
        
        $page = Mage::registry('amlanding_page');
        
        if (!$order && $page) {
            $ret = $page->getDefaultSortBy();
        }
        
        return $ret ;
    }
    
    public function getCurrentDirection()
    {
        $ret = parent::getCurrentDirection();
        
        $page = Mage::registry('amlanding_page');
        
        $dir = $this->getRequest()->getParam($this->getDirectionVarName(), null);
        if ($page && !$dir && !method_exists($this, 'reverse')){
            $ret = 'asc';
        }

        return $ret;
    }
    
    public function getModuleName()
    {
        return "Mage_Catalog";
    }
    
}