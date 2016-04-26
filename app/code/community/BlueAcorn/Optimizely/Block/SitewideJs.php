<?php
/**
 * @package     BlueAcorn\Optimizely
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_Optimizely_Block_SitewideJs extends Mage_Core_Block_Abstract
{
    /**
     * Return project code JS. returns empty string if module is disabled in System > Configuration
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (Mage::helper('blueacorn_optimizely')->isEnabled()) {
            return Mage::helper('blueacorn_optimizely')->getOptimizelyProjectCode() . PHP_EOL;
        } else {
           return '';
        }
    }
}
