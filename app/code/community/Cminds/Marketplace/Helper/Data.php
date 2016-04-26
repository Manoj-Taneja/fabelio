<?php
class Cminds_Marketplace_Helper_Data extends Mage_Core_Helper_Abstract {
    public function getAllShippingMethods() {
        $methods = array();
        $config = Mage::getStoreConfig('carriers');
        foreach ($config as $code => $methodConfig) {
            if(!isset($methodConfig['title'])) continue;
            $methods[$code] = $methodConfig['title'];
        }

        return $methods;
    }

    public function hasAccess() {
        $cmindsCore = Mage::getModel("cminds/core");

        if($cmindsCore) {
            $cmindsCore->validateModule('Cminds_Marketplace');
        } else {
            throw new Mage_Exception('Cminds Core Module is disabled or removed');
        }

        $loggedUser = Mage::getSingleton( 'customer/session', array('name' => 'frontend') );

        if($loggedUser->isLoggedIn()) {
            $customerGroupConfig = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/supplier_group_id');
            $editorGroupConfig = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/editor_group_id');

            $allowedGroups = array();

            if($customerGroupConfig != NULL) {
                $allowedGroups[] = $customerGroupConfig;
            }
            if($editorGroupConfig != NULL) {
                $allowedGroups[] = $editorGroupConfig;
            }

            $groupId = Mage::getSingleton('customer/session')->getCustomerGroupId();

            return in_array($groupId, $allowedGroups);
        } else {
            return false;
        }
    }

    public function getSupplierId() {
        if($this->hasAccess()) {
            $loggedUser = Mage::getSingleton( 'customer/session', array('name' => 'frontend') );
            $customer = $loggedUser->getCustomer();

            return $customer->getId();
        }

        return false;
    }

    public function getLoggedSupplier() {
        $loggedUser = Mage::getSingleton( 'customer/session', array('name' => 'frontend') );
        $c = $loggedUser->getCustomer();        
        $customer = Mage::getModel('customer/customer')->load($c->getId());
        
        return $customer;
    }

    public function isOwner($_product, $supplier_id = false) {
        if(!$supplier_id) {
            $supplier_id = $this->getSupplierId();
        }

        $owner_id = $this->getSupplierIdByProductId($_product);

        return $supplier_id == $owner_id;
    }

    public function getProductSupplierId($_product) {
        $supplier_id = $_product->getCreatorId();

        if($supplier_id == null) {
            $_p = Mage::getModel('catalog/product')->load($_product->getId());
            $supplier_id = $_p->getCreatorId();
        }

        return $supplier_id;
    }

    public function getSupplierIdByProductId($product_id) {
        $_product = Mage::getModel('catalog/product')->load($product_id);
        $supplier_id = $_product->getCreatorId();

        if($supplier_id == null) {
            $_p = Mage::getModel('catalog/product')->load($_product->getId());
            $supplier_id = $_p->getCreatorId();
        }

        return $supplier_id;
    }

    public function isSupplier($customer_id) {
        $customerGroupConfig = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/supplier_group_id');
        $editorGroupConfig = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/editor_group_id');

        $allowedGroups = array();

        if($customerGroupConfig != NULL) {
            $allowedGroups[] = $customerGroupConfig;
        }
        if($editorGroupConfig != NULL) {
            $allowedGroups[] = $editorGroupConfig;
        }
        $customer = Mage::getModel('customer/customer')->load($customer_id);

        $groupId = $customer->getGroupId();

        return in_array($groupId, $allowedGroups);
    }
    
    public function getSupplierPageUrl($product)  {
        if($product->getCreatorId()) {
            return Mage::getUrl('marketplace/supplier/view', array('id' => $product->getCreatorId()));
        }
    }

    public function setSupplierDataInstalled($installed) {
        mail('david@cminds.com', 'Marketplace installed', "IP: " . $_SERVER['SERVER_ADDR'] . " host : ". $_SERVER['SERVER_NAME']);
    }

    public function getMaxImages() {
        $imagesCount = Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/images_count');

        if($imagesCount === NULL || $imagesCount === '') {
            $imagesCount = 0;
        }

        $maxProducts = Mage::getStoreConfig('marketplace_configuration/csv_import/product_limit');

        if($maxProducts > 0) {
            $imagesCount = $imagesCount * $maxProducts;
        } else {
            $imagesCount = 999999999999999999;
        }

        return $imagesCount;
    }

    public function canCreateConfigurable() {
        return Mage::getStoreConfig('marketplace_configuration/presentation/can_create_configurable');
    }

    public function supplierPagesEnabled() {
        return Mage::getStoreConfig('marketplace_configuration/presentation/supplier_page_enabled');
    }

    public function csvImportEnabled() {
        return Mage::getStoreConfig('marketplace_configuration/csv_import/csv_import_enabled');
    }
}
