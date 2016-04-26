<?php
class Cminds_Supplierfrontendproductuploader_Model_Mysql4_Order extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('supplierfrontendproductuploader/ordered_products', 'id');
    }
}
