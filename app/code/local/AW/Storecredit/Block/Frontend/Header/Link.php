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

class AW_Storecredit_Block_Frontend_Header_Link extends Mage_Core_Block_Template
{
    public function addStorecreditLink()
    {
        if (!Mage::helper('aw_storecredit/config')->isModuleEnabled()) {
            return $this;
        }

        if (!Mage::helper('aw_storecredit/config')->isDisplayInToplinks()) {
            return $this;
        }

        $customer = Mage::getSingleton('customer/session')->getCustomer();
        if (!$customer || !$customer->getId()) {
            return $this;
        }

        $parentBlock = $this->getParentBlock();
        if (!$parentBlock) {
            return $this;
        }
        if (Mage::helper('aw_storecredit/config')->isDisplayBalanceInToplinks()) {
            $storeCreditModel = Mage::getModel('aw_storecredit/storecredit')->loadByCustomerId($customer->getId());
            $currentBalance = Mage::helper('core')->currency($storeCreditModel->getBalance(), true, false);
            $label = $this->__('Store Credit (%s)', $currentBalance);
        } else {
            $label = $this->__('Store Credit');
        }
        $parentBlock->addLink($label, 'awstorecredit/storecredit/index/', $label, true, array('_secure' => Mage::app()->getStore(true)->isCurrentlySecure()), 25, null, 'class="top-link-aw-storecredit"');

        return $this;
    }
}