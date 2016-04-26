<?php
class Cminds_Marketplace_Block_Adminhtml_Supplier_Customfields extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct() {
        $this->_blockGroup = 'marketplace';
        $this->_controller = 'adminhtml_supplier_customfields';
        $this->_headerText = Mage::helper('marketplace')->__('Supplier - Custom Profile Fields');
 
        parent::__construct();
    }

    public function getCreateUrl(){
        return $this->getUrl('*/*/createCustomField');
    }
}