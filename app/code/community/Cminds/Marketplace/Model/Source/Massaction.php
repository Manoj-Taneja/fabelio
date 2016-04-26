<?php
class Cminds_Marketplace_Model_Source_Massaction extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {

    public function getAllOptions() {
        $this->_options = array(
            array(
                'label' => Mage::helper('adminhtml')->__('Any'),
                'value' => ''
            ),
            array(
                'label' => Mage::helper('adminhtml')->__('Yes'),
                'value' => 1
            ),
            array(
                'label' => Mage::helper('adminhtml')->__('No'),
                'value' => 0
            ),
        );
        
        return $this->_options;
    }
    public function toFilterOptions() {
        $this->_options = array(
            1 => Mage::helper('adminhtml')->__('Yes'),
            0 => Mage::helper('adminhtml')->__('No'),
        );

        return $this->_options;
    }

    public function toOptionArray() {
        return $this->getAllOptions();
    }
}