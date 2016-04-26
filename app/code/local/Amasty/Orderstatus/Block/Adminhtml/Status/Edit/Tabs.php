<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Block_Adminhtml_Status_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('amorderstatus_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('amorderstatus')->__('Order Status Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('info', array(
            'label'     => Mage::helper('amorderstatus')->__('Status Information'),
            'title'     => Mage::helper('amorderstatus')->__('Status Information'),
            'content'   => $this->getLayout()->createBlock('amorderstatus/adminhtml_status_edit_tab_info')->toHtml(),
        ));
        
        $this->addTab('email', array(
            'label'     => Mage::helper('amorderstatus')->__('E-mail Notifications'),
            'title'     => Mage::helper('amorderstatus')->__('E-mail Notifications'),
            'content'   => $this->getLayout()->createBlock('amorderstatus/adminhtml_status_edit_tab_email')->toHtml(),
        ));
     
        return parent::_beforeToHtml();
    }
}