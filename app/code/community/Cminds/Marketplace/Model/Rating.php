<?php
class Cminds_Marketplace_Model_Rating extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('marketplace/rating', 'id');
    }
}
