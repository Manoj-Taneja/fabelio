<?php

class Cminds_Marketplace_Block_Adminhtml_Customer_Edit_Tab_Grid_Net
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        return Mage::helper('core')->currency(Mage::helper('marketplace/profits')->calculateNetIncome(Mage::registry('current_customer')->getId()  , $value), true, false);
    }
}

?>