<?php

class Magestore_Inventorypurchasing_Block_Adminhtml_Paymentterm_Edit_Tab_History extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('payment_term_history_id');
        $this->setDefaultSort('payment_term_history_id');
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
        $paymentTermId = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('inventorypurchasing/paymentterm_history')->getCollection()
                                    ->addFieldToFilter('payment_term_id',$paymentTermId);
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('payment_term_history_id', array(
            'header' => Mage::helper('inventorypurchasing')->__('ID'),
            'width' => '80px',
            'type' => 'text',
            'index' => 'payment_term_history_id',
        ));
        
        $this->addColumn('created_by', array(
            'header' => Mage::helper('inventorypurchasing')->__('Action Owner'),
            'type' => 'text',
            'index' => 'created_by',
        ));

        $this->addColumn('field_change', array(
            'header' => Mage::helper('catalog')->__('Changed field(s)'),
            'renderer' => 'inventorypurchasing/adminhtml_paymentterm_edit_tab_renderer_fieldchanged',
            'filter_index' => 'field_change',
            'filter_condition_callback' => array($this, 'filterCallback'),
        ));
        
        $this->addColumn('time_stamp', array(
            'header' => Mage::helper('sales')->__('Time Stamp'),
            'index' => 'time_stamp',
            'type' => 'datetime',
            'width' => '150px',
        ));
        
        $this->addColumn('show_history', array(
            'header' => Mage::helper('catalog')->__('Action'),
            'width' => '80px',
            'type' => 'text',
            'filter' => false,
            'sortable' => false,
            'renderer' => 'inventorypurchasing/adminhtml_paymentterm_edit_tab_renderer_history'
        ));
        
        return parent::_prepareColumns();
    }

    public function getGridUrl() {
         return $this->getData('grid_url')
            ? $this->getData('grid_url')
            : $this->getUrl('*/*/historyGrid', array('_current'=>true,'id'=>$this->getRequest()->getParam('id')));
    }
    
    public function filterCallback($collection, $column)
    {
        $value = $column->getFilter()->getValue();
        if (!is_null(@$value)) {
            if($id = $this->getRequest()->getParam('id')){
                $resource = Mage::getSingleton('core/resource');
                $readConnection = $resource->getConnection('core_read');
                $sql = 'SELECT distinct(`payment_term_history_id`) from ' . $resource->getTableName("erp_inventory_payment_term_history_content") . ' WHERE (field_name like \'%'.$value.'%\')';
                $results = $readConnection->fetchAll($sql);
                $paymenttermHistoryIds = array();
                foreach ($results as $result) {
                    $paymenttermHistoryIds[] = $result['payment_term_history_id'];
                }
            }
            $collection->addFieldToFilter('payment_term_history_id',array('in'=>$paymenttermHistoryIds));
        }
        return $this;
    }
}

?>
