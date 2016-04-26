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

class Zeon_Jobs_Model_Mysql4_Jobs_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('zeon_jobs/jobs');
        $this->_map['fields']['job_id'] = 'main_table.job_id';
        $this->_map['fields']['title'] = 'main_table.title';
        $this->_map['fields']['update_time'] = 'main_table.update_time';
        $this->_map['fields']['status'] = 'main_table.status';
    }

/**
     * Add stores column
     *
     * @return Zeon_Jobs_Model_Mysql4_Jobs_Collection
     */
    protected function _afterLoad()
    {
        parent::_afterLoad();
        if ($this->getFlag('add_stores_column')) {
            $this->_addStoresVisibility();
        }
        $this->_addCategory();
        return $this;
    }

    /**
     * Set add stores column flag
     *
     * @return Zeon_Jobs_Model_Mysql4_Jobs_Collection
     */
    public function addStoresVisibility()
    {
        $this->setFlag('add_stores_column', true);
        return $this;
    }

    /**
     * Collect and set stores ids to each collection item
     * Used in jobs grid as Visible in column info
     *
     * @return Zeon_Jobs_Model_Mysql4_Jobs_Collection
     */
    protected function _addStoresVisibility()
    {
        $jobIds = $this->getColumnValues('job_id');
        $jobStores = array();
        if (sizeof($jobIds)>0) {
            $select = $this->getConnection()->select()
                ->from($this->getTable('zeon_jobs/store'), array('store_id', 'job_id'))
                ->where('job_id IN(?)', $jobIds);
            $jobRaw = $this->getConnection()->fetchAll($select);

            foreach ($jobRaw as $job) {
                if (!isset($jobStores[$job['job_id']])) {
                    $jobStores[$job['job_id']] = array();
                }

                $jobStores[$job['job_id']][] = $job['store_id'];
            }
        }

        foreach ($this as $item) {
            if (isset($jobStores[$item->getId()])) {
                $item->setStores($jobStores[$item->getId()]);
            } else {
                $item->setStores(array());
            }
        }

        return $this;
    }

    /**
     * Collect and set category title to each collection item
     * Used in jobs grid as Category in column info
     *
     * @return Zeon_Jobs_Model_Mysql4_Jobs_Collection
     */
    protected function _addCategory()
    {
        $categoryIds = $this->getColumnValues('category_id');
        $categories = array();
        if (sizeof($categoryIds)>0) {
            $select = $this->getConnection()->select()
                ->from($this->getTable('zeon_jobs/category'), array('category_id','title'))
                ->where('category_id IN(?)', $categoryIds);
            $categoryRaw = $this->getConnection()->fetchAll($select);

            foreach ($categoryRaw as $category) {
                if (!isset($categories[$category['category_id']])) {
                    $categories[$category['category_id']] = array();
                }

                $categories[$category['category_id']] = $category['title'];
            }
        }

        foreach ($this as $item) {
            if (isset($categories[$item->getCategoryId()])) {
                $item->setCategoryName($categories[$item->getCategoryId()]);
            } else {
                $item->setCategoryName('');
            }
        }

        return $this;
    }

    /**
     * Add Filter by store
     *
     * @param int|array $storeIds
     * @param bool $withAdmin
     * @return Zeon_Jobs_Model_Mysql4_Jobs_Collection
     */
    public function addStoreFilter($storeIds, $withAdmin = true)
    {
        if (!$this->getFlag('store_filter')) {
            if ($withAdmin) {
                $storeIds = array(0, $storeIds);
            }

            $this->getSelect()->join(
                array('store_table' => $this->getTable('zeon_jobs/store')),
                'main_table.job_id = store_table.job_id',
                array()
            )
            ->where('store_table.store_id in (?)', $storeIds)
            //->group('main_table.job_id')
            ;

            $this->setFlag('store_filter', true);
        }
        return $this;
    }

    /**
     * Add Filter by category
     *
     * @param string $categoryTitle
     * @return Zeon_Jobs_Model_Mysql4_Jobs_Collection
     */
    public function addCategoryFilter($categoryTitle)
    {
        if (!$this->getFlag('category_filter')) {
            $this->getSelect()->join(
                array('category_table' => $this->getTable('zeon_jobs/category')),
                'main_table.category_id = category_table.category_id',
                array()
            )
            ->where('category_table.title like (?)', $categoryTitle);

            $this->setFlag('category_filter', true);
        }
        return $this;
    }
}