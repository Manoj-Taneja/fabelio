<?php

class Cminds_Marketplace_Block_Adminhtml_Customer_Edit_Tab_Grid_Customername
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        $customer = Mage::getModel('customer/customer')->load($value);

        if($customer->getId()) {
            $ret = $customer->getFirstname() . ' ' . $customer->getLastname();
        } else {
            $ret = $value;
        }

        return $ret;
    }
}

?>