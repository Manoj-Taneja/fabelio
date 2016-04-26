<?php

class Magestore_Inventoryplus_Block_Adminhtml_Warehouse_Edit_Tab_History extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('warehouse_history_id');
        $this->setDefaultSort('warehouse_history_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * Retrieve collection class
     *
     * @return string
     */
  
    protected function _prepareCollection() {
        $warehouseId = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('inventoryplus/warehouse_history')->getCollection()
                                    ->addFieldToFilter('warehouse_id',$warehouseId);
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('warehouse_history_id', array(
            'header' => Mage::helper('inventoryplus')->__('ID'),
            'width' => '80px',
            'type' => 'number',
            'index' => 'warehouse_history_id',
        ));
        
        $this->addColumn('create_by', array(
            'header' => Mage::helper('inventoryplus')->__('Action Owner'),
            'type' => 'text',
            'index' => 'create_by',
        ));
        
        $this->addColumn('field_change', array(
            'header' => Mage::helper('catalog')->__('Changed field(s)'),
            'renderer' => 'inventoryplus/adminhtml_warehouse_edit_tab_renderer_fieldchanged',
            'filter_index' => 'field_change',
            'filter_condition_callback' => array($this, 'filterCallback'),
        ));
        
        $this->addColumn('time_stamp', array(
            'header' => Mage::helper('inventoryplus')->__('Time Stamp'),
            'index' => 'time_stamp',
            'type' => 'datetime',
            'width' => '150px',
        ));
        
        $this->addColumn('show_history', array(
            'header' => Mage::helper('inventoryplus')->__('Action'),
            'width' => '80px',
            'type' => 'text',
            'filter' => false,
            'sortable' => false,
            'renderer' => 'inventoryplus/adminhtml_warehouse_edit_tab_renderer_history'
        ));
        
        return parent::_prepareColumns();
    }
    
    public function filterCallback($collection, $column)
    {
        $value = $column->getFilter()->getValue();
        if (!is_null(@$value)) {
            if($id = $this->getRequest()->getParam('id')){
                $resource = Mage::getSingleton('core/resource');
                $readConnection = $resource->getConnection('core_read');
                $sql = 'SELECT distinct(`warehouse_history_id`) from ' . $resource->getTableName("erp_inventory_warehouse_history_content") . ' WHERE (field_name like \'%'.$value.'%\')';
                $results = $readConnection->fetchAll($sql);
                $warehouseHistoryIds = array();
                foreach ($results as $result) {
                    $warehouseHistoryIds[] = $result['warehouse_history_id'];
                }
            }
            $collection->addFieldToFilter('warehouse_history_id',array('in'=>$warehouseHistoryIds));
        }
        return $this;
    }
    
    public function getGridUrl() {
         return $this->getData('grid_url')
            ? $this->getData('grid_url')
            : $this->getUrl('*/*/historyGrid', array('_current'=>true,'id'=>$this->getRequest()->getParam('id')));
    }
    
    public function getRowUrl($row)
    {        
    }
}

?>
