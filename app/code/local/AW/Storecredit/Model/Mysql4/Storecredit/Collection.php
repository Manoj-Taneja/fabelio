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

class AW_Storecredit_Model_Mysql4_Storecredit_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('aw_storecredit/storecredit');
    }

    public function joinCustomerTable()
    {
        if (!$this->getFlag('customer_table_joined')) {
            $this->getSelect()
                ->join(
                    array(
                        'customer' => $this->getTable('customer/entity')
                    ),
                    'main_table.customer_id = customer.entity_id',
                    array(
                        'customer.entity_id' => 'customer.entity_id',
                        'email' => 'customer.email',
                        'created_at' => 'customer.created_at',
                        'group_id' => 'customer.group_id'
                    )
                )
            ;
            $this->setFlag('customer_table_joined', true);
        }
        return $this;
    }

    public function joinAllCustomers()
    {
        if (!$this->getFlag('all_customers_joined')) {
            $this->getSelect()->reset(Zend_Db_Select::COLUMNS);
            $this->getSelect()->columns(array('total_balance' => new Zend_Db_Expr('IFNULL(main_table.total_balance,0)')));
            $this->getSelect()->columns(array('balance' => new Zend_Db_Expr('IFNULL(main_table.balance,0)')));
            $this->getSelect()
                ->joinRight(
                    array(
                        'customer' => $this->getTable('customer/entity')
                    ),
                    'main_table.customer_id = customer.entity_id',
                    array(
                        'customer.entity_id' => 'customer.entity_id',
                        'email' => 'customer.email',
                        'created_at' => 'customer.created_at',
                        'group_id' => 'customer.group_id'
                    )
                )
            ;
            $this->setFlag('all_customers_joined', true);
        }
        return $this;
    }

    public function addBalanceSpentColumn() {
        if (!$this->getFlag('balance_spent_column_added')) {
            $this->getSelect()->columns(array('storecredit_spent_balance' => new Zend_Db_Expr('IFNULL(main_table.total_balance - main_table.balance,0)')));
            $this->setFlag('balance_spent_column_added', true);
        }
        return $this;
    }

    public function joinCustomerLogTable()
    {
        if (!$this->getFlag('customer_log_table_joined')) {
            $customerLogTable = $this->getTable('log/customer');
            $this->getSelect()
                ->joinLeft(
                    new Zend_Db_Expr(
                        "(SELECT MAX(login_at) as last_visit, customer_id"
                        . " FROM {$customerLogTable}"
                        . " GROUP BY customer_id)"
                    ),
                    'customer.entity_id = t.customer_id',
                    array('last_visit' => 't.last_visit')
                )
            ;
            $this->setFlag('customer_log_table_joined', true);
        }
        return $this;
    }

    public function joinCustomerName()
    {
        if (!$this->getFlag('customer_name_joined')) {
            $firstnameAttribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'firstname');
            $firstnameAttributeId = $firstnameAttribute->getId();
            $lastnameAttribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'lastname');
            $lastnameAttributeId = $lastnameAttribute->getId();

            $customerTable = Mage::getResourceModel('aw_storecredit/storecredit')->getValueTable('customer/entity','varchar');
            $this->getSelect()
                ->joinLeft(
                    new Zend_Db_Expr(
                        "(SELECT GROUP_CONCAT(value SEPARATOR ' ') as name, entity_id AS storecredit_customer_id"
                        . " FROM {$customerTable}"
                        . " WHERE attribute_id = {$firstnameAttributeId} OR attribute_id = {$lastnameAttributeId}"
                        . " GROUP BY entity_id)"
                    ),
                    'customer.entity_id = t_2.storecredit_customer_id',
                    array('name' => 'IFNULL(t_2.name,"")')
                )
            ;
            $this->setFlag('customer_name_joined', true);
        }
        return $this;
    }

    public function joinCustomerBillingCountryId()
    {
        if (!$this->getFlag('customer_billing_country_id_joined')) {
            $billingCountryIdAttribute = Mage::getSingleton('eav/config')->getAttribute('customer_address', 'country_id');
            $billingCountryIdAttributeId = $billingCountryIdAttribute->getId();

            $customerTable = Mage::getResourceModel('aw_storecredit/storecredit')->getValueTable('customer/address_entity','varchar');
            $this->getSelect()
                ->joinLeft(
                    new Zend_Db_Expr(
                        "(SELECT value AS billing_country_id, entity_id AS storecredit_customer_id"
                        . " FROM {$customerTable}"
                        . " WHERE attribute_id = {$billingCountryIdAttributeId}"
                        . " GROUP BY entity_id)"
                    ),
                    'customer.entity_id = t_3.storecredit_customer_id',
                    array('billing_country_id' => 'IFNULL(t_3.billing_country_id,"")')
                )
            ;
            $this->setFlag('customer_billing_country_id_joined', true);
        }
        return $this;
    }

    public function getSpentBalanceFilterIndex()
    {
        return "(SELECT IFNULL(sc.total_balance - sc.balance,0)
            FROM {$this->getTable('aw_storecredit/storecredit')} as sc
            WHERE sc.customer_id = customer.entity_id
            GROUP BY sc.customer_id)"
            ;
    }

    public function getCustomerLastVisitFilterIndex()
    {
        return "(SELECT MAX(c_log.login_at)
            FROM {$this->getTable('log/customer')} as c_log
            WHERE c_log.customer_id = customer.entity_id
            GROUP BY c_log.customer_id)"
            ;
    }
}