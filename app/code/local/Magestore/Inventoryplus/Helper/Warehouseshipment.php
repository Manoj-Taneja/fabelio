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
 * @package     Magestore_Inventorywarehouse
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventorywarehouse Helper
 * 
 * @category    Magestore
 * @package     Magestore_Inventorywarehouse
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Helper_Warehouseshipment extends Mage_Core_Helper_Abstract
{
        /*
         * check product status is waiting for transfer
         * 
         * @return boolean
         */
        public function checkOrderItemWaittingFortransfer($orderItemId,$productId,$orderId,$warehouseId){
            $shipmentTransferModel = Mage::getModel('inventoryplus/warehouse_shipment')
                                            ->getCollection()
                                            ->addFieldToFilter('item_id',$orderItemId)
                                            ->addFieldToFilter('product_id',$productId)
                                            ->addFieldToFilter('order_id',$orderId)
                                            ->addFieldToFilter('warehouse_id',$warehouseId);
            $data = $shipmentTransferModel->getFirstItem()->getData();
            if($data){                
                return true;
            }
            else{
                return false;
            }
                                            
        }
        
        // public function getWarehouseNameByShipmentIdAndOrderitemId($shipmentId,$orderItemId){
		// $inventoryShipmentModel = Mage::getModel('inventoryplus/warehouse_shipment');
                // $warehouse = $inventoryShipmentModel->getCollection()
                                                    // ->addFieldToFilter('shipment_id',$shipmentId)
                                                    // ->addFieldToFilter('item_id',$orderItemId)
                                                    // ->getFirstItem();
                // if($warehouseName = $warehouse->getWarehouseName())
                    // return $warehouseName;                

	// }
	public function getWarehouseNameByShipmentIdAndOrderitemId($shipmentId,$orderItemId){
		$inventoryShipmentModel = Mage::getModel('inventoryplus/warehouse_shipment');
		$warehouse = $inventoryShipmentModel->getCollection()
											->addFieldToFilter('shipment_id',$shipmentId)
											->addFieldToFilter('item_id',$orderItemId)
											->getFirstItem();				
		if($warehouseName = $warehouse->getWarehouseName()){
			return $warehouseName;                
		}else{
			$itemCollection = Mage::getModel('sales/order_item')
								->getCollection()
								->addFieldToFilter('parent_item_id',$orderItemId);
			$itemIds = array();
			foreach($itemCollection as $item)
				$itemIds[] = $item->getId();
			$warehouse = $inventoryShipmentModel->getCollection()
											->addFieldToFilter('shipment_id',$shipmentId)
											->addFieldToFilter('item_id',array('in'=>$itemIds))
											->getFirstItem();
			if($warehouseName = $warehouse->getWarehouseName())
				return $warehouseName;    
		}
	}
}