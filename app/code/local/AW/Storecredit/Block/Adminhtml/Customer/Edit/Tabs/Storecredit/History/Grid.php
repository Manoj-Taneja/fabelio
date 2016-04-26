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


class AW_Storecredit_Block_Adminhtml_Customer_Edit_Tabs_Storecredit_History_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Initialize Grid
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('customerHistoryGrid');
        $this->setUseAjax(true);
        $this->setData('customer', Mage::registry('current_customer'));
        $this->setEmptyText(Mage::helper('aw_storecredit')->__('No Transactions Found'));
        $this->setDefaultSort('updated_at');
        $this->setDefaultDir('DESC');
    }

    /**
     * Retrieve current customer object
     *
     * @return Mage_Customer_Model_Customer
     */
    protected function _getCustomer()
    {
        if ($customerId = $this->getCustomerId()) {
            return Mage::getModel('customer/customer')->load($customerId);
        }
        return Mage::registry('current_customer');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('aw_storecredit/history')->getTransactionsCollection();
        $collection->joinStoreCreditTable();
        $collection->addFieldToFilter('customer_id', $this->_getCustomer()->getId());
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $currency = Mage::app()->getWebsite(Mage::app()->getStore()->getId())->getBaseCurrencyCode();
        $this->addColumn('balance_amount', array(
                'header'        => $this->__('Balance'),
                'width'         => 50,
                'index'         => 'balance_amount',
                'type'          => 'price',
                'currency_code' => $currency,
        ));

        $this->addColumn('balance_delta', array(
                'header'        => $this->__('Balance Change'),
                'width'         => 50,
                'index'         => 'balance_delta',
                'align'         => 'right',
                'type'          => 'price',
                'currency_code' => $currency,
                'renderer'      => 'aw_storecredit/adminhtml_widget_grid_column_renderer_balance_delta'
        ));

        $this->addColumn('action', array(
                'header'    => $this->__('Action'),
                'width'     => 100,
                'index'     => 'action',
                'type'      => 'options',
                'options'   => Mage::getModel('aw_storecredit/source_storecredit_history_action')->toOptionArray(),
        ));

        $this->addColumn('additional_info', array(
                'header'        => $this->__('Additional information'),
                'index'         => 'additional_info',
                'filter_index'  => 'history_additional.value',
                'renderer'      => 'aw_storecredit/adminhtml_widget_grid_column_renderer_additional'
        ));

        $this->addColumn('updated_at', array(
                'header'        => $this->__('Date'),
                'index'         => 'updated_at',
                'filter_index'  => 'main_table.updated_at',
                'type'          => 'datetime',
                'width'         => 100,
        ));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('aw_storecredit_admin/adminhtml_customer/customerHistoryGrid', array('_current' => true));
    }
}