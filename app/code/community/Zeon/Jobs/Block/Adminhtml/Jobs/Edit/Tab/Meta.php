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

class Zeon_Jobs_Block_Adminhtml_Jobs_Edit_Tab_Meta extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('zeon_jobs')->__('Meta Information');
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

    /**
     * Set form id prefix, set values if jobs is editing
     *
     * @return Zeon_Jobs_Block_Adminhtml_Jobs_Edit_Tab_Meta
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $htmlIdPrefix = 'job_meta_';
        $form->setHtmlIdPrefix($htmlIdPrefix);

        $fieldsetHtmlClass = 'fieldset-wide';

        $model = Mage::registry('current_job');

        Mage::dispatchEvent(
            'adminhtml_job_edit_tab_meta_before_prepare_form',
            array('model' => $model, 'form' => $form)
        );

        // add meta information fieldset
        $fieldset = $form->addFieldset(
            'default_fieldset', 
            array(
                'legend' => Mage::helper('zeon_jobs')->__('Meta Information'),
                'class'  => $fieldsetHtmlClass,
            )
        );

       $fieldset->addField(
           'meta_keywords', 
           'textarea', 
           array(
               'name'     => 'meta_keywords',
               'label'    => Mage::helper('zeon_jobs')->__('Meta Keywords'),
               'disabled' => (bool)$model->getIsReadonly(),
           )
       );

       $fieldset->addField(
           'meta_description', 
           'textarea', 
           array(
               'name'     => 'meta_description',
               'label'    => Mage::helper('zeon_jobs')->__('Meta Description'),
               'disabled' => (bool)$model->getIsReadonly(),
           )
       );

       $form->setValues($model->getData());
       $this->setForm($form);
       return parent::_prepareForm();
    }
}