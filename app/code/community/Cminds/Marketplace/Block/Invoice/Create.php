<?php
class Cminds_Marketplace_Block_Invoice_Create extends Mage_Core_Block_Template {
    public function getOrder() {
        $id = Mage::registry('order_id');
        return Mage::getModel('sales/order')->load($id);
    }
    public function getItems() {
        $id = Mage::registry('order_id');
        $_order = Mage::getModel('sales/order')->load($id);
        $_items = array();

        foreach($_order->getAllItems() AS $item) {
            $product = Mage::getModel('catalog/product')->load($item->getProductId());

            if($product->getCreatorId() == Mage::helper('marketplace')->getSupplierId()) {
                $_items[] = $item;
            }
        }

        return $_items;
    }
}