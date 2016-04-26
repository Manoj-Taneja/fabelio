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

class Zeon_Jobs_Block_Adminhtml_Category_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Initialize job department edit page. Set management buttons
     *
     */
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_category';
        $this->_blockGroup = 'zeon_jobs';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('zeon_jobs')->__('Save Department'));
        $this->_updateButton('delete', 'label', Mage::helper('zeon_jobs')->__('Delete Department'));

        $this->_addButton(
            'save_and_edit_button', array(
            'label'   => Mage::helper('zeon_jobs')->__('Save and Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class'   => 'save'
            ), 100
        );
        $this->_formScripts[] = '
        	function saveAndContinueEdit() {
            editForm.submit($(\'edit_form\').action + \'back/edit/\');}';
    }

    /**
     * Get current loaded job department ID
     *
     */
    public function getCategoryId()
    {
        return Mage::registry('current_category')->getId();
    }

    /**
     * Get header text for job department edit page
     *
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_category')->getId()) {
            return $this->htmlEscape(Mage::registry('current_category')->getTitle());
        } else {
            return Mage::helper('zeon_jobs')->__('Job Department');
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