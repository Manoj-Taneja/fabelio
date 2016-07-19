<?php
/**
 * Ptech Multi Select Layer Navigation
 *  
 * @category     Ptech
 * @package      Ptech_Multilayer 
 * @copyright    Copyright (c) 2014-2015 Ptech
 * @author       Ptech (Brijesh Kumar)  
 * @version      Release: 1.0.0
 * @Class        Ptech_Multilayer_Model_System_Config_Source_Swatches
 * @Overwrite    Varien_Object
 */ 

class Ptech_Multilayer_Model_System_Config_Source_Swatches extends Varien_Object
{
    public function toOptionArray()
    {
        $options = array();
        
        $options[] = array(
                'value'=> 'link',
                'label' => Mage::helper('multilayer')->__('Links Only')
        );
        $options[] = array(
                'value'=> 'icons',
                'label' => Mage::helper('multilayer')->__('Icons Only')
        );
        $options[] = array(
                'value'=> 'iconslinks',
                'label' => Mage::helper('multilayer')->__('Both Icons and Links')
        );
        
        return $options;
    }
} 
