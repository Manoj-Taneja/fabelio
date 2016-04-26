<?php
/**
 * Sending a warning after save to tell the user they have not actually enabled
 * the module so no settings will appear on the frontend.
 *
 * @package     BlueAcorn\Optimizely
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_Optimizely_Model_Enabledcheck extends Mage_Core_Model_Config_Data
{
    /**
     * Check to see if user has enabled the configuration, if not, warn them they have not
     *
     * @return Mage_Core_Model_Abstract|void
     */
    protected function _afterSave()
    {
        $enabled = $this->getValue();
        if ($enabled == null || $enabled == 0) {
            Mage::getSingleton('core/session')->addNotice(
                Mage::helper('blueacorn_optimizely')->__('You have not enabled the Optimizely Extension. No data will appear on the frontend. Please enable to activate frontend Javascript output.')
            );
        }


        return parent::_afterSave();
    }
}
