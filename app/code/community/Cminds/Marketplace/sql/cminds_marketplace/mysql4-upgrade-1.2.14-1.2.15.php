<?php
$installer = $this;
$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('sales/order_item'), 'vendor_fee', "DECIMAL(12,4)");

$collection = Mage::getModel('sales/order_item')->getCollection();

foreach($collection AS $item) {
	$product = Mage::getModel('catalog/product')->load($item->getProductId());

	if($product->getData('creator_id') != NULL && $product->getData('creator_id') != 0) {
        $i = Mage::getModel('sales/order_item')->load($item->getId());

        if($i) {
            $fee = Mage::helper('marketplace/profits')->getStoreProfit($product->getData('creator_id'));

            if($fee) {
                $i->setVendorFee($fee);
                $i->save();
            } else {
                $configTable = $installer->getTable('core/config_data');
                $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
                $s = $connection->fetchAll("SELECT value FROM $configTable WHERE path = 'marketplace_configuration/general/default_percentage_fee'");

                if($s[0]) {
                    $i->setVendorFee($s[0]['value']);
                    $i->save();
                }
            }
        }
    }
}

$installer->endSetup();