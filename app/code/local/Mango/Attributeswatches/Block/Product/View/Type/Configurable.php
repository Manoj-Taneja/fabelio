<?php

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright   Copyright (c) 2010 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Catalog super product configurable part block
 *
 * @category   Mage
 * @package    Mage_Catalog
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mango_Attributeswatches_Block_Product_View_Type_Configurable extends Mage_Catalog_Block_Product_View_Type_Configurable {

     public function getAllowProducts()
    {
       $_show_out_of_stock = Mage::getStoreConfig("attributeswatches/settings/outofstock");
         if (!$this->hasAllowProducts()) {
            $products = array();
            $allProducts = $this->getProduct()->getTypeInstance(true)
                ->getUsedProducts(null, $this->getProduct());
            foreach ($allProducts as $product) {
				if (($product->isSaleable() || $_show_out_of_stock)  &&  $product->getStatus() == Mage_Catalog_Model_Product_Status::STATUS_ENABLED ) {
                    $products[] = $product;
                }
            }
            $this->setAllowProducts($products);
        }
        return $this->getData('allow_products');
    }
    
    
    
    
    
    public function getJsonConfig() {

        $attributes = array();
        $options    = array();
        //$optionsSaleable = array();
        $saleableProducts = array();
        $store      = $this->getCurrentStore();
        $taxHelper  = Mage::helper('tax');
        $currentProduct = $this->getProduct();

        $preconfiguredFlag = $currentProduct->hasPreconfiguredValues();
        if ($preconfiguredFlag) {
            $preconfiguredValues = $currentProduct->getPreconfiguredValues();
            $defaultValues       = array();
        }
        /*$total_attributes =  count($this->getAllowAttributes());
        $_att_counter = 0;*/

        foreach ($this->getAllowProducts() as $product) {
            $productId  = $product->getId();
            //$saleable = ;
            $saleableProducts[$productId] =  $product->isSaleable() ;
            foreach ($this->getAllowAttributes() as $attribute) {
                $productAttribute   = $attribute->getProductAttribute();
                $productAttributeId = $productAttribute->getId();
                $attributeValue     = $product->getData($productAttribute->getAttributeCode());
                if (!isset($options[$productAttributeId])) {
                    $options[$productAttributeId] = array();
                }

                if (!isset($options[$productAttributeId][$attributeValue])) {
                    $options[$productAttributeId][$attributeValue] = array();
                }
                $options[$productAttributeId][$attributeValue][] = $productId;
                //$optionsSaleable[$productAttributeId][$attributeValue][] = array( "id"=> $productId, "saleable" => $saleable );
                
            }
        }

        $this->_resPrices = array(
            $this->_preparePrice($currentProduct->getFinalPrice())
        );

        foreach ($this->getAllowAttributes() as $attribute) {
            $productAttribute = $attribute->getProductAttribute();
            $attributeId = $productAttribute->getId();
            $info = array(
               'id'        => $productAttribute->getId(),
               'code'      => $productAttribute->getAttributeCode(),
               'label'     => $attribute->getLabel(),
               'options'   => array()
            );

            $optionPrices = array();
            $prices = $attribute->getPrices();
            if (is_array($prices)) {
                foreach ($prices as $value) {
                    if(!$this->_validateAttributeValue($attributeId, $value, $options)) {
                        continue;
                    }
                    $currentProduct->setConfigurablePrice($this->_preparePrice($value['pricing_value'], $value['is_percent']));
                    $currentProduct->setParentId(true);
                    Mage::dispatchEvent(
                        'catalog_product_type_configurable_price',
                        array('product' => $currentProduct)
                    );
                    $configurablePrice = $currentProduct->getConfigurablePrice();

                    /*$_saleable = false;
                    foreach($optionsSaleable[$attributeId][$value['value_index']] as $sindex=>$svalue){
                        if($svalue["saleable"]) {
                            $_saleable = true;
                            //break;
                        }
                    }*/

                    if (isset($options[$attributeId][$value['value_index']])) {
                        $productsIndex = $options[$attributeId][$value['value_index']];
                    } else {
                        $productsIndex = array();
                    }

                    $info['options'][] = array(
                        'id'        => $value['value_index'],
                        'label'     => $value['label'] ,
                        'price'     => $configurablePrice,
                        'oldPrice'  => $this->_prepareOldPrice($value['pricing_value'], $value['is_percent']),
                        'products'  => $productsIndex,
                        //'productsSaleable'  => isset($optionsSaleable[$attributeId][$value['value_index']]) ? $optionsSaleable[$attributeId][$value['value_index']] : array(),
                    );
                    $optionPrices[] = $configurablePrice;
                }
            }
            /**
             * Prepare formated values for options choose
             */
            foreach ($optionPrices as $optionPrice) {
                foreach ($optionPrices as $additional) {
                    $this->_preparePrice(abs($additional-$optionPrice));
                }
            }
            if($this->_validateAttributeInfo($info)) {
               $attributes[$attributeId] = $info;
            }

            // Add attribute default value (if set)
            if ($preconfiguredFlag) {
                $configValue = $preconfiguredValues->getData('super_attribute/' . $attributeId);
                if ($configValue) {
                    $defaultValues[$attributeId] = $configValue;
                }
            }
        }

        $taxCalculation = Mage::getSingleton('tax/calculation');
        if (!$taxCalculation->getCustomer() && Mage::registry('current_customer')) {
            $taxCalculation->setCustomer(Mage::registry('current_customer'));
        }

        $_request = $taxCalculation->getRateRequest(false, false, false);
        $_request->setProductClassId($currentProduct->getTaxClassId());
        $defaultTax = $taxCalculation->getRate($_request);

        $_request = $taxCalculation->getRateRequest();
        $_request->setProductClassId($currentProduct->getTaxClassId());
        $currentTax = $taxCalculation->getRate($_request);

        $taxConfig = array(
            'includeTax'        => $taxHelper->priceIncludesTax(),
            'showIncludeTax'    => $taxHelper->displayPriceIncludingTax(),
            'showBothPrices'    => $taxHelper->displayBothPrices(),
            'defaultTax'        => $defaultTax,
            'currentTax'        => $currentTax,
            'inclTaxTitle'      => Mage::helper('catalog')->__('Incl. Tax')
        );

        $config = array(
            'attributes'        => $attributes,
            'template'          => str_replace('%s', '#{price}', $store->getCurrentCurrency()->getOutputFormat()),
            'basePrice'         => $this->_registerJsPrice($this->_convertPrice($currentProduct->getFinalPrice())),
            'oldPrice'          => $this->_registerJsPrice($this->_convertPrice($currentProduct->getPrice())),
            'productId'         => $currentProduct->getId(),
            'chooseText'        => Mage::helper('catalog')->__('Choose an Option...'),
            'taxConfig'         => $taxConfig,
            'saleableProducts'  => $saleableProducts
        );

        if ($preconfiguredFlag && !empty($defaultValues)) {
            $config['defaultValues'] = $defaultValues;
        }elseif( Mage::getStoreConfig("attributeswatches/settings/defaultselect")){
            /* set default for first attribute 
             * if setting is yes 
             * and default values (cart/buyrequest) is empty */
            /* get first attribute and first value */
            foreach($attributes as $_default_attibute_id => $_attribute_info){
                foreach($_attribute_info['options'] as $_option_index => $_option_info){
                    $defaultValues[$_default_attibute_id] = $_option_info['id'];
                    break;
                }
                break;
            }
            $config['defaultValues'] = $defaultValues;
        }

        $config = array_merge($config, $this->_getAdditionalConfig());

        return Mage::helper('core')->jsonEncode($config);
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        return parent::getJsonConfig();
        
        
        
        
        
        $_info = json_decode(parent::getJsonConfig(), true);
        /* will get all the attributes with swatches  */
        $_attributes_with_swatches = Mage::helper("attributeswatches")->getAttributesWithSwatchesProductView();
        $_attributes_hideselect = Mage::helper("attributeswatches")->getAttributesProductViewHideSelect();
        $_attributes_switchgallery = Mage::helper("attributeswatches")->getAttributesSwitchGalleryProductView();
        
        /* hide select only if the attribute has another type of selector associated */
        foreach ($_attributes_hideselect as $_id => $type) {
            if (!isset($_attributes_with_swatches[$_id])) {
                unset($_attributes_hideselect[$_id]);
            }
        }
        $_swatches_ids = array();

        foreach ($_info['attributes'] as $_id => $_attribute) {
            /* options with swatches from the db */
            if (isset($_attributes_with_swatches[$_attribute["code"]]) && $_attributes_with_swatches[$_attribute["code"]] == "image") {
                foreach ($_attribute["options"] as $_option) {
                    $_swatches_ids[] = $_option["id"];
                }
            }
            /* set the swatch type to display in frontend */
            if (isset($_attributes_with_swatches[$_attribute["code"]])) {
                $_info['attributes'][$_id]["swatch_type"] = $_attributes_with_swatches[$_attribute["code"]];
            }else{
                $_info['attributes'][$_id]["swatch_type"] = false;
            }
            /* hide/show select in frontend */
            $_info['attributes'][$_id]["hideselect"] = isset($_attributes_hideselect[$_attribute["code"]]);
            /* switch gallery when attribute is selected */
            $_info['attributes'][$_id]["switchgallery"]= isset($_attributes_switchgallery[$_attribute["code"]]);
        }

        $_options = Mage::getModel('attributeswatches/attributeswatches')->getCollection()->addFieldToFilter('main_table.option_id', array('in' => $_swatches_ids));
        $_swatches_values = array();
        foreach ($_options as $_option) {
            $_swatch = "";
            if ($_option->getMode() == 2) {
                $_swatch = "background-color:#" . $_option->getColor();
            } elseif ($_option->getMode() == 1) {
                $_swatch = "background-image:url('" . Mage::getBaseUrl('media') . 'attributeswatches/' . $_option->getFilename() . "');";
            }
            $_swatches_values[$_option->getOptionId()] = $_swatch;
        }

        
        /* assign the images or colors to the swatches */
        foreach ($_info['attributes'] as $_id => $_attribute) {
            if (isset($_attributes_with_swatches[$_attribute["code"]]) && $_attributes_with_swatches[$_attribute["code"]] == "image") {
                foreach ($_attribute["options"] as $_i => $_option) {
                    if (isset($_swatches_values[$_option["id"]]))
                        $_info['attributes'][$_id]["options"][$_i]["swatch_value"] = $_swatches_values[$_option["id"]];
                }
            }
        }
        return $_info;
    }        

}
