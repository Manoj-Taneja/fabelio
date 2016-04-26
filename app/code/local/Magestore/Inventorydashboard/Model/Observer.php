<?php
/**
 * Magestore
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category    Magestore
 * @package     Magestore_Inventorydashboard
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventorydashboard Observer Model
 * 
 * @category    Magestore
 * @package     Magestore_Inventorydashboard
 * @author      Magestore Developer
 */
class Magestore_Inventorydashboard_Model_Observer
{
    /**
     * process controller_action_predispatch event
     *
     * @return Magestore_Inventorydashboard_Model_Observer
     */
    public function controllerActionPredispatch($observer)
    {
        $action = $observer->getEvent()->getControllerAction();
        return $this;
    }
    
    //add Menu
    public function addMenu($observer) {
        $menu = $observer->getEvent()->getMenus()->getMenu();

        $menu['dashboard'] = array('label' => Mage::helper('inventorydashboard')->__('Dashboards'),
            'sort_order' => 0,
            'url' => Mage::helper("adminhtml")->getUrl("inventorydashboardadmin/adminhtml_inventorydashboard/", array("_secure" => Mage::app()->getStore()->isCurrentlySecure())),
            'active' => (in_array(Mage::app()->getRequest()->getControllerName(),array('adminhtml_inventorydashboard'))) ? true : false,
            'level' => 0,           
        );
        $observer->getEvent()->getMenus()->setData('menu', $menu);
    }
    
    //change Dashboard
    public function changeDashboard($observer)
    {
        header('Location: '.Mage::helper("adminhtml")->getUrl("inventorydashboardadmin/adminhtml_inventorydashboard/", array("_secure" => Mage::app()->getStore()->isCurrentlySecure())));
        exit;        
    }
}