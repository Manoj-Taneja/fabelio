<?php

class Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Edit_Tab_Products extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('productGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        if (($this->getSupplier() && $this->getSupplier()->getId()) || Mage::getModel('admin/session')->getData('supplier_product_import')) {
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
        $collection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('type_id', array('nin' => array('configurable', 'bundle', 'grouped')));
		if ($this->_isExport) {		
			$collection->getSelect()
					->joinLeft(
						array('supplier_product' => $collection->getTable('inventorypurchasing/supplier_product')), 'e.entity_id=supplier_product.product_id AND supplier_id='.$this->getRequest()->getParam('id'), array('cost','tax','discount','supplier_sku')
					)
					->group(array('e.entity_id'));
		}
        if ($storeId = $this->getRequest()->getParam('store', 0))
            $collection->addStoreFilter($storeId);
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $currencyCode = Mage::app()->getStore()->getBaseCurrency()->getCode();

        $this->addColumn('in_products', array(
            'header_css_class' => 'a-center',
            'type' => 'checkbox',
            'name' => 'in_products',
            'values' => $this->_getSelectedProducts(),
            'align' => 'center',
            'index' => 'entity_id',
            'use_index' => true,
        ));

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

        $this->addColumn('product_sku', array(
            'header' => Mage::helper('catalog')->__('SKU'),
            'width' => '80px',
            'index' => 'sku'
        ));
		if (!$this->_isExport) {
			$this->addColumn('product_image', array(
				'header' => Mage::helper('catalog')->__('Image'),
				'width' => '90px',
				'index' => 'product_image',
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

        $this->addColumn('product_status', array(
            'header' => Mage::helper('catalog')->__('Status'),
            'width' => '90px',
            'index' => 'status',
            'type' => 'options',
            'options' => Mage::getSingleton('catalog/product_status')->getOptionArray(),
        ));
		if (!$this->_isExport) {
			$this->addColumn('cost', array(
				'header' => Mage::helper('inventorypurchasing')->__('Cost'),
				'name' => 'cost',
				'type' => 'number',
				'index' => 'cost',
				'editable' => true,
				'edit_only' => true,
				'filter' => false
			));
			$this->addColumn('tax', array(
				'header' => Mage::helper('inventorypurchasing')->__('Tax(%)'),
				'name' => 'tax',
				'type' => 'number',
				'index' => 'tax',
				'editable' => true,
				'edit_only' => true,
				'filter' => false
			));

			$this->addColumn('discount', array(
				'header' => Mage::helper('inventorypurchasing')->__('Discount(%)'),
				'name' => 'discount',
				'type' => 'number',
				'index' => 'discount',
				'editable' => true,
				'edit_only' => true,
				'filter' => false
			));
			
			$this->addColumn('supplier_sku', array(
				'header' => Mage::helper('inventorypurchasing')->__('Supplier SKU'),
				'name' => 'supplier_sku',
				'type' => 'number',
				'index' => 'supplier_sku',
				'editable' => true,
				'edit_only' => true,
				'filter' => false
			));
		}else{
			$this->addColumn('cost', array(
				'header' => Mage::helper('inventorypurchasing')->__('Cost'),
				'name' => 'cost',
				'type' => 'number',
				'index' => 'cost',
				'edit_only' => true,
				'filter' => false
			));
			$this->addColumn('tax', array(
				'header' => Mage::helper('inventorypurchasing')->__('Tax(%)'),
				'name' => 'tax',
				'type' => 'number',
				'index' => 'tax'
			));

			$this->addColumn('discount', array(
				'header' => Mage::helper('inventorypurchasing')->__('Discount(%)'),
				'name' => 'discount',
				'type' => 'number',
				'index' => 'discount'
			));
			
			$this->addColumn('supplier_sku', array(
				'header' => Mage::helper('inventorypurchasing')->__('Supplier SKU'),
				'name' => 'supplier_sku',
				'type' => 'text',
				'index' => 'supplier_sku'
			));
		}
		$this->addExportType('*/*/exportProductsCsv', Mage::helper('inventorypurchasing')->__('CSV'));
        $this->addExportType('*/*/exportProductsXml', Mage::helper('inventorypurchasing')->__('XML'));
        return parent::_prepareColumns();
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/productGrid', array(
                    '_current' => true,
                    'id' => $this->getRequest()->getParam('id'),
                    'store' => $this->getRequest()->getParam('store')
                ));
    }

    protected function _getSelectedProducts() {
        $productArrays = $this->getProducts();
        $products = '';
        $supplierProducts = array();
        if ($productArrays) {
            $products = array();
            foreach ($productArrays as $productArray) {
                parse_str(urldecode($productArray), $supplierProducts);
                if (count($supplierProducts)) {
                    foreach ($supplierProducts as $pId => $enCoded) {
                        $products[] = $pId;
                    }
                }
            }
        }
        if (!is_array($products) || Mage::getModel('admin/session')->getData('supplier_product_import')) {            
            $products = array_keys($this->getSelectedRelatedProducts());
        }
        return $products;
    }

    public function getSelectedRelatedProducts() {
        $products = array();
        $supplier = $this->getSupplier();
        $productCollection = Mage::getResourceModel('inventorypurchasing/supplier_product_collection')
                ->addFieldToFilter('supplier_id', $supplier->getId());
        foreach ($productCollection as $product) {
            $products[$product->getProductId()] = array('cost' => $product->getCost(),
                'tax' => $product->getTax(),
                'discount' => $product->getDiscount(),
                'supplier_sku' => $product->getSupplierSku(),
            );
        }
        if ($supplierProductImports = Mage::getModel('admin/session')->getData('supplier_product_import')) {
            $productModel = Mage::getModel('catalog/product');
            foreach ($supplierProductImports as $productImport) {
                $productId = $productModel->getIdBySku($productImport['SKU']);
                if ($productId)
                    $products[$productId] = array('cost' => $productImport['COST'],
                        'tax' => $productImport['TAX'],
                        'discount' => $productImport['DISCOUNT'],
                        'supplier_sku' => $productImport['SUPPLIER_SKU']
                    );
            }
        }
        return $products;
    }

    /**
     * get Current Supplier
     *
     * @return Magestore_Inventory_Model_Supplier
     */
    public function getSupplier() {
        return Mage::getModel('inventorypurchasing/supplier')->load($this->getRequest()->getParam('id'));
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
    
    public function getRowUrl($row)
    {
        return false;
    }

}