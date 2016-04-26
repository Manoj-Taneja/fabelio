<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Full Page Cache
 * @version   1.0.1
 * @build     360
 * @copyright Copyright (C) 2015 Mirasvit (http://mirasvit.com/)
 */



class Mirasvit_Fpc_Model_Resource_Log extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('fpc/log', 'log_id');
    }

    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        if ($object->isObjectNew() && !$object->hasCreatedAt()) {
            $object->setCreatedAt(Mage::getSingleton('core/date')->gmtDate());
        }

        return parent::_beforeSave($object);
    }

    public function aggregate()
    {
        $adapter = $this->_getWriteAdapter();

        try {
            $adapter->delete($this->getTable('fpc/log_aggregated_daily'));

            $periodExpr = new Zend_Db_Expr(sprintf('DATE(%s)', 'created_at'));

            $select = $adapter->select();

            $select->group(array(
                $periodExpr,
                'from_cache',
            ));

            $columns = array(
                'period' => $periodExpr,
                'response_time' => new Zend_Db_Expr('AVG(response_time)'),
                'hits' => new Zend_Db_Expr('COUNT(log_id)'),
                'from_cache' => new Zend_Db_Expr('SUM(from_cache)'),
            );

            $select->from(array('source_table' => $this->getMainTable()), $columns);

            $select->useStraightJoin();
            $insertQuery = $select->insertFromSelect($this->getTable('fpc/log_aggregated_daily'),
                array_keys($columns));
            $adapter->query($insertQuery);
        } catch (Exception $e) {
            throw $e;
        }

        return $this;
    }
}
