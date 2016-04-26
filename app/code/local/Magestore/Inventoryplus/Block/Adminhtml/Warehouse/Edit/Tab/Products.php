<?php

class Magestore_Inventoryplus_Block_Adminhtml_Warehouse_Edit_Tab_Products extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('productGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);            
        $this->setDefaultFilter(array('in_products' => 1));
    }
    
    public static function cmpAscAllocated($a, $b) {
        return $a->getAllocated() > $b->getAllocated();
    }

    public static function cmpDescAllocated($a, $b) {
        return $a->getAllocated() < $b->getAllocated();
    }
       
     protected function _prepareLayout()
    {        
        Mage::dispatchEvent('warehouse_product_prepare_layout', array('block' => $this)); 
        return parent::_prepareLayout();
    }
    public function getMainButtonsHtml()
    {
        $html = '';
        if($this->getFilterVisibility()){
            $html.= $this->getResetFilterButtonHtml();
            $html.= $this->getSearchButtonHtml();
            if($this->getChildHtml('add_product_button'))
                $html.= $this->getChildHtml('add_product_button');
        }
        return $html;
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
        
        $request = Mage::app()->getRequest();
        $filter_code = $request->getParam('filter');
        $column_sort = $request->getParam('sort');
        $dir = $request->getParam('dir');        
        if($request->getParam('limit')){
            $limit = $request->getParam('limit');
        }
		if(!isset($limit)){
			$limit = 20;		
		}	
		if($request->getParam('page')){
			$page = $request->getParam('page');
		}
		if(!isset($page)){
			$page = 1;
		}
		
        $data_filter = Mage::helper('adminhtml')->prepareFilterString($filter_code);       
        if(is_array($data_filter)){
            $allocated['from'] = isset($data_filter['allocated_qty']['from']) ? $data_filter['allocated_qty']['from'] : null;  
            $allocated['to'] = isset($data_filter['allocated_qty']['to']) ? $data_filter['allocated_qty']['to'] : null;      
        }                        
        
        $resource = Mage::getModel('core/resource');
        $warehouseId = $request->getParam('id');   
                   	        
        $collection = Mage::getResourceModel('inventoryplus/product_collection');       
        $collection->addAttributeToSelect('entity_id')
                    ->addAttributeToSelect('sku')                            
                    ->addAttributeToSelect('name')
                    ->addAttributeToSelect('status')
                    ->addAttributeToSelect('price')
                    ->addAttributeToSelect('attribute_set_id')
                    ->addAttributeToSelect('type_id')
                    ->addAttributeToFilter('type_id', array('nin' => array('configurable', 'bundle', 'grouped')));
        $collection->joinField('total_qty', 'inventoryplus/warehouse_product', 'total_qty', 'product_id=entity_id', "{{table}}.warehouse_id=$warehouseId", 'inner');
        $collection->joinField('available_qty', 'inventoryplus/warehouse_product', 'available_qty', 'product_id=entity_id', "{{table}}.warehouse_id=$warehouseId", 'inner');       
        
        // CUSTOMIZE STOCK MANAGER 
        // LINK
        $collection->getSelect()
               ->joinLeft(
                 array('order' => $resource->getTableName('inventoryplus/warehouse_order')), "e.entity_id = order.product_id" .
                        " and order.warehouse_id = $warehouseId", array('qty'));	
        $collection->getSelect()->columns(array('allocated' => 'SUM(qty)'));
                           
        
//        if(isset($allocated['from']) && $allocated['from'] >= 0){
//            $collection->getSelect()->having('SUM(qty) >= ?', $allocated['from']);           
//        }        
//        if(isset($allocated['to']) && $allocated['to'] >= 0){
//            $collection->getSelect()->having('SUM(qty) <= ?', $allocated['to']);
//        }               
        $collection->getSelect()->group('e.entity_id');                      
        if($column_sort == 'allocated_qty'){		
            $collection->getSelect()->order('SUM(order.qty) '.$dir);
        }
						                                                                                                                        
         //END CUSTOMIZE STOCK MANAGER                       
        $collection->setIsGroupCountSql(true);
        $this->setCollection($collection);      
        return parent::_prepareCollection();
    }
    protected function _prepareColumns() {      
        
        $adminId = Mage::getSingleton('admin/session')->getUser()->getId();
        $warehouse = $this->getRequest()->getParam('id');
        $check = Mage::helper('inventoryplus/warehouse')->canEdit($adminId, $warehouse);
        
        if($check == true)
            $this->addColumn('in_products', array(
                'header_css_class' => 'a-center',
                'type' => 'checkbox',
                'name' => 'in_products',
                'values' => $this->_getSelectedProducts(),
                'align' => 'center',
                'index' => 'entity_id',
                'disabled_values'=> $this->_getDisabledProducts()                
            ));

        $this->addColumn('entity_id', array(
            'header' => Mage::helper('catalog')->__('ID'),
            'sortable' => true,
            'width' => '60',
            'type'  => 'number',
            'index' => 'entity_id',
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

       
        $this->addColumn('total_qty', array(
            'header' => Mage::helper('catalog')->__('Physical Qty'),
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
        
        // CUSTOMIZE STOCK MANAGER 
        // LINK        
        $this->addColumn('allocated_qty', array(
            'header' => Mage::helper('catalog')->__('On Hold Qty'),
            'width' => '80px',
            'type' => 'number',
            'index' => 'allocated',
            'filter_condition_callback' => array($this, '_filterAllocated'),
            'align' => 'center',
            'renderer' => 'inventoryplus/adminhtml_renderer_orders',
            'default' => 0
        ));                       
        // END CUSTOMIZE STOCK MANAGER 
        $this->addExportType('*/*/exportProductsCsv', Mage::helper('inventoryplus')->__('CSV'));
        $this->addExportType('*/*/exportProductsXml', Mage::helper('inventoryplus')->__('XML'));
        return parent::_prepareColumns();
    }
    
    
    public function _getDisabledProducts() {
        $warehouse = $this->getRequest()->getParam('id');
        $products = array();
        if(!$warehouse)
            return $products;
        $productCollection = Mage::getResourceModel('inventoryplus/warehouse_product_collection')
                ->addFieldToFilter('warehouse_id', $warehouse);       
        if (count($productCollection)) {
            foreach ($productCollection as $product) {                
                if($product->getTotalQty()>0 || $product->getTotalQty()<0 || $product->getAvailableQty()>0 || $product->getAvailableQty()<0)
                    $products[$product->getProductId()] = array('total_qty' => $product->getQty());
            }
        }        
      
        return array_keys($products);
    }
    
    public function _getSelectedProducts() {
        $productArrays = $this->getProducts();
        $products = '';
        $warehouseProducts = array();
        if ($productArrays) {
            $products = array();
            foreach ($productArrays as $productArray) {
                parse_str(urldecode($productArray), $warehouseProducts);
                if (count($warehouseProducts)) {
                    foreach ($warehouseProducts as $pId => $enCoded) {
                        $products[] = $pId;
                    }
                }
            }
        }
        if (!is_array($products)) {
            $products = array_keys($this->getSelectedProducts());
        }
        return $products;
    }

    public function getSelectedProducts() {
        $warehouse = $this->getWarehouse();
        $products = array();
        $productCollection = Mage::getResourceModel('inventoryplus/warehouse_product_collection')
                ->addFieldToFilter('warehouse_id', $warehouse->getId());
        if (count($productCollection)) {
            foreach ($productCollection as $product) {
                $products[$product->getProductId()] = array('total_qty' => $product->getQty());
            }
        }
        return $products;
    }

    public function getWarehouse() {
        return Mage::getModel('inventoryplus/warehouse')
                        ->load($this->getRequest()->getParam('id'));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/productsGrid', array(
                    '_current' => true
                ));
    }
    
    public function getRowUrl($row)
    {
        return false;
    }
    
    public function _filterAllocated($collection,$column) {                                             
        $this->setCollection($collection);
        $filter = $column->getFilter()->getValue();        
        if (isset($filter['from']) && $filter['from']) {
            $collection->getSelect()->having('SUM(order.qty) >= ?', $filter['from']);
        }
        if (isset($filter['to']) && $filter['to']) {            
            $collection->getSelect()->having('SUM(order.qty) <= ?', $filter['to']);
        }
		$filterCollection = clone $collection;
		$filterCollection->clear();
		$filterCollection->setPageSize(false);                
		$_stt=0;
		foreach($filterCollection as $col){
			$_stt++;
        }
        $collection->setSize($_stt);
    }       

}

