<?php
class Cminds_Marketplace_Block_Catalog_Product_View extends Mage_Catalog_Block_Product_View
{
    private $_supplierId;
    public function getProductSupplierName() {
        $supplier_id = $this->getSupplierId();

        if(!$supplier_id) return false;

        $customer = Mage::getModel('customer/customer')->load($supplier_id);

        if(!$customer->getId()) return false;

        if($customer->getSupplierName()) {
            return $customer->getSupplierName();
        } else {
            return sprintf("%s %s", $customer->getFirstname(), $customer->getLastname());
        }
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
        $canShow = Mage::getStoreConfig("marketplace_configuration/presentation/sold_by");
        $customerGroupConfig = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/supplier_group_id');
        $editorGroupConfig = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/editor_group_id');
        $allowedGroups = array();

        if($canShow) {
            $supplier_id = $this->getSupplierId();

            if(!$supplier_id) return false;

            $customer = Mage::getModel('customer/customer')->load($supplier_id);

            if($customerGroupConfig != NULL) $allowedGroups[] = $customerGroupConfig;
            if($editorGroupConfig != NULL) $allowedGroups[] = $editorGroupConfig;
            if(!$customer->getId()) return false;
            if(!$customer->getSupplierProfileVisible()) return false;
            if(!$customer->getSupplierProfileApproved()) return false;
        }

        return $canShow;
    }
}
