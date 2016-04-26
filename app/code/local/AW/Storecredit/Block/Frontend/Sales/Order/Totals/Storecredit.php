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

class AW_Storecredit_Block_Frontend_Sales_Order_Totals_Storecredit extends Mage_Core_Block_Template
{
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }

    public function getOrder()
    {
        return $this->getParentBlock()->getOrder();
    }

    public function initTotals()
    {
        if ($this->getSource() instanceof Mage_Sales_Model_Order && null === $this->getSource()->getAwStorecredit()) {
            $quoteStorecreditItems = Mage::helper('aw_storecredit/totals')
                ->getQuoteStoreCredit($this->getSource()->getQuoteId())
            ;

            if ($quoteStorecreditItems) {
                $this->getSource()->setAwStorecredit($quoteStorecreditItems);
            }
        }

        if ($this->getSource()->getAwStorecredit()) {
            $storecredits = $this->getSource()->getAwStorecredit();
            foreach($storecredits as $storecredit) {
                $this->getParentBlock()->addTotal(
                    new Varien_Object(
                        array(
                             'code'   => 'aw_storecredit_' . $storecredit->getStorecreditId(),
                             'strong' => false,
                             'label'  => $this->__('Store Credit'),
                             'value'  => -$storecredit->getStorecreditAmount(),
                        )
                    ),
                    'tax'
                );
            }
        }
        return $this;
    }
}