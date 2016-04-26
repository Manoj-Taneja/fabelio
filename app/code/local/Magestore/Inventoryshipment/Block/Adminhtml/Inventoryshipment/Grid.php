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
 * @package     Magestore_Inventoryshipment
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventoryshipment Grid Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventoryshipment
 * @author      Magestore Developer
 */
class Magestore_Inventoryshipment_Block_Adminhtml_Inventoryshipment_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('sales_order_grid');
        $this->setDefaultSort('order_created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }
    
    protected function _getCollectionClass() {
        return 'inventoryshipment/order_grid_collection';
    }
    
    public function getWarehouseShipmentCollection() {
        $resource = Mage::getSingleton('core/resource');
        $collection = Mage::getResourceModel($this->_getCollectionClass());
//        $collection->addAttributeToSelect('*');
        $collection->getSelect()
                ->joinLeft(array('order' => $resource->getTableName('sales/order')), 'main_table.entity_id=order.entity_id', array('shipping_progress' => 'shipping_progress', 'order_created_at' => 'created_at','order_store_id'=>'store_id','order_base_grand_total'=>'base_grand_total','order_grand_total'=>'grand_total'))
                ->joinLeft(
                        array('inventory_shipment' => $resource->getTableName('inventoryplus/warehouse_shipment')), 'main_table.entity_id=inventory_shipment.order_id', array('GROUP_CONCAT(DISTINCT inventory_shipment.warehouse_name) AS names')
                )
                ->group('main_table.entity_id')
        ;
        return $collection;
    }
    /**
     * prepare collection for block to display
     *
     * @return Magestore_Inventoryshipment_Block_Adminhtml_Inventoryshipment_Grid
     */
    
    protected function _prepareCollection() {
        $collection = $this->getWarehouseShipmentCollection();    
        $collection->setIsGroupCountSql(true);
        $this->setCollection($collection);
        try {
            parent::_prepareCollection();
        } catch (Exception $e) {
            
        }
        return $this;
    }
        
    
    /**
     * prepare columns for this grid
     *
     * @return Magestore_Inventoryshipment_Block_Adminhtml_Inventoryshipment_Grid
     */
    
    protected function _prepareColumns() {

        $this->addColumn('real_order_id', array(
            'header' => Mage::helper('sales')->__('Order #'),
            'width' => '80px',
            'align' => 'right',
            'type' => 'text',
            'index' => 'increment_id',
            'filter_condition_callback' => array($this, 'filterIncrementId')
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('order_store_id', array(
                'header' => Mage::helper('sales')->__('Purchased From (Store)'),
                'index' => 'order_store_id',
                'type' => 'store',
                'align' => 'left',
                'store_view' => true,
                'display_deleted' => true,
                'filter_condition_callback' => array($this, 'filterStore')
            ));
        }

        $this->addColumn('order_created_at', array(
            'header' => Mage::helper('sales')->__('Purchased On'),
            'index' => 'order_created_at',
            'type' => 'datetime',
            'align' => 'right',
            'width' => '100px',
            'filter_condition_callback' => array($this, 'filterCreatedAt')
        ));

        $this->addColumn('billing_name', array(
            'header' => Mage::helper('sales')->__('Bill to Name'),
            'align' => 'left',
            'index' => 'billing_name',
        ));

        $this->addColumn('shipping_name', array(
            'header' => Mage::helper('sales')->__('Ship to Name'),
            'align' => 'left',
            'index' => 'shipping_name',
        ));

        $this->addColumn('order_base_grand_total', array(
            'header' => Mage::helper('sales')->__('G.T. (Base)'),
            'index' => 'order_base_grand_total',
            'type' => 'currency',
            'align' => 'right',
            'currency' => 'base_currency_code',
            'filter_condition_callback' => array($this, 'filterBaseGrandTotal')
        ));

        $this->addColumn('order_grand_total', array(
            'header' => Mage::helper('sales')->__('G.T. (Purchased)'),
            'index' => 'order_grand_total',
            'type' => 'currency',
            'align' => 'right',
            'currency' => 'order_currency_code',
            'filter_condition_callback' => array($this, 'filterGrandTotal')
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('sales')->__('Order Status'),
            'index' => 'status',
            'type' => 'options',
            'align' => 'left',
            'width' => '70px',
            'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
            'filter_index' => 'main_table.status',
        ));

        $this->addColumn('shipping_progress', array(
            'header' => Mage::helper('sales')->__('Shipping Progress'),
            'width' => '70px',
            'type' => 'options',
            'align' => 'center',
            'options' => array(
                0 => Mage::helper('inventoryshipment')->__('Not shipped'),
                1 => Mage::helper('inventoryshipment')->__('Partially shipped'),
                2 => Mage::helper('inventoryshipment')->__('Complete'),
                3 => Mage::helper('inventoryshipment')->__('Canceled'),
                4 => Mage::helper('inventoryshipment')->__('Closed')
            ),
            'sortable' => false,
            'index' => 'shipping_progress',
            'filter_index' => 'order.shipping_progress',
            'renderer' => 'inventoryshipment/adminhtml_inventoryshipment_renderer_shipping'
        ));

        $this->addColumn('names', array(
            'header' => Mage::helper('sales')->__('Warehouses Shipped'),
            'index' => 'names',
            'align' => 'left',
            'filter_index' => 'inventory_shipment.warehouse_name',
            'type' => 'options',
            'options' => Mage::helper('inventoryshipment')->getAllWarehouseName(),
            'filter_condition_callback' => array($this, 'filterCallback'),
            'sortable' => false,
            'renderer' => 'inventoryshipment/adminhtml_inventoryshipment_renderer_warehouse'
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('sales')->__('Action'),
            'width' => '100px',
            'filter' => false,
            'align' => 'right',
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
            'renderer' => 'inventoryshipment/adminhtml_inventoryshipment_renderer_action'
        ));        

        $this->addExportType('*/*/exportCsv', Mage::helper('inventoryshipment')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('inventoryshipment')->__('XML'));

        return parent::_prepareColumns();
    }
    
    /**
     * Callback filter for Warehouse
     * 
     * @param type $collection
     * @param type $column
     * @return type
     */
    public function filterCallback($collection, $column) {
        $value = $column->getFilter()->getValue();
        if (!is_null(@$value)) {
            $collection->getSelect()->where('inventory_shipment.warehouse_id = ?', $value);
        }
        return $this;
    }
    
    public function filterCreatedAt($collection, $column) {
        $condorder = $column->getFilter()->getValue();
        if ($condorder) {
            $from = $to = '';
            if(isset($condorder['from']))
                $from = $condorder['from'];
            if(isset($condorder['to']))
                $to = $condorder['to'];
            if ($from) {
                $from = date('Y-m-d H:i:s', strtotime($from));
                $collection->addFieldToFilter('order.created_at', array('gteq' => $from));
            }
            if ($to) {
                $to = date('Y-m-d H:i:s', strtotime($to));               
                $collection->addFieldToFilter('order.created_at', array('lteq' => $to));
            }
        }
      
        return $this;
    }
    
    public function filterStore($collection, $column) {
        $value = $column->getFilter()->getValue();
        $collection->addFieldToFilter('order.store_id',array('where'=> $value));        
        return $this;
    }
    
    public function filterIncrementId($collection, $column) {
        $value = $column->getFilter()->getValue();
        $collection->addFieldToFilter('order.increment_id',array('like'=> '%'.$value.'%'));        
        return $this;
    }
    
    public function filterBaseGrandTotal($collection, $column) {
        $condorder = $column->getFilter()->getValue();
        if ($condorder) {
            $from = $to = '';
            if(isset($condorder['from']))
                $from = $condorder['from'];
            if(isset($condorder['to']))
                $to = $condorder['to'];
            if ($from) {                
                $collection->addFieldToFilter('order.base_grand_total', array('gteq' => $from));
            }
            if ($to) {                            
                $collection->addFieldToFilter('order.base_grand_total', array('lteq' => $to));
            }
        }
        
        return $this;
    }
    
    public function filterGrandTotal($collection, $column) {
        $condorder = $column->getFilter()->getValue();
        if ($condorder) {
            $from = $to = '';
            if(isset($condorder['from']))
                $from = $condorder['from'];
            if(isset($condorder['to']))
                $to = $condorder['to'];
            if ($from) {                
                $collection->addFieldToFilter('order.grand_total', array('gteq' => $from));
            }
            if ($to) {                            
                $collection->addFieldToFilter('order.grand_total', array('lteq' => $to));
            }
        }
        
        return $this;
    }
    
    /**
     * get url for each row in grid
     *
     * @return string
     */
    public function getRowUrl($row)
    {
//        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
        
}