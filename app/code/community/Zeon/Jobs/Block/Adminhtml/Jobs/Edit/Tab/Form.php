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

class Zeon_Jobs_Block_Adminhtml_Jobs_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Load Wysiwyg on demand and Prepare layout
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

    /**
     * Set form id prefix, set values if jobs is editing
     *
     * @return Zeon_Jobs_Block_Adminhtml_Jobs_Edit_Tab_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $htmlIdPrefix = 'job_information_';
        $form->setHtmlIdPrefix($htmlIdPrefix);
        $fieldsetHtmlClass = 'fieldset-wide';
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')
            ->getConfig(
                array(
                    'tab_id' => $this->getTabId(),
                )
            );

        /* @var $model Zeon_Jobs_Model_Jobs */
        $model = Mage::registry('current_job');
        $contents = $model->getDescription();
        $sortContents = $model->getShortDescription();

        $fieldset = $form->addFieldset(
            'base_fieldset', 
            array(
                'legend'=>Mage::helper('zeon_jobs')->__('Job Information'),
                'class'    => $fieldsetHtmlClass,
            )
        );

        if ($model->getJobId()) {
            $fieldset->addField(
                'job_id', 
                'hidden', 
                array(
                    'name'    => 'job_id',
                )
            );
        }

        $fieldset->addField(
            'title', 
            'text', 
            array(
                'label'        => Mage::helper('zeon_jobs')->__('Title'),
                'name'        => 'title',
                'required'  => true,
            )
        );

        $fieldset->addField(
            'job_code', 
            'text', 
            array(
                'label'        => Mage::helper('zeon_jobs')->__('Job Code'),
                'name'        => 'job_code',
                'required'  => true,
            )
        );

        $fieldset->addField(
            'identifier', 
            'text', 
            array(
                'label'        => Mage::helper('zeon_jobs')->__('Identifier'),
                'name'        => 'identifier',
            )
        );

        $options[] = array(
            'value'     => '',
            'label'     => '',
        );

        $fieldset->addField(
            'category_id', 
            'select', 
            array(
                'label'    => Mage::helper('zeon_jobs')->__('Department'),
                'name'    => 'category_id',
                'values'=> array_merge(
                    $options, Mage::getResourceSingleton('zeon_jobs/category_collection')
                    ->addFieldToFilter('status', 1)
                    ->addOrder('title', 'asc')
                    ->toOptionArray()
                ),
            )
        );

        $fieldset->addField(
            'status', 'select', array(
            'label'     => Mage::helper('zeon_jobs')->__('Status'),
            'name'      => 'status',
            'required'  => true,
            'disabled'  => (bool)$model->getIsReadonly(),
            'options'   => Mage::getModel('zeon_jobs/status')->getAllOptions(),
            )
        );

        if (!$model->getId()) {
            $model->setData('status', Zeon_Jobs_Model_Status::STATUS_ENABLED);
        }
          /**
         * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField(
                'store_ids', 
                'multiselect', 
                array(
                    'name'      => 'store_ids[]',
                    'label'     => Mage::helper('zeon_jobs')->__('Visible In'),
                    'required'  => true,
                    'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
                    'value'        => $model->getStoreIds(),
                )
            );
        } else {
            $fieldset->addField(
                'store_id', 
                'hidden', 
                array(
                    'name'    => 'store_ids[]',
                    'value'    => Mage::app()->getStore(true)->getId()
                )
            );
            $model->setStoreIds(Mage::app()->getStore(true)->getId());
        }

        $fieldset->addField(
            'short_description', 
            'editor', 
            array(
                'name'      => 'short_description',
                'label'     => Mage::helper('zeon_jobs')->__('Short Job Description'),
                'title'     => Mage::helper('zeon_jobs')->__('Short Job Description'),
                'style'     => 'height:18em',
                'required'  => true,
                'config'    => $wysiwygConfig,
            )
        );

        $fieldset->addField(
            'description', 
            'editor', 
            array(
                'name'      => 'description',
                'label'     => Mage::helper('zeon_jobs')->__('Job Description, Experience and Qualifications'),
                'title'     => Mage::helper('zeon_jobs')->__('Job Description, Experience and Qualifications'),
                'style'     => 'height:36em',
                'required'  => true,
                'config'    => $wysiwygConfig,
            )
        );

        $fieldset->addField(
            'sort_order', 
            'text', 
            array(
                'label'        => Mage::helper('zeon_jobs')->__('Sort Order'),
                'title'        => Mage::helper('zeon_jobs')->__('Sort Order'),
                'name'        => 'sort_order',
            )
        );

        $form->setValues($model->getData());
        $this->setForm($form);
        return $this;
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