<?php
class Magestore_Inventoryplus_Block_Adminhtml_Adjuststock_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct() {
        parent::__construct();
        $this->setId('adjuststockGrid');
        $this->setDefaultSort('adjuststock_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
    }
    
    /**
     * prepare collection for block to display
     *
     * @return Magestore_Inventory_Block_Adminhtml_Adjuststock_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('inventoryplus/adjuststock')->getCollection();
        
        $filter   = $this->getParam($this->getVarNameFilter(), null);
        $condorder = '';
        if($filter){
            $data = $this->helper('adminhtml')->prepareFilterString($filter);
            foreach($data as $value=>$key){
                if($value == 'created_at'){
                    $condorder = $key;
                }
            }
        }
        if($condorder){
            $condorder = Mage::helper('inventoryplus')->filterDates($condorder,array('from','to'));
            $from = $condorder['from'];
            $to = $condorder['to'];
            if($from){
                $from = date('Y-m-d',strtotime($from));
                $collection->addFieldToFilter('created_at',array('gteq'=>$from));
            }
            if($to){
                $to = date('Y-m-d',strtotime($to));
                $to .= ' 23:59:59';
                $collection->addFieldToFilter('created_at',array('lteq'=>$to));
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
    protected function _prepareColumns()
    {
       $this->addColumn('adjuststock_id', array(
            'header' => Mage::helper('inventoryplus')->__('ID'),
            'sortable' => true,
            'width' => '60',
            'type' => 'number',
            'index' => 'adjuststock_id'
        ));
       
        $this->addColumn('created_at', array(
            'header' => Mage::helper('inventoryplus')->__('Adjustment Date'),
            'type'  => 'date',
            'width'     => '150px',
            'index' => 'created_at',
            'filter_condition_callback' => array($this, 'filterCreatedOn')
        ));
       
        $this->addColumn('warehouse_name', array(
            'header' => Mage::helper('inventoryplus')->__('Adjusted Warehouse'),
            'width'     => '150px',
            'index' => 'warehouse_name'
        ));
      
        $this->addColumn('action',
            array(
                'header'    =>    Mage::helper('inventoryplus')->__('Action'),
                'width'        => '100',
                'type'        => 'action',
                'getter'    => 'getId',
                'actions'    => array(
                    array(
                        'caption'    => Mage::helper('inventoryplus')->__('Edit'),
                        'url'        => array('base'=> '*/*/edit'),
                        'field'        => 'id'
                    )),
                'filter'    => false,
                'sortable'    => false,
                'index'        => 'stores',
                'is_system'    => true,
        ));

        return parent::_prepareColumns();
    }
    
    /**
     * get url for each row in grid
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid');
    }
    
    public function filterCreatedOn($collection, $column)
    {
        return $this;
    }
}