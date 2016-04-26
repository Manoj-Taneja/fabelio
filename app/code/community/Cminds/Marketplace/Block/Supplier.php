<?php
class Cminds_Marketplace_Block_Supplier extends Mage_Core_Block_Template {
    public function _construct() {
        $this->setTemplate('marketplace/supplier.phtml');
    }
    public function getCustomer() {
        return Mage::registry('customer');
    }

    public function getCustomFieldsValues($skipSystem = false) {
        $customer = $this->getCustomer();

        $dbValues = unserialize($customer->getCustomFieldsValues());
        $ret = array();

        foreach($dbValues AS $value) {
            $v = Mage::getModel('marketplace/fields')->load($value['name'], 'name');
            if($skipSystem) {
                if($v->getData('is_system')) {
                    continue;
                }
            }

            if(isset($v)) {
                $ret[] = $value;
            }
        }

        return $ret;
    }

    public function getCustomFields() {
		$collection = Mage::getModel('marketplace/fields')->getCollection();
		return $collection;
    }

    public function getCustomField($field, $data = null ) {
        switch($field->getType()){
            case 'text' :
                return $this->_getTextField($field, $data);
            break;
            case 'textarea' :
                return $this->_getTextareaField($field, $data);
            break;
            case 'date' :
                return $this->_getDateField($field, $data);
            break;
            default :
                return '';
            break;
        }
    }

    private function _getTextField($attribute, $data) {
        $value = $this->_getValue($data, $attribute->getName());
        $class = $attribute->getIsRequired() ? ' required' : '';
        return '<input type="text" value="'.$value.'" name="' . $attribute->getName() . '" id="' . $attribute->getName() . '" class="input-text form-control' . $class . '">';
    }

    private function _getTextareaField($attribute, $data) {
        $value = $this->_getValue($data, $attribute->getName());
        $class = $attribute->getIsRequired() ? ' required' : '';
        $class .= $attribute->getIsWysiwyg() ? ' wysiwyg' : '';
        return '<textarea name="' . $attribute->getName() . '" id="' . $attribute->getName() . '" class="input-text form-control' . $class . '"">'.$value.'</textarea>';
    }

    private function _getDateField($attribute, $data) {
        $value = $this->_getValue($data, $attribute->getName());
        $class = $attribute->getIsRequired() ? ' required' : '';
        return '<input type="text" value="'.$value.'" name="' . $attribute->getName() . '" id="' . $attribute->getName() . '" value="'.$value.'" class="datepicker input-text form-control' . $class . '">';
    }

    private function _getValue($data, $customFieldName) {
        if(!is_array($data)) return '';

        foreach($data AS $value) {
            if($customFieldName == $value['name']) {
                return $value['value'];
            }
        }
        return '';
    }
}