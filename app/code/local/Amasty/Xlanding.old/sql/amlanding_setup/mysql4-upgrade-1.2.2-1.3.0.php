<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
$this->startSetup();
$this->run("
    ALTER TABLE `{$this->getTable('amlanding/page')}`
        ADD COLUMN layout_heading VARCHAR(255) AFTER stock_status,
        ADD COLUMN layout_file VARCHAR(255) AFTER layout_heading,
        ADD COLUMN layout_file_name VARCHAR(255) AFTER layout_file,
        ADD COLUMN layout_file_alt VARCHAR(255) AFTER layout_file_name,
        ADD COLUMN layout_description TEXT AFTER layout_file_alt;
");
$this->endSetup();
?>