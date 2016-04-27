<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */


class Amasty_Xlanding_Helper_Url extends Mage_Core_Helper_Abstract
{
	public function getLandingUrl($query = null, $exclude = array())
	{
		if (!$query) {
			$query = Mage::app()->getRequest()->getParams();
		}
		
		$query = array_merge(Mage::app()->getRequest()->getParams(), $query);
		
		foreach ($exclude as $excludeKey) {
			if (isset($query[$excludeKey])) {
				unset($query[$excludeKey]);
			}
		}
		unset($query['page_id']);
		unset($query['am_landing']);
		
        $key = Mage::app()->getRequest()->getParam('am_landing');
        if (count($query) > 0) {
            $query = '?' . http_build_query($query);
        } else {
            $query = '';
        }
        $suffix = $this->getSuffix();
        
        return Mage::getBaseUrl() . $key . $suffix . $query;
	}
	
	public function getClearUrl()
	{
	    $key = Mage::app()->getRequest()->getParam('am_landing');
	    $suffix = Mage::getStoreConfig('catalog/seo/category_url_suffix');
	    
       	return Mage::getBaseUrl() . $key . $suffix;
	}

public function getSuffix()
{
    $suffix = Mage::getStoreConfig('catalog/seo/category_url_suffix');

        if ($suffix && '/' != $suffix){
            if (substr($suffix, 0, 1) != '.') $suffix = '.' . $suffix; // for EE;
        }
    return $suffix;

}


}
