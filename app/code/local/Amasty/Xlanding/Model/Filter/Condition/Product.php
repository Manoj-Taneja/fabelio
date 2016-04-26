<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

    class Amasty_Xlanding_Model_Filter_Condition_Product extends Amasty_Xlanding_Model_Filter_Condition_Abstract
    {
        protected $_indexKey;
        public function getAttributeName()
        {
            if ($this->getAttribute()==='attribute_set_id') {
                return Mage::helper('catalogrule')->__('Attribute Set');
            }
            
            return $this->getAttributeObject()->getFrontendLabel();   
        }
        
        protected function _getColumnEntry($collection){
            $ret = null;
            $columns = $collection->getSelect()->getPart(Zend_Db_Select::COLUMNS);
            
            foreach($columns as $columnEntry){
                list($correlationName, $column, $alias) = $columnEntry;
                
                if ($alias == $this->getAttribute()){
                    $ret = $columnEntry;
                    break;
                }
            }
            
            return $ret;
        }
        
        public function collectConditionSql($collection)
        {
            $ret = 'true';
            $columnEntry = $this->_getColumnEntry($collection);
            
            $value     = $this->getValue();
            $operator  = $this->correctOperator($this->getOperator(), $this->getInputType());

            if ($columnEntry){
                list($correlationName, $column, $alias) = $columnEntry;
                
                if ($column instanceof Zend_Db_Expr) {
                    $ret = $this->getOperatorCondition($column, $operator, $value);
                } else {
                    $selection = '';

                    if (empty($correlationName)) {
                        $selection = $column;
                    } else {
                        $selection = $correlationName . '.' . $column;
                    }
                    
                    $ret = $this->getOperatorCondition($selection, $operator, $value);
                }
            } else if ($this->getAttribute() == 'sku'){
                $ret = $this->_getStaticAttributeCondition($collection, 'sku');
            } else if ($this->getAttribute() == 'attribute_set_id'){
                $ret = $this->_getStaticAttributeCondition($collection, 'attribute_set_id');
            } else if ($this->getAttributeObject()->getIsFilterable()) {

                $value     = $this->getValue();

                $tableAlias = $this->getAttributeObject()->getAttributeCode() . '_' . $this->_getIndexAlias();

                $value     = $this->getValue();
                $operator  = $this->correctOperator($this->getOperator(), $this->getInputType());

                $ret = $this->getOperatorCondition("{$tableAlias}.value", $operator, $value);

            }
            
            return $ret;
        }
        
        protected function _getStaticAttributeCondition($collection, $attrbiute){
            $ret = 'true';
            
            $value     = $this->getValue();
            $operator  = $this->correctOperator($this->getOperator(), $this->getInputType());
            
            $columns = $collection->getSelect()->getPart(Zend_Db_Select::COLUMNS);
            if (count($columns) > 0) {
                list($correlationName, $column, $alias) = $columns[0];
                $selection = $correlationName.'.'.$attrbiute;
                $ret = $this->getOperatorCondition($selection, $operator, $value);
            }
            
            return $ret;
        }


        protected function _prepareValueOptions()
        {
            if ($this->getAttribute() === 'attribute_set_id') {
                
                $entityTypeId = Mage::getSingleton('eav/config')
                    ->getEntityType(Mage_Catalog_Model_Product::ENTITY)->getId();
                
                $selectOptions = Mage::getResourceModel('eav/entity_attribute_set_collection')
                    ->setEntityTypeFilter($entityTypeId)
                    ->load()
                    ->toOptionArray();
                
                $this->setData('value_select_options', $selectOptions);
            } 
            
            return parent::_prepareValueOptions();
        }
        
        public function getInputType()
        {
            if ($this->getAttribute()==='attribute_set_id') {
                return 'select';
            }
            
            return parent::getInputType();
        }
        
        public function getValueElementType()
        {
            if ($this->getAttribute()==='attribute_set_id') {
                return 'select';
            }
            
            
            return parent::getValueElementType();
        }
        
        public function collectValidatedAttributes($productCollection)
        {
            $connection = Mage::getSingleton('core/resource')->getConnection('core_read');


            if ($this->getAttributeObject()->getIsFilterable()){
                $value = $this->getValue();

                $tableAlias = $this->getAttributeObject()->getAttributeCode() . '_' . $this->_getIndexAlias();

                $operator  = $this->correctOperator($this->getOperator(), $this->getInputType());

                $condition = $this->getOperatorCondition("{$tableAlias}.value", $operator, $value);


                $conditions = array(
                    "{$tableAlias}.entity_id = e.entity_id",
                    $connection->quoteInto("{$tableAlias}.attribute_id = ?", $this->getAttributeObject()->getAttributeId()),
                    $connection->quoteInto("{$tableAlias}.store_id = ?", $productCollection->getStoreId()),
                    $condition
                );

                $productCollection->getSelect()->joinLeft(
                    array($tableAlias => Mage::getSingleton('core/resource')->getTableName('catalog/product_index_eav')),
                    implode(' AND ', $conditions),
                    array()
                );
            } else {
                $attribute = $this->getAttribute();

                $attributes = $this->getRule()->getCollectedAttributes();
                $attributes[$attribute] = true;
                $this->getRule()->setCollectedAttributes($attributes);
                $productCollection->addAttributeToSelect($attribute, 'left');
            }

            return $this;
        }

        protected function _getIndexAlias(){
            if (!$this->_indexKey){
                $this->_indexKey = uniqid('amlanding_idx');
            }
            return $this->_indexKey;
        }
        
        
    }      
?>