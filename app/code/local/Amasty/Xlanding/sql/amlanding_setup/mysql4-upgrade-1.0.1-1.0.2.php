<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
$this->startSetup();

$this->run("
    ALTER TABLE `{$this->getTable('amlanding/page')}` ADD `include_navigation` VARCHAR(16) DEFAULT '0';
    ALTER TABLE `{$this->getTable('amlanding/page')}` ADD `columns_count` SMALLINT DEFAULT 3;
    ALTER TABLE `{$this->getTable('amlanding/page')}` ADD `include_menu` SMALLINT DEFAULT 0;
    ALTER TABLE `{$this->getTable('amlanding/page')}` ADD `include_menu_position` SMALLINT DEFAULT 0;
");

$this->endSetup();