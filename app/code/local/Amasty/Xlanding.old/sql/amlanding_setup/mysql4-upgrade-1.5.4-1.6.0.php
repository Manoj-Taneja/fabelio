<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
$this->startSetup();
$this->run("
    ALTER TABLE `{$this->getTable('amlanding/page')}`
    ADD COLUMN `is_sale_by_rule` TINYINT(1) NOT NULL after is_sale;
");
$this->endSetup();
?>