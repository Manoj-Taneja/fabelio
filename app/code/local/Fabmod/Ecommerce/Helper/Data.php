<?php
class Fabmod_Ecommerce_Helper_Data extends Mage_Core_Helper_Abstract {
  public function isTagsEnabled(){
    return Mage::getStoreConfig("fabmod_ecommerce/tags/enabled");
  }
}
