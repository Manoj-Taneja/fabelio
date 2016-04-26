<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Model_Sales_Order extends Amasty_Orderstatus_Model_Sales_Order_Pure
{
    public function addStatusHistoryComment($comment, $status = false)
    {
        $history = parent::addStatusHistoryComment($comment, $status);
        
        // checking is the new status is one of ours
        $statusCollection = Mage::getResourceModel('amorderstatus/status_collection');
        $statusCollection->addFieldToFilter('is_system', array('eq' => 0));
        foreach ($statusCollection as $statusModel) {
            if ($statusModel->getAlias() == substr($status, strpos($status, '_') + 1)) {
                // this is it!
                Mage::register('amorderstatus_history_status', $statusModel, true);
            }
        }
        
        return $history;
    }
    
    public function sendOrderUpdateEmail($notifyCustomer=true, $comment='')
    {
        // REWRITE BEGIN
        $statusModel = Mage::registry('amorderstatus_history_status');
        if ($statusModel && $statusModel->getNotifyByEmail()) {
            $notifyCustomer = true;
        }
        // REWRITE END
        
        if (!Mage::helper('sales')->canSendOrderCommentEmail($this->getStore()->getId())) {
            return $this;
        }

        $copyTo = $this->_getEmails(self::XML_PATH_UPDATE_EMAIL_COPY_TO);
        $copyMethod = Mage::getStoreConfig(self::XML_PATH_UPDATE_EMAIL_COPY_METHOD, $this->getStoreId());
        if (!$notifyCustomer && !$copyTo) {
            return $this;
        }

        // set design parameters, required for email (remember current)
        $currentDesign = Mage::getDesign()->setAllGetOld(array(
            'store'   => $this->getStoreId(),
            'area'    => 'frontend',
            'package' => Mage::getStoreConfig('design/package/name', $this->getStoreId()),
        ));

        $translate = Mage::getSingleton('core/translate');
        /* @var $translate Mage_Core_Model_Translate */
        $translate->setTranslateInline(false);

        $sendTo = array();

        $mailTemplate = Mage::getModel('core/email_template');

        if ($this->getCustomerIsGuest()) {
            $template = Mage::getStoreConfig(self::XML_PATH_UPDATE_EMAIL_GUEST_TEMPLATE, $this->getStoreId());
            $customerName = $this->getBillingAddress()->getName();
        } else {
            $template = Mage::getStoreConfig(self::XML_PATH_UPDATE_EMAIL_TEMPLATE, $this->getStoreId());
            $customerName = $this->getCustomerName();
        }
        
        // REWRITE BEGIN
        // replacing e-mail template
        if ($statusModel) {
            $template = Mage::getModel('amorderstatus/status_template')->loadTemplateId($statusModel->getId(), $this->getStoreId());
            if (0 != strlen($template) && 0 == $template) {
                $template = 'amorderstatus_status_change';
            }
        }
        // REWRITE END

        if ($notifyCustomer) {
            $sendTo[] = array(
                'name'  => $customerName,
                'email' => $this->getCustomerEmail()
            );
            if ($copyTo && $copyMethod == 'bcc') {
                foreach ($copyTo as $email) {
                    $mailTemplate->addBcc($email);
                }
            }

        }

        if ($copyTo && ($copyMethod == 'copy' || !$notifyCustomer)) {
            foreach ($copyTo as $email) {
                $sendTo[] = array(
                    'name'  => null,
                    'email' => $email
                );
            }
        }

        foreach ($sendTo as $recipient) {
            $mailTemplate->setDesignConfig(array('area'=>'frontend', 'store' => $this->getStoreId()))
                ->sendTransactional(
                    $template,
                    Mage::getStoreConfig(self::XML_PATH_UPDATE_EMAIL_IDENTITY, $this->getStoreId()),
                    $recipient['email'],
                    $recipient['name'],
                    array(
                        'order'     => $this,
                        'billing'   => $this->getBillingAddress(),
                        'comment'   => $comment
                    )
                );
        }

        $translate->setTranslateInline(true);

        // revert current design
        Mage::getDesign()->setAllGetOld($currentDesign);

        return $this;
    }
}