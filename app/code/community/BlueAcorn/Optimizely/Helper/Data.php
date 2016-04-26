<?php
/**
 * Methods that retrieve saved data in the module's system configuration
 *
 * @package     BlueAcorn\Optimizely
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_Optimizely_Helper_Data extends Mage_Core_Helper_Abstract
{
    const CONFIG_PATH = 'blueacorn_optimizely/';

    /**
     * Config meta method for getting gts config
     *
     * @param string $code
     * @param string $group
     * @return mixed
     */
    public function getConfig($code, $group)
    {
        return Mage::getStoreConfig(self::CONFIG_PATH . "$group/$code");
    }

    /**
     * Is Optimizely enabled
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->getConfig('enabled', 'settings');
    }

    /**
     * Is Revenue Tracking Enabled
     *
     * @return boolean
     */
    public function isRevenueTrackingEnabled()
    {
        return $this->getConfig('revenue_tracking', 'settings');
    }

    /**
     * Sitewide JS from system config
     *
     * @return string
     */
    public function getOptimizelyProjectCode()
    {
        return $this->getConfig('optimizely_project_code', 'settings');

    }

    /**
     * Get custom product attributes from config
     *
     * @return array
     */
    public function getCustomAttributes()
    {
        $attrs = array();

        $config = Mage::getStoreConfig(self::CONFIG_PATH . "project_settings/attributes");

        if (is_array($config)) {
            foreach($config as $attr) {
                $attrs[] = $attr['attribute'];
            }
        }

        return $attrs;
    }
}
