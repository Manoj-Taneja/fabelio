<?php

class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Edit_Tab_Products extends Mage_Adminhtml_Block_Widget_Grid {

    protected $_editable = true;

    public function __construct() {
        parent::__construct();
        $this->checkEditable();
        $this->setId('productGrid');
        if (!$this->_editable) {
            $this->setDefaultSort('entity_id');
        } else {
            $this->setDefaultSort('product_id');
        }
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        if (($this->getPurchaseOrder() && $this->getPurchaseOrder()->getId()) || Mage::getModel('admin/session')->getData('purchaseorder_product_import')) {
            $this->setDefaultFilter(array('in_products' => 1));
        }
    }

    protected function checkEditable() {
        if ($this->getPurchaseOrder() && $this->getPurchaseOrder()->getId()) {
            $deliveries = Mage::getModel('inventorypurchasing/purchaseorder_delivery')
                    ->getCollection()
                    ->addFieldToFilter('purchase_order_id', $this->getPurchaseOrder()->getId());
            if (count($deliveries) > 0) {
                $this->_editable = false;
            }
        }
    }

    public function _getDisabledProducts() {
        $disableCheck = false;
        $warehouseIds = $this->getRequest()->getParam('warehouse_ids');
        if ($warehouseIds) {
            $warehouseIds = explode(',', $warehouseIds);
            foreach ($warehouseIds as $warehouseId) {
                if ($warehouse_id) {
                    if (!Mage::helper('inventoryplus')->getPermission($warehouse_id, 'can_purchase_product')) {
                        $disableCheck = true;
                    }
                }
            }
        }

        if ($this->getRequest()->getParam('id')) {
            $resource = Mage::getSingleton('core/resource');
            $readConnection = $resource->getConnection('core_read');
            $installer = Mage::getModel('core/resource');
            $sql = 'SELECT distinct(`warehouse_id`),warehouse_name,qty_order from ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' . $this->getRequest()->getParam("id") . ')';
            $results = $readConnection->fetchAll($sql);
            if (count($results) > 0) {
                foreach ($results as $result) {
                    if ($result['warehouse_id']) {
                        if (!Mage::helper('inventoryplus')->getPermission($result['warehouse_id'], 'can_purchase_product')) {
                            $disableCheck = true;
                        }
                    }
                }
            }
        }
        $products = array();
        if (!$disableCheck)
            return $products;
        $supplierProducts = Mage::getModel('inventorypurchasing/supplier_product')->getCollection();
        if (count($supplierProducts)) {
            foreach ($supplierProducts as $product) {
                $products[$product->getProductId()] = $product->getProductId();
            }
        }
        return array_keys($products);
    }

    protected function getCurrency() {
        if (!$this->getRequest()->getParam('id')) {
            $currency = $this->getRequest()->getParam('currency');
        } else {
            $currency = Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('id'))->getCurrency();
        }
        return $currency;
    }

    protected function getChangeRate() {
        if (!$this->getRequest()->getParam('id')) {
            $currencyRate = $this->getRequest()->getParam('change_rate');
        } else {
            $currencyRate = $this->getPurchaseOrder()->getData('change_rate');
        }
        return $currencyRate;
    }

    protected function _addColumnFilterToCollection($column) {
        if ($column->getId() == 'in_products') {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds))
                $productIds = 0;
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in' => $productIds));
            } elseif ($productIds) {
                $this->getCollection()->addFieldToFilter('entity_id', array('nin' => $productIds));
            }
            return $this;
        }
        return parent::_addColumnFilterToCollection($column);
    }

    protected function _prepareCollection() {
        $supplier_id = $this->getRequest()->getParam('supplier_id');
        if (!$supplier_id) {
            $purchaseOrderId = $this->getRequest()->getParam('id');
            if ($purchaseOrderId) {
                $purchaseOrder = $this->getPurchaseOrder();
                $supplier_id = $purchaseOrder->getSupplierId();
            } else {
                return;
            }
        }
        $supplierProducts = Mage::getModel('inventorypurchasing/supplier_product')->getCollection()
                ->addFieldToFilter('supplier_id', $supplier_id);
        $productIds = array();
        if ($this->_editable) {
            foreach ($supplierProducts as $supplierProduct) {
                $productIds[] = $supplierProduct->getProductId();
            }
        } else {
            $purchaseOrderProducts = Mage::getModel('inventorypurchasing/purchaseorder_product')->getCollection()
                    ->addFieldToFilter('purchase_order_id', $this->getRequest()->getParam('id'));
            foreach ($purchaseOrderProducts as $purchaseOrderProduct) {
                $productIds[] = $purchaseOrderProduct->getProductId();
            }
        }
        $collection = Mage::getResourceModel('inventorypurchasing/product_collection')
                ->addAttributeToSelect('*')
                ->addFieldToFilter('entity_id', array('in' => $productIds))
                ->setIsGroupCountSql(true);
        if ($storeId = $this->getRequest()->getParam('store', 0)) {
            $collection->addStoreFilter($storeId);
        }
        if ($this->_editable) {
            $currencyRate = $this->getChangeRate();
            $collection->getSelect()
                    ->joinLeft(array('supplierproduct' => $collection->getTable('erp_inventory_supplier_product')), 'e.entity_id=supplierproduct.product_id and supplierproduct.supplier_id IN (' . "'" . $supplier_id . "'" . ')', array('cost_product' => '(supplierproduct.cost) * ' . $currencyRate,
                        'tax' => 'supplierproduct.tax',
                        'discount' => 'supplierproduct.discount',
                        'supplier_sku' => 'supplierproduct.supplier_sku',
                            )
            );
            if ($this->getRequest()->getParam('id')) {
                $collection->getSelect()
                        ->joinLeft(array('purchaseproduct' => $collection->getTable('erp_inventory_purchase_order_product')), "purchase_order_id = " . $this->getRequest()->getParam('id') . " AND (e.entity_id = purchaseproduct.product_id)", array(
                            "qty" => "IFNULL(purchaseproduct.qty,0)",
                            "qty_recieved" => "IFNULL(purchaseproduct.qty_recieved,0)",
                            "qty_returned" => "IFNULL(purchaseproduct.qty_returned,0)",
                            "cost_product" => "IFNULL(purchaseproduct.cost,supplierproduct.cost)",
                            "cost" => "IFNULL(purchaseproduct.cost,supplierproduct.cost)",
                            "discount" => "IFNULL(purchaseproduct.discount,supplierproduct.discount)",
                            "tax" => "IFNULL(purchaseproduct.tax,supplierproduct.tax)",
                            'supplier_sku' => 'purchaseproduct.supplier_sku',
                                )
                );
            }
            $collection->getSelect()->group('e.entity_id');
        } else {
            $collection = Mage::getModel('inventorypurchasing/purchaseorder_product')->getCollection()
                    ->addFieldToFilter('purchase_order_id', $this->getRequest()->getParam('id'))
                    ->setIsGroupCountSql(true);
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $currency = $this->getCurrency();
        if ($this->_editable) {
            $this->addColumn('in_products', array(
                'header_css_class' => 'a-center',
                'type' => 'checkbox',
                'name' => 'in_products',
                'values' => $this->_getSelectedProducts(),
                'align' => 'center',
                'index' => 'entity_id',
                'use_index' => true,
                'disabled_values' => $this->_getDisabledProducts()
            ));
        }
        if ($this->_editable) {
            $this->addColumn('entity_id', array(
                'header' => Mage::helper('catalog')->__('ID'),
                'sortable' => true,
                'width' => '60',
                'index' => 'entity_id'
            ));
        } else {
            $this->addColumn('product_id', array(
                'header' => Mage::helper('catalog')->__('ID'),
                'sortable' => true,
                'width' => '60',
                'index' => 'product_id'
            ));
        }

        if ($this->_editable) {
            $this->addColumn('product_name', array(
                'header' => Mage::helper('catalog')->__('Name'),
                'align' => 'left',
                'index' => 'name',
            ));
        } else {
            $this->addColumn('product_name', array(
                'header' => Mage::helper('catalog')->__('Name'),
                'align' => 'left',
                'index' => 'product_name',
                'renderer' => 'inventorypurchasing/adminhtml_purchaseorder_edit_tab_renderer_product',
            ));
        }

        $sets = Mage::getResourceModel('eav/entity_attribute_set_collection')
                ->setEntityTypeFilter(Mage::getModel('catalog/product')->getResource()->getTypeId())
                ->load()
                ->toOptionHash();
        if ($this->_editable) {
            $this->addColumn('product_sku', array(
                'header' => Mage::helper('catalog')->__('SKU'),
                'width' => '80px',
                'index' => 'sku'
            ));
        } else {
            $this->addColumn('product_sku', array(
                'header' => Mage::helper('catalog')->__('SKU'),
                'width' => '80px',
                'index' => 'product_sku'
            ));
        }

        $this->addColumn('product_image', array(
            'header' => Mage::helper('catalog')->__('Image'),
            'width' => '90px',
            'filter' => false,
            'renderer' => 'inventoryplus/adminhtml_renderer_productimage'
        ));

        $editable = $this->_editable;
        if ($this->_editable) {
            $this->addColumn('cost_product', array(
                'header' => Mage::helper('inventorypurchasing')->__('Cost Price <br />(' . $currency . ')'),
                'name' => 'cost_product',
                'index' => 'cost',
                'type' => 'number',
                'filter' => false,
                'editable' => $editable,
                'edit_only' => $editable,
            ));
        } else {
            $this->addColumn('cost', array(
                'header' => Mage::helper('inventorypurchasing')->__('Cost Price <br />(' . $currency . ')'),
                'name' => 'cost',
                'type' => 'currency',
                'currency_code' => (string) $currency,
                'index' => 'cost',
                'filter' => false,
                'editable' => $editable,
                'edit_only' => $editable,
            ));
        }
        $this->addColumn('tax', array(
            'header' => Mage::helper('inventorypurchasing')->__('Tax(%)'),
            'name' => 'tax',
            'type' => 'number',
            'index' => 'tax',
            'filter' => false,
            'editable' => $editable,
            'edit_only' => $editable,
        ));

        $this->addColumn('discount', array(
            'header' => Mage::helper('inventorypurchasing')->__('Discount(%)'),
            'name' => 'discount',
            'type' => 'number',
            'index' => 'discount',
            'filter' => false,
            'editable' => $editable,
            'edit_only' => $editable,
        ));

        $this->addColumn('supplier_sku', array(
            'header' => Mage::helper('inventorypurchasing')->__('Supplier SKU'),
            'name' => 'supplier_sku',
            'index' => 'supplier_sku',
            'filter' => false,
            'editable' => $editable,
            'edit_only' => $editable,
        ));
        if ($this->getRequest()->getParam('id')) {
            $this->addColumn('qty', array(
                'header' => Mage::helper('inventorypurchasing')->__('Total Qty Ordered'),
                'name' => 'qty',
                'type' => 'number',
                'index' => 'qty',
                'filter' => false
            ));
        }
        if ($warehouseIds = $this->getRequest()->getParam('warehouse_ids')) {
            $warehouseIds = explode(',', $warehouseIds);
            foreach ($warehouseIds as $warehouseId) {
                $this->addColumn('warehouse_' . $warehouseId, array(
                    'header' => 'Qty ordering for <br/>' . $this->getWarehouseById($warehouseId),
                    'name' => 'warehouse_' . $warehouseId,
                    'type' => 'number',
                    'index' => 'warehouse_' . $warehouseId,
                    'filter' => false,
                    'editable' => true,
                    'edit_only' => true,
                    'align' => 'right',
                    'sortable' => false
                ));
            }
        } elseif ($this->getRequest()->getParam('id')) {
            $resource = Mage::getSingleton('core/resource');
            $readConnection = $resource->getConnection('core_read');
            $installer = Mage::getModel('core/resource');
            $sql = 'SELECT distinct(`warehouse_id`),warehouse_name,qty_order from ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' . $this->getRequest()->getParam("id") . ')';
            $results = $readConnection->fetchAll($sql);
            if (count($results) > 0) {
                foreach ($results as $result) {
                    $neweditable = true;
                    if (!Mage::helper('inventoryplus')->getPermission($result['warehouse_id'], 'can_purchase_product') || !$this->_editable) {
                        $neweditable = false;
                    }
                    $this->addColumn('warehouse_' . $result['warehouse_id'], array(
                        'header' => 'Qty Ordered for <br/> ' . $result['warehouse_name'],
                        'name' => 'warehouse_' . $result['warehouse_id'],
                        'type' => 'number',
                        'index' => 'warehouse_' . $result['warehouse_id'],
                        'filter' => false,
                        'align' => 'right',
                        'editable' => $neweditable,
                        'edit_only' => $neweditable,
                        'sortable' => false,
                        'renderer' => 'inventorypurchasing/adminhtml_purchaseorder_edit_tab_renderer_warehouse'
                    ));
                }
            } else {
                $purchaseOrder = $this->getPurchaseOrder();
                $warehouseIds = $purchaseOrder->getWarehouseId();
                $warehouseIds = explode(',', $warehouseIds);
                foreach ($warehouseIds as $warehouseId) {
                    $neweditable = true;
                    if (!Mage::helper('inventoryplus')->getPermission($warehouse_id, 'can_purchase_product' || !$this->_editable)) {
                        $neweditable = false;
                    }
                    $this->addColumn('warehouse_' . $warehouseId, array(
                        'header' => 'Qty ordering for <br/>' . $this->getWarehouseById($warehouseId),
                        'name' => 'warehouse_' . $warehouseId,
                        'type' => 'number',
                        'index' => 'warehouse_' . $warehouseId,
                        'filter' => false,
                        'editable' => $neweditable,
                        'edit_only' => $neweditable,
                        'align' => 'right',
                        'sortable' => false
                    ));
                }
            }
        }

        if ($this->getRequest()->getParam('id')) {
            $this->addColumn('qty_recieved', array(
                'header' => Mage::helper('inventorypurchasing')->__('Total Qty Received'),
                'name' => 'qty_recieved',
                'type' => 'number',
                'index' => 'qty_recieved',
                'filter' => false,
                'sortable' => false
            ));
        }
        if ($this->getRequest()->getParam('id')) {
            $this->addColumn('qty_returned', array(
                'header' => Mage::helper('inventorypurchasing')->__('Total Qty Returned'),
                'name' => 'qty_returned',
                'type' => 'number',
                'index' => 'qty_returned',
                'filter' => false,
                'sortable' => false
            ));
        }
    }

    public function getWarehouseById($warehouseId) {
        $warehouse = Mage::getModel('inventoryplus/warehouse')->load($warehouseId);
        return $warehouse->getWarehouseName();
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
        $warehouseProducts = array();
        if ($productArrays) {
            $products = array();
            foreach ($productArrays as $productArray) {
                parse_str(urldecode($productArray), $purchaseorderProducts);
                if (count($purchaseorderProducts)) {
                    foreach ($purchaseorderProducts as $pId => $enCoded) {
                        $products[] = $pId;
                    }
                }
            }
        }
        if (!is_array($products) || Mage::getModel('admin/session')->getData('purchaseorder_product_import')) {
            $products = array_keys($this->getSelectedRelatedProducts());
        }
        return $products;
    }

    public function getSelectedRelatedProducts() {
        $products = array();
        $purchaseOrder = $this->getPurchaseOrder();
        $productCollection = Mage::getResourceModel('inventorypurchasing/purchaseorder_product_collection')
                ->addFieldToFilter('purchase_order_id', $purchaseOrder->getId());
        foreach ($productCollection as $product) {
            $products[$product->getProductId()] = array('qty_order' => $product->getQty());
            $resource = Mage::getSingleton('core/resource');
            $readConnection = $resource->getConnection('core_read');
            $installer = Mage::getModel('core/resource');
            $sql = 'SELECT warehouse_id,qty_order from ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' . $this->getRequest()->getParam("id") . ') AND (product_id = ' . $product->getProductId() . ')';
            $results = $readConnection->fetchAll($sql);
            foreach ($results as $result) {
                $products[$product->getProductId()]['warehouse_' . $result['warehouse_id']] = $result['qty_order'];
            }
        }

        if ($purchaseOrderProductImports = Mage::getModel('admin/session')->getData('purchaseorder_product_import')) {
            $productModel = Mage::getModel('catalog/product');
            foreach ($purchaseOrderProductImports as $productImport) {
                $productId = $productModel->getIdBySku($productImport['SKU']);
                if ($productId) {
                    foreach ($productImport as $pImport => $p) {
                        if ($pImport != 'SKU') {
                            $pImport = explode('_', $pImport);
                            if (isset($pImport[1]) && $pImport[1]) {
                                $products[$productId]['warehouse_' . $pImport[1]] = $p;
                            }
                        }
                    }

                    if (isset($productImport['COST'])) {
                        $products[$productId]['cost_product'] = $productImport['COST'];
                    } else {
                        $products[$productId]['cost_product'] = 0;
                    }
                    if (isset($productImport['TAX'])) {
                        $products[$productId]['tax'] = $productImport['TAX'];
                    } else {
                        $products[$productId]['tax'] = 0;
                    }
                    if (isset($productImport['DISCOUNT'])) {
                        $products[$productId]['discount'] = $productImport['DISCOUNT'];
                    } else {
                        $products[$productId]['discount'] = 0;
                    }
                    if (isset($productImport['SUPPLIER_SKU'])) {
                        $products[$productId]['supplier_sku'] = $productImport['SUPPLIER_SKU'];
                    } else {
                        $products[$productId]['supplier_sku'] = 0;
                    }
                }
            }
        }
        return $products;
    }

    /**
     * get Current Purchase Order
     *
     * @return Magestore_Inventory_Model_Purchaseorder
     */
    public function getPurchaseOrder() {
        return Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('id'));
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

    public function getRowUrl($row) {
        return false;
    }

}
