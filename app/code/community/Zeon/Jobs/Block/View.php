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
class Zeon_Jobs_Block_View extends Mage_Core_Block_Template
{
    protected $_job;
    /**
     * Retrieve Jobs instance
     *
     * @return Zeon_Jobs_Model_Jobs
     */
    public function getJob()
    {
        $jobId = $this->getRequest()->getParam('job_id', false);
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

    /**
     * Prepare global layout
     *
     * @return Zeon_Jobs_Block_View
     */
    protected function _prepareLayout()
    {
        $job = $this->getJob();
        $helper = Mage::helper('zeon_jobs');
        // show breadcrumbs
        if ($breadcrumbs = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbs->addCrumb(
                    'home', 
                    array(
                        'label'=>$helper->__('Home'), 
                        'title'=>$helper->__('Go to Home Page'), 
                        'link'=>Mage::getBaseUrl()
                    )
                );
                $breadcrumbs->addCrumb(
                    'jobs_list', 
                    array(
                        'label'=>$helper->__('Careers'), 
                        'title'=>$helper->__('Careers'), 
                        'link'=>$this->getUrl('careers')
                    )
                );
                $breadcrumbs->addCrumb('jobs_view', array('label'=>$job->getTitle(), 'title'=>$job->getTitle()));
        }

        $head = $this->getLayout()->getBlock('head');
        if ($head) {
            $head->setTitle($job->getTitle());
            $head->setKeywords($job->getMetaKeywords() ? $job->getMetaKeywords() : $helper->getDefaultMetaKeywords());
            $head->setDescription(
                $job->getMetaDescription() ? $job->getMetaDescription() : $helper->getDefaultMetaDescription()
            );
        }

        return parent::_prepareLayout();
    }
}