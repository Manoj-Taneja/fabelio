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
 * Inventory Adminhtml Controller
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Adminhtml_DashboardController extends Mage_Adminhtml_Controller_Action
{
    /**
     * init layout and set active for current menu
     *
     * @return Magestore_Inventory_Adminhtml_InventoryController
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('inventoryplus')
            ->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Items Manager'),
                Mage::helper('adminhtml')->__('Item Manager')
            );
        return $this;
    }
 
    /**
     * index action
     */
    public function indexAction()
    {          		
        $this->_title($this->__('Dashboard Inventory'));
        $this->loadLayout();
        $this->_setActiveMenu('inventoryplus');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Dashboard Inventory'), Mage::helper('adminhtml')->__('Dashboard Inventory'));
        $this->renderLayout();
    }
    
    public function importdataAction(){
        ini_set('max_execution_time' , 18000);            
            $resource = Mage::getModel('core/resource');            
            $readConnection = $resource->getConnection('core_read');
            $writeConnection = $resource->getConnection('core_write');            
            $warehouse = Mage::getModel('inventoryplus/warehouse')
                                            ->getCollection()
                                            ->getFirstItem();		 
            $writeConnection->query('DELETE FROM '.$resource->getTableName('inventoryplus/warehouse_product'));
		$writeConnection->query('DELETE FROM '.$resource->getTableName('inventoryplus/warehouse_order'));
		$writeConnection->query('DELETE FROM '.$resource->getTableName('inventoryplus/inventory_product'));
            //add product with qty to warehouse
            $productCollection = Mage::getModel('catalog/product')->getCollection()
                    ->addAttributeToSelect('sku')
                    ->addAttributeToSelect('name')
                    ->addAttributeToSelect('type_id')
                    ->addAttributeToFilter('type_id', array('nin' => array('configurable', 'bundle', 'grouped')));
            if (Mage::helper('catalog')->isModuleEnabled('Mage_CatalogInventory')) {
                $productCollection->joinField('qty', 'cataloginventory/stock_item', 'qty', 'product_id=entity_id', '{{table}}.stock_id=1', 'left');
            }
            $warehouseProduct = array();
            $inventoryProduct = array();
            foreach ($productCollection as $product) {
                $qty_not_shipped = array();
                $product_id = $product->getId();
				
				$stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product->getId());  
				$manageStock = $stockItem->getManageStock();
				if($stockItem->getUseConfigManageStock()){
					$manageStock = Mage::getStoreConfig('cataloginventory/item_options/manage_stock',Mage::app()->getStore()->getStoreId());                                        
				}
				if(!$manageStock){					
					$warehouseProduct[] = array(
                    'product_id' => $product->getId(),
                    'warehouse_id' => $warehouse->getId(),
                    'total_qty' => 0,
                    'available_qty' => 0,
                    'created_at' => now(),
                    'updated_at' => now()                
					);					
				} else {
					$orderItems = $readConnection->fetchAll("SELECT `item_id`,`order_id`,`qty_ordered`,`qty_canceled`,`qty_shipped`,`qty_refunded`, `parent_item_id` 
                                                                                                                    FROM " . $resource->getTableName('sales/order_item')." as `orderitem`" 
                                                                                                                    ." JOIN ".$resource->getTableName('sales/order')." as `order`"
                                                                                                                    ." ON orderitem.order_id = order.entity_id"
                                                                                                                    ." AND orderitem.product_id = ".$product_id
                                                                                                                    ." AND order.status IN ('pending','processing')");
					foreach ($orderItems as $orderItem) {
						$qty_ordered = $orderItem['qty_ordered'];
						$qty_canceled = $orderItem['qty_canceled'];
						$qty_shipped = $orderItem['qty_shipped'];
						$qty_refunded = $orderItem['qty_refunded'];
						$parent_item_id = $orderItem['parent_item_id'];
						if ($orderItem['parent_item_id']) {                
							$order_parent_items = $readConnection->fetchAll("SELECT `qty_shipped`,`qty_ordered`,`qty_canceled`,`product_type` 
																																				 FROM " . $resource->getTableName('sales/order_item')." as `orderitem`" 
																																				." JOIN ".$resource->getTableName('sales/order')." as `order`"
																																				." ON orderitem.order_id = order.entity_id"
																																				." AND orderitem.item_id = ".$orderItem['parent_item_id']
																																				." AND order.status IN ('pending','processing')");
							if ($qty_shipped == 0) {
								foreach ($order_parent_items as $p) {
									if ($p['product_type'] == 'configurable') {
										$qty_shipped = $p['qty_shipped'];
									}
								}
							}
							if($qty_ordered == 0){                    
								foreach ($order_parent_items as $p) {                        
									$qty_ordered = $p['qty_ordered'];                        
								}
							}
							if($qty_canceled == 0){
								$qty_canceled = $p['qty_canceled'];
							}
						}
						$qty_not_ship = $qty_ordered - $qty_canceled - max($qty_shipped,$qty_refunded);   
						if($qty_not_ship > 0){
							try{
								$warehouseOrder = Mage::getModel('inventoryplus/warehouse_order');
								$warehouseOrder->setOrderId($orderItem['order_id'])
											   ->setWarehouseId($warehouse->getId())
											   ->setProductId($product_id)
											   ->setItemId($orderItem['item_id'])
											   ->setQty($qty_not_ship)
											   ->save();
							}catch(Exception $e){

							}
						}
						$qty_not_shipped[] = $qty_not_ship;
					}
					$qtyForDefault = (int) array_sum($qty_not_shipped) + (int) $product->getQty();
					$warehouseProduct[] = array(
                    'product_id' => $product->getId(),
                    'warehouse_id' => $warehouse->getId(),
                    'total_qty' => $qtyForDefault,
                    'available_qty' => (int) $product->getQty(),
                    'created_at' => now(),
                    'updated_at' => now()                
					);					
				}
                $inventoryProduct[] = array(
						'product_id' => $product->getId(),
						'last_update' => now(),
						'cost_price' => $product->getCost()
					);                
                if (count($warehouseProduct) == 1000) {
                    $writeConnection->insertMultiple($resource->getTableName('inventoryplus/warehouse_product'), $warehouseProduct);
                    $warehouseProduct = array();
                }

                if (count($inventoryProduct) == 1000) {
                    $writeConnection->insertMultiple($resource->getTableName('inventoryplus/inventory_product'), $inventoryProduct);
                    $inventoryProduct = array();
                }
            }
            if (!empty($warehouseProduct)) {
                $writeConnection->insertMultiple($resource->getTableName('inventoryplus/warehouse_product'), $warehouseProduct);
            }
            if (!empty($inventoryProduct)) {
                $writeConnection->insertMultiple($resource->getTableName('inventoryplus/inventory_product'), $inventoryProduct);
            }
            
            $sql = 'UPDATE '.$resource->getTableName('erp_inventory_checkupdate')
                    .' SET `is_insert_data` = "1"';
            $writeConnection->query($sql);        
            
        echo 1;
    }    
}