<?php
class Cminds_Supplierfrontendproductuploader_Helper_Email extends Mage_Core_Helper_Abstract {
    private function _isConfigEnabled($slug) {
        return $this->getConfig($slug);
    }
    private function getConfig($slug) {
        return Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_notification_config/' . $slug);
    }
    
    public function _sendEmail($receiverName, $receiverEmail, $title, $message) {
        if($message == '') {
            return false;
        }
        
        $senderName = Mage::getStoreConfig('trans_email/ident_general/name');
        $senderEmail = Mage::getStoreConfig('trans_email/ident_general/email');

        $mail = Mage::getModel('core/email');
        $mail->setToName($receiverName);
        $mail->setToEmail($receiverEmail);
        $mail->setFromEmail($senderEmail);
        $mail->setFromName($senderName);
        $mail->setBody(nl2br($message));
        $mail->setSubject($title);
        $mail->setType('html');

        try {
            $mail->send();
        }
        catch (Exception $e) {
            Mage::log($e->getMessage());
        }
    }
    public function productApproved($customerData, $productData) {
        $isEnabled = $this->_isConfigEnabled('notify_on_product_was_approved');
        if($isEnabled == 1 && $customerData->getData('notification_product_approved') == 1) {
            $topic  = $this->getConfig('email_title_on_product_approved');
            $message = $this->getConfig('email_text_on_product_approved');
            
            $replacements = array('{{supplierName}}', '{{productName}}', '{{productLink}}', '{{productQty}}');
            $customerFullName = $customerData->getFirstname() .' '. $customerData->getLastname();
            $productLink = Mage::getUrl($productData->getUrlPath());
            $replaces = array($customerFullName, $productData->getName(), $productLink, Mage::getModel('cataloginventory/stock_item')->loadByProduct($productData)->getQty());
            
            $rMessage = str_replace($replacements, $replaces, $message);
            $rTopic = str_replace($replacements, $replaces, $topic);
            $this->_sendEmail($customerFullName, $customerData->getEmail(), $rTopic, $rMessage);
        }
    }
    public function productPurchased($customerData, $productData, $itemData) {
        $isEnabled = $this->_isConfigEnabled('notify_on_product_was_ordered');

        if($isEnabled == 1 && $customerData->getData('notification_product_ordered') == 1) {
            $topic  = $this->getConfig('email_title_on_product_was_ordered');
            $message = $this->getConfig('email_text_on_product_was_ordered');
            
            $replacements = array('{{supplierName}}', '{{productName}}', '{{productLink}}', '{{productQty}}', '{{price}}', '{{sku}}', '{{firstname}}', '{{lastname}}', '{{street}}', '{{city}}', '{{email}}', '{{postcode}}', '{{region}}', '{{getCountryId}}');
            $customerFullName = $customerData->getFirstname() .' '. $customerData->getLastname();
            $productLink = Mage::getUrl($productData->getUrlPath());

            if(is_array($itemData['street'])) {
                $street = join(' ', $itemData['street']);
            } else {
                $street = $itemData['street'];
            }

            $replaces = array($customerFullName, $productData->getName(), $productLink, Mage::getModel('cataloginventory/stock_item')->loadByProduct($productData)->getQty(), $itemData['price'], $itemData['sku'], $itemData['firstname'], $itemData['lastname'], $street, $itemData['city'], $itemData['email'], $itemData['postcode'], $itemData['region'], $itemData['getCountryId']);
            
            $rMessage = str_replace($replacements, $replaces, $message);
            $rTopic = str_replace($replacements, $replaces, $topic);
            $this->_sendEmail($customerFullName, $customerData->getEmail(), $rTopic, $rMessage);
        }
    }
    
    public function notifyOnSupplierAddNew($product) {
            $adminEmail = Mage::getStoreConfig('trans_email/ident_general/email');
            $adminName = Mage::getStoreConfig('trans_email/ident_general/name');
            
            $this->_sendEmail($adminName, $adminEmail, 'New product added by supplier', 'Product '.$product->getId().' was added and waiting for acceptation');
    }

    public function notifyAdminOnProductChange($product) {
        $adminEmail = Mage::getStoreConfig('trans_email/ident_general/email');
        $adminName = Mage::getStoreConfig('trans_email/ident_general/name');

        $this->_sendEmail($adminName, $adminEmail, 'Remarked product was changed by supplier', 'Product '.$product->getName().' (SKU: '.$product->getSku().', ID#'.$product->getId().') was remarked by you and changed by supplier.');
    }
}
