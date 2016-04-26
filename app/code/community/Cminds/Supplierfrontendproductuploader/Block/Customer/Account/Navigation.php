<?php
class Cminds_Supplierfrontendproductuploader_Block_Customer_Account_Navigation extends Mage_Customer_Block_Account_Navigation {
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
        
        $this->_links[$name] = new Varien_Object(array(
            'name' => $name,
            'path' => $path,
            'label' => $label,
            'url' => $this->getUrl($path, $urlParams),
        ));
        return $this;
    }
}