<?php
class Kontenta_Status_Block_Sales_Order_View_Changestatus extends Mage_Adminhtml_Block_Sales_Order_Abstract
{
	public function getStatusChangeUrl()
	{
		$id = $this->getRequest()->getParam('order_id');
        return Mage::helper("adminhtml")->getUrl('*/statuses_index/index', array('order_id'=>$id));
	}
	
	public function canChangeStatus()
	{
		return Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/change_in_status');
	}
}