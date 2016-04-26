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

class AW_Storecredit_Model_Sales_Order_Totals_Quote extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    public function __construct()
    {
        $this->setCode('aw_storecredit');
    }

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        $_result = parent::collect($address);

        $baseTotal = $address->getBaseGrandTotal();
        $total = $address->getGrandTotal();

        $baseTotalStorecreditAmount = 0;
        $totalStorecreditAmount = 0;

        $quote = $address->getQuote();

        if ($baseTotal && $quote->getIsActive()) {
            $quoteStorecredits = Mage::helper('aw_storecredit/totals')->getQuoteStoreCredit($quote->getId());

            foreach($quoteStorecredits as $quoteStorecredit) {
                $_baseStorecreditAmount = $quoteStorecredit->getStorecreditBalance();
                $_storecreditAmount = $quote->getStore()->roundPrice(
                    $quote->getStore()->convertPrice($quoteStorecredit->getStorecreditBalance())
                );

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

                Mage::helper('aw_storecredit/totals')
                    ->saveQuoteStorecreditTotals($quoteStorecredit->getLinkId(), $_baseStorecreditAmount, $_storecreditAmount)
                ;
            }
            $address
                ->getQuote()
                ->setBaseAwStorecreditAmountUsed($baseTotalStorecreditAmount)
                ->setAwStorecreditAmountUsed($totalStorecreditAmount)
            ;
            $address
                ->setBaseAwStorecreditAmountUsed($baseTotalStorecreditAmount)
                ->setAwStorecreditAmountUsed($totalStorecreditAmount)
                ->setBaseGrandTotal($address->getBaseGrandTotal() - $baseTotalStorecreditAmount)
                ->setGrandTotal($address->getGrandTotal() - $totalStorecreditAmount)
            ;
        }
        return $_result;
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        $_result = parent::fetch($address);

        $storecredit = Mage::helper('aw_storecredit/totals')->getQuoteStoreCredit($address->getQuote()->getId());
        $address->addTotal(
            array(
                'code'       => $this->getCode(),
                'title'      => Mage::helper('aw_storecredit')->__('Store Credit'),
                'value'      => -$address->getAwStorecreditAmountUsed(),
                'storecredit' => $storecredit,
            )
        );
        return $_result;
    }
}