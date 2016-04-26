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


class AW_Rma_Model_Mysql4_Entityreason_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('awrma/entityreason');
    }

    /**
     * Covers bug in Magento function
     *
     * @return Varien_Db_Select
     */
    public function getSelectCountSql()
    {
        $this->_renderFilters();

        $countSelect = clone $this->getSelect();
        $countSelect->reset(Zend_Db_Select::ORDER);
        $countSelect->reset(Zend_Db_Select::LIMIT_COUNT);
        $countSelect->reset(Zend_Db_Select::LIMIT_OFFSET);
        $countSelect->reset(Zend_Db_Select::COLUMNS);
        $countSelect->reset(Zend_Db_Select::GROUP);
        $countSelect->reset(Zend_Db_Select::HAVING);

        $countSelect->from('', 'COUNT(*)');
        return $countSelect;
    }

    protected function _afterLoad()
    {
        foreach ($this->getItems() as $_item) {
            $_item->setStore(explode(',', $_item->getStore()));
            $_item->setData('name', Mage::helper('awrma')->__($_item->getData('name')));
        }
    }

    public function setStoreFilter($stores = null)
    {
        $_stores = array(Mage::app()->getStore()->getId());
        if (is_string($stores)) {
            $_stores = explode(',', $stores);
        }
        if (is_array($stores)) {
            $_stores = $stores;
        }
        array_push($_stores, 0);

        $conditions = array();
        foreach ($_stores as $_store) {
            $conditions[] = array('finset' => $_store);
        }
        $this->addFieldToFilter('store', $conditions);
        return $this;
    }

    public function getOptions()
    {
        $_options = array();
        $this->load();
        foreach ($this->getItems() as $_item) {
            $_options[$_item->getId()] = $_item->getName();
        }
        return $_options;
    }

    public function setDefaultSort()
    {
        $this->getSelect()->order('sort ASC');
        return $this;
    }

    public function setActiveFilter($active = 1)
    {
        $this->getSelect()->where('enabled = ?', intval($active));
        return $this;
    }

    public function setRemovedFilter($show = false)
    {
        if (!$show) {
            $this->getSelect()->where('removed = 0');
        }

        return $this;
    }
}