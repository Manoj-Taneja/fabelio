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

class AW_Storecredit_StorecreditController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        if (!$this->_validateUser()) {
            return;
        }
        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            $this->_redirect('customer/account');
            return;
        }
        $this->_initStorecredit();
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->getLayout()->getBlock('head')->setTitle($this->__('Store Credit'));
        $this->renderLayout();
    }

    protected function _validateUser()
    {
        if (!Mage::getSingleton('customer/session')->getCustomerId()) {
            Mage::getSingleton('customer/session')->authenticate($this);
            return false;
        }
        return true;
    }

    protected function _initStorecredit()
    {
        $storecreditModel = Mage::getModel('aw_storecredit/storecredit');
        $customerId  = Mage::getSingleton('customer/session')->getCustomerId();
        if ($customerId) {
            try {
                $storecreditModel->loadByCustomerId($customerId);
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }

        if (null === $storecreditModel->getId()) {
            return null;
        }
        Mage::register('current_storecredit', $storecreditModel);
        return $storecreditModel;
    }

    public function removeAction()
    {
        if ($storecreditId = $this->getRequest()->getParam('awstorecredit_code', null)) {
            $storecreditId = base64_decode($storecreditId);
            try {
                Mage::helper('aw_storecredit/totals')->removeStoreCreditFromQuote(trim($storecreditId));
                Mage::getSingleton('checkout/session')->addSuccess(
                    $this->__('Store Credit has been removed.')
                );
            } catch (Exception $e) {
                Mage::getSingleton('checkout/session')->addException($e, $this->__('Cannot remove store credit.'));
            }

        }
        $this->_redirect('checkout/cart');
    }

    public function subscribeAction()
    {
        $storecreditModel = $this->_initStorecredit();
        if (!$storecreditModel) {
            $this->_redirect('*/*');
            return null;
        }
        $isNewSubscribedState = $this->getRequest()->getParam('is_subscribed', 0);
        $isOldSubscribedState = $storecreditModel->getSubscribeState();

        if ($isNewSubscribedState == $isOldSubscribedState) {
            Mage::getSingleton('core/session')->addSuccess($this->__("Email Notification has been saved."));
            $this->_redirect('*/*');
            return null;
        }

        if (!$isNewSubscribedState && $isOldSubscribedState != $isNewSubscribedState) {
            $isNewSubscribedState = AW_Storecredit_Model_Source_Storecredit_Subscribe_State::UNSUBSCRIBED_VALUE;
        }

        $storecreditModel
            ->setSubscribeState($isNewSubscribedState)
            ->save();

        switch($isNewSubscribedState) {
            case AW_Storecredit_Model_Source_Storecredit_Subscribe_State::SUBSCRIBED_VALUE:
                Mage::getSingleton('core/session')->addSuccess($this->__("You have been subscribed to balance update email notifications."));
                break;
            case AW_Storecredit_Model_Source_Storecredit_Subscribe_State::UNSUBSCRIBED_VALUE:
                Mage::getSingleton('core/session')->addSuccess($this->__("You have been unsubscribed from balance update email notifications."));
                break;
        }
        $this->_redirect('*/*');
    }

    public function resumeAction()
    {
        $redirectTo = $this->getRequest()->getParam('redirect');
        $redirectTo = Mage::helper('core')->urlDecode($redirectTo);

        $landingPage = $this->getRequest()->getParam('landing_page_url');
        $landingPage = Mage::helper('core')->urlDecode($landingPage);

        $customerId = $this->getRequest()->getParam('customer_id');
        $customerId = Mage::helper('core')->urlDecode($customerId);

        $orderId = $this->getRequest()->getParam('order_id');
        $orderId = Mage::helper('core')->urlDecode($orderId);

        if (empty($customerId)) {
            $this->_redirect('/');
            return $this;
        }

        $customer = Mage::getModel('customer/customer')->load($customerId);

        if (!$customer || !$customer->getId() || $customerId != $customer->getId()) {
            $this->_redirect('/');
            return $this;
        }

        if (true == Mage::helper('aw_storecredit/config')->isAutologinEnabled()) {
            $session = Mage::getSingleton('customer/session');
            if ($session->isLoggedIn() && $customerId != $session->getCustomerId()) {
                $session->logout();
            }

            try {
                $session->setCustomerAsLoggedIn($customer);
            } catch (Exception $ex) {
                Mage::getSingleton('core/session')->addError($this->__("Your account has not been confirmed"));
                $this->_redirect('/');
            }
        }

        $url = Mage::app()->getStore($customer->getStoreId())->getBaseUrl();
        if (!empty($redirectTo)) {
            if (!empty($orderId)) {
                $url = Mage::app()->getStore($customer->getStoreId())->getUrl($redirectTo, array('order_id' => $orderId));
            } else {
                $url = Mage::app()->getStore($customer->getStoreId())->getUrl($redirectTo);
            }
        }
        if (!empty($landingPage)) {
            $url = $landingPage;
        }

        $this->_redirectUrl($url);
    }
}