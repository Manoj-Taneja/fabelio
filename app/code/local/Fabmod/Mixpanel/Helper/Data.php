<?php
class Fabmod_Mixpanel_Helper_Data extends Mage_Core_Helper_Abstract {
  public function isTagsEnabled(){
    return Mage::getStoreConfig("fabmod_mixpanel/tags/enabled");
  }
  public function isPlusEnabled(){
    return Mage::getStoreConfig("fabmod_mixpanel/plus/enabled");
  }
  public function isAdwordsEnabled(){
    return Mage::getStoreConfig("fabmod_mixpanel/adwords/enabled");
  }
}
