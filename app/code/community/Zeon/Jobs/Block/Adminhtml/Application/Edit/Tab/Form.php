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

class Zeon_Jobs_Block_Adminhtml_Application_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Set form id prefix, set values if jobs is editing
     *
     * @return Zeon_Jobs_Block_Adminhtml_Application_Edit_Tab_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $htmlIdPrefix = 'job_application_';
        $form->setHtmlIdPrefix($htmlIdPrefix);
        $fieldsetHtmlClass = 'fieldset-wide';
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('tab_id' => $this->getTabId()));

        $model = Mage::registry('current_application');
        $contents = $model->getData();

        Mage::dispatchEvent(
            'adminhtml_application_edit_tab_form_before_prepare_form',
            array('model' => $model, 'form' => $form)
        );

        // add category information fieldset
       $fieldset = $form->addFieldset(
           'base_fieldset',
           array(
               'legend'=>Mage::helper('zeon_jobs')->__('Applicant information'),
               'class'	=> $fieldsetHtmlClass,
           )
       );

        $fieldset->addField(
            'resume_title', 
            'text', 
            array(
                'label'    => Mage::helper('zeon_jobs')->__('Resume Title'),
                'name'     => 'resume_title',
                'disabled' => true,
            )
        );

        $fieldset->addField(
            'job_code', 
            'text', 
            array(
            'label'    => Mage::helper('zeon_jobs')->__('Job Code'),
            'name'     => 'job_code',
            'disabled' => true,
            )
        );

        $fieldset->addField(
            'firstname', 
            'text', 
            array(
                'label'    => Mage::helper('zeon_jobs')->__('First Name'),
                'name'     => 'firstname',
                'disabled' => true,
            )
        );

        $fieldset->addField(
            'lastname', 
            'text', 
            array(
            'label'    => Mage::helper('zeon_jobs')->__('Last Name'),
            'name'     => 'last_name',
            'disabled' => true,
            )
        );

        $fieldset->addField(
            'email', 
            'text', 
            array(
                'label'    => Mage::helper('zeon_jobs')->__('Email'),
                'name'     => 'email_id',
                'disabled' => true,
            )
        );

        $fieldset->addField(
            'telephone', 
            'text', 
            array(
                'label'    => Mage::helper('zeon_jobs')->__('Telephone'),
                'name'     => 'telephone',
                'disabled' => true,
            )
        );

        $fieldset->addField(
            'covering_letter', 
            'textarea', 
            array(
                'label'    => Mage::helper('zeon_jobs')->__('Covering Letter'),
                'name'     => 'covering_letter',
                'disabled' => true,
            )
        );

        $fieldset->addField(
            'upload_resume', 
            'note', 
            array(
                'label'     => Mage::helper('zeon_jobs')->__('Resume'),
                'title'     => Mage::helper('zeon_jobs')->__('Resume'),
                'text'	  => '<a href="'.$this->getUrl(
                    '*/*/download', 
                    array('id'=>$this->getRequest()->getParam('id'))
                ).'">Download</a>',
                'name'      => 'upload_resume',
            )
        );

        $fieldset->addField(
            'creation_time', 
            'text', 
            array(
                'label'     => Mage::helper('zeon_jobs')->__('Applied Time'),
                'name'      => 'creation_time',
                'disabled' => true,
            )
        );

        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('zeon_jobs')->__('General Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    /**
     * Returns status flag about this tab can be showen or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }
}