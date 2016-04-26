<?php

class Cminds_Marketplace_Block_Adminhtml_Customer_Edit_Tab_Profile extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_customer_edit_tab_profile';
        $this->_blockGroup = 'marketplace';
        $this->_removeButton('save');
        $this->_removeButton('delete');
        $this->_removeButton('back');
        $this->_removeButton('reset');
    }

    public function getHeaderHtml()
    {
        return '';
    }
    public function getHeaderCssClass()
    {
        return 'icon-head head-cms-page';
    }
}
