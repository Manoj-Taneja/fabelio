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

class AW_Storecredit_Helper_Data extends Mage_Core_Helper_Abstract
{
    const ADMIN_ORDER_VIEW_ROUTE = 'adminhtml/sales_order/view';
    const ADMIN_CREDITMEMO_VIEW_ROUTE = 'adminhtml/sales_order_creditmemo/view';
    const FRONTEND_ORDER_VIEW_ROUTE = 'sales/order/view';
    const FRONTEND_CREDITMEMO_VIEW_ROUTE = 'sales/order/creditmemo';

    public function isEEVersion()
    {
        return (AW_All_Helper_Versions::getPlatform() == AW_All_Helper_Versions::EE_PLATFORM);
    }

    public function isGiftCardEnabled()
    {
        return Mage::helper('core')->isModuleEnabled('AW_Giftcard') && Mage::helper('aw_giftcard')->isModuleOutputEnabled();
    }

    public function prepareMessage($additionInfo)
    {
        $messageType = $additionInfo['message_type'];
        $messageData = $additionInfo['message_data'];
        $messages = array();

        $messageLabel = Mage::getModel('aw_storecredit/source_storecredit_history_action')
            ->getMessageLabelByType($messageType)
        ;
        $messages[] = $messageLabel;
        if (!is_array($messageData)) {
            $messages[] = $messageData;
            return call_user_func_array('__', array_values($messages));
        }
        if (array_key_exists('order_increment_id', $messageData)) {
            $order = Mage::getModel('sales/order')->loadByIncrementId($messageData['order_increment_id']);
            $url = Mage::getUrl(self::ADMIN_ORDER_VIEW_ROUTE, array('order_id' => $order->getId()));
            $messages[] = "<a href='". $url ."'>#".$messageData['order_increment_id']."</a>";
        }
        if (array_key_exists('creditmemo_increment_id', $messageData)) {
            $creditmemo = Mage::getModel('sales/order_creditmemo')->load($messageData['creditmemo_increment_id'], 'increment_id');
            $url = Mage::getUrl(self::ADMIN_CREDITMEMO_VIEW_ROUTE, array('creditmemo_id' => $creditmemo->getId()));
            $messages[] = "<a href='". $url . "'>#" . $messageData['creditmemo_increment_id'] . "</a>";
        }
        return call_user_func_array('__', array_values($messages));
    }

    public function prepareFrontendMessage($additionInfo)
    {
        $messageType = $additionInfo['message_type'];
        $messageData = $additionInfo['message_data'];
        $messages = array();

        $messageLabel = Mage::getModel('aw_storecredit/source_storecredit_history_action')
            ->getMessageLabelByType($messageType)
        ;
        $messages[] = $messageLabel;
        if (!is_array($messageData)) {
            $messages[] = $messageData;
            return call_user_func_array('__', array_values($messages));
        }
        if (array_key_exists('order_increment_id', $messageData)) {
            $order = Mage::getModel('sales/order')->loadByIncrementId($messageData['order_increment_id']);
            $url = Mage::getUrl(self::FRONTEND_ORDER_VIEW_ROUTE, array('order_id' => $order->getId()));
            $messages[] = "<a href='". $url ."'>#".$messageData['order_increment_id']."</a>";
        }
        if (array_key_exists('creditmemo_increment_id', $messageData) && array_key_exists('order_increment_id', $messageData)) {
            $order = Mage::getModel('sales/order')->loadByIncrementId($messageData['order_increment_id']);
            $url = Mage::getUrl(self::FRONTEND_CREDITMEMO_VIEW_ROUTE, array('order_id' => $order->getId()));
            $messages[] = "<a href='". $url . "'>#" . $messageData['creditmemo_increment_id'] . "</a>";
        }
        return call_user_func_array('__', array_values($messages));
    }
}