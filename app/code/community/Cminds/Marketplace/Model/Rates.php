<?php
class Cminds_Marketplace_Model_Rates extends Mage_Core_Model_Abstract
{
    const GLOBAL_MARKER = '*';
    protected function _construct()
    {
        $this->_init('marketplace/rates', 'id');
    }

    public function getRateByWeight($country, $region, $postcode, $total) {
        $unserializedData = $this->unserializeRate();
        if(!$unserializedData) return false;

        $matched = $this->match($country, $region, $postcode);
        foreach($matched AS $i => $data) {
            if($data[3] <= $total && $total < $matched[$i+1][3]) {
                $shippingCost = $data;
                break;
            }
        }

        if(isset($shippingCost[4]) && is_numeric($shippingCost[4])) {
            return $shippingCost[4];
        } else {
            return false;
        }
    }

    public function getRateByPrice($total) {
        $unserializedData = $this->unserializeRate();

        if(!$unserializedData) return false;


        foreach($unserializedData AS $data) {
            if($data[5] >= $total) {
                return $data[4];
            }
        }

        if(count($matched) > 1 || count($matched) == 0) {
            return false;
        }

        $shippingCost = $matched[0];

        if(isset($shippingCost[4]) && is_numeric($shippingCost[4])) {
            return $shippingCost[4];
        } else {
            return false;
        }
    }

    public function getRate($country, $region, $postcode, $total) {
        $unserializedData = $this->unserializeRate();

        if(!$unserializedData) return false;

        $matched = $this->match($country, $region, $postcode, $total);

        if(count($matched) > 1 || count($matched) == 0) {
            return false;
        }

        $shippingCost = $matched[0];

        if(isset($shippingCost[4]) && is_numeric($shippingCost[4])) {
            return $shippingCost[4];
        } else {
            return false;
        }

    }

    public function unserializeRate($getEmpty = false) {
        if($this->getRateData() != NULL) {
            return unserialize($this->getRateData());
        }
        return ($getEmpty) ? array() : false;
    }

    private function match($country, $region, $postcode, $total) {
        $rates = $this->unserializeRate(true);
        $validCountries = array();

        foreach($rates AS $rate) {
            if($rate[0] == $country || $rate[0] == self::GLOBAL_MARKER) {
                $validCountries[] = $rate;
            }
        }

        $validRegions = array();
        foreach($validCountries AS $validCountry) {
            if($validCountry[1] == $region || $validCountry[1] == self::GLOBAL_MARKER) {
                $validRegions[] = $validCountry;
            }
        }
       
        $validZipCodes = array();
        foreach($validRegions AS $validRegion) {

            if($validRegion[2] == $postcode || $validRegion[2] == self::GLOBAL_MARKER) {
                $validZipCodes[] = $validRegion;
            } else {
                $pc = explode('-', $postcode);
                $vR = explode('-', $validRegion[2]);

                if($vR[0] == self::GLOBAL_MARKER && $pc[1] = $vR[1]) {
                    $validZipCodes[] = $validRegion;
                }elseif($vR[1] == self::GLOBAL_MARKER && $pc[0] = $vR[0]) {
                    $validZipCodes[] = $validRegion;
                }

            }
        }

        return $validZipCodes;
    }
}
