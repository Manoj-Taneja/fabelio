<?php

class Cminds_Marketplace_Block_Adminhtml_Customer_Grid_Renderer_Vendor
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $customerGroup = $row->getData('group_id');

        $customerGroupConfig = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/supplier_group_id');
        $editorGroupConfig = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/editor_group_id');

        $allowedGroups = array();

        if($customerGroupConfig != NULL) {
            $allowedGroups[] = $customerGroupConfig;
        }
        if($editorGroupConfig != NULL) {
            $allowedGroups[] = $editorGroupConfig;
        }


        return in_array($customerGroup, $allowedGroups) ? $this->__('Yes') : $this->__('No');
    }
}

?>