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

class AW_Storecredit_Block_Adminhtml_Transactions_Add_Customer_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected $_gridIds = null;

    public function __construct()
    {
        parent::__construct();
        $this->setId('storecreditCustomerGrid');
        $this->setDefaultSort('entity_id', 'desc');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('aw_storecredit/storecredit')->getAllCustomerCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('customer_id', array(
            'header'        => $this->__('Customer ID'),
            'index'         => 'customer.entity_id',
            'filter_index'  => 'customer.entity_id',
            'type'          => 'number',
            'width'         => 10
        ));

        $this->addColumn('name', array(
            'header'    => $this->__('Name'),
            'index'     => 'name',
            'renderer'  => 'aw_storecredit/adminhtml_widget_grid_column_renderer_customer'
        ));

        $this->addColumn('email', array(
                'header'    => $this->__('Email'),
                'width'     => '150',
                'index'     => 'email'
        ));

        $groups = Mage::getResourceModel('customer/group_collection')
            ->addFieldToFilter('customer_group_id', array('gt'=> 0))
            ->load()
            ->toOptionHash();

        $this->addColumn('group', array(
                'header'    =>  $this->__('Group'),
                'width'     =>  '100',
                'index'     =>  'group_id',
                'type'      =>  'options',
                'options'   =>  $groups,
        ));

        $this->addColumn('billing_country_id', array(
                'header'    => $this->__('Country'),
                'width'     => '100',
                'type'      => 'country',
                'index'     => 'billing_country_id',
        ));

        $this->addColumn('customer_since', array(
                'header'    => $this->__('Customer Since'),
                'type'      => 'datetime',
                'align'     => 'center',
                'index'     => 'created_at',
                'filter_index' => 'customer.created_at',
                'gmtoffset' => true
        ));

        $this->addColumn('last_visit', array(
                'header'        => $this->__('Last Visit'),
                'type'          => 'datetime',
                'align'         => 'center',
                'index'         => 'last_visit',
                'filter_index'  => Mage::getModel('aw_storecredit/storecredit')->getCollection()->getCustomerLastVisitFilterIndex(),
                'gmtoffset'     => true
        ));

        $this->addColumn('total_balance', array(
                'header'        => $this->__('Total Credit Earned'),
                'currency_code' => Mage::app()->getStore()->getBaseCurrency()->getCode(),
                'type'          => 'number',
                'renderer'      => 'aw_storecredit/adminhtml_widget_grid_column_renderer_currency',
                'index'         => 'total_balance',
                'filter_index'  => 'IFNULL(total_balance,0)',
                'width'         => 200,
        ));

        $this->addColumn('storecredit_spent_balance', array(
                'header'        => $this->__('Total Credit Spent'),
                'currency_code' => Mage::app()->getStore()->getBaseCurrency()->getCode(),
                'type'          => 'number',
                'renderer'      => 'aw_storecredit/adminhtml_widget_grid_column_renderer_currency',
                'index'         => 'storecredit_spent_balance',
                'filter_index'  => 'IFNULL(total_balance - balance,0)',
                'width'         => 200,
            ));

        $this->addColumn('balance', array(
                'header'        => $this->__('Current Balance'),
                'currency_code' => Mage::app()->getStore()->getBaseCurrency()->getCode(),
                'type'          => 'number',
                'renderer'      => 'aw_storecredit/adminhtml_widget_grid_column_renderer_currency',
                'index'         => 'balance',
                'filter_index'  => 'IFNULL(balance,0)',
                'width'         => 200,
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('customer.entity_id');
        $this->getMassactionBlock()->setFormFieldName('entity_id');

        $this->getMassactionBlock()->addItem('subscribe', array(
        ));
    }

    public function getJsonGridIds()
    {
        if(empty($this->_gridIds)) {
            $collection = clone $this->getCollection();
            $collection->clear();
            $collection->resetData();
            $collection->setCurPage(0);
            $collection->setPageSize(false);
            $collection->getSelect()->reset(Zend_Db_Select::LIMIT_COUNT);
            $collection->getSelect()->reset(Zend_Db_Select::LIMIT_OFFSET);

            $this->_gridIds = $collection->getColumnValues('customer.entity_id');
            $this->_gridIds = implode(',', $this->_gridIds);
        }
        return $this->_gridIds;
    }

    protected function _toHtml()
    {
        $html = parent::_toHtml();
        $html .= "<script type='text/javascript'>"
            . $this->getId() . "_massactionJsObject.setGridIds('" . $this->getJsonGridIds() . "');"
            . "</script>";
        return $html;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=> true));
    }

    public function getRowUrl($row)
    {
        return '';
    }
}