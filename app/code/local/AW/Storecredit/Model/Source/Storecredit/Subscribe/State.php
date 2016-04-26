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

class AW_Storecredit_Model_Source_Storecredit_Subscribe_State
{
    const NOT_SUBSCRIBED_VALUE  = 0;
    const SUBSCRIBED_VALUE      = 1;
    const UNSUBSCRIBED_VALUE    = 2;

    const NOT_SUBSCRIBED_LABEL  = 'Not Subscribed';
    const SUBSCRIBED_LABEL      = 'Subscribed';
    const UNSUBSCRIBED_LABEL    = 'Unsubscribed';

    public function toOptionArray()
    {
        return array(
            self::NOT_SUBSCRIBED_VALUE  => Mage::helper('aw_storecredit')->__(self::NOT_SUBSCRIBED_LABEL),
            self::SUBSCRIBED_VALUE      => Mage::helper('aw_storecredit')->__(self::SUBSCRIBED_LABEL),
            self::UNSUBSCRIBED_VALUE    => Mage::helper('aw_storecredit')->__(self::UNSUBSCRIBED_LABEL)
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
}