<?php
/**
 * Mexbs_Shipping_Model_Resource_Directory_Country_Collection
 * class that is used for extending the original collection with option to retrieved allowed
 * countries either for billing or for shipping
 *
 */
class Mexbs_Shipping_Model_Resource_Directory_Country_Collection extends Mage_Directory_Model_Resource_Country_Collection
{
    protected $_allowedType = 'billing';

    /**
     * Define main table
     *
     */
    protected function _construct()
    {
        $this->_init('directory/country');
    }

    /**
     * sets the allowed countries type to show
     *
     * @param string $type
     * @return Mexbs_Shipping_Model_Resource_Directory_Country_Collection
     */
    public function setAllowedType($type)
    {
        $this->_allowedType = $type;
        return $this;
    }

    /**
     * gets the allowed countries type to show
     *
     * @return string
     */
    public function getAllowedType()
    {
        return $this->_allowedType;
    }

    /**
     * Load allowed countries for current store
     *
     * @param mixed $storeId
     * @return Mage_Directory_Model_Resource_Country_Collection
     */
    public function loadByStore($storeId = null)
    {
        $allowed_countries_xml_config_path = 'general/country/allow';
        if($this->getAllowedType() == 'shipping'){
            $allowed_countries_xml_config_path = 'general/country/allow_shipping';
        }
        $allowCountries = explode(',', (string)Mage::getStoreConfig($allowed_countries_xml_config_path, $storeId));
        if (!empty($allowCountries)) {
            $this->addFieldToFilter("country_id", array('in' => $allowCountries));
        }
        return $this;
    }
}