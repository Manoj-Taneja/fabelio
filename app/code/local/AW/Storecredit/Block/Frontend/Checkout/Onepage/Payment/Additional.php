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


class AW_Storecredit_Block_Frontend_Checkout_Onepage_Payment_Additional extends Mage_Core_Block_Template
{
    protected $_storecreditModel = null;

    public function getQuote()
    {
        return Mage::getSingleton('checkout/session')->getQuote();
    }

    protected function _getStorecreditModel()
    {
        if (is_null($this->_storecreditModel)) {
            $this->_storecreditModel = Mage::getModel('aw_storecredit/storecredit');

            if ($this->_getCustomer()->getId()) {
                $this->_storecreditModel->loadByCustomerId($this->_getCustomer()->getId());
            }
        }
        return $this->_storecreditModel;
    }

    protected function _getCustomer()
    {
        return Mage::getSingleton('customer/session')->getCustomer();
    }

    public function isDisplayContainer()
    {
        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return false;
        }

        if (!$this->_getCustomer()->getId()) {
            return false;
        }

        if ($this->getBalance() <= 0) {
            return false;
        }

        return true;
    }

    public function isAllowed()
    {
        if (!$this->isDisplayContainer()) {
            return false;
        }

        if (!$this->getAmountToCharge()) {
            return false;
        }

        return true;
    }

    public function getBalance()
    {
        if (!$this->_getCustomer()->getId()) {
            return 0;
        }
        return $this->_getStorecreditModel()->getBalance();
    }

    public function getAmountToCharge()
    {
        if ($this->isStorecreditUsed()) {
            return $this->getQuote()->getAwStorecreditAmountUsed();
        }

        return min($this->getBalance(), $this->getQuote()->getBaseGrandTotal());
    }

    public function isStorecreditUsed() {
        return $this->getQuote()->getAwStorecreditAmountUsed();
    }

    public function isFullyPaidAfterApplication()
    {
        return $this->getBalance() >= $this->getQuote()->getGrandTotal();
    }
}
