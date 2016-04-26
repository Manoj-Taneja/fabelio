<?php
class Cminds_Marketplace_Model_Mysql4_Report_Viewed_Collection extends Mage_Reports_Model_Resource_Report_Product_Viewed_Collection {
    protected function _applyStoresFilterToSelect(Zend_Db_Select $select)
    {
        $nullCheck = false;
        $storeIds  = $this->_storesIds;

        if (!is_array($storeIds)) {
            $storeIds = array($storeIds);
        }

        $storeIds = array_unique($storeIds);

        if ($index = array_search(null, $storeIds)) {
            unset($storeIds[$index]);
            $nullCheck = true;
        }

        $storeIds[0] = ($storeIds[0] == '') ? 0 : $storeIds[0];
        $selectParams = $select->getPart(Zend_Db_Select::FROM);
        $tableNames = array_keys($selectParams);

        if ($nullCheck) {
            $select->where($tableNames[0] . '.store_id IN(?) OR e.store_id IS NULL', $storeIds);
        } else {
            $select->where($tableNames[0] . '.store_id IN(?)', $storeIds);
        }

        return $this;
    }
}
