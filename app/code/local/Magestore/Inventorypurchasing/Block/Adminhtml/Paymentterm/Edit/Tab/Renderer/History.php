<?php 
class Magestore_Inventorypurchasing_Block_Adminhtml_Paymentterm_Edit_Tab_Renderer_History
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $paymentTermHistoryId = $row->getPaymentTermHistoryId();
//        $url = $this->getUrl('inventorypurchasingadmin/adminhtml_paymentterms/showhistory');
        return '<p style="text-align:center"><a name="url" href="javascript:void(0)" onclick="showhistory('.$paymentTermHistoryId.')">'.Mage::helper('inventorypurchasing')->__('View').'</a></p>
                ';   
//                <script type="text/javascript">
//                    function showhistory(paymentTermHistoryId){
//                        var paymentTermHistoryId = paymentTermHistoryId;
//                        var url = "'.$url.'paymentTermHistoryId/"+paymentTermHistoryId;
//                        TINY.box.show(url,1, 800, 400, 1);
//                    }
//                </script>
    }
}