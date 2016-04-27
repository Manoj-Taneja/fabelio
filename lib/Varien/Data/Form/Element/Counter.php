<?php

class Varien_Data_Form_Element_Counter extends Varien_Data_Form_Element_Abstract
{
    /**
     * @param array $data
     */
    public function __construct($data)
    {
        parent::__construct($data);
        $this->setType('checkbox');
        $this->setValue('0');
    }
    
    public function getCanUseWebsiteValue()
    {
        return false;
    }
    
    public function getCanUseDefaultValue()
    {
        return false;
    }
    
    public function getScope()
    {
        return false;
    }

}
