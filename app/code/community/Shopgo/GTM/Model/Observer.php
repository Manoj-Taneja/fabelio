<?php
/**
 * Google Tag Manager Observer
 *
 * @category    ShopGo
 * @package     Shopgo_GTM
 * @author      Ali Halabyah <ali@shopgo.me>
 * @copyright   Copyright (c) 2015 ShopGo
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License 3.0 (OSL-3.0)
 */
class Shopgo_GTM_Model_Observer
{
	/**
	 * Add order data to GTM block (for subsequent rendering in the data layer).
	 *
	 * @param Varien_Event_Observer $observer
	 */
	public function setGTMTransactionData(Varien_Event_Observer $observer)
	{
		$orderIds = $observer->getEvent()->getOrderIds();
		if (empty($orderIds) || !is_array($orderIds)) return;
		$block = Mage::app()->getFrontController()->getAction()->getLayout()->getBlock('google_tag_manager');
		if ($block) $block->setOrderIds($orderIds);
	}
}
