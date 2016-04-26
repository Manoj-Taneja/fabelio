<?php

/**
 * Magento
 *
 * @author    WakaMage http://www.wakamage.com <cs@wakamage.com>
 * @copyright Copyright (C) 2013 WakaMage. (http://www.wakamage.com)
 *
 */

$installer = $this;
$installer->startSetup();
$installer->run("
 
ALTER TABLE `{$installer->getTable('sales/order_payment')}` ADD `migs_txn_status` VARCHAR( 255 ) NOT NULL ;
 
");
$installer->endSetup();