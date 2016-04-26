<?php

class Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Dashboard_Supplier_Products_Renderer_Name extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        $customerData = Mage::getModel('customer/customer')->load($value);
        return $this->htmlEscape($customerData->getFirstname() .' '. $customerData->getLastname());
    }
}
