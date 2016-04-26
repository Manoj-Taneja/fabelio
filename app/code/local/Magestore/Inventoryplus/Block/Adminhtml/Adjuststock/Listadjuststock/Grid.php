<?php

class Magestore_Inventoryplus_Block_Adminhtml_Adjuststock_Listadjuststock_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('listadjuststockGrid');
        $this->setDefaultSort('adjuststock_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
    }

    /**
     * prepare collection for block to display
     *
     * @return Magestore_Inventory_Block_Adminhtml_Adjuststock_Grid
     */
    protected function _prepareCollection() {
        $collection = Mage::getModel('inventoryplus/adjuststock')->getCollection();
        $resource = Mage::getSingleton('core/resource');
        $collection
                ->getSelect()
                ->columns(array('adjust_status' => 'status', 'adjust_warehouse_name' => 'warehouse_name', 'adjust_warehouse_id' => 'warehouse_id', 'adjust_created_by' => 'created_by', 'adjust_created_at' => 'created_at'))
                ->join(array('warehouse' => $resource->getTableName("erp_inventory_warehouse")), "main_table.warehouse_id = warehouse.warehouse_id", array('warehouse.manager_name', 'warehouse.manager_email', 'warehouse.telephone', 'warehouse.country_id'));

        $filter = $this->getParam($this->getVarNameFilter(), null);
        $condorder = '';
        $status = '';
        if ($filter) {
            $data = $this->helper('adminhtml')->prepareFilterString($filter);
            foreach ($data as $value => $key) {
                if ($value == 'adjust_created_at') {
                    $condorder = $key;
                }
            }
        }


        if ($condorder) {
            $condorder = Mage::helper('inventoryplus')->filterDates($condorder, array('from', 'to'));
            if (isset($condorder['from']))
                $from = $condorder['from'];
            else
                $from = '';
            if (isset($condorder['to']))
                $to = $condorder['to'];
            else
                $to = '';
            if ($from) {
                $from = date('Y-m-d', strtotime($from));
                $collection->addFieldToFilter('main_table.created_at', array('gteq' => $from));
            }
            if ($to) {
                $to = date('Y-m-d', strtotime($to));
                $to .= ' 23:59:59';
                $collection->addFieldToFilter('main_table.created_at', array('lteq' => $to));
            }
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare columns for this grid
     *
     * @return Magestore_Inventory_Block_Adminhtml_Adjuststock_Grid
     */
    protected function _prepareColumns() {
        $this->addColumn('adjuststock_id', array(
            'header' => Mage::helper('inventoryplus')->__('ID'),
            'sortable' => true,
            'width' => '60',
            'align' => 'right',
            'type' => 'number',
            'index' => 'adjuststock_id'
        ));

        $this->addColumn('adjust_created_at', array(
            'header' => Mage::helper('inventoryplus')->__('Created on'),
            'type' => 'date',
            'width' => '150px',
            'align' => 'right',
            'index' => 'adjust_created_at',
            'filter_condition_callback' => array($this, 'filterCreatedOn')
        ));

        $this->addColumn('adjust_created_by', array(
            'header' => Mage::helper('inventoryplus')->__('Created by'),
            'width' => '80px',
            'align' => 'left',
            'index' => 'adjust_created_by',
            'filter_condition_callback' => array($this, 'filterCreatedBy')
        ));

        $this->addColumn('adjust_warehouse_name', array(
            'header' => Mage::helper('inventoryplus')->__('Adjusted Warehouse'),
            'width' => '150px',
            'align' => 'left',
            'index' => 'adjust_warehouse_name',
            'type' => 'text',
            'filter_condition_callback' => array($this, 'filterWarehouseName')
        ));


        $this->addColumn('warehouse_contact', array(
            'header' => Mage::helper('inventoryplus')->__('Warehouse\'s Contact'),
            'width' => '150px',
            'align' => 'left',
            'index' => 'manager_name',
        ));

        $this->addColumn('warehouse_email', array(
            'header' => Mage::helper('inventoryplus')->__('Warehouse\'s Email'),
            'width' => '150px',
            'align' => 'left',
            'index' => 'manager_email',
        ));

        $this->addColumn('warehouse_phone', array(
            'header' => Mage::helper('inventoryplus')->__('Warehouse\'s Phone'),
            'width' => '150px',
            'align' => 'right',
            'index' => 'telephone',
        ));

        $this->addColumn('warehouse_country', array(
            'header' => Mage::helper('inventoryplus')->__('Warehouse\'s Country'),
            'width' => '150px',
            'align' => 'left',
            'index' => 'country_id',
            'type' => 'options',
            'options' => Mage::helper('inventoryplus')->getCountryList()
        ));

        $this->addColumn('adjust_status', array(
            'header'    => Mage::helper('inventoryplus')->__('Status'),
            'align'  => 'left',
            'width'  => '80px',
            'index'  => 'adjust_status',
            'type'      => 'options',
            'options'    => array(
                0 => 'Pending',
                1 => 'Completed',
                2 => 'Canceled',
            ),
            'filter_condition_callback' => array($this, 'filterStatus')
        ));


        $this->addColumn('action', array(
            'header' => Mage::helper('inventoryplus')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getAdjuststockId',
            'renderer' =>   'inventoryplus/adminhtml_adjuststock_listadjuststock_renderer_action',
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('inventoryplus')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('inventoryplus')->__('XML'));

        return parent::_prepareColumns();
    }

    /**
     * get url for each row in grid
     *
     * @return string
     */
    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getAdjuststockId()));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/grid');
    }

    public function filterCreatedOn($collection, $column) {

        return $this;
    }

    public function filterWarehouseName($collection, $column) {
        $value = $column->getFilter()->getValue();
        $collection->addFieldToFilter('main_table.warehouse_name', array('like' => '%' . $value . '%'));
        return $this;
    }

    public function filterStatus($collection, $column) {
        $value = $column->getFilter()->getValue();
        $collection->addFieldToFilter('main_table.status', array('like' => '%' . $value . '%'));
        return $this;
    }

    public function filterCreatedBy($collection, $column) {
        $value = $column->getFilter()->getValue();
        $collection->addFieldToFilter('main_table.created_by', $value);
        return $this;
    }

}
