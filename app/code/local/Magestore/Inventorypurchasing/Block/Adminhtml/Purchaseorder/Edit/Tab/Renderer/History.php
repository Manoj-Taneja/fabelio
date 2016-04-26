<?php 
class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Edit_Tab_Renderer_History
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $purchaseOrderHistoryId = $row->getPurchaseOrderHistoryId();
//        $url = $this->getUrl('inventorypurchasingadmin/adminhtml_purchaseorders/showhistory');
        return '<p style="text-align:center"><a name="url" href="javascript:void(0)" onclick="showhistory('.$purchaseOrderHistoryId.')">'.Mage::helper('inventorypurchasing')->__('View').'</a></p>
                ';   
//                <script type="text/javascript">
//                    function showhistory(purchaseOrderHistoryId){
//                        var purchaseOrderHistoryId = purchaseOrderHistoryId;
//                        var url = "'.$url.'purchaseOrderHistoryId/"+purchaseOrderHistoryId;
//                        TINY.box.show(url,1, 800, 400, 1);
//                    }
//                </script>
    }
}