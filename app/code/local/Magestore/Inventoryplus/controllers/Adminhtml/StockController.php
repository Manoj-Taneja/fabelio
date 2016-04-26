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
class Magestore_Inventoryplus_Adminhtml_StockController extends Mage_Adminhtml_Controller_Action
{
    /**
     * init layout and set active for current menu
     *
     * @return Magestore_Inventory_Adminhtml_StockController
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('inventoryplus')
            ->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Manage Stock'),
                Mage::helper('adminhtml')->__('Manage Stock')
            );
        return $this;
    }
 
    /**
     * index action
     */
    public function indexAction()
    {        
        $this->_title($this->__('Inventory'))
             ->_title($this->__('Manage Stock'));
        
        $warehouseId = $this->getRequest()->getParam('id');
        if(!$warehouseId)
            $warehouseId = 1;
        $model = Mage::getModel('inventoryplus/warehouse')->load($warehouseId);

        if ($model->getId() || $warehouseId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('warehouse_data', $model);

            $this->loadLayout();
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
            $this->_addContent($this->getLayout()->createBlock('inventoryplus/adminhtml_stock_edit'))
                    ->_addLeft($this->getLayout()->createBlock('inventoryplus/adminhtml_stock_edit_tabs'));            
                
            Mage::dispatchEvent('stock_controller_index', array('stock_controler' => $this)); 
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventoryplus')->__('Stock does not exist!')
            );
            $this->_redirect('*/*/');
        }
    }

    public function productsAction() {
		$warehouseId = Mage::getModel('admin/session')->getData('stock_warehouse_id');
		if(!isset($warehouseId) || !$warehouseId){
			Mage::getModel('admin/session')->setData('stock_warehouse_id',0);
		}
        $this->loadLayout();
			$this->getLayout()->getBlock('stock.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('stock_products', null));
        $this->renderLayout();
    }

    public function productsGridAction() {
        $this->loadLayout();
			$this->getLayout()->getBlock('stock.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('stock_products', null));
        $this->renderLayout();
    }
    
    /**
     * view and edit item action
     */
    public function editAction()
    {
        $inventoryId     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('inventoryplus/inventory')->load($inventoryId);

        if ($model->getId() || $inventoryId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('inventory_data', $model);

            $this->loadLayout()->_setActiveMenu('inventoryplus');
            $this->_setActiveMenu('inventoryplus/inventory');

            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Item Manager'),
                Mage::helper('adminhtml')->__('Item Manager')
            );
            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Item News'),
                Mage::helper('adminhtml')->__('Item News')
            );

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('inventoryplus/adminhtml_inventory_edit'))
                ->_addLeft($this->getLayout()->createBlock('inventoryplus/adminhtml_inventory_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventoryplus')->__('Item does not exist')
            );
            $this->_redirect('*/*/');
        }
    }
    
   /**
     * save item action
     */
    public function saveAction() {
        $admin = Mage::getSingleton('admin/session')->getUser();
        if ($data = $this->getRequest()->getPost()) {   
            if(isset($data['warehouse_id'])){
                $model = Mage::getModel('inventoryplus/warehouse')->load($data['warehouse_id']);
            }else{
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventoryplus')->__('Unable to find warehouse to save stock!')
                );
                $this->_redirect('*/*/');
            }
       
            try {
                $model->setUpdatedBy($admin->getUserName());
                $model->setUpdatedAt(now());
                $model->save();
                $resource = Mage::getSingleton('core/resource');
                $writeConnection = $resource->getConnection('core_write');
    //            $installer = Mage::getModel('core/resource_setup');
                $sqlNews = array();
                $sqlOlds = '';
                $countSqlOlds = 0;
                $productsHistory = array();
                $warehouseProductDeleteds = '';
                $changeProductQtys = array();

                //save products
                if (isset($data['stock_products'])) {
                    $warehouseProducts = array();
                    $warehouseProductsExplodes = explode('&', urldecode($data['stock_products']));
                    if (count($warehouseProductsExplodes) <= 900) {
                        parse_str(urldecode($data['stock_products']), $warehouseProducts);
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
                                if($stock_item->getUseConfigManageStock()){
                                    $manageStock = Mage::getStoreConfig('cataloginventory/item_options/manage_stock',Mage::app()->getStore()->getStoreId());                                        
                                }
                                if($manageStock){
                                    try {
                                        $backorders = $stock_item->getBackorders();
                                        $useConfigBackorders = $stock_item->getUseConfigBackorders();
                                        if($useConfigBackorders){
                                            $backorders = Mage::getStoreConfig('cataloginventory/item_options/backorders',Mage::app()->getStore()->getStoreId());                        
                                        }
                                        
                                        $stock_item->setQty($new_qty);
                                        $minToChangeStatus = Mage::getStoreConfig('cataloginventory/item_options/min_qty');
                                        if (Mage::getStoreConfig('inventoryplus/general/updatestock')) {
                                            if ($new_qty > $minToChangeStatus) {
                                                $stock_item->setData('is_in_stock', 1);
                                            } else {
                                                if(!$backorders){
                                                    $stock_item->setData('is_in_stock', 0);
                                                }
                                            }
                                        }

                                        //                            $stock_item->setQty($new_qty)->save();
                                        $stock_item->save();
                                    } catch (Exception $e) {
                                        Mage::log($e->getMessage(), null, 'inventory_management.log');
                                    }
                                }
                            }else{
                                $warehouseProductsNew = Mage::getModel('inventoryplus/warehouse_product');
                                 $countSqlOlds++;
                                if($codeArr['total_qty']=='')
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
                                if($stock_item->getUseConfigManageStock()){
                                    $manageStock = Mage::getStoreConfig('cataloginventory/item_options/manage_stock',Mage::app()->getStore()->getStoreId());                                        
                                }
                                if($manageStock){
                                    try {
                                        $backorders = $stock_item->getBackorders();
                                        $useConfigBackorders = $stock_item->getUseConfigBackorders();
                                        if($useConfigBackorders){
                                            $backorders = Mage::getStoreConfig('cataloginventory/item_options/backorders',Mage::app()->getStore()->getStoreId());                        
                                        }
                                        
                                        $stock_item->setQty($new_qty);
                                        $minToChangeStatus = Mage::getStoreConfig('cataloginventory/item_options/min_qty');
                                        if (Mage::getStoreConfig('inventoryplus/general/updatestock')) {
                                            if ($new_qty > $minToChangeStatus) {
                                                $stock_item->setData('is_in_stock', 1);
                                            } else {
                                                if(!$backorders){
                                                    $stock_item->setData('is_in_stock', 0);
                                                }
                                            }
                                        }

                                        //                            $stock_item->setQty($new_qty)->save();
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

                //save histoty change
                $admin = Mage::getModel('admin/session')->getUser()->getUsername();                
                if ($warehouseProductDeleteds || count($changeProductQtys)) {
                    $warehouseHistory = Mage::getModel('inventoryplus/warehouse_history');
                    $warehouseHistory->setData('warehouse_id', $model->getId())
                            ->setData('time_stamp', now())
                            ->setData('create_by', $admin)
                            ->save();
                    $warehouseHistoryId = $warehouseHistory->getId();

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
                                ->setData('field_name', Mage::helper('inventoryplus')->__('%s removed product(s) from this warehouse.',$admin))
                                ->setData('new_value', Mage::helper('inventoryplus')->__('%s removed product(s) with the following SKU(s): %s', $admin, $warehouseProductDeleteds))
                                ->save();
                    }                        
                }                

                Mage::getSingleton('adminhtml/session')->addSuccess(                      
                        Mage::helper('inventoryplus')->__('Stock of \'%s\' warehouse has been successfully updated.',$model->getWarehouseName())
                );                
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                $this->_redirect('*/*/', array('warehouse_id' => $data['warehouse_id']));
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
    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('inventoryplus/inventory');
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Item was successfully deleted')
                );
                $this->_redirect('*/*/');
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
    public function massDeleteAction()
    {
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
                    Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted',
                    count($inventoryIds))
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
    public function massStatusAction()
    {
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
    public function exportCsvAction()
    {
        $fileName   = 'inventory_stock.csv';
        $content    = $this->getLayout()
                           ->createBlock('inventoryplus/adminhtml_stock_edit_tab_products')
                           ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export grid item to XML type
     */
    public function exportXmlAction()
    {
        $fileName   = 'inventory_stock.xml';
        $content    = $this->getLayout()
                           ->createBlock('inventoryplus/adminhtml_stock_edit_tab_products')
                           ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('inventoryplus');
    }
    
    public function changewarehouseAction()
    {
        $warehouseId = $this->getRequest()->getParam('warehouse_id');echo $warehouseId;
        Mage::getModel('admin/session')->setData('stock_warehouse_id',$warehouseId);
    }
	public function showcustomerAction()
    {
        $block = $this->getLayout()
                ->createBlock('adminhtml/template')
                ->setTemplate('inventoryplus/stock/showcustomer.phtml')
                ->toHtml();
        $this->getResponse()->setBody($block);
    }
}	