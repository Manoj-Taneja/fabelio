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
class Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Edit_Tab_Purchaseorder extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('purchaseorderGrid');
        $this->setDefaultSort('purchase_order_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        $this->setVarNameFilter('purchaseorder_filter');
    }

    /**
     * prepare collection for block to display
     *
     * @return Magestore_Inventory_Block_Adminhtml_Supplier_Grid
     */
    protected function _prepareCollection() {
        $supplier_id = Mage::app()->getRequest()->getParam('id');
        $collection = Mage::getModel('inventorypurchasing/purchaseorder')->getCollection()->addFieldToFilter('supplier_id', $supplier_id);

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
            $condorder = Mage::helper('inventorypurchasing')->filterDates($condorder, array('from', 'to'));
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
     * @return Magestore_Inventory_Block_Adminhtml_Supplier_Grid
     */
    protected function _prepareColumns() {
        $this->addColumn('purchase_order_id', array(
            'header' => Mage::helper('inventorypurchasing')->__('Order ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'purchase_order_id',
        ));

        $this->addColumn('created_by', array(
            'header' => Mage::helper('inventorypurchasing')->__('Created by'),
            'align' => 'left',
            'index' => 'created_by',
            'width' => '80px',
        ));

        $this->addColumn('purchase_on', array(
            'header' => Mage::helper('inventorypurchasing')->__('Purchased On'),
            'type' => 'date',
            'align' => 'left',
            'index' => 'purchase_on',
            'filter_condition_callback' => array($this, 'filterCreatedOn')
        ));

        $this->addColumn('grand_total_excl_tax', array(
            'header' => Mage::helper('inventorypurchasing')->__('Grand Total Excl .TAX'),
            'width' => '150px',
            'type' => 'number',
			//'sortable'	=> false,
			//'filter' => false,
            'index' => 'total_amount',
            'renderer' => 'Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Renderertotalexcl',
        ));

        $this->addColumn('grand_total_incl_tax', array(
            'header' => Mage::helper('inventorypurchasing')->__('Grand Total Incl.TAX'),
            'width' => '150px',
            'align' => 'right',
			//'sortable'	=> false,
			//'filter' => false,
            'type' => 'number',
            'index' => 'total_amount',
            'renderer' => 'Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Renderertotalincl',
        ));

        $this->addColumn('paid', array(
            'header' => Mage::helper('inventorypurchasing')->__('Paid'),
            'width' => '150px',
            'currency_code' => (string) Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
            'type' => 'price',
            'index' => 'paid',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('inventorypurchasing')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => Mage::helper('inventorypurchasing/purchaseorder')->getPurchaseOrderStatus()
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('inventorypurchasing')->__('Action'),
            'width' => '80px',
            'type' => 'action',
            'getter' => 'getPurchaseOrderId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('inventorypurchasing')->__('View'),
                    'url' => array('base' => 'inventorypurchasingadmin/adminhtml_purchaseorders/edit'),
                    'field' => 'id'
            )),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));

        return parent::_prepareColumns();
    }

    /**
     * prepare mass action for this grid
     *
     * @return Magestore_Inventory_Block_Adminhtml_Supplier_Grid
     */

    /**
     * get url for each row in grid
     *
     * @return string
     */
    public function getRowUrl($row) {
        return false;
    }

    public function filterCreatedOn($collection, $column) {
        return $this;
    }

}