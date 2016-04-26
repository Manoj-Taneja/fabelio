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
class Magestore_Inventoryplus_Adminhtml_AdjuststockController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('inventoryplus')
                ->_addBreadcrumb(
                        Mage::helper('adminhtml')->__('Adjust stock Manager'), Mage::helper('adminhtml')->__('Adjust stock Manager')
        );
        $this->_title($this->__('Inventory'))
                ->_title($this->__('Manage Adjust Stocks'));
        return $this;
    }

    /**
     * index action
     */
    public function indexAction() {
        $this->_initAction()
                ->renderLayout();
    }

    public function importproductAction() {
        if (isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] != '') {
            try {
                $fileName = $_FILES['fileToUpload']['tmp_name'];
                $Object = new Varien_File_Csv();
                $dataFile = $Object->getData($fileName);
                $adjuststockProduct = array();
                $adjuststockProducts = array();
                $fields = array();
                $count = 0;
                $adjuststockHelper = Mage::helper('inventoryplus/adjuststock');
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
                                        $adjuststockProduct[$fields[$index]] = $cell;
                                    }
                                }
                            $adjuststockProducts[] = $adjuststockProduct;
                        }
                    }

                $adjuststockHelper->importProduct($adjuststockProducts);
            } catch (Exception $e) {
                
            }
        }
    }

    public function gridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventory_listadjuststock_grid');
        $this->renderLayout();
    }

    public function newAction() {
        $this->_title($this->__('Inventory'))
                ->_title($this->__('Add New Adjust Stock'));
        if (!Mage::helper('inventoryplus')->isWarehouseEnabled()) {
            $this->_redirect('*/*/prepare');
        } else {
            $this->loadLayout()->_setActiveMenu('inventoryplus');
            $this->renderLayout();
        }
    }

    public function editAction() {
        $this->_title($this->__('Inventory'))
                ->_title($this->__('Edit New Adjust Stock'));

        $adjustStockId = $this->getRequest()->getParam('id');
        $model = Mage::getModel('inventoryplus/adjuststock')->load($adjustStockId);
        if ($model->getId() || $adjustStockId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('adjuststock_data', $model);

            $this->loadLayout()->_setActiveMenu('inventoryplus');
            $this->_setActiveMenu('inventoryplus/adjuststock');
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true)
                    ->removeItem('js', 'mage/adminhtml/grid.js')
                    ->addItem('js', 'magestore/adminhtml/inventory/grid.js');
            $this->_addContent($this->getLayout()->createBlock('inventoryplus/adminhtml_adjuststock_edit'))
                    ->_addLeft($this->getLayout()->createBlock('inventoryplus/adminhtml_adjuststock_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventoryplus')->__('Adjust Stock does not exist')
            );
            $this->_redirect('*/*/');
        }
    }

    public function prepareAction() {
        $this->_title($this->__('Inventory'))
                ->_title($this->__('Add New Adjust Stock'));

        if ($data = $this->getRequest()->getPost() || !Mage::helper('inventoryplus')->isWarehouseEnabled() || $this->getRequest()->getParam('warehouse_id')) {


            $adjustStockProduct = array();
            $adjustStockProducts = array();
            if ($this->getRequest()->getPost('warehouse_id'))
                $adjustStockProducts['warehouse_id'] = $this->getRequest()->getPost('warehouse_id');

            if (!Mage::helper('inventoryplus')->isWarehouseEnabled()) {
                $adjustStockProducts['warehouse_id'] = Mage::getModel('inventoryplus/warehouse')->getCollection()
                                ->getFirstItem()->getId();

                $adminId = Mage::getSingleton('admin/session')->getUser()->getId();
                $canPhysicalAdmins = Mage::getModel('inventoryplus/warehouse_permission')->getCollection()
                        ->addFieldToFilter('warehouse_id', $adjustStockProducts['warehouse_id'])
                        ->addFieldToFilter('admin_id', $adminId)
                        ->addFieldToFilter('can_adjust', 1);
                if (!$canPhysicalAdmins->getSize()) {
                    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('inventoryplus')->__('You have not permission to adjust stock!'));
                    session_write_close();
                    $this->_redirect('*/*/');
                }
            } else {

                if (!$this->getRequest()->getPost('warehouse_id') && $this->getRequest()->getParam('warehouse_id'))
                    $adjustStockProducts['warehouse_id'] = $this->getRequest()->getParam('warehouse_id');
            }


            if (isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] != '') {

                try {
                    /* Starting upload */
                    $uploader = new Varien_File_Uploader('fileToUpload');

                    // Any extention would work
                    $uploader->setAllowedExtensions(array('csv'));
                    $uploader->setAllowRenameFiles(false);

                    $uploader->setFilesDispersion(false);

                    try {
                        $fileName = $_FILES['fileToUpload']['tmp_name'];
                        $Object = new Varien_File_Csv();
                        $dataFile = $Object->getData($fileName);

                        $fields = array();
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
                                                $adjustStockProduct[$fields[$index]] = $cell;
                                            }
                                        }
                                    $adjustStockProducts[] = $adjustStockProduct;
                                }
                            }
                        if (count($adjustStockProducts)) {

                            Mage::getModel('admin/session')->setData('adjuststock_product_import', $adjustStockProducts);
                            $this->loadLayout()->_setActiveMenu('inventoryplus');
                            $this->_setActiveMenu('inventoryplus/adjuststock');
                            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true)
                                    ->removeItem('js', 'mage/adminhtml/grid.js')
                                    ->addItem('js', 'magestore/adminhtml/inventory/grid.js');
                            $this->_addContent($this->getLayout()->createBlock('inventoryplus/adminhtml_adjuststock_edit')->setAdjustStockProducts($adjustStockProducts))
                                    ->_addLeft($this->getLayout()->createBlock('inventoryplus/adminhtml_adjuststock_edit_tabs')->setAdjustStockProducts($adjustStockProducts));
                            $this->renderLayout();
                        } else {
                            Mage::getSingleton('adminhtml/session')->addError(
                                    Mage::helper('inventoryplus')->__('Unable to find item to save')
                            );
                            $this->_redirect('*/*/new');
                        }
                    } catch (Exception $e) {
                        
                    }
                } catch (Exception $e) {
                    
                }
            } else {

                Mage::getModel('admin/session')->setData('adjuststock_product_warehouse', $adjustStockProducts);
                $this->loadLayout()->_setActiveMenu('inventoryplus');
                $this->_setActiveMenu('inventoryplus/adjuststock');
                $this->getLayout()->getBlock('head')->setCanLoadExtJs(true)
                        ->removeItem('js', 'mage/adminhtml/grid.js')
                        ->addItem('js', 'magestore/adminhtml/inventory/grid.js');
                $this->_addContent($this->getLayout()->createBlock('inventoryplus/adminhtml_adjuststock_edit')->setAdjustStockProducts($adjustStockProducts))
                        ->_addLeft($this->getLayout()->createBlock('inventoryplus/adminhtml_adjuststock_edit_tabs')->setAdjustStockProducts($adjustStockProducts));
                $this->renderLayout();
            }
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventoryplus')->__('Unable to find item to save')
            );
            $this->_redirect('*/*/index');
        }
    }

    public function productAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventoryplus.adjuststock.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('adjuststock_products', null));
        $this->renderLayout();
        if (Mage::getModel('admin/session')->getData('adjuststock_product_import')) {
            Mage::getModel('admin/session')->setData('adjuststock_product_import', null);
        }
    }

    public function productGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventoryplus.adjuststock.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('adjuststock_products', null));
        $this->renderLayout();
    }

    public function saveAction() {

        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('inventoryplus/adjuststock');
            $model->addData($data);
            $warehouse_id = $data['warehouse_id'];

            $warehouse = Mage::getModel('inventoryplus/warehouse')->load($warehouse_id);


            try {

                $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                if ($this->getRequest()->getParam('id')) {
                    $model->setId($this->getRequest()->getParam('id'));

                    if ($this->getRequest()->getParam('cancel')) {
                        $model->setStatus(2);
                        $model->save();
                        Mage::getSingleton('adminhtml/session')->addSuccess(
                                Mage::helper('inventoryplus')->__('The stock adjustment has been successfully canceled.')
                        );
                        $this->_redirect('*/*/');
                        return;
                    }
                }
                if (isset($data['adjuststock_products']) && !empty($data['adjuststock_products'])) {
                    //create a new adjuststock 
                    if (!$this->getRequest()->getParam('id')) {
                        $model->setWarehouseId($warehouse_id)
                                ->setWarehouseName($warehouse->getWarehouseName())
                                ->setCreatedAt(now())
                                ->setReason($data['reason'])
                                ->setData('created_by', $admin)
                                ->setStatus(0)
                        ;
                    }
                    //confirm
                    if ($this->getRequest()->getParam('confirm')) {
                        if ($this->getRequest()->getParam('id'))
                            $model->load($this->getRequest()->getParam('id'));
                        $model->setData('reason', $data['reason'])
                                ->setData('confirmed_by', $admin)
                                ->setData('confirmed_at', now())
                                ->setStatus(1);
                    }
                    $model->save();
                    Mage::helper('inventoryplus/adjuststock')->adjustStockData($data, $warehouse_id, $model, $this->getRequest()->getParam('confirm'));
                } else {
                    Mage::getSingleton('adminhtml/session')->addError(
                            Mage::helper('inventoryplus')->__('Cannot save stock adjustment with no product')
                    );
                    if (!$this->getRequest()->getParam('id')) {
                        $this->_redirect('inventoryplusadmin/adminhtml_adjuststock/new');
                        return;
                    } else {
                        if ($this->getRequest()->getParam('back')) {
                            $this->_redirect('*/*/edit', array('id' => $model->getId()));
                            return;
                        }
                        $this->_redirect('*/*/');
                        return;
                    }
                }

                if ($this->getRequest()->getParam('confirm')) {
                    Mage::getSingleton('adminhtml/session')->addSuccess(
                            Mage::helper('inventoryplus')->__('The stock adjustment has been successfully confirmed.')
                    );
                } else {
                    Mage::getSingleton('adminhtml/session')->addSuccess(
                            Mage::helper('inventoryplus')->__('The stock adjustment has been successfully saved.')
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
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventoryplus')->__('Unable to find adjust stock to create')
        );
        $this->_redirect('*/*/');
    }

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('inventoryplus');
    }

    /**
     * export grid item to CSV type
     */
    public function exportCsvAction() {
        $fileName = 'adjustment.csv';
        $content = $this->getLayout()
                ->createBlock('inventoryplus/adminhtml_adjuststock_listadjuststock_grid')
                ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export grid item to XML type
     */
    public function exportXmlAction() {
        $fileName = 'adjustment.xml';
        $content = $this->getLayout()
                ->createBlock('inventoryplus/adminhtml_adjuststock_listadjuststock_grid')
                ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

}
