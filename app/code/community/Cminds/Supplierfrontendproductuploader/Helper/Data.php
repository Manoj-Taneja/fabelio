<?php
class Cminds_Supplierfrontendproductuploader_Helper_Data extends Mage_Core_Helper_Abstract {

    public function validateModule() {
        if(!$this->isEnabled()) {
            Mage::app()->getResponse()->setHeader('HTTP/1.1','404 Not Found');
            Mage::app()->getResponse()->setHeader('Status','404 File not found');

            Mage::app()->getResponse()->setRedirect('defaultNoRoute');

            $pageId = Mage::getStoreConfig(Mage_Cms_Helper_Page::XML_PATH_NO_ROUTE_PAGE);
            if (!Mage::helper('cms/page')->renderPage($this, $pageId)) {
                Mage::app()->getResponse()->_forward('defaultNoRoute');
            }
            exit;
        }
    }
    
    public function isEnabled() {
        return Mage::getStoreConfig('supplierfrontendproductuploader_catalog/general/module_enabled') == 1;
    }

    public function getSupplierLoginPage() {
        $useSeparated = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/login/use_separated_login') == 1;

        if($useSeparated) {
            return Mage::getUrl('supplierfrontendproductuploader/login/index');
        } else {
            return Mage::helper('customer')->getLoginUrl();
        }
    }

    public function canRegister() {
        return Mage::getStoreConfig('supplierfrontendproductuploader_catalog/login/register_enable') == 1;
    }
    
    public function noAccessInformation() {
        $loggedUser = Mage::getSingleton( 'customer/session', array('name' => 'frontend') );

        if($loggedUser->isLoggedIn()) {
            return !$this->hasAccess();
        }
    }

    public function hasAccess() {
        $cmindsCore = Mage::getModel("cminds/core");

        if($cmindsCore) {
            $validate = $cmindsCore->validateModule('Cminds_Supplierfrontendproductuploader');

            if(!$validate) {
                return false;
            }
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

    public function canEditProducts() {
        $groupId = Mage::getSingleton('customer/session')->getCustomerGroupId();

        $editorGroupConfig = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/editor_group_id');
        $allowedGroups = array();

        if($editorGroupConfig != NULL) {
            $allowedGroups[] = $editorGroupConfig;
        }

        return in_array($groupId, $allowedGroups);
    }

    public function getSupplierId() {
        if($this->hasAccess()) {
            $loggedUser = Mage::getSingleton( 'customer/session', array('name' => 'frontend') );
            $customer = $loggedUser->getCustomer();

            return $customer->getId();
        }

        return false;
    }

    public function generateSku() {
        $sku = (int) Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/sku_schema');
        
        while(true) {
            $product = Mage::getModel('catalog/product')->loadByAttribute('sku', $sku);
            
            if(!$product) {
              break;  
            }
            
            $sku++;
        }
        
        $coreConfig = new Mage_Core_Model_Config();
        $coreConfig->saveConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/sku_schema', $sku);
        return $sku;
    }

    public function getImageCacheDir($postData) {
        $path = Mage::getBaseDir('upload');
        return $path;
    }

    public function isMarketplaceEnabled() {
        return Mage::getConfig()->getModuleConfig('Cminds_Marketplace')->is('active', 'true');
    }

}
