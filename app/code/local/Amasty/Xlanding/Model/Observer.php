<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */


class Amasty_Xlanding_Model_Observer
{
    public function convertLayerBlock(Varien_Event_Observer $observer)
    {
        $front = Mage::app()->getRequest()->getRouteName();
        $controller = Mage::app()->getRequest()->getControllerName();
        $action = Mage::app()->getRequest()->getActionName();

        // Perform this operation if we're on a category view page or search results page
        if (($front == 'amlanding' && $controller == 'page' && $action == 'view') &&
            ('true' == (string)Mage::getConfig()->getNode('modules/Mage_ConfigurableSwatches/active')))   {

            // Block name for layered navigation differs depending on which Magento edition we're in
            $blockName = 'catalog.leftnav';
            if (Mage::getEdition() == Mage::EDITION_ENTERPRISE) {
                $blockName = ($front == 'catalogsearch') ? 'enterprisesearch.leftnav' : 'enterprisecatalog.leftnav';
            } elseif ($front == 'catalogsearch') {
                $blockName = 'catalogsearch.leftnav';
            }
            Mage::helper('configurableswatches/productlist')->convertLayerBlock($blockName);
        }
    }
}