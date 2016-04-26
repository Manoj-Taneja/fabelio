<?php

class Magestore_Inventoryplus_Block_Adminhtml_Listadjuststock extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_adjuststock_listadjuststock';
        $this->_blockGroup = 'inventoryplus';
        $this->_headerText = Mage::helper('inventoryplus')->__('Manage Stock Adjustments');
        $this->_addButtonLabel = Mage::helper('inventoryplus')->__('Add Stock Adjustment');
        parent::__construct();
        if(!Mage::helper('inventoryplus/adjuststock')->getWarehouseByAdmin()){
            $this->_removeButton('add');
        }
    }
}