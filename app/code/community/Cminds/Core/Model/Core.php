<?php
class Cminds_Core_Model_Core extends Mage_Core_Model_Config_Data {
    const PLUGIN_NAME = 'activate_license';
    const ACTIVATE_ACTION = 'activate_license';
    const CHECK_ACTION = 'check_license';
    const GET_VERSION_ACTION = 'get_version';
    const DEACTIVATE_ACTION = 'deactivate_license';
    const NO_ACTIVATIONS_STATUS = 'no_activations_left';
    const MAX_ACTIVATION_COUNT = 1;
    const LOG_FILE_NAME = 'cminds_license.log';

    private static $apiEndpointUrl = 'https://www.cminds.com/';
    private static $isSandBox = false;
    
    private $url = null;

    private static $items = array(
        'cminds_marketplace' => array(
            'name'              => 'Marketplace Multi-Vendor Manager Extension for Magento',
            'extension_name'    => 'Cminds_Marketplace',
            'key_path'          => 'cmindsConf/cminds_marketplace/license_key',
            'approved_path'     => 'cmindsConf/cminds_marketplace/is_approved',
            'config_path'       => 'cminds_marketplace/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/magento-cm-marketplace',
        ),
        'cminds_supplierfrontendproductuploader' => array(
            'name'              => 'Supplier Frontend Product Uploader for Magento',
            'extension_name'    => 'Cminds_Supplierfrontendproductuploader',
            'key_path'          => 'cmindsConf/cminds_supplierfrontendproductuploader/license_key',
            'approved_path'     => 'cmindsConf/cminds_supplierfrontendproductuploader/is_approved',
            'config_path'       => 'cminds_supplierfrontendproductuploader/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/magento-supplier-frontend-product-upload/',
            'related_to'        => 'cminds_marketplace'
        ),
        'cminds_multiuseraccounts' => array(
            'name'              => 'Magento Multi-User Account',
            'extension_name'    => 'Cminds_MultiUserAccounts',
            'key_path'          => 'cmindsConf/cminds_multiuseraccounts/license_key',
            'approved_path'     => 'cmindsConf/cminds_multiuseraccounts/is_approved',
            'config_path'       => 'cminds_multiuseraccounts/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/magento-multi-user-account-extension/'
        ),
        'cminds_productreviewcoupon' => array(
            'name'              => 'Product Review Incentives Extension for Magento',
            'extension_name'    => 'Cminds_Productreviewcoupon',
            'key_path'          => 'cmindsConf/cminds_productreviewcoupon/license_key',
            'approved_path'     => 'cmindsConf/cminds_productreviewcoupon/is_approved',
            'config_path'       => 'cminds_productreviewcoupon/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/magento-multi-user-account-extension/'
        ),
        'cminds_coupon' => array(
            'name'              => 'Custom Coupons Error Message Extension for Magento',
            'extension_name'    => 'Cminds_Coupon',
            'key_path'          => 'cmindsConf/cminds_coupon/license_key',
            'approved_path'     => 'cmindsConf/cminds_coupon/is_approved',
            'config_path'       => 'cminds_coupon/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/magento-custom-coupons-error-messages/'
        ),
        'cminds_freegift' => array(
            'name'              => 'Product Free Gift and Discount for Magento',
            'extension_name'    => 'Cminds_Freegift',
            'key_path'          => 'cmindsConf/cminds_freegift/license_key',
            'approved_path'     => 'cmindsConf/cminds_freegift/is_approved',
            'config_path'       => 'cminds_freegift/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/free-gift-discount-extension-magento/'
        ),
        'cminds_salesrecovery' => array(
            'name'              => 'Magento Cart Recovery Extension',
            'extension_name'    => 'Cminds_Salesrecovery',
            'key_path'          => 'cmindsConf/cminds_salesrecovery/license_key',
            'approved_path'     => 'cmindsConf/cminds_salesrecovery/is_approved',
            'config_path'       => 'cminds_salesrecovery/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/sales-recovery-extension-for-magento/'
        ),
        'cminds_newsletter' => array(
            'name'              => 'Magento extension for newsletter registration',
            'extension_name'    => 'Cminds_Newsletter',
            'key_path'          => 'cmindsConf/cminds_newsletter/license_key',
            'approved_path'     => 'cmindsConf/cminds_newsletter/is_approved',
            'config_path'       => 'cminds_newsletter/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/magento-advanced-newsletter-registration/'
        ),
        'cminds_findify' => array(
            'name'              => 'Magento Findify Best Search Extension',
            'extension_name'    => 'Cminds_Findify',
            'key_path'          => 'cmindsConf/cminds_findify/license_key',
            'approved_path'     => 'cmindsConf/cminds_findify/is_approved',
            'config_path'       => 'cminds_findify/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/magento-findify-best-search-extension/'
        ),
        'lucidpath_salesrep_deluxe' => array(
            'name'              => 'Sales Rep Commission Manager for Magento',
            'extension_name'    => 'LucidPath_SalesRepDeluxe',
            'key_path'          => 'cmindsConf/lucidpath_salesrep_deluxe/license_key',
            'approved_path'     => 'cmindsConf/lucidpath_salesrep_deluxe/is_approved',
            'config_path'       => 'lucidpath_salesrep_deluxe/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/sales-rep-commission-manager-extension-for-magento/'
        ),
        'lucidpath_salesrep_pro' => array(
            'name'              => 'Sales Rep Commission Manager for Magento',
            'extension_name'    => 'LucidPath_SalesRepPro',
            'key_path'          => 'cmindsConf/lucidpath_salesrep_pro/license_key',
            'approved_path'     => 'cmindsConf/lucidpath_salesrep_pro/is_approved',
            'config_path'       => 'lucidpath_salesrep_pro/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/sales-rep-commission-manager-extension-for-magento/'
        ),
        'lucidpath_salesrep_basic' => array(
            'name'              => 'Sales Rep Commission Manager for Magento',
            'extension_name'    => 'LucidPath_SalesRepBasic',
            'key_path'          => 'cmindsConf/lucidpath_salesrep_basic/license_key',
            'approved_path'     => 'cmindsConf/lucidpath_salesrep_basic/is_approved',
            'config_path'       => 'lucidpath_salesrep_basic/extension/',
            'extension_page'    => 'https://ecommerce.cminds.com/sales-rep-commission-manager-extension-for-magento/'
        ),
        'lucidpath_extstatus' => array(
            'name'              => 'Extended Order Status for Magento',
            'extension_name'    => 'LucidPath_ExtStatus',
            'key_path'          => 'cmindsConf/lucidpath_extstatus/license_key',
            'approved_path'     => 'cmindsConf/lucidpath_extstatus/is_approved',
            'config_path'       => 'lucidpath_extstatus/extension/',
            'extension_page'    => 'https://www.cminds.com/ecommerce-extensions-store/extended-order-status-extension-for-magento/'
        ),
    );

    public static $confExtensions = array(
        'cmindsConf_cminds_marketplace' => array('extension_name' => 'Cminds_Marketplace'),
        'cmindsConf_cminds_supplierfrontendproductuploader' => array('extension_name' => 'Cminds_Supplierfrontendproductuploader', 'related_to' => 'Cminds_Marketplace'),
        'cmindsConf_cminds_productreviewcoupon' => array('extension_name' => 'Cminds_Productreviewcoupon'),
        'cmindsConf_cminds_multiuseraccounts' => array('extension_name' => 'Cminds_MultiUserAccounts'),
        'cmindsConf_cminds_coupon' => array('extension_name' => 'Cminds_Coupon'),
        'cmindsConf_cminds_freegift' => array('extension_name' => 'Cminds_Freegift'),
        'cmindsConf_cminds_salesrecovery' => array('extension_name' => 'Cminds_Salesrecovery'),
        'cmindsConf_cminds_newsletter' => array('extension_name' => 'Cminds_Newsletter'),
        'cmindsConf_cminds_findify' => array('extension_name' => 'Cminds_Findify'),

        'cmindsConf_lucidpath_salesrep_deluxe' => array('extension_name' => 'LucidPath_SalesRepDeluxe'),
        'cmindsConf_lucidpath_salesrep_pro' => array('extension_name' => 'LucidPath_SalesRepPro'),
        'cmindsConf_lucidpath_salesrep_basic' => array('extension_name' => 'LucidPath_SalesRepBasic'),
        'cmindsConf_lucidpath_extstatus' => array('extension_name' => 'LucidPath_ExtStatus'),
    );

    private $baseParams = null;
    private $optionIsApproved = null;
    private $optionLicenseKey = null;
    private $optionLicenseActivateKey = null;
    private $optionLicenseDeactivateKey = null;
    private $optionLicenseStatus = null;
    private $optionCountLicenseActivations = null;
    private $optionCountLicenseMaxActivations = null;
    
    private $license = null;
    private $licenseStatus = null;
    private $countLicenseActivations = null;
    private $countLicenseMaxActivations = null;
    

    private $optionUpdateLastCheck = null;

    public function before($license, $groupId)
    {
        $this->url = Mage::app()->getStore(Mage::app()
            ->getWebsite()
            ->getDefaultGroup()
            ->getDefaultStoreId())->getBaseUrl();

        $this->optionLicenseStatus = self::$items[$groupId]['config_path'] .'license';
        $this->optionCountLicenseActivations = self::$items[$groupId]['config_path'] .'active';
        $this->optionCountLicenseMaxActivations = self::$items[$groupId]['config_path'] .'limit';
        $this->optionUpdateLastCheck = self::$items[$groupId]['config_path'] .'last_check';
        $this->optionUpdateInfoArr = self::$items[$groupId]['config_path'] .'info';
        $this->optionIsApproved = self::$items[$groupId]['approved_path'];
        $this->optionKey = self::$items[$groupId]['key_path'];
        $this->itemName = self::$items[$groupId]['name'];
        $this->moduleName = self::$items[$groupId]['extension_name'];

        if($license !== false) {
            $this->license = trim($license);
        } else {
            $this->license = Mage::getStoreConfig($this->optionKey);            
        }

        $this->licenseStatus = Mage::getStoreConfig($this->optionLicenseStatus);
        $this->countLicenseActivations = Mage::getStoreConfig($this->optionCountLicenseActivations);
        $this->countLicenseMaxActivations = Mage::getStoreConfig($this->optionCountLicenseMaxActivations);

        $this->baseParams = array(
            'item_name' => self::$items[$groupId]['name'],
            'url'       => $this->url,
            'license'   => $this->license,
        );
    }

    private static function getValidActions()
    {
        $validActions = array(self::ACTIVATE_ACTION, self::DEACTIVATE_ACTION, self::GET_VERSION_ACTION, self::CHECK_ACTION);
        return $validActions;
    }

    private function apiCall($action = '')
    {
        $apiCallResults = array();
        
        if( in_array($action, self::getValidActions()) )
        {
            $params = array_merge(array('edd_action' => $action), $this->baseParams);
        }
        else
        {
            $apiCallResults[] = false;
        }
        
        $url = self::$apiEndpointUrl . '?' .http_build_query($params);
        
        $iClient = new Varien_Http_Client();
        $iClient->setUri($url)
            ->setMethod('GET')
            ->setConfig(array('timeout' => 15, 'sslverify' => false));
        $response = $iClient->request();
        $license_data = json_decode($response->getBody());
        $this->log($license_data);
        
        if( $license_data !== FALSE )
        {
            if( is_object($license_data) )
            {
                return $license_data;
            }
        }

        return FALSE;
    }

    public function activateLicense()
    {
        $result = $this->apiCall(self::ACTIVATE_ACTION);

        if( $result === false ) {
            Mage::getSingleton('core/session')->addError(Mage::helper('cminds')->__('Activation request failed'));
        } else {
            if( isset($result->error) ) {
                if($result->error == self::NO_ACTIVATIONS_STATUS) {
                    $newLicenseStatus = self::NO_ACTIVATIONS_STATUS;
                    Mage::getModel('adminnotification/inbox')->add(4, Mage::helper('cminds')->__('%s %s was activation failed !', $this->itemName, (string) Mage::getConfig()->getModuleConfig($this->moduleName)->version), Mage::helper('cminds')->__('You have exceeded the number of the approved licenses for the %s. The extension will not work until the license issue is resolved.', $this->itemName));
                } else if($result->license == 'invalid') {
                    Mage::getModel('adminnotification/inbox')->add(4, Mage::helper('cminds')->__('%s %s was activation failed !', $this->itemName, (string) Mage::getConfig()->getModuleConfig($this->moduleName)->version), Mage::helper('cminds')->__('%s %s license key is not correct. Please enter a valid license key.', $this->itemName, (string) Mage::getConfig()->getModuleConfig($this->moduleName)->version));
                    $newLicenseStatus = $result->license;
                } else {
                    $newLicenseStatus = $result->license;
                    if($newLicenseStatus == 'active') {
                        Mage::getModel('core/config')->saveConfig($this->optionIsApproved, 1);
                    }
                }
            } else {
                if($result->license == 'invalid') {
                    Mage::getModel('adminnotification/inbox')->add(4, Mage::helper('cminds')->__('%s %s was activation failed !', $this->itemName, (string) Mage::getConfig()->getModuleConfig($this->moduleName)->version), Mage::helper('cminds')->__('%s %s license key is not correct. Please enter a valid license key.', $this->itemName, (string) Mage::getConfig()->getModuleConfig($this->moduleName)->version));
                } else {
                    Mage::getModel('adminnotification/inbox')->add(4, Mage::helper('cminds')->__('%s %s was activated successfully !', $this->itemName, (string) Mage::getConfig()->getModuleConfig($this->moduleName)->version), Mage::helper('cminds')->__('%s %s is available now. Please check system configuration to finish configuration', $this->itemName, (string) Mage::getConfig()->getModuleConfig($this->moduleName)->version));
                }

                $newLicenseStatus = $result->license;
            }

            Mage::getModel('core/config')->saveConfig($this->optionLicenseStatus, $newLicenseStatus);
            Mage::getModel('core/config')->saveConfig($this->optionCountLicenseActivations, $result->site_count);
            Mage::getModel('core/config')->saveConfig($this->optionCountLicenseMaxActivations, (int) $result->license_limit);
            
            
        }
    }

    public function deactivateLicense()
    {
        $result = $this->apiCall(self::DEACTIVATE_ACTION);

        if( $result === false ) {
            Mage::getSingleton('core/session')->addError(Mage::helper('cminds')->__('Activation request failed'));
        } else {

            if( isset($result->error) ) {
                if($result->error == self::NO_ACTIVATIONS_STATUS) {
                    $newLicenseStatus = self::NO_ACTIVATIONS_STATUS;
                } else {
                    $newLicenseStatus = $result->license;
                }
            } else {
                Mage::getModel('adminnotification/inbox')->add(4, Mage::helper('cminds')->__('%s %s was deactivated successfully !', $this->itemName, (string) Mage::getConfig()->getModuleConfig($this->moduleName)->version), Mage::helper('cminds')->__('THe extension is deactivated now.', $this->itemName, (string) Mage::getConfig()->getModuleConfig($this->moduleName)->version));

                $newLicenseStatus = $result->license;
            }
        }

        Mage::getModel('core/config')->saveConfig($this->optionKey, '');
        Mage::getModel('core/config')->saveConfig($this->optionLicenseStatus, $newLicenseStatus);
        Mage::getModel('core/config')->saveConfig($this->optionCountLicenseActivations, 9999);
        Mage::getModel('core/config')->saveConfig($this->optionCountLicenseMaxActivations, (int) 0);
    }

    public function checkLicense()
    {
        $this->before(Mage::getStoreConfig($this->getPath()));
        $result = $this->apiCall(self::CHECK_ACTION);

        if( $result === false ) {
            $this->log("Checking activation plugin failed");
        } else {
            if( $result->license == 'valid' ) {
            } else {
                Mage::getModel('core/config')->saveConfig($this->optionLicenseStatus, $result->license);
            }
        }
    }

    public function isLicenseOk()
    {
        $licenseActivationCount = $this->countLicenseActivations;
        $licenseMaxActivationCount = (int) $this->countLicenseMaxActivations;

        if( $licenseMaxActivationCount > 0 )
        {
            $licenseMaxActivationCount += self::MAX_ACTIVATION_COUNT;
            $isLicenseActivationCountOk = $licenseActivationCount <= $licenseMaxActivationCount;
        }
        elseif( $licenseMaxActivationCount == 0 )
        {
            $isLicenseActivationCountOk = TRUE;
        }

        if( self::$isSandBox )
        {
            $this->log('License:' . $this->license);
            $this->log('License status:' . $this->licenseStatus);
            $this->log('License activations:' . $licenseActivationCount);
            $this->log('License max activations:' . $licenseMaxActivationCount);
        }

        $licenseOk = !empty($this->license) && in_array($this->licenseStatus, array('valid')) && $isLicenseActivationCountOk;
        return $licenseOk;
    }
    
    public function log($msg) {
        Mage::log($msg, null, self::LOG_FILE_NAME);
    }
    
    public function checkUpdates() {
        foreach(self::$items AS $i => $extension) {
            if(!$this->isExtensionEnabled($i)) continue;

            $installedVersion = (string) Mage::getConfig()->getModuleConfig($extension['extension_name'])->version;
            $this->before(Mage::getStoreConfig($this->getPath()), $i);

            if($this->isLicenseOk()) {
                $result = $this->apiCall(self::GET_VERSION_ACTION);
                
                if(version_compare($result->new_version, $installedVersion)) {
                    Mage::getModel('adminnotification/inbox')->add(4, Mage::helper('cminds')->__('%s update is available', $this->itemName), Mage::helper('cminds')->__('%s %s is available. Login to your customer panel and download lastest version !', $this->itemName, $result->new_version), $this->extensionPage, false);
                }
            } else {
                $this->log(Mage::helper('cminds')->__('License is not valid, skipping updates'));
            }
        }
    }
    
    public function validateModules() {
        foreach(self::$items AS $i => $extension) {
            $extensionName = $extension['extension_name'];

            if(isset($extension['related_to'])) {
                $key = $extension['related_to'];
                $ex = self::$items[$extension['related_to']];

                if(!$this->isExtensionEnabled($ex['extension_name'])) {
                    $key = $i;
                    $ex = self::$items[$i];
                }

                $this->before(Mage::getStoreConfig($ex['key_path']), $key);
            } else {
                $this->before(Mage::getStoreConfig($extension['key_path']), $i);
                $ex = $extension;
            }
            if(!$this->isLicenseOk()) {
                if($this->isExtensionEnabled($extensionName)) {
                    $this->disableModule($extensionName);
                }
            }
        }
    }

    public function validateModule($module_name) {
        $module = isset(self::$items[strtolower($module_name)]) ? self::$items[strtolower($module_name)] : false;

        if(!$module) $this->disableModule($module_name);

        if(isset($module['related_to'])) {
            $key = $module['related_to'];
            $ex = self::$items[$module['related_to']];

            if(!$this->isExtensionEnabled($ex['extension_name'])) {
                $key = strtolower($module_name);
                $ex = self::$items[strtolower($module_name)];
            }

            $this->before(Mage::getStoreConfig($ex['key_path']), $key);
        } else {
            $this->before(Mage::getStoreConfig($module['key_path']), strtolower($module_name));
            $ex = $module;
        }

        if(!$this->isLicenseOk()) {
            $this->disableModule($module['extension_name']);
            return false;
        }

        return true;
    }

    private function disableModule($extensionName) {
        $nodePath = 'modules/' . $extensionName . '/active';
        Mage::getConfig()->setNode($nodePath, 'false', true);
    }

    public function isExtensionInstalled($extensionName) {
        $s =  Mage::getConfig()->getModuleConfig($extensionName); 
        return ($s->active);
    }

    public function isExtensionEnabled($extensionName) {
        return Mage::getConfig()->getModuleConfig($extensionName)->is('active', 'true');    
    }
}