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

class Zeon_Jobs_Block_Adminhtml_Jobs_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Initialize jobs edit page. Set management buttons
     *
     */
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_jobs';
        $this->_blockGroup = 'zeon_jobs';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('zeon_jobs')->__('Save Job'));
        $this->_updateButton('delete', 'label', Mage::helper('zeon_jobs')->__('Delete Job'));

        $this->_addButton(
            'save_and_edit_button', array(
                'label'   => Mage::helper('zeon_jobs')->__('Save and Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save'
            ), 100
        );
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('job_information_short_description') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'job_information_short_description');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'job_information_short_description');
                }
                if (tinyMCE.getInstanceById('job_information_description') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'job_information_description');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'job_information_description');
                }
            }

            function saveAndContinueEdit() {
            editForm.submit($('edit_form').action + 'back/edit/');}";
    }

    /**
     * Get current loaded job ID
     *
     */
    public function getJobId()
    {
        return Mage::registry('current_job')->getId();
    }

    /**
     * Get header text for job edit page
     *
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_job')->getId()) {
            return $this->htmlEscape(Mage::registry('current_job')->getTitle());
        } else {
            return Mage::helper('zeon_jobs')->__('New Job');
        }
    }

    /**
     * Get form action URL
     *
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('*/*/save');
    }
}