<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */

$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE `{$this->getTable('amorderstatus/status')}` ADD `is_system` TINYINT( 1 ) UNSIGNED NOT NULL ;
");

$installer->endSetup(); 