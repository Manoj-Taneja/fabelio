<?php

class Webshops4All_ShowDeliverytime_Block_Deliverytime extends Mage_Core_Block_Template
{

    protected $_product = null;

    function getProduct()
    {
        if (!$this->_product) {
            $this->_product = Mage::registry('product');
        }
        return $this->_product;
    }
}