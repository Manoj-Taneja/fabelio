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
class Zeon_Jobs_Block_Application_Form extends Mage_Core_Block_Template
{
    protected $_job;
    /**
    * Prepare global layout
    *
    * @return Zeon_Jobs_Block_Application_Form
    */
    protected function _prepareLayout()
    {
        $helper = Mage::helper('zeon_jobs');
        $job = $this->getJob();
        // show breadcrumbs
        if ($breadcrumbs = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbs->addCrumb(
                'home', array(
                    'label'=>$helper->__('Home'), 
                    'title'=>$helper->__('Go to Home Page'),
                    'link'=>Mage::getBaseUrl()
                )
            );
            $breadcrumbs->addCrumb(
                'job_list', 
                array(
                    'label'=>$helper->__('Careers'), 
                    'title'=>$helper->__('Careers'), 
                    'link'=>$this->getUrl('careers')
                )
            );
            $breadcrumbs->addCrumb(
                'job_view', 
                array(
                    'label'=>$job->getTitle(), 
                    'title'=>$job->getTitle(), 
                    'link'=>$this->getUrl('careers/'.$job->getIdentifier())
                )
            );
        }

        $head = $this->getLayout()->getBlock('head');
        if ($head) {
            $head->setTitle($job->getTitle() ? $job->getTitle() : $helper->getDefaultTitle());
            $head->setKeywords($helper->getDefaultMetaKeywords());
            $head->setDescription($helper->getDefaultMetaDescription());
        }

        return parent::_prepareLayout();
    }

    public function getFormData()
    {
        $formData = $this->getData('form_data');
        if (is_null($formData)) {
            $formData = new Varien_Object(Mage::getSingleton('zeon_requestquote/session')->getFormData(true));
            $this->setData('form_data', $formData);
        }
        return $formData;
    }

    public function getJob()
    {
        $jobCode = $this->getRequest()->getParam('ref', false);
        $jobId = Mage::getResourceModel('zeon_jobs/jobs')->checkJobCode($jobCode, Mage::app()->getStore()->getId());
        if (is_null($this->_job)) {
            if ($jobId) {
                $this->_job = Mage::getModel('zeon_jobs/jobs')
                    ->setStoreId(Mage::app()->getStore()->getId())
                    ->load($jobId);
            } else {
                $this->_job = Mage::getSingleton('zeon_jobs/jobs');
            }
        }
        return $this->_job;
    }
}