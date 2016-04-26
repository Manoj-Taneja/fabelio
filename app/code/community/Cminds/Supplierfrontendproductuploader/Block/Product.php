<?php
class Cminds_Supplierfrontendproductuploader_Block_Product extends Mage_Core_Block_Template {
    protected $_product;

    public function setProduct($product) {
        $this->_product = $product;
    }

    public function getProduct() {
        return $this->_product;
    }

    public function getProductObject() {
        $id = Mage::registry('supplier_product_id');

        Mage::unregister('supplier_product_id');
        $product = Mage::getModel('catalog/product')
            ->setStore(Mage::app()->getStore()->getId())
            ->load($id);

        return $product;
    }

    public function getProductAttributes($product) {
        $data = array();
        $attributes = $product->getAttributes();
        foreach ($attributes as $attribute) {
            $value = $attribute->getFrontend()->getValue($product);
            $data[$attribute->getAttributeCode()] = $value;
        }
        return $data;
    }
}
