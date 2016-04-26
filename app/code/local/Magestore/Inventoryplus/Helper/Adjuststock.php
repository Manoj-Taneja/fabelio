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
 * Inventory Helper
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Helper_Adjuststock extends Mage_Core_Helper_Abstract {

    /**
     * Check permission to adjust stock.
     * 
     * @return boolean
     */
    public function getWarehouseByAdmin() {
        $adminId = Mage::getSingleton('admin/session')->getUser()->getId();
        $warehouseIds = array();
        $collection = Mage::getModel('inventoryplus/warehouse_permission')->getCollection()
                ->addFieldToFilter('admin_id', $adminId)
                ->addFieldToFilter('can_adjust', 1);
        foreach ($collection as $assignment) {
            $warehouseIds[] = $assignment->getWarehouseId();
        }
        $warehouseCollection = Mage::getModel('inventoryplus/warehouse')->getCollection()
                ->addFieldToFilter('warehouse_id', array('in' => $warehouseIds));
        if (count($warehouseCollection)) {
            return true;
        }
        return false;
    }

    /**
     * Import data for product grid
     * 
     * @return null
     */
    public function importProduct($data) {
        if (count($data)) {
            Mage::getModel('admin/session')->setData('adjuststock_product_import', $data);
        }
    }

    /**
     * Adjust stock
     * 
     * @return null
     */
    public function adjustStockData($data, $warehouse_id, $adjuststock, $confirm) {

        $admin = Mage::getModel('admin/session')->getUser()->getUsername();

        $resource = Mage::getSingleton('core/resource');

        $writeConnection = $resource->getConnection('core_write');
        $readConnection = $resource->getConnection('core_read');
        $installer = Mage::getModel('core/resource');

        $sqlNews = array();
        $sqlOlds = '';
        $sqlOldsAvailable = '';
        $sqlUpdateAdjustProduct = '';
        $sqlAdjustNew = array();
        $countSqlOlds = 0;
        $countUpdateadjustProduct = 0;
        $countUpdateProduct = 0;
        $sqlUpdateProduct = '';
        $sqlUpdateProductStatus = '';

        $adjuststockProducts = array();

        $adjuststockProductsExplodes = explode('&', urldecode($data['adjuststock_products']));

        if (count($adjuststockProductsExplodes) <= 900) {
            parse_str(urldecode($data['adjuststock_products']), $adjuststockProducts);
        } else {
            foreach ($adjuststockProductsExplodes as $adjuststockProductsExplode) {
                $adjuststockProduct = '';
                parse_str($adjuststockProductsExplode, $adjuststockProduct);
                $adjuststockProducts = $adjuststockProducts + $adjuststockProduct;
            }
        }

        if (count($adjuststockProducts)) {
            $productIds = '';
            $qtys = '';
            $count = 0;

            //history array
            $adjusthistory = array();

            foreach ($adjuststockProducts as $pId => $enCoded) {

                $productIds[] = $pId;
                $codeArr = array();
                parse_str(base64_decode($enCoded), $codeArr);
                $warehouseProductItem = Mage::getModel('inventoryplus/warehouse_product')
                        ->getCollection()
                        ->addFieldToFilter('warehouse_id', $warehouse_id)
                        ->addFieldToFilter('product_id', $pId)
                        ->getFirstItem();
                $qtyAddMore = 0;


                if ($warehouseProductItem->getId()) {
                    $qtyAddMore = $codeArr['adjust_qty'] - $warehouseProductItem->getTotalQty();

                    $oldQty = $warehouseProductItem->getTotalQty();
                    $oldQtyAvailable = $warehouseProductItem->getAvailableQty();
                    $newQty = $codeArr['adjust_qty'];
                    $newQtyAvailable = $oldQtyAvailable + ($newQty - $oldQty);

                    if ($qtyAddMore != 0) {
                        $countSqlOlds++;
                        $sqlOlds .= 'UPDATE ' . $installer->getTableName('inventoryplus/warehouse_product') . ' 
                                                                            SET `total_qty` = \'' . $codeArr['adjust_qty'] . '\'
                                                                                    WHERE `warehouse_product_id` =' . $warehouseProductItem->getId() . ';';
                        if ($countSqlOlds == 900) {
                            if ($confirm) {
                                $writeConnection->query($sqlOlds);
                                $sqlOlds = '';
                                $countSqlOlds = 0;
                            }
                        }

                        $sqlOldsAvailable .= 'UPDATE ' . $installer->getTableName('inventoryplus/warehouse_product') . ' 
                                                                            SET `available_qty` = \'' . $newQtyAvailable . '\'
                                                                                    WHERE `warehouse_product_id` =' . $warehouseProductItem->getId() . ';';
                        if ($countSqlOlds == 900) {
                            if ($confirm) {
                                $writeConnection->query($sqlOldsAvailable);
                                $sqlOldsAvailable = '';
                                $countSqlOlds = 0;
                            }
                        }
                    }
                } else {
                    $qtyAddMore = $codeArr['adjust_qty'];
                    $oldQty = 0;
                    $newQty = $codeArr['adjust_qty'];
                    $newQtyAvailable = $codeArr['adjust_qty'];
                    $sqlNews[] = array(
                        'product_id' => $pId,
                        'warehouse_id' => $warehouse_id,
                        'total_qty' => $codeArr['adjust_qty'],
                        'available_qty' => $newQtyAvailable
                    );
                    if (count($sqlNews) == 1000) {
                        if ($confirm) {
                            $writeConnection->insertMultiple($installer->getTableName('inventoryplus/warehouse_product'), $sqlNews);
                            $sqlNews = array();
                        }
                    }
                }

                //add history 
                if ($confirm) {
                    $value = array();
                    $value['old_qty'] = $oldQty;
                    $value['new_qty'] = $newQty;
                    $value['warehouse'] = $warehouse_id;
                    $adjusthistory[$pId] = $value;
                }


                $sqlAdjustProduct = "Select * from " . $installer->getTableName('inventoryplus/adjuststock_product') . " WHERE (adjuststock_id = " . $adjuststock->getId() . ") AND (product_id = " . $pId . ")";
                $adjustProduct = $readConnection->fetchRow($sqlAdjustProduct);
                if ($adjustProduct) {
                    $countUpdateadjustProduct ++;
                    $sqlUpdateAdjustProduct .= 'UPDATE ' . $installer->getTableName('inventoryplus/adjuststock_product') . ' SET old_qty = ' . $oldQty . ', adjust_qty = ' . $newQty . ' WHERE (adjuststock_product_id = ' . $adjustProduct['adjuststock_product_id'] . ');';
                    if ($countUpdateadjustProduct == 900) {
                        $writeConnection->query($sqlUpdateAdjustProduct);
                        $sqlUpdateAdjustProduct = '';
                        $countUpdateadjustProduct = 0;
                    }
                } else {
                    $sqlAdjustNew[] = array(
                        'adjuststock_id' => $adjuststock->getId(),
                        'product_id' => $pId,
                        'old_qty' => $oldQty,
                        'adjust_qty' => $newQty
                    );
                    if (count($sqlAdjustNew) == 1000) {
                        $writeConnection->insertMultiple($installer->getTableName('inventoryplus/adjuststock_product'), $sqlAdjustNew);
                        $sqlAdjustNew = array();
                    }
                }
                /* update product qty for system */

                if ($confirm) {

                    if ($qtyAddMore != 0) {
                        $countUpdateProduct++;
//                        if (Mage::getStoreConfig('inventoryplus/general/updatestock')) {
                        $product = Mage::getModel('catalog/product')->load($pId);
                        $sqlSelect = 'Select qty from ' . $installer->getTableName("cataloginventory_stock_item") . ' WHERE (product_id = ' . $pId . ')';
                        $results = $readConnection->fetchAll($sqlSelect);
                        foreach ($results as $result) {
                            $oldQtyProduct = $result['qty'];
                        }
                        $minToChangeStatus = Mage::getStoreConfig('cataloginventory/item_options/min_qty');

                        $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($pId);

                        $manageStock = $stockItem->getManageStock();
                        if ($stockItem->getUseConfigManageStock()) {
                            $manageStock = Mage::getStoreConfig('cataloginventory/item_options/manage_stock', Mage::app()->getStore()->getStoreId());
                        }
                        if ($manageStock) {
                            $backorders = $stockItem->getBackorders();
                            $useConfigBackorders = $stockItem->getUseConfigBackorders();
                            if ($useConfigBackorders) {
                                $backorders = Mage::getStoreConfig('cataloginventory/item_options/backorders', Mage::app()->getStore()->getStoreId());
                            }

                            if (($oldQtyProduct + $qtyAddMore) > $minToChangeStatus) {
                                $sqlUpdateProduct .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_item") . ' SET qty = qty + ' . $qtyAddMore . ', is_in_stock = 1 WHERE (product_id = ' . $pId . ');';
                                $sqlUpdateProductStatus .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_status") . ' SET qty = qty + ' . $qtyAddMore . ', stock_status = 1 WHERE (product_id = ' . $pId . ');';
                            } else {
                                if ($product->getTypeId() != 'configurable') {
                                    if (!$backorders) {
                                        $sqlUpdateProduct .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_item") . ' SET qty = qty + ' . $qtyAddMore . ', is_in_stock = 0 WHERE (product_id = ' . $pId . ');';
                                    } else {
                                        $sqlUpdateProduct .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_item") . ' SET qty = qty + ' . $qtyAddMore . ' WHERE (product_id = ' . $pId . ');';
                                    }
                                } else {
                                    $sqlUpdateProduct .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_item") . ' SET qty = qty + ' . $qtyAddMore . ' WHERE (product_id = ' . $pId . ');';
                                }
                                if (!$backorders) {
                                    $sqlUpdateProductStatus .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_status") . ' SET qty = qty + ' . $qtyAddMore . ', stock_status = 0 WHERE (product_id = ' . $pId . ');';
                                } else {
                                    $sqlUpdateProductStatus .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_status") . ' SET qty = qty + ' . $qtyAddMore . ' WHERE (product_id = ' . $pId . ');';
                                }
                            }

                            if ($countUpdateProduct == 900) {
                                $writeConnection->query($sqlUpdateProduct);
                                $writeConnection->query($sqlUpdateProductStatus);
                                $countUpdateProduct = 0;
                                $sqlUpdateProduct = '';
                                $sqlUpdateProductStatus = '';
                            }
                        }
                    }
                }
            }
            $adjustprs = Mage::getModel('inventoryplus/adjuststock_product')->getCollection()
                    ->addFieldToFilter('adjuststock_id', $adjuststock->getId())
                    ->addFieldToFilter('product_id', array('nin' => $productIds));
            foreach ($adjustprs as $adjustpr)
                $adjustpr->delete();

            if (!empty($sqlNews) && $confirm) {
                $writeConnection->insertMultiple($installer->getTableName('inventoryplus/warehouse_product'), $sqlNews);
            }
            if ($confirm) {
                if (!empty($sqlOlds)) {
                    $writeConnection->query($sqlOlds);
                }
                if (!empty($sqlOldsAvailable)) {
                    $writeConnection->query($sqlOldsAvailable);
                }
                //add history for warehouse
                foreach ($adjusthistory as $productId => $value) {
                    $productSku = Mage::helper('inventoryplus/warehouse')->getProductSkuByProductId($productId);
                    $warehouseHistory = Mage::getModel('inventoryplus/warehouse_history');
                    $warehouseHistory->setData('warehouse_id', $value['warehouse'])
                            ->setData('time_stamp', now())
                            ->setData('create_by', $admin)
                            ->save();
                    $warehouseHistoryContent = Mage::getModel('inventoryplus/warehouse_historycontent');
                    $warehouseHistoryContent->setData('warehouse_history_id', $warehouseHistory->getId())
                            ->setData('field_name', Mage::helper('inventoryplus')->__('%s changed quantity of product(s) with the following SKU(s) %s in stock adjustment number %s.', $admin, $productSku, $adjuststock->getId()))
                            ->setData('old_value', $value['old_qty'])
                            ->setData('new_value', $value['new_qty'])
                            ->save();
                }
            }
            if (!empty($sqlUpdateAdjustProduct)) {
                $writeConnection->query($sqlUpdateAdjustProduct);
            }
            if (!empty($sqlAdjustNew)) {
                $writeConnection->insertMultiple($installer->getTableName('inventoryplus/adjuststock_product'), $sqlAdjustNew);
            }
            if ($countUpdateProduct != 0 && $confirm) {
                if ($sqlUpdateProduct)
                    $writeConnection->query($sqlUpdateProduct);
                if ($sqlUpdateProductStatus)
                    $writeConnection->query($sqlUpdateProductStatus);
            }
        }
    }

}
