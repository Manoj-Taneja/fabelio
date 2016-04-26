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

class Zeon_Jobs_Adminhtml_Jobs_ListController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Job list
     *
     * @return void
     */
    public function indexAction()
    {
        $this->_title($this->__('Zeon Extensions'))->_title($this->__('Jobs'));
        $this->loadLayout();
        $this->_setActiveMenu('zextension/zeon_jobs');
        $this->renderLayout();
    }

    /**
     * Create new job
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit action
     *
     */
    public function editAction()
    {
        $id     = $this->getRequest()->getParam('id');
        $model = $this->_initJob('id');
        $model  = Mage::getModel('zeon_jobs/jobs')->load($id);

        if (!$model->getId() && $id) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('zeon_jobs')->__('This job no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $this->_title($model->getId() ? $model->getTitle() : $this->__('Add Job'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        $this->loadLayout();
        $this->_setActiveMenu('zextension/zeon_jobs');
        $this->_addBreadcrumb(
            $id ? Mage::helper('zeon_jobs')->__('Edit Job') : Mage::helper('zeon_jobs')->__('Add Job'),
            $id ? Mage::helper('zeon_jobs')->__('Edit Job') : Mage::helper('zeon_jobs')->__('Add Job')
        )
            ->renderLayout();
    }

    /**
     * Save action
     */
    public function saveAction()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        if ($data = $this->getRequest()->getPost()) {
            $id = $this->getRequest()->getParam('id');
            $model = $this->_initJob();

            if (!$model->getId() && $id) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('zeon_jobs')->__('This job no longer exists.')
                );
                $this->_redirect('*/*/');
                return;
            }
            $identifier = $data['identifier'] ? $data['identifier'] : $data['title'];
            $data['identifier'] = Mage::getModel('zeon_jobs/url')->formatUrlKey($identifier);
            // save model
            try {
                if (!empty($data)) {
                    $model->addData($data);
                    Mage::getSingleton('adminhtml/session')->setFormData($data);
                }
                $model->save();
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('zeon_jobs')->__('The job has been saved.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            } catch (Exception $e) {
                $this->_getSession()->addError(Mage::helper('zeon_jobs')->__('Unable to save the job.'));
                $redirectBack = true;
                Mage::logException($e);
            }
            if ($redirectBack) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
            }
        }
        $this->_redirect('*/*/');
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
            $model = Mage::getModel('zeon_jobs/jobs');
            $model->load($id);
            $model->delete();
            // display success message
            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('zeon_jobs')->__('The job has been deleted.')
            );
            // go to grid
            $this->_redirect('*/*/');
            return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('zeon_jobs')->__(
                        'An error occurred while deleting job data. Please review log and try again.'
                    )
                );
                Mage::logException($e);
                // save data in session
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                // redirect to edit form
                $this->_redirect('*/*/edit', array('id' => $id));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('zeon_jobs')
            ->__('Unable to find a job to delete.')
        );
        // go to grid
        $this->_redirect('*/*/');
    }

    /**
     * Delete specified job(s) using grid massaction
     *
     */
    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('jobs');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select job(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('zeon_jobs/jobs')->load($id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess($this->__('Total of %d record(s) have been deleted.', count($ids)));
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('zeon_jobs')->__(
                        'An error occurred while mass deleting job. Please review log and try again.'
                    )
                );
                Mage::logException($e);
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

     /**
     * Update specified job(s) status using grid massaction
     *
     */
    public function massStatusAction()
    {
        $ids = $this->getRequest()->getParam('jobs');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select job(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('zeon_jobs/jobs')->load($id);
                    $model->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d record(s) have been updated', count($ids)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('zeon_jobs')->__(
                        'An error occurred while mass updating job. Please review log and try again.'
                    )
                );
                Mage::logException($e);
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Load Job from request
     *
     * @param string $idFieldName
     * @return Zeon_Jobs_Model_Jobs $model
     */
    protected function _initJob($idFieldName = 'job_id')
    {
        $id = (int)$this->getRequest()->getParam($idFieldName);
        $model = Mage::getModel('zeon_jobs/jobs');
        if ($id) {
            $model->load($id);
        }
        if (!Mage::registry('current_job')) {
            Mage::register('current_job', $model);
        }
        return $model;
    }

    /**
     * Render Jobs grid
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}