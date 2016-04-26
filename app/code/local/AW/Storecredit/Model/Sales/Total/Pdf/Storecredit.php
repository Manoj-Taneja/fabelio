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

class AW_Storecredit_Model_Sales_Total_Pdf_Storecredit extends Mage_Sales_Model_Order_Pdf_Total_Default
{
    public function getTotalsForDisplay()
    {
        $_result = array();
        if (count($this->getSource()->getAwStorecredit()) > 0) {
            $storeCredits = $this->getSource()->getAwStorecredit();
            $fontSize = $this->getFontSize() ? $this->getFontSize() : 7;
            $_storeCreditTotals = array();
            foreach ($storeCredits as $storeCredit) {
                $_storeCreditTotals['aw_storecredit_' . $storeCredit->getStorecreditId()] = array (
                    'amount'    => '-' . $this->getOrder()->formatPriceTxt($storeCredit->getStorecreditAmount()),
                    'label'     => Mage::helper('aw_storecredit')->__('Store Credit'),
                    'font_size' => $fontSize,
                );
            }
            $_result = $_storeCreditTotals;
        }
        return $_result;
    }
}