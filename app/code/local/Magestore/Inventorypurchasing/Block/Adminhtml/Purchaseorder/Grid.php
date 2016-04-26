<?php

/**
 * Magestore
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventory Supplier Grid Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('purchaseorderGrid');
        $this->setDefaultSort('purchase_order_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * prepare collection for block to display
     *
     * @return Magestore_Inventory_Block_Adminhtml_Purchaseorder_Grid
     */
    protected function _prepareCollection() {
        $collection = Mage::getModel('inventorypurchasing/purchaseorder')->getCollection();

        $filter = $this->getParam($this->getVarNameFilter(), null);
        $condorder = '';
        if ($filter) {
            $data = $this->helper('adminhtml')->prepareFilterString($filter);
            foreach ($data as $value => $key) {
                if ($value == 'purchase_on') {
                    $condorder = $key;
                }
            }
        }
        if ($condorder) {
            $condorder = Mage::helper('inventoryplus')->filterDates($condorder, array('from', 'to'));
            $from = $condorder['from'];
            $to = $condorder['to'];
            if ($from) {
                $from = date('Y-m-d', strtotime($from));
                $collection->addFieldToFilter('purchase_on', array('gteq' => $from));
            }
            if ($to) {
                $to = date('Y-m-d', strtotime($to));
                $to .= ' 23:59:59';
                $collection->addFieldToFilter('purchase_on', array('lteq' => $to));
            }
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare columns for this grid
     *
     * @return Magestore_Inventory_Block_Adminhtml_Purchaseorder_Grid
     */
    protected function _prepareColumns() {
        $currencyCode = Mage::app()->getStore()->getBaseCurrency()->getCode();
        $this->addColumn('purchase_order_id', array(
            'header' => Mage::helper('inventorypurchasing')->__('Order #'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'purchase_order_id',
        ));

        $this->addColumn('purchase_on', array(
            'header' => Mage::helper('inventorypurchasing')->__('Purchased On'),
            'align' => 'right',
            'type' => 'date',
            'index' => 'purchase_on',
            'filter_condition_callback' => array($this, 'filterCreatedOn')
        ));

        $this->addColumn('created_by', array(
            'header' => Mage::helper('inventorypurchasing')->__('Created by'),
            'width' => '80px',
            'align' => 'left',
            'index' => 'created_by'
        ));

        $this->addColumn('bill_name', array(
            'header' => Mage::helper('inventorypurchasing')->__('Bill to Name'),
            'width' => '150px',
            'align' => 'left',
            'index' => 'bill_name',
        ));

        $this->addColumn('warehouse_id', array(
            'header' => Mage::helper('inventorypurchasing')->__('Warehouse'),
            'type' => 'options',
            'align' => 'left',
            'options' => Mage::helper('inventoryplus/warehouse')->getAllWarehouseName(),
            'renderer' => 'inventorypurchasing/adminhtml_purchaseorder_renderer_warehouse',
            'filter_index' => 'warehouse_id',
            'filter_condition_callback' => array($this, 'filterCallback'),
            'index' => 'warehouse_id'
        ));

        $this->addColumn('supplier_name', array(
            'header' => Mage::helper('inventorypurchasing')->__('Supplier'),
			'type' => 'options',
            'width' => '150px',
            'align' => 'left',
            'index' => 'supplier_name',
			'options' => Mage::helper('inventorypurchasing/supplier')->getAllSupplierName(),
            'renderer' => 'inventorypurchasing/adminhtml_purchaseorder_renderer_supplier',
			'filter_condition_callback' => array($this, 'filterSupplierCallback')
        ));

        $this->addColumn('total_products', array(
            'header' => Mage::helper('inventorypurchasing')->__('Qty Requested'),
            'width' => '150px',
            'type' => 'number',
            'align' => 'right',
            'index' => 'total_products',
        ));
        $this->addColumn('total_products_recieved', array(
            'header' => Mage::helper('inventorypurchasing')->__('Qty Received'),
            'width' => '150px',
            'type' => 'number',
            'align' => 'right',
            'index' => 'total_products_recieved',
        ));

        $this->addColumn('total_amount', array(
            'header' => Mage::helper('inventorypurchasing')->__('Subtotal'),
            'width' => '150px',
            'type' => 'number',
            'align' => 'right',
            'index' => 'total_amount',
			'filter_index' => 'total_amount',
            'renderer' => 'inventorypurchasing/adminhtml_purchaseorder_renderer_total',
			'filter_condition_callback' => array($this, 'filterTotalAmount')
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('inventorypurchasing')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => Mage::helper('inventorypurchasing/purchaseorder')->getReturnOrderStatus(),
        ));
		$labelAction = __('Edit');
        $this->addColumn('action', array(
            'header' => Mage::helper('inventorypurchasing')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => $labelAction,
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
            )),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('inventorypurchasing')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('inventorypurchasing')->__('XML'));

        return parent::_prepareColumns();
    }

    public function filterCallback($collection, $column) {
        $value = $column->getFilter()->getValue();
        if (!is_null(@$value)) {
            $collection->getSelect()->where('warehouse_id like ?', '%' . $value . '%');
        }
        return $this;
    }

    /**
     * prepare mass action for this grid
     *
     * @return Magestore_Inventory_Block_Adminhtml_Supplier_Grid
     */
    protected function _prepareMassaction() {
        $this->setMassactionIdField('purchase_order_id');
        $this->getMassactionBlock()->setFormFieldName('purchaseorder_ids');

        $statuses = Mage::helper('inventorypurchasing/purchaseorder')->getMassPOStatus();
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('inventorypurchasing')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
			'visibility' => array(
			'name' => 'status',
			'type' => 'select',
			'class' => 'required-entry',
			'label' => Mage::helper('inventorypurchasing')->__('Status'),
			'values' => $statuses
            ))
        ));
        return $this;
    }

    /**
     * get url for each row in grid
     *
     * @return string
     */
    public function getRowUrl($row) {
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function filterCreatedOn($collection, $column) {
        return $this;
    }
	public function filterTotalAmount($collection, $column) {
        $filter = $column->getFilter()->getValue();
        if (isset($filter['from']) && $filter['from']) {
            $collection->getSelect()->where('total_amount >= ?', $filter['from']);
        }
        if (isset($filter['to']) && $filter['to']) {
            $collection->getSelect()->where('total_amount <= ?', $filter['to']);
        }
    }

}