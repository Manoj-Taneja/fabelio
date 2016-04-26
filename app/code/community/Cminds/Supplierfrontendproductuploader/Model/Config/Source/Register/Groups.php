<?php
class Cminds_Supplierfrontendproductuploader_Model_Config_Source_Register_Groups {
    public function toOptionArray() {
        $customer_group = new Mage_Customer_Model_Group();
        $customer_group_pro = new Mage_Customer_Model_Group();

        $supplierPro = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/editor_group_id');
        $supplier = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/supplier_group_id');

        $supplierProModel = $customer_group_pro->load($supplierPro);
        $supplierModel = $customer_group->load($supplier);

        $config = array(
            array('value' => $supplierProModel->getCustomerGroupId(), 'label' => $supplierProModel->getCustomerGroupCode()),
            array('value' => $supplierModel->getCustomerGroupId(), 'label' => $supplierModel->getCustomerGroupCode())
        );

        return $config;
    }
}
