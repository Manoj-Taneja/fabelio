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


class AW_Rma_Block_Customer_New extends Mage_Core_Block_Template
{
    private $_policyContent = null;

    /**
     * Customer orders collection
     *
     * @var Mage_Sales_Model_Mysql4_Order_Collection
     */
    private $_customerOrders = null;

    /**
     * Is this block renders for guest or for registered customer
     *
     * @var bool
     */
    private $_guestMode = true;

    public function __construct()
    {
        parent::__construct();
        if (Mage::helper('awrma')->checkExtensionVersion('Mage_Core', '0.8.25')) {
            $_template = 'aw_rma/customer/new.phtml';
        } else {
            $_template = 'aw_rma/customer/new13x.phtml';
        }
        $this->setTemplate($_template);
        return $this;
    }

    private function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    public function getGuestMode()
    {
        return $this->_guestMode;
    }

    public function setGuestMode($val)
    {
        $this->_guestMode = (bool)$val;
        return $this;
    }

    /**
     * Return saved form data
     *
     * @param boolean $jsonItems - if it set to TRUE function returns string
     *
     * @return array or JSON string
     */
    public function getFormData($jsonItems = false)
    {
        $_formData = $this->_getSession()->getAWRMAFormData(true);
        if ($_formData) {
            return $jsonItems ? Zend_Json::encode(isset($_formData['orderitems']) ? $_formData['orderitems'] : array())
                : $_formData;
        } else {
            return false;
        }
    }

    /**
     * Returns order collection with some filters
     *
     * @return Mage_Sales_Order_Collection
     */
    public function getCustomerOrders()
    {
        if (!is_null($this->_customerOrders)) {
            return $this->_customerOrders;
        }
        $helper = Mage::helper('awrma');
        if ($this->getGuestMode()) {

            $_guestOrder = Mage::getModel('sales/order')->load($this->_getSession()->getData('awrma_guest_order'));
            if ($_guestOrder->getId()) {
                $this->_customerOrders = array($_guestOrder);
            }
        } else {
            $this->_customerOrders = Mage::getResourceModel('sales/order_collection')
                ->addFieldToFilter('customer_id', $this->_getSession()->getCustomer()->getId())
                ->addFieldToFilter('state', array('in' => array('complete')))
                ->setOrder('created_at', 'desc');
            $this->_customerOrders->getSelect()
                ->where('updated_at > DATE_SUB(NOW(), INTERVAL ? DAY)', Mage::helper('awrma/config')->getDaysAfter());
            $this->_customerOrders->load();
            $orderIds = array();
            foreach ($this->_customerOrders as $order) {
                if ($helper->isAllowedForOrder($order)) {
                    $orderIds[] = $order->getId();
                }
            }
            $this->_customerOrders = Mage::getResourceModel('sales/order_collection');
            if ($orderIds) {
                $this->_customerOrders->addFieldToFilter(
                    $this->_customerOrders->getResource()->getIdFieldName(), array('in' => $orderIds)
                );
            } else {
                $this->_customerOrders->addFieldToFilter(
                    $this->_customerOrders->getResource()->getIdFieldName(), array('eq' => -1)
                );
            }
        }

        return $this->_customerOrders;
    }

    public function getRequestTypes()
    {
        return Mage::getModel('awrma/entitytypes')
            ->getCollection()
            ->setRemovedFilter()
            ->setStoreFilter()
            ->setActiveFilter()
            ->setDefaultSort()
            ->load()
        ;
    }

    public function getAvailableReasons()
    {
        return Mage::getModel('awrma/entityreason')
            ->getCollection()
            ->setRemovedFilter()
            ->setStoreFilter()
            ->setActiveFilter()
            ->setDefaultSort()
        ;
    }

    public function getPolicy()
    {
        /** @var AW_Rma_Helper_Config $configHelper */
        $configHelper = Mage::helper('awrma/config');
        if (($this->_policyContent === null) && $configHelper->getPolicyShow()) {
            /** @var Mage_Cms_Model_Block $staticBlock */
            $staticBlock = Mage::getModel('cms/block')->load($configHelper->getPolicyBlock());
            if ($staticBlock->getId()) {
                $filterProcessor = Mage::helper('cms')->getBlockTemplateProcessor();
                $this->_policyContent = $filterProcessor->filter($staticBlock->getContent());
            }
        }
        return $this->_policyContent;
    }
}
