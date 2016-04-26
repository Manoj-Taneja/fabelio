<?php
/**
 * class that is used for helper methods and translation
 */
class Mexbs_Shipping_Helper_Data extends Mage_Core_Helper_Data
{

    /**
     * gets whether the country is allowed
     *
     * @param string $countryCode
     * @param string $allowType
     * @param int|null $storeId
     * @return bool
     */
    public function isCountryAllowed($countryCode, $allowType='billing', $storeId=null)
    {
        /**
         * @var Mage_Directory_Model_Resource_Country_Collection $allowedCountries
         */
        $allowedCountries = $this->getAllowedCountries($allowType, $storeId);
        foreach($allowedCountries as $country){
            if($country['iso2_code'] == $countryCode){
                return true;
            }
        }
        return false;
    }

    /**
     * gets the allowed countries for specified type
     *
     * @var string $type
     * @var int|null $storeId
     * @return array
     */
    public function getAllowedCountries($type, $storeId=null)
    {
        $storeId = ($storeId ? $storeId : Mage::app()->getStore()->getId());
        $useCache   = Mage::app()->useCache('config');
        $allowedCountries = false;
        if ($useCache) {
            $cacheId    = 'MEXBS_SHIPPING_ALLOWED_COUNTRIES_TYPE_' . $type . '_STORE_' . $storeId;
            $cacheTags  = array('config');
            if ($allowedCountriesCache = Mage::app()->loadCache($cacheId)) {
                $allowedCountries = unserialize($allowedCountriesCache);
            }
        }

        if ($allowedCountries == false) {
            /**
             * @var Mage_Directory_Model_Resource_Country_Collection $allowedCountriesCollection
             */
            $allowedCountriesCollection = Mage::getModel('directory/country')->getResourceCollection()->setAllowedType($type)->loadByStore($storeId);
            $allowedCountries = $allowedCountriesCollection->toArray(array('iso2_code'));
            if ($useCache) {
                Mage::app()->saveCache(serialize($allowedCountries), $cacheId, $cacheTags);
            }
        }
        return (isset($allowedCountries['items']) ? $allowedCountries['items'] : array());
    }

    /**
     * checks whether the the address is valid for shipping
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @param int|null $storeId
     * @return bool
     */
    public function isValidAddressForShipping($address, $storeId=null)
    {
        return $this->isValidAddress($address, 'shipping', $storeId);
    }

    /**
     * checks whether the the address is valid for address type
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @param string $type
     * @param int|null $storeId
     * @return bool
     */
    public function isValidAddress($address, $type='billing', $storeId=null)
    {
        $countryCode = $address->getCountryId();
        if(!$countryCode){
            return true;
        }
        return $this->isCountryAllowed($countryCode, $type, $storeId);
    }
}