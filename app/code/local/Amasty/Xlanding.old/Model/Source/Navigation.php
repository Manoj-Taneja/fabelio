<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */


class Amasty_Xlanding_Model_Source_Navigation extends Varien_Object
{
	const INCLUDE_NO = 0;
	const INCLUDE_LEFT = 'left';
	const INCLUDE_RIGHT = 'right';
	
	public function toOptionArray()
	{
	    $hlp = Mage::helper('amlanding');
		return array(
			array('value' => self::INCLUDE_NO, 'label' => $hlp->__('No')),
			array('value' => self::INCLUDE_LEFT, 'label' => $hlp->__('Yes, Left Sidebar')),
			array('value' => self::INCLUDE_RIGHT, 'label' => $hlp->__('Yes, Right Sidebar')),
		);
	}
	
	public function toFlatArray()
	{
	    $hlp = Mage::helper('amlanding');
		return array(
			self::INCLUDE_NO => $hlp->__('No'),
			self::INCLUDE_LEFT =>  $hlp->__('Yes, Left Sidebar'),
			self::INCLUDE_RIGHT => $hlp->__('Yes, Right Sidebar')
		);
	}
	
}