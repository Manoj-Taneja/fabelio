<?php
/**
 * @package     BlueAcorn\Optimizely
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_Optimizely_Block_System_Config_Loginlink extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $label = $this->helper('blueacorn_optimizely')->__('Optimizely Login/Signup');
        return '<a href="http://optimizely.com" target="_blank">' . $label . '</a>';
    }
}
