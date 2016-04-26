<?php
$installer = $this;
$installer->startSetup();
$installer->updateAttribute('catalog_product','creator_id','frontend_input','select');
$installer->updateAttribute('catalog_product','creator_id','source_model','supplierfrontendproductuploader/source_suppliers');
$installer->updateAttribute('catalog_product','creator_id','frontend_label','Supplier');
$installer->updateAttribute('catalog_product','creator_id','is_visible',1);
$installer->endSetup();