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

class AW_Storecredit_Model_Mysql4_Order_Invoice_Storecredit_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('aw_storecredit/order_invoice_storecredit');
    }

    public function joinStorecreditTable()
    {
        $this->getSelect()
            ->joinLeft(
                array(
                     'storecredit' => $this->getTable('aw_storecredit/storecredit')
                ),
                'main_table.storecredit_id = storecredit.entity_id',
                array(
                     'storecredit_balance' => 'storecredit.balance'
                )
            )
        ;
        return $this;
    }

    public function groupBy($columnName)
    {
        $this
            ->getSelect()
            ->group($columnName)
        ;
        return $this;
    }

    public function setFilterByInvoiceIds(array $invoiceIds)
    {
        $this->getSelect()->where('invoice_entity_id IN (?)', $invoiceIds);
        return $this;
    }

    public function setFilterByInvoiceId($invoiceId)
    {
        $this->getSelect()->where('invoice_entity_id = ?', $invoiceId);
        return $this;
    }

    public function setFilterByStorecreditId($storecreditId)
    {
        $this->getSelect()->where('storecredit_id = ?', $storecreditId);
        return $this;
    }

    public function addSumBaseAmountToFilter()
    {
        $this->addExpressionFieldToSelect(
            'base_storecredit_amount',
            'SUM({{base_storecredit_amount}})',
            'base_storecredit_amount'
        );
        return $this;
    }

    public function addSumAmountToFilter()
    {
        $this->addExpressionFieldToSelect(
            'storecredit_amount',
            'SUM({{storecredit_amount}})',
            'storecredit_amount'
        );
        return $this;
    }
}