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

class AW_Storecredit_Adminhtml_TransactionsController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('sales/transactions');

        $this
            ->_title($this->__('Sales'))
            ->_title($this->__('Store Credit'))
        ;
        return $this;
    }

    public function saveAction()
    {
        $post = $this->getRequest()->getPost();

        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled() || !Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            Mage::getSingleton('adminhtml/session')
                ->addError(
                    Mage::helper('aw_storecredit')->__(
                        'Store Credit is disabled by Admin'
                    )
                );
            return $this->_redirect('*/*/new');
        }


        if (empty($post['comment']) || empty($post['balance_change']) || empty($post['selected_customers'])) {
            Mage::getSingleton('adminhtml/session')
                ->addError(
                    Mage::helper('aw_storecredit')->__(
                        'Comments and Balance Change cannot be empty, at least one customer must be selected'
                    )
                );
            return $this->_redirect('*/*/new');
        }
        try {
            $customersIds = explode(',', $post['selected_customers']);
            foreach ($customersIds as $customerId) {
                $storeCredit = Mage::getModel('aw_storecredit/storecredit')->loadByCustomerId($customerId);

                $storeCredit
                    ->setBalance($storeCredit->getBalance() + $post['balance_change'])
                    ->setCustomerId($customerId)
                    ->setAddedByAdmin(true)
                    ->setComment($post['comment']);

                if ($post['balance_change'] > 0) {
                    $storeCredit->setTotalBalance($storeCredit->getTotalBalance() + $post['balance_change']);
                }
                $storeCredit->save();

                $emailTemplate = Mage::getModel('aw_storecredit/email_template');

                try {
                    $_templateData = array();
                    $_templateData['store_credit_added_by_admin'] = true;
                    $_templateData['store_credit_delta_balance_formatted'] = Mage::helper('core')->currency($post['balance_change'], true, false);
                    $_templateData['store_credit_admin_comment'] = $post['comment'];
                    $_templateData['customer_id'] = $customerId;

                    $store = Mage::app()->getStore(Mage_Core_Model_App::ADMIN_STORE_ID);
                    $emailTemplate->prepareEmailAndSend($_templateData, $store);
                } catch (Exception $e) {
                    Mage::logException($e);
                }
            }
        } catch (Exception $ex) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('points')->__('Error occurred while saving transaction'));
            return $this->_redirect('*/*/new');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess(
            Mage::helper('aw_storecredit')->__('Transaction(s) successfully created')
        );
        return $this->_redirect('*/*/index');
    }

    public function indexAction()
    {
        $this->_initAction();
        $this->_title($this->__('Transactions'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_title($this->__('Add Transactions'));
        $this
            ->loadLayout()
            ->_setActiveMenu('sales')
            ->renderLayout();
    }

    public function exportCsvAction()
    {
        $fileName = 'aw_storecredit_transactions.csv';
        $content = $this->getLayout()->createBlock('aw_storecredit/adminhtml_transactions_grid')
            ->getCsvFile()
        ;
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName = 'aw_storecredit_transactions.xml';
        $content = $this->getLayout()->createBlock('aw_storecredit/adminhtml_transactions_grid')
            ->getExcelFile()
        ;
        $this->_prepareDownloadResponse($fileName, $content);
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sales/aw_storecredit/transactions');
    }

    public function gridAction()
    {
        $customerGrid = $this->getLayout()
            ->createBlock('aw_storecredit/adminhtml_transactions_add_customer_grid');
        $this->getResponse()->setBody($customerGrid->toHtml());
    }
}