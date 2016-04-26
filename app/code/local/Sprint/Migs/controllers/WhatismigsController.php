<?php
/**
 * Magento
 *
 * @author    WakaMage http://www.wakamage.com <cs@wakamage.com>
 * @copyright Copyright (C) 2013 WakaMage. (http://www.wakamage.com)
 *
 */

class Sprint_Migs_WhatismigsController extends Mage_Core_Controller_Front_Action {
	public function indexAction() {
		$this->getResponse()->setBody($this->getLayout()->createBlock('migs/whatismigs')->toHtml());
	}
}