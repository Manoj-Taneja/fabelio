<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Block_Adminhtml_Status extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'amorderstatus';
        $this->_controller = 'adminhtml_status'; // not actual controller, but name to build right grid class
        $this->_headerText = Mage::helper('amorderstatus')->__('Manage Custom Order Statuses');
        $this->_addButtonLabel = Mage::helper('amorderstatus')->__('Add New Custom Order Status');
        
        if (version_compare(Mage::getVersion(), '1.5.0.0', '<')) {
            $this->_addButton('edit_sys', array(
                'label'     => Mage::helper('amorderstatus')->__('Edit Default Order Statuses'),
                'onclick'   => 'setLocation(\'' . $this->getEditSystemStatusesUrl() .'\')',
                'class'     => 'go',
            ));
        }
        
        parent::__construct();
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/edit');
    }
    
    public function getEditSystemStatusesUrl()
    {
        return $this->getUrl('*/*/system');
    }
}