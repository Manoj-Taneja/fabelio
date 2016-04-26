<?php
class Fabmod_Criteo_Helper_Data extends Mage_Core_Helper_Abstract {
  public function isTagsEnabled(){
    return Mage::getStoreConfig("fabmod_criteo/tags/enabled");
  }
}
