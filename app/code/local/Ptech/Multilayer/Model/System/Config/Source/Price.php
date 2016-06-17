<?php
/**
 * Ptech Multi Select Layer Navigation
 *  
 * @category     Ptech
 * @package      Ptech_Multilayer 
 * @copyright    Copyright (c) 2014-2015 Ptech
 * @author       Ptech (Brijesh Kumar)  
 * @version      Release: 1.0.0
 * @Class        Ptech_Multilayer_Model_System_Config_Source_Price
 * @Overwrite    Varien_Object
 */ 

class Ptech_Multilayer_Model_System_Config_Source_Price extends Varien_Object
{
    public function toOptionArray()
    {
        $options = array();
        
        $options[] = array(
                'value'=> 'default',
                'label' => Mage::helper('multilayer')->__('Default')
        );
        $options[] = array(
                'value'=> 'slider',
                'label' => Mage::helper('multilayer')->__('Slider')
        );
        $options[] = array(
                'value'=> 'input',
                'label' => Mage::helper('multilayer')->__('Input')
        );
        
        $options[] = array(
                'value'=> 'sliderinput',
                'label' => Mage::helper('multilayer')->__('Both Slider and Input')
        );
        return $options;
    }
} 
