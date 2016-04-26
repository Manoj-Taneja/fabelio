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

class Zeon_Jobs_Adminhtml_Jobs_ApplicationController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Job Application list
     *
     * @return void
     */
    public function indexAction()
    {
        $this->_title($this->__('Zeon Extensions'))->_title($this->__('Jobs Applications'));
        $this->loadLayout();
        $this->_setActiveMenu('zextension/zeon_jobs');
        $this->renderLayout();
    }

    /**
     * View action
     */
    public function editAction()
    {
        $id     = $this->getRequest()->getParam('id');
        $model = $this->_initApplication('id');
        $model  = Mage::getModel('zeon_jobs/application')->load($id);

        if (!$model->getId() && $id) {
            Mage::getSingleton('adminhtml/session')
            ->addError(Mage::helper('zeon_jobs')->__('This applicantion no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }
        $this->_title($model->getId() ? $model->getTitle() : $this->__('Jobs Applicantions'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        $this->loadLayout();
        $this->_setActiveMenu('zextension/zeon_jobs');

        $this->_addBreadcrumb(
            $id ? Mage::helper('zeon_jobs')->__('Edit Applicantions') : Mage::helper('zeon_jobs')->__('Jobs Applicantions'),
            $id ? Mage::helper('zeon_jobs')->__('Edit Applicantions') : Mage::helper('zeon_jobs')->__('Jobs Applicantions')
        )
            ->renderLayout();
    }

    /**
     * Delete action
     *
     */
    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                // init model and delete
                $model = Mage::getModel('zeon_jobs/application');
                $model->load($id);
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')
                ->addSuccess(
                    Mage::helper('zeon_jobs')->__('The application has been deleted.')
                );
                // go to grid
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('zeon_jobs')
                    ->__('An error occurred while deleting job application data. Please review log and try again.')
                );
                    Mage::logException($e);
                    // save data in session
                    Mage::getSingleton('adminhtml/session')->setFormData($data);
                    // redirect to edit form
                    $this->_redirect('*/*/view', array('id' => $id));
                    return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('zeon_jobs')
            ->__('Unable to find a job application to delete.')
        );
            // go to grid
            $this->_redirect('*/*/');
    }

    /**
     * Update specified job application status using grid massaction
     *
     */
    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('applications');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select Application(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('zeon_jobs/application')->load($id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('zeon_jobs')
                    ->__('An error occurred while mass deleting jobs/event category. Please review log and try again.')
                );
                Mage::logException($e);
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Load Job Application from request
     *
     * @param string $idFieldName
     * @return Zeon_Jobs_Model_Application $model
     */
    protected function _initApplication($idFieldName = 'applicant_id')
    {
        $id = (int)$this->getRequest()->getParam($idFieldName);
        $model = Mage::getModel('zeon_jobs/application');
        if ($id) {
            $model->load($id);
        }
        if (!Mage::registry('current_application')) {
            Mage::register('current_application', $model);
        }
        return $model;
    }

    /**
     * Render Job Application grid
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Export Application grid to CSV
     */
    public function exportCsvAction()
    {
        $this->_prepareDownloadResponse(
            'jobapplications.csv',
            $this->getLayout()->createBlock('zeon_jobs/adminhtml_application_report')->getCsv()
        );
    }

    /**
     * Declare headers and content file in responce for file download
     *
     * @param string $filename
     * @param string $content set to null to avoid starting output, $contentLength should be set explicitly in that case
     * @param string $contentType
     * @param int $contentLength explicit content length, if strlen($content) isn't applicable
     */
    protected function _prepareDownloadResponse($filename, $content, $contentType = 'application/octet-stream', $contentLength = null)
    {
        $session = Mage::getSingleton('adminhtml/session');
        
        $this->getResponse()
            ->setHttpResponseCode(200)
            ->setHeader('Pragma', 'public', true)
            ->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true)
            ->setHeader('Content-type', $contentType, true)
            ->setHeader('Content-Length', is_null($contentLength) ? strlen($content) : $contentLength)
            ->setHeader('Content-Disposition', 'attachment; filename=' . $filename)
            ->setHeader('Last-Modified', date('r'));
        if (!is_null($content)) {
            $this->getResponse()->setBody($content);
        }
        return $this;
    }

    /**
     * Download action
     *
     */
    public function downloadAction()
    {
        $model = Mage::getModel('zeon_jobs/application')
            ->setId($this->getRequest()->getParam('id'));
        /* @var $model Zeon_Jobs_Model_Application */

        if (!$model->isFileExists()) {
            $this->_redirect('*/*');
        }

        $filename = $model->getFilename();
        $this->_prepareDownloadResponse($filename, null, 'application/octet-stream', $model->getSize());
        $this->getResponse()->sendHeaders();
        $model->output();
        exit;
    }

}
