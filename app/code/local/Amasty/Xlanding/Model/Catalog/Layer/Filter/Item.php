<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */ 
class Amasty_Xlanding_Model_Catalog_Layer_Filter_Item extends Amasty_Xlanding_Model_Catalog_Layer_Filter_Item_Pure
{
    public function getUrl()
    {
        if ($key = Mage::app()->getRequest()->getParam('am_landing')) {
			if (!Mage::helper('amlanding')->seoLinksActive()) {
				return Mage::helper('amlanding/url')->getLandingUrl(array(
					'p' => 1,
					$this->getFilter()->getRequestVar() => $this->getValue()));
			}
        }
        return parent::getUrl();
    }
    
	public function getRemoveUrl()
    {
    	if ($key = Mage::app()->getRequest()->getParam('am_landing')) {
        	$exclude = array(
        		$this->getFilter()->getRequestVar()
        	);
        	if (!Mage::helper('amlanding')->seoLinksActive()) {
        		return Mage::helper('amlanding/url')->getLandingUrl(array(
					'p' => 1
				), $exclude);
        	}
        }
        return parent::getRemoveUrl();                
    }

}