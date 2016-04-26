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
class Magestore_Inventorypurchasing_Adminhtml_ShippingmethodsController extends Mage_Adminhtml_Controller_Action {

     /**
     * init layout and set active for current menu
     *
     * @return Magestore_Inventory_Adminhtml_SupplierController
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('inventoryplus')
            ->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Manage Shipping Methods'),
                Mage::helper('adminhtml')->__('Manage Shipping Methods')
            );
        $this->_title($this->__('Inventory'))
             ->_title($this->__('Manage Shipping Methods'));
        return $this;
    }
 
    /**
     * index action
     */
    public function indexAction()
    {
        $this->_initAction()
            ->renderLayout();
    }
       
    /**
     * view and edit item action
     */
    public function editAction()
    {
        
        
        $shippingMethodId     = $this->getRequest()->getParam('id');
        
        if(!$shippingMethodId){
            $this->_title($this->__('Inventory'))
                    ->_title($this->__('Add New Shipping Method'));
        }else{
            $this->_title($this->__('Inventory'))
                    ->_title($this->__('Edit Shipping Method'));
        }
        
        $model  = Mage::getModel('inventorypurchasing/shippingmethod')->load($shippingMethodId);

        if ($model->getId() || $shippingMethodId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('shippingmethod_data', $model);

            $this->loadLayout()->_setActiveMenu('inventoryplus');
            $this->_setActiveMenu('inventoryplus');

            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Manage Shipping Method'),
                Mage::helper('adminhtml')->__('Manage Shippineg Method')
            );
            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Shipping Method News'),
                Mage::helper('adminhtml')->__('Shipping Method News')
            );

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('inventorypurchasing/adminhtml_shippingmethod_edit'))
                ->_addLeft($this->getLayout()->createBlock('inventorypurchasing/adminhtml_shippingmethod_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventorypurchasing')->__('Item does not exist')
            );
            $this->_redirect('*/*/');
        }
    }
 
    public function newAction()
    {
	
        $this->_forward('edit');
    }
 
    /**
     * save item action
     */
     public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {        
            $model = Mage::getModel('inventorypurchasing/shippingmethod');        
           
            if($this->getRequest()->getParam('id')){
//                $model = $model->load($this->getRequest()->getParam('id'));
                $data['created_by'] = $model->getData('created_by');
            }
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));
            try {
                if($this->getRequest()->getParam('id')){
                    $oldData = Mage::getModel('inventorypurchasing/shippingmethod')->load($this->getRequest()->getParam('id'));
                    $changeArray = array();
                    $changeData = 0;
                    foreach($data as $key=>$value){
                        if(!in_array($key,$this->getFiledSaveHistory())) continue;
                        if($oldData->getData($key) != $value){
                            $changeArray[$key]['old'] = $oldData->getData($key);
                            $changeArray[$key]['new'] = $value;
                            $changeData = 1;
                        }
                    }
                }
                $admin = Mage::getModel('admin/session')->getUser()->getUsername();
                if(!$this->getRequest()->getParam('id')){
                    $model->setData('created_by',$admin);
                }
                $model->save();
                if(!$this->getRequest()->getParam('id')){
                    $shippingMethodHistory = Mage::getModel('inventorypurchasing/shippingmethod_history');
                    $shippingMethodHistoryContent = Mage::getModel('inventorypurchasing/shippingmethod_historycontent');
                    $shippingMethodHistory->setData('shipping_method_id',$model->getId())
                                          ->setData('time_stamp',now())
                                          ->setData('created_by',$admin)
                                          ->save();
                    $shippingMethodHistoryContent->setData('shipping_method_history_id',$shippingMethodHistory->getId())
                                                 ->setData('field_name',Mage::helper('inventorypurchasing')->__('%s created this shipping method.', $admin))
                                                 ->save();
                }else{
                    if($changeData == 1){
                        $shippingMethodHistory = Mage::getModel('inventorypurchasing/shippingmethod_history');
                        $shippingMethodHistory->setData('shipping_method_id',$model->getId())
                                              ->setData('time_stamp',now())
                                              ->setData('created_by',$admin)
                                              ->save();
                        foreach($changeArray as $field=>$filedValue){
                            $fileTitle = $this->getTitleByField($field);
                            if($field == 'shipping_method_status'){
                                $statusArray = array(
                                                    1 => Mage::helper('inventorypurchasing')->__('Active'),
                                                    0 => Mage::helper('inventorypurchasing')->__('Inactive'), 
                                                );
                                $filedValue['old'] = $statusArray[$filedValue['old']];
                                $filedValue['new'] = $statusArray[$filedValue['new']];
                            }
                            $shippingMethodHistoryContent = Mage::getModel('inventorypurchasing/shippingmethod_historycontent');
                            $shippingMethodHistoryContent->setData('shipping_method_history_id',$shippingMethodHistory->getId())
                                                         ->setData('field_name',$fileTitle)
                                                         ->setData('old_value',$filedValue['old'])
                                                         ->setData('new_value',$filedValue['new'])
                                                         ->save();
                        }
                    }
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('inventorypurchasing')->__('Shipping Method was successfully saved!')
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
            Mage::helper('inventorypurchasing')->__('Unable to find shipping method to save!')
        );
        $this->_redirect('*/*/');
    }
    
    public function getTitleByField($field)
    {
        $fieldArray = array(
                            'shipping_method_name'=>Mage::helper('inventorypurchasing')->__('Shipping Method Name'),
                            'description'=>Mage::helper('inventorypurchasing')->__('Description'),
                            'shipping_method_status' => Mage::helper('inventorypurchasing')->__('Status'),
                            'created_by' => Mage::helper('inventorypurchasing')->__('Create By')
                        );
        if(!$fieldArray[$field]) return $field;
        return $fieldArray[$field];
    }
    
    public function getFiledSaveHistory()
    {
        return array('shipping_method_name','description','shipping_method_status');
    }
    
    /**
     * delete item action
     */
    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('inventorypurchasing/shippingmethod');
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Shipping Method was successfully deleted!')
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
        $shippingMethodIds = $this->getRequest()->getParam('shippingmethod_ids');
        if (!is_array($shippingMethodIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select shipping method(s)!'));
        } else {
            try {
                foreach ($shippingMethodIds as $shippingMethodId) {
                    $supplier = Mage::getModel('inventorypurchasing/shippingmethod')->load($shippingMethodId);
                    $supplier->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total %d record(s) were successfully deleted',
                    count($shippingMethodIds))
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
        $shippingMethodIds = $this->getRequest()->getParam('shippingmethod_ids');
       
        if (!is_array($shippingMethodIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select shipping method(s)'));
        } else {
            try {
                foreach ($shippingMethodIds as $shippingMethodId) {
                     
                    Mage::getSingleton('inventorypurchasing/shippingmethod')
                        ->load($shippingMethodId)
                        ->setShippingMethodStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total %d record(s) were successfully updated', count($shippingMethodIds))
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
        $fileName   = 'shippingmethod.csv';
        $content    = $this->getLayout()
                           ->createBlock('inventorypurchasing/adminhtml_shippingmethod_grid')
                           ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export grid item to XML type
     */
    public function exportXmlAction()
    {
        $fileName   = 'shippingmethod.xml';
        $content    = $this->getLayout()
                           ->createBlock('inventorypurchasing/adminhtml_shippingmethod_grid')
                           ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
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
            ->createBlock('inventorypurchasing/adminhtml_shippingmethod')
            ->setTemplate('inventorypurchasing/shippingmethod/showhistory.phtml')
            ->toHtml();
        $this->getResponse()->setBody($form_html);
    }
    
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('inventoryplus');
    }

}
