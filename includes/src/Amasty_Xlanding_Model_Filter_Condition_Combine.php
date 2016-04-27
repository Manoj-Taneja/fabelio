<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

class Amasty_Xlanding_Model_Filter_Condition_Combine
    extends Mage_SalesRule_Model_Rule_Condition_Product_Combine
{
    /**
     * Initialize model
     */
    public function __construct()
    {
        parent::__construct();
        $this->setType('amlanding/filter_condition_combine');
    }
    
    protected function _getProductAttributes()
    {
        $exclude = array(
            "tier_price", "media_gallery"
        );
        $pAttributes = array(
            array(
                'value'=>'amlanding/filter_condition_product|attribute_set_id', 
                'label'=>Mage::helper('catalogrule')->__('Attribute Set')
            )
        );
        
        if (is_null($this->_productAttributesInfo)) {
            $this->_productAttributesInfo = array();
            $productAttributes = Mage::getResourceModel('eav/entity_attribute_collection')
                ->setItemObjectClass('catalog/resource_eav_attribute')
                ->setEntityTypeFilter(Mage::getResourceModel('catalog/product')->getTypeId());

            foreach ($productAttributes as $attribute) {
                $attributeCode = $attribute->getAttributeCode();
                $attributeLabel = $attribute->getFrontendLabel();
                
                if (!empty($attributeLabel) && !in_array($attributeCode, $exclude)){
                    $pAttributes[] = array('value'=>'amlanding/filter_condition_product|'.$attributeCode, 'label'=>$attributeLabel);
                }
            }
        };
        
        
        
        return $pAttributes;
    }
    
    public function collectConditionSql($collection)
    {
        $value     = $this->getValue();
        
        $wheres = array();
        foreach ($this->getConditions() as $condition) {
            
            $wheres[] = $condition->collectConditionSql($collection);
        }

        if (empty($wheres)) {
            return '';
        }
        
        $delimiter = $this->getAggregator() == "all" ? ' AND ' : ' OR ';
        return '(' . implode($delimiter, $wheres) . ')';
    }

    public function getNewChildSelectOptions()
    {
        $conditions = Mage_Rule_Model_Condition_Combine::getNewChildSelectOptions();
        $conditions = array_merge_recursive(
            $conditions,
            array(
                array(
                    'label' => Mage::helper('amlanding')->__('Conditions Combination'),
                    'value' => 'amlanding/filter_condition_combine'
                ),
                array(
                    'label' => Mage::helper('amlanding')->__('Custom Fields'),
                    'value' => array(
                        array(
                            'label' => Mage::helper('amlanding')->__('Qty'),
                            'value' => 'amlanding/filter_condition_qty'
                        ),
                    )
                ),
                array(
                    'label' => Mage::helper('catalog')->__('Product Attribute'),
                    'value' => $this->_getProductAttributes(),
                ),
            )
        );
        return $conditions;
    }
    
    public function loadValueOptions()
    {
        $this->setValueOption(array(
            1 => Mage::helper('rule')->__('TRUE'),
//            0 => Mage::helper('rule')->__('FALSE'),
        ));
        return $this;
    }
}
