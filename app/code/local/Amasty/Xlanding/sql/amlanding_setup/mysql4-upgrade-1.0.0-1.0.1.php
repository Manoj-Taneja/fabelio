<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
$this->startSetup();

$this->run("
    ALTER TABLE `{$this->getTable('amlanding/page')}` ADD `layout_static_top` VARCHAR(255) DEFAULT NULL;
    ALTER TABLE `{$this->getTable('amlanding/page')}` ADD `layout_static_bottom` VARCHAR(255) DEFAULT NULL;
    ALTER TABLE `{$this->getTable('amlanding/page')}` CHANGE COLUMN `attr_code` `attributes` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
 	DROP COLUMN `attr_value`;
");

$this->endSetup();