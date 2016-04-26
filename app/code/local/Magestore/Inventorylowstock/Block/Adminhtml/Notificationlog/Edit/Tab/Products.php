<?php

class Magestore_Inventorylowstock_Block_Adminhtml_Notificationlog_Edit_Tab_Products extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('productsGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        if (($this->getAdjustStock() && $this->getAdjustStock()->getId()) || Mage::getModel('admin/session')->getData('notificationlog_import')) {
            $this->setDefaultFilter(array('in_products' => 1));
        }        
    }

    protected function _prepareCollection() {
        $productIds = array();
        $collection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect('name')
                ->addAttributeToSelect('sku')                
                ->addAttributeToSelect('image');

        $collection->joinTable('inventorylowstock/notificationlog_product', 'product_id=entity_id', array('qty_notify', 'time_notify'), '{{table}}.send_email_log_id = ' . $this->getRequest()->getParam('id'), 'inner');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('entity_id', array(
            'header' => Mage::helper('inventorylowstock')->__('ID'),
            'sortable' => true,
            'width' => '60',
            'index' => 'entity_id'
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('inventorylowstock')->__('Name'),
            'align' => 'left',
            'index' => 'name',
        ));

        $this->addColumn('sku', array(
            'header' => Mage::helper('inventorylowstock')->__('SKU'),
            'width' => '80px',
            'index' => 'sku'
        ));

        $this->addColumn('image', array(
            'header' => Mage::helper('inventorylowstock')->__('Image'),
            'width' => '90px',
            'filter' => false,
            'renderer' => 'inventoryplus/adminhtml_renderer_productimage'
        ));

        $this->addColumn('qty_notify', array(
            'header' => Mage::helper('inventorylowstock')->__('Qty Notified'),
            'align' => 'left',
            'index' => 'qty_notify',
            'type' => 'number',
			'filter_condition_callback' => array($this, 'filterQtyNotify')
        ));

        $this->addColumn('time_notify', array(
            'header' => Mage::helper('inventorylowstock')->__('Time Notified'),
            'width' => '250px',
            'index' => 'time_notify',
            'type' => 'datetime',
			'filter_condition_callback' => array($this, 'filterTimeNotify')
        ));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/productsGrid', array(
                    '_current' => true,
                    'id' => $this->getRequest()->getParam('id'),
                    'store' => $this->getRequest()->getParam('store')
                ));
    }

    public function getRowUrl($row) {
        return false;
    }
	protected function filterQtyNotify($collection, $column) {
        $filter = $column->getFilter()->getValue();
        if (isset($filter['from']) && $filter['from']) {
            $collection->getSelect()->where('qty_notify >= ?', $filter['from']);
        }
        if (isset($filter['to']) && $filter['to']) {
            $collection->getSelect()->where('qty_notify <= ?', $filter['to']);
        }
    }
	protected function filterTimeNotify($collection, $column) {
        $filter = $column->getFilter()->getValue();
        if (isset($filter['orig_from']) && $filter['orig_from']) {
			$filter['orig_from'] .= ' 00:00:00'; 
			$from = Mage::getModel('core/date')->date('Y-m-d H:i:s', Mage::getModel('core/date')->gmtTimestamp($filter['orig_from']));
            $collection->getSelect()->where('time_notify >= ?', $from);
        }
        if (isset($filter['orig_to']) && $filter['orig_to']) {
            $filter['orig_to'] .= ' 23:59:59';
			$to = Mage::getModel('core/date')->date('Y-m-d H:i:s', Mage::getModel('core/date')->gmtTimestamp($filter['orig_to']));
            $collection->getSelect()->where('time_notify <= ?', $to);
        }
    }
}
