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
class Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Edit_Tab_Returnorder extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('returnorderGrid');
        $this->setDefaultSort('return_product_warehouse_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        $this->setVarNameFilter('returnorder_filter');
    }

    /**
     * prepare collection for block to display
     *
     * @return Magestore_Inventory_Block_Adminhtml_Supplier_Grid
     */
    protected function _prepareCollection() {
        $supplier_id = Mage::app()->getRequest()->getParam('id');
        $purchaseOrderIds = array();
        $returnOrders = Mage::getModel('inventorypurchasing/purchaseorder_refund')->getCollection()->addFieldToFilter('supplier_id', $supplier_id);
        foreach ($returnOrders as $returnOrder)
            $purchaseOrderIds[] = $returnOrder->getData('purchase_order_id');
        $collection = Mage::getModel('inventorypurchasing/purchaseorder_returnproductwarehouse')->getCollection()
                ->addFieldToFilter('purchase_order_id', array('in' => $purchaseOrderIds));
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare columns for this grid
     *
     * @return Magestore_Inventory_Block_Adminhtml_Supplier_Grid
     */
    protected function _prepareColumns() {
        $this->addColumn('return_product_warehouse_id', array(
            'header' => Mage::helper('inventorypurchasing')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'return_product_warehouse_id',
        ));

        $this->addColumn('returned_on', array(
            'header' => Mage::helper('inventorypurchasing')->__('Return Date'),
            'width' => '150px',
            'type' => 'datetime',
            'index' => 'returned_on',
        ));

        $this->addColumn('product_name', array(
            'header' => Mage::helper('inventorypurchasing')->__('Product Name'),
            'align' => 'left',
            'index' => 'product_name',
        ));

        $this->addColumn('warehouse_name', array(
            'header' => Mage::helper('inventorypurchasing')->__('Warehouse'),
            'width' => '80px',
            'index' => 'warehouse_name'
        ));

        $this->addColumn('qty_return', array(
            'header' => Mage::helper('inventorypurchasing')->__('Qty Returned'),
            'width' => '150px',
            'name' => 'qty_return',
            'type' => 'number',
            'index' => 'qty_return'
        ));

        $this->addColumn('created_by', array(
            'header' => Mage::helper('inventorypurchasing')->__('Created by'),
            'name' => 'created_by',
            'width' => '80px',
            'index' => 'created_by'
        ));

        $this->addColumn('reason', array(
            'header' => Mage::helper('inventorypurchasing')->__('Reason(s)'),
            'name' => 'reason',
            'width' => '150px',
            'index' => 'reason'
        ));
        return parent::_prepareColumns();
    }

    protected function _prepareColumnsOldVersion() {
        $this->addColumn('returned_order_id', array(
            'header' => Mage::helper('inventorypurchasing')->__('Order ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'returned_order_id',
        ));

        $this->addColumn('returned_on', array(
            'header' => Mage::helper('inventorypurchasing')->__('Returned On'),
            'align' => 'left',
            'type' => 'date',
            'index' => 'returned_on',
        ));

        $this->addColumn('grand_total_excl_tax', array(
            'header' => Mage::helper('inventorypurchasing')->__('Grand Total Excl .TAX'),
            'width' => '150px',
            'currency_code' => (string) Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
            'type' => 'price',
            'index' => 'total_amount',
            'renderer' => 'Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Renderertotalexcl',
        ));

        $this->addColumn('grand_total_incl_tax', array(
            'header' => Mage::helper('inventorypurchasing')->__('Grand Total Incl.TAX'),
            'width' => '150px',
            'align' => 'right',
            'currency_code' => (string) Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
            'type' => 'price',
            'index' => 'total_amount',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('inventorypurchasing')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => Mage::helper('inventorypurchasing/purchaseorder')->getReturnOrderStatus()
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('inventorypurchasing')->__('Action'),
            'width' => '80',
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
        return $this->getUrl('*/adminhtml_purchaseorders/edit', array('id' => $row->getPurchaseOrderId(),'active' => 'return'));
    }

}