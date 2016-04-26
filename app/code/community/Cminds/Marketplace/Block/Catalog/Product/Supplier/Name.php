<?php
class Cminds_Marketplace_Block_Catalog_Product_Supplier_Name extends Cminds_Marketplace_Block_Catalog_Product_Supplier
{
    private $_supplierId;
    public function _construct() {
        $this->setTemplate('marketplace/catalog/product/supplier/name.phtml');
    }

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
}