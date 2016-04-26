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
class Magestore_Inventorypurchasing_Adminhtml_PaymenttermsController extends Mage_Adminhtml_Controller_Action {

    /**
     * init layout and set active for current menu
     *
     * @return Magestore_Inventorypurchasing_Adminhtml_PaymenttermsController 
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('inventoryplus')
            ->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Manage Payment Terms'),
                Mage::helper('adminhtml')->__('Manage Payment Terms')
            );
        $this->_title($this->__('Inventory'))
                    ->_title($this->__('Manage Payment Terms'));
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
        $paymentTermId     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('inventorypurchasing/paymentterm')->load($paymentTermId);
        if(!$paymentTermId){
            $this->_title($this->__('Inventory'))
                    ->_title($this->__('Add New Payment Term'));
        }  else {
            $this->_title($this->__('Inventory'))
                    ->_title($this->__('Edit Payment Term'));
        }
        if ($model->getId() || $paymentTermId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('paymentterm_data', $model);

            $this->loadLayout()->_setActiveMenu('inventoryplus');
            $this->_setActiveMenu('inventoryplus');

            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Manage Payment Term'),
                Mage::helper('adminhtml')->__('Manage Payment Term')
            );
            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Payment Term News'),
                Mage::helper('adminhtml')->__('Payment Term News')
            );

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('inventorypurchasing/adminhtml_paymentterm_edit'))
                ->_addLeft($this->getLayout()->createBlock('inventorypurchasing/adminhtml_paymentterm_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventorypurchasing')->__('Payment term does not exist')
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
            $model = Mage::getModel('inventorypurchasing/paymentterm');        
            if($this->getRequest()->getParam('id')){
                $data['created_by'] = $model->getData('created_by');
            }
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));
            try {
                if($this->getRequest()->getParam('id')){
                    $oldData = Mage::getModel('inventorypurchasing/paymentterm')->load($this->getRequest()->getParam('id'));
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
                    $paymentTermHistory = Mage::getModel('inventorypurchasing/paymentterm_history');
                    $paymentTermHistoryContent = Mage::getModel('inventorypurchasing/paymentterm_historycontent');
                    $paymentTermHistory->setData('payment_term_id',$model->getId())
                                          ->setData('time_stamp',now())
                                          ->setData('created_by',$admin)
                                          ->save();
                    $paymentTermHistoryContent->setData('payment_term_history_id',$paymentTermHistory->getId())
                                              ->setData('field_name',Mage::helper('inventorypurchasing')->__('%s created this payment term.',$admin))
                                              ->save();
                }else{
                    if($changeData == 1){
                        $paymentTermHistory = Mage::getModel('inventorypurchasing/paymentterm_history');
                        $paymentTermHistory->setData('payment_term_id',$model->getId())
                                           ->setData('time_stamp',now())
                                           ->setData('created_by',$admin)
                                           ->save();
                        foreach($changeArray as $field=>$filedValue){
                            $fileTitle = $this->getTitleByField($field);
                            if($field == 'status'){
                                $statusArray = array(
                                                    1 => Mage::helper('inventorypurchasing')->__('Active'),
                                                    0 => Mage::helper('inventorypurchasing')->__('Inactive'), 
                                                );
                                $filedValue['old'] = $statusArray[$filedValue['old']];
                                $filedValue['new'] = $statusArray[$filedValue['new']];
                            }
                            $paymentTermHistoryContent = Mage::getModel('inventorypurchasing/paymentterm_historycontent');
                            $paymentTermHistoryContent->setData('payment_term_history_id',$paymentTermHistory->getId())
                                                      ->setData('field_name',$fileTitle)
                                                      ->setData('old_value',$filedValue['old'])
                                                      ->setData('new_value',$filedValue['new'])
                                                      ->save();
                        }
                    }
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('inventorypurchasing')->__('Payment Term was successfully saved!')
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
            Mage::helper('inventorypurchasing')->__('Unable to find payment term to save!')
        );
        $this->_redirect('*/*/');
    }
    
    public function getTitleByField($field)
    {
        $fieldArray = array(
                            'payment_term_name'=>Mage::helper('inventorypurchasing')->__('Payment term name'),
                            'description'=>Mage::helper('inventorypurchasing')->__('Description'),
                            'payment_term_status' => Mage::helper('inventorypurchasing')->__('Status'),
                            'payment_days' => Mage::helper('inventorypurchasing')->__('Payment Period'),
                            'created_by' => Mage::helper('inventorypurchasing')->__('Create By')
                        );
        if(!$fieldArray[$field]) return $field;
        return $fieldArray[$field];
    }
    
    public function getFiledSaveHistory()
    {
        return array('payment_term_name','description','payment_days','payment_term_');
    }
    
    /**
     * delete item action
     */
    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('inventorypurchasing/paymentterm');
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Payment Term was successfully deleted!')
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
        $paymentTermIds = $this->getRequest()->getParam('paymentterm_ids');
        if (!is_array($paymentTermIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select payment term(s)!'));
        } else {
            try {
                foreach ($paymentTermIds as $paymentTermId) {
                    $supplier = Mage::getModel('inventorypurchasing/paymentterm')->load($paymentTermId);
                    $supplier->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total %d record(s) were successfully deleted',
                    count($paymentTermIds))
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
        $paymentTermIds = $this->getRequest()->getParam('paymentterm_ids');
        if (!is_array($paymentTermIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select payment term(s)'));
        } else {
            try {
                foreach ($paymentTermIds as $paymentTermId) {
                    Mage::getSingleton('inventorypurchasing/paymentterm')
                        ->load($paymentTermId)
                        ->setPaymentTermStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total %d record(s) were successfully updated', count($paymentTermIds))
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
        $fileName   = 'paymentterm.csv';
        $content    = $this->getLayout()
                           ->createBlock('inventorypurchasing/adminhtml_paymentterm_grid')
                           ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export grid item to XML type
     */
    public function exportXmlAction()
    {
        $fileName   = 'paymentterm.xml';
        $content    = $this->getLayout()
                           ->createBlock('inventorypurchasing/adminhtml_paymentterm_grid')
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
            ->createBlock('inventorypurchasing/adminhtml_paymentterm')
            ->setTemplate('inventorypurchasing/paymentterm/showhistory.phtml')
            ->toHtml();
        $this->getResponse()->setBody($form_html);
    }
    
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('inventoryplus');
    }

}
