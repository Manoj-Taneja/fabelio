<?php
class Magestore_Inventorylowstock_Model_Config_Specificdays {

    public function toOptionArray($isMultiselect=false)
    {
        $days = array();
        for($i=1;$i<32;$i++){
            $days[] = array('value'=>$i, 'label'=>sprintf("%02d", $i));
        }
        
        return $days;
    }
    
}
?>
