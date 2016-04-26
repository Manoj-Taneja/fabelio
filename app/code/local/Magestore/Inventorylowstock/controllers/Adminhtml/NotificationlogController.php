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
class Magestore_Inventorylowstock_Adminhtml_NotificationlogController extends Mage_Adminhtml_Controller_Action {

    /**
     * init layout and set active for current menu
     *
     * @return Magestore_Inventorylowstock_Adminhtml_NotificationlogController
     */
    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('inventoryplus')
                ->_addBreadcrumb(
                        Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager')
        );
        $this->_title($this->__('Inventory'))
             ->_title($this->__('Manage Notification'));
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
     * export grid item to CSV type
     */
    public function exportCsvAction() {
        $fileName = 'notificationlog.csv';
        $content = $this->getLayout()
                ->createBlock('inventorylowstock/adminhtml_notificationlog_grid')
                ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export grid item to XML type
     */
    public function exportXmlAction() {
        $fileName = 'notificationlog.xml';
        $content = $this->getLayout()
                ->createBlock('inventorylowstock/adminhtml_notificationlog_grid')
                ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('inventoryplus');
    }
    
    public function viewAction() {
       
        $notificationLogId = $this->getRequest()->getParam('id');
        $model = Mage::getModel('inventorylowstock/sendemaillog')->load($notificationLogId);
        $this->_title($this->__('Inventory'))
             ->_title($this->__('Manage Notification'));
        if ($model->getId()) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('notificationloglog_data', $model);

            $this->loadLayout()->_setActiveMenu('inventoryplus');
          
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true)
                    ->removeItem('js', 'mage/adminhtml/grid.js')
                    ->addItem('js', 'magestore/adminhtml/inventory/grid.js');
            $this->_addContent($this->getLayout()->createBlock('inventorylowstock/adminhtml_notificationlog_edit'))
                    ->_addLeft($this->getLayout()->createBlock('inventorylowstock/adminhtml_notificationlog_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inventoryplus')->__('Notification log does not exist')
            );
            $this->_redirect('*/*/');
        }
    }
    
    public function productsAction() {
        $this->loadLayout();
        
        $this->getLayout()->getBlock('notificationlog.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('oproducts', null));
        $this->renderLayout();
        if (Mage::getModel('admin/session')->getData('notificationlog_import'))
            Mage::getModel('admin/session')->setData('notificationlog_import', null);
    }

    public function productsGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('notificationlog.edit.tab.products')
                ->setProducts($this->getRequest()->getPost('oproducts', null));
        $this->renderLayout();
    }
    
    public function productAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function productGridAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

}
