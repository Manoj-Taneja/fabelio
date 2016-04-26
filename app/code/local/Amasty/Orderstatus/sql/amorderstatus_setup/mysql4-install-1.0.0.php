<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */

$installer = $this;

$installer->startSetup();

$installer->run("
CREATE TABLE IF NOT EXISTS `{$this->getTable('amorderstatus/status')}` (
`entity_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`alias` VARCHAR( 255 ) NOT NULL ,
`status` VARCHAR( 255 ) NOT NULL ,
`parent_state` VARCHAR( 64 ) NOT NULL ,
`is_active` TINYINT( 1 ) UNSIGNED NOT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;
");

$installer->endSetup(); 