<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
$this->startSetup();
$this->run("
    ALTER TABLE `{$this->getTable('amlanding/page')}`
        ADD COLUMN default_sort_by VARCHAR(255),
        ADD COLUMN advanced_filter_condition boolean not null default 1;
");
$this->endSetup();
?>