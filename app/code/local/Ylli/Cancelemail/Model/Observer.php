<?php
class Ylli_Cancelemail_Model_Observer
{

            public function invoicedStatusChange(Varien_Event_Observer $observer)
            {
				$order =$observer->getEvent()->getOrder();
				$orderstatus =$order->getStatusLabel();
				$incrementid =$order->getIncrementId();
				$new_data = $observer->getEvent()->getData('data_object')->getData();
				$orderstatus =$order->getStatusLabel();
				$flagvalue = $order->getExportProcessed();
				 
				//Manufacturing 2/3 Awaiting COD confirmation Awaiting Bank Transfer
					//if (($original_data['status'] !== $new_data['status'])&&($orderstatus=='Complete: Delivered' ||$orderstatus=='Closed' || $orderstatus=='Canceled'|| $orderstatus=='Processing: Awaiting COD confirmation'|| $orderstatus=='Processing: Awaiting Bank Transfer'|| $orderstatus=='Processing: Manufacturing 2/3')) {
					//if (($orderstatus=='Complete: Delivered' ||$orderstatus=='Closed' || $orderstatus=='Canceled'|| $orderstatus=='Processing: Awaiting COD confirmation'|| $orderstatus=='Processing: Awaiting Bank Transfer'|| $orderstatus=='Processing: Manufacturing 2/3')) {
					  // $original_data = $observer->getEvent()->getData('data_object')->getOrigData();
        Mage::log("Order Status : ".$orderstatus);				
				if (($orderstatus=='Complete' || $orderstatus=='Canceled'|| $orderstatus=='Canceled: Customer'||  $orderstatus=='Canceled: No response'|| $orderstatus=='Processing: Manufacturing 2/3') & ($flagvalue!=1)) {
						$order->setExportProcessed(true);  
						$this->_sendStatusMail($order,$orderstatus);
            Mage::log("Transactional mail sent");
					}               
				
			}

 
		 private  function _sendStatusMail($order,$orderstatus)
			{
				//$emailTemplate  = Mage::getModel('core/email_template');
				$template_name = array('Complete'=>'Complete','Canceled'=>'Canceled','Canceled: No response'=>'Canceled','Canceled: Customer'=>'Canceled','Processing: Manufacturing 2/3'=>'Processing: Manufacturing 2/3');

				$emailTemplate = Mage::getModel('core/email_template')  ->loadByCode($template_name[$orderstatus]);
				//  $emailTemplate->loadDefault('sales_email_order_invoice_items');
        Mage::log("Template Name : ".$template_name[$orderstatus]);
				// $emailTemplate->loadDefault('custom_order_tpl');
				//$emailTemplate->setTemplateSubject('Your order was holded : '.$orderstatus.'flag vakue'.$flagevalue);
		 
				// Get General email address (Admin->Configuration->General->Store Email Addresses)
				$salesData['email'] = Mage::getStoreConfig('trans_email/ident_general/email');
				$salesData['name']  = Mage::getStoreConfig('trans_email/ident_general/name'); 
        if($orderstatus=='Complete'){
          $emailTemplate->addBcc('system_74f24e7262aa6@inbound.trustedcompany.com');
        }

				//$emailTemplate->setSenderName($salesData['name']);
				$emailTemplate->setSenderName('Tarra dari Fabelio');
				$emailTemplate->setSenderEmail($salesData['email']);
				$Incrementid = $order->getIncrementId();
				$emailTemplateVariables['username']  = $order->getCustomerFirstname() . ' ' . $order->getCustomerLastname();
				$emailTemplateVariables['order_id'] = $order->getIncrementId();
				$emailTemplateVariables['store_name'] = $order->getStoreName();
				$emailTemplateVariables['store_url'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
				$emailTemplate->send($order->getCustomerEmail(), $order->getStoreName(), array('order'=>$order,'test'=>$Incrementid));
			}
}
?>
