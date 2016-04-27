<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

/**
 * Layered navigation state
 *
 * @category   Mage
 * @package    Mage_Catalog
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Amasty_Xlanding_Block_Catalog_Layer_State extends Mage_Catalog_Block_Layer_State
{

    /**
     * Retrieve Clear Filters URL
     *
     * @return string
     */
    public function getClearUrl()
    {
    	if (!Mage::app()->getRequest()->getParam('am_landing')) {
    		return parent::getClearUrl();
    	}
        return Mage::helper('amlanding/url')->getClearUrl();
    }
}
