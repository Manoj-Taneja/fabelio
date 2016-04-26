<?php
class Cminds_Marketplace_Block_Adminhtml_Catalog_Product_Set_Grid extends Mage_Adminhtml_Block_Catalog_Product_Attribute_Set_Grid
{
    
    protected function _prepareColumns()
    {
        $this->addColumn('available_for_supplier', array(
            'header' => Mage::helper('catalog')->__('Available for Supplier'),
            'align' => 'left',
            'index' => 'available_for_supplier',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('catalog')->__('Yes'),
                '0' => Mage::helper('catalog')->__('No'),
            ),
        )); 
        return parent::_prepareColumns();
    }

}
