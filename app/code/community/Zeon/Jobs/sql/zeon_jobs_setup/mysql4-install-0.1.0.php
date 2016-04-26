<?php

/**
 * zeonsolutions inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.zeonsolutions.com/shop/license-community.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * This package designed for Magento COMMUNITY edition
 * =================================================================
 * zeonsolutions does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * zeonsolutions does not provide extension support in case of
 * incorrect edition usage.
 * =================================================================
 *
 * @category   Zeon
 * @package    Zeon_Jobs
 * @version    0.0.1
 * @copyright  @copyright Copyright (c) 2013 zeonsolutions.Inc. (http://www.zeonsolutions.com)
 * @license    http://www.zeonsolutions.com/shop/license-community.txt
 */
$installer = $this;

$installer->startSetup();

$installer->run(
    "-- DROP TABLE IF EXISTS {$this->getTable('zeon_jobs/jobs')};
CREATE TABLE {$this->getTable('zeon_jobs/jobs')} (
    `job_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Job Id',
    `category_id` int(10) unsigned DEFAULT NULL COMMENT 'Category Id',
    `title` varchar(255) DEFAULT NULL COMMENT 'Title',
    `job_code` varchar(255) DEFAULT NULL COMMENT 'Job Code',
    `identifier` varchar(255) DEFAULT NULL COMMENT 'Identifier',
    `status` smallint(6) NOT NULL COMMENT 'Status',
    `short_description` text NOT NULL COMMENT 'Short Description',
    `description` text NOT NULL COMMENT 'Description',
    `meta_keywords` text COMMENT 'Meta Keywords',
    `meta_description` text COMMENT 'Meta Description',
    `sort_order` smallint(6) DEFAULT NULL COMMENT 'Sort Order',
    `creation_time` datetime DEFAULT NULL COMMENT 'Creation Time',
    `update_time` datetime DEFAULT NULL COMMENT 'Update Time',
    PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Zeon Jobs';



-- DROP TABLE IF EXISTS {$this->getTable('zeon_jobs/applications')};
CREATE TABLE {$this->getTable('zeon_jobs/applications')} (
    `application_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Applicantion Id',
    `job_code` varchar(255) DEFAULT NULL COMMENT 'Job Code',
    `resume_title` varchar(255) DEFAULT NULL COMMENT 'Resume Title',
    `firstname` varchar(255) DEFAULT NULL COMMENT 'First Name',
    `lastname` varchar(255) DEFAULT NULL COMMENT 'Last Name',
    `email` varchar(255) DEFAULT NULL COMMENT 'Email',
    `telephone` varchar(255) DEFAULT NULL COMMENT 'Telephone',
    `covering_letter` varchar(255) DEFAULT NULL COMMENT 'Covering Letter',
    `upload_resume` varchar(255) DEFAULT NULL COMMENT 'Upload Resume',
    `creation_time` datetime DEFAULT NULL COMMENT 'Creation Time',
    `update_time` datetime DEFAULT NULL COMMENT 'Update Time',
    PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Zeon Job applications';



-- DROP TABLE IF EXISTS {$this->getTable('zeon_jobs/category')};
CREATE TABLE {$this->getTable('zeon_jobs/category')} (
    `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Category Id',
    `title` varchar(255) DEFAULT NULL COMMENT 'Title',
    `identifier` varchar(255) DEFAULT NULL COMMENT 'Identifier',
    `status` smallint(6) NOT NULL COMMENT 'Status',
    `description` text NOT NULL COMMENT 'Description',
    `sort_order` smallint(6) DEFAULT NULL COMMENT 'Sort Order',
    `creation_time` datetime DEFAULT NULL COMMENT 'Creation Time',
    `update_time` datetime DEFAULT NULL COMMENT 'Update Time',
    PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Zeon Job Category';



-- DROP TABLE IF EXISTS {$this->getTable('zeon_jobs/store')};
CREATE TABLE {$this->getTable('zeon_jobs/store')} (
    `job_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Job Id',
    `store_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Store Id',
    PRIMARY KEY (`job_id`,`store_id`),
    KEY `IDX_ZEON_JOBS_STORE_JOB_ID` (`job_id`),
    KEY `IDX_ZEON_JOBS_STORE_STORE_ID` (`store_id`),
    CONSTRAINT `FK_ZEON_JOBS_STORE_JOB_ID_ZEON_JOBS_JOB_ID` FOREIGN KEY (`job_id`) 
    REFERENCES {$this->getTable('zeon_jobs/jobs')} (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `FK_ZEON_JOBS_STORE_STORE_ID_CORE_STORE_STORE_ID` FOREIGN KEY (`store_id`) 
    REFERENCES {$this->getTable('core_store')} (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Zeon Job Store';"
);

$installer->endSetup();