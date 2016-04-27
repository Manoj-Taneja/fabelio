<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
class Amasty_Xlanding_Model_Catalog_Layer_Filter_Category extends Amasty_Xlanding_Model_Catalog_Layer_Filter_Category_Pure
{
    protected function _initItems()
    {
    	if (!$key = Mage::app()->getRequest()->getParam('am_landing')) {
    		return parent::_initItems();
    	}
    	
        $data  = $this->_getItemsData();
        $items = array();
        foreach ($data as $itemData) {
            if (!$itemData)
                continue;
                
            $obj = new Varien_Object();
            $obj->setData($itemData);
            if (isset($itemData['id'])) {
            	
            	/*
            	 * Navigation works here
            	 */
                $param = 'cat='.$itemData['id'];
                $url = Mage::helper('amshopby/url')->getFullUrl();

                $url = preg_replace('/(\?|&)cat=\d+/', '$1'.$param, $url, 1, $count);
                if (!$count) {
                    if (strpos($url, '?') !== false) {
                        $url .= '&' . $param;
                    } else {
                        $url .= '?' . $param;
                    }
                }
            } else {
            	$url = Mage::helper('amlanding/url')->getLandingUrl(array('cat' => $itemData['value']));
            }
            $obj->setUrl($url);

            $items[] = $obj;
        }
        $this->_items = $items;
        return $this;
    }
}