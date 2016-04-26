<?php
class Cminds_Supplierfrontendproductuploader_Model_Source_Approved extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DISAPPROVED = 2;
    const STATUS_NONACTIVE = 3;

    public function getAllOptions() {
        $this->_options = array(
            array('label' => 'Pending', 'value' => self::STATUS_PENDING),
            array('label' => 'Approved', 'value' => self::STATUS_APPROVED),
            array('label' => 'Disapproved', 'value' => self::STATUS_DISAPPROVED),
            array('label' => 'Not Active', 'value' => self::STATUS_NONACTIVE),
        );
        
        return $this->_options;
    }

    public function toOptionArray() {
        return $this->getAllOptions();
    }
}