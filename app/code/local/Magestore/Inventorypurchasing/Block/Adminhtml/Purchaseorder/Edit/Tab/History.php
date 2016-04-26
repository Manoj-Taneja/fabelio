<?php

class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Edit_Tab_History extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('purchase_order_history_id');
        $this->setDefaultSort('purchase_order_history_id');
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
        $purchaseOrderId = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('inventorypurchasing/purchaseorder_history')->getCollection()
                                    ->addFieldToFilter('purchase_order_id',$purchaseOrderId);
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('purchase_order_history_id', array(
            'header' => Mage::helper('inventorypurchasing')->__('ID'),
            'width' => '80px',
            'type' => 'text',
            'index' => 'purchase_order_history_id',
        ));
        
        $this->addColumn('created_by', array(
            'header' => Mage::helper('inventorypurchasing')->__('Action Owner'),
            'type' => 'text',
            'index' => 'created_by',
        ));
        
        $this->addColumn('field_change', array(
            'header' => Mage::helper('catalog')->__('Changed field(s)'),
            'renderer' => 'inventorypurchasing/adminhtml_purchaseorder_edit_tab_renderer_fieldchanged',
            'filter_index' => 'field_change',
            'filter_condition_callback' => array($this, 'filterCallback'),
        ));
        
        $this->addColumn('time_stamp', array(
            'header' => Mage::helper('inventorypurchasing')->__('Time Stamp'),
            'index' => 'time_stamp',
            'type' => 'datetime',
            'width' => '150px',
        ));
        
        $this->addColumn('show_history', array(
            'header' => Mage::helper('inventorypurchasing')->__('Action'),
            'width' => '80px',
            'type' => 'text',
            'filter' => false,
            'sortable' => false,
            'renderer' => 'inventorypurchasing/adminhtml_purchaseorder_edit_tab_renderer_history'
        ));
        
        return parent::_prepareColumns();
    }

    public function getGridUrl() {
         return $this->getData('grid_url')
            ? $this->getData('grid_url')
            : $this->getUrl('*/*/historyGrid', array('_current'=>true,'id'=>$this->getRequest()->getParam('id')));
    }
    
    public function getRowUrl($row){
        return false;
    }
    
    public function filterCallback($collection, $column)
    {
        $purchaseorderHistoryIds = array();
        $value = $column->getFilter()->getValue();
        if (!is_null(@$value)) {
            if($id = $this->getRequest()->getParam('id')){
                $resource = Mage::getSingleton('core/resource');
                $readConnection = $resource->getConnection('core_read');
                $sql = 'SELECT distinct(`purchase_order_history_id`) from ' . $resource->getTableName("erp_inventory_purchase_order_history_content") . ' WHERE (field_name like \'%'.$value.'%\')';
                $results = $readConnection->fetchAll($sql);
                $paymenttermHistoryIds = array();
                foreach ($results as $result) {
                    $purchaseorderHistoryIds[] = $result['purchase_order_history_id'];
                }
            }
            $collection->addFieldToFilter('purchase_order_history_id',array('in'=>$purchaseorderHistoryIds));
        }
        return $this;
    }
}

?>
