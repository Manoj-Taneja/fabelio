<?php

class Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Edit_Tab_History extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('supplier_history_id');
        $this->setDefaultSort('supplier_history_id');
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
        $supplierId = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('inventorypurchasing/supplier_history')->getCollection()
                                    ->addFieldToFilter('supplier_id',$supplierId);
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('supplier_history_id', array(
            'header' => Mage::helper('inventorypurchasing')->__('ID'),
            'width' => '80px',
            'type' => 'text',
            'index' => 'supplier_history_id',
        ));
        
        $this->addColumn('created_by', array(
            'header' => Mage::helper('inventorypurchasing')->__('Action Owner'),
            'type' => 'text',
            'index' => 'created_by',
        ));
        
        $this->addColumn('field_change', array(
            'header' => Mage::helper('catalog')->__('Changed field(s)'),
            'renderer' => 'inventorypurchasing/adminhtml_supplier_edit_tab_renderer_fieldchanged',
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
            'renderer' => 'inventorypurchasing/adminhtml_supplier_edit_tab_renderer_history'
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
                $sql = 'SELECT distinct(`supplier_history_id`) from ' . $resource->getTableName("erp_inventory_supplier_history_content") . ' WHERE (field_name like \'%'.$value.'%\')';
                $results = $readConnection->fetchAll($sql);
                $supplierHistoryIds = array();
                foreach ($results as $result) {
                    $supplierHistoryIds[] = $result['supplier_history_id'];
                }
            }
            $collection->addFieldToFilter('supplier_history_id',array('in'=>$supplierHistoryIds));
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
        return false;
    }
}

