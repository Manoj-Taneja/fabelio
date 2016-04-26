<?php
class Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Report_Items_Ordered extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_report_items_ordered';
        $this->_blockGroup = 'supplierfrontendproductuploader';
        $this->_headerText = Mage::helper('supplierfrontendproductuploader')->__('Supplier Items Ordered');
        parent::__construct();
        $this->_removeButton('add');
    }

}
