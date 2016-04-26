<?php
abstract class Cminds_Marketplace_Block_Catalog_Product_Supplier extends Mage_Core_Block_Template
{
    private $_supplierId;

    public function getProduct() {
        return Mage::registry('product');
    }

    public function getSupplierId() {
        if(!$this->_supplierId) {
            $this->_supplierId = $this->helper('marketplace')->getProductSupplierId($this->getProduct());
        }

        return $this->_supplierId;
    }

    public function isCreatedBySupplier() {
        return $this->getSupplierId();
    }

    public function canShowSoldBy() {
        return Mage::getStoreConfig("marketplace_configuration/presentation/sold_by");
    }
}