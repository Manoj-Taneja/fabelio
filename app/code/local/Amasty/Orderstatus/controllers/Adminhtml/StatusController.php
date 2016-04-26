<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Adminhtml_StatusController extends Mage_Adminhtml_Controller_Action
{
    protected $_entityTypeId;

    public function preDispatch()
    {
        parent::preDispatch();
    }

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('sales/amorderstatus')
            ->_addBreadcrumb(Mage::helper('amorderstatus')->__('Sales'), Mage::helper('amorderstatus')->__('Sales'))
            ->_addBreadcrumb(Mage::helper('amorderstatus')->__('Order Statuses'), Mage::helper('amorderstatus')->__('Order Statuses'))
        ;
        return $this;
    }
    
    public function indexAction()
    {
        $this->_initAction()
             ->_addContent($this->getLayout()->createBlock('amorderstatus/adminhtml_status'))
             ->renderLayout();
    }
    
    public function editAction()
    {
        $this->_initAction();
        
        $this->_addContent($this->getLayout()->createBlock('amorderstatus/adminhtml_status_edit'))
                ->_addLeft($this->getLayout()->createBlock('amorderstatus/adminhtml_status_edit_tabs'));
        $this->renderLayout();
    }
    
    public function saveAction()
    {
        $this->_initAction();
        
        $model = Mage::getModel('amorderstatus/status');
        $alias = '';
        if ($id = $this->getRequest()->getParam('id')) {
            $model->load($id);
            $alias = $model->getAlias();
        }
        try {
            
            $data = $this->getRequest()->getPost();
            $data['parent_state'] = implode(',', $data['parent_state']);
            $model->setData($data);
            if ($id) {
                $model->setId($id);
                $model->setAlias($alias);
            }
            $storeEmailTemplate = array();
            if (isset($data['store_template'])) {
                $storeEmailTemplate = $data['store_template'];
                unset($data['store_template']);
            }
            $model->save();
            Mage::getModel('amorderstatus/status_template')->saveTemplates($storeEmailTemplate, $model);
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('amorderstatus')->__('The status has been saved.'));
            $this->_redirect('*/*');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
        }
    }
    
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('amorderstatus/status');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('amorderstatus')->__('The status has been deleted.'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('amorderstatus')->__('Unable to find status to delete.'));
        $this->_redirect('*/*/');
    }
    
    public function systemAction()
    {
        $this->_initAction()
             ->_addContent($this->getLayout()->createBlock('amorderstatus/adminhtml_system_status'))
             ->renderLayout();
    }
    
    public function systemSaveAction()
    {
        $statuses = $this->getRequest()->getParam('system');
        
        if (is_array($statuses)
            && !empty($statuses)) {
            foreach ($statuses as $alias => $title) {
                $model = Mage::getModel('amorderstatus/status');
                $model->load($alias, 'alias');
                if ($title) {
                    $model->setAlias($alias);
                    $model->setStatus($title);
                    $model->setIsSystem(1);
                    $model->save();
                } else {
                    if ($model->getId()) {
                        $model->delete();
                    }
                }
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('amorderstatus')->__('The statuses have been saved.'));
            $this->_redirect('*/*/system');
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('amorderstatus')->__('Unable to find statuses to save.'));
        $this->_redirect('*/*/system');
    }
}