<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */

$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE `{$this->getTable('amorderstatus/status')}` ADD `notify_by_email` TINYINT( 1 ) NOT NULL ;
");

$installer->run("
CREATE TABLE `{$this->getTable('amorderstatus/status_template')}` (
`entity_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`status_id` INT UNSIGNED NOT NULL ,
`store_id` INT UNSIGNED NOT NULL ,
`template_id` INT UNSIGNED NOT NULL
) ENGINE = InnoDB ;
");

$installer->run("
ALTER TABLE `{$this->getTable('amorderstatus/status_template')}` ADD UNIQUE (
`status_id` ,
`store_id`
) ;
");

$installer->endSetup(); 