<?php 
class Cminds_Core_Block_Adminhtml_System_Config_Form_License extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {
        $value = $element->getValue();
        if(strlen($value) == 32) {
            $value = substr($value, 0, -10);
            $element->setValue($value.'**********');
        }
        return $element->getElementHtml();
    }
}