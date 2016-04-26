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


class Mirasvit_MstCore_Helper_Data extends Mage_Core_Helper_Data
{
    public function isModuleInstalled($modulename)
    {
        $modules = Mage::getConfig()->getNode('modules')->children();
        $modulesArray = (array)$modules;

        if(isset($modulesArray[$modulename]) && $modulesArray[$modulename]->is('active')) {
            return true;
        } else {
            return false;
        }
    }

    public function pr($arr, $ip = false, $die = false)
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $clientIp = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $clientIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $clientIp = $_SERVER['REMOTE_ADDR'];
        }

        if (!$ip) {
            pr($arr);
        } elseif ($clientIp == $ip) {
            pr($arr);
            if ($die) {
                die();
            }
        }
    }

    public function copyConfigData($oldPath, $newPath, $callbackFunction = false)
    {
        if ($oldPath == $newPath) {
            throw new Exception("Old path should now be equal to the new path. Otherwise, we will have possible data loses.");
        }
        $resource = Mage::getSingleton('core/resource');
        $connection = $resource->getConnection('core_write');
        $query = "SELECT * FROM {$resource->getTableName('core/config_data')} where path='$oldPath'";
        $results = $connection->fetchAll($query);
        foreach ($results as $row) {
            $query = "REPLACE INTO {$resource->getTableName('core/config_data')} (scope, scope_id, path, value)
                VALUES (?, ?, ?, ?)";
            $value = $row['value'];
            if ($callbackFunction) {
                $value = call_user_func($callbackFunction, $value, $row['scope'], $row['scope_id']);
            }
            $connection->query($query, array($row['scope'], $row['scope_id'], $newPath, $value));
        }
    }
}

if (!function_exists('pr')) {

    function pr($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}
