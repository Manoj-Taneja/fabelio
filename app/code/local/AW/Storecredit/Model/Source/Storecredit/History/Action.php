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

class AW_Storecredit_Model_Source_Storecredit_History_Action
{
    const CREATED_VALUE  = 1;
    const UPDATED_VALUE  = 2;
    const USED_VALUE     = 3;
    const REFUNDED_VALUE = 4;

    const CREATED_LABEL  = 'Created';
    const UPDATED_LABEL  = 'Modified';
    const USED_LABEL     = 'Used';
    const REFUNDED_LABEL = 'Refunded';

    const BY_ADMIN_MESSAGE_VALUE            = 0;
    const BY_ORDER_MESSAGE_VALUE            = 1;
    const BY_CREDITMEMO_MESSAGE_VALUE       = 2;
    const BY_GIFTCARD_REDEEM_VALUE          = 3;
    const BY_ORDER_CANCELED_MESSAGE_VALUE   = 4;

    const BY_ADMIN_MESSAGE_LABEL            = "Added by admin: %s.";
    const BY_ORDER_MESSAGE_LABEL            = "Spent on order %s.";
    const BY_CREDITMEMO_MESSAGE_LABEL       = "Order refunded %s <br> Credit Memo %s";
    const BY_GIFTCARD_REDEEM_LABEL          = "Gift Card Redeemed";
    const BY_ORDER_CANCELED_MESSAGE_LABEL   = "Order canceled %s.";

    public function toOptionArray()
    {
        return array(
            self::CREATED_VALUE  => Mage::helper('aw_storecredit')->__(self::CREATED_LABEL),
            self::UPDATED_VALUE  => Mage::helper('aw_storecredit')->__(self::UPDATED_LABEL),
            self::USED_VALUE     => Mage::helper('aw_storecredit')->__(self::USED_LABEL),
            self::REFUNDED_VALUE => Mage::helper('aw_storecredit')->__(self::REFUNDED_LABEL),
        );
    }

    public function getOptionByValue($value)
    {
        $options = $this->toOptionArray();
        if (array_key_exists($value, $options)) {
            return $options[$value];
        }
        return null;
    }

    public function getMessageLabelByType($messageType)
    {
        $label = '';
        switch ($messageType) {
            case self::BY_ADMIN_MESSAGE_VALUE :
                $label = self::BY_ADMIN_MESSAGE_LABEL;
                break;
            case self::BY_ORDER_MESSAGE_VALUE :
                $label = self::BY_ORDER_MESSAGE_LABEL;
                break;
            case self::BY_CREDITMEMO_MESSAGE_VALUE :
                $label = self::BY_CREDITMEMO_MESSAGE_LABEL;
                break;
            case self::BY_GIFTCARD_REDEEM_VALUE :
                $label = self::BY_GIFTCARD_REDEEM_LABEL;
                break;
            case self::BY_ORDER_CANCELED_MESSAGE_VALUE :
                $label = self::BY_ORDER_CANCELED_MESSAGE_LABEL;
                break;
        }
        return $label;
    }
}