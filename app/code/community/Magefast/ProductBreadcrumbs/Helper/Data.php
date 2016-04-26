<?php

class Magefast_ProductBreadcrumbs_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_CATEGORY_URL_SUFFIX = 'catalog/productbreadcrumbs/skip_categories';
    const CACHE_TAG = 'magefast_product_breadcrumbs';

    protected $_skipCategoryIDs = array();


    /**
     * Get skip category IDs
     *
     * @param null $storeId
     * @return mixed
     */
    public function getSkipCategoryIDs($storeId = null)
    {
        if (is_null($storeId)) {
            $storeId = Mage::app()->getStore()->getId();
        }

        if (!isset($this->_skipCategoryIDs[$storeId])) {
            $arrayData = array();
            $configData = Mage::getStoreConfig(self::XML_PATH_CATEGORY_URL_SUFFIX, $storeId);
            $configData = trim($configData);

            $configDataArray = explode(',', $configData);

            foreach ($configDataArray as $a) {
                $arrayData[intval(trim($a))] = intval(trim($a));
            }

            $this->_skipCategoryIDs[$storeId] = $arrayData;
        }
        return $this->_skipCategoryIDs[$storeId];
    }

}