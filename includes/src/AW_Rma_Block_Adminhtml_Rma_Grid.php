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


class AW_Rma_Block_Adminhtml_Rma_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    const GRID_ID = 'rma';
    const ORDERS_GRID_ID = 'rmaOrderGrid';
    const CUSTOMERS_GRID_ID = 'rmaCustomerGrid';

    public function __construct()
    {
        parent::__construct();
        $this->setId(self::GRID_ID)
            ->setDefaultSort('date')
            ->setDefaultDir('DESC')
            ->setSaveParametersInSession(true)
            ->setUseAjax(false)
        ;
        if (Mage::registry('awrmaRequestGridPendingOnly')) {
            $this->setId('rma_pending');
        }
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'id', array(
                'header'                    => $this->__('RMA ID'),
                'index'                     => 'rma_id',
                'type'                      => 'text',
                'width'                     => '100px',
                'filter_condition_callback' => array($this, '_filterIdCondition')
            )
        );

        $this->addColumn(
            'orderid',
            array(
                'header' => $this->__('Order Id'),
                'index'  => 'order_id',
                'width'  => '100px'
            )
        );

        $this->addColumn(
            'date',
            array(
                'header'                    => $this->__('Date'),
                'index'                     => 'created_at',
                'type'                      => 'datetime',
                'width'                     => '150px',
                'filter_condition_callback' => array($this, '_filterDateCondition')
            )
        );

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn(
                'store_id',
                array(
                    'header'                    => $this->__('Store View'),
                    'index'                     => 'store_id',
                    'sortable'                  => false,
                    'type'                      => 'store',
                    'store_all'                 => true,
                    'store_view'                => true,
                    'renderer'                  => 'Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Store',
                    'filter_condition_callback' => array($this, '_filterStoreCondition')
                )
            );
        }

        $this->addColumn(
            'customer_name',
            array(
                'header' => $this->__('Customer Name'),
                'index'  => 'customer_name',
            )
        );

        $this->addColumn(
            'customer_email',
            array(
                'header'                    => $this->__('Customer Email'),
                'index'                     => 'customer_email',
                'filter_condition_callback' => array($this, '_filterCustomerEmailCondition'),
            )
        );

        $filter = 'AW_Rma_Block_Adminhtml_Rma_Grid_Filter_Status';
        if (Mage::registry('awrmaRequestGridPendingOnly')) {
            $filter = false;
        }
        $this->addColumn(
            'status_name',
            array(
                'header'                    => $this->__('Status'),
                'index'                     => 'status_name',
                'filter'                    => $filter,
                'filter_condition_callback' => array($this, '_filterStatusCondition'),
            )
        );

        if (Mage::helper('awrma/config')->getReasonsEnabled()) {
            $this->addColumn(
                'reason_name',
                array(
                    'header' => $this->__('Reason'),
                    'index'  => 'reason_name',
                    'filter' => false,
                )
            );
        }

        $this->addColumn(
            'actions',
            array(
                'header'  => $this->__('Actions'),
                'width'   => '100px',
                'type'    => 'action',
                'getter'  => 'getId',
                'actions' => array(
                    array(
                        'caption' => $this->__('Edit'),
                        'url'     => array('base' => 'awrma_admin/adminhtml_rma/edit'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'is_system' => true,
            )
        );

        $this->addExportType('*/*/createcsv', Mage::helper('awrma')->__('CSV'));
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('awrma/entity')
            ->getCollection()
            ->joinOrderStore()
            ->joinStatusNames()
            ->joinReasonNames()
        ;
        if (Mage::registry('awrmaRequestGridPendingOnly')) {
            $collection->setStatusFilter(Mage::helper('awrma/status')->getPendingApprovalStatusId());
        }
        if ($this->getOrderMode()) {
            $collection->addFieldToFilter('order_id', $this->getOrderMode());
        }
        if ($this->getCustomerMode()) {
            $collection->addFieldToFilter('main_table.customer_id', $this->getCustomerMode());
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    public function getGridUrl()
    {
        $params = array();
        if ($this->getOrderMode()) {
            $params = array('active_tab' => 'Requests');
        }
        return $this->getCurrentUrl($params);
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('awrma_admin/adminhtml_rma/edit', array('id' => $row->getId()));
    }

    protected function _filterStoreCondition($collection, $column)
    {
        if (!($value = $column->getFilter()->getValue())) {
            return;
        }
        $collection->getSelect()->where('find_in_set(?, o.store_id)', $value);
    }

    protected function _filterStatusCondition($collection, $column)
    {
        if (!($value = $column->getFilter()->getValue())) {
            return;
        }
        $collection->getSelect()->where('main_table.status = ?', $value);
    }

    protected function _filterIdCondition($collection, $column)
    {
        if (!($value = $column->getFilter()->getValue())) {
            return;
        }
        $collection->getSelect()->where('main_table.rma_id LIKE \'%' . $value . '%\'');
    }

    protected function _filterCustomerEmailCondition($collection, $column)
    {
        if (!($value = $column->getFilter()->getValue())) {
            return;
        }
        $collection->getSelect()->where('main_table.customer_email LIKE \'%' . $value . '%\'');
    }

    protected function _filterDateCondition($collection, $column)
    {
        if (!($value = $column->getFilter()->getValue())) {
            return;
        }
        $date = $column->getFilter()->getValue();
        if (isset($date['from'])) {
            $from = $date['from']->toString('Y-M-d H:m:s');
            $collection->getSelect()->where('main_table.created_at >= \'' . $from . '\'');
        }
        if (isset($date['to'])) {
            $to = $date['to']->toString('Y-M-d H:m:s');
            $collection->getSelect()->where('main_table.created_at <= \'' . $to . '\'');
        }
    }
}
