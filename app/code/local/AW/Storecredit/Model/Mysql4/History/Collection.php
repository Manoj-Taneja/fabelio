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

class AW_Storecredit_Model_Mysql4_History_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('aw_storecredit/history');
    }

    protected function _afterLoadData()
    {
        foreach ($this->getItems() as $item) {
            Mage::getResourceModel('aw_storecredit/history')->unserializeFields($item);
        }
        return parent::_afterLoadData();
    }

    public function joinStoreCreditTable()
    {
        if (!$this->getFlag('storecredit_table_joined')) {
            $this->getSelect()
                ->joinLeft(
                    array(
                        'storecredit' => $this->getTable('aw_storecredit/storecredit')
                    ),
                    'main_table.storecredit_id = storecredit.entity_id',
                    array(
                        'customer.entity_id' => 'storecredit.customer_id'
                    )
                )
            ;
            $this->setFlag('storecredit_table_joined', true);
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

            $customerTable = Mage::getResourceModel('aw_storecredit/history')->getValueTable('customer/entity','varchar');
            $this->getSelect()
                ->joinLeft(
                    new Zend_Db_Expr(
                        "(SELECT GROUP_CONCAT(value SEPARATOR ' ') as name,  entity_id AS storecredit_customer_id"
                        . " FROM {$customerTable}"
                        . " WHERE attribute_id = {$firstnameAttributeId} OR attribute_id = {$lastnameAttributeId}"
                        . " GROUP BY entity_id)"
                    ),
                    'storecredit.customer_id = t.storecredit_customer_id',
                    array(
                        'name' => 'IFNULL(t.name,"")'
                    )
                )
            ;
            $this->setFlag('customer_name_joined', true);
        }
        return $this;
    }

    public function joinCustomerEmail()
    {
        if (!$this->getFlag('customer_email_joined')) {
            $this->getSelect()
                ->join(
                    array(
                        'customer' => $this->getTable('customer/entity')
                    ),
                    'storecredit.customer_id = customer.entity_id',
                    array(
                        'customer_email' => 'customer.email'
                    )
                )
            ;
            $this->setFlag('customer_email_joined', true);
        }
        return $this;
    }

    public function joinAdditionalInfoTable()
    {
        if (!$this->getFlag('history_additional_table_joined')) {
            $localeCode = Mage::app()->getLocale()->getLocaleCode();
            $this->getSelect()
                ->joinLeft(
                    array(
                        'history_additional' => $this->getTable('aw_storecredit/history_additional')
                    ),
                    "main_table.history_id = history_additional.history_id AND history_additional.locale_code = '{$localeCode}'",
                    array(
                        'history_additional_info' => 'history_additional.value'
                    )
                )
            ;
            $this->setFlag('history_additional_table_joined', true);
        }
        return $this;
    }
}