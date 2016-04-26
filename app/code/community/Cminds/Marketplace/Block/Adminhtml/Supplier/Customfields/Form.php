<?php
class Cminds_Marketplace_Block_Adminhtml_Supplier_Customfields_Form
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'marketplace';
        $this->_controller = 'adminhtml_supplier_customfields';

        $this->_mode = 'edit';

        $newOrEdit = $this->getRequest()->getParam('id')
            ? $this->__('Edit')
            : $this->__('New');
        $this->_headerText =  $newOrEdit . ' ' . $this->__('Custom Field');
    }

    public function getDeleteUrl(){
        return $this->getUrl('*/*/deleteCustomField', array('id' => $this->getRequest()->getParam('id')));
    }
}