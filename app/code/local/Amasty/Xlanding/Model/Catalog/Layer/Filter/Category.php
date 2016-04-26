<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
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
                /** @var Amasty_Shopby_Model_Url_Builder $urlBuilder */
                $urlBuilder = Mage::getModel('amshopby/url_builder');
                $urlBuilder->reset();
                $urlBuilder->changeQuery(array('cat' => $itemData['value']));
                $url = $urlBuilder->getUrl();
            } else {
            	$url = Mage::helper('amlanding/url')->getLandingUrl(array(
                    'cat' => $itemData['value'],
                    'p' => 1
                ));
            }
            $obj->setUrl($url);

            $items[] = $obj;
        }
        $this->_items = $items;
        return $this;
    }
}