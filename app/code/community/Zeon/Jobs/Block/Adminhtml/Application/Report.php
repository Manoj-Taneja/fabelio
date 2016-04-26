<?php
/**
 * Zeon Solutions, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Zeon Solutions License
 * that is bundled with this package in the file LICENSE_ZE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.zeonsolutions.com/license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zeonsolutions.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * versions in the future. If you wish to customize this extension for your
 * needs please refer to http://www.zeonsolutions.com for more information.
 *
 * @category    Zeon
 * @package     Zeon_Jobs
 * @copyright   Copyright (c) 2012 Zeon Solutions, Inc. All Rights Reserved.(http://www.zeonsolutions.com)
 * @license     http://www.zeonsolutions.com/license/
 */
class Zeon_Jobs_Block_Adminhtml_Application_Report extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Instantiate and prepare collection
     *
     * @return Zeon_Jobs_Block_Adminhtml_Application_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('zeon_jobs/Application_collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    /**
     * Define grid columns
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'application_id', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('ID'),
                'type'  => 'number',
                'width'    => '1',
                'index'    => 'application_id',
            )
        );

        $this->addColumn(
            'resume_title', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Resume Title'),
                'type'   => 'text',
                'index'    => 'resume_title',
            )
        );

        $this->addColumn(
            'job_code', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Job Code'),
                'type'   => 'text',
                'index'    => 'job_code',
            )
        );

        $this->addColumn(
            'firstname', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('First Name'),
                'type'   => 'text',
                'index'    => 'firstname',
            )
        );

        $this->addColumn(
            'lastname', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Last Name'),
                'type'   => 'text',
                'index'    => 'lastname',
            )
        );

        $this->addColumn(
            'email', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Email'),
                'type'   => 'text',
                'index'    => 'email',
            )
        );

        $this->addColumn(
            'telephone', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Telephone'),
                'type'   => 'text',
                'index'    => 'telephone',
            )
        );

        $this->addColumn(
            'covering_letter', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Covering Letter'),
                'type'   => 'text',
                'index'    => 'covering_letter',
            )
        );

        $this->addColumn(
            'upload_resume', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Resume'),
                'type'   => 'text',
                'index'    => 'upload_resume',
            )
        );

        $this->addColumn(
            'creation_time', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Applied Time'),
                'type'    => 'datetime',
                'index'    => 'creation_time',
            )
        );
        return parent::_prepareColumns();
    }
}