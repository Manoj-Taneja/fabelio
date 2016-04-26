<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Block_Adminhtml_Status_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'amorderstatus';
        $this->_controller = 'adminhtml_status';
        
        $this->_updateButton('save', 'label', Mage::helper('amorderstatus')->__('Save Order Status'));
        $this->_updateButton('delete', 'label', Mage::helper('amorderstatus')->__('Delete Order Status'));
    }

    public function getHeaderText()
    {
        if ($this->getRequest()->getParam('id')) {
            return Mage::helper('amorderstatus')->__('Edit Order Status');
        }
        return Mage::helper('amorderstatus')->__('Create New Order Status');
    }
}
