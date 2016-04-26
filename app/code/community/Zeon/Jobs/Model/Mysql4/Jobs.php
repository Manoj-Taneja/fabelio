<?php

/**
 * zeonsolutions inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.zeonsolutions.com/shop/license-community.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * This package designed for Magento COMMUNITY edition
 * =================================================================
 * zeonsolutions does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * zeonsolutions does not provide extension support in case of
 * incorrect edition usage.
 * =================================================================
 *
 * @category   Zeon
 * @package    Zeon_Jobs
 * @version    0.0.1
 * @copyright  @copyright Copyright (c) 2013 zeonsolutions.Inc. (http://www.zeonsolutions.com)
 * @license    http://www.zeonsolutions.com/shop/license-community.txt
 */

class Zeon_Jobs_Model_Mysql4_Jobs extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        // Note that the job_id refers to the key field in your database table.
        $this->_init('zeon_jobs/jobs', 'job_id');
    }

    /**
     * Process job data before deleting
     *
     * @param Mage_Core_Model_Abstract $object
     * @return Zeon_Jobs_Model_Mysql4_Jobs
     */
    protected function _beforeDelete(Mage_Core_Model_Abstract $object)
    {
        $condition = array(
            'job_id = ?'     => (int) $object->getId(),
        );

        $this->_getWriteAdapter()->delete($this->getTable('zeon_jobs/store'), $condition);

        return parent::_beforeDelete($object);
    }

    /**
     * Process job data before saving
     *
     * @param Mage_Core_Model_Abstract $object
     * @return Zeon_Jobs_Model_Mysql4_Jobs
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        if (!$this->getIsUniqueJobToStores($object)) {
            Mage::throwException(Mage::helper('zeon_jobs')->__('A job URL key for specified store already exists.'));
        }
        if (!$this->isValidJobIdentifier($object)) {
            Mage::throwException(
                Mage::helper('zeon_jobs')->__('The job URL key contains capital letters or disallowed symbols.')
            );
        }
        if ($this->isNumericJobIdentifier($object)) {
            Mage::throwException(Mage::helper('zeon_jobs')->__('The job URL key cannot consist only of numbers.'));
        }
        // modify create / update dates
        if ($object->isObjectNew() && !$object->hasCreationTime()) {
            $object->setCreationTime(Mage::getSingleton('core/date')->gmtDate());
        }
        $object->setUpdateTime(Mage::getSingleton('core/date')->gmtDate());

        return parent::_beforeSave($object);
    }
    /**
     * Retrieve load select with filter by identifier, store and activity
     *
     * @param string $identifier
     * @param int|array $store
     * @param int $isActive
     * @return Varien_Db_Select
     */
    protected function isValidJobIdentifier(Mage_Core_Model_Abstract $object)
    {
        return preg_match('/^[a-z0-9][a-z0-9_\/-]+(\.[a-z0-9_-]+)?$/', $object->getData('identifier'));
    }

    /**
     * Retrieve load select with filter by identifier, store and activity
     *
     * @param string $identifier
     * @param int|array $store
     * @param int $isActive
     * @return Varien_Db_Select
     */
    protected function _getLoadByIdentifierSelect($identifier, $store, $isActive = null)
    {
        $select = $this->_getReadAdapter()->select()
            ->from(array('jp' => $this->getMainTable()))
            ->join(
                array('jps' => $this->getTable('zeon_jobs/store')),
                'jp.job_id = jps.job_id',
                array()
            )
            ->where('jp.identifier = ?', $identifier)
            ->where('jps.store_id IN (?)', $store);

        if (!is_null($isActive)) {
            $select->where('jp.status = ?', $isActive);
        }
        return $select;
    }

    /**
     * Check for unique of identifier of job(s) to selected store(s).
     *
     * @param Mage_Core_Model_Abstract $object
     * @return bool
     */
    public function getIsUniqueJobToStores(Mage_Core_Model_Abstract $object)
    {
        if (Mage::app()->isSingleStoreMode() || !$object->hasStores()) {
            $stores = array(Mage_Core_Model_App::ADMIN_STORE_ID);
        } else {
            $stores = (array)$object->getData('stores');
        }

        $select = $this->_getLoadByIdentifierSelect($object->getData('identifier'), $stores);

        if ($object->getId()) {
            $select->where('jps.job_id <> ?', $object->getId());
        }

        if ($this->_getWriteAdapter()->fetchRow($select)) {
            return false;
        }
        return true;
    }
     /**
     *  Check whether job identifier is valid
     *
     *  @param    Mage_Core_Model_Abstract $object
     *  @return   bool
     */
    protected function isNumericJobIdentifier(Mage_Core_Model_Abstract $object)
    {
        return preg_match('/^[0-9]+$/', $object->getData('identifier'));
    }
    /**
     * Check if jobs identifier exist for specific store
     * return page id if page exists
     *
     * @param string $identifier
     * @param int $storeId
     * @return int
     */
    public function checkIdentifier($identifier, $storeId)
    {
        $stores = array(Mage_Core_Model_App::ADMIN_STORE_ID, $storeId);
        $select = $this->_getLoadByIdentifierSelect($identifier, $stores, 1);
        $select->reset(Zend_Db_Select::COLUMNS)
            ->columns('jp.job_id')
            ->order('jps.store_id DESC')
            ->limit(1);

        return $this->_getReadAdapter()->fetchOne($select);
    }
    /**
     * Retrieves job page title from DB by passed identifier.
     *
     * @param string $identifier
     * @return string|false
     */
    public function getJobPageTitleByIdentifier($identifier)
    {
        $stores = array(Mage_Core_Model_App::ADMIN_STORE_ID);
        if ($this->_store) {
            $stores[] = (int)$this->getStore()->getId();
        }

        $select = $this->_getLoadByIdentifierSelect($identifier, $stores);
        $select->reset(Zend_Db_Select::COLUMNS)
            ->columns('jp.title')
            ->order('jps.store_id DESC')
            ->limit(1);

        return $this->_getReadAdapter()->fetchOne($select);
    }

   /**
     * Retrieves job page title from DB by passed id.
     *
     * @param string $id
     * @return string|false
     */
    public function getJobPageTitleById($id)
    {
        $adapter = $this->_getReadAdapter();

        $select  = $adapter->select()
            ->from($this->getMainTable(), 'title')
            ->where('job_id = :job_id');

        $binds = array(
            'job_id' => (int) $id
        );

        return $adapter->fetchOne($select, $binds);
    }
    /**
     * Retrieves job page identifier from DB by passed id.
     *
     * @param string $id
     * @return string|false
     */
    public function getJobPageIdentifierById($id)
    {
        $adapter = $this->_getReadAdapter();

        $select  = $adapter->select()
            ->from($this->getMainTable(), 'identifier')
            ->where('job_id = :job_id');

        $binds = array(
            'job_id' => (int) $id
        );

        return $adapter->fetchOne($select, $binds);
    }

   /**
     * Retrieves job id from DB by passed job code.
     *
     * @param string $jobCode
     * @return string|false
     */
    public function checkJobCode($jobCode)
    {
        $adapter = $this->_getReadAdapter();

        $select  = $adapter->select()
            ->from($this->getMainTable(), 'job_id')
            ->where('job_code = :job_code');

        $binds = array(
            'job_code' => $jobCode
        );
        return $adapter->fetchOne($select, $binds);
    }

     /**
     * Initialize unique fields
     *
     * @return Mage_Core_Model_Mysql4_Abstract
     */
    protected function _initUniqueFields()
    {
        $this->_uniqueFields = array(array(
            'field' => 'title',
            'title' => Mage::helper('zeon_jobs')->__('Job with the same title')
        ));
        return $this;
    }
        /**
     * Load store Ids array
     *
     * @param Zeon_Jobs_Model_Jobs $object
     */
    public function loadStoreIds(Zeon_Jobs_Model_Jobs $object)
    {
        $pollId   = $object->getId();
        $storeIds = array();
        if ($pollId) {
            $storeIds = $this->lookupStoreIds($pollId);
        }
        $object->setStoreIds($storeIds);
    }
        /**
     * Get store ids to which specified item is assigned
     *
     * @param int $id
     * @return array
     */
    public function lookupStoreIds($id)
    {
        return $this->_getReadAdapter()->fetchCol(
            $this->_getReadAdapter()->select()
            ->from(
                $this->getTable(
                    'zeon_jobs/store'
                ),
                'store_id'
            )
            ->where("{$this->getIdFieldName()} = :id_field"),
            array(':id_field' => $id)
        );
    }
    /**
     * Delete current jobs from the table zeon_jobs_store and then
     * insert to update "jobs to store" relations
     *
     * @param Mage_Core_Model_Abstract $object
     */
    public function saveJobStore(Mage_Core_Model_Abstract $object)
    {
        /** stores */
        $deleteWhere = $this->_getReadAdapter()->quoteInto('job_id = ?', $object->getId());
        $this->_getReadAdapter()->delete($this->getTable('zeon_jobs/store'), $deleteWhere);

        foreach ($object->getStoreIds() as $storeId) {
            $jobsStoreData = array(
            'job_id'   => $object->getId(),
            'store_id'  => $storeId
            );
            $this->_getWriteAdapter()->insert($this->getTable('zeon_jobs/store'), $jobsStoreData);
        }
    }
}