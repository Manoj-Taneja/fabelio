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



$installer = $this;

$installer->startSetup();
$installer->run("DROP TABLE IF EXISTS `{$installer->getTable('fpc/log')}`;");
$installer->run("
CREATE TABLE `{$installer->getTable('fpc/log')}` (
    `log_id`        int(11)       NOT NULL AUTO_INCREMENT COMMENT 'Log Id',
    `response_time` decimal(12,4) NOT NULL DEFAULT '0.0000' COMMENT 'Response Time',
    `from_cache`    int(11)       NOT NULL DEFAULT '0' COMMENT 'From Cache',

    `created_at`    datetime      NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='FPC Log';
");

$installer->run("DROP TABLE IF EXISTS `{$installer->getTable('fpc/log_aggregated_daily')}`;");
$installer->run("
CREATE TABLE `{$installer->getTable('fpc/log_aggregated_daily')}` (
    `id`               int(11)       NOT NULL AUTO_INCREMENT COMMENT 'Log Id',
    `period`           date          NOT NULL DEFAULT '0000-00-00',
    `from_cache`       int(11)       NOT NULL DEFAULT '0' COMMENT 'From Cache',
    `response_time`    decimal(12,4) NOT NULL DEFAULT '0.0000' COMMENT 'Response Time',
    `hits`             int(11)       NOT NULL DEFAULT '0.0000' COMMENT 'Hits',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='FPC Log Aggregated';
");

$installer->endSetup();
