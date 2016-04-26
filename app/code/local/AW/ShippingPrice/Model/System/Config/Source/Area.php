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
 * @package    AW_ShippingPrice
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_ShippingPrice_Model_System_Config_Source_Area
{
    const CATEGORY_PAGE         = 1;
    const PRODUCT_PAGE          = 2;
    const BOTH_CATEGORY_PRODUCT = 0;

    public function toOptionArray()
    {
        return array(
            array(
                'value' => self::CATEGORY_PAGE,
                'label' => Mage::helper('aw_shippingprice')->__('Category Page'),
            ),
            array(
                'value' => self::PRODUCT_PAGE,
                'label' => Mage::helper('aw_shippingprice')->__('Product Page'),
            ),
            array(
                'value' => self::BOTH_CATEGORY_PRODUCT,
                'label' => Mage::helper('aw_shippingprice')->__('Both Category and Product Pages'),
            ),
        );
    }
}