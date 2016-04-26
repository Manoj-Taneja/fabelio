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

class AW_Storecredit_Model_Storecredit extends Mage_Core_Model_Abstract
{
    protected $_eventPrefix = 'aw_sc_storecredit';
    protected $_eventObject = 'storecredit';

    protected $_customersCollection = null;
    protected $_allCustomersCollection = null;

    public function _construct()
    {
        parent::_construct();
        $this->_init('aw_storecredit/storecredit');
    }

    public function loadByCustomerId($customerId)
    {
        return $this->load($customerId, 'customer_id');
    }

    protected function _beforeSave()
    {
        $_result = parent::_beforeSave();

        if (null === $this->getId()) {
            $this->setIsNew(true);
            $isAutoSubscribed = Mage::helper('aw_storecredit/config')->isAutoSubscribedCustomers();
            if ($isAutoSubscribed) {
                $this->setSubscribeState(AW_Storecredit_Model_Source_Storecredit_Subscribe_State::SUBSCRIBED_VALUE);
            }
            $currentDate = Mage::app()->getLocale()
                ->date()
                ->setTimezone(Mage_Core_Model_Locale::DEFAULT_TIMEZONE)
                ->toString(Varien_Date::DATE_INTERNAL_FORMAT)
            ;
            $this
                ->setCreatedAt($currentDate)
            ;
        }

        if ($this->getDeltaAmount()) {
            $balance = $this->getBalance();
            $this->setBalance($balance + $this->getDeltaAmount());
        }
        return $_result;
    }

    protected function isUsed()
    {
        if ($this->getBalance() > 0) {
            return false;
        }
        return true;
    }

    protected function _afterSave()
    {
        parent::_afterSave();
        $this->_registerHistory();
        return $this;
    }

    protected function _registerHistory()
    {
        if ($this->getIsNew()) {
            Mage::getModel('aw_storecredit/history')
                ->registerAction(AW_Storecredit_Model_Source_Storecredit_History_Action::CREATED_VALUE, $this)
            ;
        }

        if (!$this->getIsNew() && $this->getOrigData('balance') > $this->getBalance()
            && null !== $this->getOrder()
        ) {
            Mage::getModel('aw_storecredit/history')
                ->registerAction(AW_Storecredit_Model_Source_Storecredit_History_Action::USED_VALUE, $this)
            ;
        }

        if (!$this->getIsNew() && $this->getOrigData('balance') != $this->getBalance()) {
            if (null !== $this->getCreditmemo()) {
                Mage::getModel('aw_storecredit/history')
                    ->registerAction(AW_Storecredit_Model_Source_Storecredit_History_Action::REFUNDED_VALUE, $this)
                ;
            }

            if (true === $this->getAddedByAdmin() || true == $this->getRedeemedFromGiftCard() || true === $this->getOrderCanceled()) {
                Mage::getModel('aw_storecredit/history')
                    ->registerAction(AW_Storecredit_Model_Source_Storecredit_History_Action::UPDATED_VALUE, $this)
                ;
            }
        }

        return $this;
    }

    public function getAllCustomerCollection()
    {
        if (null === $this->_allCustomersCollection) {
            $collection = $this
                ->getCollection()
                ->joinAllCustomers()
                ->addBalanceSpentColumn()
                ->joinCustomerLogTable()
                ->joinCustomerName()
                ->joinCustomerBillingCountryId()
            ;
            $this->_allCustomersCollection = $collection;
        }
        return $this->_allCustomersCollection;
    }

    public function getCustomerCollection()
    {
        if (null === $this->_customersCollection) {
            $collection = $this
                ->getCollection()
                ->addBalanceSpentColumn()
                ->joinCustomerTable()
                ->joinCustomerLogTable()
                ->joinCustomerName()
                ->joinCustomerBillingCountryId()
            ;
            $this->_customersCollection = $collection;
        }
        return $this->_customersCollection;
    }

    public function _afterLoad()
    {
        return parent::_afterLoad();
    }

    public function delete()
    {
        $this->_getResource()->removeTotals($this);
        return parent::delete();
    }
}