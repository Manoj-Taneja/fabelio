<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */


class Amasty_Xlanding_Model_Source_Menu extends Varien_Object
{
	const INCLUDE_NO = 0;
	const INCLUDE_APPEND = 1;
	const INCLUDE_PREPEND = 2;
	
	public static function toOptionArray()
	{
	    $hlp = Mage::helper('amlanding');
		return array(
			array('value' => self::INCLUDE_NO, 'label' => $hlp->__('No')),
			array('value' => self::INCLUDE_APPEND, 'label' => $hlp->__('Yes, Append to existing')),
			array('value' => self::INCLUDE_PREPEND, 'label' => $hlp->__('Yes, Prepend existing')),
		);
	}
	
}