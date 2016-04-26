<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2010-2013 Amasty (http://www.amasty.com)
*/
class Amasty_Number_Model_Source_Offset
{
    public function toOptionArray()
    {
        $options = array(); 
        
        for ($i = -12; $i <= 12; $i++){
            $v = $i > 0 ? "+$i" : $i;
            $hours = ($i==1 || $i==-1) ? '%s hour': '%s hours';
            
            $options[] = array(
                'value' => $v,
                'label' => Mage::helper('amnumber')->__($hours, $v),
            );
        }
        return $options;
    }
}