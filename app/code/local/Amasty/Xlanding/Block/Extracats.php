<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

class Amasty_Xlanding_Block_Extracats extends Mage_Core_Block_Template {
  protected function _construct() {
    parent::_construct();
    $this->setTemplate("amasty/amlanding/extracats.phtml");
  }
  protected function _getPage(){
    return Mage::registry('amlanding_page');
  }
}
?>
