<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Model_Mysql4_Sales_Order extends Mage_Sales_Model_Mysql4_Order
{
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        parent::_beforeSave($object);
        $order = $object;
        if ($order->getId()) {
            $currentOrder = Mage::getModel('sales/order')->load($order->getId());
            // if state changed, and status too, will set previous status if it was status created by extension
            if ($currentOrder->getState() != $order->getState()
                && $currentOrder->getStatus() != $order->getStatus()) {
                $currentStatus = str_replace($currentOrder->getState() . '_', '', $currentOrder->getStatus());
                $statusModel = Mage::getModel('amorderstatus/status')->load($currentStatus, 'alias');
                if ($statusModel->getId()
                    && !$statusModel->getIsSystem()) {
                    // checking if we should apply status to the current state
                    $parentStates = array();
                    if ($statusModel->getParentState()) {
                        $parentStates = explode(',', $statusModel->getParentState());
                    }
                    // checking if the status corresponds to the state of the new order
                    if (!$parentStates
                        || in_array($order->getState(), $parentStates)) {
                        // replacing status back
                        $order->setStatus($order->getState() . '_' . $currentStatus);
                    }
                }
            }
        }
        return $this;
    }
}