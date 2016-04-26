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
 * Warehouse Grid Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Block_Adminhtml_Warehouse_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('warehouseGrid');
        $this->setDefaultSort('warehouse_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * prepare collection for block to display
     *
     * @return Magestore_Inventory_Block_Adminhtml_Inventory_Grid
     */
    protected function _prepareCollection() {
        $collection = Mage::getModel('inventoryplus/warehouse')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare columns for this grid
     *
     * @return Magestore_Inventory_Block_Adminhtml_Inventory_Grid
     */
    protected function _prepareColumns() {               
        $this->addColumn('warehouse_id', array(
            'header' => Mage::helper('inventoryplus')->__('ID'),
            'align' => 'right',
            'type'  => 'number',
            'width' => '50px',
            'index' => 'warehouse_id',
            'filter_index' => 'warehouse_id'
        ));

        $this->addColumn('warehouse_name', array(
            'header' => Mage::helper('inventoryplus')->__('Warehouse Name'),
            'align' => 'left',
            'index' => 'warehouse_name',
        ));
        
        $this->addColumn('created_by', array(
            'header' => Mage::helper('inventoryplus')->__('Created By'),
            'align' => 'left',
            'index' => 'created_by',
//            'filter_index' => 'admin_user.username'
        ));
        
        $this->addColumn('manager_email', array(
            'header' => Mage::helper('inventoryplus')->__('Manager\'s Email'),
            'align' => 'left',
            'index' => 'manager_email',
        ));

        $this->addColumn('telephone', array(
            'header' => Mage::helper('inventoryplus')->__('Telephone'),
            'align' => 'left',
            'index' => 'telephone',
        ));

        $this->addColumn('street', array(
            'header' => Mage::helper('inventoryplus')->__('Street'),
            'align' => 'left',
            'width' => '150px',
            'index' => 'street',
        ));

        $this->addColumn('city', array(
            'header' => Mage::helper('inventoryplus')->__('City'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'city',
        ));

        $this->addColumn('country_id', array(
            'header' => Mage::helper('inventoryplus')->__('Country'),
            'align' => 'left',
            'index' => 'country_id',
            'type' => 'country',
//            'options' => Mage::helper('inventoryplus')->getCountryList()
        ));
        $store = Mage::app()->getStore((int) $this->getRequest()->getParam('store', 0));
            
        $this->addColumn('status', array(
            'header' => Mage::helper('inventoryplus')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));
        
        $this->addColumn('is_root', array(
            'header' => Mage::helper('inventoryplus')->__('Root Warehouse'),
            'align' => 'center',
            'width' => '80px',
            'index' => 'is_root',
            'filter' => false,
            'sortable' => false,
            'renderer' => 'inventoryplus/adminhtml_warehouse_renderer_rootwarehouse'
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
                'renderer' =>   'inventoryplus/adminhtml_warehouse_renderer_action',
                'sortable'    => false,
                'index'        => 'stores',
                'is_system'    => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('inventoryplus')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('inventoryplus')->__('XML'));

        return parent::_prepareColumns();
    }
    
    protected function _filterTotalProductsCallback($collection, $column) {
        $filter = $column->getFilter()->getValue();
        if (isset($filter['from']) && $filter['from']) {
            $collection->getSelect()->having('SUM(warehouse_product.qty) >= ?', $filter['from']);
        }
        if (isset($filter['to']) && $filter['to']) {
            $collection->getSelect()->having('SUM(warehouse_product.qty) <= ?', $filter['to']);
        }
    }

    /**
     * prepare mass action for this grid
     *
     * @return Magestore_Inventory_Block_Adminhtml_Inventory_Grid
     */
    protected function _prepareMassaction() {

    }

    /**
     * get url for each row in grid
     *
     * @return string
     */
    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/grid');
    }

}