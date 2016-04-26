<?php
class Cminds_Supplierfrontendproductuploader_Model_Source_Suppliers extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {
    public function getAllOptions() {
        $collection = Mage::getModel('customer/customer')
        ->getCollection()
        ->addAttributeToSelect('*')
        ->addFieldToFilter('group_id', Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/editor_group_id'));
        $this->_options[] = array('label'=> NULL, 'value' => NULL);
        
        foreach ($collection as $customer) {
            $fullName = $customer->getFirstname() . ' ' . $customer->getLastname();
            $this->_options[] = array('label'=> $fullName, 'value' => $customer->getId());
        }

		if(Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/supplier_group_id') != Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/editor_group_id')) {

	        $collection = Mage::getModel('customer/customer')
	        ->getCollection()
	        ->addAttributeToSelect('*')
	        ->addFieldToFilter('group_id', Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/supplier_group_id'));
	        
	        foreach ($collection as $customer) {
	            $fullName = $customer->getFirstname() . ' ' . $customer->getLastname();
	            $this->_options[] = array('label'=> $fullName, 'value' => $customer->getId());
	        }
	    }
        
        return $this->_options;
    }

    public function toOptionArray() {
        return $this->getAllOptions();
    }
}