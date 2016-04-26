<?php
class Cminds_Marketplace_Block_Adminhtml_Customer_Grid extends Mage_Adminhtml_Block_Customer_Grid {
    public function __construct()
    {
        parent::__construct();
        $this->setId('customerGrid');
        $this->setUseAjax(true);
        $this->setDefaultSort('entity_id');
        $this->setSaveParametersInSession(true);

        $this->setDefaultFilter(array('is_vendor' => 0));
    }

    protected function _prepareColumns(){
        $this->addColumnAfter('is_vendor', array(
            'header'    => Mage::helper('customer')->__('Is Vendor'),
            'index'     => 'customer_id',
            'renderer'  => 'Cminds_Marketplace_Block_Adminhtml_Customer_Grid_Renderer_Vendor',
            'type'      => 'options',
            'options'   => Mage::getSingleton('marketplace/source_massaction')->toFilterOptions(),
            'filter_condition_callback' => array($this, '_supplierFilter'),
        ),'email');
        return parent::_prepareColumns();
    }

    protected function _supplierFilter($collection, $column)
    {
        $value = $column->getFilter()->getValue();

        $supplier_id = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/supplier_group_id');
        $editor_id = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/editor_group_id');
        
        if($value == 1) {
            $this->getCollection()->addFieldToFilter('group_id', array($supplier_id,$editor_id));
        } else {
            $this->getCollection()->addFieldToFilter('group_id', array('neq' => array($editor_id)));
            $this->getCollection()->addFieldToFilter('group_id', array('neq' => array($supplier_id)));
        }

        return $this;
    }
}