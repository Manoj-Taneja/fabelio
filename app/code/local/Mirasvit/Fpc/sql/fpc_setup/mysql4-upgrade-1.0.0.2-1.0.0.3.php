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
$installer->run("
    ALTER TABLE `{$this->getTable('fpc/crawler_url')}` ADD `sort_by_page_type` VARCHAR(255) NOT NULL AFTER `rate` ;
    ALTER TABLE `{$this->getTable('fpc/crawler_url')}` ADD `sort_by_product_attribute` INT(11) NOT NULL DEFAULT 1000 AFTER `sort_by_page_type` ;
");
$installer->endSetup();
