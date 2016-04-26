<?php

class Cminds_Marketplace_Model_Shipping_Calculate_Options {
    public function toOptionArray()
    {
        return array(
                array(
                        'value'     => '1',
                        'label'     => Mage::helper('marketplace')->__('Total Shipping Cost of All Suppliers'),
                ),
                array(
                        'value'     => '2',
                        'label'     => Mage::helper('marketplace')->__('Highest Value'),
                ),
        );
    }
	
	public function supplierOptions(){
		return array(
				array(
                        'value'     => '1',
                        'label'     => Mage::helper('marketplace')->__('Fixed Price. Free Shipment Above'),
                ),
                array(
                        'value'     => '2',
                        'label'     => Mage::helper('marketplace')->__('Table Rate Shipping'),
                ),
                array(
                        'value'     => '3',
                        'label'     => Mage::helper('marketplace')->__('Per Item'),
                ),
        );
	}
}