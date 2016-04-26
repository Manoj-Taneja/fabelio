<?php
class Cminds_Marketplace_Model_Mysql4_Categories_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('marketplace/categories');
    }
}
