<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */ 
class Amasty_Xlanding_Block_Adminhtml_Page_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('ruleTabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('amlanding')->__('Landing Page'));
    }

    protected function _beforeToHtml()
    {
        $tabs = array(            
                'main' => 'General',
                'meta' => 'Meta',
                'design' => 'Design',
                'filter' => 'Conditions'
        );
        
        foreach ($tabs as $code => $label){
            $label = Mage::helper('amlanding')->__($label);
            $content = $this->getLayout()->createBlock('amlanding/adminhtml_page_edit_tab_' . $code)
                ->setTitle($label)
                ->toHtml();
                
            $this->addTab($code, array(
                'label'     => $label,
                'content'   => $content,
            ));
        }
        
        return parent::_beforeToHtml();
    }
}