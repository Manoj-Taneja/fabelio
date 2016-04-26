<?php
class Cminds_Supplierfrontendproductuploader_Model_Config_Source_Availbility_Sku {
    const NOT_ALLOWED = 0;
    const ALL = 2;

    public function toOptionArray() {
        $options = array(
            array('value' => self::NOT_ALLOWED, 'label' => Mage::helper('supplierfrontendproductuploader')->__('Not allowed')),
            array('value' => self::ALL, 'label' => Mage::helper('supplierfrontendproductuploader')->__('Allowed'))
        );
        return $options;
    }
}
