<?php
/**
 * @package     BlueAcorn\Optimizely
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_Optimizely_Block_System_Config_Explanation extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->helper('blueacorn_optimizely')->__('These are for additional attributes you can set for product pages. These attributes will be included in your Optimizely custom variable and be available for page targeting.');
    }
}
