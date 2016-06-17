<?php
/**
 * Ptech Multi Select Layer Navigation
 *  
 * @category     Ptech
 * @package      Ptech_Multilayer 
 * @copyright    Copyright (c) 2014-2015 Ptech
 * @author       Ptech (Brijesh Kumar)  
 * @version      Release: 1.0.0
 * @Class        Ptech_Multilayer_Model_Select
 * @Overwrite    Varien_Object
 */ 

class Ptech_Multilayer_Model_Select extends Zend_Db_Select 
{
    public function __construct()
    {
    }

    public function setPart($part, $val){
        $this->_parts[$part] = $val;
    }   
} 
