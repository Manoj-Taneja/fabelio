<?php

class Cminds_Marketplace_Block_Adminhtml_Billing_List_Grid_Renderer_Owning
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $orderId = $row->getData('order_id');
        $supplierId = $row->getData('supplier_id');
        $toPaid = $row->getData('vendor_amount');

        $col = Mage::getModel('marketplace/payments')->getCollection()->addFilter('order_id', $orderId)->addFilter('supplier_id', $supplierId)->getFirstItem();

        $owning = $toPaid - $col->getAmount();
        if($owning == 0) {
            return '<div style="color:#FFF;font-weight:bold;background:green;border-radius:8px;">' . Mage::helper('core')->currency($toPaid - $col->getAmount(), true, false) . '</div>';
        } else {
            return '<div style="color:#FFF;font-weight:bold;background:red;border-radius:8px;">' . Mage::helper('core')->currency($toPaid - $col->getAmount(), true, false) . '</div>';
        }
    }
}