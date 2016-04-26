<?php
class Fareye_Qcdata_Model_Resource_Postdata extends Mage_Core_Model_Resource_Db_Abstract {
  protected function _construct() {
    $this->_init('qcdata/postdata', 'id');
  }
}
