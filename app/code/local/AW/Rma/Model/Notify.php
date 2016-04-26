<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Rma
 * @version    1.5.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Rma_Model_Notify extends Mage_Core_Model_Abstract
{
    protected $_storeId = null;

    /**
     * Return TRUE when Enable emails notifications isn't set to "Disabled"
     * @return boolean
     */
    protected function _isGenerallyEnabled()
    {
        $disableStatus = AW_Rma_Model_Source_Config_Enableemailsnotifications::DISABLED;
        return Mage::helper('awrma/config')->getEnableEmailNotifications($this->_storeId) != $disableStatus;
    }

    /**
     * Return TRUE when Enable emails notifications is set to All or Customer only
     * @return boolean
     */
    protected function _isEnabledForCustomer()
    {
        $adminOnlyStatus = AW_Rma_Model_Source_Config_Enableemailsnotifications::ADMINONLY;
        return $this->_isGenerallyEnabled()
        && Mage::helper('awrma/config')->getEnableEmailNotifications($this->_storeId) != $adminOnlyStatus;
    }

    /**
     * Return TRUE when Enable emails notifications is set to All or Admin only
     * @return boolean
     */
    protected function _isEnabledForAdmin()
    {
        $customerOnlyStatus = AW_Rma_Model_Source_Config_Enableemailsnotifications::CUSTOMERONLY;
        return $this->_isGenerallyEnabled()
        && Mage::helper('awrma/config')->getEnableEmailNotifications($this->_storeId) != $customerOnlyStatus;
    }

    /**
     * Wrapper for new request event
     * @param AW_Rma_Model_Entity $rmaRequest
     * @param string $commentText
     * @return AW_Rma_Model_Notify
     */
    public function notifyNew($rmaRequest, $commentText = null)
    {
        $this->setFlagNotifyNew(true);
        if ($commentText) {
            /** @var AW_Rma_Model_Entitycomments $comment */
            $comment = Mage::getModel('awrma/entitycomments');
            $comment->setData('text', $commentText);
        } else {
            $comment = null;
        }
        return $this->_notifyByStatus($rmaRequest, $comment, true);
    }

    /**
     * @return AW_Rma_Helper_Config
     */
    protected function _getConfigHelper()
    {
        return Mage::helper('awrma/config');
    }

    /**
     * @return AW_Rma_Helper_Request
     */
    protected function _getRequestHelper()
    {
        return Mage::helper('awrma/request');
    }

    /**
     * @param AW_Rma_Model_Entity|int $rmaEntity
     * @return AW_Rma_Model_Entity
     */
    protected function _initRMAEntity($rmaEntity)
    {
        if (!is_object($rmaEntity)) {
            $rmaEntity = Mage::getModel('awrma/entity')->load($rmaEntity);
        } else {
            $rmaEntity->afterLoad();
        }
        return $rmaEntity;
    }

    /**
     * @param AW_Rma_Model_Entity $rmaEntity
     * @param null $comment
     * @param bool $isFrontend
     * @return AW_Rma_Model_Entity
     */
    protected function _addDataForStatusNotification(AW_Rma_Model_Entity $rmaEntity, $comment = null, $isFrontend = false)
    {
        $configHelper = $this->_getConfigHelper();
        $storeId = $rmaEntity->getStoreId();
        if ($comment) {
            $rmaEntity->setData('notify_has_comment', true);
            $rmaEntity->setData('notify_comment_text', $comment->getData('text'));
        }
        if ($this->getFlagStatusChanged()) {
            $rmaEntity->setData('notify_status_changed', true);
        }
        $rmaEntity->addData(array(
            'notify_initiated_by_customer' => $isFrontend,
            'notify_initiated_by_admin' => !$isFrontend,
            'notify_printlabel_allowed' => $configHelper->getAllowPrintLabel($storeId),
            'confirm_shipping_is_required' => $configHelper->getRequireConfirmSending($storeId),
            'notify_rma_address' => $configHelper->getDepartmentAddress($storeId),
        ));
        return $rmaEntity;
    }

    /**
     * @param AW_Rma_Model_Entity $rmaEntity
     * @return AW_Rma_Model_Entitystatus
     */
    protected function _getEntityStatus(AW_Rma_Model_Entity $rmaEntity)
    {
        /** @var AW_Rma_Model_Entitystatus $entityStatus */
        $entityStatus = Mage::getModel('awrma/entitystatus')->load($rmaEntity->getStatus());
        $entityStatus->storeTemplateFromRma($rmaEntity->getStoreId());
        return $entityStatus;
    }

    /**
     * @param AW_Rma_Model_Entity $rmaEntity
     * @return AW_Rma_Model_Email_Template
     */
    protected function _getEmailTemplate(AW_Rma_Model_Entity $rmaEntity)
    {
        /** @var AW_Rma_Model_Email_Template $emailTemplate */
        $emailTemplate = Mage::getModel('awrma/email_template');
        return $emailTemplate->setDesignConfig(array('area' => 'frontend', 'store' => $rmaEntity->getStoreId()));
    }

    /**
     * @param AW_Rma_Model_Entity $rmaEntity
     * @return array
     */
    protected function _getEmailParams(AW_Rma_Model_Entity $rmaEntity)
    {
        $configHelper = $this->_getConfigHelper();
        $storeId = $rmaEntity->getStoreId();
        $store = Mage::app()->getSafeStore($storeId);
        if (!Mage::helper('awrma')->checkExtensionVersion('Mage_Core', '0.8.25')) {
            $store->setFrontendName($rmaEntity->getOrder()->getStoreGroupName());
        }
        return array(
            'sender' => $configHelper->getEmailSender($storeId),
            'email' => $configHelper->getDepartmentEmail($storeId),
            'depname' => $configHelper->getDepartmentDisplayName($storeId),
            'request' => $rmaEntity,
            'store' => $store,
            'subject' => $_subject = Mage::helper('awrma')->__('Notify about RMA %s', $rmaEntity->getTextId()),
        );
    }

    /**
     * @param AW_Rma_Model_Entitycomments $comment
     * @return array
     */
    protected function _getCommentAttachment(AW_Rma_Model_Entitycomments $comment)
    {
        /** @var AW_Rma_Helper_Files $filesHelper */
        $filesHelper = Mage::helper('awrma/files');
        $attachments = array();
        if ($attachment = $comment->getData('attachments')) {
            $attachments[$attachment] = $filesHelper->getAttachmentContent($attachment);
        }
        return $attachments;
    }

    /**
     * @param AW_Rma_Model_Email_Template $emailTemplate
     * @param array $attachments
     * @return $this
     */
    protected function _addAttachmentsToEmailTemplate(AW_Rma_Model_Email_Template $emailTemplate, array $attachments)
    {
        foreach ($attachments as $fileName => $fileContent) {
            $emailTemplate->addAttachment($fileName, $fileContent);
        }
        return $this;
    }

    /**
     * @param AW_Rma_Model_Entity $rmaEntity
     * @param AW_Rma_Model_Entitystatus $status
     * @return $this
     */
    protected function _notifyCustomerOnStatus(AW_Rma_Model_Entity $rmaEntity, AW_Rma_Model_Entitystatus $status, $comment = null)
    {
        $emailParams = $this->_getEmailParams($rmaEntity);
        $this->_notify($rmaEntity, $comment, $status->getToCustomer(), AW_Rma_Model_Email_Template::AWRMA_RECIPIENT_CUSTOMER,
            $rmaEntity->getCustomerEmail(), $rmaEntity->getCustomerName(), $emailParams);
        return $this;
    }

    /**
     * @param AW_Rma_Model_Entity $rmaEntity
     * @param AW_Rma_Model_Entitystatus $status
     * @return $this
     */
    protected function _notifyAdminOnStatus(AW_Rma_Model_Entity $rmaEntity, AW_Rma_Model_Entitystatus $status, $comment = null)
    {
        $emailParams = $this->_getEmailParams($rmaEntity);
        $this->_notify($rmaEntity, $comment, $status->getToAdmin(), AW_Rma_Model_Email_Template::AWRMA_RECIPIENT_ADMIN,
            $emailParams['email'], $emailParams['depname'], $emailParams);
        return $this;
    }

    /**
     * @param AW_Rma_Model_Entity $rmaEntity
     * @param AW_Rma_Model_Entitystatus $status
     * @return $this
     */
    protected function _notifyChatboxOnStatus(AW_Rma_Model_Entity $rmaEntity, AW_Rma_Model_Entitystatus $status)
    {
        $emailParams = $this->_getEmailParams($rmaEntity);
        $emailTemplate = $this->_getEmailTemplate($rmaEntity)
            ->setAWRMATemplate($status->getToChatbox(), AW_Rma_Model_Email_Template::AWRMA_RECIPIENT_CHATBOX);
        $processedTemplate = $emailTemplate->getProcessedTemplate($emailParams);
        Mage::helper('awrma/comments')->postComment($rmaEntity->getId(), $processedTemplate, array(), false);
        return $this;
    }

    /**
     * Parse all templates in status and sent emails and adds messages to chatbox
     *
     * @param AW_Rma_Model_Entity $rmaRequest
     * @param AW_Rma_Model_Entitycomments $comment
     * @param boolean $isFrontend
     *
     * @return AW_Rma_Model_Notify
     * @throws Exception
     */
    protected function _notifyByStatus($rmaRequest, $comment = null, $isFrontend = false)
    {
        if (!$this->_isGenerallyEnabled()) {
            return $this;
        }

        $rmaRequest = $this->_initRMAEntity($rmaRequest);
        $this->_addDataForStatusNotification($rmaRequest, $comment, $isFrontend);

        $oldStore = Mage::app()->getStore();
        $oldDesign = Mage::getDesign()->setAllGetOld(array(
            'package' => Mage::getStoreConfig('design/package/name', $rmaRequest->getStoreId()),
            'store' => $rmaRequest->getStoreId()
        ));

        $entityStatus = $this->_getEntityStatus($rmaRequest);

        # Notify customer
        if ($this->_isEnabledForCustomer() && $entityStatus->getToCustomer()) {
            if ($this->getFlagNotifyNew()) {
                $rmaRequest->setData('notify_has_comment', false);
            }
            $rmaRequest->setData('printlabel_link', $this->_getRequestHelper()->getPrintlabelLink($rmaRequest));
            //change locale
            $frontendLocale = Mage::getStoreConfig('general/locale/code', $rmaRequest->getStoreId());
            $currentLocale =  Mage::app()->getLocale()->getLocaleCode();
            Mage::getSingleton('adminhtml/session')->setLocale($frontendLocale);
            Mage::app()->getTranslator()
                ->setLocale($frontendLocale)
                ->init(Mage_Core_Model_App_Area::AREA_FRONTEND, true)
            ;

            //send notify
            $this->_notifyCustomerOnStatus($rmaRequest, $entityStatus, $comment);

            //return locale
            Mage::getSingleton('adminhtml/session')->setLocale($currentLocale);
            Mage::app()->getTranslator()
                ->setLocale($currentLocale)
                ->init(Mage_Core_Model_App_Area::AREA_FRONTEND, true)
            ;
        }

        # Notify admin
        if ($this->_isEnabledForAdmin() && $entityStatus->getToAdmin() && $isFrontend) {
            $rmaRequest->setData('notify_order_admin_link', Mage::helper('awrma')->getOrderUrl($rmaRequest->getOrderId()));
            $this->_notifyAdminOnStatus($rmaRequest, $entityStatus, $comment);
        }

        # Chatbox
        if ($entityStatus->getToChatbox()) {
            $this->_notifyChatboxOnStatus($rmaRequest, $entityStatus);
        }

        Mage::getDesign()->setAllGetOld($oldDesign);
        Mage::app()->setCurrentStore($oldStore);
        Mage::app()->getWebsite()->setId($oldStore->getWebsiteId());

        return $this;
    }

    /**
     * @param AW_Rma_Model_Entity $rmaEntity
     * @param AW_Rma_Model_Entitycomments $comment
     * @param string $template
     * @param string $templateRecipient
     * @param string $toEmail
     * @param string $toName
     * @param array $emailParams
     * @return $this
     */
    protected function _notify($rmaEntity, $comment, $template, $templateRecipient, $toEmail, $toName, $emailParams)
    {
        /** @var AW_Rma_Model_Email_Template $emailTemplate */
        $emailTemplate = $this->_getEmailTemplate($rmaEntity);
        if ($comment && ($attachments = $this->_getCommentAttachment($comment))) {
            $this->_addAttachmentsToEmailTemplate($emailTemplate, $attachments);
        }
        $emailTemplate
            ->setAWRMATemplate($template, $templateRecipient)
            ->sendEmail($emailParams['sender'], $toEmail, $toName, $emailParams);
        return $emailTemplate->getSentSuccess();
    }

    /**
     * @param $rmaEntity
     * @param $comment
     * @return $this
     */
    protected function _notifyAdminOnComment($rmaEntity, $comment)
    {
        $emailParams = $this->_getEmailParams($rmaEntity);
        $this->_notify($rmaEntity, $comment, '', AW_Rma_Model_Email_Template::AWRMA_RECIPIENT_ADMIN,
            $emailParams['email'], $emailParams['depname'], $emailParams);
        return $this;
    }

    /**
     * @param $rmaEntity
     * @param $comment
     * @return $this
     */
    protected function _notifyCustomerOnComment($rmaEntity, $comment)
    {
        $emailParams = $this->_getEmailParams($rmaEntity);
        $this->_notify($rmaEntity, $comment, '', AW_Rma_Model_Email_Template::AWRMA_RECIPIENT_CUSTOMER,
            $rmaEntity->getCustomerEmail(), $rmaEntity->getCustomerName(), $emailParams);
        return $this;
    }

    protected function _addDataForCommentNotification($rmaEntity, $comment, $isFrontend)
    {
        $rmaEntity->addData(array(
            'notify_has_comment' => true,
            'notify_comment_text' => $comment->getData('text'),
            'notify_initiated_by_customer' => $isFrontend,
            'notify_initiated_by_admin' => !$isFrontend,
        ));
        return $rmaEntity;
    }

    /**
     * Notify customer or admin about comment on request
     *
     * @param AW_Rma_Model_Entity $rmaRequest
     * @param AW_Rma_Model_Entitycomments $comment
     * @param boolean $isFrontend
     *
     * @return AW_Rma_Model_Notify
     */
    public function notifyAboutComment($rmaRequest, $comment = null, $isFrontend = false)
    {
        if (!$this->_isGenerallyEnabled() || !$comment) {
            return $this;
        }

        /** @var AW_Rma_Model_Entity $rmaRequest */
        $rmaRequest = $this->_initRMAEntity($rmaRequest);
        $this->_addDataForCommentNotification($rmaRequest, $comment, $isFrontend);

        $oldStore = Mage::app()->getStore();
        $oldDesign = Mage::getDesign()->setAllGetOld(array(
            'package' => Mage::getStoreConfig('design/package/name', $rmaRequest->getStoreId()),
            'store' => $rmaRequest->getStoreId()
        ));

        if ($isFrontend && $this->_isEnabledForAdmin()) {
            $this->_notifyAdminOnComment($rmaRequest, $comment);
        }

        if (!$isFrontend && $this->_isEnabledForCustomer()) {
            $this->_notifyCustomerOnComment($rmaRequest, $comment);
        }

        Mage::getDesign()->setAllGetOld($oldDesign);
        Mage::app()->setCurrentStore($oldStore);
        Mage::app()->getWebsite()->setId($oldStore->getWebsiteId());

        return $this;
    }

    /**
     * Check changes in request and call some functions on it
     *
     * @param AW_Rma_Model_Entity $rmaRequest
     * @param boolean $isFrontend
     * @param AW_Rma_Model_Entitycomments $commen
     *
     * @return AW_Rma_Model_Notify
     */
    public function checkChanges($rmaRequest, $isFrontend = true, $comment = null)
    {
        if ($this->_isGenerallyEnabled()) {
            if ($rmaRequest->getData('status') != $rmaRequest->getOrigData('status')) {
                # Status changes
                $this->setFlagStatusChanged(true);
                $this->_notifyByStatus($rmaRequest, $comment, $isFrontend);
            } elseif ($comment) {
                # Comment added without status change
                $this->notifyAboutComment($rmaRequest, $comment, $isFrontend);
            }
        }
        return $this;
    }
}
