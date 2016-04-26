<?php
$installer = $this;
$installer->startSetup();

$installer->updateAttribute('catalog_product','frontendproduct_product_status','frontend_label','Status Set by Supplier');
$installer->updateAttribute('catalog_product','frontendproduct_product_status','is_visible', 1);
$installer->updateAttribute('catalog_product','frontendproduct_product_status','default', Cminds_Supplierfrontendproductuploader_Model_Source_Approved::STATUS_APPROVED);

$installer->endSetup();