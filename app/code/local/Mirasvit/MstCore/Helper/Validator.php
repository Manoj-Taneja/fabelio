<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Full Page Cache
 * @version   1.0.1
 * @build     360
 * @copyright Copyright (C) 2015 Mirasvit (http://mirasvit.com/)
 */


class Mirasvit_MstCore_Helper_Validator extends Mirasvit_MstCore_Helper_Validator_Abstract
{
    public function testCache()
    {
        $result = self::SUCCESS;
        $title = 'Core: PHP Cache';
        $description = array();

        $caches = array(
            'APC'     => 'apc_clear_cache',
            'OPcache' => 'opcache_reset',
            'xCache'  => 'xcache_clear_cache',
        );

        foreach ($caches as $name => $method) {
            if (function_exists($method)) {
                $description[] = "PHP Cache $name is installed. Please, clear it after installation or upgrade (method $method)";
                $result = self::INFO;
            }
        }

        return array($result, $title, $description);
    }

    public function testRedisCache()
    {
        $result = self::SUCCESS;
        $title = 'Core: Redis Cache';
        $description = array();

        $backend = (string)Mage::getConfig()->getNode('global/cache/backend');
        if ($backend == 'Cm_Cache_Backend_Redis') {
            $description[] = "Cm_Cache_Backend_Redis is installed. Please, clear it after installation or upgrade. To clear cache use SSH:<br>
<pre>
$ redis-cli
redis> flushall
</pre>
            ";
            $result = self::INFO;
        }
        return array($result, $title, $description);
    }

    public function testMirasvitMstCoreCrc()
    {
        $modules = array('MCore');
        return Mage::helper('mstcore/validator_crc')->testMirasvitCrc($modules);
    }
}