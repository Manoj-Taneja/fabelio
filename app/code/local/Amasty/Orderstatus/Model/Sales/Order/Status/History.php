<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Model_Sales_Order_Status_History extends Mage_Sales_Model_Order_Status_History
{
    public function setIsCustomerNotified($flag = null)
    {
        $statusModel = Mage::registry('amorderstatus_history_status');
        if ($statusModel && $statusModel->getNotifyByEmail()) {
            $flag = 1;
        }
        return parent::setIsCustomerNotified($flag);
    }
}