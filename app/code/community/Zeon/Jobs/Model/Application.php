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

class Zeon_Jobs_Model_Application extends Mage_Core_Model_Abstract
{
    // Admin Email
    const XML_PATH_EMAIL_RECIPIENT      = 'zeon_jobs/email/recipient_email';
    const XML_PATH_EMAIL_IDENTITY       = 'zeon_jobs/email/sender_email_identity';
    const XML_PATH_ADMIN_EMAIL_TEMPLATE = 'zeon_jobs/email/admin_email_template';

    // User Email
    const XML_PATH_CONFIRM              = 'zeon_jobs/email/confirm';
    const XML_PATH_USER_EMAIL_TEMPLATE  = 'zeon_jobs/email/user_email_template';

    public function _construct()
    {
        parent::_construct();
        $this->_init('zeon_jobs/application');
    }

    public function validate()
    {
        $errors = array();
        $helper = Mage::helper('zeon_jobs');

        if (!Zend_Validate::is(trim($this->getResumeTitle()), 'NotEmpty')) {
            $errors[] = $helper->__('The resume title cannot be empty.');
        }

        if (!Zend_Validate::is(trim($this->getFirstname()), 'NotEmpty')) {
            $errors[] = $helper->__('The first name cannot be empty.');
        }

        if (!Zend_Validate::is(trim($this->getLastname()), 'NotEmpty')) {
            $errors[] = $helper->__('The last name cannot be empty.');
        }

        if (!Zend_Validate::is(trim($this->getEmail()), 'NotEmpty')) {
            $errors[] = $helper->__('The email cannot be empty.');
        }

        if (Zend_Validate::is(trim($this->getEmail()), 'NotEmpty') && !Zend_Validate::is(trim($this->getEmail()), 'EmailAddress')) {
            $errors[] = $customerHelper->__('Invalid email address "%s".', $this->getEmail());
        }

        if (!Zend_Validate::is(trim($this->getTelephone()), 'NotEmpty')) {
            $errors[] = $helper->__('The telephone cannot be empty.');
        }

        if (!Zend_Validate::is(trim($this->getUploadResume()), 'NotEmpty')) {
            $errors[] = $helper->__('Select the resume to upload.');
        }

    if (empty($errors)) {
            return true;
    }
    return $errors;
    }

    function addError($error)
    {
        $this->_errors[] = $error;
    }

    function getErrors()
    {
        return $this->_errors;
    }

    function resetErrors()
    {
        $this->_errors = array();
    }

    function printError($error, $line = null)
    {
        if ($error == null) return false;
        $img = 'error_msg_icon.gif';
        $liStyle = 'background-color:#FDD; ';
        echo '<li style="'.$liStyle.'">';
        echo '<img src="'.Mage::getDesign()->getSkinUrl('images/'.$img).'" class="v-middle"/>';
        echo $error;
        if ($line) {
            echo '<small>, Line: <b>'.$line.'</b></small>';
        }
        echo "</li>";
    }

    /* Checks backup file exists.
     *
     * @return boolean
     */
    public function isFileExists()
    {
        return is_file(Mage::getBaseDir('media') . DS . 'resumes' . DS . $this->getFilename());
    }

    /**
     * Return file name of backup file
     *
     * @return string
     */
    public function getFilename()
    {
        $request = $this->load($this->getId());
        return $this->getUploadResume();
    }

    /**
     * Print output
     *
     */
    public function output()
    {
        if (!$this->isFileExists()) {
            return;
        }

        $ioAdapter = new Varien_Io_File();
        $ioAdapter->open(array('path' => Mage::getBaseDir('media') . DS . 'resumes'));

        $ioAdapter->streamOpen($this->getFilename(), 'r');
        while ($buffer = $ioAdapter->streamRead()) {
            echo $buffer;
        }
        $ioAdapter->streamClose();
    }

    public function getSize()
    {
        if (!is_null($this->getData('size'))) {
            return $this->getData('size');
        }

        if ($this->isFileExists()) {
            $this->setData('size', filesize(Mage::getBaseDir('media') . DS . 'resumes' . DS . $this->getFilename()));
            return $this->getData('size');
        }

        return 0;
    }

    /**
     * Send admin notification email
     *
     * @return bool
     */
    public function sendNotificationEmail(Varien_Object $data)
    {
        $return = false;
        $store = Mage::app()->getStore($this->getStoreId());
        $mail  = Mage::getModel('core/email_template');
        $mail->setDesignConfig(array('area'=>'frontend', 'store' => $this->getStoreId()))
            ->setReplyTo($data->getEmail())
            ->sendTransactional(
                $store->getConfig(self::XML_PATH_ADMIN_EMAIL_TEMPLATE), 
                $store->getConfig(self::XML_PATH_EMAIL_IDENTITY),
                $store->getConfig(self::XML_PATH_EMAIL_RECIPIENT), 
                null, 
                array(
                    'store'      => $store,
                    'department' => $store->getConfig(self::XML_PATH_EMAIL_IDENTITY),
                    'data'       => $data
                )
            );
        if ($mail->getSentSuccess()) {
            $return = true;
        }

        if($store->getConfig(self::XML_PATH_CONFIRM)) {
            unset($mail);
            $mail = Mage::getModel('core/email_template');
            $mail->setDesignConfig(array('area'=>'frontend', 'store' => $this->getStoreId()))
                ->sendTransactional(
                    $store->getConfig(self::XML_PATH_USER_EMAIL_TEMPLATE), 
                    $store->getConfig(self::XML_PATH_EMAIL_IDENTITY),
                    $data->getEmail(), 
                    null, 
                    array(
                        'store'      => $store,
                        'department' => $store->getConfig(self::XML_PATH_EMAIL_IDENTITY),
                        'data'       => $data
                    )
                );
            if ($mail->getSentSuccess()) {
                $return = true;
            }
        }

        return $return;
    }

}
