<?php
class Kellton_Customtabs_Block_Adminhtml_Config extends Mage_Core_Block_Template implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
 public function __construct(){
  $this->setTemplate('customtabs/custom_tab.phtml');
  parent::__construct();
 }

 //Label to be shown in the tab
 public function getTabLabel(){
  return Mage::helper('core')->__('Custom Tab');
 }

 public function getTabTitle(){
  return Mage::helper('core')->__('Custom Tab');
 }

 public function canShowTab(){
  return true;
 }

 public function isHidden(){
  return false;
 }
}

