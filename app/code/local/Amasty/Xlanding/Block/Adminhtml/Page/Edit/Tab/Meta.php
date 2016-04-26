<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

/**
 * Customer account form block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Amasty_Xlanding_Block_Adminhtml_Page_Edit_Tab_Meta
    extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

        $model = Mage::registry('amlanding_page');

        $fieldset = $form->addFieldset('meta_fieldset', array('legend' => Mage::helper('cms')->__('Meta Data'), 'class' => 'fieldset-wide'));

        $fieldset->addField('meta_title', 'text', array(
            'name' => 'meta_title',
            'label' => Mage::helper('amlanding')->__('Title'),
            'title' => Mage::helper('amlanding')->__('Meta Title'),
        ));
        
        $fieldset->addField('meta_keywords', 'textarea', array(
            'name' => 'meta_keywords',
            'label' => Mage::helper('cms')->__('Keywords'),
            'title' => Mage::helper('cms')->__('Meta Keywords'),
        ));

        $fieldset->addField('meta_description', 'textarea', array(
            'name' => 'meta_description',
            'label' => Mage::helper('cms')->__('Description'),
            'title' => Mage::helper('cms')->__('Meta Description'),
        ));


        $form->setValues($model->getData());

        $this->setForm($form);

        return parent::_prepareForm();
    }
}
