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


class AW_Rma_Guest_RmaController extends Mage_Core_Controller_Front_Action
{

    private function hasErrors()
    {
        return (bool)count($this->_getSession()->getMessages()->getItemsByType('error'));
    }

    protected function _initAction($title = 'RMA')
    {
        if (!Mage::helper('awrma/config')->getAllowAnonymousAccess() && $this->getRequest()->getActionName() != 'view'
            && $this->getRequest()->getActionName() != 'printform'
        ) {
            return $this->_redirect('customer/account/login', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }
        if (Mage::getSingleton('customer/session')->isLoggedIn()
            && $this->getRequest()->getActionName() != 'view'
            && $this->getRequest()->getActionName() != 'printform'
        ) {
            return $this->_redirect('awrma/customer_rma/new', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }

        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');

        $this->getLayout()->getBlock('head')->setTitle($this->__($title));

        return $this;
    }

    private function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    /**
     * Retreive AW_Rma_Model_Entity by id given in request
     * or null otherwise
     */
    protected function _getRmaRequest()
    {
        if ($this->getRequest()->getParam('id')) {
            $_rmaRequest = Mage::getModel('awrma/entity')->loadByExternalLink($this->getRequest()->getParam('id'));
            if (is_object($_rmaRequest) && $_rmaRequest->getData() != array()) {
                return $_rmaRequest;
            } else {
                $this->_getSession()->addError($this->__('Can\'t load RMA request'));
            }
        } else {
            $this->_getSession()->addError($this->__('RMA id isn\'t specified'));
        }

        $this->_redirect('awrma/guest_rma/index', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        return null;
    }

    protected function indexAction()
    {
        $this->_initAction()->renderLayout();
    }

    protected function newAction()
    {
        if (!$this->_getSession()->hasData('awrma_guest_order')) {
            return $this->_redirect('*/*/index', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }
        $this->_initAction()->renderLayout();
        return $this;
    }

    protected function viewAction()
    {
        $this->_initAction();
        if (($_rmaRequest = $this->_getRmaRequest())) {
            Mage::unregister('awrma-request');
            Mage::register('awrma-request', $_rmaRequest);
        }
        $this->renderLayout();
        return $this;
    }

    protected function saveAction()
    {
        if (!$this->_validateFormKey()) {
            return $this->_redirect('awrma/guest_rma/new');
        }
        $newRma = Mage::helper('awrma/request')->save($this->getRequest(), true);
        if ($this->hasErrors() || !$newRma) {
            return $this->_redirect('awrma/guest_rma/new', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        } else {
            return $this->_redirect('awrma/guest_rma/view', array('id' => $newRma, '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }
    }

    protected function commentAction()
    {
        if (!$this->_validateFormKey()) {
            return $this->_redirect('awrma/guest_rma/new');
        }
        Mage::helper('awrma/comments')->saveComment($this->getRequest(), true);
        $this->_redirect('awrma/guest_rma/view', array('id' => $this->getRequest()->getParam('id'), '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        return $this;
    }

    protected function checkorderAction()
    {
        if ($this->getRequest()->isPost()) {
            if ($this->getRequest()->getParam('orderid')) {
                $orderId = trim($this->getRequest()->getParam('orderid'));
                $orderId = preg_replace('/^#/', '', $orderId);
                $_order = Mage::getModel('sales/order')->loadByIncrementId($orderId);
                if ($_order->getId()) {
                    if (!strcasecmp($_order->getCustomerEmail(), $this->getRequest()->getParam('email'))) {
                        if (is_null($_order->getCustomerId())) {
                            if (Mage::helper('awrma')->isAllowedForOrder($_order)) {
                                $this->_getSession()->setData('awrma_guest_order', $_order->getId());
                                return $this->_redirect('awrma/guest_rma/new', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
                            } else {
                                $this->_getSession()->addError(
                                    $this->__(
                                        'Specified order has been created more than %s days ago '
                                        . 'or has not been completed',
                                        Mage::helper('awrma/config')->getDaysAfter()
                                    )
                                );
                            }
                        } else {
                            $this->_getSession()->addError(
                                $this->__(
                                    'This order has been placed by registered customer. '
                                    . 'Please, authorize and request RMA via customer account.'
                                )
                            );
                        }
                    } else {
                        $this->_getSession()->addError(
                            $this->__('Order ID and customer email didn\'t match each other')
                        );
                    }
                } else {
                    $this->_getSession()->addError($this->__('Couldn\'t load order by given order ID'));
                }
            } else {
                $this->_getSession()->addError($this->__('Order ID isn\'t specified'));
            }
        } else {
            $this->_getSession()->addError($this->__('Wrong request method'));
        }

        if ($this->hasErrors()) {
            return $this->_redirect('awrma/guest_rma/index', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
        }
        return $this;
    }

    public function getitemsfororderAction()
    {
        $this->_initAction();

        header('Content-type: application/x-json');
        if ($this->_getSession()->getData('awrma_guest_order')) {
            $_guestOrder = Mage::getModel('sales/order')->load($this->_getSession()->getData('awrma_guest_order'));
            $result = Mage::helper('awrma')->getItemsForOrderHtml(
                $this->getRequest()->getParam('incrementid'), TRUE, $_guestOrder->getCustomerEmail()
            );
        } else {
            header('HTTP/1.1 403 Forbidden');
            return $this;
        }
        echo Zend_Json::encode($result);

        exit(0);
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

    protected function _canCustomerDownloadAttachment(AW_Rma_Model_Entitycomments $comment, $emailHash)
    {
        $entity = $comment->getEntity();
        return strcmp(md5($entity->getData('customer_email')), $emailHash) === 0;
    }

    protected function downloadAction()
    {
        $comment = $this->_initComment();
        $emailHash = $this->getRequest()->getParam('e');
        if (!$comment || !$this->_canCustomerDownloadAttachment($comment, $emailHash)) {
            $this->_getSession()->addError($this->__("Can't download the attached file"));
            return $this->_redirectReferer();
        }
        Mage::helper('awrma/files')->downloadFile($comment->getAttachments());
    }

    protected function cancelAction()
    {
        if (($_rmaRequest = $this->_getRmaRequest())) {
            $_rmaRequest->setStatus(Mage::helper('awrma/status')->getResolvedCanceledStatusId());
            $_rmaRequest->save();
            Mage::getModel('awrma/notify')->checkChanges($_rmaRequest);
            $this->_getSession()->addSuccess($this->__('Your RMA successfully canceled'));
        }

        return $this->_redirect('awrma/guest_rma/view', array('id' => $_rmaRequest->getExternalLink(), '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
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
            return $this->_redirect('*/*/view', array('id' => $this->getRequest()->getParam('id')));
        }
        if (($rmaRequest = $this->_getRmaRequest())) {
            if ($this->getRequest()->isPost()) {
                if (!$this->_validateFormKey()) {
                    return $this->_redirect('*/*/index', array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()));
                }
                $printLabel = $this->getRequest()->getParam('printlabel');
                if ($printLabel['stateprovince_id'] && !$printLabel['stateprovince']) {
                    $printLabel['stateprovince'] = Mage::helper('awrma')->getRegionName(
                        $printLabel['stateprovince_id']
                    );
                }
                $rmaRequest->setPrintLabel($printLabel)
                    ->save()
                    ->load($rmaRequest->getId());
            }
            Mage::unregister('awrma-request');
            Mage::register('awrma-request', $rmaRequest);
            Mage::unregister('awrma-formdata');
            Mage::register('awrma-formdata', $rmaRequest->getPrintLabel());
        }
        $this->_initAction()->renderLayout();
        return $this;
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
}
