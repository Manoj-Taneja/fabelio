<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Storecredit
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */

class AW_Storecredit_Adminhtml_CustomerController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('sales/customer');

        $this
            ->_title($this->__('Sales'))
            ->_title($this->__('Store Credit'))
        ;
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction();
        $this->_title($this->__('Customers'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($formData = $this->getRequest()->getPost()) {

            $storecreditModel = $this->_initStorecredit();
            try {
                $storecreditModel
                    ->addData($formData)
                    ->save()
                ;
                Mage::getSingleton('adminhtml/session')->setFormData(null);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit',
                        array(
                            'id'  => $storecreditModel->getEntityId(),
                            'tab' => $this->getRequest()->getParam('tab', null)
                        )
                    );
                    return;
                }
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($formData);
                $this->_redirect(
                    '*/*/edit',
                    array(
                        'id'  => $storecreditModel->getEntityId(),
                        'tab' => $this->getRequest()->getParam('tab', null)
                    )
                );
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    public function customerHistoryGridAction()
    {
        $customerId = $this->getRequest()->getParam('id', 0);
        $historyGrid = $this->getLayout()
            ->createBlock(
                'aw_storecredit/adminhtml_customer_edit_tabs_storecredit_history_grid', '', array('customer_id' => $customerId)
            );
        $this->getResponse()->setBody($historyGrid->toHtml());
    }

    public function exportCsvAction()
    {
        $fileName = 'aw_storecredit_customers.csv';
        $content = $this->getLayout()->createBlock('aw_storecredit/adminhtml_customer_grid')
            ->getCsvFile()
        ;
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName = 'aw_storecredit_customers.xml';
        $content = $this->getLayout()->createBlock('aw_storecredit/adminhtml_customer_grid')
            ->getExcelFile()
        ;
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function massSubscribeAction()
    {
        $entityIds = $this->getRequest()->getParam('entity_id', null);
        $state = $this->getRequest()->getParam('state', null);
        try {
            if (!is_array($entityIds)) {
                throw new Mage_Core_Exception($this->__('Customers not selected'));
            }

            if (null === $state) {
                throw new Mage_Core_Exception($this->__('Invalid state value'));
            }
            foreach ($entityIds as $id) {
                Mage::getModel('aw_storecredit/storecredit')
                    ->load($id)
                    ->setSubscribeState($state)
                    ->save()
                ;
            }
            if (count($entityIds) > 1) {
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    $this->__('%d customers have been successfully updated', count($entityIds))
                );
            } else {
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    $this->__('%d customer has been successfully updated', count($entityIds))
                );
            }

        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/index');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sales/aw_storecredit/customer');
    }
}