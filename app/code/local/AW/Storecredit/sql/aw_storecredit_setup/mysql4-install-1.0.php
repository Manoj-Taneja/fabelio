<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Storecredit
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */

$installer = $this;
$installer->startSetup();

$installer->run("
    CREATE TABLE IF NOT EXISTS {$this->getTable('aw_storecredit/storecredit')} (
      `entity_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
      `customer_id` INT UNSIGNED NOT NULL,
      `status` SMALLINT(6) NOT NULL DEFAULT '0',
      `created_at` DATE NOT NULL,
      `total_balance` DECIMAL(12,4) UNSIGNED NOT NULL DEFAULT '0.0000',
      `balance` DECIMAL(12,4) UNSIGNED NOT NULL DEFAULT '0.0000',
      `subscribe_state` SMALLINT(6) NOT NULL DEFAULT '0',
      PRIMARY KEY (`entity_id`),
      INDEX `IDX_AW_STORECREDIT_ENTITY_ID` (`entity_id` ASC))
    ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

    CREATE TABLE IF NOT EXISTS {$this->getTable('aw_storecredit/history')} (
      `history_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
      `storecredit_id` INT UNSIGNED NOT NULL,
      `updated_at` TIMESTAMP NULL,
      `action` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
      `balance_amount` DECIMAL(12,4) UNSIGNED NOT NULL DEFAULT '0.0000',
      `balance_delta` DECIMAL(12,4) NOT NULL DEFAULT '0.0000',
      `additional_info` TEXT NULL,
      PRIMARY KEY (`history_id`, `storecredit_id`),
      INDEX `fk_aw_storecredit_history_aw_storecredit_idx` (`storecredit_id` ASC),
      CONSTRAINT `fk_aw_storecredit_history_aw_storecredit`
        FOREIGN KEY (`storecredit_id`)
        REFERENCES {$this->getTable('aw_storecredit/storecredit')} (`entity_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE IF NOT EXISTS {$this->getTable('aw_storecredit/quote_storecredit')} (
      `link_id` INT UNSIGNED NOT NULL  AUTO_INCREMENT,
      `storecredit_id` INT UNSIGNED NOT NULL,
      `quote_entity_id` INT(10) UNSIGNED NOT NULL,
      `base_storecredit_amount` DECIMAL(12,4) UNSIGNED NULL,
      `storecredit_amount` DECIMAL(12,4) UNSIGNED NULL,
      PRIMARY KEY (`link_id`),
      INDEX `fk_aw_quote_totals_aw_storecredit1_idx` (`storecredit_id` ASC),
      CONSTRAINT `fk_aw_qoute_totals_aw_storecredit1`
        FOREIGN KEY (`storecredit_id`)
        REFERENCES {$this->getTable('aw_storecredit/storecredit')} (`entity_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE IF NOT EXISTS {$this->getTable('aw_storecredit/order_invoice_storecredit')} (
      `link_id` INT UNSIGNED NOT NULL  AUTO_INCREMENT,
      `storecredit_id` INT UNSIGNED NOT NULL,
      `invoice_entity_id` INT(10) UNSIGNED NOT NULL,
      `base_storecredit_amount` DECIMAL(12,4) UNSIGNED NULL,
      `storecredit_amount` DECIMAL(12,4) UNSIGNED NULL,
      PRIMARY KEY (`link_id`),
      INDEX `fk_aw_invoice_totals_aw_storecredit1_idx` (`storecredit_id` ASC),
      CONSTRAINT `fk_aw_invoice_totals_aw_storecredit1`
        FOREIGN KEY (`storecredit_id`)
        REFERENCES {$this->getTable('aw_storecredit/storecredit')} (`entity_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE IF NOT EXISTS {$this->getTable('aw_storecredit/order_creditmemo_storecredit')} (
      `link_id` INT(10) UNSIGNED NOT NULL  AUTO_INCREMENT,
      `storecredit_id` INT(10) UNSIGNED NOT NULL,
      `creditmemo_entity_id` INT(10) UNSIGNED NOT NULL,
      `base_storecredit_amount` DECIMAL(12,4) UNSIGNED NULL,
      `storecredit_amount` DECIMAL(12,4) UNSIGNED NULL,
      PRIMARY KEY (`link_id`),
      INDEX `fk_aw_creditmemo_totals_aw_storecredit1_idx` (`storecredit_id` ASC),
      CONSTRAINT `fk_aw_creditmemo_totals_aw_storecredit1`
        FOREIGN KEY (`storecredit_id`)
        REFERENCES {$this->getTable('aw_storecredit/storecredit')} (`entity_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE IF NOT EXISTS {$this->getTable('aw_storecredit/order_refunded_storecredit')} (
      `link_id` INT(10) UNSIGNED NOT NULL  AUTO_INCREMENT,
      `storecredit_id` INT(10) UNSIGNED NOT NULL,
      `order_entity_id` INT(10) UNSIGNED NOT NULL,
      `base_refunded_amount` DECIMAL(12,4) UNSIGNED NULL,
      `refunded_amount` DECIMAL(12,4) UNSIGNED NULL,
      PRIMARY KEY (`link_id`),
      INDEX `fk_aw_order_refunded_totals_aw_storecredit1_idx` (`storecredit_id` ASC),
      CONSTRAINT `fk_aw_order_refunded_totals_aw_storecredit1`
        FOREIGN KEY (`storecredit_id`)
        REFERENCES {$this->getTable('aw_storecredit/storecredit')} (`entity_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE IF NOT EXISTS {$this->getTable('aw_storecredit/history_additional')} (
      `link_id` INT(10) UNSIGNED NOT NULL  AUTO_INCREMENT,
      `history_id` INT(10) UNSIGNED NOT NULL,
      `locale_code` VARCHAR(255) NOT NULL,
      `value` TEXT NULL,
      PRIMARY KEY (`link_id`),
      INDEX `fk_aw_history_additional_info_aw_storecredit1_idx` (`history_id` ASC),
      CONSTRAINT `fk_aw_history_additional_info_aw_storecredit1`
        FOREIGN KEY (`history_id`)
        REFERENCES {$this->getTable('aw_storecredit/history')} (`history_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB DEFAULT CHARSET=utf8;
");
$installer->endSetup();