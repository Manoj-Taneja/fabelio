<?php
	class Cminds_Marketplace_Model_Invoice_Pdf extends Mage_Sales_Model_Order_Pdf_Invoice {
		protected function insertAddress(&$page, $store = null) {
	        $page->setFillColor(new Zend_Pdf_Color_GrayScale(0));
	        $font = $this->_setFontRegular($page, 10);
	        $page->setLineWidth(0);
	        $this->y = $this->y ? $this->y : 815;
	        $top = 815;
	        if($this->getIsSupplier()) {
	        	$supplierId = Mage::helper('marketplace')->getSupplierId();
        		$customer = Mage::getModel('customer/customer')->load($supplierId);
        		$billingAddress = $customer->getPrimaryBillingAddress();
				if($billingAddress) {
					$address = $billingAddress->format('html');
				} else {
					$address = "";
				}
        		foreach (explode("\n", $address) as $value){
		            if ($value !== '') {
		                $value = preg_replace('/<br[^>]*>/i', "\n", $value);

		                foreach (Mage::helper('core/string')->str_split($value, 45, true, true) as $_value) {
		                    $page->drawText(trim(strip_tags($_value)),
		                        $this->getAlignRight($_value, 130, 440, $font, 10),
		                        $top,
		                        'UTF-8');
		                    $top -= 10;
		                }
		            }
		        }
        	} else {
        		foreach (explode("\n", Mage::getStoreConfig('sales/identity/address', $store)) as $value){
		            if ($value !== '') {
		                $value = preg_replace('/<br[^>]*>/i', "\n", $value);
		                foreach (Mage::helper('core/string')->str_split($value, 45, true, true) as $_value) {
		                    $page->drawText(trim(strip_tags($_value)),
		                        $this->getAlignRight($_value, 130, 440, $font, 10),
		                        $top,
		                        'UTF-8');
		                    $top -= 10;
		                }
		            }
		        }
        	}
	        
	        $this->y = ($this->y > $top) ? $top : $this->y;
	    }
	}	