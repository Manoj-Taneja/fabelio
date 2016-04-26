<?php

class Cminds_Marketplace_Model_Shipping_Carrier_Marketplace_Shipping extends Mage_Shipping_Model_Carrier_Abstract implements Mage_Shipping_Model_Carrier_Interface
{
	protected $_code = 'marketplace_shipping';
	protected $_request = null;
	protected $_result = null;
	protected $data = array();
	protected $_supplierShippingPrices = array();

    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        $this->setRequest($request);
        $this->_collectData($request);

        $result = Mage::getModel('shipping/rate_result');

        $method = Mage::getModel('shipping/rate_result_method');
        $method->setCarrier('marketplace_shipping');
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod('marketplace_shipping');
        $method->setMethodTitle($this->getConfigData('name'));
        
        if($request->getFreeShipping()) {
            $method->setPrice(0.00);    
        } else {
            $method->setPrice($this->_getTotalPrice());
        }
        
        $result->append($method);

        $this->_result = $result;

        return $this->getResult();
    }

	public function setRequest(Mage_Shipping_Model_Rate_Request $request)
	{
		$this->_request = $request;

		$r = new Varien_Object();

		$this->_rawRequest = $r;

		return $this;
	}

	public function getResult()
	{
	   return $this->_result;
	}

	public function getCode($type, $code='')
	{
		$codes = array(
			'method'=>array(
				'FREIGHT'    => Mage::helper('usa')->__('Freight')
			)
		);

		if (!isset($codes[$type])) {
			return false;
		} elseif (''===$code) {
			return $codes[$type];
		}

		if (!isset($codes[$type][$code])) {
			return false;
		} else {
			return $codes[$type][$code];
		}
	}

	public function getAllowedMethods()
	{
		$allowed = explode(',', $this->getConfigData('allowed_methods'));
		$arr = array();
		foreach ($allowed as $k) {
			$arr[$k] = $this->getCode('method', $k);
		}
		return $arr;
	}

	public function proccessAdditionalValidation( Mage_Shipping_Model_Rate_Request $request )
	{

		if(!count($request->getAllItems())) {
			return $this;
		}

		$errorMsg = '';
		$configErrorMsg = $this->getConfigData('specificerrmsg');
		$defaultErrorMsg = Mage::helper('shipping')->__('The shipping module is not available.');
		$showMethod = $this->getConfigData('showmethod');

		if (!$errorMsg && !$request->getDestPostcode() && $this->isZipCodeRequired()) {
			$errorMsg = Mage::helper('shipping')->__('This shipping method is not available, please specify ZIP-code');
		}

		if ($errorMsg && $showMethod) {
			$error = Mage::getModel('shipping/rate_result_error');
			$error->setCarrier($this->_code);
			$error->setCarrierTitle($this->getConfigData('title'));
			$error->setErrorMessage($errorMsg);
			return $error;
		} elseif ($errorMsg) {
			return false;
		}
		return $this;
	}

    private function _getTotalPrice() {
        return max(array($this->getConfigData('minimum_suppler_shipping_price'), $this->_getSupplierTotalPrice()));
    }

    private function _getSupplierTotalPrice() {
        if($this->getConfigData('cost_calculation') == 1) {
            return array_sum($this->data['prices']);
        } elseif($this->getConfigData('cost_calculation') == 2) {
            return max($this->data['prices']);
        } else {
            return 0;
        }
    }

    private function _collectData($request) {
        $totalItems = array();

        foreach($request->getAllItems() AS $item){
            $qty = $item->getQty();
            $_product = Mage::getModel("catalog/product")
                ->load($item->getProductId());

            if($_product->getCreatorId()) {
                $totalItems[$_product->getCreatorId()][] = array(
                    $_product->getWeight(),
                    $item->getPrice(),
                    $qty
                );
            } else {
                $this->data['prices'][] = $this->getConfigData('default_shipping_fee');
            }
        }
        foreach($totalItems AS $supplier_id => $_items) {
            $costModel = Mage::getModel('marketplace/methods')
                ->load($supplier_id, 'supplier_id');
            if($costModel->getId()) {
                $cost = $this->_getPrice($costModel, $_items);

                if($cost === false) {
                    $this->data['prices'][] = $this->getConfigData('title');
                } else {
                    $this->data['prices'][] = $cost;
                }
            } else {
                $this->data['prices'][] = $this->getConfigData('default_shipping_fee_not_set_supplier');
            }
        }
    }

    private function _getPrice($supplierPriceModel, $items) {
        if($supplierPriceModel->getFreeShipping()) {
            return 0;
        }
        if($supplierPriceModel->getFlatRateAvailable()) {
            return $supplierPriceModel->getFlatRateFee();
        }
        if($supplierPriceModel->getTableRateAvailable()) {
            $supplerRates = Mage::getModel("marketplace/rates")
                ->load($supplierPriceModel->getSupplierId(), 'supplier_id');
            if(!$supplerRates->getId()) return $supplierPriceModel->getTableRateFee();
            $calculatedRate = $this->_calculateTableFee($items, $supplerRates, $supplierPriceModel->getTableRateCondition());

            if($calculatedRate === false) {
                $calculatedRate = $supplierPriceModel->getTableRateFee();
            }
            
            return $calculatedRate;
        }

        return 0.0;
    }

    private function _calculateTableFee($items, $model, $type) {

        $cart = Mage::getSingleton('checkout/cart');
        $country = $cart->getQuote()->getShippingAddress()->getCountry();
        $region = $cart->getQuote()->getShippingAddress()->getRegion();
        $postcode = $cart->getQuote()->getShippingAddress()->getPostcode();

        $total = 0;

        foreach($items AS $item) {
            
            if(isset($item[$type-1])) {
                if($type == 3) {
                    $total += $item[$type-1];
                } else {
                    $total += ($item[$type-1]*$item[2]);
                }
            }
        }
        if($type == 1) {
            return $model->getRateByWeight($country, $region, $postcode, $total); 
        } else if($type == 2) {
            return $model->getRateByWeight($country, $region, $postcode, $total); 
        } else if($type == 3) {
            return $model->getRateByWeight($country, $region, $postcode, $total); 
        }

        return 0;
    }
}
?>