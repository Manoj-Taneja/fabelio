<?php

/**
 * Created by IntelliJ IDEA.
 * User: eadesignpc
 * Date: 5/5/2015
 * Time: 10:16 AM
 */
class Eadesigndev_Romcity_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getCities($countryId, $regionId)
    {
        $cityCollection = Mage::getModel('romcity/romcity')->getCollection();
        $cityCollection->addFieldToSelect('cityname')
            ->setOrder('cityname', 'ASC')
            ->addFieldToFilter('country_id', $countryId)
            ->addFieldToFilter('region_id', $regionId);

        $jsonData = Mage::helper('core')->jsonEncode($cityCollection->getData());

        return $jsonData;
    }

    public function getCitiesAsOptions($countryId, $regionId)
    {
        $cityCollection = Mage::getModel('romcity/romcity')->getCollection();
        $cityCollection->addFieldToSelect('cityname')
            ->setOrder('cityname', 'ASC')
            ->addFieldToFilter('country_id', $countryId)
            ->addFieldToFilter('region_id', $regionId);

        return $cityCollection;
    }

}
