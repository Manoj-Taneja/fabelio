<?php
class Fabmod_Shopgo_Helper_Data extends Mage_Core_Helper_Abstract {
  public function isTagsEnabled(){
    return Mage::getStoreConfig("fabmod_shopgo/tags/enabled");
  }
}
