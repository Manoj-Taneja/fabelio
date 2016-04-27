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


class AW_Rma_Model_Entity extends Mage_Core_Model_Abstract
{
    private $_order = null;
    private $_storeId = null;
    private $_status = null;
    private $_requestType = null;

    public function _construct()
    {
        $this->_init('awrma/entity');
    }

    /**
     * Convert Int Id to string like #0000000010
     * @return string
     */
    public function getTextId()
    {
        if ($this->getId()) {
            return $this->getRmaId();
        }
        return null;
    }

    /**
     * Unserialize order items and print label data
     */
    protected function _afterLoad()
    {
        if (is_string($this->getOrderItems()))
            $this->setOrderItems(unserialize($this->getOrderItems()));
        if (is_string($this->getPrintLabel()))
            $this->setPrintLabel(unserialize($this->getPrintLabel()));
    }

    /**
     * Serialize order items and print label data
     */
    protected function _beforeSave()
    {
        if (!is_string($this->getOrderItems()))
            $this->setOrderItems(serialize($this->getOrderItems()));
        if (!is_string($this->getPrintLabel()))
            $this->setPrintLabel(serialize($this->getPrintLabel()));
    }

    protected function _afterSave()
    {
        if (trim($this->getData('rma_id')) === '') {
            $this->setData('rma_id', sprintf('#%010d', $this->getId()));
            $this->save();
        }
        return parent::_afterSave();
    }

    /**
     * Loads by external_link field
     * @param string $link
     * @return AW_Rma_Model_Entity
     */
    public function loadByExternalLink($link)
    {
        $entCollection = $this->getCollection()->setExternalLinkFilter($link)->load();
        foreach ($entCollection as $ent) {
            return $this->load($ent->getId());
        }

        return $this->load(null);
    }

    /**
     * Returns TRUE if request is active, FALSE otherwise
     * @return bool
     */
    public function getIsActive()
    {
        return!(in_array($this->getStatus(), Mage::helper('awrma/status')->getResolvedStatuses()));
    }

    /**
     * Retreives status name for RMA
     * @return string
     */
    public function getStatusName()
    {
        if (is_null($this->_status) && $this->getStatus()) {
            $this->_status = Mage::getModel('awrma/entitystatus')->load($this->getStatus());
        }
        if (is_object($this->_status) && $this->_status->getData() != array()) {
            $_helper = Mage::helper('awrma');
            return $_helper->__($this->_status->getName());
        }
        else {
            return null;
        }
    }

    /**
     * Returns TRUE if status was removed, FALSE otherwise
     * @return bool
     */
    public function getIsStatusRemoved()
    {
        if (is_null($this->_status) && $this->getStatus()) {
            $this->_status = Mage::getModel('awrma/entitystatus')->load($this->getStatus());
        }
        if (is_object($this->_status) && $this->_status->getData() != array()) {
            return (bool)$this->_status->getRemoved();
        }
        else {
            return false;
        }
    }

    /**
     * Retreives request type name for RMA
     * @return string
     */
    public function getRequestTypeName()
    {
        if (is_null($this->_requestType) && !is_null($this->getRequestType())) {
            $this->_requestType = Mage::getModel('awrma/entitytypes')->load($this->getRequestType());
        }
        if (is_object($this->_requestType) && $this->_requestType->getData() != array()) {
            $_helper = Mage::helper('awrma');
            return $_helper->__($this->_requestType->getName());
        }
        else {
            return null;
        }
    }

    /**
     * Returns TRUE if request type was removed, FALSE otherwise
     * @return bool
     */
    public function getIsRequestTypeRemoved()
    {
        if (is_null($this->_requestType) && !is_null($this->getRequestType())) {
            $this->_requestType = Mage::getModel('awrma/entitytypes')->load($this->getRequestType());
        }
        if (is_object($this->_requestType) && $this->_requestType->getData() != array()) {
            return (bool)$this->_requestType->getRemoved();
        }
        else {
            return false;
        }
    }

    /**
     * Retreives package opened label for RMA
     * @return string
     */
    public function getPackageOpenedLabel()
    {
        if (!is_null($this->getPackageOpened()))
            return Mage::getModel('awrma/source_packageopened')->getOptionLabel($this->getPackageOpened());
        else
            return null;
    }

    /**
     * Loads order for current RMA
     * @return Mage_Core_Sales_Model_Order
     */
    public function getOrder()
    {
        if (!$this->_order && $this->getOrderId()) {
            $this->_order = Mage::getModel('sales/order')->loadByIncrementId($this->getOrderId());
        }

        return $this->_order;
    }

    /**
     * Retreives store id from order
     * @return int
     */
    public function getStoreId()
    {
        if (!$this->_storeId && $this->getOrder()) {
            $this->_storeId = $this->getOrder()->getStoreId();
        }

        return $this->_storeId;
    }

    /**
     * Retreives customer url for RMA
     * @return string
     */
    public function getUrl()
    {
        if ($this->getStoreId()) {
            if ($this->getCustomerId()) {
                return Mage::app()->getStore($this->getStoreId())
                    ->getUrl('awrma/customer_rma/view', array('id' => $this->getId(), '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()))
                ;
            } else {
                return Mage::app()->getStore($this->getStoreId())
                    ->getUrl('awrma/guest_rma/view', array('id' => $this->getExternalLink(), '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()))
                ;
            }
        }
        return '';
    }

    /**
     * Retreives admin url for RMA
     * @return string
     */
    public function getAdminUrl()
    {
        if ($this->getId()) {
            return Mage::helper('adminhtml')->getUrl('awrma_admin/adminhtml_rma/edit', array('id' => $this->getId()));
        } else {
            return '';
        }
    }

    /**
     * Retreives print label url for RMA
     * @return string
     */
    public function getPrintLabelUrl()
    {
        if ($this->getStoreId()) {
            if ($this->getCustomerId()) {
                return Mage::app()->getStore($this->getStoreId())
                    ->getUrl('awrma/customer_rma/printlabel', array('id' => $this->getId(), '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()))
                ;
            }
            else {
                return Mage::app()->getStore($this->getStoreId())
                    ->getUrl('awrma/guest_rma/printlabel', array('id' => $this->getId(), '_secure' => Mage::app()->getStore(true)->isCurrentlySecure()))
                ;
            }
        }
        return '';
    }

    /**
     * Retrieves formatted created at
     * @return string
     */
    public function getFormattedCreatedAt()
    {
        return Mage::helper('core')->formatDate(
            $this->getData('created_at'), Mage_Core_Model_Locale::FORMAT_TYPE_SHORT, true
        );
    }
}