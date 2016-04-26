<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
$this->startSetup();
$this->run("
    ALTER TABLE `{$this->getTable('amlanding/page')}`
    ADD COLUMN `layout_footer` TEXT;
");
$this->endSetup();
?>