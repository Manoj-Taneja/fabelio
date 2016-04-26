<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

/**
 * SEO Suite extension
 *
 * @category   MageWorx
 * @package    MageWorx_SeoSuite
 * @author     MageWorx Dev Team <dev@mageworx.com>
 */

class MageWorx_SeoSuite_Block_Catalog_Product_List_Toolbar extends Mage_Catalog_Block_Product_List_Toolbar
{

    public function getPagerUrl($params=array())
    {
        if ($identifier = Mage::app()->getRequest()->getParam('am_landing')) {
    		if (count($params) > 0) {
    			return $identifier . '?' . http_build_query($params);	
    		}
    		return $identifier; 
    	}
		
        $urlParams = array();
        $urlParams['_current']  = true;
        $urlParams['_escape']   = true;
        $urlParams['_use_rewrite']   = true;
        $urlParams['_query']    = $params;
        return Mage::helper('seosuite')->getLayerFilterUrl($urlParams);
    }
    
    public function getPagerHtml()
    {
        if ($identifier = Mage::app()->getRequest()->getParam('am_landing')) {
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
        return parent::getPagerHtml();
    }
}
