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
$installer->run("DROP TABLE IF EXISTS `{$installer->getTable('fpc/crawler_url')}`;");
$installer->run("
CREATE TABLE `{$installer->getTable('fpc/crawler_url')}` (
    `url_id`        int(11)       NOT NULL AUTO_INCREMENT COMMENT 'Url Id',
    `url`           text          NOT NULL,
    `cache_id`      varchar(255)  NOT NULL,
    `status`        int(11)       NOT NULL DEFAULT 0,
    `rate`          int(11)       NOT NULL DEFAULT 0,
    `created_at`    datetime      NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at`    datetime      NOT NULL DEFAULT '0000-00-00 00:00:00',
    `checked_at`    datetime      NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`url_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='FPC Log';
");

$installer->endSetup();
