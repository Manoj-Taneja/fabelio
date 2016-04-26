<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
 
-- DROP TABLE IF EXISTS {$this->getTable('apptrian_imageoptimizer/file')};
CREATE TABLE {$this->getTable('apptrian_imageoptimizer/file')} (
  `id` varchar(32) NOT NULL default '',
  `file_path` varchar(255) NOT NULL default '',
  `optimized` tinyint(1) NOT NULL default '0',
  `optimization_time` int(11) unsigned NOT NULL default '0',
  `old_file_size` int(11) unsigned NOT NULL default '0',
  `new_file_size` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
");
 
$installer->endSetup();
