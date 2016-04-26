<?php 
class Magestore_Inventoryplus_Block_Adminhtml_Warehouse_Edit_Tab_Renderer_History
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $warehouseHistoryId = $row->getWarehouseHistoryId();
//        $url = $this->getUrl('inventoryadmin/adminhtml_warehouse/showhistory');
        return '<p style="text-align:center"><a name="url" href="javascript:void(0)" onclick="showhistory('.$warehouseHistoryId.')">'.Mage::helper('inventoryplus')->__('View').'</a></p>';   
//                <script type="text/javascript">
//                    function showhistory(warehouseHistoryId){
//                        var warehouseHistoryId = warehouseHistoryId;
//                        var url = "'.$url.'warehouseHistoryId/"+warehouseHistoryId;
//                        TINY.box.show(url,1, 800, 400, 1);
//                    }
//                </script>
    }
}