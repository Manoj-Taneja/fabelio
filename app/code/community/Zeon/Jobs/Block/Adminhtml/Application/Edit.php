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
 * @package     Zeon_RequestQuote
 * @copyright   Copyright (c) 2012 Zeon Solutions, Inc. All Rights Reserved.(http://www.zeonsolutions.com)
 * @license     http://www.zeonsolutions.com/license/
 */

class Zeon_Jobs_Block_Adminhtml_Application_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Initialize jobs category edit page. Set management buttons
     *
     */
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_application';
        $this->_blockGroup = 'zeon_jobs';
        parent::__construct();
       $this->removeButton('save');
       $this->removeButton('reset');
        $this->_updateButton('delete', 'label', Mage::helper('zeon_jobs')->__('Delete Application'));
    }

    /**
     * Get current loaded request ID
     *
     */
    public function getApplyId()
    {
        return Mage::registry('current_application')->getId();
    }
    /**
     * Get form action URL
     *
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('*/*/save');
    }
    /**
     * Get header text for request for jobs edit page
     *
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_application')->getId()) {
            return $this->htmlEscape(Mage::registry('current_application')->getResumeTitle());
        } else {
            return Mage::helper('zeon_jobs')->__('Job Application');
        }
    }

}