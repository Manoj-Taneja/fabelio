<?php
/**
 * Clean the project code JS of unicode characters
 *
 * @package     BlueAcorn\Optimizely
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_Optimizely_Model_Projectcode extends Mage_Core_Model_Config_Data
{
    /**
     * Clean the project code of unicode characters.
     *
     * @return Mage_Core_Model_Abstract|void
     */
    protected function _beforeSave()
    {
        $script = $this->getValue();
        $script = preg_replace('/[^(\x20-\x7F)]*/','', $script);

        $this->setValue($script);

        return parent::_beforeSave();
    }
}
