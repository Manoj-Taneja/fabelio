<?php

class Sprint_Migs_Model_System_Config_Source_View 
{
   /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'AUTHORIZATION', 'label'=>Mage::helper('migs')->__('Authorization')),
            array('value' => 'SALE', 'label'=>Mage::helper('migs')->__('Sale')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            0 => Mage::helper('migs')->__('AUTHORIZATION'),
            1 => Mage::helper('migs')->__('SALE'),
        );
    }
}

?>