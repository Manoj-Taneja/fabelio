<?php
class Fabmod_Fbpixel_Helper_Data extends Mage_Core_Helper_Abstract {
  public function isFbPxEnabled(){
    return Mage::getStoreConfig("fabmod_fbpixel/fbpx/enabled");
  }
  public function getPxId(){
    return Mage::getStoreConfig("fabmod_fbpixel/fbpx/pxid");
  }
  public function isInPxEnabled(){
    return Mage::getStoreConfig("fabmod_fbpixel/inpx/enabled");
  }
  public function getInPxId(){
    return Mage::getStoreConfig("fabmod_fbpixel/inpx/pxid");
  }
}
