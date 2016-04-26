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

class Zeon_Jobs_Model_Mysql4_Category extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        // Note that the category_id refers to the key field in your database table.
        $this->_init('zeon_jobs/category', 'category_id');
    }

    /**
     * Process jobs category before deleting
     *
     * @param Mage_Core_Model_Abstract $object
     * @return Zeon_Jobs_Model_Mysql4_Category
     */
    protected function _beforeDelete(Mage_Core_Model_Abstract $object)
    {
        $this->_getWriteAdapter()->update(
            $this->getTable('zeon_jobs/jobs'),
            array('category_id' => new Zend_Db_Expr('NULL')),
            array('category_id = ?' => (int)$object->getId())
        );
        return parent::_beforeDelete($object);
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
            'title' => Mage::helper('zeon_jobs')->__('Jobs category with the same title')
        ));
        return $this;
    }

    /**
     * Process category data before saving
     *
     * @param Mage_Core_Model_Abstract $object
     * @return Zeon_Jobs_Model_Mysql4_Category
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        // modify create / update dates
        if ($object->isObjectNew() && !$object->hasCreationTime()) {
            $object->setCreationTime(Mage::getSingleton('core/date')->gmtDate());
        }

        $object->setUpdateTime(Mage::getSingleton('core/date')->gmtDate());

        return parent::_beforeSave($object);
    }

    /**
     * Retrieves job category title from DB by passed id.
     *
     * @param string $id
     * @return string|false
     */
    public function getJobCategoryTitleById($id)
    {
        $adapter = $this->_getReadAdapter();

        $select  = $adapter->select()
            ->from($this->getMainTable(), 'title')
            ->where('category_id = :category_id');

        $binds = array('category_id' => (int) $id);
        return $adapter->fetchOne($select, $binds);
    }
}
