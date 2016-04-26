<?php
class Cminds_Marketplace_Helper_Email extends Mage_Core_Helper_Abstract {
    private function _isConfigEnabled($slug) {
        return $this->getConfig($slug);
    }
    private function getConfig($slug) {
        return Mage::getStoreConfig('marketplace_configuration/' . $slug);
    }
    
    public function notifyAdminOnProfileChange($customer) {
        if(!$this->_isConfigEnabled('general/notify_admin_on_profile_changed')) return false;

        $adminEmail = Mage::getStoreConfig('trans_email/ident_general/email');
        $adminName = Mage::getStoreConfig('trans_email/ident_general/name');

        $supplierName = $customer->getFirstname() .' '. $customer->getLastname();

        Mage::helper('supplierfrontendproductuploader/email')->_sendEmail($adminName, $adminEmail, 'Profile is waiting for confirmation', 'Supplier "'.$supplierName.'" (ID '.$customer->getId().') just changed his profile. You can go to admin section Suppliers -> Manager Suppliers and review his changes.');

    }

    public function notifyAdminOnUploadedFiles() {
        if(!$this->_isConfigEnabled('general/notify_admin_on_profile_changed')) return false;

        $adminEmail = Mage::getStoreConfig('trans_email/ident_general/email');
        $adminName = Mage::getStoreConfig('trans_email/ident_general/name');

        Mage::helper('supplierfrontendproductuploader/email')->_sendEmail($adminName, $adminEmail, 'New products awaiting for acceptation', 'Some of the suppliers added new products which are waiting for your acceptation !');

    }

    public function notifyAdminOnUploadingProducts($customer, $products_count) {
        if(!$this->_isConfigEnabled('csv_import/notify_admin_on_uploading_products')) return false;

        $adminEmail = Mage::getStoreConfig('trans_email/ident_general/email');
        $adminName = Mage::getStoreConfig('trans_email/ident_general/name');
        $supplierName = $customer->getFirstname() .' '. $customer->getLastname();

        Mage::helper('supplierfrontendproductuploader/email')->_sendEmail($adminName, $adminEmail, 'Supplier uploaded products', 'Supplier '.$supplierName.' uploaded ' . $products_count .' new product(s)');
    }

    public function notifySupplier($customer) {
        if(!$this->_isConfigEnabled('notify_supplier_on_profile_approved')) return false;
        
        Mage::helper('supplierfrontendproductuploader/email')->_sendEmail($customer->getFirstname() .' '. $customer->getLastname(), $customer->getEmail(), 'Your supplier profile has been enabled', 'Your Supplier profile has been enabled !');
    }
}
