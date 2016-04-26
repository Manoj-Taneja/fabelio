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
 * Inventory Observer Model
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Model_Observer {

    /**
     * process controller_action_predispatch event
     *
     * @return Magestore_Inventory_Model_Observer
     */
    
    public function controllerActionPredispatch($observer) {
        $refreshCache = false;

        if (Mage::helper('core')->isModuleEnabled('Magestore_Standardinventory')) {

            $this->disableModule('Magestore_Standardinventory');
            $template = file_get_contents(Mage::getBaseDir('etc') . DS . 'modules' . DS . 'Magestore_Standardinventory.xml');
            $standardInventory = Mage::getBaseDir('etc') . DS . 'modules' . DS . 'Magestore_Standardinventory.xml';
            if ($template) {
                $template = str_replace('true', 'false', $template);
            }
            chmod($standardInventory, 0777);
            file_put_contents($standardInventory, $template);

            $refreshCache = true;
        }

        if (Mage::helper('core')->isModuleEnabled('Magestore_Inventory')) {
            // set permission for warehouse
            $checkUpdate = Mage::getModel('inventoryplus/checkupdate')->getCollection()->addFieldToFilter('inserted_data', 0)->getFirstItem();
            if ($checkUpdate->getId()) {

                $admins = Mage::getModel('admin/user')->getCollection();


                $warehouseCollection = Mage::getModel('inventoryplus/warehouse')->getCollection()
                        ->addFieldToFilter('status', 1);

                foreach ($warehouseCollection as $warehouse) {
                    try {
                        foreach ($admins as $admin) {

                            if ($warehouse->getIsUnwarehouse()) {
                                $checkPermissionExists = Mage::getModel('inventoryplus/warehouse_permission')->getCollection()
                                        ->addFieldToFilter('admin_id', $admin->getId())
                                        ->addFieldToFilter('warehouse_id', $warehouse->getId())
                                        ->getFirstItem();
                                if ($checkPermissionExists->getId()) {
                                    try {
                                        $checkPermissionExists->setCanEditWarehouse(1)
                                                ->setCanAdjust(1)
                                                ->save();
                                    } catch (Exception $e) {
                                        Mage::log($e->getMessage(), null, 'inventory_installation.log');
                                    }
                                } else {
                                    try {
                                        Mage::getModel('inventoryplus/warehouse_permission')
                                                ->setData('warehouse_id', $warehouse->getId())
                                                ->setData('admin_id', $admin->getId())
                                                ->setData('can_edit_warehouse', 1)
                                                ->setData('can_adjust', 1)
                                                ->save();
                                    } catch (Exception $e) {
                                        Mage::log($e->getMessage(), null, 'inventory_installation.log');
                                    }
                                }
                            } else {
                                $checkPermissionExists = Mage::getModel('inventoryplus/warehouse_permission')->getCollection()
                                        ->addFieldToFilter('admin_id', $admin->getId())
                                        ->addFieldToFilter('warehouse_id', $warehouse->getId())
                                        ->getFirstItem();

                                $warehousePermission = Mage::getModel('inventory/assignment')->getCollection()
                                        ->addFieldToFilter('warehouse_id', $warehouse->getId())
                                        ->addFieldToFilter('admin_id', $admin->getId())
                                        ->getFirstItem();
                                if ($checkPermissionExists->getId()) {
                                    try {
                                        $checkPermissionExists->setCanEditWarehouse($warehousePermission->getCanEditWarehouse())
                                                ->setCanAdjust($warehousePermission->getCanAdjust())
                                                ->save();
                                    } catch (Exception $e) {
                                        Mage::log($e->getMessage(), null, 'inventory_installation.log');
                                    }
                                } else {
                                    try {
                                        Mage::getModel('inventoryplus/warehouse_permission')
                                                ->setData('warehouse_id', $warehouse->getId())
                                                ->setData('admin_id', $admin->getId())
                                                ->setData('can_edit_warehouse', $warehousePermission->getCanEditWarehouse())
                                                ->setData('can_adjust', $warehousePermission->getCanAdjust())
                                                ->save();
                                    } catch (Exception $e) {
                                        Mage::log($e->getMessage(), null, 'inventory_installation.log');
                                    }
                                }
                            }
                        }
                    } catch (Exception $e) {
                        Mage::log($e->getMessage(), null, 'inventory_installation.log');
                    }
                }
                try {
                    $checkUpdate->setInsertedData(1)->save();
                } catch (Exception $e) {
                    Mage::log($e->getMessage(), null, 'inventory_installation.log');
                }

                $refreshCache = true;
            }

            $this->disableModule('Magestore_Inventory');
            $templateInventory = file_get_contents(Mage::getBaseDir('etc') . DS . 'modules' . DS . 'Magestore_Inventory.xml');
            $inventory = Mage::getBaseDir('etc') . DS . 'modules' . DS . 'Magestore_Inventory.xml';

            if ($templateInventory) {
                $templateInventory = str_replace('true', 'false', $templateInventory);
            }
            chmod($inventory, 0777);
            file_put_contents($inventory, $templateInventory);

            if (Mage::helper('core')->isModuleEnabled('Magestore_Inventorydropship')) {
                $version = Mage::getConfig()->getModuleConfig("Magestore_Inventorydropship")->version;

                if (trim($version) == '0.1.1') {
                    try {
                        $this->disableModule('Magestore_Inventorydropship');
                        $templateDropship = file_get_contents(Mage::getBaseDir('etc') . DS . 'modules' . DS . 'Magestore_Inventorydropship.xml');
                        $dropship = Mage::getBaseDir('etc') . DS . 'modules' . DS . 'Magestore_Inventorydropship.xml';
                        if ($templateDropship) {
                            $templateDropship = str_replace('true', 'false', $templateDropship);
                        }
                        chmod($dropship, 0777);
                        file_put_contents($dropship, $templateDropship);

                        $adminHTMLDropship = Mage::getBaseDir('code') . DS . 'local' . DS . 'Magestore' . DS . 'Inventorydropship' . DS . 'etc' . DS . 'adminhtml.xml';
                        chmod($adminHTMLDropship, 0777);
                        unlink($adminHTMLDropship);
                        $refreshCache = true;
                    } catch (Exception $e) {
                        Mage::log($e->getMessage(), null, 'inventory_installation.log');
                    }
                }
            }

            $refreshCache = true;
        }






        //refresh cache
        if ($refreshCache) {
            $types = array('config', 'layout', 'block_html', 'collections', 'eav', 'translate');
            foreach ($types as $type) {
                Mage::app()->getCacheInstance()->cleanType($type);
                Mage::dispatchEvent('adminhtml_cache_refresh_type', array('type' => $type));
            }
        }
    }

    /**
     * disable Module 
     * 
     */
    protected function disableModule($module) {
        $section = 'advanced';
        $groups = array();
        foreach (Mage::app()->getWebsites() as $website) {
            foreach ($website->getGroups() as $group) {
                $stores = $group->getStores();
                foreach ($stores as $store) {
                    $groups['modules_disable_output']['fields'][$module] = array('value' => 1);

                    try {
                        Mage::getSingleton('adminhtml/config_data')
                                ->setSection($section)
                                ->setWebsite($website->getCode())
                                ->setStore($store->getCode())
                                ->setGroups($groups)
                                ->save();
                    } catch (Exception $e) {
                        Mage::log($e->getMessage(), null, 'inventory_installation.log');
                    }
                }
            }
        }
        $groups['modules_disable_output']['fields'][$module] = array('value' => 1);
        try {
            Mage::getSingleton('adminhtml/config_data')
                    ->setSection($section)
                    ->setWebsite(null)
                    ->setStore(null)
                    ->setGroups($groups)
                    ->save();
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'inventory_installation.log');
        }
    }

    /**
     * process catalog_product_save_before event
     *
     * @return Magestore_Inventory_Model_Observer
     */
    //get old qty of product before update
    public function catalogProductSaveBefore($observer) {
        if (Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse'))
            return;
        if (Mage::registry('INVENTORY_CORE_PRODUCT_SAVE_BEFORE'))
            return;
        Mage::register('INVENTORY_CORE_PRODUCT_SAVE_BEFORE', true);
        $product = $observer->getProduct();
        if (in_array($product->getTypeId(), array('configurable', 'bundle', 'grouped')))
            return;
        $qty = 0;
        if ($product->getId()) {
            $item = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);
            $qty = $item->getQty();
        }
        Mage::getModel('admin/session')->setData('inventory_before_update_product_item', $qty);
    }

    /**
     * process catalog_product_save_after event
     *
     * @return Magestore_Inventory_Model_Observer
     */
    //update qty product for warehouse when product change
    public function catalogProductSaveAfter($observer) {
        if (Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse'))
            return;
        if (Mage::registry('INVENTORY_CORE_PRODUCT_SAVE_AFTER'))
            return;
        Mage::register('INVENTORY_CORE_PRODUCT_SAVE_AFTER', true);
        $product = $observer->getProduct();
        if (in_array($product->getTypeId(), array('configurable', 'bundle', 'grouped')))
            return;
        $oldQty = 0;
        if (Mage::getModel('admin/session')->getData('inventory_before_update_product_item')) {
            $oldQty = Mage::getModel('admin/session')->getData('inventory_before_update_product_item');
            Mage::getModel('admin/session')->setData('inventory_before_update_product_item', null);
        }
        $item = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);
        $newQty = $item->getQty();
        $addQtyMore = $newQty - $oldQty;
        $warehouseId = Mage::getModel('inventoryplus/warehouse')->getCollection()->getFirstItem()->getId();
        $warehouseProduct = Mage::getModel('inventoryplus/warehouse_product')
                ->getCollection()
                ->addFieldToFilter('warehouse_id', $warehouseId)
                ->addFieldToFilter('product_id', $product->getId())
                ->getFirstItem();
        try {
            if ($warehouseProduct->getId()) {
                if ($addQtyMore != '0') {
                    $totalQty = $warehouseProduct->getTotalQty();
                    $availableQty = $warehouseProduct->getTotalQty();
                    $warehouseProduct->setTotalQty($totalQty + $addQtyMore)
                            ->setAvailableQty($availableQty + $addQtyMore)
                            ->save();
                }
            } else {
                $warehouseProduct = Mage::getModel('inventoryplus/warehouse_product');
                $warehouseProduct->setData('warehouse_id', $warehouseId)
                        ->setData('product_id', $product->getId())
                        ->setTotalQty($newQty)
                        ->setAvailableQty($newQty)
                        ->save();
            }
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'inventory_management.log');
        }
    }

    //minus qty available warehouse
    public function salesOrderPlaceAfter($observer) {

        if (Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse'))
            return;
        if (Mage::registry('INVENTORY_CORE_ORDER_PLACE'))
            return;
        Mage::register('INVENTORY_CORE_ORDER_PLACE', true);
        $order = $observer->getOrder();
        $items = $order->getAllItems();
        $warehouseIds = null;
        $warehouseId = Mage::getModel('inventoryplus/warehouse')->getCollection()->getFirstItem()->getId();
        if (!$warehouseId) {
            Mage::log($observer->getOrder(), null, 'inventory_management.log');
            return;
        }
        foreach ($items as $item) {
            $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($item->getProductId());
            $manageStock = $stockItem->getManageStock();
            if ($stockItem->getUseConfigManageStock()) {
                $manageStock = Mage::getStoreConfig('cataloginventory/item_options/manage_stock', Mage::app()->getStore()->getStoreId());
            }
            if ($manageStock == '0') {
                continue;
            }

            if (in_array($item->getProductType(), array('configurable', 'bundle', 'grouped'))) {
                continue;
            }
            $qtyOrdered = 0;
            if (!$item->getQtyOrdered() || $item->getQtyOrdered() == 0) {
                if ($item->getParentItemId()) {
                    $qtyOrdered = Mage::getModel('sales/order_item')->load($item->getParentItemId())->getQtyOrdered();
                }
            } else {
                $qtyOrdered = $item->getQtyOrdered();
            }
            $warehouseProduct = Mage::getModel('inventoryplus/warehouse_product')->getCollection()
                    ->addFieldToFilter('warehouse_id', $warehouseId)
                    ->addFieldToFilter('product_id', $item->getProductId())
                    ->getFirstItem();
            $currentQty = $warehouseProduct->getAvailableQty() - $qtyOrdered;
            try {
                $warehouseProduct->setAvailableQty($currentQty)
                        ->save();
                Mage::getModel('inventoryplus/warehouse_order')->setOrderId($order->getId())
                        ->setWarehouseId($warehouseId)
                        ->setProductId($item->getProductId())
                        ->setItemId($item->getId())
                        ->setQty($qtyOrdered)
                        ->save();
            } catch (Exception $e) {
                Mage::log($e->getMessage(), null, 'inventory_management.log');
            }
        }
    }

    /**
     * process sales_order_shipment_save_after event
     *
     * @return Magestore_Inventory_Model_Observer
     */
    //create shipment
    public function salesOrderShipmentSaveAfter($observer) {

        if (Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse'))
            return;

        if (Mage::registry('INVENTORY_CORE_ORDER_SHIPMENT'))
            return;
        Mage::register('INVENTORY_CORE_ORDER_SHIPMENT', true);
        $inventoryShipmentData = array();
        $data = Mage::app()->getRequest()->getParams();
        $shipment = $observer->getEvent()->getShipment();
        $order = $shipment->getOrder();
        $orderId = $data['order_id'];
        $shipmentId = $shipment->getId();
        $total_qty_order = $order->getTotalQtyOrdered();
        $total_qty_shipped = array();
        $total_shipped = array();
        $warehouse = Mage::getModel('inventoryplus/warehouse')->getCollection()->getFirstItem();
        if (!$warehouse->getId())
            return;
        $warehouseId = $warehouse->getId();

        foreach ($order->getAllItems() as $ordered) {
            $basePrice = $ordered->getBasePrice();
            $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($ordered->getProductId());

            $manageStock = $stockItem->getManageStock();
            if ($stockItem->getUseConfigManageStock()) {
                $manageStock = Mage::getStoreConfig('cataloginventory/item_options/manage_stock', Mage::app()->getStore()->getStoreId());
            }

            if ($manageStock == '0') {
                continue;
            }

            if (in_array($ordered->getProductType(), array('configurable', 'bundle', 'grouped')))
                continue;

            //row_total_incl_tax

            if ($ordered->getParentItemId()) {//neu no co cha 
                if (isset($data['shipment']['items'][$ordered->getParentItemId()])) { //neu cha no đc gán qty to ship
                    $item_parrent = Mage::getModel('sales/order_item')->load($ordered->getParentItemId());
                    $options = $ordered->getProductOptions();

                    if (isset($options['bundle_selection_attributes'])) {
                        $option = unserialize($options['bundle_selection_attributes']);

                        $parentQty = $data['shipment']['items'][$ordered->getParentItemId()];

                        $itemQty = (int) $option['qty'] * (int) $parentQty;

                        $inventoryShipmentData[$ordered->getItemId()]['qty'] = $itemQty;
                        $inventoryShipmentData[$ordered->getItemId()]['price'] = $basePrice;

                        if (isset($data['warehouse-shipment']['items'][$ordered->getParentItemId()]) && $data['warehouse-shipment']['items'][$ordered->getParentItemId()] != '')
                            $inventoryShipmentData[$ordered->getItemId()]['warehouse'] = $data['warehouse-shipment']['items'][$ordered->getParentItemId()];
                        else
                            $inventoryShipmentData[$ordered->getItemId()]['warehouse'] = $data['warehouse-shipment']['items'][$ordered->getItemId()];
                        $inventoryShipmentData[$ordered->getItemId()]['product_id'] = $ordered->getProductId();
                        $inventoryShipmentData[$ordered->getItemId()]['price_incl_tax'] = $ordered->getPriceInclTax();
                    }else {

                        $inventoryShipmentData[$ordered->getItemId()]['qty'] = $data['shipment']['items'][$ordered->getParentItemId()];
                        $inventoryShipmentData[$ordered->getItemId()]['price'] = $item_parrent->getBasePrice();
                        if (isset($data['warehouse-shipment']['items'][$ordered->getParentItemId()]) && $data['warehouse-shipment']['items'][$ordered->getParentItemId()] != '')
                            $inventoryShipmentData[$ordered->getItemId()]['warehouse'] = $data['warehouse-shipment']['items'][$ordered->getParentItemId()];
                        else
                            $inventoryShipmentData[$ordered->getItemId()]['warehouse'] = $data['warehouse-shipment']['items'][$ordered->getItemId()];
                        $inventoryShipmentData[$ordered->getItemId()]['product_id'] = $ordered->getProductId();
                        $inventoryShipmentData[$ordered->getItemId()]['price_incl_tax'] = $ordered->getPriceInclTax();
                    }
                } else {
                    $inventoryShipmentData[$ordered->getItemId()]['qty'] = $data['shipment']['items'][$ordered->getItemId()];
                    $inventoryShipmentData[$ordered->getItemId()]['price'] = $basePrice;
                    $inventoryShipmentData[$ordered->getItemId()]['warehouse'] = $warehouseId;
                    $inventoryShipmentData[$ordered->getItemId()]['product_id'] = $ordered->getProductId();
                    $inventoryShipmentData[$ordered->getItemId()]['price_incl_tax'] = $ordered->getPriceInclTax();
                }
            } else {//neu no ko co cha
                if (!$ordered->getHasChildren()) { // va no khong co con
                    $inventoryShipmentData[$ordered->getItemId()]['qty'] = $data['shipment']['items'][$ordered->getItemId()];
                    $inventoryShipmentData[$ordered->getItemId()]['price'] = $basePrice;
                    $inventoryShipmentData[$ordered->getItemId()]['warehouse'] = $warehouseId;
                    $inventoryShipmentData[$ordered->getItemId()]['product_id'] = $ordered->getProductId();
                    $inventoryShipmentData[$ordered->getItemId()]['price_incl_tax'] = $ordered->getPriceInclTax();
                } else { //neu no co con
                    $warehouseName = $warehouse->getWarehouseName();
                    $inventoryShipmentModel = Mage::getModel('inventoryplus/warehouse_shipment');
                    $inventoryShipmentModel->setItemId($ordered->getItemId())
                            ->setProductId($ordered->getProductId())
                            ->setOrderId($orderId)
                            ->setWarehouseId($warehouseId)
                            ->setWarehouseName($warehouseName)
                            ->setShipmentId($shipmentId)
                            ->setQtyShipped(0)
                            ->save();
                }
            }
            if ($inventoryShipmentData[$ordered->getItemId()]['qty'] > ($ordered->getQtyOrdered() - $ordered->getQtyRefunded())) {
                $inventoryShipmentData[$ordered->getItemId()]['qty'] = ($ordered->getQtyOrdered() - $ordered->getQtyRefunded());
                $inventoryShipmentData[$ordered->getItemId()]['price'] = $basePrice;
            }
        }

        /*
          //get total qty shipped
          $order_item_collection = Mage::getModel('sales/order_item')
          ->getCollection()
          ->addFieldToFilter('order_id', $order->getEntityId());

          foreach ($order_item_collection as $c) {
          if (!$c->getParentItemId()) {
          if ($c->getProductType() == 'virtual' || $c->getProductType() == 'downloadable') {
          $total_qty_order += -(int) $c->getQtyOrdered();
          }
          $shipment_item = Mage::getModel('sales/order_shipment_item')
          ->getCollection()
          ->addFieldToFilter('order_item_id', $c->getItemId());
          foreach ($shipment_item as $i) {
          $qty_shipped = $i->getQty();
          $total_shipped[] = (int) $qty_shipped;
          }
          }
          }
          $total_products_shipped = array_sum($total_shipped);
          //end get total qty shipped
          //set status for shipment
          if ($total_qty_order == 0) {
          $shipping_progress = 2;
          } else {
          if ((int) $total_products_shipped = 0) {
          $shipping_progress = 0;
          } elseif ((int) $total_products_shipped < (int) $total_qty_order) {
          $shipping_progress = 1;
          } elseif ((int) $total_products_shipped == (int) $total_qty_order) {
          $shipping_progress = 2;
          }
          }

          $order->setShippingProgress($shipping_progress);
         */
        //end set status

        try {
            foreach ($inventoryShipmentData as $key => $dataArray) {
                if ($dataArray['qty'] == 0)
                    continue;
                $warehouseName = $warehouse->getWarehouseName();
                $inventoryShipmentModel = Mage::getModel('inventoryplus/warehouse_shipment');
                $inventoryShipmentModel->setItemId($key)
                        ->setProductId($dataArray['product_id'])
                        ->setOrderId($orderId)
                        ->setWarehouseId($warehouseId)
                        ->setWarehouseName($warehouseName)
                        ->setShipmentId($shipmentId)
                        ->setQtyShipped($dataArray['qty'])
                        ->setSubtotalShipped($dataArray['price'] * $dataArray['qty'])
                        ->save();

                $warehouseOrder = Mage::getModel('inventoryplus/warehouse_order')
                        ->getCollection()
                        ->addFieldToFilter('order_id', $orderId)
                        ->addFieldToFilter('item_id', $key)
                        ->addFieldToFilter('product_id', $dataArray['product_id'])
                        ->getFirstItem();
                if ($warehouseOrder->getId()) {
                    $wOQty = $warehouseOrder->getQty();
                    $warehouseOrder->setQty($wOQty - $dataArray['qty'])
                            ->save();
                }

                $warehouseProduct = Mage::getModel('inventoryplus/warehouse_product')
                        ->getCollection()
                        ->addFieldToFilter('warehouse_id', $warehouseId)
                        ->addFieldToFilter('product_id', $dataArray['product_id'])
                        ->getFirstItem();
                $oldQty = $warehouseProduct->getTotalQty();
                $newQty = $oldQty - $dataArray['qty'];
                if ($dataArray['qty'] != 0 && ($newQty < $oldQty)) {
                    $warehouseProduct->setTotalQty($newQty);
//                    $warehouseProduct->setUpdatedAt(now());
                    $warehouseProduct->save();
                }
            }
            return;
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'inventory_management.log');
        }
    }

    //order cancel => return qty to qty available
    public function orderCancelAfter($observer) {
        if (Mage::registry('INVENTORY_CORE_ORDER_CANCEL'))
            return;
        Mage::register('INVENTORY_CORE_ORDER_CANCEL', true);
        try {
            $order = $observer->getOrder();
            $items = $order->getAllItems();

            $parentQtyCanceled = array();
            foreach ($items as $item) {

                $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($item->getProductId());

                $manageStock = $stockItem->getManageStock();
                if ($stockItem->getUseConfigManageStock()) {
                    $manageStock = Mage::getStoreConfig('cataloginventory/item_options/manage_stock', Mage::app()->getStore()->getStoreId());
                }
                if ($manageStock == 0) {
                    continue;
                }

                $qtyCanceled = 0;
                if (in_array($item->getProductType(), array('configurable', 'bundle', 'grouped'))) {
                    $parentQtyCanceled[$item->getId()] = $item->getQtyCanceled();
                    continue;
                }
                if ($item->getQtyCanceled() > 0) {
                    $qtyCanceled = $item->getQtyCanceled();
                } else {
                    if ($item->getParentItemId()) {
                        if ($parentQtyCanceled[$item->getParentItemId()])
                            $qtyCanceled = $parentQtyCanceled[$item->getParentItemId()];
                    }
                }
                if ($qtyCanceled > 0) {
                    $warehouseOrder = Mage::getModel('inventoryplus/warehouse_order')
                            ->getCollection()
                            ->addFieldToFilter('order_id', $order->getId())
                            ->addFieldToFilter('item_id', $item->getId())
                            ->addFieldToFilter('product_id', $item->getProductId())
                            ->getFirstItem();
                    if ($warehouseOrder->getId()) {
                        $wOQty = $warehouseOrder->getQty();
                        $warehouseOrder->setQty($wOQty - $qtyCanceled)
                                ->save();
                    }
                    $warehouseProduct = Mage::getModel('inventoryplus/warehouse_product')
                            ->getCollection()
                            ->addFieldToFilter('product_id', $item->getProductId())
                            ->addFieldToFilter('warehouse_id', $warehouseOrder->getWarehouseId())
                            ->getFirstItem();
                    if ($warehouseProduct->getId()) {
                        $availableQty = $warehouseProduct->getAvailableQty();
                        $warehouseProduct->setAvailableQty($availableQty + $qtyCanceled)
                                ->save();
                    }
                }
            }
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'inventory_management.log');
        }
    }

    public function salesOrderCreditmemoSaveAfter($observer) {
        if (Mage::registry('INVENTORY_WAREHOUSE_ORDER_CREDITMEMO'))
            return;
        Mage::register('INVENTORY_WAREHOUSE_ORDER_CREDITMEMO', true);

        $data = Mage::app()->getRequest()->getParams();
        $creditmemo = $observer->getCreditmemo();
        $order = $creditmemo->getOrder();
        $inventoryCreditmemoData = array();
        $order_id = $order->getId();
        $creditmemo_id = $creditmemo->getId();
        foreach ($creditmemo->getAllItems() as $creditmemo_item) {
            $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($creditmemo_item->getProductId());
            $manageStock = $stockItem->getManageStock();
            if ($stockItem->getUseConfigManageStock()) {
                $manageStock = Mage::getStoreConfig('cataloginventory/item_options/manage_stock', Mage::app()->getStore()->getStoreId());
            }
            if ($manageStock == '0') {
                continue;		// Ignore NOT manage stock products.
            }
            if (isset($data['creditmemo']['select-warehouse-supplier'][$creditmemo_item->getOrderItemId()]) && $data['creditmemo']['select-warehouse-supplier'][$creditmemo_item->getOrderItemId()] == 2) {
                continue; 	// Dropship
            }
            $item = Mage::getModel('sales/order_item')->load($creditmemo_item->getOrderItemId());
            if (in_array($item->getProductType(), array('configurable', 'bundle', 'grouped')))
                continue;		// Ignore configurable, bundle, grouped products.

            if ($item->getParentItemId()) {		/* Item has parent item Id */
                if (isset($data['creditmemo']['items'][$item->getParentItemId()])) {		// Neu cha no dc gan Qty. refund.
                    if (isset($data['creditmemo']['select-warehouse-supplier'][$item->getParentItemId()]) && $data['creditmemo']['select-warehouse-supplier'][$item->getParentItemId()] == 2) {
                        continue;	// Dropship
                    }
                    $item_parrent = Mage::getModel('sales/order_item')->load($item->getParentItemId());
                    $options = $item->getProductOptions();
                    if (isset($options['bundle_selection_attributes'])) {	// Neu product co option bundle_selection_attributes
                        $option = unserialize($options['bundle_selection_attributes']);
                        $parentQty = $data['creditmemo']['items'][$item->getParentItemId()]['qty'];
                        $inventoryCreditmemoData[$item->getItemId()]['price'] = $basePrice;
                        $qtyRefund = (int) $option['qty'] * (int) $parentQty;
                        $qtyShipped = $item->getQtyShipped();
                        $qtyRefunded = $item->getQtyRefunded();
                        $qtyOrdered = $item->getQtyOrdered();
                        $inventoryCreditmemoData[$item->getItemId()]['product'] = $item->getProductId();
                        $inventoryCreditmemoData[$item->getItemId()]['qty_avaiable'] = 0;
                        $inventoryCreditmemoData[$item->getItemId()]['qty_total'] = 0;
                        $inventoryCreditmemoData[$item->getItemId()]['qty_product'] = 0;
                        if (isset($data['creditmemo']['items'][$item->getParentItemId()]['back_to_stock'])) {		//Back to Stock
                            $inventoryCreditmemoData[$item->getItemId()]['warehouse'] = $data['creditmemo']['warehouse-select'][$item->getParentItemId()];
                            $inventoryCreditmemoData[$item->getItemId()]['qty_avaiable'] = $qtyRefund;
                            $qtyChecked = $qtyShipped + $qtyRefunded + $qtyRefund - $qtyOrdered;
                            if ($qtyShipped > 0) {
                                if ($qtyChecked >= 0) {
                                    $inventoryCreditmemoData[$item->getItemId()]['qty_total'] = $qtyChecked;
                                } else {
                                    $inventoryCreditmemoData[$item->getItemId()]['qty_total'] = $qtyOrdered - $qtyShipped + $qtyRefunded;
                                }
                            }
                            if ($qtyChecked >= 0) {
                                $inventoryCreditmemoData[$item->getItemId()]['qty_product'] = $qtyRefund;
                            } else {
                                $inventoryCreditmemoData[$item->getItemId()]['qty_product'] = $qtyOrdered - $qtyShipped + $qtyRefunded;
                            }
                        } else {		// NOT Back to Stock
                            $inventoryShipmentModel = Mage::getModel('inventoryplus/warehouse_shipment')
                                    ->getCollection()
                                    ->addFieldToFilter('order_id', $order_id)
                                    ->addFieldToFilter('item_id', $item->getItemId())
                                    ->addFieldToFilter('product_id', $item->getProductId())
                                    ->getFirstItem();

                            $warehouseId = $inventoryShipmentModel->getWarehouseId();
                            if (!$warehouseId) {
                                $inventoryOrderModel = Mage::getModel('inventoryplus/warehouse_order')->getCollection()
                                        ->addFieldToFilter('order_id', $order_id)
                                        ->addFieldToFilter('item_id', $item->getItemId())
                                        ->addFieldToFilter('product_id', $item->getProductId())
                                        ->getFirstItem();
                                $warehouseId = $inventoryOrderModel->getWarehouseId();
                            }
                            $qtycheckNotShip = $qtyShipped + $qtyRefunded + $qtyRefund - $qtyOrdered;
                            if ($qtycheckNotShip <= 0) {
                                $inventoryCreditmemoData[$item->getItemId()]['qty_total'] = $qtycheckNotShip;
                            } else {
                                $inventoryCreditmemoData[$item->getItemId()]['qty_total'] = $qtyShipped + $qtyRefunded - $qtyOrdered;
                            }
                            $inventoryCreditmemoData[$item->getItemId()]['warehouse'] = $warehouseId;
                        }// End product co option bundle_selection_attributes and NOT Back to Stock
                    } else {			// Neu product KHONG co option bundle_selection_attributes
                        $qtyRefund = $data['creditmemo']['items'][$item->getParentItemId()]['qty'];
                        $parentItem = Mage::getModel('sales/order_item')->load($item->getParentItemId());
                        $qtyShipped = $parentItem->getQtyShipped();
                        $qtyRefunded = $parentItem->getQtyRefunded();
                        $qtyOrdered = $parentItem->getQtyOrdered();
						$qtyInvoiced = $parentItem->getQtyInvoiced();
                        $inventoryCreditmemoData[$item->getItemId()]['qty_avaiable'] = 0;
                        $inventoryCreditmemoData[$item->getItemId()]['qty_total'] = 0;
                        $inventoryCreditmemoData[$item->getItemId()]['qty_product'] = 0;
						$maxQtyCanRefund = $qtyInvoiced - $qtyRefunded;
                        if (isset($data['creditmemo']['items'][$item->getParentItemId()]['back_to_stock'])) {	/* If add back product to stock */
							$qtyRefundNow = min($maxQtyCanRefund,$qtyRefund);	/* Remove case admin enter a number biger than qty can refund */
							$sumQtyRefund = $qtyRefundNow+$qtyRefunded;
							$inventoryCreditmemoData[$item->getItemId()]['qty_avaiable'] = $qtyRefundNow;
							if($qtyShipped<=$qtyRefunded)$qtyAddBack = 0;	// Neu add back stock va qty_shipped <= qtyRefunded thi ko lam gi ca	
							else{
								if($qtyShipped<$sumQtyRefund){$qtyAddBack = $qtyShipped-$qtyRefunded;}  /* Max qty return to warehouse = qtyShipped - qtyRefunded */
								else{$qtyAddBack = $qtyRefundNow;}
							}
							$inventoryCreditmemoData[$item->getItemId()]['qty_total'] = $qtyAddBack;	/* qty_total is qty will add back qty_total of warehouse */
							$inventoryCreditmemoData[$item->getItemId()]['warehouse'] = $data['creditmemo']['warehouse-select'][$item->getParentItemId()];
                        } else {			/* If does NOT add back product to stock */
							/* Need to subtract total qty : qty_order - qty_shiped - qty_refund_now */
							/* Qty catalog and available qty of warehouse not changed
							Tuy nhien can xu ly phan chenh lech giua total qty va available qty */
							$qtyRefundNow = min($maxQtyCanRefund,$qtyRefund);	/* Remove case admin enter a number biger than qty can refund */
							if($qtyShipped>$qtyRefundNow)$totalQtyNeedSubtracted = 0;	// Neu ko add back stock va qty shipped > qty_refund_now thi ko lam gi ca
							else{		/* Need to subtract total qty : qty_order - qty_shiped - qty_refund_now cho tuong ung qty catalog va available qty */
								$totalQtyNeedSubtracted = $qtyOrdered - $qtyShipped - $qtyRefundNow;
							}
							$inventoryShipmentModel = Mage::getModel('inventoryplus/warehouse_shipment')
                            ->getCollection()
                            ->addFieldToFilter('order_id', $order_id)
                            ->addFieldToFilter('item_id', $item->getItemId())
                            ->addFieldToFilter('product_id', $item->getProductId())
                            ->getFirstItem();
							$warehouseId = $inventoryShipmentModel->getWarehouseId();
							if (!$warehouseId) {
								$inventoryOrderModel = Mage::getModel('inventoryplus/warehouse_order')->getCollection()
										->addFieldToFilter('order_id', $order_id)
										->addFieldToFilter('item_id', $item->getItemId())
										->addFieldToFilter('product_id', $item->getProductId())
										->getFirstItem();
								$warehouseId = $inventoryOrderModel->getWarehouseId();
							}
							$inventoryCreditmemoData[$item->getItemId()]['qty_total'] =  - $totalQtyNeedSubtracted; // Minus because does NOT add back to stock
							$inventoryCreditmemoData[$item->getItemId()]['warehouse'] = $warehouseId;
                        }
                        $inventoryCreditmemoData[$item->getItemId()]['product'] = $item->getProductId();		//product_id
                    }	// End Neu product KHONG co option bundle_selection_attributes and cha no dc gan Qty. refund.
                } else {	// Neu no CO Cha va Cha no KHONG dc gan Qty. refund.
                    $qtyRefund = $data['creditmemo']['items'][$item->getItemId()]['qty'];
                    $qtyShipped = $item->getQtyShipped();
                    $qtyRefunded = $item->getQtyRefunded();
                    $qtyOrdered = $item->getQtyOrdered();
					$qtyInvoiced = $item->getQtyInvoiced();
                    $inventoryCreditmemoData[$item->getItemId()]['qty_avaiable'] = 0;
                    $inventoryCreditmemoData[$item->getItemId()]['qty_total'] = 0;
                    $inventoryCreditmemoData[$item->getItemId()]['qty_product'] = 0;
					$maxQtyCanRefund = $qtyInvoiced - $qtyRefunded;
                    if (isset($data['creditmemo']['items'][$item->getItemId()]['back_to_stock'])) {		/* If add back product to stock */
						$qtyRefundNow = min($maxQtyCanRefund,$qtyRefund);	/* Remove case admin enter a number biger than qty can refund */ 
						$sumQtyRefund = $qtyRefundNow+$qtyRefunded;
						$inventoryCreditmemoData[$item->getItemId()]['qty_avaiable'] = $qtyRefundNow;
						if($qtyShipped<=$qtyRefunded)$qtyAddBack = 0;	// Neu add back stock va qty_shipped <= qtyRefunded thi ko lam gi ca	
						else{
							if($qtyShipped<$sumQtyRefund){$qtyAddBack = $qtyShipped-$qtyRefunded;}  /* Max qty return to warehouse = qtyShipped - qtyRefunded */
							else{$qtyAddBack = $qtyRefundNow;}
						}
						$inventoryCreditmemoData[$item->getItemId()]['qty_total'] = $qtyAddBack;	/* qty_total is qty will add back qty_total of warehouse */
						$inventoryCreditmemoData[$item->getItemId()]['warehouse'] = $data['creditmemo']['warehouse-select'][$item->getItemId()];
                    } else {			/* If does NOT add back product to stock */
						/* Need to subtract total qty : qty_order - qty_shiped - qty_refund_now */
						/* Qty catalog and available qty of warehouse not changed
						Tuy nhien can xu ly phan chenh lech giua total qty va available qty */
						$qtyRefundNow = min($maxQtyCanRefund,$qtyRefund);	/* Remove case admin enter a number biger than qty can refund */
						if($qtyShipped>$qtyRefundNow)$totalQtyNeedSubtracted = 0;	// Neu ko add back stock va qty shipped > qty_refund_now thi ko lam gi ca
						else{		/* Need to subtract total qty : qty_order - qty_shiped - qty_refund_now cho tuong ung qty catalog va available qty */
							$totalQtyNeedSubtracted = $qtyOrdered - $qtyShipped - $qtyRefundNow;
						}
						$inventoryShipmentModel = Mage::getModel('inventoryplus/warehouse_shipment')
								->getCollection()
								->addFieldToFilter('order_id', $order_id)
								->addFieldToFilter('item_id', $item->getItemId())
								->addFieldToFilter('product_id', $item->getProductId())
								->getFirstItem();
						$warehouseId = $inventoryShipmentModel->getWarehouseId();
						if (!$warehouseId) {
							$inventoryOrderModel = Mage::getModel('inventoryplus/warehouse_order')->getCollection()
									->addFieldToFilter('order_id', $order_id)
									->addFieldToFilter('item_id', $item->getItemId())
									->addFieldToFilter('product_id', $item->getProductId())
									->getFirstItem();
							$warehouseId = $inventoryOrderModel->getWarehouseId();
						}
						$inventoryCreditmemoData[$item->getItemId()]['qty_total'] =  - $totalQtyNeedSubtracted; // Minus because does NOT add back to stock
						$inventoryCreditmemoData[$item->getItemId()]['warehouse'] = $warehouseId;
                    }
                    $inventoryCreditmemoData[$item->getItemId()]['product'] = $item->getProductId();
                }// End neu no CO Cha va Cha no KHONG dc gan Qty. refund.
            } else {	/* Item doesn't have parrent item Id */
                $qtyRefund = $data['creditmemo']['items'][$item->getItemId()]['qty'];
                $qtyShipped = $item->getQtyShipped();
                $qtyRefunded = $item->getQtyRefunded();
                $qtyOrdered = $item->getQtyOrdered();
				$qtyInvoiced = $item->getQtyInvoiced();
                $inventoryCreditmemoData[$item->getItemId()]['qty_avaiable'] = 0;
                $inventoryCreditmemoData[$item->getItemId()]['qty_total'] = 0;
                $inventoryCreditmemoData[$item->getItemId()]['qty_product'] = 0;
				$maxQtyCanRefund = $qtyInvoiced - $qtyRefunded;
                if (isset($data['creditmemo']['items'][$item->getItemId()]['back_to_stock'])) {		/* If add back product to stock */
					$qtyRefundNow = min($maxQtyCanRefund,$qtyRefund);	/* Remove case admin enter a number biger than qty can refund */
					//$maxQtyCanAddBack = min($qtyShipped,min($qtyOrdered, $sumQtyRefund));  
					$sumQtyRefund = $qtyRefundNow+$qtyRefunded;
                    $inventoryCreditmemoData[$item->getItemId()]['qty_avaiable'] = $qtyRefundNow;
					if($qtyShipped<=$qtyRefunded)$qtyAddBack = 0;	// Neu add back stock va qty_shipped <= qtyRefunded thi ko lam gi ca	
					else{
						if($qtyShipped<$sumQtyRefund){$qtyAddBack = $qtyShipped-$qtyRefunded;}  /* Max qty return to warehouse = qtyShipped - qtyRefunded */
						else{$qtyAddBack = $qtyRefundNow;}
					}
                    $inventoryCreditmemoData[$item->getItemId()]['qty_total'] = $qtyAddBack;	/* qty_total is qty will add back qty_total of warehouse */
                    $inventoryCreditmemoData[$item->getItemId()]['warehouse'] = $data['creditmemo']['warehouse-select'][$item->getItemId()];
                } else {	/* If does NOT add back product to stock */
					/* Need to subtract total qty : qty_order - qty_shiped - qty_refund_now */
					/* Qty catalog and available qty of warehouse not changed
					Tuy nhien can xu ly phan chenh lech giua total qty va available qty */
					$qtyRefundNow = min($maxQtyCanRefund,$qtyRefund);	/* Remove case admin enter a number biger than qty can refund */
					if($qtyShipped>$qtyRefundNow)$totalQtyNeedSubtracted = 0;	// Neu ko add back stock va qty shipped > qty_refund_now thi ko lam gi ca
					else{		/* Need to subtract total qty : qty_order - qty_shiped - qty_refund_now cho tuong ung qty catalog va available qty */
						$totalQtyNeedSubtracted = $qtyOrdered - $qtyShipped - $qtyRefundNow;
					}
                    $inventoryShipmentModel = Mage::getModel('inventoryplus/warehouse_shipment')
                            ->getCollection()
                            ->addFieldToFilter('order_id', $order_id)
                            ->addFieldToFilter('item_id', $item->getItemId())
                            ->addFieldToFilter('product_id', $item->getProductId())
                            ->getFirstItem();
                    $warehouseId = $inventoryShipmentModel->getWarehouseId();
                    if (!$warehouseId) {
                        $inventoryOrderModel = Mage::getModel('inventoryplus/warehouse_order')->getCollection()
                                ->addFieldToFilter('order_id', $order_id)
                                ->addFieldToFilter('item_id', $item->getItemId())
                                ->addFieldToFilter('product_id', $item->getProductId())
                                ->getFirstItem();
                        $warehouseId = $inventoryOrderModel->getWarehouseId();
                    }
					$inventoryCreditmemoData[$item->getItemId()]['qty_total'] =  - $totalQtyNeedSubtracted; // Minus because does NOT add back to stock
                    $inventoryCreditmemoData[$item->getItemId()]['warehouse'] = $warehouseId;
                }
				$inventoryCreditmemoData[$item->getItemId()]['product'] = $item->getProductId();		// product_id
            }
        }  /* End foreach Refund Item Observer */
        foreach ($inventoryCreditmemoData as $id => $value) {
            $warehouseProduct = Mage::getModel('inventoryplus/warehouse_product')
                    ->getCollection()
                    ->addFieldToFilter('product_id', $value['product'])
                    ->addFieldToFilter('warehouse_id', $value['warehouse'])
                    ->getFirstItem();
            if ($warehouseProduct->getId()) {
                try {
                    $warehouseTotalQty = $warehouseProduct->getTotalQty() + $value['qty_total'];
					$warehouseAvailableQty = $warehouseProduct->getAvailableQty() + $value['qty_avaiable'];
                    $warehouseProduct->setData('total_qty',$warehouseTotalQty )
                            ->setData('available_qty', $warehouseAvailableQty)
                            ->save();
                } catch (Exception $e) {
                    Mage::log($e->getTraceAsString(), null, 'inventory_management.log');
                }
            }
            if (Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse')) {
                $warehouse_name = Mage::helper('inventorywarehouse/warehouse')->getWarehouseNameByWarehouseId($value['warehouse']);
                try {
                    Mage::getModel('inventorywarehouse/warehouse_refund')
                            ->setData('warehouse_id', $value['warehouse'])
                            ->setData('creditmemo_id', $creditmemo_id)
                            ->setData('order_id', $order_id)
                            ->setData('item_id', $id)
                            ->setData('product_id', $value['product'])
                            ->setData('qty_refunded', $value['qty_avaiable'])
                            ->setData('warehouse_name', $warehouse_name)
                            ->save();
                } catch (Exception $e) {
                    Mage::log($e->getTraceAsString(), null, 'inventory_management.log');
                }
            }
        }/* End foreach $inventoryCreditmemoData */
    }

    //order creditmemo => qty return to warehouse
    /* qtyRefund - current qty refund
     * qtyRefunded - old qty refund
     */
    public function salesOrderCreditmemoSaveAfter_backup($observer) {
        if (Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse'))
            return;
        if (Mage::registry('INVENTORY_CORE_ORDER_CREDITMEMO'))
            return;
        Mage::register('INVENTORY_CORE_ORDER_CREDITMEMO', true);
        try {
            $warehouse = Mage::getModel('inventoryplus/warehouse')->getCollection()->getFirstItem();
            $warehouseId = $warehouse->getId();
            $creditmemo = $observer->getCreditmemo();
            $order = $creditmemo->getOrder();
            $supplierReturn = array();
            $transactionData = array();

            $parents = array();
            foreach ($creditmemo->getAllItems() as $item) {
                $orderItemId = $item->getOrderItemId();
                $orderItem = Mage::getModel('sales/order_item')->load($orderItemId);
                if (in_array($orderItem->getProductType(), array('configurable', 'bundle', 'grouped'))) {
                    $parents[$orderItemId]['qtyRefund'] = $item->getQty();
                    $parents[$orderItemId]['qtyRefunded'] = $orderItem->getQtyRefunded();
                    $parents[$orderItemId]['qtyShipped'] = $orderItem->getQtyShipped();
                    continue;
                }
                if ($orderItem->getParentItemId()) {
                    $qtyRefund = $item->getQty();
                    $qtyShipped = $orderItem->getQtyShipped();
                    $creditmemoParentItem = Mage::getModel('sales/order_creditmemo_item')->getCollection()
                            ->addFieldToFilter('parent_id', $item->getParentId())
                            ->addFieldToFilter('order_item_id', $orderItem->getParentItemId())
                            ->getFirstItem();
                    if ($parents && $parents[$orderItem->getParentItemId()]['qtyRefund']) {
                        $qtyRefund = max($qtyRefund, $parents[$orderItem->getParentItemId()]['qtyRefund']);
                    }
                    if ($qtyShipped == 0 && $parents && $parents[$orderItem->getParentItemId()]['qtyShipped']) {
                        $qtyShipped = $parents[$orderItem->getParentItemId()]['qtyShipped'];
                    }
                    $qtyOrdered = $orderItem->getQtyOrdered();
                    $qtyRefunded = $orderItem->getQtyRefunded();
                    $qtyRefunded = max($qtyRefunded, $parents[$orderItem->getParentItemId()]['qtyRefunded']);
                } else {
                    $qtyRefund = $item->getQty();
                    $qtyShipped = $orderItem->getQtyShipped();
                    $qtyOrdered = $orderItem->getQtyOrdered();
                    $qtyRefunded = $orderItem->getQtyRefunded();
                }
                //if return to stock
                /*
                 * total qty will be updated if (qtyShipped + qtyRefunded + qtyRefund) > qtyOrdered and will be returned = (qtyShipped + qtyRefunded + qtyRefund) > qtyOrdered
                 * available qty will be returned = qtyRefund
                 */
                $qtyReturnAvailableQty = 0;
                $qtyReturnTotalQty = 0;
                if ($item->getBackToStock()) {
                    $qtyReturnAvailableQty = $qtyRefund;
                    $qtyChecked = $qtyShipped + $qtyRefunded + $qtyRefund - $qtyOrdered;
                    if ($qtyChecked > 0)
                        $qtyReturnTotalQty = $qtyChecked;
                }else {
                    //if not return to stock
                    /*
                     * total qty will be updated = qtyShipped - min[(qtyShipped + qtyRefunded + qtyRefund),qtyOrdered]
                     * available qty not change
                     */
                    $totalShipAndRefund = $qtyShipped + $qtyRefunded + $qtyRefund;
                    $qtyReturnTotalQty = min($totalShipAndRefund, $qtyOrdered);
                }
                $warehouseProduct = Mage::getModel('inventoryplus/warehouse_product')
                        ->getCollection()
                        ->addFieldToFilter('product_id', $item->getProductId())
                        ->addFieldToFilter('warehouse_id', $warehouseId)
                        ->getFirstItem();
                if ($warehouseProduct->getId()) {
                    $warehouseProduct->setData('total_qty', $warehouseProduct->getTotalQty() + $qtyReturnTotalQty)
                            ->setData('available_qty', $warehouseProduct->getAvailableQty() + $qtyReturnAvailableQty)
                            ->save();
                }

                $warehouseShipment = Mage::getModel('inventoryplus/warehouse_shipment')
                        ->getCollection()
                        ->addFieldToFilter('item_id', $orderItemId)
                        ->addFieldToFilter('product_id', $item->getProductId())
                        ->addFieldToFilter('warehouse_id', $warehouseId)
                        ->getFirstItem();
                if ($warehouseShipment->getId()) {
                    $warehouseShipment->setData('qty_refunded', $warehouseShipment->getQtyRefunded() + $qtyRefund)
                            ->save();
                }
            }
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'inventory_management.log');
        }
    }

    public function productPrepareSave($observer) {
        $product = $observer->getEvent()->getProduct();
        if (in_array($product->getTypeId(), array('configurable', 'bundle', 'grouped'))) {
            return;
        }
        $productId = $product->getId();
        $productData = $observer->getRequest()->getPost('product');
        $stockData = $productData['stock_data'];
        $manageStock = $stockData['manage_stock'];
        $installer = Mage::getModel('core/resource');
        $writeConnection = $installer->getConnection('core_write');
        if (isset($stockData['use_config_manage_stock'])) {
            $manageStock = Mage::getStoreConfig('cataloginventory/item_options/manage_stock', Mage::app()->getStore()->getStoreId());
        } 
        if ($manageStock == '0') {
            try {
                $stockData['original_inventory_qty'] = 0;
                $stockData['qty'] = 0;
                $product->setData('stock_data',$stockData);
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            $warehouseProducts = Mage::getModel('inventoryplus/warehouse_product')
                    ->getCollection()
                    ->addFieldToFilter('product_id', $productId);
            foreach ($warehouseProducts as $whp) {
                try {
                    $whp->setTotalQty(0)
                        ->setAvailableQty(0)
                        ->save();
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
            }
        }
    }
    
    public function adminLoginSuccess($observer){ return; // Save inventory_permission vao session
		// muc dich cai thien toc do.
		//Hien tai dang loi - fix sau.
        $permissionArray = array();
        $admin = $observer->getUser();
        $adminPermission = Mage::getModel('inventoryplus/warehouse_permission')
                ->getCollection();
        foreach($adminPermission as $permission){
            if(!array_key_exists($permission->getAdminId(),$permissionArray)){
                $permissionArray[$permission->getAdminId()] = '';
            } 
            if(!array_key_exists($permission->getWarehouseId(),$permissionArray[$permission->getAdminId()])){
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()] = '';
            }
            if($permissionArray[$permission->getAdminId()][$permission->getWarehouseId()] == ''){
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()]['can_edit'] = !$permission->getCanEdit() ? '0' : $permission->getCanEdit();
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()]['can_adjust'] = !$permission->getCanAdjust() ? '0' : $permission->getCanAdjust();
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()]['can_send_request_stock'] = !$permission->getCanSendRequestStock() ? '0' : $permission->getCanSendRequestStock();
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()]['can_physical'] = !$permission->getCanPhysical() ? '0' : $permission->getCanPhysical();
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()]['can_purchase_product'] = !$permission->getCanPurchaseProduct() ? '0' : $permission->getCanPurchaseProduct();
            }
        }
        Mage::getSingleton('adminhtml/session')->setData('inventory_permission',$permissionArray);
    }
}
