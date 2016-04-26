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


class AW_Storecredit_Model_Observer_Storecredit extends Mage_Core_Model_Abstract
{
    public function processOrderCreationData(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled()) {
            return $this;
        }

        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return $this;
        }
        $quote = $observer->getEvent()->getOrderCreateModel()->getQuote();

        if (!$quote || !$quote->getCustomerId()) {
            return $this;
        }

        $request = $observer->getEvent()->getRequest();
        if (isset($request['payment']) && isset($request['payment']['use_customer_balance'])) {
            if ($request['payment']['use_customer_balance']) {
                $storeCredit = Mage::getModel('aw_storecredit/storecredit')->loadByCustomerId($quote->getCustomerId());
                if ($storeCredit) {
                    $quote->setStorecreditInstance($storeCredit);
                    if (!$quote->getPayment()->getMethod()) {
                        $quote->getPayment()->setMethod('free');
                    }
                }
            }
        }
    }

    public function paymentDataImport(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled()) {
            return $this;
        }

        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return $this;
        }

        $input = $observer->getEvent()->getInput();
        $payment = $observer->getEvent()->getPayment();
        if (!$payment->getQuote() || !$payment->getQuote()->getCustomerId()) {
            return $this;
        }

        if ($input && $input->getUseStorecredit()) {
            $storeCredit = Mage::getModel('aw_storecredit/storecredit')->loadByCustomerId($payment->getQuote()->getCustomerId());
            if ($storeCredit) {
                $payment->getQuote()->setStorecreditInstance($storeCredit);

                if (!$input->getMethod() || $payment->getMethod() == 'free') {
                    $input->setMethod('free');
                }

                if (count(Mage::helper('aw_storecredit/totals')->getQuoteStoreCredit($payment->getQuote()->getId())) == 0) {
                    Mage::helper('aw_storecredit/totals')->addStoreCreditToQuote($storeCredit);
                }
            }
        }
        if (!$input->getUseStorecredit()
            && count(Mage::helper('aw_storecredit/totals')->getQuoteStoreCredit($payment->getQuote()->getId())) >= 1
        ) {
            $storeCredit = Mage::getModel('aw_storecredit/storecredit')->loadByCustomerId($payment->getQuote()->getCustomerId());
            if ($storeCredit) {
                $payment->getQuote()->setStorecreditInstance(null);
                Mage::helper('aw_storecredit/totals')->removeStoreCreditFromQuote($storeCredit->getEntityId());
            }
        }
    }

    public function quoteCollectTotalsBefore(Varien_Event_Observer $observer)
    {
        $quote = $observer->getEvent()->getQuote();
        $quote->setStorecreditCollected(false);
    }

    public function updateStoreCreditFromCustomerEdit($observer)
    {
        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled()) {
            return $this;
        }

        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return $this;
        }

        if (!$request = $observer->getRequest()) {
            return $this;
        }
        $customerId = $observer->getCustomer()->getId();
        if (!$customerId) {
            return $this;
        }
        $updateSubscribeState = $request->getPost('balance_update_notification', 0);
        $storeCredit = Mage::getModel('aw_storecredit/storecredit')->loadByCustomerId($customerId);

        if ($storeCredit->getId()) {
            $oldSubscribeState = $storeCredit->getSubscribeState();
            if (!$updateSubscribeState && $oldSubscribeState != $updateSubscribeState) {
                $updateSubscribeState = AW_Storecredit_Model_Source_Storecredit_Subscribe_State::UNSUBSCRIBED_VALUE;
            }

            $storeCredit
                ->setCustomerId($customerId)
                ->setSubscribeState($updateSubscribeState)
                ->save()
            ;
        }

        if (!$request->getPost('aw_update_storecredit')) {
            return $this;
        }

        $updateStoreCredit = $request->getPost('aw_update_storecredit');
        $comment = Mage::helper('aw_storecredit')->__("No comments left");
        if ($request->getPost('aw_update_storecredit_comment')) {
            $comment = $request->getPost('aw_update_storecredit_comment');
        }

        $storeCredit
            ->setBalance($storeCredit->getBalance() + $updateStoreCredit)
            ->setCustomerId($customerId)
            ->setAddedByAdmin(true)
            ->setComment($comment)
        ;
        if ($updateStoreCredit > 0) {
            $storeCredit->setTotalBalance($storeCredit->getTotalBalance() + $updateStoreCredit);
        }
        $storeCredit->save();

        $emailTemplate = Mage::getModel('aw_storecredit/email_template');

        try {
            $_templateData = array();
            $_templateData['store_credit_added_by_admin'] = true;
            $_templateData['store_credit_delta_balance_formatted'] = Mage::helper('core')->currency($updateStoreCredit, true, false);
            $_templateData['store_credit_admin_comment'] = $comment;
            $_templateData['customer_id'] = $customerId;

            $store = Mage::app()->getStore(Mage_Core_Model_App::ADMIN_STORE_ID);
            $emailTemplate->prepareEmailAndSend($_templateData, $store);
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }

    public function salesOrderCreditmemoRefund(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled()) {
            return $this;
        }
        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return $this;
        }

        $creditmemo = $observer->getEvent()->getCreditmemo();

        $request = Mage::app()->getRequest();
        $creditmemoParams = $request->getParam('creditmemo');
        if (!$creditmemoParams
            || !array_key_exists('aw_storecredit_refund_checkbox', $creditmemoParams)
            || !array_key_exists('aw_storecredit_refund_input', $creditmemoParams)
        ) {
            $baseStoreCreditRefundValue = $creditmemo->getBaseAwStorecreditAmountUsed();
        } else {
            $baseStoreCreditRefundValue = $creditmemoParams['aw_storecredit_refund_input'];
        }

        $baseRealMoneyRefundValue = $creditmemo->getBaseRealMoneyRefundValue();
        $customerId = $creditmemo->getCustomerId();

        if (!$baseStoreCreditRefundValue || !$customerId) {
            return $this;
        }

        $additionalRefundMoney = $baseStoreCreditRefundValue - $creditmemo->getBaseStoreCreditRefundValue();
        if (!$baseRealMoneyRefundValue && !$creditmemo->getBaseAwStorecreditAmountUsed()) {
            $baseRealMoneyRefundValue = $baseStoreCreditRefundValue;
            $additionalRefundMoney = 0;
        }

        if ($additionalRefundMoney > 0) {
            $baseRealMoneyRefundValue += $additionalRefundMoney;
        }

        $storeCreditModel = Mage::getModel('aw_storecredit/storecredit')->loadByCustomerId($customerId);
        $storeCreditModel
            ->setCreditmemo($creditmemo)
            ->setTotalBalance($storeCreditModel->getTotalBalance() + $baseRealMoneyRefundValue)
            ->setCustomerId($customerId)
            ->setBalance($storeCreditModel->getBalance() + $baseStoreCreditRefundValue)
            ->save()
        ;

        $emailTemplate = Mage::getModel('aw_storecredit/email_template');
        $order = $creditmemo->getOrder();
        try {
            $_templateData = array();
            $_templateData['store_credit_has_creditmemo'] = true;
            $_templateData['store_credit_delta_balance_formatted'] = Mage::helper('core')->currency($baseStoreCreditRefundValue, true, false);
            $_templateData['order_increment_id'] = $order->getIncrementId();
            $_templateData['order_url'] = Mage::helper('aw_storecredit/url')->getCustomerOrderUrlForEmail(
                $order->getCustomerId(), $order->getId(), $order->getStoreId()
            );
            $_templateData['customer_id'] = $customerId;

            $store = Mage::app()->getStore($order->getStoreId());
            $emailTemplate->prepareEmailAndSend($_templateData, $store);
        } catch (Exception $e) {
            Mage::logException($e);
        }

        try {
            $storeCreditModel->save();
        } catch (Exception $e) {
            Mage::logException($e);
        }

        return $this;
    }

    public function salesOrderPlaceAfter(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled()) {
            return $this;
        }

        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return $this;
        }

        $order = $observer->getEvent()->getOrder();

        if(!$order->getCustomerId()) {
            return $this;
        }

        $quoteStorecreditItem = Mage::helper('aw_storecredit/totals')->getQuoteStoreCredit($order->getQuoteId());
        if (count($quoteStorecreditItem) > 0) {
            foreach ($quoteStorecreditItem as $storecredit) {
                $storecreditModel = Mage::getModel('aw_storecredit/storecredit')->loadByCustomerId($order->getCustomerId());
                if (!$storecreditModel->getEntityId()) {
                    continue;
                }

                $storecreditModel
                    ->setOrder($order)
                    ->setBalance($storecreditModel->getBalance() - $storecredit->getBaseStorecreditAmount())
                    ->save()
                ;

                $emailTemplate = Mage::getModel('aw_storecredit/email_template');
                try {
                    $_templateData = array();
                    $_templateData['store_credit_product_bought'] = true;
                    $_templateData['customer_id'] = $order->getCustomerId();
                    $_templateData['credit_spent'] = Mage::helper('core')->currency($storecredit->getBaseStorecreditAmount(), true, false);
                    $_templateData['order_increment_id'] = $order->getIncrementId();
                    $_templateData['order_url'] = Mage::helper('aw_storecredit/url')->getCustomerOrderUrlForEmail(
                        $order->getCustomerId(), $order->getId(), $order->getStoreId()
                    );

                    $store = Mage::app()->getStore($order->getStoreId());
                    $emailTemplate->prepareEmailAndSend($_templateData, $store);
                } catch (Exception $e) {
                    Mage::logException($e);
                }
            }
        }
        return $this;
    }

    public function orderPaymentCancel(Varien_Event_Observer $observer)
    {
        $payment = $observer->getEvent()->getPayment();
        $order = $payment->getOrder();

        if ($order->getAwStorecredit() && $order->getCustomerId()) {
            $storeCredits = $order->getAwStorecredit();
            foreach ($storeCredits as $storeCredit) {
                $storeCreditModel = Mage::getModel('aw_storecredit/storecredit')->loadByCustomerId($order->getCustomerId());
                $storeCreditModel
                    ->setOrder($order)
                    ->setOrderCanceled(true)
                    ->setCustomerId($order->getCustomerId())
                    ->setBalance($storeCreditModel->getBalance() + $storeCredit->getBaseStorecreditAmount())
                ;
                try {
                    $storeCreditModel->save();
                } catch (Exception $e) {
                    Mage::logException($e);
                }
            }
        }
        return $this;
    }

    public function prepareBackUrl(Varien_Event_Observer $observer)
    {
        $request = Mage::app()->getRequest();
        if (!$request->getParam('storecredit')) {
            return $this;
        }
        $blocks = Mage::app()->getLayout()->getAllBlocks();
        foreach($blocks as $block) {
            if ($block instanceof Mage_Adminhtml_Block_Customer_Edit) {
                $data = array(
                    'label'     => Mage::helper('adminhtml')->__('Back'),
                    'onclick'   => 'setLocation(\'' . $request->getServer('HTTP_REFERER') . '\')',
                    'class'     => 'back',
                );
                $block->removeButton('back');
                $block->addButton('back', $data, -1);
            }
        }
        return $this;
    }

    public function saveShippingMethodAfter(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled()) {
            return $this;
        }

        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
                return $this;
        }

        $body = Mage::app()->getResponse()->getBody();
        $body = Mage::helper('core')->jsonDecode($body);
        if (array_key_exists('update_section', $body) && array_key_exists('html', $body['update_section'])) {
                $baseGrandTotal = Mage::getSingleton('checkout/session')->getQuote()->getBaseGrandTotal();
                $body['update_section']['html'] = '<script type="text/javascript">'
                        . 'if (typeof(storeCreditManager) != "undefined") {'
                        . 'storeCreditManager.quoteBaseGrandTotal = ' . $baseGrandTotal
                        . ';}</script>'
                        . $body['update_section']['html'];
            }
        Mage::app()->getResponse()->setBody(Mage::helper('core')->jsonEncode($body));


            return $this;
    }
}