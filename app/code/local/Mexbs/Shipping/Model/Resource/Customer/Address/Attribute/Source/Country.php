<?php
/**
 * Mexbs_Shipping_Model_Resource_Customer_Address_Attribute_Source_Country
 * class that is used for overriding the customer address country select box source
 *
 */
class Mexbs_Shipping_Model_Resource_Customer_Address_Attribute_Source_Country extends Mage_Customer_Model_Resource_Address_Attribute_Source_Country
{
    /**
     * Retreive all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $countryCollection = Mage::getResourceModel('directory/country_collection');
            if($this->getAttribute() && $this->getAttribute()->getAddressType()){
                $countryCollection->setAllowedType($this->getAttribute()->getAddressType());
            }
            $countryCollection->loadByStore($this->getAttribute()->getStoreId());
            $this->_options = $countryCollection->toOptionArray();
        }
        return $this->_options;
    }
}