<?php
class Cminds_Marketplace_Model_Categories extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('marketplace/categories', 'id');
    }
}
