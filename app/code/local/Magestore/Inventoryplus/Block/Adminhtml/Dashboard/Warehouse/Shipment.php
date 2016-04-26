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
class Magestore_Inventoryplus_Block_Adminhtml_Dashboard_Warehouse_Shipment extends Mage_Adminhtml_Block_Template
{
 
    
    public function __construct()
    {        
        parent::__construct();
        $this->setTemplate('inventoryplus/dashboard/warehouse/shipment.phtml');       
    }
    
    protected function _prepareLayout()
    {       
        parent::_prepareLayout();
    }
    
    /**
     * get warehouse shipment collection
     *
     * @return object
     */
   
    public function getWarehouseShipmentCollection() {
        
        $resource = Mage::getSingleton('core/resource');
        $collection = Mage::getModel('sales/order_shipment')->getCollection();
        $collection->addAttributeToSelect('*');
        
        $collection->setOrder('created_at','DESC')->setPageSize(10)->getSelect()
                ->joinLeft(array('order' => $resource->getTableName('sales/order')), 'main_table.order_id=order.entity_id', array('shipping_progress' => 'shipping_progress','grand_total'=>'grand_total','order_increment_id'=>'increment_id'))                
                ->join(
                          array('warehouse_shipment' => $resource->getTableName('inventoryplus/warehouse_shipment')), 'main_table.entity_id=warehouse_shipment.shipment_id', array('GROUP_CONCAT(DISTINCT warehouse_shipment.warehouse_name) AS names' , 'qty_shipped'=>'qty_shipped')
                 )                
                ->group('main_table.entity_id');
       
        return $collection;
    }
    
   
}