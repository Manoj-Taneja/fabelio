<?php
class Magestore_Inventorylowstock_Model_Config_Specificmonths {

    public function toOptionArray($isMultiselect=false)
    {
        $months = array('1'=>Mage::helper('inventorylowstock')->__('January'),
            '2'=>Mage::helper('inventorylowstock')->__('February'),
            '3'=>Mage::helper('inventorylowstock')->__('March'),
            '4'=>Mage::helper('inventorylowstock')->__('April'),
            '5'=>Mage::helper('inventorylowstock')->__('May'),
            '6'=>Mage::helper('inventorylowstock')->__('June'),
            '7'=>Mage::helper('inventorylowstock')->__('July'),
            '8'=>Mage::helper('inventorylowstock')->__('August'),
            '9'=>Mage::helper('inventorylowstock')->__('September'),
            '10'=>Mage::helper('inventorylowstock')->__('October'),
            '11'=>Mage::helper('inventorylowstock')->__('November'),
            '12'=>Mage::helper('inventorylowstock')->__('December'));
        $options = array();
        foreach($months as $id => $value){
            $options[] =  array('value'=>$id, 'label'=>$value);
        }
       
        return $options;
    }
    
}
?>
