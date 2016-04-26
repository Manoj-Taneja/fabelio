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
 * @package    AW_Rma
 * @version    1.5.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Rma_Model_Observer
{
    public static function removeSessionData()
    {
        Mage::getSingleton('customer/session')->getAWRMAFormData(true);
        Mage::getSingleton('customer/session')->getAWRMACommentFormData(true);
    }

    /**
     * Replace view order page template in customer account for adding link
     * Request RMA
     *
     * @return null
     */
    public static function setOrderInfoTemplate()
    {
        if (!Mage::getSingleton('core/layout')->getBlock('sales.order.info')) {
            return;
        }
        if (Mage::helper('awrma')->checkExtensionVersion('Mage_Core', '0.8.25')) {
            $_template = 'aw_rma/sales/order/info.phtml';
        } else {
            $_template = 'aw_rma/sales/order/info13x.phtml';
        }
        Mage::getSingleton('core/layout')->getBlock('sales.order.info')->setTemplate($_template);
    }

    public function customerSaveBefore(Varien_Event_Observer $observer)
    {
        $data = $observer->getEvent()->getDataObject();
        $customerId = $data->getData('entity_id');
        if (!$customerId) {
            return $this;
        }
        $customer = Mage::getModel('customer/customer')->load($customerId);
        $newEmail = $data->getData('email');
        $oldEmail = $customer->getEmail();

        $newName = $data->getData('firstname') . ' ' . $data->getData('lastname');
        $oldName = $customer->getFirstname() . ' ' . $customer->getLastname();

        if (strcmp($newEmail,$oldEmail) !== 0) {
            $data->setNeedUpdateEmail(true);
        }
        if (strcmp($newName,$oldName) !== 0) {
            $data->setNeedUpdateName(true);
        }
    }

    public function customerSaveAfter(Varien_Event_Observer $observer)
    {
        $data = $observer->getEvent()->getDataObject();
        $customerId = $data->getData('entity_id');
        if (!$customerId) {
            return $this;
        }

        $newEmail = $data->getData('email');
        $newName = $data->getData('firstname') . ' ' . $data->getData('lastname');

        if ($data->getNeedUpdateEmail()) {
            Mage::getResourceModel('awrma/entity')->updateCustomerEmailByCustomerId($newEmail, $customerId);
        }
        if ($data->getNeedUpdateName()) {
            Mage::getResourceModel('awrma/entity')->updateCustomerNameByCustomerId($newName, $customerId);
        }
    }
}
