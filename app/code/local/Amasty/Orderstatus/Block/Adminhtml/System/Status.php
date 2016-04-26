<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Block_Adminhtml_System_Status extends Mage_Adminhtml_Block_Template
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate('amasty/amorderstatus/system/status.phtml');
        $this->_prepareSystemStatuses();
        return $this;
    }
    
    protected function _prepareSystemStatuses()
    {
        $statuses = Mage::helper('amorderstatus')->getSystemStatuses();
        $this->setSystemStatuses($statuses);
    }
    
    public function getSaveUrl()
    {
        return $this->getUrl('*/*/systemSave');
    }
}