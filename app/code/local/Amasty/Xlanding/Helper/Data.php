<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */


class Amasty_Xlanding_Helper_Data extends Mage_Core_Helper_Abstract
{
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;
	
	public function getAvailableStatuses()
	{
		return array(
			self::STATUS_ENABLED => Mage::helper('amlanding')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('amlanding')->__('Disabled'),
		);
	}
	
	public function isPrice($attribute)
	{
            return $attribute && $attribute->getFrontendInput() == "price";
	}
	
	public function getOperations($filterable = false, $attribute = null)
    {
        $res = array();
        
        if ($filterable && !$this->isPrice($attribute)) {
        	$res['eq']    = $this->__('equal');
	        $res['in']    = $this->__('is one of');
	        $res['nin']   = $this->__('is not one of');
        } else {
	        $res['eq']    = $this->__('equal');
	        $res['neq']   = $this->__('not equal');
	        $res['gt']    = $this->__('greater than');
	        $res['lt']    = $this->__('less than');
	        $res['gteq']  = $this->__('equal or greater than');
	        $res['lteq']  = $this->__('equal or less than');
	        $res['in']    = $this->__('is one of');
	        $res['nin']   = $this->__('is not one of');
	        $res['like']  = $this->__('contains');
	        $res['nlike'] = $this->__('not contains');	
        }
        return $res;
    }
	
	public function getMenuPositions()
	{
		return array(
			Amasty_Xlanding_Model_Source_Menu::INCLUDE_NO => Mage::helper('amlanding')->__('No'),
			Amasty_Xlanding_Model_Source_Menu::INCLUDE_APPEND => Mage::helper('amlanding')->__('Yes, Append to existing'),
			Amasty_Xlanding_Model_Source_Menu::INCLUDE_PREPEND => Mage::helper('amlanding')->__('Yes, Prepend existing'),
		);
	}
	
	public function getColumnCount()
	{
		return Mage::getStoreConfig('amlanding/advanced/column_count');
	}
	
	public function newFilterActive()
	{
		return (Mage::app()->getRequest()->getParam('am_landing') && Mage::getStoreConfig('amlanding/advanced/new_criteria')
			&& Mage::registry('amlanding_page')->getIsNew() != 0 && !$this->isVersionLessThan(1,7));
	}
	
	public function seoLinksActive()
	{
           if ('true' !== (string)Mage::getConfig()->getNode('modules/Amasty_Shopby/active')) return false;
	   return class_exists('Amasty_Shopby_Block_Catalog_Layer_View') && Mage::getStoreConfig('amshopby/seo/urls');
	}
	
	public function isVersionLessThan($major=5, $minor=3)
    {
        $curr = explode('.', Mage::getVersion()); // 1.3. compatibility
        $need = func_get_args();
        foreach ($need as $k => $v){
            if ($curr[$k] != $v)
                return ($curr[$k] < $v);
        }
        return false;
    }
}
