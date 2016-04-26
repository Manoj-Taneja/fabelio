<?php
class Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Renderertotalexcl extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $data = $row->getData();
        $total_amount =  $row->getData($this->getColumn()->getIndex());
        $purchaseOrderId = $data['purchase_order_id'];
        $pruchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
        $totalexcl_curency = $total_amount  + $pruchaseOrder->getShippingCost();
        $currency = $row->getCurrency();
        if(!$currency)
            $currency = Mage::app()->getStore()->getBaseCurrencyCode();			
        return Mage::getModel('directory/currency')->load($currency)->formatTxt($totalexcl_curency);  
    }
}
?>