<?php
class Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Catalog_Product_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('supplier_products');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(false);
    }

    protected function _getStore()
    {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('attribute_set_id')
            ->addAttributeToSelect('creator_id')
            ->addAttributeToSelect('type_id');

        if (Mage::helper('catalog')->isModuleEnabled('Mage_CatalogInventory')) {
            $collection->joinField('qty',
                'cataloginventory/stock_item',
                'qty',
                'product_id=entity_id',
                '{{table}}.stock_id=1',
                'left');
        }

        $collection->addAttributeToSelect('price');
        $collection->joinAttribute('status', 'catalog_product/status', 'entity_id', null, 'inner');
        $collection->joinAttribute('visibility', 'catalog_product/visibility', 'entity_id', null, 'inner');
        $collection->joinAttribute('supplier_old_price', 'catalog_product/supplier_old_price', 'entity_id', null, 'left');
        $collection->joinAttribute('supplier_price_change', 'catalog_product/supplier_price_change', 'entity_id', null, 'left');
        $collection->addAttributeToFilter('creator_id',array('neq' => NULL));
        $this->setCollection($collection);

        parent::_prepareCollection();
        $this->getCollection()->addWebsiteNamesToResult();
        return $this;
    }

    protected function _addColumnFilterToCollection($column)
    {
        if ($this->getCollection()) {
            if ($column->getId() == 'websites') {
                $this->getCollection()->joinField('websites',
                    'catalog/product_website',
                    'website_id',
                    'product_id=entity_id',
                    null,
                    'left');
            }
        }
        return parent::_addColumnFilterToCollection($column);
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id',
            array(
                'header'=> Mage::helper('catalog')->__('ID'),
                'width' => '50px',
                'type'  => 'number',
                'index' => 'entity_id',
            ));
        $this->addColumn('creator_id',
            array(
                'header'=> Mage::helper('catalog')->__('Supplier ID'),
                'width' => '50px',
                'index' => 'creator_id',
            ));
        $this->addColumn('name',
            array(
                'header'=> Mage::helper('catalog')->__('Name'),
                'index' => 'name',
            ));

        $this->addColumn('sku',
            array(
                'header'=> Mage::helper('catalog')->__('SKU'),
                'width' => '80px',
                'index' => 'sku',
            ));

        $store = $this->_getStore();
        $this->addColumn('price',
            array(
                'header'=> Mage::helper('catalog')->__('Price'),
                'type'  => 'price',
                'currency_code' => $store->getBaseCurrency()->getCode(),
                'index' => 'price',
            ));

        if (Mage::helper('catalog')->isModuleEnabled('Mage_CatalogInventory')) {
            $this->addColumn('qty',
                array(
                    'header'=> Mage::helper('catalog')->__('Qty'),
                    'width' => '100px',
                    'type'  => 'number',
                    'index' => 'qty',
                ));
        }

        $this->addColumn('visibility',
            array(
                'header'=> Mage::helper('catalog')->__('Visibility'),
                'width' => '70px',
                'index' => 'visibility',
                'type'  => 'options',
                'options' => Mage::getModel('catalog/product_visibility')->getOptionArray(),
            ));

        $this->addColumn('status',
            array(
                'header'=> Mage::helper('catalog')->__('Status'),
                'width' => '70px',
                'index' => 'status',
                'type'  => 'options',
                'options' => Mage::getSingleton('catalog/product_status')->getOptionArray(),
            ));

        $this->addColumn('supplier_old_price', 
            array(
                'header'=> Mage::helper('catalog')->__('Old Price'), 
                'width' => '70px', 
                'index' => 'supplier_old_price', 
                'type'  => 'price',
                'currency_code' => $store->getBaseCurrency()->getCode(),      
            )); 

         $this->addColumn('supplier_price_change', 
              array(     
                 'header'=> Mage::helper('catalog')->__('Price Changed by Supplier'),  
                 'width' => '70px', 
                 'index' => 'supplier_price_change',  
                 'type'  => 'options',  
                 'options' => $this->_getAttributeOptions('supplier_price_change'), 
            ));


        $this->addColumn('created_at',
            array(
                'header'=> Mage::helper('catalog')->__('Created On'),
                'width' => '70px',
                'index' => 'created_at',
                'renderer' => 'Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Catalog_Product_Grid_Renderer_Createddate'
            ));


        $this->addColumn('enable',
            array(
                'header'=> Mage::helper('supplierfrontendproductuploader')->__('Approve'),
                'width' => '100px',
                'sortable'  => false,
                'index'     => 'enable',
                'type'      => 'options',
                'renderer' => 'Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Catalog_Product_Grid_Renderer_Approve'
            ));
        
        $this->addColumn('review_price_change',
            array(
                'header'=> Mage::helper('supplierfrontendproductuploader')->__('Review Price Change'),
                'width' => '100px',
                'sortable'  => false,
                'index'     => 'enable',
                'type'      => 'options',
                'renderer' => 'Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Catalog_Product_Grid_Renderer_Review'
            ));
        
        $this->addColumn('action',
            array(
                'header'    => Mage::helper('catalog')->__('Action'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('catalog')->__('Edit'),
                        'url'     => array(
                            'base'=>'adminhtml/catalog_product/edit',
                            'params'=>array('store'=>$this->getRequest()->getParam('store'), 'supplier' => true)
                        ),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
            ));

        if (Mage::helper('catalog')->isModuleEnabled('Mage_Rss')) {
            $this->addRssList('rss/catalog/notifystock', Mage::helper('catalog')->__('Notify Low Stock RSS'));
        }

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('product');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('catalog')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('catalog')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('catalog/product_status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));

        $this->getMassactionBlock()->addItem('status', array(
            'label'=> Mage::helper('catalog')->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Status'),
                    'values' => $statuses
                )
            )
        ));

        $this->getMassactionBlock()->addItem('approve', array(
            'label'=> Mage::helper('catalog')->__('Approve'),
            'url'  => $this->getUrl('*/*/massApprove'),
            'confirm' => Mage::helper('catalog')->__('Are you sure to approve these products?')
        ));
        $this->getMassactionBlock()->addItem('disapprove', array(
            'label'=> Mage::helper('catalog')->__('Disapprove'),
            'url'  => $this->getUrl('*/*/massDisapprove'),
            'confirm' => Mage::helper('catalog')->__('Are you sure?')
        ));

        return $this;
    }

     protected function _getAttributeOptions($attribute_code)
     {
        $attribute = Mage::getModel('eav/config')->getAttribute('catalog_product', $attribute_code);
        $options = array();
        foreach( $attribute->getSource()->getAllOptions(true, true) as $option ) {
          $options[$option['value']] = $option['label'];
        }
        return $options;
     }
        
    public function getGridUrl()
    {
        return $this->getUrl('*/*/index', array('_current'=>true));
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('adminhtml/catalog_product/edit', array(
                'store' => $this->getRequest()->getParam('store'),
                'supplier' => true,
                'id' => $row->getId())
        );
    }
}
