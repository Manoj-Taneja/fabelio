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


class AW_Storecredit_Block_Frontend_Customer_Storecredit_History extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        parent::_construct();
        $collection = Mage::getModel('aw_storecredit/history')
            ->getTransactionsCollection()
            ->joinStoreCreditTable()
            ->addFieldToFilter('customer_id', Mage::getSingleton('customer/session')->getCustomer()->getId())
            ->setOrder('updated_at', 'DESC')
        ;
        $this->setData('collection', $collection);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()
            ->createBlock('page/html_pager', 'aw.storecredit.history.pager')
            ->setCollection($this->getCollection());
        $this->setChild('awstorecredit_pager', $pager);
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('awstorecredit_pager');
    }

    public function getTransactions()
    {
        return $this->getCollection();
    }

    public function getAdditionalInfoFromTransaction($transaction)
    {
        $additionalInfo = $transaction->getAdditionalInfo();
        if (!is_array($additionalInfo)
            || !array_key_exists('message_type', $additionalInfo)
            || !array_key_exists('message_data', $additionalInfo)
        ) {
            return '';
        }
        $message = Mage::helper('aw_storecredit')->prepareFrontendMessage($additionalInfo);

        return $message;
    }


    public function getActionFromTransaction($transaction)
    {
        return Mage::getModel('aw_storecredit/source_storecredit_history_action')->getOptionByValue($transaction->getAction());
    }

    public function getBalanceDeltaFromTransaction($transaction)
    {
        $balanceDelta = $transaction->getBalanceDelta();
        $balanceDeltaFormatted = Mage::helper('core')->currency($balanceDelta, true, false);
        if ($balanceDelta < 0) {
            $balanceDeltaFormatted = '<span style="color: #ff0000">' . $balanceDeltaFormatted . '</span>';
        }

        return $balanceDeltaFormatted;
    }


}