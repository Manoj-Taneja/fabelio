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
class Zeon_Jobs_Block_Apply extends Mage_Core_Block_Template
{
    /**
     * Prepare global layout
     *
     * @return Zeon_Jobs_Block_View
     */
    protected function _prepareLayout()
    {
        if ($breadcrumbs = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbs->addCrumb(
                'home', 
                array('label'=>$this->__('Home'), 'title'=>$this->__('Go to Home Page'), 'link'=>Mage::getBaseUrl())
            );
            $breadcrumbs->addCrumb(
                'jobs', 
                array('label'=>$this->__('Jobs'), 'title'=>$this->__('Jobs'), 'link'=>$this->getUrl('*'))
            );
            $breadcrumbs->addCrumb('Apply', array('label'=>$this->__('Apply'), 'title'=>$this->__('Apply')));
        }
        return parent::_prepareLayout();
    }
    /**
     * Prepare Form Url
     */
    public function getFormAction()
    {
        return Mage::getUrl(
            'jobs/index/post', 
            array('jobRefId'=>$this->getRequest()->getParam('jobRefId'))
        );
    }
}