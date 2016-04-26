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
 * @package     Magestore_Inventory
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Supplier Adminhtml Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Block_Adminhtml_Dashboard extends Mage_Adminhtml_Block_Template
{
 
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('inventoryplus/dashboard/index.phtml');       
    }
    
    protected function _prepareLayout()
    {
        $this->setChild('warehouse_shipment',
                $this->getLayout()->createBlock('inventoryplus/adminhtml_dashboard_warehouse_shipment')                                    
        );
        
        $this->setChild('adjuststock',
                $this->getLayout()->createBlock('inventoryplus/adminhtml_dashboard_adjuststock')                                    
        );
        
        $this->setChild('lowstock',
                $this->getLayout()->createBlock('inventoryplus/adminhtml_dashboard_lowstock')                                    
        );
        
        $this->setChild('dropship',
                $this->getLayout()->createBlock('inventoryplus/adminhtml_dashboard_dropship')                                    
        );
        
        parent::_prepareLayout();
    }
    
}