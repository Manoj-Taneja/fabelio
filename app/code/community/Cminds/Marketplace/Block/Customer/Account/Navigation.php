<?php
class Cminds_Marketplace_Block_Customer_Account_Navigation extends Mage_Customer_Block_Account_Navigation {
    public function addLink($name, $path, $label, $urlParams=array()) {
        $configLabelName = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_presentation/account_page_label');

        if($name == 'supplierfrontendproductuploader') {
            if(!Mage::helper('supplierfrontendproductuploader')->hasAccess() || !Mage::helper('supplierfrontendproductuploader')->isEnabled()) {
                return $this;
            }

            if($configLabelName != '') {
                $label = $configLabelName;
            }
        }

        if($name == 'marketplace_supplier_rate' || $name == 'marketplace_supplier_rates') {
            if(!Mage::helper('supplierfrontendproductuploader')->isEnabled()) {
                return $this;
            }

            if(!Mage::getStoreConfig('marketplace_configuration/presentation/supplier_rating')) {
                return $this;
            }
        }
        
        $this->_links[$name] = new Varien_Object(array(
            'name' => $name,
            'path' => $path,
            'label' => $label,
            'url' => $this->getUrl($path, $urlParams),
        ));
        return $this;
    }
    protected function _beforeToHtml()
    {
        if(Mage::getConfig()->getModuleConfig('Cminds_MultiUserAccounts')->is('active', 'true')){
            $helper = Mage::helper('cminds_multiuseraccounts');

            if ($helper->isEnabled() && !$helper->isSubAccountMode()) {
                $this->addLink('sub_account', 'customer/account/subAccount', $this->__('Manage Users'));
            }
        }
        return $this;
    }
}