<?php 
class Magestore_Inventorypurchasing_Block_Adminhtml_Shippingmethod_Edit_Tab_Renderer_History
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $shippingMethodHistoryId = $row->getShippingMethodHistoryId();
//        $url = $this->getUrl('inventorypurchasingadmin/adminhtml_shippingmethods/showhistory');
        return '<p style="text-align:center"><a name="url" href="javascript:void(0)" onclick="showhistory('.$shippingMethodHistoryId.')">'.Mage::helper('inventorypurchasing')->__('View').'</a></p>
                ';   
//                <script type="text/javascript">
//                    function showhistory(shippingMethodHistoryId){
//                        var shippingMethodHistoryId = shippingMethodHistoryId;
//                        var url = "'.$url.'shippingMethodHistoryId/"+shippingMethodHistoryId;
//                        TINY.box.show(url,1, 800, 400, 1);
//                    }
//                </script>
    }
}