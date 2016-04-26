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
 * @package     Magestore_Inventorypurchasing
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventorypurchasing Adminhtml Controller
 * 
 * @category    Magestore
 * @package     Magestore_Inventorypurchasing
 * @author      Magestore Developer
 */
class Magestore_Inventorypurchasing_Adminhtml_PurchaseordersController extends Mage_Adminhtml_Controller_Action {

    public function indexAction() {
        $this->loadLayout()
                ->_setActiveMenu('inventoryplus');
        $this->_title($this->__('Inventory'))
                ->_title($this->__('Manage Purchase Orders'));
        $this->renderLayout();
    }

    public function editAction() {
        $purchaseOrderId = $this->getRequest()->getParam('id');
        $model = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);

        $supplier_id = $this->getRequest()->getParam('supplier_id');
        if (isset($supplier_id) && $supplier_id) {
            $this->_title($this->__('Inventory'))
                    ->_title($this->__('Add New Purchase Order'));
        }
        if ($purchaseOrderId) {
            $this->_title($this->__('Inventory'))
                    ->_title($this->__('Edit Purchase Order'));
        }
        if ($model->getId() || $purchaseOrderId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

            Mage::dispatchEvent('purchaseorder_edit_before', array('cotroller' => $this));

            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('purchaseorder_data', $model);

            $this->loadLayout()->_setActiveMenu('inventoryplus');
            $this->_setActiveMenu('inventoryplus');
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true)
                    ->removeItem('js', 'mage/adminhtml/grid.js')
                    ->addItem('js', 'magestore/adminhtml/inventory/grid.js');
            $this->_addContent($this->getLayout()->createBlock('inventorypurchasing/adminhtml_purchaseorder_edit'))
                    ->_addLeft($this->getLayout()->createBlock('inventorypurchasing/adminhtml_purchaseorder_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventorypurchasing')->__('Purchase Order does not exist!')
            );
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_title($this->__('Inventory'))
                ->_title($this->__('Add New Purchase Order'));

        $data = $this->getRequest()->getPost();

        $supplier_id = $this->getRequest()->getParam('supplier_id');
        if (isset($supplier_id) && $supplier_id) {
            $this->_forward('edit');
        } else {

            Mage::dispatchEvent('purchaseorder_new_before', array('cotroller' => $this));

            $this->loadLayout()->_setActiveMenu('inventoryplus');

            $this->_setActiveMenu('inventoryplus');
            $this->_addBreadcrumb(
                    Mage::helper('adminhtml')->__('Purchase Order'), Mage::helper('adminhtml')->__('Purchase Order')
            );
            $this->_addBreadcrumb(
                    Mage::helper('adminhtml')->__('Purchase Order News'), Mage::helper('adminhtml')->__('Purchase Order News')
            );
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('inventorypurchasing/adminhtml_purchaseorder_new'))
                    ->_addLeft($this->getLayout()->createBlock('inventorypurchasing/adminhtml_purchaseorder_new_tabs'));
            $this->renderLayout();
        }
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
            if (array_key_exists('send_mail', $data)) {
                $data['send_mail'] = 1;
            }            
            $admin = Mage::getModel('admin/session')->getUser()->getUsername();            
            $model = Mage::getModel('inventorypurchasing/purchaseorder');
            $data = $this->_filterDateTime($data, array('purchase_on'));
            $data = $this->_filterDates($data, array('started_date', 'canceled_date', 'expected_date', 'payment_date'));

            if ($this->getRequest()->getParam('supplier_id'))
                $data['supplier_id'] = $this->getRequest()->getParam('supplier_id');
            if ($this->getRequest()->getParam('warehouse_ids'))
                $data['warehouse_id'] = $this->getRequest()->getParam('warehouse_ids');
            if ($this->getRequest()->getParam('currency')) {
                $data['currency'] = $this->getRequest()->getParam('currency');
            }
            if ($this->getRequest()->getParam('change_rate')) {
                $data['change_rate'] = $this->getRequest()->getParam('change_rate');
            }

            $model = Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('id'));
            if ($this->getRequest()->getParam('id')) {
                $data['created_by'] = $model->getData('created_by');
                $data['status'] = $model->getData('status');
            }



            //create a new shipping method
            if ($data['ship_via'] == 'new' && $data['ship_via_new']) {
                try {
                    $shippingMethod = Mage::getModel('inventorypurchasing/shippingmethod');
                    $shippingMethod->setData('shipping_method_name', $data['ship_via_new'])
                            ->setData('shipping_method_status', 1)
                            ->setData('created_by', $admin)
                            ->save();
                    $data['ship_via'] = $shippingMethod->getId();
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('inventorypurchasing')->__('The shipping method "%s" has been created.', $data['ship_via_new']));
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
            }

            // create payment term
            if ($data['payment_term'] == 'new' && $data['payment_term_new']) {
                try {
                    $paymentTerm = Mage::getModel('inventorypurchasing/paymentterm');
                    $paymentTerm->setData('payment_term_name', $data['payment_term_new'])
                            ->setData('payment_term_status', 1)
                            ->setData('payment_days', 7)
                            ->setData('created_by', $admin)
                            ->save();
                    $data['payment_term'] = $paymentTerm->getId();

                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('inventorypurchasing')->__('The payment term "%s" has been created with the default payment period of 7 days.', $data['payment_term_new']));
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
            }

            $model->addData($data);

            $purchaseOrderModel = Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('id'));

            if ($data['paid_more']) {
                if ($this->getRequest()->getParam('id')) {
                    $data['paid'] = $purchaseOrderModel->getPaid() + $data['paid_more'];
                } else {
                    $data['paid'] = $data['paid_more'];
                }
                $model->setPaid($data['paid']);
            } else {
                if (!$this->getRequest()->getParam('id')) {
                    $data['paid'] = 0;
                }
            }
            $supplier_id = $data['supplier_id'];
            $supplierProducts = Mage::getModel('inventorypurchasing/supplier_product')
                    ->getCollection()
                    ->addFieldToFilter('supplier_id', $supplier_id);
            $supplierProductIds = array();
            foreach ($supplierProducts as $supplierProduct) {
                $supplierProductIds[] = $supplierProduct->getProductId();
            }
            try {
                if (!Mage::helper('inventorypurchasing/purchaseorder')->haveDelivery($this->getRequest()->getParam('id'))) {
                    $supplierModel = Mage::getModel('inventorypurchasing/supplier')->load($supplier_id);
                    if ($purchaseOrderModel->getId()) {
                        $warehouse_ids = $purchaseOrderModel->getWarehouseId();
                    } else {
                        $warehouse_ids = $data['warehouse_id'];
                    }
                    $warehouseIds = explode(',', $warehouse_ids);
                    $warehouseName = '';
                    foreach ($warehouseIds as $warehouseId) {
                        $warehouseModel = Mage::getModel('inventoryplus/warehouse')->load($warehouseId);
                        $warehouseName .= ', ' . $warehouseModel->getWarehouseName();
                    }

                    if ($supplierModel->getId())
                        $model->setSupplierName($supplierModel->getSupplierName());
                    if ($warehouseModel->getId())
                        $model->setWarehouseName($warehouseName);
                }
                //check field changed
                $change=0;
                if ($this->getRequest()->getParam('id')) {
                    $oldData = Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('id'));
                    $changeArray = array();
                    $changeData = 0;
                    $change=1;
                    foreach ($data as $key => $value) {
                        if (!in_array($key, $this->getFiledSaveHistory()))
                            continue;
                        if ($oldData->getData($key) != $value) {
                            $changeArray[$key]['old'] = $oldData->getData($key);
                            $changeArray[$key]['new'] = $value;
                            $changeData = 1;
                        }
                    }
                }


                if (!$this->getRequest()->getParam('id')) {
                    $model->setData('created_by', $admin);
                }
                $purchaseOrderId = $model->save()->getId();


                //add history for payment term
                if ($data['payment_term_new'] && isset($paymentTerm)) {
                    $paymentTermHistory = Mage::getModel('inventorypurchasing/paymentterm_history');
                    $paymentTermHistoryContent = Mage::getModel('inventorypurchasing/paymentterm_historycontent');
                    $paymentTermHistory->setData('payment_term_id', $paymentTerm->getId())
                            ->setData('time_stamp', now())
                            ->setData('created_by', $admin)
                            ->save();
                    $paymentTermHistoryContent->setData('payment_term_history_id', $paymentTermHistory->getId())
                            ->setData('field_name', Mage::helper('inventorypurchasing')->__('%s created this payment term on purchase order #%s.', $admin, $purchaseOrderId))
                            ->save();
                }

                //add history for shipping method
                if ($data['ship_via_new'] && isset($shippingMethod)) {
                    $shippingMethodHistory = Mage::getModel('inventorypurchasing/shippingmethod_history');
                    $shippingMethodHistoryContent = Mage::getModel('inventorypurchasing/shippingmethod_historycontent');
                    $shippingMethodHistory->setData('shipping_method_id', $shippingMethod->getId())
                            ->setData('time_stamp', now())
                            ->setData('created_by', $admin)
                            ->save();
                    $shippingMethodHistoryContent->setData('shipping_method_history_id', $shippingMethodHistory->getId())
                            ->setData('field_name', Mage::helper('inventorypurchasing')->__('%s created this shipping method on purchase order #%s.', $admin, $purchaseOrderId))
                            ->save();
                }

                //save histoty change
                if (!$this->getRequest()->getParam('id')) {
                    $purchaseOrderHistory = Mage::getModel('inventorypurchasing/purchaseorder_history');
                    $purchaseOrderHistoryContent = Mage::getModel('inventorypurchasing/purchaseorder_historycontent');
                    $purchaseOrderHistory->setData('purchase_order_id', $model->getId())
                            ->setData('time_stamp', now())
                            ->setData('created_by', $admin)
                            ->save();
                    $purchaseOrderHistoryContent->setData('purchase_order_history_id', $purchaseOrderHistory->getId())
                            ->setData('field_name', Mage::helper('inventorypurchasing')->__('%s created this purchase order.', $admin))
                            ->save();
                } else {
                    if ($changeData == 1) {
                        $purchaseOrderHistory = Mage::getModel('inventorypurchasing/purchaseorder_history');
                        $purchaseOrderHistory->setData('purchase_order_id', $model->getId())
                                ->setData('time_stamp', now())
                                ->setData('created_by', $admin)
                                ->save();
                        foreach ($changeArray as $field => $filedValue) {
                            $fileTitle = $this->getTitleByField($field);
                            if ($field == 'status') {
                                $statusArray = Mage::helper('inventorypurchasing/purchaseorder')->getReturnOrderStatus();
                                $filedValue['old'] = $statusArray[$filedValue['old']];
                                $filedValue['new'] = $statusArray[$filedValue['new']];
                            } elseif ($field == 'ship_via') {
                                $shipArray = Mage::helper('inventorypurchasing/purchaseorder')->getShippingMethod();
                                $filedValue['old'] = $shipArray[$filedValue['old']];
                                $filedValue['new'] = $shipArray[$filedValue['new']];
                            } elseif ($field == 'payment_term') {
                                $paymentArray = Mage::helper('inventorypurchasing/purchaseorder')->getPaymentTerms();
                                $filedValue['old'] = $paymentArray[$filedValue['old']];
                                $filedValue['new'] = $paymentArray[$filedValue['new']];
                            } elseif ($field == 'order_placed') {
                                $placedArray = Mage::helper('inventorypurchasing/purchaseorder')->getOrderPlaced();
                                $filedValue['old'] = $placedArray[$filedValue['old']];
                                $filedValue['new'] = $placedArray[$filedValue['new']];
                            }
                            $purchaseOrderHistoryContent = Mage::getModel('inventorypurchasing/purchaseorder_historycontent');
                            $purchaseOrderHistoryContent->setData('purchase_order_history_id', $purchaseOrderHistory->getId())
                                    ->setData('field_name', $fileTitle)
                                    ->setData('old_value', $filedValue['old'])
                                    ->setData('new_value', $filedValue['new'])
                                    ->save();
                        }
                    }
                }

                $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($model->getId());
                $resource = Mage::getSingleton('core/resource');
                $writeConnection = $resource->getConnection('core_write');
                $installer = Mage::getModel('core/resource');
                $sqlNews = array();
                $sqlWarehouseNew = array();
                $sqlOlds = '';
                $countSqlOlds = 0;
                $countSqlWarehouse = 0;
                if (isset($data['purchaseorder_products'])) {
                    $purchaseorderProducts = array();
                    $purchaseorderProductsExplodes = explode('&', urldecode($data['purchaseorder_products']));
                    if (count($purchaseorderProductsExplodes) <= 900) {
                        parse_str(urldecode($data['purchaseorder_products']), $purchaseorderProducts);
                    } else {
                        foreach ($purchaseorderProductsExplodes as $purchaseorderProductsExplode) {
                            $purchaseorderProduct = '';
                            parse_str($purchaseorderProductsExplode, $purchaseorderProduct);
                            $purchaseorderProducts = $purchaseorderProducts + $purchaseorderProduct;
                        }
                    }

                    if (count($purchaseorderProducts)) {
                        $productIds = '';
                        $qtys = '';
                        $count = 0;
                        $totalProducts = 0;
                        $totalAmounts = 0;
                        $sqlCount = 0;
                        $sqlNews = array();
                        $changeRateNow = $model->getChangeRate();
                        $sqlWarehouse = '';
                        foreach ($purchaseorderProducts as $pId => $enCoded) {
                            if (in_array($pId, $supplierProductIds)) {
                                $count = 0;
                                $codeArr = array();
                                parse_str(base64_decode($enCoded), $codeArr);
                                $purchaseorderProductItem = Mage::getModel('inventorypurchasing/purchaseorder_product')
                                        ->getCollection()
                                        ->addFieldToFilter('purchase_order_id', $model->getId())
                                        ->addFieldToFilter('product_id', $pId)
                                        ->getFirstItem();

                                $productInfo = Mage::getModel('inventorypurchasing/supplier_product')
                                        ->getCollection()
                                        ->addFieldToFilter('supplier_id', $purchaseOrder->getSupplierId())
                                        ->addFieldToFilter('product_id', $pId)
                                        ->getFirstItem();
                                $productModel = Mage::getModel('catalog/product')->load($pId);
                                $productIds[] = $pId;
                                if ($purchaseorderProductItem->getId()) {
                                    $purchase_order_id = $model->getId();
                                    $oldQty = $purchaseorderProductItem->getQty();
                                    $codeArr['qty_order'] = 0;
//                                    Zend_Debug::Dump($codeArr);die();
                                    foreach ($codeArr as $codeId => $code) {
                                        if (!in_array($codeId, array('qty_order', 'cost_product', 'tax', 'discount', 'supplier_sku'))) {
                                            $codeId = explode('_', $codeId);

                                            if ($codeId[1]) {
                                                $codeArr['qty_order'] += $code;
                                                $sqlWarehouse .= 'UPDATE ' . $installer->getTableName('erp_inventory_purchase_order_product_warehouse') . ' 
                                                                            SET `qty_order` = \'' . $code . '\'
                                                                                    WHERE `purchase_order_id` =' . $purchase_order_id . ' AND `product_id` =' . $pId . ' AND `warehouse_id`=' . $codeId[1] . ' ;';
                                            }
                                            $countSqlWarehouse++;
                                        }
                                        if ($countSqlWarehouse == 900) {
                                            $writeConnection->query($sqlWarehouse);
                                            $sqlWarehouse = '';
                                            $countSqlWarehouse = 0;
                                        }
                                    }
                                    if ($codeArr['qty_order'] == 0) {
                                        $codeArr['qty_order'] = $oldQty;
                                    }
                                    $cost = isset($codeArr['cost_product']) ? $codeArr['cost_product'] : $purchaseorderProductItem->getCost();
                                    $tax = isset($codeArr['tax']) ? $codeArr['tax'] : $purchaseorderProductItem->getTax();
                                    $discount = isset($codeArr['discount']) ? $codeArr['discount'] : $purchaseorderProductItem->getDiscount();
                                    $supplierSku = isset($codeArr['supplier_sku']) ? $codeArr['supplier_sku'] : $purchaseorderProductItem->getSupplierSku();
                                    $countSqlOlds++;
                                    $totalAmounts += $codeArr['qty_order'] * $cost * (1 - $discount / 100 + $tax / 100);
                                    $totalProducts += $codeArr['qty_order'];
//                                    if ($codeArr['qty_order'] == $purchaseorderProductItem->getQty()) {
//                                        continue;
//                                    }
                                    $sqlOlds .= 'UPDATE ' . $installer->getTableName('inventorypurchasing/purchaseorder_product') . ' 
                                                                            SET `qty` = \'' . $codeArr['qty_order'] . '\', `tax` = \'' . $tax . '\',`supplier_sku` = \'' . $supplierSku . '\', `cost` = \'' . $cost . '\', `discount` = \'' . $discount . '\'
                                                                                    WHERE `purchase_order_product_id` =' . $purchaseorderProductItem->getId() . ';';
//                                    Zend_Debug::dump($sqlOlds);die();
                                    if ($countSqlOlds == 900) {
                                        $writeConnection->query($sqlOlds);
                                        $sqlOlds = '';
                                        $countSqlOlds = 0;
                                    }
                                } else {
                                    $sqlCount++;
                                    $product_id = $pId;
                                    $product_name = $productModel->getName();
                                    $product_sku = $productModel->getSku();
                                    $purchase_order_id = $model->getId();
                                    $qty = 0;
                                    $codeArr['qty_order'] = 0;
                                    $cost = 0;
                                    $discount = 0;
                                    $tax = 0;
                                    foreach ($codeArr as $codeId => $code) {

                                        if (!in_array($codeId, array('qty_order', 'cost_product', 'tax', 'discount', 'supplier_sku'))) {
                                            $codeId = explode('_', $codeId);


                                            if ($codeId[1]) {
                                                if (!$code || $code < 0)
                                                    $code = 0;
                                                $sqlWarehouseNew[] = array(
                                                    'purchase_order_id' => $purchase_order_id,
                                                    'product_id' => $product_id,
                                                    'product_name' => $product_name,
                                                    'product_sku' => $product_sku,
                                                    'warehouse_id' => $codeId[1],
                                                    'warehouse_name' => Mage::getModel('inventoryplus/warehouse')->load($codeId[1])->getWarehouseName(),
                                                    'qty_order' => $code
                                                );
                                                $qty += $code;
                                                $codeArr['qty_order'] += $code;
                                                if (count($sqlWarehouseNew) == 1000) {
                                                    $writeConnection->insertMultiple($installer->getTableName('erp_inventory_purchase_order_product_warehouse'), $sqlWarehouseNew);
                                                    $sqlWarehouseNew = array();
                                                }
                                            }
                                        }
                                    }

                                    $cost = $codeArr['cost_product'];
                                    $discount = $codeArr['discount'];
                                    $tax = $codeArr['tax'];
                                    $supplier_sku = $codeArr['supplier_sku'];
                                    $totalAmounts += $codeArr['qty_order'] * $cost * (1 - $discount / 100 + $tax / 100);
                                    if (!$this->getRequest()->getParam('id')) {
                                        Mage::dispatchEvent('purchaseorder_save_product', array('productInfo' => $productInfo, 'cost' => $cost, 'tax' => $tax, 'discount' => $discount, 'supplier_sku' => $supplier_sku, 'change_rate_now' => $changeRateNow));
                                    }
                                    $sqlNews[] = array(
                                        'product_id' => $product_id,
                                        'product_name' => $product_name,
                                        'product_sku' => $product_sku,
                                        'purchase_order_id' => $purchase_order_id,
                                        'qty' => $qty,
                                        'cost' => $cost,
                                        'discount' => $discount,
                                        'tax' => $tax,
                                        'supplier_sku' => $supplier_sku
                                    );

                                    if (count($sqlNews) == 1000) {
                                        $writeConnection->insertMultiple($installer->getTableName('inventorypurchasing/purchaseorder_product'), $sqlNews);
                                        $sqlNews = array();
                                    }

                                    $totalProducts += $codeArr['qty_order'];
                                }
                            }
                        }
                        if (!empty($sqlNews)) {
                            $writeConnection->insertMultiple($installer->getTableName('inventorypurchasing/purchaseorder_product'), $sqlNews);
                        }
                        if (!empty($sqlWarehouseNew)) {
                            $writeConnection->insertMultiple($installer->getTableName('erp_inventory_purchase_order_product_warehouse'), $sqlWarehouseNew);
                        }
                        if (!empty($sqlOlds)) {
                            $writeConnection->query($sqlOlds);
                        }
                        if (!empty($sqlWarehouse)) {
                            $writeConnection->query($sqlWarehouse);
                        }
                        $writeConnection->commit();
                        $productDeletes = Mage::getModel('inventorypurchasing/purchaseorder_product')->getCollection()
                                ->addFieldToFilter('purchase_order_id', $model->getId())
                                ->addFieldToFilter('product_id', array('nin' => $productIds));
                        if (count($productDeletes) > 0) {
                            foreach ($productDeletes as $productDelete)
                                $productDelete->delete();
                        }
                    }

                    $model->setTotalProducts($totalProducts)
                            ->setTotalAmount($totalAmounts)
                            ->save();
                }

                if (array_key_exists('send_mail', $data)) {
                    $this->sendEmail($data['supplier_id'], $sqlNews, $purchaseOrderId);
                }

                if (!$this->getRequest()->getParam('id')) {
                    if ($totalProducts <= 0) {
                        $model->delete();
                        Mage::getSingleton('adminhtml/session')->addError(
                                Mage::helper('inventorypurchasing')->__('Please fill qty for product(s) to purchase order!')
                        );
                        $this->_redirect('*/*/new');
                        return;
                    }
                }
                Mage::dispatchEvent('purchaseorder_save_after', array('action'=>$change,'purchase_order_id'=>$model->getId()));
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('inventorypurchasing')->__('The purchase order has been saved successfully.')
                );
                if ($data['status'] == 6 && !$this->getRequest()->getParam('id')) {
                    $this->_redirect('*/*/allDelivery', array('purchaseorder_id' => $model->getId()));
                    return;
                }
                Mage::getSingleton('adminhtml/session')->setFormData(false);
               
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventorypurchasing')->__('Unable to find Purchase order to save!')
        );
        $this->_redirect('*/*/');
    }

    public function massStatusAction() {
        $purchaseOrderIds = $this->getRequest()->getParam('purchaseorder_ids');
        if (!is_array($purchaseOrderIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('inventorypurchasing')->__('Please select purchase order(s)!'));
        } else {
            $massStatus = $this->getRequest()->getParam('status');
            if ($massStatus == '7' || $massStatus == '5') { //Canceled and Waiting Delivery
                foreach ($purchaseOrderIds as $purchaseOrderId) {
                    $hasDelivery = Mage::helper('inventorypurchasing/purchaseorder')->haveDelivery($purchaseOrderId);
                    if ($hasDelivery && $massStatus == '7') {
                        Mage::getSingleton('adminhtml/session')->addError(
                                Mage::helper('inventorypurchasing')->__('The purchase order cannot be canceled because some items have been received through deliveries.')
                        );
                        $this->_redirect('*/*/index');
                        return;
                    }
                    $canCancel = Mage::helper('inventorypurchasing/purchaseorder')->canCancel($purchaseOrderId);
                    if (!$canCancel && $massStatus == '7') {
                        Mage::getSingleton('adminhtml/session')->addError(
                                Mage::helper('inventorypurchasing')->__('The purchase order cannot be canceled because some items have been received through deliveries.')
                        );
                        $this->_redirect('*/*/index');
                        return;
                    }
                    $canWaittingDelivery = Mage::helper('inventorypurchasing/purchaseorder')->canWaittingDelivery($purchaseOrderId);
                    if (!$canWaittingDelivery) {
                        Mage::getSingleton('adminhtml/session')->addError(
                                Mage::helper('inventorypurchasing')->__('The purchase order cannot be canceled because all deliveries have been completed.')
                        );
                        $this->_redirect('*/*/index');
                        return;
                    }
                }
            }

            try {
                $supplierPurchaseOrder = array();
                foreach ($purchaseOrderIds as $purchaseOrderId) {
                    $purchaseOrder = Mage::getSingleton('inventorypurchasing/purchaseorder')
                            ->load($purchaseOrderId);
                    $purchaseOrder->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();

                    if ($this->getRequest()->getParam('status') == 7) {
                        $supplierId = $purchaseOrder->getSupplierId();
                        $supplier = Mage::getModel('inventorypurchasing/supplier')->load($supplierId);
                        if (!in_array($supplierId, $supplierPurchaseOrder)) {
                            $supplierPurchaseOrder[] = $supplierId;
                            $supplier->save();
                        }
                    }
                }
                $this->_getSession()->addSuccess(
                        Mage::helper('inventorypurchasing')->__('Total %d record(s) were successfully updated', count($purchaseOrderIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function exportCsvAction() {
        $fileName = 'purchase_order.csv';
        $content = $this->getLayout()
                ->createBlock('inventorypurchasing/adminhtml_purchaseorder_grid')
                ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportcsvpurchaseorderAction() {
        //new version - pdf
//        require("lib/Magestore/Pdf/html2fpdf.php");
        $purchaseOrderId = $this->getRequest()->getParam('id');
        $purchaseOrderProducts = Mage::getModel('inventorypurchasing/purchaseorder_product')->getCollection()
                ->addFieldToFilter('purchase_order_id', $purchaseOrderId);

        $sqlNews = $purchaseOrderProducts->getData();
        $img = Mage::getDesign()->getSkinUrl('images/logo_black.png', array('_area' => 'frontend'));
        $contents = '<div><img src="' . $img . '" /></div>'.'<br><br>';
        $contents .= $this->getLayout()->createBlock('inventorypurchasing/adminhtml_purchaseorder')
                ->setPurchaseorderid($purchaseOrderId)
                ->setSqlnews($sqlNews)
                ->setTemplate('inventorypurchasing/purchaseorder/sendtosupplier.phtml')
                ->toHtml();

        include("lib/Magestore/MPDF56/mpdf.php");

        $mpdf = new mPDF();

        $mpdf->WriteHTML($contents);
        $fileName = 'PurchaseOrderId' . $purchaseOrderId;
        $mpdf->Output($fileName . '.pdf', 'D');
        exit;

        require_once('lib/Magestore/html2pdf_v4.03/html2pdf.class.php');
        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'en');
            $html2pdf->writeHTML($contents, isset($_GET['vuehtml']));
            $html2pdf->Output('exemple13.pdf');
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }

    public function exportXmlAction() {
        $fileName = 'purchase_order.xml';
        $content = $this->getLayout()
                ->createBlock('inventorypurchasing/adminhtml_purchaseorder_grid')
                ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('inventoryplus');
    }

    public function productAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.purchaseorder.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('purchaseorder_products', null));
        if ($warehouseIds = $this->getRequest()->getParam('warehouse_ids')) {
            $warehouseIds = explode(',', $warehouseIds);
            $addmore = '';
            foreach ($warehouseIds as $warehouseId) {
                $this->getLayout()->getBlock('related_grid_serializer')->addColumnInputName('warehouse_' . $warehouseId);
            }
        } elseif ($this->getRequest()->getParam('id')) {
            $resource = Mage::getSingleton('core/resource');
            $readConnection = $resource->getConnection('core_read');
            $installer = Mage::getModel('core/resource');
            $sql = 'SELECT distinct(`warehouse_id`) from ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' . $this->getRequest()->getParam("id") . ')';
            $results = $readConnection->fetchAll($sql);
            if (count($results) > 0) {
                foreach ($results as $result) {
                    $this->getLayout()->getBlock('related_grid_serializer')->addColumnInputName('warehouse_' . $result['warehouse_id']);
                }
            } else {
                $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('id'));
                $warehouseIds = $purchaseOrder->getWarehouseId();
                $warehouseIds = explode(',', $warehouseIds);
                foreach ($warehouseIds as $warehouseId) {
                    $this->getLayout()->getBlock('related_grid_serializer')->addColumnInputName('warehouse_' . $warehouseId);
                }
            }
        }
        $this->getLayout()->getBlock('related_grid_serializer')->addColumnInputName('cost_product');
        $this->getLayout()->getBlock('related_grid_serializer')->addColumnInputName('tax');
        $this->getLayout()->getBlock('related_grid_serializer')->addColumnInputName('discount');
        $this->getLayout()->getBlock('related_grid_serializer')->addColumnInputName('supplier_sku');
        $this->renderLayout();
        if (Mage::getModel('admin/session')->getData('purchaseorder_product_import')) {
            Mage::getModel('admin/session')->setData('purchaseorder_product_import', null);
        }
    }

    public function productGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.purchaseorder.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('purchaseorder_products', null));
        $this->renderLayout();
    }

    public function deliveryAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.purchaseorder.edit.tab.delivery')
                ->setDeliveries($this->getRequest()->getPost('isdeliveries', null));
        $this->renderLayout();
    }

    public function deliveryGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.purchaseorder.edit.tab.delivery')
                ->setDeliveries($this->getRequest()->getPost('isdeliveries', null));
        $this->renderLayout();
    }

    public function newDeliveryAction() {
        $purchaseOrderId = $this->getRequest()->getParam('purchaseorder_id');
        $model = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
        $this->_title($this->__('Inventory'))
                ->_title($this->__('Add New Delivery'));
        if ($model->getId() || $purchaseOrderId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('purchaseorder_data', $model);

            $this->loadLayout()->_setActiveMenu('inventoryplus');

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('inventorypurchasing/adminhtml_purchaseorder_editdelivery'))
                    ->_addLeft($this->getLayout()->createBlock('inventorypurchasing/adminhtml_purchaseorder_editdelivery_tabs'));
            $this->renderLayout();

            if (Mage::getModel('admin/session')->getData('delivery_purchaseorder_product_import')) {
                Mage::getModel('admin/session')->setData('delivery_purchaseorder_product_import', null);
            }
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventorypurchasing')->__('Item does not exist')
            );
            $this->_redirect('*/*/');
        }
    }

    public function getWarehouseAvailable() {
        $adminId = Mage::getModel('admin/session')->getUser()->getId();
        if (!$adminId)
            return null;
        $warehouseAssigneds = Mage::getModel('inventoryplus/warehouse_permission')->getCollection()
                ->addFieldToFilter('admin_id', $adminId)
        ;
        $warehouseIds = array();
        foreach ($warehouseAssigneds as $warehouseAssigned) {
            if ($warehouseAssigned->getData('can_edit_warehouse') || $warehouseAssigned->getData('can_send_request_stock') || $warehouseAssigned->getData('can_adjust'))
                $warehouseIds[] = $warehouseAssigned->getWarehouseId();
        }
        return $warehouseIds;
    }

    public function prepareDeliveryAction() {
        $this->_title($this->__('Inventory'))
                ->_title($this->__('Add New Delivery'));

        $this->loadLayout()->_setActiveMenu('inventoryplus');
        $this->getLayout()->getBlock('inventorypurchasing.purchaseorder.edit.tab.preparedelivery')
                ->setProducts($this->getRequest()->getPost('isproducts', null));
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $installer = Mage::getModel('core/resource');
        $sql = 'SELECT distinct(`warehouse_id`) from ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' . $this->getRequest()->getParam("purchaseorder_id") . ')';
        $results = $readConnection->fetchAll($sql);
        foreach ($results as $result) {
            if(Mage::helper('inventoryplus')->getPermission($result['warehouse_id'], 'can_purchase_product')){
                $this->getLayout()->getBlock('related_grid_serializer')->addColumnInputName('warehouse_' . $result['warehouse_id']);
            }
        }
        if (Mage::helper('core')->isModuleEnabled('Magestore_Inventorybarcode')) {
            $this->getLayout()->getBlock('related_grid_serializer')->addColumnInputName('barcode');
        }

        $this->renderLayout();
        if (Mage::getModel('admin/session')->getData('delivery_purchaseorder_product_import')) {
            Mage::getModel('admin/session')->setData('delivery_purchaseorder_product_import', null);
        }
    }

    public function prepareDeliveryGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.purchaseorder.edit.tab.preparedelivery')
                ->setProducts($this->getRequest()->getPost('isproducts', null));
        $this->renderLayout();
    }

    public function checktimedeliveryAction() {
        $delivery_date = $this->getRequest()->getParam('delivery_date');
        if (!$delivery_date) {
            echo 'error';
        } else {
            $timestamp = Mage::getModel('core/date')->timestamp(time());
            $datestamp = strtotime(date('Y-m-d', $timestamp));
            $deliverydate = strtotime($delivery_date);
            if ($datestamp < $deliverydate) {
                echo 'error';
            }
        }
    }

    public function saveDeliveryAction() {
        $purchaseOrderId = $this->getRequest()->getParam('purchaseorder_id');

        if (!$purchaseOrderId) {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventorypurchasing')->__('Unable to find delivery to save!')
            );
            $this->_redirect('*/*/');
        }
        try {
            if ($data = $this->getRequest()->getPost()) {
                $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
                if (isset($data['delivery_products'])) {
                    $deliveryProducts = array();
                    parse_str(urldecode($data['delivery_products']), $deliveryProducts);

                    if (count($deliveryProducts)) {
                        $productIds = '';
                        $totalProductDelivery = 0;
                        $resource = Mage::getSingleton('core/resource');
                        $writeConnection = $resource->getConnection('core_write');
                        $installer = Mage::getModel('core/resource');
                        $sqlDeliveryWarehouseNew = array();
                        $receivingData = array();
                        $deliveryIds = array();
                        $sqlUpdateSystemProductStatus = '';
                        $sqlUpdateSystemProduct = '';
                        $countUpdateSystemProduct = 0;
                        $countUpdateWarehouseProduct = 0;
                        $sqlUpdateWarehouseProduct = '';
                        $addnewProduct = false;
                        $warehouseInsertProduct = array();

                        Mage::dispatchEvent('save_delivery_before', array('purchase_order_id' => $purchaseOrderId, 'products' => $deliveryProducts));
                        Mage::getModel('admin/session')->unsetData('delivery_create_at');
                        foreach ($deliveryProducts as $pId => $enCoded) {
                            $codeArr = array();
                            parse_str(base64_decode($enCoded), $codeArr);
							//Zend_Debug::dump($codeArr);die();
                            $purchaseorderProductItem = Mage::getModel('inventorypurchasing/purchaseorder_product')
                                    ->getCollection()
                                    ->addFieldToFilter('purchase_order_id', $purchaseOrderId)
                                    ->addFieldToFilter('product_id', $pId)
                                    ->getFirstItem();
                            if ($purchaseorderProductItem->getId()) {
                                $sametime = strtotime(now());
                                $totalmaxQtyReceive = $purchaseorderProductItem->getQty() - $purchaseorderProductItem->getQtyRecieved();

                                $codeArr['qty_delivery'] = 0;

                                foreach ($codeArr as $codeId => $code) {

                                    if ($codeId != 'qty_delivery' && $codeId != 'barcode' && $codeId != 'warehouse_SKU') {
                                        $codeId = explode('_', $codeId); //warehouse id


                                        $readConnection = $resource->getConnection('core_read');

                                        $sql = 'SELECT qty_order, qty_received, qty_returned FROM ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE purchase_order_id = ' . $purchaseOrderId . ' AND product_id = ' . $pId . ' AND warehouse_id = ' . $codeId[1];
                                        $result = $readConnection->fetchRow($sql);

                                        $maxQtyReceive = $result['qty_order'] - $result['qty_received'];


                                        if ($codeId[1]) {
                                            if (!$code || $code < 0)
                                                $code = 0;
                                            if ($code > $maxQtyReceive) {
                                                $code = $maxQtyReceive;
                                            }

                                            $codeArr['qty_delivery'] += $code;


                                            if ($code > 0) {
                                                $receivingData[$codeId[1]][$pId] = $code;
                                                $sqlDeliveryWarehouseNew[] = array(
                                                    'delivery_date' => $data['delivery_date'],
                                                    'purchase_order_id' => $purchaseOrderId,
                                                    'product_id' => $pId,
                                                    'product_sku' => $purchaseorderProductItem->getProductSku(),
                                                    'product_name' => $purchaseorderProductItem->getProductName(),
                                                    'warehouse_id' => $codeId[1],
                                                    'warehouse_name' => Mage::getModel('inventoryplus/warehouse')->load($codeId[1])->getWarehouseName(),
                                                    'qty_delivery' => $code,
                                                    'sametime' => $sametime
                                                );

                                                //add product via warehouse product
                                                $warehouseId = $codeId[1];
                                                $warehouseProduct = Mage::getModel('inventoryplus/warehouse_product')
                                                        ->getCollection()
                                                        ->addFieldToFilter('warehouse_id', $warehouseId)
                                                        ->addFieldToFilter('product_id', $pId)
                                                        ->getFirstItem();
                                                try {
                                                    if ($warehouseProduct->getId()) {
                                                        $qty = $warehouseProduct->getTotalQty() + $code;
                                                        $newQtyAvailable = $warehouseProduct->getAvailableQty() + $code;

                                                        $sqlUpdateWarehouseProduct .= 'UPDATE ' . $installer->getTableName('inventoryplus/warehouse_product') . '  SET `total_qty` = ' . $qty . ', `available_qty` = ' . $newQtyAvailable . ', updated_at = now() WHERE `warehouse_product_id` = ' . $warehouseProduct->getId() . ';';
                                                    } else {
                                                        $addnewProduct = true;
                                                        $warehouseInsertProduct[] = array(
                                                            'product_id' => $pId,
                                                            'warehouse_id' => $warehouseId,
                                                            'total_qty' => (int) $code,
                                                            'available_qty' => (int) $code,
                                                            'updated_at' => now()
                                                        );
                                                        if (count($warehouseInsertProduct) == 1000) {
                                                            $writeConnection->insertMultiple($installer->getTableName('inventoryplus/warehouse_product'), $warehouseInsertProduct);
                                                            $warehouseInsertProduct = array();
                                                        }
                                                    }
                                                } catch (Exception $e) {
                                                    
                                                }

                                                $countUpdateWarehouseProduct++;


                                                if ($countUpdateWarehouseProduct == 900) {
                                                    $writeConnection->query($sqlUpdateWarehouseProduct);
                                                    $sqlUpdateWarehouseProduct = '';
                                                    $countUpdateWarehouseProduct = 0;
                                                }

                                                //add product to system

                                                $sqlUpdateSystemProduct .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_item") . ' SET qty = qty + ' . $code . ', is_in_stock = 1 WHERE (product_id = ' . $pId . ');';
                                                $sqlUpdateSystemProductStatus .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_status") . ' SET qty = qty + ' . $code . ', stock_status = 1 WHERE (product_id = ' . $pId . ');';
                                                if ($countUpdateSystemProduct == 900) {
                                                    $writeConnection->query($sqlUpdateSystemProduct);
                                                    $writeConnection->query($sqlUpdateSystemProductStatus);
                                                    $countUpdateSystemProduct = 0;
                                                    $sqlUpdateSystemProduct = '';
                                                    $sqlUpdateSystemProductStatus = '';
                                                }
                                                $countUpdateSystemProduct++;

                                                $sqlWarehouseProductReceived = 'UPDATE ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' SET qty_received = qty_received + ' . $code . ' WHERE (product_id = ' . $pId . ') AND (purchase_order_id = ' . $purchaseOrderId . ') AND (warehouse_id = ' . $codeId[1] . ')';
                                                $writeConnection->query($sqlWarehouseProductReceived);
                                                if (count($sqlDeliveryWarehouseNew) == 1000) {
                                                    $writeConnection->insertMultiple($installer->getTableName('erp_inventory_delivery_warehouse'), $sqlDeliveryWarehouseNew);
                                                    $sqlDeliveryWarehouseNew = array();
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($codeArr['qty_delivery'] > $totalmaxQtyReceive)
                                    $codeArr['qty_delivery'] = $totalmaxQtyReceive;
                                if (!$codeArr['qty_delivery'] || $codeArr['qty_delivery'] <= 0)
                                    continue;
                                $purchaseorderProductItem->setQtyRecieved($purchaseorderProductItem->getQtyRecieved() + $codeArr['qty_delivery'])
                                        ->save();
                                $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                                $delivery = Mage::getModel('inventorypurchasing/purchaseorder_delivery');
                                $delivery->setDeliveryDate($data['delivery_date'])
                                        ->setQtyDelivery($codeArr['qty_delivery'])
                                        ->setPurchaseOrderId($purchaseOrderId)
                                        ->setProductId($pId)
                                        ->setProductName($purchaseorderProductItem->getProductName())
                                        ->setProductSku($purchaseorderProductItem->getProductSku())
                                        ->setSametime($sametime)
                                        ->setCreatedBy($admin)
                                        ->save();
                                $totalProductDelivery += $codeArr['qty_delivery'];
                                $deliveryIds[] = $delivery->getId();
								Mage::dispatchEvent('save_delivery_after', array('data' => $codeArr, 'product_id' => $pId, 'purchase_order_id' => $purchaseOrderId,'delivery'=>$delivery));
                            }
                        }
                        $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                        if (count($deliveryIds)) {
                            $purchaseOrderHistory = Mage::getModel('inventorypurchasing/purchaseorder_history');
                            $purchaseOrderHistoryContent = Mage::getModel('inventorypurchasing/purchaseorder_historycontent');
                            $purchaseOrderHistory->setData('purchase_order_id', $purchaseOrderId)
                                    ->setData('time_stamp', now())
                                    ->setData('created_by', $admin)
                                    ->save();
                            $purchaseOrderHistoryContent->setData('purchase_order_history_id', $purchaseOrderHistory->getId())
                                    ->setData('field_name', Mage::helper('inventorypurchasing')->__('%s created delivery for this purchase order.', $admin))
                                    ->setData('new_value', Mage::helper('inventorypurchasing')->__('Delivery ID(s): %s', implode(",", $deliveryIds)))
                                    ->save();
                        }
                        if (!empty($sqlDeliveryWarehouseNew)) {
                            $writeConnection->insertMultiple($installer->getTableName('erp_inventory_delivery_warehouse'), $sqlDeliveryWarehouseNew);
                        }

                        if (!empty($sqlUpdateSystemProduct)) {
                            $writeConnection->query($sqlUpdateSystemProduct);
                        }
                        if (!empty($sqlUpdateSystemProductStatus)) {
                            $writeConnection->query($sqlUpdateSystemProductStatus);
                        }

                        if (!empty($sqlUpdateWarehouseProduct)) {
                            $writeConnection->query($sqlUpdateWarehouseProduct);
                        }

                        if ($addnewProduct && !empty($warehouseInsertProduct)) {
                            $writeConnection->insertMultiple($installer->getTableName('inventoryplus/warehouse_product'), $warehouseInsertProduct);
                        }

                        if ($totalProductDelivery == 0) {
                            Mage::getSingleton('adminhtml/session')->addError(
                                    Mage::helper('inventorypurchasing')->__('Please select product and enter Qty greater than 0 to create delivery!')
                            );

                            $this->_redirect('*/*/newdelivery', array(
                                'purchaseorder_id' => $purchaseOrderId,
                                'action' => 'newdelivery',
                                'active' => 'delivery'
                            ));
                            return;
                        }
                    } else {
                        Mage::getSingleton('adminhtml/session')->addError(
                                Mage::helper('inventorypurchasing')->__('Please select product(s) to create delivery!')
                        );

                        $this->_redirect('*/*/newdelivery', array(
                            'purchaseorder_id' => $purchaseOrderId,
                            'action' => 'newdelivery',
                            'active' => 'delivery'
                        ));
                        return;
                    }
                } else {
                    Mage::getSingleton('adminhtml/session')->addError(
                            Mage::helper('inventorypurchasing')->__('Please select product(s) to create delivery!')
                    );
                    $this->_redirect('*/*/newdelivery', array(
                        'purchaseorder_id' => $purchaseOrderId,
                        'action' => 'newdelivery',
                        'active' => 'delivery'
                    ));
                    return;
                }
                /* auto create receiving */
                if (count($receivingData) && Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse')) {
                    foreach ($receivingData as $rData => $rCode) {

                        $transaction = Mage::getModel('inventorywarehouse/transaction');
                        $transaction->setType('3')
                                ->setWarehouseIdFrom($purchaseOrder->getSupplierId())
                                ->setWarehouseNameFrom($purchaseOrder->getSupplierName())
                                ->setWarehouseIdTo($rData)
                                ->setWarehouseNameTo(Mage::getModel('inventoryplus/warehouse')->load($rData)->getWarehouseName())
                                ->setCreatedAt(now())
                                ->setCreatedBy($admin)
                                ->setReason(Mage::helper('inventorypurchasing')->__('Receive from purchase order #%s', $purchaseOrderId))
                                ->save();
                        //transaction products
                        $totalProductTransaction = 0;
                        $sqlTransactionNew = array();
                        foreach ($rCode as $rPId => $rPQty) {
                            $product = Mage::getModel('catalog/product')->load($rPId);
                            $totalProductTransaction += $rPQty;
                            $sqlTransactionNew[] = array(
                                'warehouse_transaction_id' => $transaction->getId(),
                                'product_id' => $rPId,
                                'product_sku' => $product->getSku(),
                                'product_name' => $product->getName(),
                                'qty' => $rPQty
                            );
                            if (count($sqlTransactionNew) == 1000) {
                                $writeConnection->insertMultiple($installer->getTableName('inventorywarehouse/transaction_product'), $sqlTransactionNew);
                                $sqlTransactionNew = array();
                            }
                        }
                        if (!empty($sqlTransactionNew)) {
                            $writeConnection->insertMultiple($installer->getTableName('inventorywarehouse/transaction_product'), $sqlTransactionNew);
                        }
                        $transaction->setTotalProducts($totalProductTransaction)->save();
                    }
                }

                $totalProductOrder = 0;
                $totalProductReceived = 0;
                $purchaseOrderProducts = Mage::getModel('inventorypurchasing/purchaseorder_product')->getCollection()
                        ->addFieldToFilter('purchase_order_id', $purchaseOrderId);
                $purchaseOrder->setStatus(6);


                foreach ($purchaseOrderProducts as $purchaseOrderProduct) {
                    if ($purchaseOrderProduct->getQtyRecieved() < $purchaseOrderProduct->getQty()) {
                        $purchaseOrder->setStatus(5);
                    }
                    $totalProductOrder += $purchaseOrderProduct->getQty();
                    $totalProductReceived += $purchaseOrderProduct->getQtyRecieved();
                }
                $process = round(($totalProductReceived / $totalProductOrder) * 100, 2);
                $purchaseOrder->setDeliveryProcess($process)->save();
                $totalProduct_Recieved = $purchaseOrder->getData('total_products_recieved') + $totalProductDelivery;
                $purchaseOrder->setTotalProductsRecieved($totalProduct_Recieved);
                $purchaseOrder->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('inventorypurchasing')->__('The delivery has been saved.')
                );                
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('inventorypurchasingadmin/adminhtml_purchaseorders/edit', array('id' => $this->getRequest()->getParam('purchaseorder_id'), 'active' => 'delivery'));
                return;
            }
            
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/');
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventorypurchasing')->__('Unable to find delivery to save!')
        );
        $this->_redirect('*/*/');
    }

    public function allDeliveryAction() {
        $purchaseOrderId = $this->getRequest()->getParam('purchaseorder_id');
        if (!$purchaseOrderId) {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventorypurchasing')->__('Unable to find delivery to save!')
            );
            $this->_redirect('*/*/');
        }
        try {
            $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
            $purchaseOrderProducts = Mage::getResourceModel('inventorypurchasing/purchaseorder_product_collection')
                    ->addFieldToFilter('purchase_order_id', $this->getRequest()->getParam('purchaseorder_id'));
            $totalProductDelivery = 0;

            if (count($purchaseOrderProducts)) {
                $resource = Mage::getSingleton('core/resource');
                $writeConnection = $resource->getConnection('core_write');
                $readConnection = $resource->getConnection('core_read');
                $installer = Mage::getModel('core/resource');
                $sqlDeliveryWarehouseNew = array();
                $receivingData = array();
                $deliveryIds = array();
                $productInfo = array();


                $sqlUpdateSystemProductStatus = '';
                $sqlUpdateSystemProduct = '';
                $countUpdateSystemProduct = 0;
                $countUpdateWarehouseProduct = 0;
                $sqlUpdateWarehouseProduct = '';
                $addnewProduct = false;
                $warehouseInsertProduct = array();


                foreach ($purchaseOrderProducts as $product) {
                    $sametime = strtotime(now());
                    $sql = 'SELECT warehouse_id,qty_order,qty_received from ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' . $this->getRequest()->getParam("purchaseorder_id") . ') AND (product_id = ' . $product->getProductId() . ')';
                    $results = $readConnection->fetchAll($sql);
                    $qtyDeliveries = 0;
                    $maxQtyReceive = $product->getQty() - $product->getQtyRecieved();
                    $warehouseIds = array();
                    foreach ($results as $result) {
                        $qtyDefault = $result['qty_order'] - $result['qty_received'];
                        if ($qtyDefault < 0)
                            $qtyDefault = 0;
                        if ($qtyDefault > 0) {
                            if ($qtyDeliveries + $qtyDefault > $maxQtyReceive) {
                                $qtyDefault = $maxQtyReceive - $qtyDeliveries;
                                $qtyDeliveries = $maxQtyReceive;
                            } else {
                                $qtyDeliveries += $qtyDefault;
                            }
                            $totalProductDelivery += $qtyDefault;
                            if ($qtyDefault > 0) {
                                $receivingData[$result['warehouse_id']][$product->getProductId()] = $qtyDefault;
                                $productInfo[$product->getProductId()]['sku'] = $product->getProductSku();
                                $productInfo[$product->getProductId()]['name'] = $product->getProductName();
                                $sqlDeliveryWarehouseNew[] = array(
                                    'delivery_date' => now(),
                                    'purchase_order_id' => $purchaseOrderId,
                                    'product_id' => $product->getProductId(),
                                    'product_sku' => $product->getProductSku(),
                                    'product_name' => $product->getProductName(),
                                    'warehouse_id' => $result['warehouse_id'],
                                    'warehouse_name' => Mage::getModel('inventoryplus/warehouse')->load($result['warehouse_id'])->getWarehouseName(),
                                    'qty_delivery' => $qtyDefault,
                                    'sametime' => $sametime
                                );
                                //add warehouse product
                                $warehouseId = $result['warehouse_id'];
                                $warehouseIds[] = $warehouseId;
                                $warehouseProduct = Mage::getModel('inventoryplus/warehouse_product')
                                        ->getCollection()
                                        ->addFieldToFilter('warehouse_id', $warehouseId)
                                        ->addFieldToFilter('product_id', $product->getProductId())
                                        ->getFirstItem();


                                try {
                                    if ($warehouseProduct->getId()) {
                                        $qty = $warehouseProduct->getTotalQty() + $qtyDefault;
                                        $newQtyAvailable = $warehouseProduct->getAvailableQty() + $qtyDefault;

                                        $sqlUpdateWarehouseProduct .= 'UPDATE ' . $installer->getTableName('inventoryplus/warehouse_product') . '  SET `total_qty` = ' . $qty . ', `available_qty` = ' . $newQtyAvailable . ', updated_at = now() WHERE `warehouse_product_id` = ' . $warehouseProduct->getId() . ';';
                                    } else {
                                        $addnewProduct = true;
                                        $warehouseInsertProduct[] = array(
                                            'product_id' => $product->getProductId(),
                                            'warehouse_id' => $warehouseId,
                                            'total_qty' => (int) $qtyDefault,
                                            'available_qty' => (int) $qtyDefault,
                                            'updated_at' => now()
                                        );
                                        if (count($warehouseProduct) == 1000) {
                                            $writeConnection->insertMultiple($installer->getTableName('inventoryplus/warehouse_product'), $warehouseInsertProduct);
                                            $warehouseProduct = array();
                                        }
                                    }
                                } catch (Exception $e) {
                                    
                                }

                                $countUpdateWarehouseProduct++;


                                if ($countUpdateWarehouseProduct == 900) {
                                    $writeConnection->query($sqlUpdateWarehouseProduct);
                                    $sqlUpdateWarehouseProduct = '';
                                    $countUpdateWarehouseProduct = 0;
                                }


                                //add product to system

                                $sqlUpdateSystemProduct .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_item") . ' SET qty = qty + ' . $qtyDefault . ', is_in_stock = 1 WHERE (product_id = ' . $product->getProductId() . ');';
                                $sqlUpdateSystemProductStatus .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_status") . ' SET qty = qty + ' . $qtyDefault . ', stock_status = 1 WHERE (product_id = ' . $product->getProductId() . ');';
                                if ($countUpdateSystemProduct == 900) {
                                    $writeConnection->query($sqlUpdateSystemProduct);
                                    $writeConnection->query($sqlUpdateSystemProductStatus);
                                    $countUpdateSystemProduct = 0;
                                    $sqlUpdateSystemProduct = '';
                                    $sqlUpdateSystemProductStatus = '';
                                }
                                $countUpdateSystemProduct++;

                                $sqlWarehouseProductReceived = 'UPDATE ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' SET qty_received = qty_received + ' . $qtyDefault . ' WHERE (product_id = ' . $product->getProductId() . ') AND (purchase_order_id = ' . $purchaseOrderId . ') AND (warehouse_id = ' . $result['warehouse_id'] . ')';
                                $writeConnection->query($sqlWarehouseProductReceived);
                                if (count($sqlDeliveryWarehouseNew) == 1000) {
                                    $writeConnection->insertMultiple($installer->getTableName('erp_inventory_delivery_warehouse'), $sqlDeliveryWarehouseNew);
                                    $sqlDeliveryWarehouseNew = array();
                                }
                            }
                        }
                    }
                    if ($qtyDeliveries > $maxQtyReceive)
                        $qtyDeliveries = $maxQtyReceive;
                    if (!$qtyDeliveries || $qtyDeliveries <= 0)
                        continue;
                    $product->setQtyRecieved($product->getQtyRecieved() + $qtyDeliveries)
                            ->save();
                    $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                    $delivery = Mage::getModel('inventorypurchasing/purchaseorder_delivery');
                    $delivery->setDeliveryDate(now())
                            ->setQtyDelivery($qtyDeliveries)
                            ->setPurchaseOrderId($purchaseOrderId)
                            ->setProductId($product->getProductId())
                            ->setProductName($product->getProductName())
                            ->setProductSku($product->getProductSku())
                            ->setSametime($sametime)
                            ->setCreatedBy($admin)
                            ->save();
                    $deliveryIds[] = $delivery->getId();

                    Mage::dispatchEvent('save_all_delivery_after', array('warehouse_id' => $warehouseIds, 'product_id' => $product->getProductId(), 'purchase_order_id' => $purchaseOrderId, 'qty_received' => $qtyDeliveries));
                }

                //history change
                $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                if (count($deliveryIds)) {
                    $purchaseOrderHistory = Mage::getModel('inventorypurchasing/purchaseorder_history');
                    $purchaseOrderHistoryContent = Mage::getModel('inventorypurchasing/purchaseorder_historycontent');
                    $purchaseOrderHistory->setData('purchase_order_id', $purchaseOrderId)
                            ->setData('time_stamp', now())
                            ->setData('created_by', $admin)
                            ->save();
                    $purchaseOrderHistoryContent->setData('purchase_order_history_id', $purchaseOrderHistory->getId())
                            ->setData('field_name', Mage::helper('inventorypurchasing')->__('%s created delivery for this purchase order.', $admin))
                            ->setData('new_value', Mage::helper('inventorypurchasing')->__('Delivery ID(s): %s', implode(",", $deliveryIds)))
                            ->save();
                }

                if (!empty($sqlDeliveryWarehouseNew)) {
                    $writeConnection->insertMultiple($installer->getTableName('erp_inventory_delivery_warehouse'), $sqlDeliveryWarehouseNew);
                }

                if (!empty($sqlUpdateSystemProduct)) {
                    $writeConnection->query($sqlUpdateSystemProduct);
                }
                if (!empty($sqlUpdateSystemProductStatus)) {
                    $writeConnection->query($sqlUpdateSystemProductStatus);
                }

                if (!empty($sqlUpdateWarehouseProduct)) {
                    $writeConnection->query($sqlUpdateWarehouseProduct);
                }

                if ($addnewProduct && !empty($warehouseInsertProduct)) {
                    $writeConnection->insertMultiple($installer->getTableName('inventoryplus/warehouse_product'), $warehouseInsertProduct);
                }

                if ($totalProductDelivery == 0) {
                    Mage::getSingleton('adminhtml/session')->addError(
                            Mage::helper('inventorypurchasing')->__('Please select product and enter qty delivery for product to create delivery')
                    );

                    $this->_redirect('inventorypurchasingadmin/adminhtml_purchaseorders/edit', array('id' => $this->getRequest()->getParam('purchaseorder_id'), 'active' => 'delivery'));
                    return;
                }




                if (count($receivingData) && Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse')) {

                    foreach ($receivingData as $rData => $rCode) {

                        //auto create transaction

                        $transaction = Mage::getModel('inventorywarehouse/transaction');
                        $transaction->setType('3')
                                ->setWarehouseIdFrom($purchaseOrder->getSupplierId())
                                ->setWarehouseNameFrom($purchaseOrder->getSupplierName())
                                ->setWarehouseIdTo($rData)
                                ->setWarehouseNameTo(Mage::getModel('inventoryplus/warehouse')->load($rData)->getWarehouseName())
                                ->setCreatedAt(now())
                                ->setCreatedBy($admin)
                                ->setReason(Mage::helper('inventorypurchasing')->__('Receive from purchase order #%s', $purchaseOrderId))
                                ->save();
                        //transaction products
                        $totalProductTransaction = 0;
                        $sqlTransactionNew = array();
                        foreach ($rCode as $rPId => $rPQty) {
                            $product = Mage::getModel('catalog/product')->load($rPId);
                            $totalProductTransaction += $rPQty;
                            $sqlTransactionNew[] = array(
                                'warehouse_transaction_id' => $transaction->getId(),
                                'product_id' => $rPId,
                                'product_sku' => $product->getSku(),
                                'product_name' => $product->getName(),
                                'qty' => $rPQty
                            );
                            if (count($sqlTransactionNew) == 1000) {
                                $writeConnection->insertMultiple($installer->getTableName('inventorywarehouse/transaction_product'), $sqlTransactionNew);
                                $sqlTransactionNew = array();
                            }
                        }
                        if (!empty($sqlTransactionNew)) {
                            $writeConnection->insertMultiple($installer->getTableName('inventorywarehouse/transaction_product'), $sqlTransactionNew);
                        }
                        $transaction->setTotalProducts($totalProductTransaction)->save();
                    }
                }

                $totalProductOrder = 0;
                $totalProductReceived = 0;
                $purchaseOrderProducts = Mage::getModel('inventorypurchasing/purchaseorder_product')->getCollection()
                        ->addFieldToFilter('purchase_order_id', $purchaseOrderId);
                $purchaseOrder->setStatus(6);

                foreach ($purchaseOrderProducts as $purchaseOrderProduct) {
                    if ($purchaseOrderProduct->getQtyRecieved() < $purchaseOrderProduct->getQty()) {
                        $purchaseOrder->setStatus(5);
                    }
                    $totalProductOrder += $purchaseOrderProduct->getQty();
                    $totalProductReceived += $purchaseOrderProduct->getQtyRecieved();
                }
                $process = round(($totalProductReceived / $totalProductOrder) * 100, 2);

                $purchaseOrder->setDeliveryProcess($process)->save();

                $totalProduct_Recieved = $purchaseOrder->getData('total_products_recieved') + $totalProductDelivery;
                $purchaseOrder->setTotalProductsRecieved($totalProduct_Recieved);
                $purchaseOrder->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('inventorypurchasing')->__('All deliveries have been saved. The purchase order has been completed.')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('inventorypurchasingadmin/adminhtml_purchaseorders/edit', array('id' => $this->getRequest()->getParam('purchaseorder_id'), 'active' => 'delivery'));
                return;
            }

            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventorypurchasing')->__('Unable to find delivery to save!')
            );
            $this->_redirect('inventorypurchasingadmin/adminhtml_purchaseorders/edit', array('id' => $this->getRequest()->getParam('purchaseorder_id'), 'active' => 'delivery'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventorypurchasing')->__('Unable to find delivery to save!')
            );
            $this->_redirect('inventorypurchasingadmin/adminhtml_purchaseorders/edit', array('id' => $this->getRequest()->getParam('purchaseorder_id'), 'active' => 'delivery'));
            return;
        }
    }

    public function saveReturnOrderAction() {
        $purchaseOrderId = $this->getRequest()->getParam('purchaseorder_id');
        if (!$purchaseOrderId) {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventorypurchasing')->__('Unable to find return order to save!')
            );
            $this->_redirect('*/*/');
        }

        try {
            if ($data = $this->getRequest()->getPost()) {

                $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
                if (isset($data['returnorder_products'])) {
                    $returnorderProducts = array();
                    parse_str(urldecode($data['returnorder_products']), $returnorderProducts);
                    if (count($returnorderProducts)) {
                        $productIds = '';
                        $supplierId = Mage::helper('inventorypurchasing/purchaseorder')->getDataByPurchaseOrderId($purchaseOrderId, 'supplier_id');
                        $returnOrderModel = Mage::getModel('inventorypurchasing/purchaseorder_refund');
                        $returnOrderModel->setPurchaseOrderId($purchaseOrderId);
                        $returnOrderModel->setSupplierId($supplierId);
                        $returnOrderModel->setReturnedOn($data['return_date']);
						$returnOrderModel->setReason($data['reason']);
                        $returnOrderModel->save();
                        $newReturnOrderId = $returnOrderModel->getId();

                        $supplier = Mage::getModel('inventorypurchasing/supplier')->load($supplierId);
                        $resource = Mage::getSingleton('core/resource');
                        $writeConnection = $resource->getConnection('core_write');
                        $readConnection = $resource->getConnection('core_read');
                        $installer = Mage::getModel('core/resource');
                        $sqlReturnWarehouseNew = array();
                        $issuingData = array();
                        $totalProductReturns = 0;
                        $totalAmountReturned = 0;
                        $returnOrderIds = array();
                        $changeHistory = 0;
                        $returnOrderWarehouseIds = '';
                        $i = 0;
                        $returnWarehouseProducts = array();
                        $products = array();

                        $countUpdateWarehouseProduct = 0;
                        $sqlUpdateWarehouseProduct = '';
                        $sqlUpdateSystemProduct = '';
                        $sqlUpdateSystemProductStatus = '';
                        $countUpdateSystemProduct = 0;
                        $totalProductReturns = 0;

                        foreach ($returnorderProducts as $pId => $enCoded) {

                            $codeArr = array();
                            parse_str(base64_decode($enCoded), $codeArr);

                            $purchaseorderProductItem = Mage::getModel('inventorypurchasing/purchaseorder_product')
                                    ->getCollection()
                                    ->addFieldToFilter('purchase_order_id', $purchaseOrderId)
                                    ->addFieldToFilter('product_id', $pId)
                                    ->getFirstItem();

                            if ($purchaseorderProductItem->getId()) {
                                $codeArr['qty_return'] = 0;
                                $totalForAProduct = 0;
                                                                

                                foreach ($codeArr as $codeId => $code) {
                                    if ($codeId != 'qty_return') {
                                        $codeId = explode('_', $codeId);                                       
                                        if ($codeId[1]) {
                                            $sql = 'SELECT qty_received,qty_returned from ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' . $purchaseOrderId . ') 
                                                                            AND (product_id = ' . $pId . ') AND (warehouse_id = ' . $codeId[1] . ')';
                                            $results = $readConnection->fetchAll($sql);
                                            $maxQtyReturn = 0;
                                            if (count($results)) {
                                                foreach ($results as $result) {
                                                    $maxQtyReturn = $result['qty_received'] - $result['qty_returned'];
                                                }
                                            }
                                            if (!$code)
                                                $code = 0;
                                            if ($code > $maxQtyReturn) {
                                                $code = $maxQtyReturn;
                                            }
                                            $warehouseProduct = Mage::getModel('inventoryplus/warehouse_product')
                                                    ->getCollection()
                                                    ->addFieldToFilter('warehouse_id', $codeId[1])
                                                    ->addFieldToFilter('product_id', $pId)
                                                    ->getFirstItem();
                                            if ($warehouseProduct->getId() && $code > $warehouseProduct->getTotalQty()) {
                                                $code = $warehouseProduct->getTotalQty();
                                            }                                                          
                                            if (floatval($code) > 0) {

                                                $products[$pId] = $code . ',' . $purchaseorderProductItem->getProductSku() . ',' . $purchaseorderProductItem->getProductName();
                                                $returnWarehouseProducts[$codeId[1]] = $products;
                                                $changeHistory = 1;
                                                $totalProductReturns += $code;
                                                $totalForAProduct += $code;
                                                $issuingData[$codeId[1]][$pId] = $code;
                                                $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                                                $returnNewData = array(
                                                    'returned_on' => $data['return_date'],
                                                    'purchase_order_id' => $purchaseOrderId,
                                                    'product_id' => $pId,
                                                    'product_sku' => $purchaseorderProductItem->getProductSku(),
                                                    'product_name' => $purchaseorderProductItem->getProductName(),
                                                    'warehouse_id' => $codeId[1],
                                                    'warehouse_name' => Mage::getModel('inventoryplus/warehouse')->load($codeId[1])->getWarehouseName(),
                                                    'qty_return' => $code,
                                                    'created_by' => $admin,
                                                    'reason' => $data['reason']
                                                );
                                                $warehouseId = $codeId[1];


                                                //minus product on warehouse product
                                                try {
                                                    if ($warehouseProduct->getId()) {
                                                        $qty = $warehouseProduct->getTotalQty() - $code;
                                                        $newQtyAvailable = $warehouseProduct->getAvailableQty() - $code;

                                                        $sqlUpdateWarehouseProduct .= 'UPDATE ' . $installer->getTableName('inventoryplus/warehouse_product') . '  SET `total_qty` = ' . $qty . ', `available_qty` = ' . $newQtyAvailable . ', updated_at = now() WHERE `warehouse_product_id` = ' . $warehouseProduct->getId() . ';';
                                                    }
                                                } catch (Exception $e) {
                                                    
                                                }

                                                $countUpdateWarehouseProduct++;


                                                if ($countUpdateWarehouseProduct == 900) {
                                                    $writeConnection->query($sqlUpdateWarehouseProduct);
                                                    $sqlUpdateWarehouseProduct = '';
                                                    $countUpdateWarehouseProduct = 0;
                                                }

                                                //minus product on system
                                                $sql = 'SELECT qty FROM ' . $installer->getTableName("cataloginventory_stock_item") . ' WHERE (product_id = ' . $pId . ');';
                                                $result = $readConnection->fetchRow($sql);
                                                if ($result['qty'] - $code > 0) {
                                                    $stockStatus = 1;
                                                } else {
                                                    $stockStatus = 0;
                                                }



                                                $sqlUpdateSystemProduct .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_item") . ' SET qty = qty - ' . $code . ', is_in_stock = ' . $stockStatus . ' WHERE (product_id = ' . $pId . ');';


                                                $sqlUpdateSystemProductStatus .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_status") . ' SET qty = qty - ' . $code . ', stock_status = ' . $stockStatus . ' WHERE (product_id = ' . $pId . ');';
                                                if ($countUpdateSystemProduct == 900) {
                                                    $writeConnection->query($sqlUpdateSystemProduct);
                                                    $writeConnection->query($sqlUpdateSystemProductStatus);
                                                    $countUpdateSystemProduct = 0;
                                                    $sqlUpdateSystemProduct = '';
                                                    $sqlUpdateSystemProductStatus = '';
                                                }
                                                $countUpdateSystemProduct++;




                                                $sqlWarehouseProductReturned = 'UPDATE ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' SET qty_returned = qty_returned + ' . $code . ' 
                                                                            WHERE (product_id = ' . $pId . ') AND (purchase_order_id = ' . $purchaseOrderId . ') AND (warehouse_id = ' . $codeId[1] . ')';
                                                $writeConnection->query($sqlWarehouseProductReturned);

                                                $pSku = $purchaseorderProductItem->getProductSku();
                                                $amountMoved = ($purchaseorderProductItem->getCost()) * (100 + $purchaseorderProductItem->getTax() - $purchaseorderProductItem->getDiscount()) / 100;

                                                try {
                                                    $returnOrderWarehouse = Mage::getModel('inventorypurchasing/purchaseorder_returnproductwarehouse');
                                                    $returnOrderWarehouse->setData($returnNewData)->save();
                                                    if ($i > 0)
                                                        $returnOrderWarehouseIds .= ', ';
                                                    $returnOrderWarehouseIds .= $returnOrderWarehouse->getId();
                                                    $i++;
                                                } catch (Exception $e) {
                                                    
                                                }
                                            }
                                        }
                                    }
                                }

                                $purchaseorderProductItem->setQtyReturned($purchaseorderProductItem->getQtyReturned() + $totalForAProduct)
                                        ->save();
                                $returnOrderProduct = Mage::getModel('inventorypurchasing/purchaseorder_refund_product');
                                $returnOrderProduct->setReturnedOrderId($newReturnOrderId)
                                        ->setQtyReturn($totalForAProduct)
                                        ->setProductId($pId)
                                        ->setProductName($purchaseorderProductItem->getProductName())
                                        ->setProductSku($purchaseorderProductItem->getProductSku())
                                        ->save();
                            }
                            $productPrice = $totalForAProduct * $purchaseorderProductItem->getCost() * (100 - $purchaseorderProductItem->getDiscount() + $purchaseorderProductItem->getTax()) / 100;
                            $totalAmountReturned += $productPrice;
                        }

                        if (!empty($sqlUpdateWarehouseProduct)) {
                            $writeConnection->query($sqlUpdateWarehouseProduct);
                        }

                        if (!empty($sqlUpdateSystemProduct)) {
                            $writeConnection->query($sqlUpdateSystemProduct);
                        }

                        if (!empty($sqlUpdateSystemProductStatus)) {
                            $writeConnection->query($sqlUpdateSystemProductStatus);
                        }


                        //create transaction
                        if ($returnWarehouseProducts) {
                            foreach ($returnWarehouseProducts as $warehouseId => $products) {
                                $warehouse = Mage::getModel('inventoryplus/warehouse')->load($warehouseId);
                                $transactionData['type'] = 4;
                                $transactionData['warehouse_id_from'] = $warehouseId;
                                $transactionData['warehouse_name_from'] = $warehouse->getWarehouseName();
                                $transactionData['warehouse_id_to'] = $supplierId;
                                $transactionData['warehouse_name_to'] = $supplier->getSupplierName();
                                $transactionData['created_at'] = $returnOrderModel->getReturnedOn();
                                $transactionData['created_by'] = $purchaseOrder->getCreatedBy();
                                $transactionData['reason'] = $returnOrderModel->getReason();
                                $transactionDataModel = Mage::getModel('inventorywarehouse/transaction')->setData($transactionData)
                                        ->save();
                                $totalProduct = 0;
                                foreach ($products as $productId => $information) {
                                    $pInfo = explode(',', $information);
                                    Mage::getModel('inventorywarehouse/transaction_product')
                                            ->setWarehouseTransactionId($transactionDataModel->getId())
                                            ->setProductId($productId)
                                            ->setProductSku($pInfo[1])
                                            ->setProductName($pInfo[2])
                                            ->setQty($pInfo[0])
                                            ->save();
                                    $totalProduct += $pInfo[0];
                                }
                                $transactionDataModel->setTotalProducts($totalProduct)->save();
                            }
                        }
                        //history change
                        if ($totalProductReturns == 0) {
                            Mage::getSingleton('adminhtml/session')->addError(
                                    Mage::helper('inventorypurchasing')->__('Please select product and enter Qty greater than 0 to create return order!')
                            );
                            $returnOrderProduct->delete();
                            $returnOrderModel->delete();
                            $this->_redirect('*/*/newreturnorder', array(
                                'purchaseorder_id' => $purchaseOrderId,
                                'action' => 'newreturnorder',
                                'active' => 'return'
                            ));
                            return;
                        }

                        if ($changeHistory == '1') {
                            $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                            $purchaseOrderHistory = Mage::getModel('inventorypurchasing/purchaseorder_history');
                            $purchaseOrderHistoryContent = Mage::getModel('inventorypurchasing/purchaseorder_historycontent');
                            $purchaseOrderHistory->setData('purchase_order_id', $purchaseOrderId)
                                    ->setData('time_stamp', now())
                                    ->setData('created_by', $admin)
                                    ->save();
                            $purchaseOrderHistoryContent->setData('purchase_order_history_id', $purchaseOrderHistory->getId())
                                    ->setData('field_name', Mage::helper('inventorypurchasing')->__('%s returned product(s) from this purchase order.', $admin))
                                    ->setData('new_value', Mage::helper('inventorypurchasing')->__('Return ID(s): %s', $returnOrderWarehouseIds))
                                    ->save();
                        }
                        
                        Mage::getModel('admin/session')->unsetData('returnorder_create_at');
                        Mage::getModel('admin/session')->unsetData('returnorder_reason');

                    } else {
                        Mage::getSingleton('adminhtml/session')->addError(
                                Mage::helper('inventorypurchasing')->__('Please select product to create return order')
                        );

                        $this->_redirect('*/*/newreturnorder', array(
                            'purchaseorder_id' => $purchaseOrderId,
                            'action' => 'newreturnorder',
                            'active' => 'return'
                        ));
                        return;
                    }
                } else {
                    Mage::getSingleton('adminhtml/session')->addError(
                            Mage::helper('inventorypurchasing')->__('Please select product to create return order')
                    );

                    $this->_redirect('*/*/newreturnorder', array(
                        'purchaseorder_id' => $purchaseOrderId,
                        'action' => 'newreturnorder',
                        'active' => 'return'
                    ));
                    return;
                }



                $returnOrderModel->setTotalProducts($totalProductReturns);
                $returnOrderModel->setTotalAmount($totalAmountReturned);
                $returnOrderModel->save();


                $totalProductRecieved = $purchaseOrder->getData('total_products_recieved') - $totalProductReturns;
                $totalProductRefund = $purchaseOrder->getData('total_product_refunded') + $totalProductReturns;
                if ($totalProductRecieved >= 0) {
                    $purchaseOrder->setTotalProductsRecieved($totalProductRecieved);
                    $purchaseOrder->setTotalProductRefunded($totalProductRefund);
                    $purchaseOrder->save();
                }

                if ($purchaseOrder->getTotalProducts() == $purchaseOrder->getTotalProductRefunded())
                    if ($purchaseOrder->getTotalProductsRecieved() == 0) {
                        $purchaseOrder->setStatus(7);
                        $purchaseOrder->save();
                    }



                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('inventorypurchasingadmin/adminhtml_purchaseorders/edit', array('id' => $this->getRequest()->getParam('purchaseorder_id'), 'active' => 'return'));
                return;
            }
        } catch (Exception $e) {

            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/');
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventorypurchasing')->__('Unable to find return order to save!')
        );
        $this->_redirect('*/*/');
    }

    public function returnOrderAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.purchaseorder.edit.tab.returnorder');
        $this->renderLayout();
    }

    public function returnOrderGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.purchaseorder.edit.tab.returnorder');
        $this->renderLayout();
    }

    public function newReturnOrderAction() {
        $this->_title($this->__('Inventory'))
                ->_title($this->__('Add New Return Order'));
        $purchaseOrderId = $this->getRequest()->getParam('purchaseorder_id');
        $model = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);

        if ($model->getId() || $purchaseOrderId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('purchaseorder_data', $model);

            $this->loadLayout()->_setActiveMenu('inventoryplus');
            $this->_setActiveMenu('inventoryplus');

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('inventorypurchasing/adminhtml_purchaseorder_returnorder'))
                    ->_addLeft($this->getLayout()->createBlock('inventorypurchasing/adminhtml_purchaseorder_returnorder_tabs'));

            $this->renderLayout();
            if (Mage::getModel('admin/session')->getData('returnorder_product_import')) {
                Mage::getModel('admin/session')->setData('returnorder_product_import', null);
            }
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventorypurchasing')->__('Item does not exist')
            );
            $this->_redirect('*/*/');
        }
    }

    public function prepareNewReturnOrderAction() {
        $this->_title($this->__('Inventory'))
                ->_title($this->__('Add New Return Order'));
        $this->loadLayout()->_setActiveMenu('inventoryplus');
        $this->getLayout()->getBlock('inventorypurchasing.purchaseorder.edit.tab.preparenewreturnorder')
                ->setProducts($this->getRequest()->getPost('isproducts', null));
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $installer = Mage::getModel('core/resource');
        $sql = 'SELECT distinct(`warehouse_id`) from ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' . $this->getRequest()->getParam("purchaseorder_id") . ')';
        $results = $readConnection->fetchAll($sql);
        $availableWarehouses = $this->getWarehouseAvailable();
        foreach ($results as $result) {
            if (in_array($result['warehouse_id'], $availableWarehouses)) {
                $this->getLayout()->getBlock('related_grid_serializer')->addColumnInputName('warehouse_' . $result['warehouse_id']);
            }
        }
        $this->renderLayout();
        if (Mage::getModel('admin/session')->getData('returnorder_product_import')) {
            Mage::getModel('admin/session')->setData('returnorder_product_import', null);
        }
    }

    public function prepareNewReturnOrderGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.purchaseorder.edit.tab.preparenewreturnorder')
                ->setProducts($this->getRequest()->getPost('isproducts', null));
        $this->renderLayout();
    }

    public function cancelOrderAction() {
        $purchaseOrderId = $this->getRequest()->getParam('id');
        $deliveryModel = Mage::getModel('inventorypurchasing/purchaseorder_delivery')->getCollection()->addFieldToFilter('purchase_order_id', $purchaseOrderId);
        if (!$deliveryModel->getFirstItem()->getData()) {
            $purchaseOrderModel = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
            $purchaseOrderModel->setStatus(7);
            $purchaseOrderModel->save();
            //save history
            $admin = Mage::getModel('admin/session')->getUser()->getUsername();
            $purchaseOrderHistory = Mage::getModel('inventorypurchasing/purchaseorder_history');
            $purchaseOrderHistoryContent = Mage::getModel('inventorypurchasing/purchaseorder_historycontent');
            $purchaseOrderHistory->setData('purchase_order_id', $purchaseOrderId)
                    ->setData('time_stamp', now())
                    ->setData('created_by', $admin)
                    ->save();
            $purchaseOrderHistoryContent->setData('purchase_order_history_id', $purchaseOrderHistory->getId())
                    ->setData('field_name', Mage::helper('inventorypurchasing')->__('%s canceled this purchase order.', $admin))
                    ->save();
            Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('inventorypurchasing')->__('Purchase Order was successfully canceled.')
            );
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventorypurchasing')->__('Unable to cancel order because it has been on delivery!')
            );
        }
        $this->_redirect('*/*/');
    }

    public function viewDetailDeliveryAction() {
        
    }

    public function viewDetailReturnOrderAction() {
        
    }

    public function returnallorderAction() {
        $purchaseOrderId = $this->getRequest()->getParam('purchaseorder_id');
        if (!$purchaseOrderId) {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventorypurchasing')->__('Unable to find return order to save!')
            );
            $this->_redirect('*/*/');
        }
        try {


            $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
            $purchaseorderProducts = Mage::getModel('inventorypurchasing/purchaseorder_productwarehouse')->getCollection()
                    ->addFieldToFilter('purchase_order_id', $purchaseOrderId)
                    ->addFieldToFilter('qty_received', array('gt' => 0));

            if ($purchaseorderProducts->getSize()) {
                $productIds = '';
                $supplierId = Mage::helper('inventorypurchasing/purchaseorder')->getDataByPurchaseOrderId($purchaseOrderId, 'supplier_id');
                $returnOrderModel = Mage::getModel('inventorypurchasing/purchaseorder_refund');
                $returnOrderModel->setPurchaseOrderId($purchaseOrderId);
                $returnOrderModel->setSupplierId($supplierId);
                $returnOrderModel->setReturnedOn(date("Y-m-d"));
				$returnOrderModel->setReason(Mage::helper('inventorypurchasing')->__('Return products from purchase order #%s', $purchaseOrderId));
                $returnOrderModel->save();
                $newReturnOrderId = $returnOrderModel->getId();

                $supplier = Mage::getModel('inventorypurchasing/supplier')->load($supplierId);
                $resource = Mage::getSingleton('core/resource');
                $writeConnection = $resource->getConnection('core_write');
                $readConnection = $resource->getConnection('core_read');
                $installer = Mage::getModel('core/resource');
                $sqlReturnWarehouseNew = array();
                $issuingData = array();
                $totalProductReturns = 0;
                $totalAmountReturned = 0;
                $returnOrderIds = array();
                $changeHistory = 0;
                $returnOrderWarehouseIds = '';
                $i = 0;
                $returnWarehouseProducts = array();
                $products = array();

                $countUpdateWarehouseProduct = 0;
                $sqlUpdateWarehouseProduct = '';
                $sqlUpdateSystemProduct = '';
                $sqlUpdateSystemProductStatus = '';
                $countUpdateSystemProduct = 0;
                $totalProductReturns = 0;


                foreach ($purchaseorderProducts as $purchaseorderProduct) {

                    if ($purchaseorderProduct->getQtyReceived() - $purchaseorderProduct->getQtyReturned() <= 0) {
                        continue;
                    }
                    $totalForAProduct = 0;
                    $purchaseorderProductItem = Mage::getModel('inventorypurchasing/purchaseorder_product')
                            ->getCollection()
                            ->addFieldToFilter('purchase_order_id', $purchaseOrderId)
                            ->addFieldToFilter('product_id', $purchaseorderProduct->getProductId())
                            ->getFirstItem();




                    $sql = 'SELECT qty_received,qty_returned from ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' . $purchaseOrderId . ') 
                                                                            AND (product_id = ' . $purchaseorderProduct->getProductId() . ') AND (warehouse_id = ' . $purchaseorderProduct->getWarehouseId() . ')';
                    $results = $readConnection->fetchAll($sql);
                    $maxQtyReturn = 0;
                    if (count($results)) {
                        foreach ($results as $result) {
                            $maxQtyReturn = $result['qty_received'] - $result['qty_returned'];
                        }
                    }
                    $warehouseProduct = Mage::getModel('inventoryplus/warehouse_product')
                            ->getCollection()
                            ->addFieldToFilter('warehouse_id', $purchaseorderProduct->getWarehouseId())
                            ->addFieldToFilter('product_id', $purchaseorderProduct->getProductId())
                            ->getFirstItem();
                    if ($warehouseProduct->getId()) {
                        if ($maxQtyReturn > $warehouseProduct->getTotalQty()) {
                            $maxQtyReturn = $warehouseProduct->getTotalQty();
                        }
                    }


                    $products[$purchaseorderProduct->getProductId()] = $maxQtyReturn . ',' . $purchaseorderProduct->getProductSku() . ',' . $purchaseorderProduct->getProductName();
                    $returnWarehouseProducts[$purchaseorderProduct->getWarehouseId()] = $products;
                    $changeHistory = 1;
                    $totalProductReturns += $maxQtyReturn;
                    $totalForAProduct += $maxQtyReturn;

                    $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                    $returnNewData = array(
                        'returned_on' => now(),
                        'purchase_order_id' => $purchaseOrderId,
                        'product_id' => $purchaseorderProduct->getProductId(),
                        'product_sku' => $purchaseorderProduct->getProductSku(),
                        'product_name' => $purchaseorderProduct->getProductName(),
                        'warehouse_id' => $purchaseorderProduct->getWarehouseId(),
                        'warehouse_name' => $purchaseorderProduct->getWarehouseName(),
                        'qty_return' => $maxQtyReturn,
                        'created_by' => $admin,
                        'reason' => ''
                    );
                    $warehouseId = $purchaseorderProduct->getWarehouseId();


                    //minus product on warehouse product
                    try {
                        $qty = $warehouseProduct->getTotalQty() - $maxQtyReturn;
                        $newQtyAvailable = $warehouseProduct->getAvailableQty() - $maxQtyReturn;

                        $sqlUpdateWarehouseProduct .= 'UPDATE ' . $installer->getTableName('inventoryplus/warehouse_product') . '  SET `total_qty` = ' . $qty . ', `available_qty` = ' . $newQtyAvailable . ' WHERE `warehouse_product_id` = ' . $warehouseProduct->getId() . ';';
                    } catch (Exception $e) {
                        
                    }

                    $countUpdateWarehouseProduct++;


                    if ($countUpdateWarehouseProduct == 900) {
                        $writeConnection->query($sqlUpdateWarehouseProduct);
                        $sqlUpdateWarehouseProduct = '';
                        $countUpdateWarehouseProduct = 0;
                    }

                    //minus product on system
                    $sql = 'SELECT qty FROM ' . $installer->getTableName("cataloginventory_stock_item") . ' WHERE (product_id = ' . $purchaseorderProduct->getProductId() . ');';
                    $result = $readConnection->fetchRow($sql);
                    if ($result['qty'] - $maxQtyReturn > 0) {
                        $stockStatus = 1;
                    } else {
                        $stockStatus = 0;
                    }



                    $sqlUpdateSystemProduct .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_item") . ' SET qty = qty - ' . $maxQtyReturn . ', is_in_stock = ' . $stockStatus . ' WHERE (product_id = ' . $purchaseorderProduct->getProductId() . ');';


                    $sqlUpdateSystemProductStatus .= 'UPDATE ' . $installer->getTableName("cataloginventory_stock_status") . ' SET qty = qty - ' . $maxQtyReturn . ', stock_status = ' . $stockStatus . ' WHERE (product_id = ' . $purchaseorderProduct->getProductId() . ');';
                    if ($countUpdateSystemProduct == 900) {
                        $writeConnection->query($sqlUpdateSystemProduct);
                        $writeConnection->query($sqlUpdateSystemProductStatus);
                        $countUpdateSystemProduct = 0;
                        $sqlUpdateSystemProduct = '';
                        $sqlUpdateSystemProductStatus = '';
                    }
                    $countUpdateSystemProduct++;




                    $sqlWarehouseProductReturned = 'UPDATE ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' SET qty_returned = qty_returned + ' . $maxQtyReturn . ' 
                                                                            WHERE (product_id = ' . $purchaseorderProduct->getProductId() . ') AND (purchase_order_id = ' . $purchaseOrderId . ') AND (warehouse_id = ' . $purchaseorderProduct->getWarehouseId() . ')';
                    $writeConnection->query($sqlWarehouseProductReturned);

                    $pSku = $purchaseorderProduct->getProductSku();
                    $amountMoved = ($purchaseorderProductItem->getCost()) * (100 + $purchaseorderProductItem->getTax() - $purchaseorderProductItem->getDiscount()) / 100;

                    try {
                        $returnOrderWarehouse = Mage::getModel('inventorypurchasing/purchaseorder_returnproductwarehouse');
                        $returnOrderWarehouse->setData($returnNewData)->save();
                        if ($i > 0)
                            $returnOrderWarehouseIds .= ', ';
                        $returnOrderWarehouseIds .= $returnOrderWarehouse->getId();
                        $i++;
                    } catch (Exception $e) {
                        
                    }





                    $purchaseorderProductItem->setQtyReturned($purchaseorderProductItem->getQtyReturned() + $totalForAProduct)
                            ->save();
                    $returnOrderProduct = Mage::getModel('inventorypurchasing/purchaseorder_refund_product');
                    $returnOrderProduct->setReturnedOrderId($newReturnOrderId)
                            ->setQtyReturn($totalForAProduct)
                            ->setProductId($purchaseorderProduct->getProductId())
                            ->setProductName($purchaseorderProductItem->getProductName())
                            ->setProductSku($purchaseorderProductItem->getProductSku())
                            ->save();
                    $productPrice = $totalForAProduct * $purchaseorderProductItem->getCost() * (100 - $purchaseorderProductItem->getDiscount() + $purchaseorderProductItem->getTax()) / 100;
                    $totalAmountReturned += $productPrice;
                }
                if (!empty($sqlUpdateWarehouseProduct)) {
                    $writeConnection->query($sqlUpdateWarehouseProduct);
                }

                if (!empty($sqlUpdateSystemProduct)) {
                    $writeConnection->query($sqlUpdateSystemProduct);
                }

                if (!empty($sqlUpdateSystemProductStatus)) {
                    $writeConnection->query($sqlUpdateSystemProductStatus);
                }


                //create transaction
                if ($returnWarehouseProducts) {
                    foreach ($returnWarehouseProducts as $warehouseId => $products) {
                        $warehouse = Mage::getModel('inventoryplus/warehouse')->load($warehouseId);
                        $transactionData['type'] = 4;
                        $transactionData['warehouse_id_from'] = $warehouseId;
                        $transactionData['warehouse_name_from'] = $warehouse->getWarehouseName();
                        $transactionData['warehouse_id_to'] = $supplierId;
                        $transactionData['warehouse_name_to'] = $supplier->getSupplierName();
                        $transactionData['created_at'] = $returnOrderModel->getReturnedOn();
                        $transactionData['created_by'] = $purchaseOrder->getCreatedBy();
						$transactionData['reason'] = $returnOrderModel->getReason();
                        $transactionDataModel = Mage::getModel('inventorywarehouse/transaction')->setData($transactionData)
                                ->save();
                        $totalProduct = 0;
                        foreach ($products as $productId => $information) {
                            $pInfo = explode(',', $information);
                            Mage::getModel('inventorywarehouse/transaction_product')
                                    ->setWarehouseTransactionId($transactionDataModel->getId())
                                    ->setProductId($productId)
                                    ->setProductSku($pInfo[1])
                                    ->setProductName($pInfo[2])
                                    ->setQty($pInfo[0])
                                    ->save();
                            $totalProduct += $pInfo[0];
                        }
                        $transactionDataModel->setTotalProducts($totalProduct)->save();
                    }
                }
                //history change
                if ($totalProductReturns == 0) {
                    Mage::getSingleton('adminhtml/session')->addError(
                            Mage::helper('inventorypurchasing')->__('Please select product and enter Qty greater than 0 to create return order!')
                    );
//                    $returnOrderProduct->delete();
                    $returnOrderModel->delete();
                    $this->_redirect('*/*/newreturnorder', array(
                        'purchaseorder_id' => $purchaseOrderId,
                        'action' => 'newreturnorder',
                        'active' => 'return'
                    ));
                    return;
                }

                if ($changeHistory == '1') {
                    $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                    $purchaseOrderHistory = Mage::getModel('inventorypurchasing/purchaseorder_history');
                    $purchaseOrderHistoryContent = Mage::getModel('inventorypurchasing/purchaseorder_historycontent');
                    $purchaseOrderHistory->setData('purchase_order_id', $purchaseOrderId)
                            ->setData('time_stamp', now())
                            ->setData('created_by', $admin)
                            ->save();
                    $purchaseOrderHistoryContent->setData('purchase_order_history_id', $purchaseOrderHistory->getId())
                            ->setData('field_name', Mage::helper('inventorypurchasing')->__('%s returned product(s) from this purchase order.', $admin))
                            ->setData('new_value', Mage::helper('inventorypurchasing')->__('Return ID(s): %s', $returnOrderWarehouseIds))
                            ->save();
                }


                $returnOrderModel->setTotalProducts($totalProductReturns);
                $returnOrderModel->setTotalAmount($totalAmountReturned);
                $returnOrderModel->save();


                $totalProductRecieved = $purchaseOrder->getData('total_products_recieved') - $totalProductReturns;
                $totalProductRefund = $purchaseOrder->getData('total_product_refunded') + $totalProductReturns;
                if ($totalProductRecieved >= 0) {
                    $purchaseOrder->setTotalProductsRecieved($totalProductRecieved);
                    $purchaseOrder->setTotalProductRefunded($totalProductRefund);
                    $purchaseOrder->save();
                }

                if ($purchaseOrder->getTotalProducts() == $purchaseOrder->getTotalProductRefunded())
                    if ($purchaseOrder->getTotalProductsRecieved() == 0) {
                        $purchaseOrder->setStatus(7);
                        $purchaseOrder->save();
                    }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('inventorypurchasing')->__('All returned products have been saved.')
                );


                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('inventorypurchasingadmin/adminhtml_purchaseorders/edit', array('id' => $this->getRequest()->getParam('purchaseorder_id'), 'active' => 'return'));

                return;
            } else {
                Mage::getSingleton('adminhtml/session')->addError(
                        Mage::helper('inventorypurchasing')->__('Unable to find return order to save!')
                );
                $this->_redirect('*/*/');
            }
        } catch (Exception $e) {

            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
//            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/');
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventorypurchasing')->__('Unable to find return order to save!')
        );
        $this->_redirect('*/*/');
    }

    public function importproductAction() {
        if (isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] != '') {
            try {
                $fileName = $_FILES['fileToUpload']['tmp_name'];
                $Object = new Varien_File_Csv();
                $dataFile = $Object->getData($fileName);
                $purchaseorderProduct = array();
                $purchaseorderProducts = array();
                $fields = array();
                $count = 0;
                $purchaseorderHelper = Mage::helper('inventorypurchasing/purchaseorder');
                if (count($dataFile))
                    foreach ($dataFile as $col => $row) {
                        if ($col == 0) {
                            if (count($row))
                                foreach ($row as $index => $cell)
                                    $fields[$index] = (string) $cell;
                        }elseif ($col > 0) {
                            if (count($row))
                                foreach ($row as $index => $cell) {
                                    if (isset($fields[$index])) {
                                        $purchaseorderProduct[$fields[$index]] = $cell;
                                    }
                                }
                            $purchaseorderProducts[] = $purchaseorderProduct;
                        }
                    }
                $purchaseorderHelper->importProduct($purchaseorderProducts);
            } catch (Exception $e) {
                
            }
        }
    }

    public function importproductforcreatedeliveryAction() {
        $getParams = $this->getRequest()->getParams();
        Mage::getModel('admin/session')->setData('delivery_create_at', null);
        if (isset($getParams['create_at'])) {
            Mage::getModel('admin/session')->setData('delivery_create_at', $getParams['create_at']);
        }
        $checkField = array(
            'SKU', 'COST', 'TAX', 'DISCOUNT', 'SUPPLIER_SKU'
        );
        $purchaseOrderId = $getParams['purchaseorder_id'];
        $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
        if (isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] != '') {
            try {
                $fileName = $_FILES['fileToUpload']['tmp_name'];
                $Object = new Varien_File_Csv();
                $dataFile = $Object->getData($fileName);
                $newDeliveryProduct = array();
                $newDeliveryProducts = array();
                $fields = array();
                $count = 0;
                $purchaseorderHelper = Mage::helper('inventorypurchasing/purchaseorder');
                if (count($dataFile))
                    foreach ($dataFile as $col => $row) {
                        if ($col == 0) {
                            if (count($row))
                                foreach ($row as $index => $cell)
                                    $fields[$index] = (string) $cell;
                        }elseif ($col > 0) {
                            if (count($row))
                                foreach ($row as $index => $cell) {
                                    if (isset($fields[$index])) {
                                        if (!in_array($fields[$index], $checkField)) {
                                            $warehouse = explode('_', $fields[$index]);
                                            if (!Mage::helper('inventoryplus')->getPermission($warehouse[1],'can_purchase_product')) {
                                                continue;
                                            }
                                        }
                                        $newDeliveryProduct[$fields[$index]] = $cell;
                                    }
                                }
                            $newDeliveryProducts[] = $newDeliveryProduct;
                        }
                    }//end foreach  

                $purchaseorderHelper->importDeliveryProduct($newDeliveryProducts);
            } catch (Exception $e) {
                
            }
        }
    }

    public function importproductforreturnorderAction() {
        $getParams = $this->getRequest()->getParams();
        Mage::getModel('admin/session')->setData('returnorder_create_at', null);
        Mage::getModel('admin/session')->setData('returnorder_reason', null);
        if (isset($getParams['create_at'])) {
            Mage::getModel('admin/session')->setData('returnorder_create_at', $getParams['create_at']);
        }
        if (isset($getParams['reason'])) {
            Mage::getModel('admin/session')->setData('returnorder_reason', $getParams['reason']);
        }

        $checkField = array(
            'SKU', 'COST', 'TAX', 'DISCOUNT', 'SUPPLIER_SKU'
        );        
        $purchaseOrderId = $getParams['purchaseorder_id'];
        $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
        if (isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] != '') {
            try {
                $fileName = $_FILES['fileToUpload']['tmp_name'];
                $Object = new Varien_File_Csv();
                $dataFile = $Object->getData($fileName);
                $newReturnOrderProduct = array();
                $newReturnOrderProducts = array();
                $fields = array();
                $count = 0;
                $purchaseorderHelper = Mage::helper('inventorypurchasing/purchaseorder');
                if (count($dataFile))
                    foreach ($dataFile as $col => $row) {
                        if ($col == 0) {
                            if (count($row))
                                foreach ($row as $index => $cell)
                                    $fields[$index] = (string) $cell;
                        }elseif ($col > 0) {
                            if (count($row))
                                foreach ($row as $index => $cell) {
                                    if (isset($fields[$index])) {
                                        if (!in_array($fields[$index], $checkField)) {
                                            $warehouse = explode('_', $fields[$index]);
                                            if (!Mage::helper('inventoryplus')->getPermission($warehouse[1],'can_purchase_product')) {
                                                continue;
                                            }
                                        }
                                        
                                        $newReturnOrderProduct[$fields[$index]] = $cell;
                                    }
                                }
                            $newReturnOrderProducts[] = $newReturnOrderProduct;
                        }
                    }//end foreach
                $purchaseorderHelper->importReturnOrderProduct($newReturnOrderProducts);
            } catch (Exception $e) {
                
            }
        }
    }

    public function exportPostAction($data) {
        $headers = new Varien_Object(array(
            'ID' => Mage::helper('inventorypurchasing')->__('ID'),
            'Name' => Mage::helper('inventorypurchasing')->__('Name'),
            'SKU' => Mage::helper('inventorypurchasing')->__('SKU'),
            'Cost' => Mage::helper('inventorypurchasing')->__('Cost'),
            'Price' => Mage::helper('inventorypurchasing')->__('Price'),
            'Warehouse' => Mage::helper('inventorypurchasing')->__('Warehouse'),
            'Supplyneeds' => Mage::helper('inventorypurchasing')->__('Supplyneeds'),
            'Supplier' => Mage::helper('inventorypurchasing')->__('Supplier')
        ));
        $template = '"{{ID}}","{{Name}}","{{SKU}}","{{Cost}}","{{Price}}","{{Supplyneeds}}","{{Warehouse}}","{{Supplier}}"';
        $content = $headers->toString($template);
        if (($data['product_list'])) {
            $info = array();
            $list = explode(';', $data['product_list']);
            $arr = Mage::helper('inventoryplus/supplyneeds')->filterList($list);
            foreach ($arr as $productId => $qty) {
                $product = Mage::getModel('catalog/product')->getCollection()
                        ->addFieldToFilter('entity_id', $productId)
                        ->addAttributeToSelect('*')
                        ->getFirstItem();
                $warehouse = Mage::getModel('inventoryplus/warehouse')
                        ->getCollection()
                        ->addFieldToFilter('warehouse_id', $data['warehouse_select'])
                        ->getFirstItem()
                        ->getName();
                $supplier = Mage::getModel('inventorypurchasing/supplier')
                        ->getCollection()
                        ->addFieldToFilter('supplier_id', $data['supplier_select'])
                        ->getFirstItem()
                        ->getName();
                $cost = Mage::getModel('inventorypurchasing/supplier_product')
                        ->getCollection()
                        ->addFieldToFilter('product_id', $productId)
                        ->getFirstItem()
                        ->getCost();
                $info['ID'] = $productId;
                $info['Name'] = $product->getName();
                $info['SKU'] = $product->getSku();
                $info['Cost'] = $cost;
                $info['Price'] = $product->getPrice();
                $info['Supplyneeds'] = $qty;
                $info['Warehouse'] = $warehouse;
                $info['Supplier'] = $supplier;
                $csv_content = new Varien_Object($info);
                $content .= "\n";
                $content .= $csv_content->toString($template);
            }
        }
        $this->_prepareDownloadResponse('supplyneeds.csv', $content);
    }

    public function getFiledSaveHistory() {
        return array('purchase_on', 'bill_name', 'order_placed', 'start_date', 'cancel_date', 'expected_date', 'payment_date', 'ship_via', 'payment_term', 'comments', 'tax_rate', 'shipping_cost', 'delivery_process');
    }

    public function getTitleByField($field) {
        $fieldArray = array(
            'purchase_on' => Mage::helper('inventorypurchasing')->__('Order Created On'),
            'bill_name' => Mage::helper('inventorypurchasing')->__('Bill Name'),
            'order_placed' => Mage::helper('inventorypurchasing')->__('Order placed via'),
            'start_date' => Mage::helper('inventorypurchasing')->__('Start ship'),
            'cancel_date' => Mage::helper('inventorypurchasing')->__('Cancel'),
            'expected_date' => Mage::helper('inventorypurchasing')->__('Expected date'),
            'payment_date' => Mage::helper('inventorypurchasing')->__('Payment date'),
            'ship_via' => Mage::helper('inventorypurchasing')->__('Shipping via'),
            'payment_term' => Mage::helper('inventorypurchasing')->__('Payment terms'),
            'comments' => Mage::helper('inventorypurchasing')->__('Comment'),
            'tax_rate' => Mage::helper('inventorypurchasing')->__('Tax Rate'),
            'shipping_cost' => Mage::helper('inventorypurchasing')->__('Shipping Cost'),
            'delivery_process' => Mage::helper('inventorypurchasing')->__('Delivery Process')
        );
        if (!$fieldArray[$field])
            return $field;
        return $fieldArray[$field];
    }

    public function historyAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function historyGridAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function showhistoryAction() {
        $form_html = $this->getLayout()
                ->createBlock('inventorypurchasing/adminhtml_purchaseorder')
                ->setTemplate('inventorypurchasing/purchaseorder/showhistory.phtml')
                ->toHtml();
        $this->getResponse()->setBody($form_html);
    }

    public function checkproductAction() {        
        $purchaseorder_products = $this->getRequest()->getPost('products');
        $checkProduct = 0;
        $next = false;        
        if($purchaseorder_products == 'false'){            
            echo 1; 
            return;
        }
        if (isset($purchaseorder_products)) {
            $purchaseorderProducts = array();
            $purchaseorderProductsExplodes = explode('&', urldecode($purchaseorder_products));
            if (count($purchaseorderProductsExplodes) <= 900) {
                parse_str(urldecode($purchaseorder_products), $purchaseorderProducts);
            } else {
                foreach ($purchaseorderProductsExplodes as $purchaseorderProductsExplode) {
                    $purchaseorderProduct = '';
                    parse_str($purchaseorderProductsExplode, $purchaseorderProduct);
                    $purchaseorderProducts = $purchaseorderProducts + $purchaseorderProduct;
                }
            }
            if (count($purchaseorderProducts)) {
                foreach ($purchaseorderProducts as $pId => $enCoded) {
                    $codeArr = array();
                    parse_str(base64_decode($enCoded), $codeArr);
                    foreach ($codeArr as $codeId => $code) {
                        if (!in_array($codeId, array('qty_order', 'cost_product', 'tax', 'discount', 'supplier_sku'))) {
                            if ($codeId[1]) {
                                if (is_numeric($code) && $code > 0) {
                                    $checkProduct = 1;
                                    $next = true;
                                    break;
                                }
                            }
                        }
                    }
                    if ($next)
                        break;
                }
            }
        } 
        echo $checkProduct;
    }

    public function sendEmail($supplierId, $sqlNews, $purchaseOrderId) {
        $store = Mage::app()->getStore();
        $templateId = Mage::getStoreConfig('inventorypurchasing/email_supplier/template', $store->getId());
        if ($supplierId) {
            $supplierInfo = Mage::helper('inventorypurchasing/supplier')->getBillingAddressBySupplierId($supplierId);
        }
        if (!$supplierId) {
            $supplierInfo = Mage::helper('inventorypurchasing/purchaseorder')->getBilingAddressByPurchaseOrderId($purchaseOrderId);
        }
        $supplierCollection = Mage::getResourceModel('inventorypurchasing/supplier_collection')
                ->addFieldToFilter('supplier_id', $supplierId);
        $supplierdata = $supplierCollection->getFirstItem()->getData();
        $translate = Mage::getSingleton('core/translate');
        $translate->setTranslateInline(false);
        $transaction = Mage::getSingleton('core/email_template');


        $top_email = Mage::getStoreConfig('inventorypurchasing/email_supplier/top_email', $store->getId());
        $domainName = $_SERVER['HTTP_HOST'];

        $senderEmail = Mage::getStoreConfig('trans_email/ident_general/email', $store->getId());

        $senderName = Mage::getStoreConfig('trans_email/ident_general/name', $store->getId());

        $emailSubject = Mage::helper('inventorypurchasing')->__('Purchase Order #%s', $purchaseOrderId);

        $top_email = Mage::helper('inventorypurchasing')->__(
                '<p style="font-size:12px; line-height:16px; margin:0;"> We are from %s <br/> We want to purchase order some product from you. And below are our information and list product that we want to purchase.</p>', $domainName);
        $sender = array(
            'name' => $senderName,
            'email' => $senderEmail,
        );
        $items = '';
        $count = 0;
        foreach ($sqlNews as $item) {
            if ($count % 2 == 0)
                $items = $items . '<tbody bgcolor="#F6F6F6">';
            else
                $items = $items . '<tbody>';
            $items = $items . '<tr>
                                                                    <td align="left" valign="top" style="font-size:11px; padding:3px 9px; border-bottom:1px dotted #CCCCCC;">
                                                                            <strong style="font-size:11px;">' . $item["product_name"] . '</strong>
                                                                    </td>
                                                                    <td align="left" valign="top" style="font-size:11px; padding:3px 9px; border-bottom:1px dotted #CCCCCC;">' . $item["product_sku"] . '</td>
                                                                    <td align="left" valign="top" style="font-size:11px; padding:3px 9px; border-bottom:1px dotted #CCCCCC;">' . Mage::helper('core')->currency($item["cost"]) . '</td>
                                                                    <td align="left" valign="top" style="font-size:11px; padding:3px 9px; border-bottom:1px dotted #CCCCCC;">' . $item["tax"] . '</td>
                                                                    <td align="center" valign="top" style="font-size:11px; padding:3px 9px; border-bottom:1px dotted #CCCCCC;">' . $item["discount"] . '</td>
                                                                         <td align="center" valign="top" style="font-size:11px; padding:3px 9px; border-bottom:1px dotted #CCCCCC;">' . $item["supplier_sku"] . '</td>
                                                                    <td align="right" valign="top" style="font-size:11px; padding:3px 9px; border-bottom:1px dotted #CCCCCC;">
                                                                                                                                                            <span class="price">' . $item["qty"] . '</span>            
                                                                    </td>
                                                            </tr>
                                                    </tbody>';
            $count++;
        }
        $purchaseOrder = 'Our Purchase Order #' . $purchaseOrderId;
        $transaction->sendTransactional(
                $templateId, //Template config
                $sender, $supplierdata['supplier_email'], $supplierdata['supplier_name'], array(
//Infomation - variable in email template (we'll use then send email successfullly)
            'store' => $store,
            'top_email' => $top_email,
            'order_id' => $purchaseOrder,
            'billing' => $supplierInfo,
            'email_subject' => $emailSubject,
            'items' => $items,
            'purchaseorderid' => $purchaseOrderId,
            'sqlnews' => $sqlNews
                )
        );

        $admin = Mage::getModel('admin/session')->getUser()->getUsername();
        $purchaseOrderHistory = Mage::getModel('inventorypurchasing/purchaseorder_history');
        $purchaseOrderHistoryContent = Mage::getModel('inventorypurchasing/purchaseorder_historycontent');
        $purchaseOrderHistory->setData('purchase_order_id', $purchaseOrderId)
                ->setData('time_stamp', now())
                ->setData('created_by', $admin)
                ->save();
        $purchaseOrderHistoryContent->setData('purchase_order_history_id', $purchaseOrderHistory->getId())
                ->setData('field_name', Mage::helper('inventorypurchasing')->__('%s sent to %s.', $admin, $supplierdata['supplier_name']))
                ->save();
        Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('inventorypurchasing')->__('The purchase order email has been sent to the supplier.')
        );
    }

    public function resendemailtosupplierAction() {
        $purchaseOrderId = $this->getRequest()->getParam('id');
        $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
        $purchaseOrderProducts = Mage::getModel('inventorypurchasing/purchaseorder_product')->getCollection()
                ->addFieldToFilter('purchase_order_id', $purchaseOrderId);

        $sqlNews = $purchaseOrderProducts->getData();
        $this->sendEmail($purchaseOrder->getSupplierId(), $sqlNews, $purchaseOrderId);
        $purchaseOrder->setSendMail(1)->save();
        $this->_redirect('*/*/edit', array('id' => $purchaseOrderId));
    }

}
