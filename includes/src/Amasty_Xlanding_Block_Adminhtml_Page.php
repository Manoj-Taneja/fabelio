<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */ 
class Amasty_Xlanding_Block_Adminhtml_Page extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_page';
        $this->_blockGroup = 'amlanding';
        $this->_headerText = Mage::helper('amlanding')->__('Landing Pages');
        $this->_addButtonLabel = Mage::helper('amlanding')->__('Add Landing Page');
        parent::__construct();
    }
}