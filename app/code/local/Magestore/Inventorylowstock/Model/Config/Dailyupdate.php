<?php
class Magestore_Inventorylowstock_Model_Config_Dailyupdate {
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label'=>Mage::helper('inventorylowstock')->__('Yes')),
            array('value' => 2, 'label'=>Mage::helper('inventorylowstock')->__('No'))            
        );
    }
    
}
?>
