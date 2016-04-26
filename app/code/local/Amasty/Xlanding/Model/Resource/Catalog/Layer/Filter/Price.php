<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

class Amasty_Xlanding_Model_Resource_Catalog_Layer_Filter_Price extends Mage_Catalog_Model_Resource_Layer_Filter_Price
{

    /**
     * Retrieve clean select with joined price index table
     *
     * @param Mage_Catalog_Model_Layer_Filter_Price $filter
     * @return Varien_Db_Select
     */
    protected function _getSelect($filter)
    {
//    	if (!Mage::helper('amlanding')->newFilterActive()) {
//    		return parent::_getSelect($filter);
//	  	}
    	
    	if (version_compare(Mage::getVersion(), '1.6.2.0', '<=')) {
            return parent::_getSelect($filter);
        }
        
        $collection = $filter->getLayer()->getProductCollection();
        $collection->addPriceData($filter->getCustomerGroupId(), $filter->getWebsiteId());

        if (!is_null($collection->getCatalogPreparedSelect())) {
            $select = clone $collection->getCatalogPreparedSelect();
        } else {
            $select = clone $collection->getSelect();
        }

        // reset columns, order and limitation conditions
        $select->reset(Zend_Db_Select::COLUMNS);
        $select->reset(Zend_Db_Select::ORDER);
        $select->reset(Zend_Db_Select::LIMIT_COUNT);
        $select->reset(Zend_Db_Select::LIMIT_OFFSET);

        // remove join with main table
        $fromPart = $select->getPart(Zend_Db_Select::FROM);
        if (!isset($fromPart[Mage_Catalog_Model_Resource_Product_Collection::INDEX_TABLE_ALIAS])
            || !isset($fromPart[Mage_Catalog_Model_Resource_Product_Collection::MAIN_TABLE_ALIAS])
        ) {
            return $select;
        }

        $select->where($this->_getPriceExpression($filter, $select) . ' IS NOT NULL');
        
        return $select;
    		
    }
    
	protected function _getPriceExpression($filter, $select, $replaceAlias = true)
    {
//    	if (Mage::helper('amlanding')->newFilterActive()) {
//    		$replaceAlias = false;
//    	}
    		$replaceAlias = false;
    	return parent::_getPriceExpression($filter, $select, $replaceAlias);
    }
}
