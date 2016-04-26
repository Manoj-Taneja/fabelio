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
class Magestore_Inventoryplus_Adminhtml_WarehouseController extends Mage_Adminhtml_Controller_Action {

    /**
     * init layout and set active for current menu
     *
     * @return Magestore_Inventory_Adminhtml_InventoryController
     */
    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('inventoryplus')
                ->_addBreadcrumb(
                        Mage::helper('adminhtml')->__('Manage Warehouses'), Mage::helper('adminhtml')->__('Manage Warehouses')
        );
        return $this;
    }

    /**
     * index action
     */
    public function indexAction() {
        if (Mage::getModel('admin/session')->getData('warehouseaddmore_product_import'))
            Mage::getModel('admin/session')->setData('warehouseaddmore_product_import', null);
        if (Mage::getModel('admin/session')->getData('null_warehouseaddmore_product_import'))
            Mage::getModel('admin/session')->setData('null_warehouseaddmore_product_import', 0);

        $this->_title($this->__('Inventory'))
                ->_title($this->__('Manage Warehouses'));

        if (!Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse')) {
            $warehouse = Mage::getModel('inventoryplus/warehouse')->getCollection()
                    ->getFirstItem();
            if ($warehouse->getId()) {
                $this->_redirect('*/*/edit', array('id' => $warehouse->getId()));
                return;
            }
        }

        $this->_initAction()
                ->renderLayout();
    }

    /**
     * view and edit item action
     */
    public function editAction() {
        $this->_title($this->__('Inventory'))
                ->_title($this->__('Manage Warehouses'));

        $warehouseId = $this->getRequest()->getParam('id');
        $model = Mage::getModel('inventoryplus/warehouse')->load($warehouseId);

        if ($model->getId() || $warehouseId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('warehouse_data', $model);

            $this->loadLayout()->_setActiveMenu('inventoryplus');
            $this->_setActiveMenu('inventoryplus/warehouse');

            $this->_addBreadcrumb(
                    Mage::helper('adminhtml')->__('Manage Warehouses'), Mage::helper('adminhtml')->__('Manage Warehouses')
            );
            $this->_addBreadcrumb(
                    Mage::helper('adminhtml')->__('Warehouse'), Mage::helper('adminhtml')->__('Warehouse')
            );

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true)
                    ->removeItem('js', 'mage/adminhtml/grid.js')
                    ->addItem('js', 'magestore/adminhtml/inventory/grid.js');
            $this->_addContent($this->getLayout()->createBlock('inventoryplus/adminhtml_warehouse_edit'))
                    ->_addLeft($this->getLayout()->createBlock('inventoryplus/adminhtml_warehouse_edit_tabs'));
            Mage::dispatchEvent('warehouse_controller_index', array('warehouse_controler' => $this));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventoryplus')->__('Warehouse does not exist!')
            );
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    /**
     * save item action
     */
    public function saveAction() {
        $admin = Mage::getSingleton('admin/session')->getUser();
        if ($data = $this->getRequest()->getPost()) {

            if ($data['manager']) {
                $manager = $data['manager'];
                $managerEmail = Mage::getModel('admin/user')->loadByUsername($manager)->getEmail();
                $managerName = Mage::getModel('admin/user')->loadByUsername($manager)->getFirstname() . ' ' . Mage::getModel('admin/user')->loadByUsername($manager)->getLastname();
                $data['manager_email'] = $managerEmail;
                $data['manager_name'] = $managerName;
            }
            //remove root warehouse if this warehouse is root
            if ($data['is_root']) {
                $current_root = Mage::getModel('inventoryplus/warehouse')->getCollection()
                        ->addFieldToFilter('is_root', '1')
                        ->getFirstItem();
                try {
                    $current_root->setData('is_root', 0)->save();
                } catch (Exception $e) {
                    
                }
            }
            $model = Mage::getModel('inventoryplus/warehouse')->load($this->getRequest()->getParam('id'));
            //get current manager
            $oldManager = $model->getManager();

            $model->addData($data);

            //check field changed
            if ($this->getRequest()->getParam('id')) {
                $oldData = Mage::getModel('inventoryplus/warehouse')->load($this->getRequest()->getParam('id'));
                $changeArray = array();
                $changeData = 0;
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
                $model->setCreatedBy($admin->getUsername());
                $model->setCreatedAt(now());
            } else {
                if (!$model->getCreatedBy() || $model->getCreatedBy() == 'Automatically created') {
                    $model->setCreatedBy($admin->getUsername());
                }
            }
            try {
                $model->setUpdatedBy($admin->getUserName());
                $model->setUpdatedAt(now());
                $model->save();

                $resource = Mage::getSingleton('core/resource');
                $writeConnection = $resource->getConnection('core_write');
                $sqlNews = array();
                $sqlOlds = '';
                $countSqlOlds = 0;
                $productsHistory = array();
                $warehouseProductDeleteds = '';
                $changeProductQtys = array();

                //save products
                if (isset($data['warehouse_products'])) {
                    $warehouseProducts = array();
                    $warehouseProductsExplodes = explode('&', urldecode($data['warehouse_products']));
                    if (count($warehouseProductsExplodes) <= 900) {
                        parse_str(urldecode($data['warehouse_products']), $warehouseProducts);
                    } else {
                        foreach ($warehouseProductsExplodes as $warehouseProductsExplode) {
                            $warehouseProduct = '';
                            parse_str($warehouseProductsExplode, $warehouseProduct);
                            $warehouseProducts = $warehouseProducts + $warehouseProduct;
                        }
                    }

                    if (count($warehouseProducts)) {
                        $deletes = array_keys($warehouseProducts);
                        $warehouseProductDeleteds = Mage::helper('inventoryplus/warehouse')->deleteWarehouseProducts($model, $deletes);
                        $productIds = '';

                        foreach ($warehouseProducts as $pId => $enCoded) {

                            $codeArr = array();
                            parse_str(base64_decode($enCoded), $codeArr);

                            $warehouseProductsItem = Mage::getModel('inventoryplus/warehouse_product')
                                    ->getCollection()
                                    ->addFieldToFilter('warehouse_id', $model->getId())
                                    ->addFieldToFilter('product_id', $pId)
                                    ->getFirstItem();
                            if ($warehouseProductsItem->getId()) {
                                $countSqlOlds++;
                                if (isset($codeArr['total_qty']) && $codeArr['total_qty'] == $warehouseProductsItem->getTotalQty())
                                    continue;
                                if (isset($codeArr['total_qty']) && !is_numeric($codeArr['total_qty']))
                                    continue;
                                $current_warehouse_qty = $warehouseProductsItem->getTotalQty();
                                $changeProductQtys[$pId]['old_qty'] = $current_warehouse_qty;
                                $changeProductQtys[$pId]['new_qty'] = $codeArr['total_qty'];
                                $oldQtyAvailable = $warehouseProductsItem->getAvailableQty();
                                $newQtyAvailable = $oldQtyAvailable + ($codeArr['total_qty'] - $warehouseProductsItem->getTotalQty());
                                $warehouseProductsItem
                                        ->setWarehouseId($model->getId())
                                        ->setTotalQty($codeArr['total_qty'])
                                        ->setAvailableQty($newQtyAvailable)
                                        ->save();
                                $productsHistory[$pId] = array('old' => $current_warehouse_qty, 'new' => $codeArr['total_qty']);
                                $stock_item = Mage::getModel('cataloginventory/stock_item')
                                        ->getCollection()
                                        ->addFieldToFilter('product_id', $pId)
                                        ->getFirstItem();
                                $stock_item_qty = $stock_item->getQty();
                                $new_qty = (int) $stock_item_qty + (int) $codeArr['total_qty'] - $current_warehouse_qty;

                                $manageStock = $stock_item->getManageStock();
                                if ($stock_item->getUseConfigManageStock()) {
                                    $manageStock = Mage::getStoreConfig('cataloginventory/item_options/manage_stock', Mage::app()->getStore()->getStoreId());
                                }
                                if ($manageStock) {
                                    try {
                                        $backorders = $stock_item->getBackorders();
                                        $useConfigBackorders = $stock_item->getUseConfigBackorders();
                                        if ($useConfigBackorders) {
                                            $backorders = Mage::getStoreConfig('cataloginventory/item_options/backorders', Mage::app()->getStore()->getStoreId());
                                        }

                                        $stock_item->setQty($new_qty);
                                        $minToChangeStatus = Mage::getStoreConfig('cataloginventory/item_options/min_qty');

                                        if ($new_qty > $minToChangeStatus) {
                                            $stock_item->setData('is_in_stock', 1);
                                        } else {
                                            if (!$backorders) {
                                                $stock_item->setData('is_in_stock', 0);
                                            }
                                        }

                                        $stock_item->save();
                                    } catch (Exception $e) {
                                        Mage::log($e->getMessage(), null, 'inventory_management.log');
                                    }
                                }
                            } else {
                                $warehouseProductsNew = Mage::getModel('inventoryplus/warehouse_product');
                                $countSqlOlds++;
                                if ($codeArr['total_qty'] == '')
                                    $codeArr['total_qty'] = 0;
                                if (isset($codeArr['total_qty']) && !is_numeric($codeArr['total_qty']))
                                    continue;

                                $warehouseProductsNew
                                        ->setWarehouseId($model->getId())
                                        ->setProductId($pId)
                                        ->setTotalQty($codeArr['total_qty'])
                                        ->setAvailableQty($codeArr['total_qty'])
                                        ->save();

                                $stock_item = Mage::getModel('cataloginventory/stock_item')
                                        ->getCollection()
                                        ->addFieldToFilter('product_id', $pId)
                                        ->getFirstItem();
                                $stock_item_qty = $stock_item->getQty();
                                $new_qty = (int) $stock_item_qty + (int) $codeArr['total_qty'];

                                $manageStock = $stock_item->getManageStock();
                                if ($stock_item->getUseConfigManageStock()) {
                                    $manageStock = Mage::getStoreConfig('cataloginventory/item_options/manage_stock', Mage::app()->getStore()->getStoreId());
                                }
                                if ($manageStock) {
                                    try {
                                        $stock_item->setQty($new_qty);
                                        $minToChangeStatus = Mage::getStoreConfig('cataloginventory/item_options/min_qty');

                                        $backorders = $stock_item->getBackorders();
                                        $useConfigBackorders = $stock_item->getUseConfigBackorders();
                                        if ($useConfigBackorders) {
                                            $backorders = Mage::getStoreConfig('cataloginventory/item_options/backorders', Mage::app()->getStore()->getStoreId());
                                        }

                                        if ($new_qty > $minToChangeStatus) {
                                            $stock_item->setData('is_in_stock', 1);
                                        } else {
                                            if (!$backorders) {
                                                $stock_item->setData('is_in_stock', 0);
                                            }
                                        }


                                        $stock_item->save();
                                    } catch (Exception $e) {
                                        Mage::log($e->getMessage(), null, 'inventory_management.log');
                                    }
                                }
                            }
                            $productIds[] = $pId;
                        }
                    }
                }
                //add new product
                Mage::dispatchEvent('inventory_adminhtml_add_new_product', array('data' => $data, 'warehouse' => $model));

                //save permission
                $edits = array();
                if (isset($data['edit']) && is_array($data['edit'])) {
                    $edits = $data['edit'];
                }

                $adjusts = array();
                if (isset($data['adjust']) && is_array($data['adjust'])) {
                    $adjusts = $data['adjust'];
                }


                $changePermissions = array();
                $managerId = Mage::getModel('admin/user')->loadByUsername($manager)->getUserId();
                $oldManagerId = Mage::getModel('admin/user')->loadByUsername($oldManager)->getUserId();
                $owner = $model->getCreatedBy();
                $ownerId = Mage::getModel('admin/user')->loadByUsername($owner)->getUserId();
                $isNewManager = false;
                //remove old manager permission
                $oldassignment = Mage::getModel('inventoryplus/warehouse_permission')->loadByWarehouseAndAdmin($model->getId(), $oldManagerId);
                $newassignment = Mage::getModel('inventoryplus/warehouse_permission')->loadByWarehouseAndAdmin($model->getId(), $managerId);
                $ownerassignment = Mage::getModel('inventoryplus/warehouse_permission')->loadByWarehouseAndAdmin($model->getId(), $ownerId);

                //check old manager and new manager
                $isDiffMng = false;
                if ($managerId && $managerId != $oldManagerId) {
                    $isDiffMng = true;
                }
                $isNewMng = false;
                if(!$oldManagerId || !isset($oldManagerId)){
                    $isNewMng = true;
                }
                
                //add permission for warehouse owner
                $ownerassignment->setCanEditWarehouse(1)
                        ->setCanAdjust(1)
                        ->setCanPhysical(1)
                        ->setCanSendRequestStock(1)
                        ->setCanPurchaseProduct(1)
                        ->setAdminId($ownerId)
                        ->setWarehouseId($model->getId())
                        ->setId($ownerassignment->getId())
                        ->save()
                ;
                
                // add permission for warehouse manager
                if (($oldassignment->getId() && $isDiffMng) || $isNewMng) {
                    
                    if($oldManagerId && $oldManagerId != $ownerId){
                        $oldassignment->delete();
                    }
                    //save data for new manager
                    if ($managerId && $managerId != $ownerId) {
                        $newassignment->setCanEditWarehouse(1)
                                ->setCanAdjust(1)
                                ->setCanPhysical(1)
                                ->setCanSendRequestStock(1)
                                ->setCanPurchaseProduct(1)
                                ->setAdminId($managerId)
                                ->setWarehouseId($model->getId())
                                ->save()
                        ;
                        $isNewManager = true;
                    }
                }

                if (in_array($admin->getId(),array($managerId,$ownerId))) {
                    $admins = Mage::getModel('admin/user')->getCollection()
                            ->addFieldToFilter('user_id', array('nin' => array($ownerId, $managerId)))
                            ->getAllIds();
                    foreach ($admins as $adminId) {
                        $assignment = Mage::getModel('inventoryplus/warehouse_permission')->loadByWarehouseAndAdmin($model->getId(), $adminId);
                        if ($assignment->getId()) {
                            $oldEditWarehouse = $assignment->getCanEditWarehouse();
                            $oldAdjust = $assignment->getCanAdjust();
                        }
                        $assignment->setWarehouseId($model->getId());
                        $assignment->setAdminId($adminId);

                        if (in_array($adminId, $edits)) {
                            if ($assignment->getId()) {
                                if ($oldEditWarehouse != 1) {
                                    $changePermissions[$adminId]['old_edit'] = Mage::helper('inventoryplus')->__('Cannot edit Warehouse');
                                    $changePermissions[$adminId]['new_edit'] = Mage::helper('inventoryplus')->__('Can edit Warehouse');
                                }
                            } else {
                                $changePermissions[$adminId]['old_edit'] = '';
                                $changePermissions[$adminId]['new_edit'] = Mage::helper('inventoryplus')->__('Can edit Warehouse');
                            }
                            $assignment->setData('can_edit_warehouse', 1);
                        } else {
                            if ($assignment->getId()) {
                                if ($oldEditWarehouse != 0) {
                                    $changePermissions[$adminId]['old_edit'] = Mage::helper('inventoryplus')->__('Can edit Warehouse');
                                    $changePermissions[$adminId]['new_edit'] = Mage::helper('inventoryplus')->__('Cannot edit Warehouse');
                                }
                            } else {
                                $changePermissions[$adminId]['old_edit'] = '';
                                $changePermissions[$adminId]['new_edit'] = Mage::helper('inventoryplus')->__('Cannot edit Warehouse');
                            }
                            $assignment->setData('can_edit_warehouse', 0);
                        }

                        if (in_array($adminId, $adjusts)) {
                            if ($assignment->getId()) {
                                if ($oldAdjust != 1) {
                                    $changePermissions[$adminId]['old_adjust'] = Mage::helper('inventoryplus')->__('Cannot adjust Warehouse');
                                    $changePermissions[$adminId]['new_adjust'] = Mage::helper('inventoryplus')->__('Can adjust Warehouse');
                                }
                            } else {
                                $changePermissions[$adminId]['old_adjust'] = '';
                                $changePermissions[$adminId]['new_adjust'] = Mage::helper('inventoryplus')->__('Can adjust Warehouse');
                            }
                            $assignment->setData('can_adjust', 1);
                        } else {
                            if ($assignment->getId()) {
                                if ($oldAdjust != 0) {
                                    $changePermissions[$adminId]['old_adjust'] = Mage::helper('inventoryplus')->__('Can adjust Warehouse');
                                    $changePermissions[$adminId]['new_adjust'] = Mage::helper('inventoryplus')->__('Cannot adjust Warehouse');
                                }
                            } else {
                                $changePermissions[$adminId]['old_adjust'] = '';
                                $changePermissions[$adminId]['new_adjust'] = Mage::helper('inventoryplus')->__('Cannot adjust Warehouse');
                            }
                            $assignment->setData('can_adjust', 0);
                        }

                        Mage::dispatchEvent('inventory_adminhtml_add_more_permission', array('permission' => $assignment, 'data' => $data, 'admin_id' => $adminId, 'change_permssions' => $changePermissions));

                        try {
                            $assignment->save();
                        } catch (Exception $e) {
                            Mage::log($e->getMessage(), null, 'inventory_management.log');
                        }
                    }
                }
                //save permission to session
                Mage::helper('inventoryplus')->saveSessionPermission();
                //save history change
                $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                if (!$this->getRequest()->getParam('id')) {
                    $warehouseHistory = Mage::getModel('inventoryplus/warehouse_history');
                    $warehouseHistoryContent = Mage::getModel('inventoryplus/warehouse_historycontent');
                    $warehouseHistory->setData('warehouse_id', $model->getId())
                            ->setData('time_stamp', now())
                            ->setData('create_by', $admin)
                            ->save();
                    $warehouseHistoryContent->setData('warehouse_history_id', $warehouseHistory->getId())
                            ->setData('field_name', Mage::helper('inventoryplus')->__('%s created this warehouse.', $admin))
                            ->save();
                } else {
                    if ($changeData == 1 || $warehouseProductDeleteds || count($changeProductQtys) || count($changePermissions)) {
                        $warehouseHistory = Mage::getModel('inventoryplus/warehouse_history');
                        $warehouseHistory->setData('warehouse_id', $model->getId())
                                ->setData('time_stamp', now())
                                ->setData('create_by', $admin)
                                ->save();
                        $warehouseHistoryId = $warehouseHistory->getId();
                        if ($isNewManager) {
                            $warehouseHistoryContent = Mage::getModel('inventoryplus/warehouse_historycontent');
                            $warehouseHistoryContent->setData('warehouse_history_id', $warehouseHistoryId)
                                    ->setData('field_name', Mage::helper('inventoryplus')->__('Set %s to be this warehouse manager', $manager))
                                    ->setData('old_value', 'Old manager: ' . $oldManager)
                                    ->setData('new_value', 'New manager: ' . $manager)
                                    ->save();
                        }

                        if (count($changePermissions)) {
                            foreach ($changePermissions as $key => $value) {
                                $admin = Mage::getModel('admin/user')->load($key)->getUsername();
                                $newValue = '';
                                $oldValue = '';
                                if (isset($value['new_edit']))
                                    $newValue .= '| ' . $value['new_edit'] . ' |';
                                if (isset($value['new_adjust']))
                                    $newValue .= '| ' . $value['new_adjust'] . ' |';
                                if (isset($value['new_purchase']))
                                    $newValue .= '| ' . $value['new_purchase'] . ' |';
                                if (isset($value['old_edit']))
                                    $oldValue .= '| ' . $value['old_edit'] . ' |';
                                if (isset($value['old_adjust']))
                                    $oldValue .= '| ' . $value['old_adjust'] . ' |';
                                if (isset($value['old_purchase']))
                                    $newValue .= '| ' . $value['old_purchase'] . ' |';
                                $warehouseHistoryContent = Mage::getModel('inventoryplus/warehouse_historycontent');
                                $warehouseHistoryContent->setData('warehouse_history_id', $warehouseHistoryId)
                                        ->setData('field_name', Mage::helper('inventoryplus')->__('Changed permission of %s for this warehouse.', $admin))
                                        ->setData('old_value', $oldValue)
                                        ->setData('new_value', $newValue)
                                        ->save();
                            }
                        }
                        if (count($changeProductQtys)) {
                            foreach ($changeProductQtys as $key => $value) {
                                $productSku = Mage::helper('inventoryplus/warehouse')->getProductSkuByProductId($key);
                                $warehouseHistoryContent = Mage::getModel('inventoryplus/warehouse_historycontent');
                                $warehouseHistoryContent->setData('warehouse_history_id', $warehouseHistoryId)
                                        ->setData('field_name', Mage::helper('inventoryplus')->__('%s changed quantity of product(s) with the following SKU(s): %s.', $admin, $productSku))
                                        ->setData('old_value', $value['old_qty'])
                                        ->setData('new_value', $value['new_qty'])
                                        ->save();
                            }
                        }
                        if ($warehouseProductDeleteds) {
                            $warehouseHistoryContent = Mage::getModel('inventoryplus/warehouse_historycontent');
                            $warehouseHistoryContent->setData('warehouse_history_id', $warehouseHistoryId)
                                    ->setData('field_name', Mage::helper('inventoryplus')->__('%s removed product(s) from this warehouse.', $admin))
                                    ->setData('new_value', Mage::helper('inventoryplus')->__('%s removed product(s) with the following SKU(s): %s', $admin, $warehouseProductDeleteds))
                                    ->save();
                        }
                        if ($changeData == 1) {
                            foreach ($changeArray as $field => $filedValue) {
                                $fileTitle = $this->getTitleByField($field);
                                if ($field == 'status') {

                                    $statusArray = Mage::getSingleton('inventoryplus/status')->getOptionHash();

                                    if (isset($statusArray[$filedValue['old']]))
                                        $filedValue['old'] = $statusArray[$filedValue['old']]['value'];
                                    else
                                        $filedValue['old'] = $statusArray[0]['value'];

                                    if (isset($statusArray[$filedValue['new']]))
                                        $filedValue['new'] = $statusArray[$filedValue['new']]['value'];
                                    else
                                        $filedValue['new'] = $statusArray[0]['value'];
                                } elseif ($field == 'country_id') {
                                    $countryArray = array();
                                    $countryArrays = Mage::helper('inventoryplus/warehouse')->getCountryListHash();
                                    foreach ($countryArrays as $country) {
                                        $countryArray[$country['value']] = $country['label'];
                                    }
                                    $filedValue['old'] = '';
                                    $filedValue['new'] = '';
                                    if (isset($countryArray[$filedValue['old']]))
                                        $filedValue['old'] = $countryArray[$filedValue['old']];
                                    if (isset($countryArray[$filedValue['new']]))
                                        $filedValue['new'] = $countryArray[$filedValue['new']];
                                } elseif ($field == 'state_id') {
                                    $oldRegion = Mage::getModel('directory/region')->load($filedValue['old']);
                                    $oldRegionName = $oldRegion->getName();
                                    $newRegion = Mage::getModel('directory/region')->load($filedValue['new']);
                                    $newRegionName = $newRegion->getName();
                                    $filedValue['old'] = $oldRegionName;
                                    $filedValue['new'] = $newRegionName;
                                }
                                $warehouseHistoryContent = Mage::getModel('inventoryplus/warehouse_historycontent');
                                $warehouseHistoryContent->setData('warehouse_history_id', $warehouseHistoryId)
                                        ->setData('field_name', $fileTitle)
                                        ->setData('old_value', $filedValue['old'])
                                        ->setData('new_value', $filedValue['new'])
                                        ->save();
                            }
                        }
                    }
                }


                if (!$this->getRequest()->getParam('id')) {
                    Mage::getSingleton('adminhtml/session')->addNotice(Mage::helper('inventoryplus')->__('The warehouse is empty. You can add products by adjusting stock or requesting stock for sending stock to this warehouse.'));
                    Mage::getSingleton('adminhtml/session')->addSuccess(
                            Mage::helper('inventoryplus')->__('The warehouse has been created.')
                    );
                } else {
                    Mage::getSingleton('adminhtml/session')->addSuccess(
                            Mage::helper('inventoryplus')->__('The warehouse has been saved.')
                    );
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
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventoryplus')->__('Unable to find warehouse to save!')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete item action
     */
    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('inventoryplus/warehouse');
                $canDelete = Mage::helper('inventoryplus/warehouse')->canDelete($this->getRequest()->getParam('id'));
                if ($canDelete) {
                    $model->setId($this->getRequest()->getParam('id'))
                            ->delete();

                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Warehouse was successfully deleted'));
                    $this->_redirect('*/*/');
                } else {
                    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Can\'t delete warehouse because it still contains some products.'));
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                }
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * mass delete item(s) action
     */
    public function massDeleteAction() {
        $inventoryIds = $this->getRequest()->getParam('inventoryplus');
        if (!is_array($inventoryIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($inventoryIds as $inventoryId) {
                    $inventory = Mage::getModel('inventoryplus/inventory')->load($inventoryId);
                    $inventory->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted', count($inventoryIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass change status for item(s) action
     */
    public function massStatusAction() {
        $inventoryIds = $this->getRequest()->getParam('inventoryplus');
        if (!is_array($inventoryIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($inventoryIds as $inventoryId) {
                    Mage::getSingleton('inventoryplus/inventory')
                            ->load($inventoryId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) were successfully updated', count($inventoryIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export grid item to CSV type
     */
    public function exportCsvAction() {
        $fileName = 'warehouse.csv';
        $content = $this->getLayout()
                ->createBlock('inventoryplus/adminhtml_warehouse_grid')
                ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportWarehouseProductCsvAction() {

        $fileName = 'warehouse_product.csv';
        $content = $this->getLayout()
                ->createBlock('inventoryplus/adminhtml_warehouse_edit_tab_products')
                ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export grid item to XML type
     */
    public function exportXmlAction() {
        $fileName = 'warehouse.xml';
        $content = $this->getLayout()
                ->createBlock('inventoryplus/adminhtml_warehouse_grid')
                ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportWarehouseProductXmlAction() {
        $fileName = 'warehouse_product.xml';
        $content = $this->getLayout()
                ->createBlock('inventoryplus/adminhtml_warehouse_edit_tab_products')
                ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('inventoryplus');
    }

    //warehouse products
    public function productsAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('warehouse.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('warehouse_products', null));
        $this->renderLayout();
    }

    public function productsGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('warehouse.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('warehouse_products', null));
        $this->renderLayout();
    }

    //warehouse permission
    public function permissionAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('warehouse.edit.tab.permission')
                ->setAssignments($this->getRequest()->getPost('rassignments', null));
        $this->renderLayout();
    }

    public function permissionGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('warehouse.edit.tab.permission')
                ->setAssignments($this->getRequest()->getPost('rassignments', null));
        $this->renderLayout();
    }

    //warehouse change history
    public function historyAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function historyGridAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    //show history
    public function showhistoryAction() {
        $form_html = $this->getLayout()
                ->createBlock('inventoryplus/adminhtml_warehouse_history')
                ->setTemplate('inventoryplus/warehouse/showhistory.phtml')
                ->toHtml();
        $this->getResponse()->setBody($form_html);
    }

    public function getFiledSaveHistory() {
        return array('name', 'manager_name', 'manager_email', 'telephone', 'street', 'city', 'country_id', 'state', 'stateEl', 'state_id', 'postcode', 'status');
    }

    public function getTitleByField($field) {
        $fieldArray = array(
            'name' => Mage::helper('inventoryplus')->__('Warehouse Name'),
            'manager_name' => Mage::helper('inventoryplus')->__('Manager\'s Name'),
            'manager_email' => Mage::helper('inventoryplus')->__('Manager\'s Email'),
            'telephone' => Mage::helper('inventoryplus')->__('Telephone'),
            'street' => Mage::helper('inventoryplus')->__('Street'),
            'city' => Mage::helper('inventoryplus')->__('City'),
            'country_id' => Mage::helper('inventoryplus')->__('Country'),
            'stateEl' => Mage::helper('inventoryplus')->__('State/Province'),
            'state' => Mage::helper('inventoryplus')->__('State/Province'),
            'state_id' => Mage::helper('inventoryplus')->__('State/Province'),
            'postcode' => Mage::helper('inventoryplus')->__('Zip/Postal Code'),
            'status' => Mage::helper('inventoryplus')->__('Status')
        );
        if (!$fieldArray[$field])
            return $field;
        return $fieldArray[$field];
    }

    public function gridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventory_warehouse_grid');
        $this->renderLayout();
    }
	public function exportProductsCsvAction() {
        $fileName = 'warehouse_products.csv';
        $content = $this->getLayout()
                ->createBlock('inventoryplus/adminhtml_warehouse_edit_tab_products')
                ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    public function exportProductsXmlAction() {
        $fileName = 'warehouse_products.xml';
        $content = $this->getLayout()
                ->createBlock('inventoryplus/adminhtml_warehouse_edit_tab_products')
                ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }
}
