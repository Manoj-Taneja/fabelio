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

class AW_Storecredit_Helper_Url extends Mage_Core_Helper_Abstract
{
    const STORECREDIT_RESUME_ROUTE = 'awstorecredit/storecredit/resume';

    public function getCustomerOrderUrlForEmail($customerId, $orderId, $storeId = null)
    {
        $url = Mage::getBaseUrl();
        if ($customerId && $orderId) {
            $url = Mage::app()->getStore($storeId)->getUrl(
                self::STORECREDIT_RESUME_ROUTE,
                array(
                    'redirect' => $this->urlEncode('sales/order/view'),
                    'customer_id' => $this->urlEncode($customerId),
                    'order_id' => $this->urlEncode($orderId)
                )
            );
        }
        return $url;
    }

    public function getStorecreditAccountUrlForEmail($customerId, $storeId = null)
    {
        $url = Mage::getBaseUrl();
        if ($customerId) {
            $url = Mage::app()->getStore($storeId)->getUrl(
                self::STORECREDIT_RESUME_ROUTE,
                array(
                    'redirect' => $this->urlEncode('awstorecredit/storecredit/index'),
                    'customer_id' => $this->urlEncode($customerId),
                )
            );
        }
        return $url;
    }

    public function getLandingPageUrlForEmail($customerId, $storeId = null)
    {
        $url = Mage::getBaseUrl();
        if ($customerId) {
            $landingPageUrl = Mage::helper('aw_storecredit/config')->getLandingPageUrl($storeId);
            $url = Mage::app()->getStore($storeId)->getUrl(
                self::STORECREDIT_RESUME_ROUTE,
                array(
                    'landing_page_url' => $this->urlEncode($landingPageUrl),
                    'customer_id' => $this->urlEncode($customerId),
                )
            );
        }
        return $url;
    }
}