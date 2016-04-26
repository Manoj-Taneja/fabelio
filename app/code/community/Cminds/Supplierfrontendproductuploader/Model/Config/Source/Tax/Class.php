<?php
class Cminds_Supplierfrontendproductuploader_Model_Config_Source_Tax_Class {
    public function toOptionArray() {
        $collection = Mage::getModel('tax/class')->getCollection();
        $allSet = array();

        foreach($collection AS $tax) {
            $allSet[] = array('value' => $tax->getClassId(), 'label' => $tax->getClassName());
        }

        return $allSet;
    }
}
