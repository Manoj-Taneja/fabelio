<?php

class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Returnorder_Tab_Returnorder extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('productGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
        if (($this->getPurchaseOrder() && $this->getPurchaseOrder()->getId()) || Mage::getModel('admin/session')->getData('returnorder_product_import')) {
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
        $purchaseorder_id = $this->getRequest()->getParam('purchaseorder_id');
        $purchaseorderProducts = Mage::getModel('inventorypurchasing/purchaseorder_product')->getCollection()
                ->addFieldToFilter('purchase_order_id', $purchaseorder_id)
                ->addFieldToFilter('qty_recieved', array('gt' => 0));
        ;
        $productIds = array();
        foreach ($purchaseorderProducts as $purchaseorderProduct) {
            if ($purchaseorderProduct->getQtyRecieved() > 0)
                $productIds[] = $purchaseorderProduct->getProductId();
        }
//        $collection = Mage::getModel('catalog/product')->getCollection()
//                ->addAttributeToSelect('*')
//                ->addFieldToFilter('entity_id', array('in' => $productIds));
        $collection = Mage::getResourceModel('inventorypurchasing/product_collection')
                ->addAttributeToSelect('*')
                ->addFieldToFilter('entity_id', array('in' => $productIds))
                ->setIsGroupCountSql(true);
        if ($storeId = $this->getRequest()->getParam('store', 0))
            $collection->addStoreFilter($storeId);
        $collection->getSelect()
                ->joinLeft(array('purchaseorderproduct' => $collection->getTable('erp_inventory_purchase_order_product')), 'purchaseorderproduct.purchase_order_id IN (' . $this->getRequest()->getParam('purchaseorder_id') . ')
							and e.entity_id=purchaseorderproduct.product_id ', array(
                    'cost' => 'purchaseorderproduct.cost',
                    'tax' => 'purchaseorderproduct.tax',
                    'discount' => 'purchaseorderproduct.discount',
                    'qty' => 'purchaseorderproduct.qty',
                    'qty_recieved' => 'purchaseorderproduct.qty_recieved',
                    'qty_returned' => 'purchaseorderproduct.qty_returned'
                        )
                )
                ->group('e.entity_id');
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

//        $sets = Mage::getResourceModel('eav/entity_attribute_set_collection')
//                ->setEntityTypeFilter(Mage::getModel('catalog/product')->getResource()->getTypeId())
//                ->load()
//                ->toOptionHash();

        $this->addColumn('product_sku', array(
            'header' => Mage::helper('catalog')->__('SKU'),
            'width' => '80px',
            'index' => 'sku'
        ));

        $this->addColumn('product_price', array(
            'header' => Mage::helper('catalog')->__('Cost'),
            'type' => 'currency',
            'currency_code' => (string) Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
            'index' => 'price'
        ));

        $this->addColumn('qty', array(
            'header' => Mage::helper('inventorypurchasing')->__('Qty Ordered'),
            'name' => 'qty',
            'type' => 'number',
            'index' => 'qty',
            'filter' => false
        ));
        $this->addColumn('qty_recieved', array(
            'header' => Mage::helper('inventorypurchasing')->__('Qty Received'),
            'name' => 'qty_recieved',
            'type' => 'number',
            'index' => 'qty_recieved',
            'filter' => false
        ));

        $this->addColumn('qty_returned', array(
            'header' => Mage::helper('inventorypurchasing')->__('Qty Returned'),
            'name' => 'qty_returned',
            'type' => 'number',
            'index' => 'qty_returned',
            'filter' => false
        ));

        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $installer = Mage::getModel('core/resource');
        $sql = 'SELECT distinct(`warehouse_id`),warehouse_name from ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' . $this->getRequest()->getParam("purchaseorder_id") . ')';
        $results = $readConnection->fetchAll($sql);
        foreach ($results as $result) {
            if(Mage::helper('inventoryplus')->getPermission($result['warehouse_id'], 'can_purchase_product')){
                $this->addColumn('warehouse_' . $result['warehouse_id'], array(
                    'header' => 'Return Qty from ' . $result['warehouse_name'],
                    'name' => 'warehouse_' . $result['warehouse_id'],
                    'type' => 'number',
                    'index' => 'warehouse_' . $result['warehouse_id'],
                    'filter' => false,
                    'editable' => true,
                    'edit_only' => true,
                    'align' => 'right',
                    'sortable' => false,
                    'renderer' => 'inventorypurchasing/adminhtml_purchaseorder_returnorder_renderer_warehouse'
                ));
			}
        }
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/preparenewreturnorderGrid', array(
                    '_current' => true,
                    'id' => $this->getRequest()->getParam('id'),
                    'store' => $this->getRequest()->getParam('store')
        ));
    }

    public function _getSelectedProducts() {
        $products = $this->getProducts();
        if (!is_array($products) || Mage::getModel('admin/session')->getData('returnorder_product_import') || $this->getRequest()->getParam('id')) {
            $products = array_keys($this->getSelectedProducts());
        }
        return $products;
    }
       
    public function getSelectedProducts() {
        $purchaseOrder = $this->getPurchaseOrder();
      
        $products = array();
        $productCollection = Mage::getResourceModel('inventorypurchasing/purchaseorder_delivery_warehouse_collection')
                ->addFieldToFilter('purchase_order_id', $purchaseOrder->getId());
  
        if ($returnOrderProductImports = Mage::getModel('admin/session')->getData('returnorder_product_import')) {
            $productModel = Mage::getModel('catalog/product');
            foreach ($returnOrderProductImports as $productImport) {
                $productId = $productModel->getIdBySku($productImport['SKU']);
                if ($productId) {
                    foreach ($productImport as $pImport => $p) {
                        if ($pImport != 'SKU') {
                            $pImport = explode('_', $pImport);
                            if ($pImport[1]) {
                                $products[$productId]['warehouse_' . $pImport[1]] = $p;
                            }
                        }
                    }
                }
            }
        }else{
            $availableWarehouse = $this->getWarehouseAvailable();
            foreach($productCollection as $product){    
                if(in_array($product->getWarehouseId(), $availableWarehouse)){
                    $productId = $product->getProductId();                
                    $resource = Mage::getSingleton('core/resource');
                    $readConnection = $resource->getConnection('core_read');
                    $installer = Mage::getModel('core/resource');
                    $sql = 'SELECT qty_returned,qty_received FROM ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE purchase_order_id = ' . $purchaseOrder->getId() . ' AND product_id = '.$productId.' AND warehouse_id = '.$product->getWarehouseId();
                    $result = $readConnection->fetchRow($sql);
                    $qty = 0;
                    $qty = $result['qty_received'] - $result['qty_returned'];
                    if($qty < 0)
                        $qty = 0;
                    if ($productId) {                  
                        $products[$productId]['warehouse_' . $product->getWarehouseId()] = $qty;

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
        return Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('purchaseorder_id'));
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

    public function getWarehouseAvailable() {
        $adminId = Mage::getModel('admin/session')->getUser()->getId();
        if (!$adminId)
            return null;
        $warehouseAssigneds = Mage::getModel('inventoryplus/warehouse_permission')->getCollection()
                ->addFieldToFilter('admin_id', $adminId)
        ;
        $warehouseIds = array();
        foreach ($warehouseAssigneds as $warehouseAssigned) {
            if ($warehouseAssigned->getData('can_purchase_product'))
                $warehouseIds[] = $warehouseAssigned->getWarehouseId();
        }
        return $warehouseIds;
    }

    public function getRowUrl($row) {
        return false;
    }

}
