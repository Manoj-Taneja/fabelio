<?php

class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Renderer_Total extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {        
        $currency = $row->getCurrency();
        if(!$currency)
            $currency = Mage::app()->getStore()->getBaseCurrencyCode();			
        return Mage::getModel('directory/currency')->load($currency)->formatTxt($row->getTotalAmount());               
    }

}

?>
