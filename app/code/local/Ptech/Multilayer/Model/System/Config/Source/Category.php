<?php
/**
 * Ptech Multi Select Layer Navigation
 *  
 * @category     Ptech
 * @package      Ptech_Multilayer 
 * @copyright    Copyright (c) 2014-2015 Ptech
 * @author       Ptech (Brijesh Kumar)  
 * @version      Release: 1.0.0
 * @Class        Ptech_Multilayer_Model_System_Config_Source_Category
 * @Overwrite    Varien_Object
 */ 

class Ptech_Multilayer_Model_System_Config_Source_Category extends Varien_Object
{
    public function toOptionArray()
    {
        $options = array();
        
        $options[] = array(
                'value'=> 'breadcrumbs',
                'label' => Mage::helper('multilayer')->__('Breadcrumbs')
        );
        $options[] = array(
                'value'=> 'none',
                'label' => Mage::helper('multilayer')->__('None')
        );
        
        return $options;
    }
} 
