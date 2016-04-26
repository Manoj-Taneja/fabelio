<?php

class Magestore_Inventoryplus_Block_Adminhtml_Stock_Edit_Tab_Products extends Mage_Adminhtml_Block_Widget_Grid {

    protected $_isAllWarehouse = true;

    public function __construct() {
        parent::__construct();
        $this->setId('productGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setVarNameFilter('filter');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $warehouse = Mage::helper('inventoryplus/stock')->getWarehouse();
        if (isset($warehouse) && $warehouse->getId() && $warehouse->getId() > 0) {
            $this->_isAllWarehouse = false;
        } else {
            $this->_isAllWarehouse = true;
        }
    }

    protected function _prepareCollection() {
        $resource = Mage::getModel('core/resource');
        $warehouse = Mage::helper('inventoryplus/stock')->getWarehouse();
        if (!$warehouse) {
            return parent::_prepareCollection();
        }
        $warehouseId = $warehouse->getId();
        if (!$warehouse->getId()) {
            $warehouseId = 0;
        }
        $collection = Mage::getResourceModel('inventoryplus/product_collection');
        $collection->addAttributeToSelect('entity_id')
                ->addAttributeToSelect('sku')
                ->addAttributeToSelect('name')
                ->addAttributeToSelect('status')
                ->addAttributeToSelect('price')
                ->addAttributeToSelect('attribute_set_id')
                ->addAttributeToSelect('type_id')
                ->addAttributeToFilter('type_id', array('nin' => array('configurable', 'bundle', 'grouped')));

        if ($this->_isAllWarehouse == true) {
            $collection->getSelect()
                    ->join(
                            array('warehouse_product' => $collection->getTable('inventoryplus/warehouse_product')), 'e.entity_id=warehouse_product.product_id', array('total_qty', 'available_qty')
            );
        } else {
            $collection->joinField('total_qty', 'inventoryplus/warehouse_product', 'total_qty', 'product_id=entity_id', "{{table}}.warehouse_id=$warehouseId", 'right');
            $collection->joinField('available_qty', 'inventoryplus/warehouse_product', 'available_qty', 'product_id=entity_id', "{{table}}.warehouse_id=$warehouseId", 'right');
        }
        $collection->getSelect()->group('e.entity_id');
        if ($this->_isAllWarehouse == true) {
            $collection->getSelect()->columns(array(
                'total_physical_qty' => 'SUM(warehouse_product.total_qty)',
                'total_available_qty' => 'SUM(warehouse_product.available_qty)'
            ));
            $sort = $this->getRequest()->getParam('sort');
            $dir = $this->getRequest()->getParam('dir');
            if ($sort == 'total_physical_qty') {
                $collection->getSelect()->order('SUM(warehouse_product.total_qty) ' . $dir);
            } elseif ($sort == 'total_available_qty') {
                $collection->getSelect()->order('SUM(warehouse_product.available_qty)' . $dir);
            }
            $collection->setResetHaving(true);
        }
        $collection->setIsGroupCountSql(true);
        //echo $collection->getSelect()->__toString();die();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $warehouse = Mage::helper('inventoryplus/stock')->getWarehouse();
        if (!$warehouse)
            return parent::_prepareColumns();
        $warehouseId = $warehouse->getId();
        $adminId = Mage::getSingleton('admin/session')->getUser()->getId();
        $this->addColumn('entity_id', array(
            'header' => Mage::helper('catalog')->__('ID'),
            'sortable' => true,
            'width' => '60',
            'type' => 'number',
            'index' => 'entity_id',
        ));

        $this->addColumn('product_name', array(
            'header' => Mage::helper('catalog')->__('Name'),
            'align' => 'left',
            'index' => 'name',
        ));
        
        $sets = Mage::getResourceModel('eav/entity_attribute_set_collection')
            ->setEntityTypeFilter(Mage::getModel('catalog/product')->getResource()->getTypeId())
            ->load()
            ->toOptionHash();

        $this->addColumn('set_name',
            array(
                'header'=> Mage::helper('catalog')->__('Attrib. Set Name'),
                'width' => '100px',
                'index' => 'attribute_set_id',
                'type'  => 'options',
                'options' => $sets,
        ));

        
        $this->addColumn('product_sku', array(
            'header' => Mage::helper('catalog')->__('SKU'),
            'width' => '80px',
            'index' => 'sku'
        ));

        $this->addColumn('product_image', array(
            'header' => Mage::helper('catalog')->__('Image'),
            'width' => '90px',
            'renderer' => 'inventoryplus/adminhtml_renderer_productimage',
            'index' => 'product_image',
            'filter' => false
        ));

        $this->addColumn('product_status', array(
            'header' => Mage::helper('catalog')->__('Status'),
            'width' => '90px',
            'index' => 'status',
            'type' => 'options',
            'options' => Mage::getSingleton('catalog/product_status')->getOptionArray(),
        ));

        $this->addColumn('product_price', array(
            'header' => Mage::helper('catalog')->__('Price'),
            'type' => 'currency',
            'currency_code' => (string) Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
            'index' => 'price'
        ));
        if ($this->_isAllWarehouse == false) {
            $this->addColumn('total_qty', array(
                'header' => Mage::helper('catalog')->__('Phys. Qty'),
                'width' => '80px',
                'index' => 'total_qty',
                'type' => 'number',
                'default' => 0
            ));
            $this->addColumn('available_qty', array(
                'header' => Mage::helper('catalog')->__('Avail. Qty'),
                'width' => '80px',
                'type' => 'number',
                'index' => 'available_qty',
            ));
        }
        if ($this->_isAllWarehouse == true) {
            $this->addColumn('total_physical_qty', array(
                'header' => Mage::helper('catalog')->__('Total Phys. Qty'),
                'width' => '80px',
                'type' => 'number',
                'default' => 0,
                'index' => 'total_physical_qty',
                'filter_index' => "SUM(warehouse_product.total_qty)",
                'filter_condition_callback' => array($this, '_filterTotalPhysQtyCallback')
            ));
            $this->addColumn('total_available_qty', array(
                'header' => Mage::helper('catalog')->__('Total Avail. Qty'),
                'width' => '80px',
                'type' => 'number',
                'index' => 'total_available_qty',
                'filter_index' => 'SUM(warehouse_product.available_qty)',
                'filter_condition_callback' => array($this, '_filterTotalAvailQtyCallback'),
            ));
        }
        $this->addColumn('warehouse_id', array(
            'header' => Mage::helper('catalog')->__('Warehouse') . '<br/>' . Mage::helper('catalog')->__('(Phys. / Avail. Qty)'),
            'type' => 'options',
            'sortable' => false,
            'filter' => false,
            'options' => Mage::helper('inventoryplus/warehouse')->getAllWarehouseName(),
            'renderer' => 'inventoryplus/adminhtml_stock_renderer_warehouse',
            'align' => 'left'
        ));
        if (Mage::helper('core')->isModuleEnabled('Magestore_Inventorypurchasing')) {
            $this->addColumn('supplier_id', array(
                'header' => Mage::helper('catalog')->__('Supplier'),
                'type' => 'options',
                'options' => Mage::helper('inventorypurchasing/supplier')->getAllSupplierName(),
                'renderer' => 'inventoryplus/adminhtml_stock_renderer_supplier',
                'align' => 'left',
                'sortable' => false,
                'filter' => false,
            ));
        }


        return parent::_prepareColumns();
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/productsGrid', array(
                    '_current' => true
        ));
    }

    public function getRowUrl($row) {
        return false;
    }

    protected function _filterTotalPhysQtyCallback($collection, $column) {
        $filter = $column->getFilter()->getValue();
        if (isset($filter['from']) && $filter['from']) {
            $collection->getSelect()->having('SUM(warehouse_product.total_qty) >= ?', $filter['from']);
        }
        if (isset($filter['to']) && $filter['to']) {
            $collection->getSelect()->having('SUM(warehouse_product.total_qty) <= ?', $filter['to']);
        }
        $filterCollection = clone $collection;
        $filterCollection->clear();
        $filterCollection->setPageSize(false);
        $_stt = 0;
        foreach ($filterCollection as $col) {
            $_stt++;
        }
        $collection->setSize($_stt);
    }

    public function _filterTotalAvailQtyCallback($collection, $column) {
        $filter = $column->getFilter()->getValue();
        if (isset($filter['from']) && $filter['from']) {
            $collection->getSelect()->having('SUM(warehouse_product.available_qty) >= ?', $filter['from']);
        }
        if (isset($filter['to']) && $filter['to']) {
            $collection->getSelect()->having('SUM(warehouse_product.available_qty) <= ?', $filter['to']);
        }
        $filterCollection = clone $collection;
        $filterCollection->clear();
        $filterCollection->setPageSize(false);
        $_stt = 0;
        foreach ($filterCollection as $col) {
            $_stt++;
        }
        $collection->setSize($_stt);
    }

}
