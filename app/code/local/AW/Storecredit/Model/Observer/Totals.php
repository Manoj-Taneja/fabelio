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

class AW_Storecredit_Model_Observer_Totals extends Mage_Core_Model_Abstract
{
    public function paymentMethodIsActive(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled()) {
            return $this;
        }

        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return $this;
        }
        $quote = $observer->getEvent()->getQuote();

        if ($quote && null !== $quote->getStorecreditInstance()) {
            $paymentMethod = $observer->getEvent()->getMethodInstance()->getCode();
            $result = $observer->getEvent()->getResult();
            if ($quote->getStorecreditInstance()->getBalance() >= $quote->getBaseGrandTotal() + $quote->getBaseAwStorecreditAmountUsed()) {
                $result->isAvailable = ($paymentMethod === 'free')
                    && empty($result->isDeniedInConfig);
            }
        }
        return $this;
    }

    public function salesOrderLoadAfter(Varien_Event_Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quoteStorecreditItem = Mage::helper('aw_storecredit/totals')->getQuoteStoreCredit($order->getQuoteId());
        $refundedStorecreditItem = Mage::helper('aw_storecredit/totals')->getRefundedStoreCredit($order->getId());

        if (count($quoteStorecreditItem) > 0) {
            $order->setAwStorecredit($quoteStorecreditItem);
        }

        if (count($refundedStorecreditItem) > 0) {
            $order->setAwRefundedStorecredit($refundedStorecreditItem);
        }

        if (!$order->isCanceled()
            && $order->getState() != Mage_Sales_Model_Order::STATE_CLOSED
            && !$order->canCreditmemo()
            && count($quoteStorecreditItem) > 0
        ) {
            foreach ($order->getAllItems() as $item) {
                if ($item->canRefund()) {
                    $order->setForcedCanCreditmemo(true);
                }
            }
        }
        return $this;
    }

    public function salesOrderSaveBefore(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled()) {
            return $this;
        }

        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return $this;
        }

        $order = $observer->getEvent()->getOrder();
        if ($order->hasForcedCanCreditmemo()) {
            $order->setForcedCanCreditmemo(false);
            foreach ($order->getAllItems() as $item) {
                if ($item->canRefund()) {
                    $order->setForcedCanCreditmemo(true);
                }
            }
        }
        return $this;
    }

    public function salesOrderInvoiceLoadAfter(Varien_Event_Observer $observer)
    {
        $invoice = $observer->getEvent()->getInvoice();
        if (null !== $invoice->getId()) {
            $invoiceStorecreditItems = Mage::helper('aw_storecredit/totals')->getInvoiceStoreCredit($invoice->getId());
            $invoice->setAwStorecredit($invoiceStorecreditItems);
        }
        return $this;
    }

    public function salesOrderCreditmemoLoadAfter(Varien_Event_Observer $observer)
    {
        $creditmemo = $observer->getEvent()->getCreditmemo();
        if (null !== $creditmemo->getId()) {
            $creditmemoStorecreditItems = Mage::helper('aw_storecredit/totals')
                ->getCreditmemoStoreCredit($creditmemo->getId())
            ;
            $creditmemo->setAwStorecredit($creditmemoStorecreditItems);
        }
        return $this;
    }

    public function salesOrderInvoiceSaveAfter(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled()) {
            return $this;
        }

        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return $this;
        }

        $invoice = $observer->getEvent()->getInvoice();

        if (!$invoice->getAwStorecredit()) {
            return $this;
        }

        $storeCredits = $invoice->getAwStorecredit();

        foreach ($storeCredits as $storeCredit) {
            $invoiceStoreCreditModel = Mage::getModel('aw_storecredit/order_invoice_storecredit');
            $invoiceStoreCreditModel
                ->setInvoiceEntityId($invoice->getId())
                ->setStorecreditId($storeCredit->getStorecreditId())
                ->setBaseStorecreditAmount($storeCredit->getBaseStorecreditAmount())
                ->setStorecreditAmount($storeCredit->getStorecreditAmount())
            ;

            try {
                $invoiceStoreCreditModel->save();
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }
        return $this;
    }

    public function salesOrderCreditmemoSaveAfter(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled()) {
            return $this;
        }

        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return $this;
        }

        $creditmemo = $observer->getEvent()->getCreditmemo();
        if (!$creditmemo->getAwStorecredit()) {
            return $this;
        }
        $storeCredits = $creditmemo->getAwStorecredit();
        foreach ($storeCredits as $storeCredit) {
            $creditmemoStoreCreditModel = Mage::getModel('aw_storecredit/order_creditmemo_storecredit');
            $creditmemoStoreCreditModel
                ->setCreditmemoEntityId($creditmemo->getId())
                ->setStorecreditId($storeCredit->getStorecreditId())
                ->setBaseStorecreditAmount($storeCredit->getBaseStorecreditAmount())
                ->setStorecreditAmount($storeCredit->getStorecreditAmount())
            ;
            try {
                $creditmemoStoreCreditModel->save();
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }
        return $this;
    }

    public function saveOrderRefundedToStorecredit(Varien_Event_Observer $observer)
    {
        $storeCredit = $observer->getEvent()->getStorecredit();
        $request = Mage::app()->getRequest();
        $creditmemoParams = $request->getParam('creditmemo');
        if (!$storeCredit->getCreditmemo()
            || !$creditmemoParams
            || !array_key_exists('aw_storecredit_refund_checkbox', $creditmemoParams)
            || !array_key_exists('aw_storecredit_refund_input', $creditmemoParams)
        ) {
            return $this;
        }
        $creditmemo = $storeCredit->getCreditmemo();
        $baseStoreCreditRefundValue = $creditmemoParams['aw_storecredit_refund_input'];
        $orderRate = $creditmemo->getOrder()->getStoreToOrderRate();

        $orderRefundedModel = Mage::getModel('aw_storecredit/order_refunded_storecredit');
        $orderRefundedModel
            ->setOrderEntityId($creditmemo->getOrder()->getId())
            ->setStorecreditId($storeCredit->getId())
            ->setBaseRefundedAmount($baseStoreCreditRefundValue)
            ->setRefundedAmount($baseStoreCreditRefundValue * $orderRate)
        ;
        try {
            $orderRefundedModel->save();
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }

    public function paypalPrepareLineItems(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('aw_storecredit')->isModuleOutputEnabled()) {
            return $this;
        }

        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return $this;
        }

        $paypalCart = $observer->getEvent()->getPaypalCart();
        $salesEntity = $observer->getEvent()->getSalesEntity();

        if (null === $salesEntity) {
            $salesEntity = $paypalCart->getSalesEntity();
        }

        if (null === $salesEntity) {
           return $this;
        }

        $storeCredits = $salesEntity->getAwStorecredit();
        if ($salesEntity instanceof Mage_Sales_Model_Quote) {
            $storeCredits = Mage::helper('aw_storecredit/totals')->getQuoteStoreCredit($salesEntity->getId());
        }
        if ($salesEntity instanceof Mage_Sales_Model_Order) {
            $storeCredits = Mage::helper('aw_storecredit/totals')->getQuoteStoreCredit($salesEntity->getQuoteId());
        }

        if (null === $storeCredits || count($storeCredits) == 0) {
            return $this;
        }

        $baseAmount = 0;
        foreach ($storeCredits as $storecredit) {
            $baseAmount += $storecredit->getBaseStorecreditAmount();
        }

        $baseAmount = round($baseAmount, 4);
        if ($baseAmount > 0.0001 ) {
            if (is_null($paypalCart)) {
                $additionalItems = $observer->getEvent()->getAdditional();
                $itemList = $additionalItems->getItems();
                $itemList[] = new Varien_Object(
                    array(
                         'name'   => Mage::helper('aw_storecredit')->__('Store Credits'),
                         'qty'    => 1,
                         'amount' => $baseAmount,
                    )
                );
                $additionalItems->setItems($itemList);
                $salesEntity->setBaseSubtotal($salesEntity->getBaseSubtotal() + $baseAmount);
                return $this;
            }
            $paypalCart->updateTotal(
                Mage_Paypal_Model_Cart::TOTAL_DISCOUNT, $baseAmount,
                Mage::helper('aw_storecredit')->__(
                    'Store Credit (%s)', Mage::app()->getStore()->convertPrice($baseAmount, true, false)
                )
            );
        }
        return $this;
    }
}