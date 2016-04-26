<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
class Amasty_Xlanding_Block_Catalog_Product_List_Toolbar extends Amasty_Xlanding_Block_Catalog_Product_List_Toolbar_Pure
{
 	public function getPagerUrl($params=array())
    {        
            return Mage::helper('amlanding/url')->getLandingUrl($params);            
    	}
    
    public function getAmastyPager(){
        $alias = 'product_list_toolbar_pager';
        $oldPager   = $this->getChild($alias);

        if ($oldPager instanceof Varien_Object){

            $layer = Mage::getSingleton('catalog/layer');
            $collection = $layer->getProductCollection();

            $newPager = $this->getLayout()->createBlock('amlanding/catalog_pager')
                ->setArea('frontend')
                ->setCollection($collection)
                ->setTemplate($oldPager->getTemplate());
                
            $newPager->assign('_type', 'html')
                     ->assign('_section', 'body');
                     
            $this->setChild($alias, $newPager);
        }

        return $this->getChild($alias);
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

    public function getModuleName()
    {
        return "Mage_Catalog";
    }
    
}