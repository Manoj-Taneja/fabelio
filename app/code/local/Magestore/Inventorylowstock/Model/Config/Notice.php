<?php
class Magestore_Inventorylowstock_Model_Config_Notice {
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label'=>Mage::helper('inventorylowstock')->__('ONLY WAREHOUSE')),
            array('value' => 2, 'label'=>Mage::helper('inventorylowstock')->__('ONLY SYSTEM')),
            array('value' => 3, 'label'=>Mage::helper('inventorylowstock')->__('BOTH WAREHOUSE AND SYSTEM')),
        );
    }
    
}
?>
