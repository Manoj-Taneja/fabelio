<?php
$installer = $this;
$installer->startSetup();

$db = Mage::getSingleton('core/resource')->getConnection('core_write');
$table_prefix = Mage::getConfig()->getTablePrefix();

$this->run("
    DROP TABLE IF EXISTS `".$this->getTable('supplierfrontendproductuploader/ordered_products')."`;
    CREATE TABLE          `".$this->getTable('supplierfrontendproductuploader/ordered_products')."` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `entity_id` INT(11) UNSIGNED NOT NULL,
        `order_id` INT(11) UNSIGNED NOT NULL,
        `supplier_id` INT(11) UNSIGNED NOT NULL,
        `qty` INT(11) NOT NULL,
        `price` FLOAT NOT NULL,
        `order_date` DATE NOT NULL,
        PRIMARY KEY (`id`),
        INDEX `entity_id` (`entity_id`),
        INDEX `order_id` (`order_id`),
        INDEX `supplier_id` (`supplier_id`)
    )
    ENGINE=InnoDB;
");
$installer->endSetup();
