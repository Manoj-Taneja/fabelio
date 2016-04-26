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
class Zeon_Jobs_Block_List extends Mage_Core_Block_Template
{
    protected $_defaultToolbarBlock = 'zeon_jobs/list_toolbar';

    protected $_jobsCollection;
    /**
     * Retrieve Jobs collection
     *
     * @return Zeon_Jobs_Model_Resource_Jobs_Collection
     */
    protected function _getJobsCollection()
    {
        if (is_null($this->_jobsCollection)) {
            $this->_jobsCollection = Mage::getResourceModel('zeon_jobs/jobs_collection')
                                    ->distinct(true)
                                    ->addStoreFilter(Mage::app()->getStore()->getId())
                                    ->addFieldToFilter('status', Zeon_Jobs_Model_Status::STATUS_ENABLED);
            if ($categoryId = $this->getRequest()->getParam('category', null)) {
                $this->_jobsCollection = $this->_jobsCollection->addFieldToFilter('category_id', $categoryId);
            }
        }

        return $this->_jobsCollection;
    }
    /**
     * Retrieve loaded Jobs collection
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    public function getJobsCollection()
    {
        return $this->_getJobsCollection();
    }
    /**
     * Prepare global layout
     *
     * @return Zeon_Faq_Block_List
     */
    protected function _prepareLayout()
    {
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
                if ($categoryId = $this->getRequest()->getParam('category', null)) {
                    $breadcrumbs->addCrumb(
                        'job_list', 
                        array(
                            'label'=>$helper->__('Careers'), 
                            'title'=>$helper->__('Careers'), 
                            'link'=>Mage::getUrl('careers')
                        )
                    );
                    $categoryTitle = Mage::getResourceModel('zeon_jobs/category')->getJobCategoryTitleById($categoryId);
                    $breadcrumbs->addCrumb('job_category', array('label'=>$categoryTitle, 'title'=>$categoryTitle));
                } else {
                    $breadcrumbs->addCrumb(
                        'job_list', 
                        array(
                            'label'=>$helper->__('Careers'), 
                            'title'=>$helper->__('Careers')
                        )
                    );
                }
        }

        $head = $this->getLayout()->getBlock('head');
        if ($head) {
            $head->setTitle($helper->getDefaultTitle());
            $head->setKeywords($helper->getDefaultMetaKeywords());
            $head->setDescription($helper->getDefaultMetaDescription());
        }
        return parent::_prepareLayout();
    }

    public function getMode()
    {
        return $this->getChild('toolbar')->getCurrentMode();
    }

    protected function _beforeToHtml()
    {
        $toolbar = $this->getToolbarBlock();

        // called prepare sortable parameters
        $collection = $this->_getJobsCollection();

        // use sortable parameters
        if ($orders = $this->getAvailableOrders()) {
            $toolbar->setAvailableOrders($orders);
        }
        if ($sort = $this->getSortBy()) {
            $toolbar->setDefaultOrder($sort);
        }
        if ($dir = $this->getDefaultDirection()) {
            $toolbar->setDefaultDirection($dir);
        }
        if ($modes = $this->getModes()) {
            $toolbar->setModes($modes);
        }

        // set collection to toolbar and apply sort
        $toolbar->setCollection($collection);

        $this->setChild('toolbar', $toolbar);

        $categoryId = $this->getRequest()->getParam('category', null);
        $model = Mage::getModel('zeon_jobs/category');
        if ($categoryId) {
            $category = $model->load($categoryId);
            $this->setCurrentCategory($category);
        }

        return parent::_beforeToHtml();
    }

    public function getToolbarBlock()
    {
        if ($blockName = $this->getToolbarBlockName()) {
            if ($block = $this->getLayout()->getBlock($blockName)) {
                return $block;
            }
        }
        $block = $this->getLayout()->createBlock($this->_defaultToolbarBlock, microtime());
        return $block;
    }

    public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }

    public function setCollection($collection)
    {
        $this->_jobsCollection = $collection;
        return $this;
    }
    /**
     * Set current category.
     *
     * @return object
     */
    public function setCurrentCategory($category)
    {
        $this->_category = $category;
        return $this;
    }
    /**
     * Get current category.
     *
     * @return object
     */
    public function getCurrentCategory()
    {
        return $this->_category;
    }
}