<?php
class Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Catalog_Product_Edit extends Mage_Adminhtml_Block_Catalog_Product_Edit {
    public function getDeleteUrl() {
        return $this->getUrl('*/*/delete', array('_current'=>true, 'supplier' => $this->isSupplier()));
    }

    public function getDuplicateUrl() {
        return $this->getUrl('*/*/duplicate', array('_current'=>true, 'supplier' => $this->isSupplier()));
    }

    protected function isSupplier() {
    	return Mage::app()->getRequest()->getParam('supplier', false);
    }
}