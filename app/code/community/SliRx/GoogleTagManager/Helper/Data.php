<?php
/**
 * @author     Karazey Sergey <karazey.sergey@gmail.com>
 * @copyright  2014 Karazey Sergey
 * @created    10:00 27/06/2014
 * @license    http://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 */

/**
 * Class SliRx_GoogleTagManager_Helper_Data
 */
class SliRx_GoogleTagManager_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLED = 'slirx_gtm/slirx_gtm_group/enable';
    const XML_PATH_CONTAINER_ID = 'slirx_gtm/slirx_gtm_group/container_id';
    const XML_PATH_ENABLE_REMARKETING = 'slirx_gtm/slirx_gtm_remarketing_group/enable_remarketing';
    const XML_PATH_ENABLE_TRANSACTION = 'slirx_gtm/slirx_gtm_transaction_group/enable_transaction';
    const XML_PATH_TRANSACTION_AFFILIATION = 'slirx_gtm/slirx_gtm_transaction_group/transaction_affiliation';

    /**
     * Return module status
     *
     * @return mixed
     */
    public function isActive()
    {
        return Mage::getStoreConfig(self::XML_PATH_ENABLED);
    }

    /**
     * Return container id
     *
     * @return mixed
     */
    public function getContainerId()
    {
        return Mage::getStoreConfig(self::XML_PATH_CONTAINER_ID);
    }

    /**
     * Return remarketing status
     *
     * @return mixed
     */
    public function isActiveRemarketing()
    {
        return Mage::getStoreConfig(self::XML_PATH_ENABLE_REMARKETING);
    }

    /**
     * Return transaction status
     *
     * @return mixed
     */
    public function isActiveTransaction()
    {
        return Mage::getStoreConfig(self::XML_PATH_ENABLE_TRANSACTION);
    }

    /**
     * Return transaction affiliation
     *
     * @return string
     */
    public function getTransactionAffiliation()
    {
        return Mage::getStoreConfig(self::XML_PATH_TRANSACTION_AFFILIATION);
    }
}
