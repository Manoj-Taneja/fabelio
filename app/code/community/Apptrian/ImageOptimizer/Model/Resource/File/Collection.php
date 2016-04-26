<?php
/**
 * @category   Apptrian
 * @package    Apptrian_ImageOptimizer
 * @author     Apptrian
 * @copyright  Copyright (c) 2015 Apptrian (http://www.apptrian.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Apptrian_ImageOptimizer_Model_Resource_File_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	
	protected function _construct()
    {
    	$this->_init('apptrian_imageoptimizer/file');
    }
	
}