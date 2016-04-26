<?php
class Cminds_Supplierfrontendproductuploader_Block_Product_Create extends Cminds_Supplierfrontendproductuploader_Block_Product
{
    private $_selectedCategories;

    public function _construct()
    {
        parent::_construct();
    }

    public function setSelectedCategories($categories) {
        $this->_selectedCategories = $categories;
    }

    public function getCategories() {
        $parent     = Mage::app()->getStore()->getRootCategoryId();
        $category = Mage::getModel('catalog/category');

        if (!$category->checkId($parent)) {
            return new Varien_Data_Collection();
        }

       $storeCategories = Mage::getResourceModel('catalog/category_collection')
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active', 1)
            ->addAttributeToFilter('include_in_menu', array(array('eq' => 1), array('eq' => 0)))
            ->addAttributeToFilter('entity_id', array('neq' => $parent))
            ->addAttributeToSort('path');

        return $storeCategories;
    }

    public function getCategoryTree() {
        $store = Mage::app()->getStore()->getStoreId();
        $parentId = 1;

        $tree = Mage::getResourceSingleton('catalog/category_tree')
            ->load();

        $root = $tree->getNodeById($parentId);

        if ($root && $root->getId() == 1) {
            $root->setName(Mage::helper('catalog')->__('Root'));
        }

        $collection = Mage::getModel('catalog/category')->getCollection()
            ->setStoreId($store)
            ->addAttributeToSelect('name');
            

        $tree->addCollectionData($collection, true);

        return $this->nodeToArray($root);
    }

    public function getNodes($categories) {
        $str = '';

        foreach($categories AS $category) {
            $cat = Mage::getModel('catalog/category')->load($category->getEntityId());
            if($cat->getData('available_for_supplier') == 0) continue;

            $str .= $this->_renderCategory($cat);
        }

        return $str;
    }

    protected function _renderCategory($cat) {
        $str = '<li class="level-'.$cat->getLevel().'" style="margin-left:' . (15*$cat->getLevel()).'px">';
        $str .= '<input type="checkbox" name="category[]" value="'.$cat->getId().'" '.(in_array($cat->getId(), $this->_selectedCategories) ? ' checked' : '') .'/> ';
        $str .= $cat->getName();
        $str .= '</li>';
        return $str;
    }

    private function nodeToArray(Varien_Data_Tree_Node $node)
    {
        $result = array();
        $category = Mage::getModel('catalog/category')->load($node->getId());

        if($category->getAvailableForSupplier() == 1) {
            $result['category_id'] = $node->getId();
            $result['parent_id'] = $node->getParentId();
            $result['name'] = $node->getName();
            $result['is_active'] = $node->getIsActive();
            $result['position'] = $node->getPosition();
            $result['level'] = $node->getLevel();
        }

            $result['children'] = array();

            foreach ($node->getChildren() as $child) {
                $result['children'][] = $this->nodeToArray($child);
            }
        return $result;
    }

    public function getAttributes() {
        $configAttributeSet = Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/attribute_set');

        $attributesCollection = Mage::getModel('catalog/product_attribute_api')->items($configAttributeSet);

        return $attributesCollection;
    }

    public function listCategory($categories) {
        echo '<ul>';

        foreach($categories AS $category) {
            echo '<li>';

            if(isset($category['category_id']) && $category['name'] != '' && $category['category_id'] != 1) {
                echo '<input type="checkbox" name="category[]" value="'.$category['category_id'].'"/>' . $category['name'];
            }

            if(count($category['children'])) {
                $this->listCategory($category['children']);
            }
            echo '</li>';
        }

        echo '</ul>';
    }

    public function getAttributeHtml($attribute, $data = null ) {
        $frontend = $attribute->getFrontend();

        switch($frontend->getInputType()){
            case 'text' :
                return $this->_getTextField($attribute, $data);
            break;
            case 'textarea' :
                return $this->_getTextareaField($attribute, $data);
            break;
            case 'price' :
                return $this->_getPriceField($attribute, $data);
            break;
            case 'date' :
                return $this->_getDateField($attribute, $data);
            break;
            case 'select' :
                return $this->_getSelectField($attribute, $data);
            break;
            case 'multiselect' :
                return $this->_getSelectField($attribute, $data, true);
            break;
            break;
            case 'boolean' :
                return $this->_getBooleanField($attribute, $data, true);
            break;
            default :
                    return $frontend->getInputType();
                break;
        }
    }

    private function _getTextField($attribute, $data) {
        $value = isset($data[$attribute->getAttributeCode()]) ? $data[$attribute->getAttributeCode()] : null;
        return '<input type="text" value="'.$value.'" name="' . $attribute->getAttributeCode() . '" class="' . $attribute->getFrontend()->getClass() . ' form-control">';
    }

    private function _getTextareaField($attribute, $data) {
        $value = isset($data[$attribute->getAttributeCode()]) ? $data[$attribute->getAttributeCode()] : null;
        return '<textarea class="form-control" name="' . $attribute->getAttributeCode() . '">'.$value.'</textarea>';
    }

    private function _getPriceField($attribute, $data) {
        $value = isset($data[$attribute->getAttributeCode()]) ? $data[$attribute->getAttributeCode()] : null;
        return '<input type="text" value="'.$value.'" name="' . $attribute->getAttributeCode() . '" class="form-control ' . $attribute->getFrontend()->getClass() . '">';
    }

    private function _getDateField($attribute, $data) {
        $value = isset($data[$attribute->getAttributeCode()]) ? $data[$attribute->getAttributeCode()] : null;
        return '<input type="text" value="'.$value.'" name="' . $attribute->getAttributeCode() . '" value="'.$value.'" class="datepicker ' . $attribute->getFrontend()->getClass() . '">';
    }

    protected function _getSelectField($attribute, $data, $isMultiple = false) {
        $value = isset($data[$attribute->getAttributeCode()]) ? $data[$attribute->getAttributeCode()] : null;

        if(strstr($value, ', ')) {
            $value = explode(', ', $value);
        }

        $isMultiple = ($isMultiple) ? " multiple" : "";
        $isMultipleStyle = ($isMultiple) ? " height:150px;" : "";
        $name = $attribute->getAttributeCode();
        $name .= ($isMultiple) ? "[]" : "";

        $html = '<select name="' . $name . '" style="'.$isMultipleStyle.'" class="form-control '. $attribute->getFrontend()->getClass() . '"'.$isMultiple.'>';
        $allOptions = $attribute->getSource()->getAllOptions(false);
        $html .= '<option value="">----------------</option>';
        
        foreach($allOptions AS $option) {
            if($option['value'] == '') continue;

            $selected = (($value == $option['value'] || in_array($option['value'], $value)) || ($value == $option['label'] || in_array($option['label'], $value)));

            $html .= '<option value="' . $option['value'] . '" '.($selected ? '  selected="selected"' : '').'>'.$option['label'].'</option>';
        }

        $html .= '</select>';
        return $html;
    }

    private function _getBooleanField($attribute, $data) {
        $value = isset($data[$attribute->getAttributeCode()]) ? $data[$attribute->getAttributeCode()] : $attribute->getDefaultValue();
        $html = '<select name="' . $attribute->getAttributeCode() . '" class="form-control '. $attribute->getFrontend()->getClass() . '">';
        $allOptions = $attribute->getSource()->getAllOptions();

        foreach($allOptions AS $option) {
            $selected = (($value == $option['value'] || in_array($option['value'], $value)) || ($value == $option['label'] || in_array($option['label'], $value)));
            $html .= '<option value="'.$option['value'].'" '.(($selected) ? ' selected="selected"' : '').'>'.$option['label'].'</option>';
        }

        $html .= '</select>';
        return $html;
    }

    public function canAddSku() {
        $canAddSku = Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/can_define_sku');

        return ($canAddSku == 2);
    }

    public function getMaxImagesCount() {
        $imagesCount = Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/images_count');

        return $imagesCount;
    }

    public function getLabel($attribute, $force = '', $loaded = true) {
        
        if(!$loaded) {
            $attribute = Mage::getModel('eav/entity_attribute')->loadByCode(4, $attribute);
        }

        if(!is_object($attribute)) return $force;

        $label = Mage::getModel('supplierfrontendproductuploader/labels')->load($attribute->getAttributeCode(), 'attribute_code');

        if($label->getId() == null) {
            if($force != '' && $force != null) {
                return $this->__($force);
            } else {
                return $attribute->getFrontend()->getLabel();
            }
        } else {
            if($label->getLabel() == '' || $label->getLabel() == NULL) {
                if($force != '' && $force != null) {
                    return $this->__($force);
                } else {
                    return $attribute->getFrontend()->getLabel();
                }
            } else {
                return $label->getLabel();
            }
        }
    }
}