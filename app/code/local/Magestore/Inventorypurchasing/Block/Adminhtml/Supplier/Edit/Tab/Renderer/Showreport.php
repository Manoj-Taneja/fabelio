<?php 
class Magestore_Inventory_Block_Adminhtml_Supplier_Edit_Tab_Renderer_Showreport
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $productId = $row->getEntityId();
        $supplierId = Mage::app()->getRequest()->getParam('id');
        $supplier = Mage::helper('inventorypurchasing/supplier')->getAllSupplierName();
        if(count($supplier) && !$supplierId){
            $model = Mage::getModel('inventorypurchasing/supplier');
            $firstItem = $model->getCollection()->getFirstItem();
            $supplierId = $firstItem->getSupplierId();
        }
        return '<p style="text-align:center"><a name="url" href="# return false;" onclick="showreport('.$productId.','.$supplierId.'); return false;">'.Mage::helper('inventorypurchasing')->__('View').'</a></p>';       
    }
}