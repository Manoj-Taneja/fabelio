<?php
/**
 * Magento
 *
 * @author    WakaMage http://www.wakamage.com <cs@wakamage.com>
 * @copyright Copyright (C) 2013 WakaMage. (http://www.wakamage.com)
 *
 */
 
class Sprint_Migs_Helper_Data extends Mage_Core_Helper_Abstract {
	
	//Get total price
	public function getTotalPrice() {
		$session = Mage::getSingleton('checkout/session')->getLastRealOrderId();
		$order = Mage::getModel('sales/order')->loadByIncrementId($session);
		$baseCode = Mage::app()->getBaseCurrencyCode();
		$allowedCurrencies = Mage::getModel('directory/currency')->getConfigAllowCurrencies(); 
		$rates = Mage::getModel('directory/currency')->getCurrencyRates($baseCode, array_values($allowedCurrencies));
		if($baseCode == 'IDR') {
			$TotalWithPeriod = explode('.', $order->getBaseGrandTotal());
			$totalPrice = $TotalWithPeriod[0];
		}
		else {
			$totalPriceRate = $order->getBaseGrandTotal()*$rates['IDR'];
			$TotalWithPeriod = explode('.', $totalPriceRate);
			$totalPrice = $TotalWithPeriod[0];
		}
		return $totalPrice;
	}
	
	//Get ordered product names
	public function getProducts() {
		//$session = Mage::getSingleton('checkout/session')->getLastRealOrderId();
		//$order = Mage::getModel('sales/order')->loadByIncrementId($session);
		$items = Mage::getSingleton('checkout/session')->getQuote()->getAllVisibleItems();

		$products = "";
	 
		foreach ($items as $item) {
			//$output .= $item->getSku() . "<br>";
			$products[] = $item->getName();
			//$output .= $item->getDescription() . "<br>";
			//$products .= "Qty: ".$item->getQtyToInvoice();
			//$output .= $item->getBaseCalculationPrice();
			//$products .= ", ";
		}
		
		return $products;
	}
	
	public function getTransactionDate() {
		$session = Mage::getSingleton('checkout/session')->getLastRealOrderId();
		$order = Mage::getModel('sales/order')->loadByIncrementId($session);
		$date = date("d-m-Y H:i:s", strtotime($order->getCreated_at()));
		$dateTimestamp = Mage::getModel('core/date')->timestamp(strtotime($date));
		$orderDate = date("d/m/Y H:i:s", $dateTimestamp);
		
		return $orderDate;
	}
	
	public function getKeyId() {
		$clearKey = Mage::getStoreConfig('payment/bcaklikpay/clearkey');
		$hexArray = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F');
		/*$hex_ary = array();
		foreach (str_split($clearKey) as $chr) {
		    $hex_ary[] = sprintf("%02X", ord($chr));
		}
		
		$bytes = implode('', $hex_ary);
		
		$keyId = $bytes;
		*/
		$bytes = array_merge(unpack('C*',$clearKey));
		
		$keyId = '';
		for ($i = 0 ; $i < strlen($clearKey) ; $i++) {
			$keyId .= $hexArray[($bytes[$i] & 0xFF) / 16] . $hexArray[($bytes[$i] & 0xFF) % 16];
		}
		
		return $keyId;
	}
	
	public function getFirstValue() {
		$klikPayCode = Mage::getStoreConfig('payment/bcaklikpay/klikpaycode');
		$transactionNo = Mage::getSingleton('checkout/session')->getLastRealOrderId();
		return $klikPayCode.$transactionNo.'IDR'.Mage::helper('bcaklikpay')->getKeyId();
	}
	
	public function getSecondValue() {
		//Generat second temporary value
		$dateExplode = explode(" ",Mage::helper('bcaklikpay')->getTransactionDate());
		$dateFirstArray = reset($dateExplode);
		$date = str_replace("/","",$dateFirstArray);
		
		$totalExplode = explode(".",Mage::helper('bcaklikpay')->getTotalPrice());
		$total = reset($totalExplode);
		
		return strval($date + $total);
	}

	public function getHash($value) {
		//Hashing
		$minVal = -2147483648;
		$maxVal = 2147483647;
		
		//Hashing first value
		$hash = 0;
		for ($i = 0; $i <= strlen($value)-1; $i++) {
			//echo $i.'<br>';
			$hash = ( $hash * 31 ) + ord($value[$i]);
			
			while ( $hash > $maxVal ) {
				$hash = $hash + $minVal - $maxVal - 1;
			}
			while ( $hash < $minVal ) {
				$hash = $hash + $maxVal - $minVal + 1;
			}
		}
		
		return $hash;
	}
	
	public function getPayType() {
		$session = Mage::getSingleton('checkout/session')->getLastRealOrderId();
		$order = Mage::getModel('sales/order')->loadByIncrementId($session);
		$bcaTenor = explode(',', $order->getPayment()->getBca_tenor());
		$all_numeric = true;
		foreach ($bcaTenor as $value) { 
		    if (!(is_numeric($value))) {
		        $all_numeric = false;
		        break;
		    } 
		}
		if ($order->getPayment()->getBca_tenor() == 01) {
			return '01';
		}
		elseif (count(array_unique($bcaTenor)) === 1 && $bcaTenor[0] === 'full') {
			return '01';
		}
		elseif ($all_numeric) {
			return '02';			
		}
		elseif (!$all_numeric) {
			return '03';
		}
		
	}
	
	public function getBcaCase() {
		$session = Mage::getSingleton('checkout/session')->getLastRealOrderId();
		$order = Mage::getModel('sales/order')->loadByIncrementId($session);
		return $order->getPayment()->getBca_case();
	}
	
	public function getAllowedInstallment() {
		$cartItems = Mage::getSingleton('checkout/session')->getQuote()->getAllVisibleItems();
		foreach ($cartItems as $item) {
			$isAllowed[] = Mage::getModel('catalog/product')->load($item->getProduct()->getId())->getCicilan_bcaklikpay();
		}
		
		return $isAllowed;
	}
}