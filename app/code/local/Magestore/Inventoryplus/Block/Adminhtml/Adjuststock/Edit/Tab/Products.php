<?php

class Magestore_Inventoryplus_Block_Adminhtml_Adjuststock_Edit_Tab_Products extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('adjuststockproductGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
        $this->setVarNameFilter('filter');
        if (($this->getAdjustStock() && $this->getAdjustStock()->getId()) || Mage::getModel('admin/session')->getData('adjuststock_product_import')) {
            $this->setDefaultFilter(array('in_products' => 1));
        }
    }

    protected function _addColumnFilterToCollection($column) {
        if ($column->getId() == 'in_products') {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds))
                $productIds = 0;
            if ($column->getFilter()->getValue())
                $this->getCollection()->addFieldToFilter('entity_id', array('in' => $productIds));
            elseif ($productIds)
                $this->getCollection()->addFieldToFilter('entity_id', array('nin' => $productIds));
            return $this;
        }
        return parent::_addColumnFilterToCollection($column);
    }

    protected function _prepareCollection() {
        if ($this->getRequest()->getParam('id')) {
            $id = $this->getRequest()->getParam('id');
            $adjuststock = Mage::getModel('inventoryplus/adjuststock')->load($id);
            $warehouse_id = $adjuststock->getWarehouseId();
            $productIds = array();
            $adjuststockProducts = Mage::getModel('inventoryplus/adjuststock_product')
                    ->getCollection()
                    ->addFieldToFilter('adjuststock_id', $id);
            foreach ($adjuststockProducts as $adjuststockProduct) {
                $productIds[] = $adjuststockProduct->getProductId();
            }
            $collection = Mage::getModel('catalog/product')->getCollection()
                    ->addAttributeToSelect('*')
                    ->addAttributeToFilter('type_id', array('nin' => array('configurable', 'bundle', 'grouped')))
            //->addFieldToFilter('entity_id', array('in' => $productIds))
            ;
            if ($adjuststock->getStatus() == 1 || $adjuststock->getStatus() == 2) {
                $collection->addFieldToFilter('entity_id', array('in' => $productIds));
                $collection->joinField('old_qty', 'inventoryplus/adjuststock_product', 'old_qty', 'product_id=entity_id', '{{table}}.adjuststock_id=' . $id, 'left');
            } else {
                $collection->joinField('old_qty', 'inventoryplus/warehouse_product', 'total_qty', 'product_id=entity_id', '{{table}}.warehouse_id=' . $warehouse_id, 'left');
            }
            $collection->joinField('adjust_qty', 'inventoryplus/adjuststock_product', 'adjust_qty', 'product_id=entity_id', '{{table}}.adjuststock_id=' . $id, 'left');
        } else {
            $productSkus = array();
            if ($adjustStockProducts = Mage::getModel('admin/session')->getData('adjuststock_product_warehouse')) {

                $warehouse_id = $adjustStockProducts['warehouse_id'];
            }
            $collection = Mage::getModel('catalog/product')->getCollection()
                    ->addAttributeToSelect('*')
                    ->addAttributeToFilter('type_id', array('nin' => array('configurable', 'bundle', 'grouped')))
            ;
            $collection->joinField('qty', 'inventoryplus/warehouse_product', 'total_qty', 'product_id=entity_id', '{{table}}.warehouse_id=' . $warehouse_id, 'left');
        }

        if ($storeId = $this->getRequest()->getParam('store', 0))
            $collection->addStoreFilter($storeId);



        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $model = Mage::getModel('inventoryplus/adjuststock')->load($this->getRequest()->getParam('id'));
        $currencyCode = Mage::app()->getStore()->getBaseCurrency()->getCode();

        if ((!$this->getRequest()->getParam('id') || $model->getStatus() == 0)) {
            $this->addColumn('in_products', array(
                'header_css_class' => 'a-center',
                'type' => 'checkbox',
                'name' => 'in_products',
                'values' => $this->_getSelectedProducts(),
                'align' => 'center',
                'index' => 'entity_id',
                'use_index' => true,
            ));
        }
        $this->addColumn('entity_id', array(
            'header' => Mage::helper('catalog')->__('ID'),
            'sortable' => true,
            'width' => '60',
            'index' => 'entity_id'
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

        $this->addColumn('set_name', array(
            'header' => Mage::helper('catalog')->__('Attrib. Set Name'),
            'width' => '100px',
            'index' => 'attribute_set_id',
            'type' => 'options',
            'options' => $sets,
        ));

        $this->addColumn('product_status', array(
            'header' => Mage::helper('catalog')->__('Status'),
            'width' => '90px',
            'index' => 'status',
            'type' => 'options',
            'options' => Mage::getSingleton('catalog/product_status')->getOptionArray(),
        ));
        $this->addColumn('product_sku', array(
            'header' => Mage::helper('catalog')->__('SKU'),
            'width' => '80px',
            'index' => 'sku'
        ));

        if (!$this->_isExport) {
            $this->addColumn('product_image', array(
                'header' => Mage::helper('catalog')->__('Image'),
                'width' => '90px',
                'filter' => false,
                'renderer' => 'inventoryplus/adminhtml_renderer_productimage'
            ));
        }

        $this->addColumn('product_price', array(
            'header' => Mage::helper('catalog')->__('Price'),
            'type' => 'currency',
            'currency_code' => (string) Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
            'index' => 'price'
        ));


        if ($this->getRequest()->getParam('id')) {
            $this->addColumn('old_qty', array(
                'header' => Mage::helper('inventoryplus')->__('Qty Before Adjusting'),
                'width' => '100px',
                'type' => 'number',
                'index' => 'old_qty',
                'default' => '0',
                'editable' => false
            ));
            if ($model->getStatus() == 1 || $model->getStatus() == 2) {
                $this->addColumn('adjust_qty', array(
                    'header' => Mage::helper('inventoryplus')->__('Qty After Adjusting'),
                    'name' => 'adjust_qty',
                    'type' => 'number',
                    'index' => 'adjust_qty',
                    'default' => '0',
                ));
                $this->addExportType('*/*/exportProductCsv', Mage::helper('inventoryplus')->__('CSV'));
                $this->addExportType('*/*/exportProductXml', Mage::helper('inventoryplus')->__('XML'));
            } else {
                $this->addColumn('adjust_qty', array(
                    'header' => Mage::helper('inventoryplus')->__('Adjusted Qty'),
                    'name' => 'adjust_qty',
                    'type' => 'number',
                    'index' => 'adjust_qty',
                    'editable' => true,
                    'edit_only' => true,
                    'filter' => false,
                ));
            }
        } else {
            $this->addColumn('qty', array(
                'header' => Mage::helper('inventoryplus')->__('Qty Before Adjusting'),
                'width' => '100px',
                'type' => 'number',
                'index' => 'qty',
                'default' => '0',
                'editable' => false
            ));
            if (Mage::helper('inventoryplus/adjuststock')->getWarehouseByAdmin()) {
                $this->addColumn('adjust_qty', array(
                    'header' => Mage::helper('inventoryplus')->__('Adjusted Qty'),
                    'name' => 'adjust_qty',
                    'type' => 'number',
                    'index' => 'adjust_qty',
                    'editable' => true,
                    'edit_only' => true,
                    'filter' => false,
                ));
            } else {
                $this->addColumn('adjust_qty', array(
                    'header' => Mage::helper('inventoryplus')->__('Adjusted Qty'),
                    'name' => 'adjust_qty',
                    'type' => 'number',
                    'index' => 'adjust_qty',
                    'editable' => false,
                    'edit_only' => true,
                    'filter' => false
                ));
            }
        }
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/productGrid', array(
                    '_current' => true,
                    'id' => $this->getRequest()->getParam('id'),
                    'store' => $this->getRequest()->getParam('store')
        ));
    }

    public function getRowUrl($row) {
        return false;
    }

    protected function _getSelectedProducts() {

        $productArrays = $this->getProducts();


        $products = '';
        $adjustProducts = array();
        if ($productArrays) {
            $products = array();
            foreach ($productArrays as $productArray) {
                parse_str(urldecode($productArray), $adjustProducts);
                if (count($adjustProducts)) {
                    foreach ($adjustProducts as $pId => $enCoded) {
                        $products[] = $pId;
                    }
                }
            }
        }
        if ((!is_array($products) || Mage::getModel('admin/session')->getData('adjuststock_product_import'))) {
            $products = array_keys($this->getSelectedRelatedProducts());
        }
        return $products;
    }

    public function getProductSelect() {
        if ($this->getRequest()->getParam('id')) {
            $id = $this->getRequest()->getParam('id');
            $adjuststock = Mage::getModel('inventoryplus/adjuststock')->load($id);
            $warehouse_id = $adjuststock->getWarehouseId();
            $productIds = array();
            $adjuststockProducts = Mage::getModel('inventoryplus/adjuststock_product')
                    ->getCollection()
                    ->addFieldToFilter('adjuststock_id', $id);
            foreach ($adjuststockProducts as $adjuststockProduct)
                $productIds[] = $adjuststockProduct->getProductId();
            $collection = Mage::getModel('catalog/product')->getCollection()
                    ->addAttributeToSelect('*')
                    ->addFieldToFilter('entity_id', array('in' => $productIds));
            $collection->joinField('old_qty', 'inventoryplus/adjuststock_product', 'old_qty', 'product_id=entity_id', '{{table}}.adjuststock_id=' . $id, 'left');
            $collection->joinField('adjust_qty', 'inventoryplus/adjuststock_product', 'adjust_qty', 'product_id=entity_id', '{{table}}.adjuststock_id=' . $id, 'left');
        } else {
            $productSkus = array();
            if ($adjustStockProducts = Mage::getModel('admin/session')->getData('adjuststock_product_warehouse')) {

                $warehouse_id = $adjustStockProducts['warehouse_id'];
            }
            $collection = Mage::getModel('catalog/product')->getCollection()
                    ->addAttributeToSelect('*');
            $collection->joinField('qty', 'inventoryplus/warehouse_product', 'total_qty', 'product_id=entity_id', '{{table}}.warehouse_id=' . $warehouse_id, 'left');
        }

        if ($storeId = $this->getRequest()->getParam('store', 0))
            $collection->addStoreFilter($storeId);
        $collection->addOrder('entity_id', 'ASC');
        return $collection;
    }

    public function getSelectedRelatedProducts() {
        $products = array();
        if ($adjustStockProducts = Mage::getModel('admin/session')->getData('adjuststock_product_import')) {
            $productModel = Mage::getModel('catalog/product');
            foreach ($adjustStockProducts as $adjustStockProduct) {
                $productId = $productModel->getIdBySku($adjustStockProduct['SKU']);
                if ($productId) {
                    if ($adjustStockProduct['QTY']) {
                        $products[$productId] = array('adjust_qty' => $adjustStockProduct['QTY']);
                    } else if ($adjustStockProduct['Qty After Adjusting']) {
                        $products[$productId] = array('adjust_qty' => $adjustStockProduct['Qty After Adjusting']);
                    }
                }
            }
        } else {
            if ($this->getRequest()->getParam('id')) {
                $collection = $this->getProductSelect();
                if ($collection) {
                    foreach ($collection as $product) {
                        $products[$product->getId()] = array('adjust_qty' => $product->getAdjustQty());
                    }
                }
            }
        }
        return $products;
    }

    /**
     * get Current Purchase Order
     *
     * @return Magestore_Inventory_Model_Adjuststock
     */
    public function getAdjustStock() {
        return Mage::getModel('inventoryplus/adjuststock')->load($this->getRequest()->getParam('id'));
    }

    /**
     * get currrent store
     *
     * @return Mage_Core_Model_Store
     */
    public function getStore() {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

}
