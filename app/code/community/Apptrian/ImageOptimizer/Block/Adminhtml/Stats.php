<?php
/**
 * @category   Apptrian
 * @package    Apptrian_ImageOptimizer
 * @author     Apptrian
 * @copyright  Copyright (c) 2015 Apptrian (http://www.apptrian.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Apptrian_ImageOptimizer_Block_Adminhtml_Stats extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * Import static blocks
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return String
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
    	
    	$r = Mage::getResourceModel('apptrian_imageoptimizer/file');
    	
    	$indexed   = $r->getFileCount();
    	$optimized = $r->getFileCount(1);
    	
    	// Fix for division by zero possibility
    	if ($indexed == 0) {
    		$percent = 0;
    	} else {
    		$percent = round((100 * $optimized) / $indexed, 2);
    	}
    	
    	$html = '<div class="apptrian-imageoptimizer-bar-wrapper"><div class="apptrian-imageoptimizer-bar-outer">
    	<div class="apptrian-imageoptimizer-bar-inner" style="width:' . $percent .'%;"></div>
    	<div class="apptrian-imageoptimizer-bar-text"><span>' . $percent . '% ' . Mage::helper('apptrian_imageoptimizer')->__('(%s of %s files)', $optimized, $indexed) . '</span></div>
    	</div></div>';
    	
    	return $html;
    	
    }
}
