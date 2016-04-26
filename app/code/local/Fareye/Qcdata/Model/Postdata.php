<?php
class Fareye_Qcdata_Model_Postdata extends Mage_Core_Model_Abstract {

  protected function _construct() {
    $this->_init('qcdata/postdata');
  }

  protected function _beforeSave() {
    parent::_beforeSave();
    $this->_updateTimestamps();
    return $this;
  }

  protected function _updateTimestamps() {
    $timestamp = now();
   // $this->setUpdatedAt($timestamp);
    if ($this->isObjectNew()) {
      $this->setCreatedAt($timestamp);
    }
    return $this;
  }
}
