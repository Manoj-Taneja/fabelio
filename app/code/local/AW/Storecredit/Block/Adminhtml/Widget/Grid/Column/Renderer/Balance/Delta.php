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

class AW_Storecredit_Block_Adminhtml_Widget_Grid_Column_Renderer_Balance_Delta
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Price
{
    public function render(Varien_Object $row)
    {
        if (null === $row->getData('balance_delta')) {
            return '';
        }

        $currencyCode = $this->_getCurrencyCode($row);

        if (!$currencyCode) {
            return '';
        }
        $balanceDelta = $row->getData('balance_delta');
        $balanceDelta = floatval($balanceDelta) * $this->_getRate($row);
        $balanceDelta = sprintf("%f", $balanceDelta);
        $balanceDelta = Mage::app()->getLocale()->currency($currencyCode)->toCurrency($balanceDelta);

        if ($row->getData('balance_delta') < 0) {
            $balanceDelta = '<span style="color: #ff0000">' . $balanceDelta . '</span>';
        }

        return $balanceDelta;
    }
}