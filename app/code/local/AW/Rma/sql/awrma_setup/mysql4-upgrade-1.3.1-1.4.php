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
 * @package    AW_Rma
 * @version    1.5.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


$installer = $this;
$installer->startSetup();

$installer->run("
    CREATE TABLE IF NOT EXISTS `{$this->getTable('awrma/entity_reason')}` (
        `id` INT( 10 ) NOT NULL AUTO_INCREMENT,
        `name` TINYTEXT NOT NULL,
        `store` TINYTEXT NOT NULL,
        `sort` SMALLINT NOT NULL,
        `enabled` TINYINT( 1 ) NOT NULL DEFAULT '1',
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB COMMENT = 'Table contain possible reasons of RMA requests' DEFAULT CHARSET=utf8;

    ALTER TABLE {$this->getTable('awrma/entity')} ADD `reason_id` INT(10);
    ALTER TABLE {$this->getTable('awrma/entity')} ADD `reason_details` TEXT  AFTER `reason_id`;
    ALTER TABLE {$this->getTable('awrma/entity')} ADD `rma_id` varchar(255) AFTER `id` ;

    UPDATE {$this->getTable('awrma/entity')} SET `rma_id` = LPAD(LPAD(`id`, 10, '0'), 11, '#');
");

$installer->endSetup();