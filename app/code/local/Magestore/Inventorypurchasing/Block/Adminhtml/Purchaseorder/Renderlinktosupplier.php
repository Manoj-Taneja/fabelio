<?php
class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Rendererlinktosupplier extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $data = $row->getData();
        $supplierId = $data['supplier_id'];
        $supplierName = $data['supplier_name'];
        $return = "<a href='".$this->getUrl('*/supplier/edit', array('id'=>$supplierId,'_current'=>false))."'>$supplierName</a>";
        return $return;
    }
}
?>