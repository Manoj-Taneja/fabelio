<?php
class Cminds_Marketplace_Block_Product_Create extends Cminds_Supplierfrontendproductuploader_Block_Product_Create
{
    public function _construct()
    {
        parent::_construct();
    }

    public function getProduct() {
        if(!$this->_product) {
            $requestParams = Mage::registry('cminds_configurable_request');
            if(isset($requestParams['id'])) {
                $this->_product = Mage::getModel('catalog/product')->load($requestParams['id']);
            } else {
                $this->_product = new Varien_Object();
            }
        }

        return $this->_product;
    }

    public function isEditMode() {
        $requestParams = Mage::registry('cminds_configurable_request');

        if(isset($requestParams['id']) && !isset($requestParams['attribute_set_id'])) {
            return true;
        } elseif(!isset($requestParams['id']) && isset($requestParams['attribute_set_id'])) {
            return false;
        } else {
            if(Mage::registry('is_configurable')) {
                throw new Exception();
            } else {
                return false;
            }
        }

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

    public function getProductId() {
        $product = Mage::registry('product_object');
        return $product->getId();
    }

    public function getAttributeSetId() {
        if(!$this->isEditMode()) {
            if(Mage::registry('is_configurable')) {
                $requestParams = Mage::registry('cminds_configurable_request');
                return $requestParams['attribute_set_id'];
            } else {
                $params = Mage::app()->getFrontController()->getRequest()->getParams();

                if(!isset($params['attribute_set_id']) || !$params['attribute_set_id']) {
                    $configAttributeSet = Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/attribute_set');
                } else {
                    $configAttributeSet = $params['attribute_set_id'];
                }

                return $configAttributeSet;
            }
        } else {
            $product = $this->getProduct();
            return $product->getAttributeSetId();
        }
    }

    public function getAttributes() {
        $attributesCollection = Mage::getModel('catalog/product_attribute_api')->items($this->getAttributeSetId());
        return $attributesCollection;
    }

    public function isMarketplaceEnabled() {
        $cmindsCore = Mage::getModel("cminds/core");

        if($cmindsCore) {
            $cmindsCore->validateModule('Cminds_Marketplace');
        } else {
            throw new Mage_Exception('Cminds Core Module is disabled or removed');
        }
    }
}