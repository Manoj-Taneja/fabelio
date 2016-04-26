<?php
$installer = $this;
$installer->startSetup();

$db = Mage::getSingleton('core/resource')->getConnection('core_write');
$table_prefix = Mage::getConfig()->getTablePrefix();
$this->run("
    DROP TABLE IF EXISTS `" . $installer->getTable('supplierfrontendproductuploader/supplierfrontendproductuploader_attribute_label') . "`;
    CREATE TABLE          `" . $installer->getTable('supplierfrontendproductuploader/supplierfrontendproductuploader_attribute_label') . "` (
    	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`attribute_id` int(10) unsigned NOT NULL,
		`attribute_code` varchar(255) NOT NULL DEFAULT '',
		`label` varchar(255) NOT NULL DEFAULT '',
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$installer->endSetup();