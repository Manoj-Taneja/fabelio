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

class AW_Storecredit_Block_Frontend_Checkout_Total extends Mage_Checkout_Block_Total_Default
{
    protected $_template = 'aw_storecredit/checkout/total.phtml';
    protected $_storecredit = null;

    public function getAwStorecredit()
    {
        if (null === $this->_storecredit) {
            $this->_storecredit = $this->getTotal()->getAwStorecredit();
            if (null === $this->_storecredit) {
                $this->_storecredit = Mage::helper('aw_storecredit/totals')->getQuoteStoreCredit();
            }
        }
        return $this->_storecredit;
    }
}