<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

class Amasty_Xlanding_Model_Source_Import extends Mage_Core_Model_Config_Data
{
	public function _afterSave()
    {
        Mage::getResourceModel('amlanding/import')->uploadAndImport($this);
    }
	
}