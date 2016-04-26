<?php

class Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Dashboard_Supplier_Products extends Mage_Adminhtml_Block_Dashboard_Grid
{
    protected $_collection;

    public function __construct()
    {
        parent::__construct();
        $this->setId('supplierProductsGrid');
    }

    protected function _prepareCollection()
    {
        $this->_collection = Mage::getModel('catalog/product')
            ->getCollection()->addAttributetoSelect('name')
            ->addAttributetoSelect('creator_id')
            ->addAttributetoFilter('creator_id', array('notnull' => true));

        $this->setCollection($this->_collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('sku', array(
            'header'    => $this->__('Product SKU'),
            'sortable'  => false,
            'index'     => 'sku',
        ));

        $this->addColumn('name', array(
            'header'    => $this->__('Product Name'),
            'sortable'  => false,
            'index'     => 'name',
        ));

        $this->addColumn('creator_id', array(
            'header'    => $this->__('Supplier Name'),
            'sortable'  => false,
            'index'     => 'creator_id',
            'renderer'  => 'Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Dashboard_Supplier_Products_Renderer_Name'
        ));

        $this->setFilterVisibility(false);
        $this->setPagerVisibility(false);

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/catalog_product/edit', array('id'=>$row->getId()));
    }
}
