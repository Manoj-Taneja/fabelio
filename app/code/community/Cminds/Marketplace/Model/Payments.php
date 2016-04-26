<?php
class Cminds_Marketplace_Model_Payments extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('marketplace/payments', 'id');
    }
}
