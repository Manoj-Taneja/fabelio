<?php
class Magestore_Inventorylowstock_Model_Config_Times {
    public function toOptionArray()
    {
        for($i = 0;$i<=23;$i++){
                $i = sprintf("%02d", $i);
            $times[$i]= $i.':00';
        }
        $arr = array();
        foreach ($times as $id=>$value) {
            $arr[] = array('value'=>$id, 'label'=>$value);
        }
        return $arr;
    }
    
}
?>
