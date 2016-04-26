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
class Magestore_Inventorypurchasing_Adminhtml_SupplierController extends Mage_Adminhtml_Controller_Action {

    /**
     * init layout and set active for current menu
     *
     * @return Magestore_Inventorypurchasing_Adminhtml_InventorypurchasingController
     */
    protected function _initAction() {
        $this->loadLayout()->_setActiveMenu('inventoryplus')
                ->_addBreadcrumb(
                        Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager')
        );
        $this->_title($this->__('Inventory'))
                    ->_title($this->__('Manage Suppliers'));
        return $this;
    }

    /**
     * index action
     */
    public function indexAction() {
        $this->_initAction()
                ->renderLayout();
    }

    /**
     * view and edit item action
     */
    public function editAction() {
        $inventorypurchasingId = $this->getRequest()->getParam('id');
        $model = Mage::getModel('inventorypurchasing/supplier')->load($inventorypurchasingId);
        
        if(!$inventorypurchasingId){
            $this->_title($this->__('Inventory'))
                    ->_title($this->__('Add New Supplier'));
        }else{
            $this->_title($this->__('Inventory'))
                    ->_title($this->__('Edit Supplier'));
        }
        
        if ($model->getId() || $inventorypurchasingId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('inventorypurchasing_supplier_data', $model);

            $this->loadLayout()->_setActiveMenu('inventoryplus');

            $this->_addBreadcrumb(
                    Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager')
            );
            $this->_addBreadcrumb(
                    Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News')
            );

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true)
					->removeItem('js', 'mage/adminhtml/grid.js')
                    ->addItem('js', 'magestore/adminhtml/inventory/grid.js');
            $this->_addContent($this->getLayout()->createBlock('inventorypurchasing/adminhtml_supplier_edit'))
                    ->_addLeft($this->getLayout()->createBlock('inventorypurchasing/adminhtml_supplier_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventorypurchasing')->__('Item does not exist')
            );
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function getFiledSaveHistory() {
        return array('supplier_name', 'contact_name', 'supplier_email', 'telephone', 'fax', 'street', 'city', 'country_id', 'state', 'state_id', 'postcode', 'description', 'website', 'created_by', 'created_time', 'updated_time', 'supplier_status');
    }

    /**
     * save item action
     */
    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('inventorypurchasing/supplier')->load($this->getRequest()->getParam('id'));
            if ($this->getRequest()->getParam('id')) {
                $data['created_by'] = $model->getData('created_by');
            }
            $model->addData($data);

            try {

                //check field changed
                if ($this->getRequest()->getParam('id')) {
                    $oldData = Mage::getModel('inventorypurchasing/supplier')->load($this->getRequest()->getParam('id'));
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

                $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                if (!$this->getRequest()->getParam('id')) {
                    $model->setData('created_by', $admin);
                }
                
                Mage::dispatchEvent('controller_supplier_save_before', array('model' => $model,'datas'=>$data)); 
                
                $model->save();


                $resource = Mage::getSingleton('core/resource');

                $writeConnection = $resource->getConnection('core_write');

                $installer = Mage::getModel('core/resource');

                $sqlNews = array();
                $sqlOlds = '';
                $countSqlOlds = 0;
                $productChangeds = array();
                $productNews = array();
                $productDeleteds = '';

                if (isset($data['supplier_products'])) {
                    $supplierProducts = array();
                    $supplierProductsExplodes = explode('&', urldecode($data['supplier_products']));
                    if (count($supplierProductsExplodes) <= 900) {
                        parse_str(urldecode($data['supplier_products']), $supplierProducts);
                    } else {
                        foreach ($supplierProductsExplodes as $supplierProductsExplode) {
                            $supplierProduct = '';
                            parse_str($supplierProductsExplode, $supplierProduct);
                            $supplierProducts = $supplierProducts + $supplierProduct;
                        }
                    }
                    
                    if (count($supplierProducts)) {
                        $productIds = '';
                        $qtys = '';
                        $count = 0;
                        foreach ($supplierProducts as $pId => $enCoded) {
                            $codeArr = array();
                            parse_str(base64_decode($enCoded), $codeArr);
                            $supplierProductItem = Mage::getModel('inventorypurchasing/supplier_product')
                                    ->getCollection()
                                    ->addFieldToFilter('supplier_id', $model->getId())
                                    ->addFieldToFilter('product_id', $pId)
                                    ->getFirstItem();
                            $productIds[] = $pId;
                            if ($supplierProductItem->getId()) {
                                $countSqlOlds++;
                                if (($codeArr['cost'] == $supplierProductItem->getCost()) && ($codeArr['discount'] == $supplierProductItem->getDiscount()) && ($codeArr['tax'] == $supplierProductItem->getTax()) && ($codeArr['supplier_sku'] == $supplierProductItem->getSupplierSku()))
                                    continue;
                                
                                
                                $productChangeds[$pId]['old_cost'] = $supplierProductItem->getCost();
                                $productChangeds[$pId]['new_cost'] = $codeArr['cost'];
                                $productChangeds[$pId]['old_discount'] = $supplierProductItem->getDiscount();
                                $productChangeds[$pId]['new_discount'] = $codeArr['discount'];
                                $productChangeds[$pId]['old_tax'] = $supplierProductItem->getDiscount();
                                $productChangeds[$pId]['new_tax'] = $codeArr['tax'];
                                $productChangeds[$pId]['old_suppliersku'] = $supplierProductItem->getSupplierSku();
                                
                                $productChangeds[$pId]['new_suppliersku'] = $codeArr['supplier_sku'];
                                
                                $sqlOlds .= 'UPDATE ' . $installer->getTableName('inventorypurchasing/supplier_product') . ' 
                                                                        SET `cost` = \'' . $codeArr['cost'] . '\',
                                                                                `discount` = \'' . $codeArr['discount'] . '\',
                                                                                `tax` = \'' . $codeArr['tax'] . '\',
                                                                                `supplier_sku` = \'' . $codeArr['supplier_sku'] . '\'
                                                                                WHERE `supplier_product_id` =' . $supplierProductItem->getId() . ';';
                                if ($countSqlOlds == 900) {
                                    $writeConnection->query($sqlOlds);
                                    $countSqlOlds = 0;
                                }
                            } else {
                                $productNews[$pId]['new_cost'] = $codeArr['cost'];
                                $productNews[$pId]['new_discount'] = $codeArr['discount'];
                                $productNews[$pId]['new_tax'] = $codeArr['tax'];
                                $productNews[$pId]['new_suppliersku'] = $codeArr['supplier_sku'];
                                $sqlNews[] = array(
                                    'product_id' => $pId,
                                    'supplier_id' => $model->getId(),
                                    'discount' => $codeArr['discount'],
                                    'tax' => $codeArr['tax'],
                                    'cost' => $codeArr['cost'],
                                    'supplier_sku' => $codeArr['supplier_sku']
                                );
                                if (count($sqlNews) == 1000) {
                                    $writeConnection->insertMultiple($installer->getTableName('inventorypurchasing/supplier_product'), $sqlNews);
                                    $sqlNews = array();
                                }
                            }
                        }
                        if (!empty($sqlNews)) {
                            $writeConnection->insertMultiple($installer->getTableName('inventorypurchasing/supplier_product'), $sqlNews);
                        }
                        if (!empty($sqlOlds)) {
                            $writeConnection->query($sqlOlds);
                        }
                        $writeConnection->commit();
                        $productDeletes = Mage::getModel('inventorypurchasing/supplier_product')->getCollection()
                                ->addFieldToFilter('supplier_id', $model->getId())                     
                                ->addFieldToFilter('product_id', array('nin' => $productIds));
                        if (count($productDeletes) > 0) {
                            $i = 0;
                            foreach ($productDeletes as $productDelete) {
                                if ($i != 0)
                                    $productDeleteds .= ', ';
                                $productDeleteds .= Mage::helper('inventoryplus/warehouse')->getProductSkuByProductId($productDelete->getProductId());
                                $productDelete->delete();
                            }
                        }
                    }else{
                        $productDeletes = Mage::getModel('inventorypurchasing/supplier_product')->getCollection()
                                ->addFieldToFilter('supplier_id', $model->getId());
                      
                                
                        if (count($productDeletes) > 0) {
                            $i = 0;
                            foreach ($productDeletes as $productDelete) {
                                if ($i != 0)
                                    $productDeleteds .= ', ';
                                $productDeleteds .= Mage::helper('inventoryplus/warehouse')->getProductSkuByProductId($productDelete->getProductId());
                                $productDelete->delete();
                            }
                        }
                    }
                }

                //save histoty change
                $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                if (!$this->getRequest()->getParam('id')) {
                    $supplierHistory = Mage::getModel('inventorypurchasing/supplier_history');
                    $supplierHistoryContent = Mage::getModel('inventorypurchasing/supplier_historycontent');
                    $supplierHistory->setData('supplier_id', $model->getId())
                            ->setData('time_stamp', now())
                            ->setData('created_by', $admin)
                            ->save();
                    $supplierHistoryContent->setData('supplier_history_id', $supplierHistory->getId())
                            ->setData('field_name', Mage::helper('inventorypurchasing')->__('%s created this supplier.',$admin))
                            ->save();
                } else {
                    if ($changeData == 1 || $productDeleteds || count($productChangeds) || count($productNews)) {
                        $supplierHistory = Mage::getModel('inventorypurchasing/supplier_history');
                        $supplierHistory->setData('supplier_id', $model->getId())
                                ->setData('time_stamp', now())
                                ->setData('created_by', $admin)
                                ->save();
                        $supplierHistoryId = $supplierHistory->getId();

                        if (count($productChangeds)) {
                            foreach ($productChangeds as $key => $value) {
                                $newValue = '';
                                $oldValue = '';
                                if ($value['new_cost'])
                                    $newValue .= '| ' . Mage::helper('inventorypurchasing')->__('Cost: %s',round(floatval($value['new_cost']), 2)) . ' |';
                                if ($value['new_discount'])
                                    $newValue .= '| ' . Mage::helper('inventorypurchasing')->__('Discount: %s',round(floatval($value['new_discount']), 2)) . ' |';
                                if ($value['new_tax'])
                                    $newValue .= '| ' . Mage::helper('inventorypurchasing')->__('Tax: %s',round(floatval($value['new_tax']), 2)) . ' |';
                                if ($value['new_suppliersku'])
                                    $newValue .= '| ' . Mage::helper('inventorypurchasing')->__('Supplier SKU: %s', $value['new_suppliersku']) . ' |';
                                if ($value['old_cost'])
                                    $oldValue .= '| ' . Mage::helper('inventorypurchasing')->__('Cost: %s', round(floatval($value['old_cost']), 2)) . ' |';
                                if ($value['old_discount'])
                                    $oldValue .= '| ' . Mage::helper('inventorypurchasing')->__('Discount: %s',round(floatval($value['old_discount']), 2)) . ' |';
                                if ($value['old_tax'])
                                    $oldValue .= '| ' . Mage::helper('inventorypurchasing')->__('Tax: %s',round(floatval($value['old_tax']), 2)) . ' |';
                                if ($value['old_suppliersku'])
                                    $oldValue .= '| ' . Mage::helper('inventorypurchasing')->__('Supplier SKU: %s',$value['old_suppliersku']) . ' |';

                                $productSku = Mage::helper('inventoryplus/warehouse')->getProductSkuByProductId($key);
                                $supplierHistoryContent = Mage::getModel('inventorypurchasing/supplier_historycontent');
                               
                                $supplierHistoryContent->setData('supplier_history_id', $supplierHistoryId)
                                        ->setData('field_name', Mage::helper('inventorypurchasing')->__('Changed product(s) with the following SKU(s): %s',$productSku))
                                        ->setData('old_value', $oldValue)
                                        ->setData('new_value', $newValue)
                                        ->save();
                            }
                        }
                        if (count($productNews)) {
                            foreach ($productNews as $key => $value) {
                                $newValue = '';
                                $oldValue = '';
                                if ($value['new_cost'])
                                    $newValue .= '| ' . Mage::helper('inventorypurchasing')->__('Cost: %s', round(floatval($value['new_cost']), 2)) . ' |';
                                if ($value['new_discount'])
                                    $newValue .= '| ' . Mage::helper('inventorypurchasing')->__('Discount: %s', round(floatval($value['new_discount']), 2)) . ' |';
                                if ($value['new_tax'])
                                    $newValue .= '| ' . Mage::helper('inventorypurchasing')->__('Tax: %s', round(floatval($value['new_tax']), 2)) . ' |';
                                if ($value['new_suppliersku'])
                                    $newValue .= '| ' . Mage::helper('inventorypurchasing')->__('Supplier SKU: %s', $value['new_suppliersku']) . ' |';
                                $productSku = Mage::helper('inventoryplus/warehouse')->getProductSkuByProductId($key);
                                $supplierHistoryContent = Mage::getModel('inventorypurchasing/supplier_historycontent');
                                $supplierHistoryContent->setData('supplier_history_id', $supplierHistoryId)
                                        ->setData('field_name', Mage::helper('inventorypurchasing')->__('Add product sku : %s for this supplier',$productSku))
                                        ->setData('old_value', $oldValue)
                                        ->setData('new_value', $newValue)
                                        ->save();
                            }
                        }
                        if ($productDeleteds) {
                            $supplierHistoryContent = Mage::getModel('inventorypurchasing/supplier_historycontent');
                            $supplierHistoryContent->setData('supplier_history_id', $supplierHistoryId)
                                    ->setData('field_name', Mage::helper('inventorypurchasing')->__('%s removed product(s) from this supplier.'))
                                    ->setData('new_value', Mage::helper('inventorypurchasing')->__('Remove product sku(s): %s',$productDeleteds))
                                    ->save();
                        }
                        if ($changeData == 1) {
                            foreach ($changeArray as $field => $filedValue) {
                                $fileTitle = $this->getTitleByField($field);
                                
                                    
                                if ($field == 'status') {
                                    $statusArray = Mage::getSingleton('inventorypurchasing/status')->getOptionHash();
                                    $filedValue['old'] = $statusArray[$filedValue['old']];
                                    $filedValue['new'] = $statusArray[$filedValue['new']];
                                } else if ($field == 'country_id') {
                                    $countryArray = array();
                                    $countryArrays = Mage::helper('inventoryplus/warehouse')->getCountryListHash();
                                    foreach ($countryArrays as $country) {
                                        $countryArray[$country['value']] = $country['label'];
                                    }
                                    $filedValue['old'] = $countryArray[$filedValue['old']];
                                    $filedValue['new'] = $countryArray[$filedValue['new']];
                                } else if ($field == 'state') {
                                    
                                    $oldRegion = Mage::getModel('directory/region')->load($filedValue['old']);
                                    $oldRegionName = $oldRegion->getName();
                                    if (!$oldRegionName || $oldRegionName == '') {
                                        $oldRegionName = $filedValue['old'];
                                    }
                                    $newRegion = Mage::getModel('directory/region')->load($filedValue['new']);
                                    $newRegionName = $newRegion->getName();
                                    if (!$newRegionName || $newRegionName == '') {
                                        $newRegionName = $filedValue['new'];
                                    }
                                    $filedValue['old'] = $oldRegionName;
                                    $filedValue['new'] = $newRegionName;
                                  
                                }
                                

                                $supplierHistoryContent = Mage::getModel('inventorypurchasing/supplier_historycontent');
                                $supplierHistoryContent->setData('supplier_history_id', $supplierHistoryId)
                                        ->setData('field_name', $fileTitle)
                                        ->setData('old_value', $filedValue['old'])
                                        ->setData('new_value', $filedValue['new'])
                                        ->save();
                            } 
                        }
                    }
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('inventorypurchasing')->__('Supplier was successfully saved!')
                );
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
                Mage::helper('inventorypurchasing')->__('Unable to find supplier to save!')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete item action
     */
    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('inventorypurchasing/supplier');
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
    public function massDeleteAction() {
        $supplierIds = $this->getRequest()->getParam('supplier_ids');
        if (!is_array($supplierIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($supplierIds as $supplierId) {
                    $supplierModel = Mage::getModel('inventorypurchasing/supplier')->load($supplierId);
                    $supplierModel->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted', count($supplierIds))
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
        $supplierIds = $this->getRequest()->getParam('supplier_ids');
        if (!is_array($supplierIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($supplierIds as $supplierId) {
                    Mage::getSingleton('inventorypurchasing/supplier')
                            ->load($supplierId)
                            ->setSupplierStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) were successfully updated', count($supplierIds))
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
        $fileName = 'supplier.csv';
        $content = $this->getLayout()
                ->createBlock('inventorypurchasing/adminhtml_supplier_grid')
                ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export grid item to XML type
     */
    public function exportXmlAction() {
        $fileName = 'supplier.xml';
        $content = $this->getLayout()
                ->createBlock('inventorypurchasing/adminhtml_supplier_grid')
                ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('inventoryplus');
    }

    public function productAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.supplier.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('supplier_products', null));
        $this->renderLayout();
        if (Mage::getModel('admin/session')->getData('supplier_product_import'))
            Mage::getModel('admin/session')->setData('supplier_product_import', null);
    }

    public function productGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.supplier.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('supplier_products', null));
        $this->renderLayout();
    }

    public function importproductAction() {
        if (isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] != '') {
            try {
                $fileName = $_FILES['fileToUpload']['tmp_name'];
                $Object = new Varien_File_Csv();
                $dataFile = $Object->getData($fileName);
                $supplierProduct = array();
                $supplierProducts = array();
                $fields = array();
                $count = 0;
                $supplierHelper = Mage::helper('inventorypurchasing/supplier');
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
                                        $supplierProduct[$fields[$index]] = $cell;
                                    }
                                }
                            $supplierProducts[] = $supplierProduct;
                        }
                    }

                $supplierHelper->importProduct($supplierProducts);
            } catch (Exception $e) {
                
            }
        }
    }
    
    public function showhistoryAction() {
        $form_html = $this->getLayout()
            ->createBlock('inventorypurchasing/adminhtml_supplier')
            ->setTemplate('inventorypurchasing/supplier/showhistory.phtml')
            ->toHtml();
        $this->getResponse()->setBody($form_html);
    }
    
    public function historyAction() {
        $this->loadLayout();
        $this->renderLayout();
    }	
    public function historyGridAction() {
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function returnorderAction() {
        $this->loadLayout();
	$this->getLayout()->getBlock('inventorypurchasing.supplier.edit.tab.returnorder');
        $this->renderLayout();
    }	
    public function returnorderGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.supplier.edit.tab.returnorder');
        $this->renderLayout();
    }
    
    public function purchaseorderAction() {
        $this->loadLayout();
	$this->getLayout()->getBlock('inventorypurchasing.supplier.edit.tab.purchaseorder');
        $this->renderLayout();
    }	
    public function purchaseorderGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('inventorypurchasing.supplier.edit.tab.purchaseorder');
        $this->renderLayout();
    }
    
    public function getTitleByField($field)
    {
        $fieldArray = array(
                            'name' => Mage::helper('inventorypurchasing')->__('Supplier Name '),
                            'contact_name' => Mage::helper('inventorypurchasing')->__('Contact Person'),
                            'email' => Mage::helper('inventorypurchasing')->__('Email'),
                            'telephone'  => Mage::helper('inventorypurchasing')->__('Telephone'),
                            'fax' => Mage::helper('inventorypurchasing')->__('Fax'),
                            'street' => Mage::helper('inventorypurchasing')->__('Street'),
                            'city' => Mage::helper('inventorypurchasing')->__('City'),
                            'country_id' => Mage::helper('inventorypurchasing')->__('Country'),
                            'state' => Mage::helper('inventorypurchasing')->__('State/Province'),
                            'postcode' => Mage::helper('inventorypurchasing')->__('Zip/Postal Code'),
                            'website' => Mage::helper('inventorypurchasing')->__('Website'),
                            'description' => Mage::helper('inventorypurchasing')->__('Description'),
                            'status' => Mage::helper('inventorypurchasing')->__('Status')
                        );
        if(!$fieldArray[$field]) return $field;
        return $fieldArray[$field];
    }
	public function exportProductsCsvAction() {
        $fileName = 'supplier_products.csv';
        $content = $this->getLayout()
                ->createBlock('inventorypurchasing/adminhtml_supplier_edit_tab_products')
                ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    public function exportProductsXmlAction() {
        $fileName = 'supplier_products.xml';
        $content = $this->getLayout()
                ->createBlock('inventorypurchasing/adminhtml_supplier_edit_tab_products')
                ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }
}
