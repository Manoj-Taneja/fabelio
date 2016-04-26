<?php
class Cminds_Marketplace_Model_Mysql4_Rates extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('marketplace/rates', 'id');
    }
}
