<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
$this->startSetup();

$this->run("

CREATE TABLE  `{$this->getTable('amlanding/page')}` (
  `page_id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Page ID',
  `title` varchar(255) DEFAULT NULL COMMENT 'Page Title',
  `root_template` varchar(255) DEFAULT NULL COMMENT 'Page Template',
  `content_update_template` varchar(255) DEFAULT NULL COMMENT 'Update content template',
  `meta_title` varchar(255) NOT NULL DEFAULT '',
  `meta_keywords` text COMMENT 'Page Meta Keywords',
  `meta_description` text COMMENT 'Page Meta Description',
  `identifier` varchar(100) NOT NULL DEFAULT '' COMMENT 'Page String Identifier',
  `is_active` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Is Page Active',
  `layout_update_xml` text COMMENT 'Page Layout Update Content',
  `is_new` tinyint(1) NOT NULL,
  `is_sale` tinyint(1) NOT NULL,
  `include_type` tinyint(1) NOT NULL,
  `include_sku` text,
  `category` mediumint(9) NOT NULL,
  `attr_code` varchar(255) NOT NULL,
  `attr_value` varchar(255) NOT NULL,
  `stock_less` int(11) NOT NULL,
  `stock_more` int(11) NOT NULL,
  `stock_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`page_id`),
  KEY `IDX_AM_LANDING_PAGE_IDENTIFIER` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Amasty Landing Page Table';


CREATE TABLE  `{$this->getTable('amlanding/page_store')}` (
  `page_id` smallint(6) NOT NULL COMMENT 'Page ID',
  `store_id` smallint(5) unsigned NOT NULL COMMENT 'Store ID',
  PRIMARY KEY (`page_id`,`store_id`),
  KEY `IDX_AM_LANDING_PAGE_STORE_STORE_ID` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$this->endSetup();
