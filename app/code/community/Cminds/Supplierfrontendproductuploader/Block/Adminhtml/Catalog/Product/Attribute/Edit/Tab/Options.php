<?php

class Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Catalog_Product_Attribute_Edit_Tab_Options extends Mage_Adminhtml_Block_Catalog_Product_Attribute_Edit_Tab_Options
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('supplierfrontendproductuploader/catalog/product/attribute/options.phtml');
    }
}