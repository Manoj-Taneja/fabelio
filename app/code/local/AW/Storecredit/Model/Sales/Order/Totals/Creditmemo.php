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

class AW_Storecredit_Model_Sales_Order_Totals_Creditmemo extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditMemo)
    {
        $_result = parent::collect($creditMemo);
        $order = $creditMemo->getOrder();

        $creditMemo->setBaseStoreCreditRefundValue(0);
        $creditMemo->setStoreCreditRefundValue(0);

        $total = $creditMemo->getGrandTotal();
        $baseTotal = $creditMemo->getBaseGrandTotal();

        $needBaseMoneyToRefund = abs($order->getBaseTotalPaid() - $order->getBaseTotalRefunded());
        if ($baseTotal > $needBaseMoneyToRefund) {
            $needMoneyToRefund = abs($order->getTotalPaid() - $order->getTotalRefunded());
            $creditMemo->setBaseRealMoneyRefundValue($needBaseMoneyToRefund);
            $total = $creditMemo->getGrandTotal() - $needMoneyToRefund;
            $baseTotal = $creditMemo->getBaseGrandTotal() - $needBaseMoneyToRefund;
        }

        if ($total <= 0 || $baseTotal <= 0) {
            return $this;
        }

        $baseTotalStorecreditAmount = 0;
        $totalStorecreditAmount = 0;
        $creditmemosStorecredit = array();
        if (null === $creditMemo->getId()) {
            $invoiceStorecredits = Mage::helper('aw_storecredit/totals')->getInvoicedStorecreditByOrderId(
                $creditMemo->getOrder()->getId()
            );

            foreach($invoiceStorecredits as $invoiceStorecredit) {
                $_baseStorecreditAmount = $invoiceStorecredit->getBaseStorecreditAmount();
                $_storecreditAmount = $invoiceStorecredit->getStorecreditAmount();

                $creditmemoItems = Mage::helper('aw_storecredit/totals')->getAllCreditmemoForStorecredit(
                    $creditMemo->getOrder()->getId(), $invoiceStorecredit->getStorecreditId()
                );

                if (count($creditmemoItems) > 0) {
                    foreach ($creditmemoItems as $creditmemoStorecredit) {
                        $_baseStorecreditAmount -= $creditmemoStorecredit->getBaseStorecreditAmount();
                        $_storecreditAmount -= $creditmemoStorecredit->getStorecreditAmount();
                    }
                }
                $baseStorecreditUsedAmount = $_baseStorecreditAmount;
                if ($_baseStorecreditAmount >= $baseTotal) {
                    $baseStorecreditUsedAmount = $baseTotal;
                }

                $storecreditUsedAmount = $_storecreditAmount;

                if ($_storecreditAmount >= $total) {
                    $storecreditUsedAmount = $total;
                }

                $_baseStorecreditAmount = round($baseStorecreditUsedAmount, 4);
                $_storecreditAmount = round($storecreditUsedAmount, 4);

                $baseTotalStorecreditAmount += $_baseStorecreditAmount;
                $totalStorecreditAmount += $_storecreditAmount;

                $_creditmemoStorecredit = new Varien_Object($invoiceStorecredit->getData());
                $_creditmemoStorecredit
                    ->setBaseStorecreditAmount($_baseStorecreditAmount)
                    ->setStorecreditAmount($_storecreditAmount)
                ;
                array_push($creditmemosStorecredit, $_creditmemoStorecredit);
            }
        }

        if (null !== $creditMemo->getId() && $creditMemo->getAwStorecredit()) {
            $creditmemoStorecredits = $creditMemo->getAwStorecredit();
            foreach ($creditmemoStorecredits as $creditmemoStorecredit) {
                $baseTotalStorecreditAmount += $creditmemoStorecredit->getBaseStorecreditAmount();
                $totalStorecreditAmount += $creditmemoStorecredit->getStorecreditAmount();
            }
        }

        if ($creditmemosStorecredit) {
            $creditMemo->setAllowZeroGrandTotal(true);
        }

        $creditMemo
            ->setAwStorecredit($creditmemosStorecredit)
            ->setBaseAwStorecreditAmountUsed($baseTotalStorecreditAmount)
            ->setAwStorecreditAmountUsed($totalStorecreditAmount)
            ->setBaseGrandTotal($creditMemo->getBaseGrandTotal() - $baseTotalStorecreditAmount)
            ->setGrandTotal($creditMemo->getGrandTotal() - $totalStorecreditAmount)
        ;

        $creditMemo->setBaseStoreCreditRefundValue(0);
        $creditMemo->setStoreCreditRefundValue(0);

        $creditMemo->setBaseStoreCreditRefundValue($creditMemo->getBaseStoreCreditRefundValue() + $creditMemo->getBaseGrandTotal());
        $creditMemo->setBaseStoreCreditRefundValue($creditMemo->getBaseStoreCreditRefundValue() + $creditMemo->getBaseAwStorecreditAmountUsed());

        $creditMemo->setStoreCreditRefundValue($creditMemo->getStoreCreditRefundValue() + $creditMemo->getGrandTotal());
        $creditMemo->setStoreCreditRefundValue($creditMemo->getStoreCreditRefundValue() + $creditMemo->getAwStorecreditAmountUsed());

        return $_result;
    }
}