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


class AW_Rma_Model_Mysql4_Entity extends Mage_Core_Model_Mysql4_Abstract
{
    const DATETIMEFORMAT = 'Y-m-d H:i:s';

    public function _construct()
    {
        $this->_init('awrma/entity', 'id');
    }

    public function updateCustomerEmailByCustomerId($newEmail, $customerId)
    {
        $writeAdapter = $this->_getWriteAdapter();
        $tableName = Mage::getSingleton('core/resource')->getTableName('awrma/entity');
        $bind  = array('customer_email' => new Zend_Db_Expr('"' . $newEmail . '"'));
        $where = array('`customer_id` = ?' => $customerId);
        $writeAdapter->update($tableName, $bind, $where);
    }

    public function updateCustomerNameByCustomerId($newName, $customerId)
    {
        $writeAdapter = $this->_getWriteAdapter();
        $tableName = Mage::getSingleton('core/resource')->getTableName('awrma/entity');
        $bind  = array('customer_name' => new Zend_Db_Expr('"' . $newName . '"'));
        $where = array('`customer_id` = ?' => $customerId);
        $writeAdapter->update($tableName, $bind, $where);
    }
}