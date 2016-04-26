<?php
/**
 * Magento
 *
 * @author    WakaMage http://www.wakamage.com <cs@wakamage.com>
 * @copyright Copyright (C) 2013 WakaMage. (http://www.wakamage.com)
 *
 */

class Sprint_Migs_Block_Payment_Redirect {
  public function __construct() {
    $session = Mage::getSingleton('checkout/session')->getLastRealOrderId();
		$order = Mage::getModel('sales/order')->loadByIncrementId($session);
		
    //Billing Data
    $billingAddress = !$order->getIsVirtual() ? $order->getBillingAddress() : null;
	  $address_line1 = "";
	  $district = "";
	  
	  if(strpos($billingAddress->getData("street"), "\n")){
	    $tmp = explode("\n", $billingAddress->getData("street"));
	    $district = $tmp[1];
	    $address_line1 = $tmp[0];
	  }
	  if($address_line1 == ""){
	    $address_line1 = $billingAddress->getData("street");
	  }
	  $billingData = array(
	    "billing_name"			=> $billingAddress ? $billingAddress->getName() : '',
	    "billing_company"		=> $billingAddress ? $billingAddress->getData("company") : '',
	    "billing_street"		=> $billingAddress ? $address_line1 : '',
	    "billing_district"		=> $billingAddress ? $district : '',
	    "billing_zip" 			=> $billingAddress ? $billingAddress->getData("postcode") : '',
	    "billing_city" 		=> $billingAddress ? $billingAddress->getData("city") : '',
	    "billing_state" 		=> $billingAddress ? Mage::getModel('directory/region')->load($billingAddress->getRegionId())->getName(): '',
	    "billing_country"		=> $billingAddress ? $billingAddress->getCountry() : '',
	    "billing_telephone"	=> $billingAddress ? $billingAddress->getData("telephone") : '',
	    "billing_email"		=> $order->getCustomerEmail()
	  );
		
    $billingName 		= $billingData[billing_name];
    $billingAddress		= $billingData[billing_street];
    $billingCity		= $billingData[billing_city];
    $billingState		= $billingData[billing_state];
    $billingPostalCode	= $billingData[billing_zip];
    $billingCountry		= $billingData[billing_country];
    $billingPhone		= $billingData[billing_telephone];
    $billingEmail		= $billingData[billing_email];
    
    //Shipping Data
    $shippingAddress = !$order->getIsVirtual() ? $order->getShippingAddress() : null;
	  $address_line1 = "";
	  $district = "";
	  
	  if(strpos($shippingAddress->getData("street"), "\n")){
	    $tmp = explode("\n", $shippingAddress->getData("street"));
	    $district = $tmp[1];
	    $address_line1 = $tmp[0];
	  }
	  if($address_line1 == ""){
	    $address_line1 = $shippingAddress->getData("street");
	  }
	 
	  /*return array(
	    "shipping_name"      => $shippingAddress ? $shippingAddress->getName() : '',
	    "shipping_company"   => $shippingAddress ? $shippingAddress->getData("company") : '',
	    "shipping_street"    => $shippingAddress ? $address_line1 : '',
	    "shipping_district"  => $shippingAddress ? $district : '',
	    "shipping_zip"       => $shippingAddress ? $shippingAddress->getData("postcode") : '',
	    "shipping_city"      => $shippingAddress ? $shippingAddress->getData("city") : '',
	    "shipping_state"     => $shippingAddress ? $shippingAddress->getRegionCode() : '',
	    "shipping_country"   => $shippingAddress ? $shippingAddress->getCountry() : '',
	    "shipping_telephone" => $shippingAddress ? $shippingAddress->getData("telephone") : ''
	  );*/
		
		$deliveryName 		  = $shippingAddress ? $shippingAddress->getName() : '';
		$deliveryAddress	  = $shippingAddress ? $address_line1 : '';
		$deliveryCity		    = $shippingAddress ? $shippingAddress->getData("city") : '';
		$deliveryState		  = $shippingAddress ? Mage::getModel('directory/region')->load($shippingAddress->getRegionId())->getName() : '';
		$deliveryPostalCode	= $shippingAddress ? $shippingAddress->getData("postcode") : '';
		$deliveryCountry	  = $shippingAddress ? $shippingAddress->getCountry() : '';
		
    //MIGS Data
    if(Mage::getStoreConfig('payment/migs/transaction_url') == "production")
    {
        $action = "https://acquire.doappx.com/sprint/doacquire/api/webAuthorization.cfm";
    }
    else
    {
      $action = "https://training.doappx.com/sprintAsia/api/webAuthorization.cfm";
    }
   // $action					        = Mage::getStoreConfig('payment/migs/transaction_url');
		$siteID					        = Mage::getSingleton('core/session')->getMigsSiteId();
    if(!$siteID) {
    $siteID                 = Mage::getStoreConfig('payment/migs/site_id');
    }
   /* else
    {
      if($siteID == 'FabelioBCA3' || $siteID == 'FabelioBCA6' || $siteID == 'FabelioBCA12')
        $action = "https://training.doappx.com/sprintAsia/api/webAuthorization.cfm";
   
    } */

		$ProfileCode			      = Mage::getStoreConfig('payment/migs/profile_code');
		$transactionType		    = Mage::getStoreConfig('payment/migs/transactionType');
		$merchantTransactionID	= Mage::getSingleton('checkout/session')->getLastRealOrderId();
		$amount					        = Mage::helper('migs')->getTotalPrice(); // Total Harga
		$currency				        = 'IDR';
		$serviceVersion			    = '1.2';

    $checkSum = md5(
      $amount.
			$currency.
			$merchantTransactionID.
			$serviceVersion.
			$siteID.
			$soml.
			$transactionType.
			$ProfileCode
		);
		
	  //Start Form
		echo '<form style="display:none;" title="migs" id="migs" name="migs" action="'.$action.'" method="post">';
		//MIGS Data
		echo '<p>siteID: <input type="text" name="siteID" id="siteID" value="'.$siteID.'" /></p>';
		echo '<p>merchantTransactionID: <input type="text" name="merchantTransactionID" id="merchantTransactionID" value="'.$merchantTransactionID.'" /></p>';
		echo '<p>serviceVersion: <input type="text" name="serviceVersion" id="serviceVersion" value="'.$serviceVersion.'" /></p>';
		echo '<p>currency: <input type="text" name="currency" id="currency" value="'.$currency.'" /></p>';
		echo '<p>amount: <input type="text" name="amount" id="amount" value="'.$amount.'" /></p>';
		//Billing Data
		echo '<p>billingName: <input type="text" name="billingName" id="billingName" value="'.$billingName.'" /></p>';
		echo '<p>billingAddress: <input type="text" name="billingAddress" id="billingAddress" value="'.$billingAddress.'" /></p>';
		echo '<p>billingCity: <input type="text" name="billingCity" id="billingCity" value="'.$billingCity.'" /></p>';
		echo '<p>billingState: <input type="text" name="billingState" id="billingState" value="'.$billingState.'" /></p>';
		echo '<p>billingPostalCode: <input type="text" name="billingPostalCode" id="billingPostalCode" value="'.$billingPostalCode.'" /></p>';
		echo '<p>billingCountry: <input type="text" name="billingCountry" id="billingCountry" value="'.$billingCountry.'" /></p>';
		echo '<p>billingPhone: <input type="text" name="billingPhone" id="billingPhone" value="'.$billingPhone.'" /></p>';
		echo '<p>billingEmail: <input type="text" name="billingEmail" id="billingEmail" value="'.$billingEmail.'" /></p>';
		//Shipping Data
		echo '<p>deliveryName: <input type="text" name="deliveryName" id="deliveryName" value="'.$deliveryName.'" /></p>';
		echo '<p>deliveryAddress: <input type="text" name="deliveryAddress" id="deliveryAddress" value="'.$deliveryAddress.'" /></p>';
		echo '<p>deliveryCity: <input type="text" name="deliveryCity" id="deliveryCity" value="'.$deliveryCity.'" /></p>';
		echo '<p>deliveryState: <input type="text" name="deliveryState" id="deliveryState" value="'.$deliveryState.'" /></p>';
		echo '<p>deliveryPostalCode: <input type="text" name="deliveryPostalCode" id="deliveryPostalCode" value="'.$deliveryPostalCode.'" /></p>';
		echo '<p>deliveryCountry: <input type="text" name="deliveryCountry" id="deliveryCountry" value="'.$deliveryCountry.'" /></p>';
		echo '<p><input type="hidden" value="'.$checkSum.'" name="checkSum" /></p>';
		echo '<p><input type="hidden" value="'.$transactionType.'" name="transactionType" /></p>';
		echo '<script type="text/javascript">document.getElementById("migs").submit();</script>';
	}
}
