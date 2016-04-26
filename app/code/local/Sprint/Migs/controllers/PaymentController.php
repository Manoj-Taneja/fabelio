<?php

class Sprint_Migs_PaymentController extends Mage_Core_Controller_Front_Action {
	// The redirect action is triggered when someone places an order
	
	public function redirectAction() {
		$this->getResponse()->setBody($this->getLayout()->createBlock('migs/payment_redirect'));
	}

	public function sendingAction() {
		$this->getResponse()->setBody($this->getLayout()->createBlock('migs/sending')->toHtml());
	}
	
	public function noidrAction() {
		$this->loadLayout();
		$this->renderLayout();
	}
	
	public function responseAction() {
		$orderId			= $_POST['merchantTransactionID'];
		$order 				= Mage::getModel('sales/order')->loadByIncrementId($orderId);
		$referer = parse_url($_SERVER['HTTP_REFERER']);
		$re 	 = $referer['scheme'];
		$ht		 = $referer['host'];
		$referer = $re."://".$ht;
		$referers = array(
			"development" => "training.doappx.com",
			"production" => "acquire.doappx.com"
		);
		$referers = $re."://".$referers[ Mage::getStoreConfig('payment/migs/transaction_url') ];
    Mage::log($_POST,null,"response.log");	
		if( $order ){
			if( Mage::getStoreConfig('payment/migs/transaction_url') == "development" OR ( /*$referers == $referer AND*/ Mage::getStoreConfig('payment/migs/transaction_url') == "production" ) ){
				//VALIDATE acquirerApprovalCode
				if( $_POST['acquirerApprovalCode'] != "" ){			
					$soml = '';
					$transactionDescription = '';
					$userDefineValue = '';
					$check = MD5(
								$_POST['acquirerApprovalCode'].
								$_POST['acquirerCode'].
								$_POST['acquirerMerchantAccount'].
								$_POST['acquirerResponseCode'].
								$_POST['amount'].
								$_POST['cardNo'].
								$_POST['currency'].
								$_POST['merchantTransactionID'].
								$_POST['scrubCode'].
								$_POST['scrubMessage'].
								$_POST['serviceVersion'].
								$_POST['siteID'].
								$_POST['SOML'].
								$transactionDescription.
								$_POST['transactionID'].
								$_POST['transactionStatus'].
								$_POST['transactionType'].
								$userDefineValue.
								Mage::getStoreConfig('payment/migs/profile_code')		
					);
					//VALIDATE checkSumResponse
					if( strtoupper( $_POST['checksumResponse'] ) == strtoupper( $check ) ){		
						if( strtoupper($order->getStatus()) == strtoupper( Mage::getStoreConfig('payment/migs/order_status') ) ){
							if ($_POST['transactionStatus'] == 'APPROVED'){		
								//$order->setData('state', "processing");
								//$order->setStatus("processing");
								//Mage::helper('migs')->generateInvoice( $order );
								$history = $order->addStatusHistoryComment('Payment has been processed by MIGS', FALSE);
								$order->sendNewOrderEmail();
								$order->setEmailSent(true);
								$history->setIsCustomerNotified(true);
                $order->save();
                Mage::getModel('sales/order')->loadByIncrementId($orderId)->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true)->save();
								Mage::log('['.date("Y-m-d H:i:s").'] SUCCESS, '.print_r($_POST,true), null, 'klikpayTrx.log');
							}else if ($_POST['transactionStatus'] == 'CANCEL'){		
								$order->setData('state', "canceled");
								$order->setStatus("canceled");
								$history->setIsCustomerNotified(true);
								$order->save();
								Mage::log('['.date("Y-m-d H:i:s").'] CANCEL, '.print_r($_POST,true), null, 'klikpayTrx.log');
							}else{
								$_POST['transactionStatus'] = 'SCRUBBED';
								Mage::log('['.date("Y-m-d H:i:s").'] SCRUBBED, '.print_r($_POST,true), null, 'klikpayTrx.log');
							}
						}else{
							$_POST['transactionStatus'] = 'SCRUBBED';
							Mage::log('['.date("Y-m-d H:i:s").'] FAILED TRANSACTION, INVALID LAST ORDER STATUS', null, 'klikpayTrx.log');
						}
					}else{
						$_POST['transactionStatus'] = 'SCRUBBED';
						Mage::log('['.date("Y-m-d H:i:s").'] FAILED TRANSACTION, INVALID checksumResponse [ '.strtoupper( $_POST['checksumResponse'] ).' >< '.strtoupper( $check ).' ]', null, 'klikpayTrx.log');
					}
				}else{
					$_POST['transactionStatus'] = 'SCRUBBED';
					Mage::log('['.date("Y-m-d H:i:s").'] FAILED TRANSACTION, EMPTY acquirerApprovalCode', null, 'klikpayTrx.log');
				}
			}else{
				$_POST['transactionStatus'] = 'SCRUBBED';
				Mage::log('['.date("Y-m-d H:i:s").'] FAILED TRANSACTION, INVALID REFFERED [ '.$referers.' >< '.$referer.' ]', null, 'klikpayTrx.log');
			}
		}else{
			$_POST['transactionStatus'] = 'SCRUBBED';
			Mage::log('['.date("Y-m-d H:i:s").'] FAILED TRANSACTION, INVALID ORDER', null, 'klikpayTrx.log');
		}
		
		
		Mage::getSingleton('checkout/cart')->truncate();
		Mage::getSingleton('checkout/session')->clear();
		$this->loadLayout();
		$this->renderLayout();
	}
}
