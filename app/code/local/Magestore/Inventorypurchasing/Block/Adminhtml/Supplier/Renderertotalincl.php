<?php
class Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Renderertotalincl extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $data = $row->getData();
        $total_amount =  $row->getData($this->getColumn()->getIndex());
        $purchaseOrderId = $data['purchase_order_id'];
        $pruchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
        $tax_rate = Mage::helper('inventorypurchasing/purchaseorder')->getDataByPurchaseOrderId($purchaseOrderId,'tax_rate');        
        $totalincl_curency = $total_amount*(1+($tax_rate/100)) + $pruchaseOrder->getShippingCost();
        $currency = $row->getCurrency();
        if(!$currency)
            $currency = Mage::app()->getStore()->getBaseCurrencyCode();			
        return Mage::getModel('directory/currency')->load($currency)->formatTxt($totalincl_curency);
    }
}
?>