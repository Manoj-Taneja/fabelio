<?php
class Fareye_Qcdata_Model_Data extends Mage_Core_Model_Abstract {

/*  protected function _construct() {
    $this->_init('fareye_qcdata/data', 'id');
}  */

  protected function _construct() {
    $this->_init('qcdata/data');
  }
  public function getAvailableStatus() {
    return array(
      "0" => Mage::helper('qcdata')->__('Pending'),
      "1" => Mage::helper('qcdata')->__('Done'),
      "3" => Mage::helper('qcdata')->__('Failed'),
    );
  }

  protected function _beforeSave() {
    parent::_beforeSave();
    $this->_updateTimestamps();
    return $this;
  }

  protected function _updateTimestamps() {
    $timestamp = now();
    $this->setUpdatedAt($timestamp);
    if ($this->isObjectNew()) {
      $this->setCreatedAt($timestamp);
    }
    return $this;
  }

}
