<?php
class Cminds_Marketplace_Block_Shipment_View extends Mage_Core_Block_Template {
    private $_carriers = false;
    public function getShipment() {
        $id = Mage::registry('shipment_id');
        return Mage::getModel('sales/order_shipment')->load($id);
    }

    private function getCarriers() {
        if($this->_carriers) {
            $this->_carriers = Mage::getSingleton('shipping/config')->getActiveCarriers();

            if(!$this->_carriers) {
                $this->_carriers = array();
            }
        }

        return $this->_carriers;
    }

    public function getCarrierName($carrierCode) {
        $carriers = array('custom' => 'Custom', 'dhl' => 'DHL (Deprecated)', 'fedex' => 'Federal Express', 'ups' => 'United Parcel Service', 'usps' => 'United States Postal Service', 'dhlint' => 'DHL');
        if(isset($carriers[$carrierCode])) {
            return $carriers[$carrierCode];
        }
        return '';
    }
}