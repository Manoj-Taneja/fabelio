<?php
class Fareye_Qcdata_Model_Resource_Data extends Mage_Core_Model_Resource_Db_Abstract {
  protected function _construct() {
 //   echo 123; die;
    $this->_init('qcdata/data', 'id');
  }
}
