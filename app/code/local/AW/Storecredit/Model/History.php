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

class AW_Storecredit_Model_History extends Mage_Core_Model_Abstract
{
    protected $_transactionsCollection = null;

    public function _construct()
    {
        parent::_construct();
        $this->_init('aw_storecredit/history');
    }

    public function registerAction($actionType, AW_Storecredit_Model_Storecredit $storecreditModel)
    {
        $info = array(
            'message_type' => AW_Storecredit_Model_Source_Storecredit_History_Action::BY_ADMIN_MESSAGE_VALUE,
            'message_data' => $this->_getCurrentAdminUserName()
        );

        if (null !== $storecreditModel->getOrder()) {
            $info = array(
                'message_type' => AW_Storecredit_Model_Source_Storecredit_History_Action::BY_ORDER_MESSAGE_VALUE,
                'message_data' => array('order_increment_id' => $storecreditModel->getOrder()->getIncrementId())
            );
        }

        if (true === $storecreditModel->getOrderCanceled() && null !== $storecreditModel->getOrder()) {
            $info = array(
                'message_type' => AW_Storecredit_Model_Source_Storecredit_History_Action::BY_ORDER_CANCELED_MESSAGE_VALUE,
                'message_data' => array('order_increment_id' => $storecreditModel->getOrder()->getIncrementId())
            );
        }

        if (null !== $storecreditModel->getCreditmemo()) {
            $orderIncrementId = '';
            $creditmemoIncrementId = '';
            if ($storecreditModel->getCreditmemo() instanceof Mage_Sales_Model_Order_Creditmemo) {
                $orderIncrementId = $storecreditModel->getCreditmemo()->getOrder()->getIncrementId();
                $creditmemoIncrementId = $storecreditModel->getCreditmemo()->getIncrementId();
            }
            $info = array(
                'message_type' => AW_Storecredit_Model_Source_Storecredit_History_Action::BY_CREDITMEMO_MESSAGE_VALUE,
                'message_data' => array('order_increment_id' => $orderIncrementId, 'creditmemo_increment_id' => $creditmemoIncrementId)
            );
        }

        if (true === $storecreditModel->getAddedByAdmin()) {
            $comment = Mage::helper('aw_storecredit')->__("No comments left");
            if ($storecreditModel->getComment()) {
                $comment = $storecreditModel->getComment();
            }
            $info = array(
                'message_type' => AW_Storecredit_Model_Source_Storecredit_History_Action::BY_ADMIN_MESSAGE_VALUE,
                'message_data' => $comment
            );
        }

        if (true === $storecreditModel->getRedeemedFromGiftCard()) {
            $info = array(
                'message_type' => AW_Storecredit_Model_Source_Storecredit_History_Action::BY_GIFTCARD_REDEEM_VALUE,
                'message_data' => ''
            );
        }

        $_balanceDelta = $storecreditModel->getBalance();
        if (!$storecreditModel->getIsNew() && null !== $storecreditModel->getOrigData('balance')) {
            $_balanceDelta = $storecreditModel->getBalance() - $storecreditModel->getOrigData('balance');
        }

        $this
            ->setStorecreditId($storecreditModel->getId())
            ->setAction($actionType)
            ->setBalanceDelta($_balanceDelta)
            ->setBalanceAmount($storecreditModel->getBalance())
            ->setAdditionalInfo($info)
            ->save()
        ;

        $this->_saveAdditionalInfoTranslates($info);

        return $this;
    }

    protected function _saveAdditionalInfoTranslates($additionalInfo)
    {
        $translator = Mage::app()->getTranslator();
        $stores = Mage::app()->getStores();
        $messageTranslates = array();
        foreach ($stores as $store) {
            $localeCode = Mage::getStoreConfig(Mage_Core_Model_Locale::XML_PATH_DEFAULT_LOCALE, $store);
            $translator->setLocale($localeCode);
            $translator->init('adminhtml', true);
            $message = Mage::helper('aw_storecredit')->prepareMessage($additionalInfo);
            $messageTranslates[$localeCode] = strip_tags($message);
        }
        foreach($messageTranslates as $localeCode => $message) {
            $historyAdditional = Mage::getModel('aw_storecredit/history_additional');
            $historyAdditional
                ->setHistoryId($this->getId())
                ->setLocaleCode($localeCode)
                ->setValue($message)
                ->save();
        }
    }

    public function getTransactionsCollection()
    {
        if (null === $this->_transactionsCollection) {
            $collection = $this
                ->getCollection()
                ->joinStoreCreditTable()
                ->joinCustomerName()
                ->joinCustomerEmail()
                ->joinAdditionalInfoTable()
            ;
            $this->_transactionsCollection = $collection;
        }
        return $this->_transactionsCollection;
    }

    protected function _getCurrentAdminUserName()
    {
        if ($user = Mage::getSingleton('admin/session')->getUser()) {
            if ($username = $user->getUsername()) {
                return $username;
            }
        }
        return null;
    }
}