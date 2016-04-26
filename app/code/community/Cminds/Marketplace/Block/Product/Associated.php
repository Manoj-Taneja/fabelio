<?php
class Cminds_Marketplace_Block_Product_Associated extends Cminds_Supplierfrontendproductuploader_Block_Product_Create
{
    private $_configurableProduct = null;

    public function _construct()
    {
        parent::_construct();
    }

    public function getConfigurableModel() {
        if(!$this->_configurableProduct) {
            $requestParams = $this->getConfigurable();
            $this->_configurableProduct = Mage::getModel('marketplace/product_configurable');
            $this->_configurableProduct->setProduct($requestParams);
        }

        return $this->_configurableProduct;
    }

    public function getAvailableAttributeSets() {
        $s = Mage::getModel('eav/entity_attribute_set')->getCollection()->addFieldToFilter('available_for_supplier', 1);
        return $s;
    }

    public function getProductTypes() {
        $types = array(
            array('label' => $this->__('Simple Product'), 'value' => Mage_Catalog_Model_Product_Type::TYPE_SIMPLE),
            array('label' => $this->__('Configurable Product'), 'value' => Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE),
        );
        return $types;
    }

    public function getAttributeSetId() {
        $requestParams = $this->getConfigurable();
        return $requestParams['attribute_set_id'];
    }

    public function getProductId() {
        return $this->getConfigurable()->getId();
    }

    public function getAttributes() {

        $configurableAttributesData = $this->getConfigurable()->getTypeInstance()->getConfigurableAttributesAsArray();
        return $configurableAttributesData;
    }

    public function getChildrenProducts() {
        $childProducts = Mage::getModel('catalog/product_type_configurable')
            ->getUsedProducts(null, $this->getConfigurable());

        return $childProducts;
    }

    public function getConfigurable() {
        return Mage::registry('product_object');
    }

    public function getChildrenProductIds() {
        $children = $this->getChildrenProducts();
        $ids = array();

        foreach($children AS $child) {
            $ids[] = $child->getId();
        }

        return $ids;
    }

    public function canSetValue($value_id) {
        return !$this->getConfigurableModel()->isValueUsed($value_id);
    }

    protected function _getSelectField($attribute, $data, $isMultiple = false) {
        $value = isset($data[$attribute->getAttributeCode()]) ? $data[$attribute->getAttributeCode()] : null;
        $isMultiple = ($isMultiple) ? " multiple" : "";
        $isMultipleStyle = ($isMultiple) ? " height:100px;" : "";
        $html = '<select name="' . $attribute->getAttributeCode() . '" style="'.$isMultipleStyle.'" class="required-entry associated-dropdown '. $attribute->getFrontend()->getClass() . '"'.$isMultiple.'>';
        $allOptions = $attribute->getSource()->getAllOptions(true);
        $html .= '<option value="">----------------</option>';
        foreach($allOptions AS $option) {
            if($option['value'] == '') continue;
            if(!$this->canSetValue($option['value'])) continue;

            $html .= '<option value="'.$option['value'].'" '.(($value == $option['label']) ? ' selected="selected"' : '').'>'.$option['label'].'</option>';
        }

        $html .= '</select>';
        return $html;
    }

    public function getNotAssociatedProducts() {
        $s = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('creator_id')
            ->addAttributeToFilter('type_id', 'simple')
            ->addAttributeToFilter('attribute_set_id', $this->getConfigurable()->getAttributeSetId())
            ->addAttributeToFilter('creator_id', Mage::helper('marketplace')->getSupplierId());

        $childrenIds = $this->getChildrenProductIds();

        if(count($childrenIds) > 0) {
            $s->addAttributeToFilter('entity_id', array('nin' => $childrenIds));
        }

        foreach($s AS $product) {
            if ($this->areOptionsExists($product)) {
               $s->removeItemByKey($product->getId());
            }
        }
        return $s;
    }

    public function areOptionsExists($simpleProduct) {
        $configurable_values = $this->getConfigurableModel()->getConfigurableProductValues();
        $product = Mage::getModel('catalog/product')->load($simpleProduct->getId());
        $superAttributes = $this->getConfigurableModel()->getSuperAttributes();
        $allAttributesCount = count($superAttributes);
        $matchedValuesCount = 0;
        foreach($superAttributes AS $attribute) {
            $simpleProductData = $product->getData($attribute['attribute_code']);
            
            if($simpleProductData == NULL) {
                $matchedValuesCount++;
                continue;
            }

            foreach($attribute['values'] AS $value) {
                if($value['value_index'] == $simpleProductData || !$simpleProductData) {
                    $matchedValuesCount++;
                }
            }
        }

        return ($matchedValuesCount >= $allAttributesCount);
    }

}
