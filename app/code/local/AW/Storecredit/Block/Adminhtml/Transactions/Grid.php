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

class AW_Storecredit_Block_Adminhtml_Transactions_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected $_collection;

    public function __construct()
    {
        parent::__construct();
        $this->setId('transactionsGrid');
        $this->setDefaultSort('updated_at');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('aw_storecredit/history')->getTransactionsCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
                'header'        => $this->__('ID'),
                'index'         => 'history_id',
                'filter_index'  => 'main_table.history_id',
                'type'          => 'int',
                'width'         => 50,
        ));

        $this->addColumn('name', array(
                'header'    => $this->__('Name'),
                'index'     => 'name',
                'renderer'  => 'aw_storecredit/adminhtml_widget_grid_column_renderer_customer'
        ));

        $this->addColumn('customer_email', array(
                'header'        => $this->__('Email'),
                'width'         => '150',
                'index'         => 'customer_email',
                'filter_index'  => 'email'
        ));

        $this->addColumn('updated_at', array(
                'header'        => $this->__('Date'),
                'index'         => 'updated_at',
                'filter_index'  => 'main_table.updated_at',
                'type'          => 'datetime',
                'width'         => 200,
        ));

        $this->addColumn('action', array(
                'header'    => $this->__('Action'),
                'width'     => 100,
                'index'     => 'action',
                'type'      => 'options',
                'options'   => Mage::getModel('aw_storecredit/source_storecredit_history_action')->toOptionArray(),
        ));

        $currency = Mage::app()->getWebsite(Mage::app()->getStore()->getId())->getBaseCurrencyCode();
        $this->addColumn('balance_delta', array(
                'header'        => $this->__('Balance Change'),
                'width'         => 50,
                'index'         => 'balance_delta',
                'align'         => 'right',
                'type'          => 'price',
                'currency_code' => $currency,
                'renderer'      => 'aw_storecredit/adminhtml_widget_grid_column_renderer_balance_delta',
        ));

        $this->addColumn('balance_amount', array(
                'header'        => $this->__('Balance'),
                'width'         => 50,
                'index'         => 'balance_amount',
                'type'          => 'price',
                'currency_code' => $currency,
        ));

        $this->addColumn('additional_info', array(
                'header'        => $this->__('Additional information'),
                'index'         => 'additional_info',
                'filter_index'  => 'history_additional.value',
                'renderer'      => 'aw_storecredit/adminhtml_widget_grid_column_renderer_additional'
        ));

        $this->addExportType('*/*/exportCsv', $this->__('CSV'));
        $this->addExportType('*/*/exportXml', $this->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _exportCsvItem(Varien_Object $item, Varien_Io_File $adapter)
    {
        $row = array();
        foreach ($this->_columns as $column) {
            if (!$column->getIsSystem()) {
                $row[] = strip_tags($column->getRowFieldExport($item));
            }
        }
        $adapter->streamWriteCsv($row);
    }

    protected function _exportExcelItem(Varien_Object $item, Varien_Io_File $adapter, $parser = null)
    {
        if (is_null($parser)) {
            $parser = new Varien_Convert_Parser_Xml_Excel();
        }

        $row = array();
        foreach ($this->_columns as $column) {
            if (!$column->getIsSystem()) {
                $row[] = strip_tags($column->getRowFieldExport($item));
            }
        }
        $data = $parser->getRowXml($row);
        $adapter->streamWrite($data);
    }

    public function getRowUrl($row)
    {
        return '';
    }
}