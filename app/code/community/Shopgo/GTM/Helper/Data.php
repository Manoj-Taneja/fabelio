<?php
/**
 * GTM Data Helper
 *
 * @category    ShopGo
 * @package     Shopgo_GTM
 * @author      Ali Halabyah <ali@shopgo.me>
 * @copyright   Copyright (c) 2015 ShopGo
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License 3.0 (OSL-3.0)
 */
class Shopgo_GTM_Helper_Data extends Mage_Core_Helper_Abstract
{
	const XML_PATH_ACTIVE = 'google/gtm/active';
	const XML_PATH_CONTAINER = 'google/gtm/containerid';

	const XML_PATH_DATALAYER = 'google/gtm/datalayer';
	const XML_PATH_DATALAYER_TRANSACTIONTYPE = 'google/gtm/datalayertransactiontype';
	const XML_PATH_DATALAYER_TRANSACTIONAFFILIATION = 'google/gtm/datalayertransactionaffiliation';

	/**
	 * Determine if GTM is ready to use.
	 *
	 * @return bool
	 */
	public function isGTMAvailable()
	{
		return Mage::getStoreConfig(self::XML_PATH_CONTAINER) && Mage::getStoreConfigFlag(self::XML_PATH_ACTIVE);
	}

	/**
	 * Get the GTM container ID.
	 *
	 * @return string
	 */
	public function getContainerId() {
		return Mage::getStoreConfig(self::XML_PATH_CONTAINER);
	}

	/**
	 * Add transaction and customer data to the data layer?
	 *
	 * @return bool
	 */
	public function isDataLayerEnabled()
	{
		return Mage::getStoreConfig(self::XML_PATH_DATALAYER);
	}

	/**
	 * Get the transaction type.
	 *
	 * @return string
	 */
	public function getTransactionType() {
		if (!Mage::getStoreConfig(self::XML_PATH_DATALAYER_TRANSACTIONTYPE)) return '';
		return Mage::getStoreConfig(self::XML_PATH_DATALAYER_TRANSACTIONTYPE);
	}

	/**
	 * Get the transaction affiliation.
	 *
	 * @return string
	 */
	public function getTransactionAffiliation() {
		if (!Mage::getStoreConfig(self::XML_PATH_DATALAYER_TRANSACTIONAFFILIATION)) return '';
		return Mage::getStoreConfig(self::XML_PATH_DATALAYER_TRANSACTIONAFFILIATION);
	}
}
