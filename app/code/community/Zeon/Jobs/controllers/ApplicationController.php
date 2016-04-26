<?php

/**
 * zeonsolutions inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.zeonsolutions.com/shop/license-community.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * This package designed for Magento COMMUNITY edition
 * =================================================================
 * zeonsolutions does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * zeonsolutions does not provide extension support in case of
 * incorrect edition usage.
 * =================================================================
 *
 * @category   Zeon
 * @package    Zeon_Jobs
 * @version    0.0.1
 * @copyright  @copyright Copyright (c) 2013 zeonsolutions.Inc. (http://www.zeonsolutions.com)
 * @license    http://www.zeonsolutions.com/shop/license-community.txt
 */

class Zeon_Jobs_ApplicationController extends Mage_Core_Controller_Front_Action
{
    const XML_PATH_ENABLED = 'zeon_jobs/general/is_enabled';

    public function preDispatch()
    {
        parent::preDispatch();

        if ( !Mage::getStoreConfigFlag(self::XML_PATH_ENABLED) ) {
            $this->norouteAction();
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
            return;
        }
    }

    public function applyAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('jobApplicationForm')
            ->setFormAction(Mage::getUrl('careers/application/applyPost'));
        $this->renderLayout();
    }

    protected function _getSession()
    {
        return Mage::getSingleton('zeon_jobs/session');
    }
    /**
     * action after form submition
    */
    public function applyPostAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $session = $this->_getSession();
            $model = Mage::getModel('zeon_jobs/application');
            try {
                if (!empty($data)) {
                    $model->addData($data);
                    $session->setFormData($data);
                }
                if (isset($_FILES['upload_resume']['name']) && $_FILES['upload_resume']['name'] != '') {
                    $uploader = new Varien_File_Uploader('upload_resume');
                    $uploader->setAllowedExtensions(
                        explode(',', Mage::helper('zeon_jobs')->getAllowedFileExtensions())
                    );
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(false);
                    $path = Mage::getBaseDir('media') . DS . 'resumes' . DS;
                    $_FILES['upload_resume']['name'] = str_replace(' ', '-', $_FILES['upload_resume']['name']);
                    $uploader->save($path, $_FILES['upload_resume']['name']);
                    $model->setUploadResume($uploader->getUploadedFileName());
                }

                $model->save();
                $session->addSuccess(
                    Mage::helper('zeon_jobs')->__('Your application has been submitted. Thank you for contacting us.')
                );

                $translate = Mage::getSingleton('core/translate');
                $translate->setTranslateInline(false);
                /*To send email*/
                $dataObject = new Varien_Object();
                $dataObject->setData($data);
                //Send Email Notification to Admin & User
                if (!$model->sendNotificationEmail($dataObject)) {
                    throw new Exception('Email notification has not been sent.');
                }

                $translate->setTranslateInline(true);

                // Redirect to a success page, at the moment it goes back to the job list.
                $this->_redirect('careers');
                return;

            } catch (Exception $e) {
                $session->addError($e->getMessage());
                $session->getFormData($data);
                $this->_redirect('careers');
                return;
            }
        }
    }
}