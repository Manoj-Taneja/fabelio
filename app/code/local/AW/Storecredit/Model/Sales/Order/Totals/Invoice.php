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

class AW_Storecredit_Model_Sales_Order_Totals_Invoice extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        $_result = parent::collect($invoice);

        $baseTotal = $invoice->getBaseGrandTotal();
        $total = $invoice->getGrandTotal();

        $baseTotalStorecreditAmount = 0;
        $totalStorecreditAmount = 0;
        $invoiceStorecredit = array();

        if (null === $invoice->getId()) {
            $quoteStorecredits = Mage::helper('aw_storecredit/totals')->getQuoteStoreCredit(
                $invoice->getOrder()->getQuoteId()
            );

            foreach($quoteStorecredits as $quoteStorecredit) {
                $_baseStorecreditAmount = $quoteStorecredit->getBaseStorecreditAmount();
                $_storecreditAmount = $quoteStorecredit->getStorecreditAmount();

                $invoices = Mage::helper('aw_storecredit/totals')->getAllInvoicesForStorecredit(
                    $invoice->getOrder()->getId(), $quoteStorecredit->getStorecreditId()
                );
                if (count($invoices) > 0) {
                    foreach ($invoices as $storecreditInvoice) {
                        $_baseStorecreditAmount -= $storecreditInvoice->getBaseStorecreditAmount();
                        $_storecreditAmount -= $storecreditInvoice->getStorecreditAmount();
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

                $_invoiceStorecredit = new Varien_Object($quoteStorecredit->getData());
                $_invoiceStorecredit
                    ->setBaseStorecreditAmount($_baseStorecreditAmount)
                    ->setStorecreditAmount($_storecreditAmount)
                ;
                array_push($invoiceStorecredit, $_invoiceStorecredit);
            }
        }

        if (null !== $invoice->getId() && $invoice->getAwStorecredit()) {
            $invoiceStorecredits = $invoice->getAwStorecredit();
            foreach($invoiceStorecredits as $invoiceStorecredit){
                $baseTotalStorecreditAmount += $invoiceStorecredit->getBaseStorecreditAmount();
                $totalStorecreditAmount += $invoiceStorecredit->getStorecreditAmount();
            }

        }

        $invoice
            ->setAwStorecredit($invoiceStorecredit)
            ->setBaseAwStorecreditAmountUsed($baseTotalStorecreditAmount)
            ->setAwStorecreditAmountUsed($totalStorecreditAmount)
            ->setBaseGrandTotal($invoice->getBaseGrandTotal() - $baseTotalStorecreditAmount)
            ->setGrandTotal($invoice->getGrandTotal() - $totalStorecreditAmount)
        ;
        return $_result;
    }
}