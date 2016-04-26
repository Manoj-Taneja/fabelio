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



class Mirasvit_Fpc_Helper_Validator extends Mirasvit_MstCore_Helper_Validator_Abstract
{
    public function testMagentoCrc()
    {
        $filter = array(
            'app/code/core/Mage/Core',
            'app/code/core/Mage/Review',
            'js',
        );

        return Mage::helper('mstcore/validator_crc')->testMagentoCrc($filter);
    }

    public function testMirasvitCrc()
    {
        $modules = array('Fpc');

        return Mage::helper('mstcore/validator_crc')->testMirasvitCrc($modules);
    }

    public function testTablesExists()
    {
        $result = self::SUCCESS;
        $title = 'FPC: Required tables are exists';
        $description = array();

        $tables = array(
            'fpc/log',
            'fpc/log_aggregated_daily',
            'fpc/crawler_url',
        );

        foreach ($tables as $table) {
            if (!$this->dbTableExists($table)) {
                $description[] = "Table '$table' not exists";
                $result = self::FAILED;
            }
        }

        return array($result, $title, $description);
    }

    public function testColumnsExists()
    {
        $result = self::SUCCESS;
        $title = 'FPC: Required columns are exists';
        $description = array();
        $tableName = 'fpc/crawler_url';
        $fullTableName = Mage::getSingleton('core/resource')->getTableName($tableName);
        $tableColumns = array('sort_by_page_type', 'sort_by_product_attribute');

        foreach ($tableColumns as $column) {
            if (!$this->dbTableColumnExists($tableName, $column)) {
                $description[] = "Column '$column' not exists in table '$fullTableName'";
                $result = self::FAILED;
            }
        }

        return array($result, $title, $description);
    }

    public function testConflicts()
    {
        $result = self::SUCCESS;
        $title = 'Full Page Cache: Conflicts';
        $description = array();

        if (Mage::helper('mstcore')->isModuleInstalled('Devinc_Gomobile')) {
            $result = self::FAILED;
            $description[] = 'Devinc Gomobile installed. If you see folowing code "Mage::app()->getCacheInstance()->flush();"';
            $description[] = 'in file /app/code/community/Devinc/Gomobile/Model/Observer.php, please comment out it and contact to developers of the extension or disable this extension.';
            $description[] = "This code periodically flush cache, so Full Page Cache can't work correctly.";
        }

        if (Mage::helper('mstcore')->isModuleInstalled('Lesti_Fpc')) {
            $result = self::FAILED;
            $description[] = 'Lesti Fpc installed. Please, disable the extension in file /app/etc/modules/Lesti_Fpc.xml. Then flush all cache.';
            $description[] = "Full Page Cache can't work correctly with Lesti Fpc installed.";
        }

        if (file_exists(Mage::getBaseDir().'/app/design/frontend/base/default/layout/fpc.xml')) {
            $result = self::FAILED;
            $description[] = "File /app/design/frontend/base/default/layout/fpc.xml exists. It can do an exception 'Mage registry key \"_singleton/fpc/observer_save\" already exists'.";
            $description[] = 'It is not Mirasvit file. Please, rename file /app/design/frontend/base/default/layout/fpc.xml to /app/design/frontend/base/default/layout/fpc.xml_OLD. Then flush all cache.';
        }

        return array($result, $title, $description);
    }
}
