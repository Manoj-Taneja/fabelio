<?php
class Cminds_Marketplace_Model_Product_Configurable extends Mage_Core_Model_Abstract {
    private $_product;

    public function setProduct($_product) {
        $this->_product = $_product;
    }

    public function getProduct() {
        return $this->_product;
    }

    public function getSuperAttributes() {
        return $this->getProduct()->getTypeInstance(true)->getConfigurableAttributesAsArray($this->getProduct());
    }

    public function getConfigurableProductValues() {
        $allProducts = $this->getProduct()->getTypeInstance(true)->getUsedProducts(null, $this->getProduct());
        $products = array();
        foreach ($allProducts as $product) {
            $products[] = $product;
        }

        $configurableAttributeCollection    = $this->getProduct()->getTypeInstance()->getConfigurableAttributes();
        $configurableProductsData           = array();

        foreach ($products as $product) {
            foreach($configurableAttributeCollection as $attribute) {
                $configurableProductsData[$product->getId()][] = array(
                    'attribute_id' => $attribute->getProductAttribute()->getAttributeId(),
                    'value_index' => $product->getData($attribute->getProductAttribute()->getAttributeCode()),
                    'is_percent' => '0',
                    'pricing_value' => $this->getPricingValue($product->getData($attribute->getProductAttribute()->getAttributeCode()))
                );
            }
        }
        return $configurableProductsData;
    }

    public function getUsedValueIds() {
        $values = $this->getConfigurableProductValues();
        $preparedValues = array();

        foreach($values AS $value) {
            foreach($value AS $v) {
                $preparedValues[] = $v['value_index'];
            }
        }

        return $preparedValues;
    }

    public function isValueUsed($value_id) {
        return in_array($value_id, $this->getUsedValueIds());
    }

    public function getPricingValue($data) {
        $usedValues = $this->getProduct()->getTypeInstance(true)->getConfigurableAttributesAsArray($this->getProduct());
        return $this->_findValue($usedValues, $data);
    }

    private function _findValue($usedValues, $attribute_value_id) {
        foreach($usedValues AS $usedValue) {
            foreach($usedValue['values'] AS $value) {
                if($value['value_index'] == $attribute_value_id) {
                    return $value['pricing_value'];
                }
            }
        }

    }
}