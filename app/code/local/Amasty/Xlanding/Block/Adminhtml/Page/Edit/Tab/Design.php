<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
class Amasty_Xlanding_Block_Adminhtml_Page_Edit_Tab_Design 
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        parent::__construct();
        $this->setShowGlobalIcon(true);
    }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('page_');

        $model = Mage::registry('amlanding_page');
        
        /* @var $helper Amasty_Xlanding_Helper_Data */
        $helper = Mage::helper('amlanding');
        
        /*
         * Menu 
         */
        
        /*
        $fieldset = $form->addFieldset('menu', array(
            'legend' => Mage::helper('amlanding')->__('Menu'),
        ));
        
        $fieldset->addField('include_menu', 'select', array(
            'label'     => $helper->__('Include In Top Menu'),
            'title'     => $helper->__('Include In Top Menu'),
            'name'      => 'include_menu',
            'options'   => $helper->getMenuPositions()
        ));
        
        $fieldset->addField('include_menu_position', 'text', array(
            'label'     => $helper->__('Sort Order'),
            'title'     => $helper->__('Sort Order'),
        	'note'      => $helper->__('Specify order of landing pages included in top menu'),
            'name'      => 'include_menu_position',
        ));
        */
        
        /*
         * Page Design
         */
        $fieldset = $form->addFieldset('page_design', array(
          'legend' => Mage::helper('amlanding')->__('Page Design'),
        ));
        
        $fieldset->addField('columns_count', 'text', array(
          'name'     => 'columns_count',
          'label'    => $helper->__('Columns Count'),
        	'note'     => $helper->__('Count of columns in products grid')
        ));
        
        $fieldset->addField('include_navigation', 'select', array(
          'name'     => 'include_navigation',
          'label'    => $helper->__('Include Navigation'),
          'values'   => Mage::getSingleton('amlanding/source_navigation')->toFlatArray(),
        ));
        
    	  $options = Mage::getResourceModel('cms/block_collection')->load();
        $identifiersList = array();
        $identifiersList[] = array(
          'value' => '',
          'label' => Mage::helper('amlanding')->__('Please select a static block ...')
        );
        foreach ($options as $option) {
          $identifiersList[] = array(
            'value' => $option->getIdentifier(),
            'label' => $option->getTitle()
          );
        }
        
        $fieldset->addField('layout_heading', 'text', array(
          'name'     => 'layout_heading',
          'label'    => $helper->__('Heading'),
        ));
        
        $fieldset->addField('layout_file', 'image', array(
          'name'     => 'layout_file',
          'note' => $helper->__('Supported formats: jpg,jpeg,gif,png'),
          'label'    => $helper->__('Image'),
          'attributes'   => array('accepts'=>'.jpg,.jpeg,.gif,.png'),
        ));
        
        $fieldset->addField('layout_file_mobile', 'image', array(
          'name'     => 'layout_file_mobile',
          'note' => $helper->__('Supported formats: jpg,jpeg,gif,png'),
          'label'    => $helper->__('Image for Mobile'),
        ));
        
        $fieldset->addField('layout_file_alt', 'text', array(
          'name'     => 'layout_file_alt',
          'label'    => $helper->__('Image Alt'),
        ));

        $fieldset->addField('video_link', 'text', array(
          'name'     => 'video_link',
          'label'    => $helper->__('Video Link ID'),
        	'note'     => $helper->__('Add youtube video link ID, Ex. <strong>R38fWPlIrFo</strong> of "https://www.youtube.com/watch?v=R38fWPlIrFo"')
        ));
        
        
        $fieldset->addField('layout_description', 'editor', array(
          'name' => 'layout_description',
          'label' =>$helper->__('Top Description'),
          'title' => $helper->__('Top Description'),
          'style' => 'height:12em;width:500px;',
          'wysiwyg' => true,
          'required' => false,
          'config' => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
        ));
                
        $fieldset->addField('layout_footer', 'editor', array(
          'name' => 'layout_footer',
          'label' =>$helper->__('Bottom Description'),
          'title' => $helper->__('Bottom Description'),
          'style' => 'height:12em;width:500px;',
          'wysiwyg' => true,
          'required' => false,
          'config' => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
        ));
                
        $fieldset->addField('layout_static_top', 'select', array(
          'name'     => 'layout_static_top',
          'label'    => Mage::helper('amlanding')->__('Top Static Block'),
          'values'   => $identifiersList,
        	'note'    => Mage::helper('amlanding')->__('Choose Static Block to show Above Products List'),
        ));
        
        $fieldset->addField('layout_static_bottom', 'select', array(
          'name'     => 'layout_static_bottom',
          'label'    => Mage::helper('amlanding')->__('Bottom Static Block'),
          'values'   => $identifiersList,
         	'note'    => Mage::helper('amlanding')->__('Choose Static Block to show Below Products List'),
        ));
        

        $attribute = Mage::getModel('eav/entity_attribute')->loadByCode("catalog_category", "default_sort_by");
        
        $this->_setFieldset(array($attribute), $fieldset);
        
        $dateFormatIso = "yyyy-MM-dd h:mm a";
        $fieldset->addField('campaign_timer', 'datetime', array(
          'name'         => 'campaign_timer',
          'label'        => Mage::helper('amlanding')->__('Timer End Time'),
          'image'        => $this->getSkinUrl('images/grid-cal.gif'),
          'input_format' => $dateFormatIso,
          'format'       => $dateFormatIso,
          'time'         => true
        ));


        $uspValues = array(
          array('value' => 'warranty-365',      'label' => 'Garansi 365 Hari', 'checked'=> true),
          array('value' => 'free-delivery',     'label' => 'Pengiriman Gratis'),
          array('value' => 'return-14',         'label' => '14 Hari Pengembalian'),
          array('value' => 'cod',               'label' => 'Pembayaran di Tempat'),
          array('value' => 'installment-0',     'label' => 'Cicilan 0%'),
          array('value' => 'free-installation', 'label' => 'Gratis Instalasi Oleh Tim Kami'),
          array('value' => 'call-us',           'label' => 'Hubungi Kami 0812-611-44-200'),
        );

        $uspValue = array('free-delivery','installment-0','free-installation','call-us');

        $fieldset->addField('landing_usps', 'multiselect', array(
          'label'        => 'USPs',
          'name'         => 'landing_usps[]',
          'container_id' => 'usps-container',
          'values'       => $uspValues,
          'value'      => $uspValue
        ));
        
        /*
         * Layout Design
         */
        $layoutFieldset = $form->addFieldset('layout_fieldset', array(
          'legend' => Mage::helper('amlanding')->__('Page Layout'),
          'class'  => 'fieldset-wide',
          'expanded'  => false,
        ));
        
        $layoutFieldset->addField('root_template', 'select', array(
          'name'     => 'root_template',
          'label'    => Mage::helper('amlanding')->__('Layout'),
          'required' => true,
          'values'   => Mage::getSingleton('page/source_layout')->toOptionArray(),
        ));
        if (!$model->getId()) {
           $model->setRootTemplate(Mage::getSingleton('page/source_layout')->getDefaultValue());
        }

        $layoutFieldset->addField('content_update_template', 'select', array(
          'name'     => 'content_update_template',
          'label'    => 'Content Template',
          'required' => false,
          'values'   => array(''=>'Default', 'fabelio-looks'=>'Fabelio Looks')
        ));

        $layoutFieldset->addField('layout_update_xml', 'textarea', array(
          'name'      => 'layout_update_xml',
          'label'     => Mage::helper('amlanding')->__('Layout Update XML'),
          'style'     => 'height:24em;',
        ));
        
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
        return Mage::helper('amlanding')->__('Design');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('amlanding')->__('Design');
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
