<?php 
class Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Edit_Tab_Renderer_History
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $supplierHistoryId = $row->getSupplierHistoryId();
//        $url = $this->getUrl('inventorypurchasingadmin/adminhtml_supplier/showhistory');
        return '<p style="text-align:center"><a name="url" href="javascript:void(0)" onclick="showhistory('.$supplierHistoryId.')">'.Mage::helper('inventorypurchasing')->__('View').'</a></p>';   
//                <script type="text/javascript">
//                    function showhistory(supplierHistoryId){
//                        var supplierHistoryId  = supplierHistoryId ;
//                        var url = "'.$url.'supplierHistoryId/"+supplierHistoryId ;
//                        TINY.box.show(url,1, 800, 400, 1);
//                    }
//                </script>
    }
}