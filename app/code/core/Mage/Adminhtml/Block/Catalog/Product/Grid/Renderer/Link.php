<?php
class Mage_Adminhtml_Block_Catalog_Product_Grid_Renderer_Link extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {
  public function render(Varien_Object $row) {
    $value =  $row->getProductUrl();
    return "<a href='$value' target='_blank'>View</a>";
  }
}

