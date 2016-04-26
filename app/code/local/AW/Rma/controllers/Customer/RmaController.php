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
 * @package    AW_Rma
 * @version    1.5.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Rma_Customer_RmaController extends Mage_Core_Controller_Front_Action
{
    private function hasErrors()
    {
        return (bool)count($this->_getSession()->getMessages()->getItemsByType('error'));
    }

    protected function _initAction($title = 'RMA')
    {
        // Redirecting to login page when there is no authorized customer
        $loginUrl = Mage::helper('customer')->getLoginUrl();
        if (!Mage::getSingleton('customer/session')->authenticate($this, $loginUrl)) {
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
        }

        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');

        $this->getLayout()->getBlock('head')->setTitle($this->__($title));

        if ($navigationBlock = $this->getLayout()->getBlock('customer_account_navigation')) {
            $navigationBlock->setActive('awrma/customer_rma/list', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }

        return $this;
    }

    private function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    protected function _getRmaRequest()
    {
        if ($this->getRequest()->getParam('id')) {
            $_rmaRequest = Mage::getModel('awrma/entity')->load($this->getRequest()->getParam('id'));
            if (is_object($_rmaRequest) && $_rmaRequest->getData() != array()) {
                $sessionCustomerId = Mage::getSingleton('customer/session')->getCustomer()->getId();
                if ($_rmaRequest->getData('customer_id') == $sessionCustomerId) {
                    return $_rmaRequest;
                } else {
                    $this->_getSession()->addError($this->__('Wrong request ID'));
                }
            } else {
                $this->_getSession()->addError($this->__('Can\'t load RMA request'));
            }
        } else {
            $this->_getSession()->addError($this->__('External RMA ID isn\'t specified'));
        }

        $this->_redirect('awrma/customer_rma/index', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        return null;
    }

    protected function indexAction()
    {
        $this->_redirect('*/*/list');
    }

    protected function listAction()
    {
        $this->_initAction()->renderLayout();
    }

    protected function viewAction()
    {
        $this->_initAction();
        $_rmaRequest = $this->_getRmaRequest();
        if ($_rmaRequest) {
            Mage::unregister('awrma-request');
            Mage::register('awrma-request', $_rmaRequest);
        }
        $this->renderLayout();
    }

    protected function commentAction()
    {
        if (!$this->_validateFormKey()) {
            return $this->_redirect('awrma/customer_rma/list');
        }
        Mage::helper('awrma/comments')->saveComment($this->getRequest(), false);
        $this->_redirect('awrma/customer_rma/view', array('id' => $this->getRequest()->getParam('id'), '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        return $this;
    }

    /**
     * @return AW_Rma_Model_Entitycomments|null
     */
    protected function _initComment()
    {
        $commentId = $this->getRequest()->getParam('cid');
        /** @var AW_Rma_Model_Entitycomments $comment */
        $comment = Mage::getModel('awrma/entitycomments')->load($commentId);
        return $comment->getId()
            ? $comment
            : null;
    }

    protected function _canCustomerDownloadAttachment(AW_Rma_Model_Entitycomments $comment)
    {
        /** @var Mage_Customer_Model_Customer $customer */
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $entity = $comment->getEntity();
        return strcmp($customer->getData('email'), $entity->getData('customer_email')) === 0;
    }

    protected function downloadAction()
    {
        $comment = $this->_initComment();
        if (!$comment || !$this->_canCustomerDownloadAttachment($comment)) {
            $this->_getSession()->addError($this->__("Can't download the attached file"));
            return $this->_redirectReferer();
        }
        Mage::helper('awrma/files')->downloadFile($comment->getAttachments());
    }

    protected function newAction()
    {
        $this->_initAction('Request RMA');

        $this->renderLayout();
    }

    protected function saveAction()
    {
        if (!$this->_validateFormKey()) {
            return $this->_redirect('awrma/customer_rma/new', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }
        $newRma = Mage::helper('awrma/request')->save($this->getRequest());
        if ($this->hasErrors() || !$newRma) {
            return $this->_redirect('awrma/customer_rma/new', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        } else {
            return $this->_redirect('awrma/customer_rma/view', array('id' => $newRma, '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }
    }

    public function getitemsfororderAction()
    {
        $this->_initAction();

        if (!$this->_getSession()->getCustomer()->getId()) {
            header('HTTP/1.1 403 Forbidden');
            return $this;
        }
        header('Content-type: application/x-json');
        $result = Mage::helper('awrma')->getItemsForOrderHtml(
            $this->getRequest()->getParam('incrementid'), false, $this->_getSession()->getCustomer()->getId()
        );
        echo Zend_Json::encode($result);

        exit(0);
    }

    protected function cancelAction()
    {
        $_rmaRequest = $this->_getRmaRequest();
        if ($_rmaRequest) {
            $_rmaRequest->setStatus(Mage::helper('awrma/status')->getResolvedCanceledStatusId());
            $_rmaRequest->save();
            Mage::getModel('awrma/notify')->checkChanges($_rmaRequest);
            $this->_getSession()->addSuccess($this->__('Your RMA successfully canceled'));
        }
        if (isset($_rmaRequest) && $_rmaRequest->getId()) {
            $this->_redirect('awrma/customer_rma/view', array('id' => $_rmaRequest->getId(), '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        } else {
            $this->_redirect('awrma/customer_rma/list', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }
    }

    protected function printlabelAction()
    {
        if (!Mage::helper('awrma/config')->getAllowPrintLabel()) {
            return $this->_redirect('*/*/view', array('id' => $this->getRequest()->getParam('id'), '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }
        if (($rmaRequest = $this->_getRmaRequest())) {
            Mage::unregister('awrma-request');
            Mage::register('awrma-request', $rmaRequest);
        }
        $this->_initAction()->renderLayout();
        return $this;
    }

    protected function printformAction()
    {
        if (!Mage::helper('awrma/config')->getAllowPrintLabel()) {
            $this->_getSession()->addError($this->__('Print Label isn\'t allowed by admin'));
            return $this->_redirect('*/*/view', array('id' => $this->getRequest()->getParam('id'), '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }
        if (!$this->_validateFormKey()) {
            return $this->_redirect('*/*/list');
        }
        if (($rmaRequest = $this->_getRmaRequest())) {
            $printLabel = $this->getRequest()->getParam('printlabel');
            if ($printLabel['stateprovince_id'] && !$printLabel['stateprovince']) {
                $printLabel['stateprovince'] = Mage::helper('awrma')->getRegionName($printLabel['stateprovince_id']);
            }
            $rmaRequest->setPrintLabel($printLabel)
                ->save()
                ->load($rmaRequest->getId());
            Mage::unregister('awrma-request');
            Mage::register('awrma-request', $rmaRequest);
            Mage::unregister('awrma-formdata');
            $printLabelData = $this->getRequest()->getParam('printlabel');
            foreach ($printLabelData as $key => $value) {
                if (is_array($value)) {
                    foreach ($printLabelData[$key] as $mKey => $mValue) {
                        $printLabelData[$key][$mKey] = strip_tags($mValue);
                    }
                } else {
                    $printLabelData[$key] = strip_tags($value);
                }
            }
            Mage::register('awrma-formdata', $printLabelData);
        }
        $this->_initAction()->renderLayout();
        return $this;
    }

    protected function testAction()
    {

    }

    protected function confirmsendAction()
    {
        if (Mage::helper('awrma/config')->getRequireConfirmSending() && ($rmaRequest = $this->_getRmaRequest())) {
            $rmaRequest->setStatus(Mage::helper('awrma/status')->getPackageSentStatusId());
            $rmaRequest->save();
            Mage::getModel('awrma/notify')->checkChanges($rmaRequest);
            $this->_getSession()->addSuccess($this->__('RMA status has been successfully changed'));
        }
        return $this->_redirect('*/*/view', array('id' => $this->getRequest()->getParam('id'), '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
    }

    protected function createfororderAction()
    {
        $_order = Mage::getModel('sales/order')->loadByIncrementId($this->getRequest()->getParam('order_id'));
        if ($_order->getData() != array()) {
            $_formData = array(
                'order' => $_order->getIncrementId()
            );
            foreach ($_order->getItemsCollection() as $_item) {
                $_formData['orderitems'][$_item->getId()] = Mage::helper('awrma')->getItemMaxCount($_item);
            }
            $this->_getSession()->setAWRMAFormData($_formData);
            if ($_order->getData('customer_is_guest')) {
                $this->_getSession()->setData('awrma_guest_order', $_order->getId());
                return $this->_redirect('awrma/guest_rma/new', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
            } else {
                return $this->_redirect('*/*/new', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
            }
        } else {
            $this->_getSession()->addError($this->__('Can\'t load order'));
            return $this->_redirect('sales/order/history', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }
    }
}
