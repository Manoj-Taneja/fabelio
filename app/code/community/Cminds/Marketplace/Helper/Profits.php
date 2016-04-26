<?php
class Cminds_Marketplace_Helper_Profits extends Mage_Core_Helper_Abstract {
    private $_fee;

    public function calcuateStoreIncome($supplier, $amount) {
        $storeFee = $this->getStoreProfit($supplier);

        return $amount * $storeFee / 100;
    }

    public function calculateNetIncome($supplier, $amount) {
        $storeFee = $this->getStoreProfit($supplier);
        return $amount - ($amount * ($storeFee / 100));
    }

    public function getStoreProfit($supplier) {
        if(!$this->_fee) {
            $customerObj = Mage::getModel('customer/customer')->load($supplier);
            $this->_fee = $customerObj->getData('percentage_fee');

            if($this->_fee == null || trim($this->_fee) == "") {
                $this->_fee = Mage::getStoreConfig('marketplace_configuration/general/default_percentage_fee');
            }
        }
        return $this->_fee;
    }
}
