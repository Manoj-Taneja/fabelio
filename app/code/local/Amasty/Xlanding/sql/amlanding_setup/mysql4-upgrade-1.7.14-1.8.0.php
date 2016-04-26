<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
$this->startSetup();
$this->run("
    ALTER TABLE `{$this->getTable('amlanding/page')}`
    CHANGE COLUMN `category` `category`  VARCHAR(255) DEFAULT NULL;
");
$this->endSetup();
?>