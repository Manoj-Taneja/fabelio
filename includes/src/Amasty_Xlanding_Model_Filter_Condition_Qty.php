<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

    class Amasty_Xlanding_Model_Filter_Condition_Qty extends Amasty_Xlanding_Model_Filter_Condition_Abstract
    {
        protected $_inputType = 'numeric';
        
        public function __construct()
        {
            parent::__construct();
            $this->setType('amlanding/filter_condition_qty');
            $this->setValue(null);
        }
        
        public function getNewChildSelectOptions()
        {
            return array('value' => $this->getType(),
                'label' => Mage::helper('amlanding')->__($this->getDefaultLabel()),
            );
        }

        static function getDefaultLabel() {
             return 'Qty';
        }

        public function asHtml()
        {
            return $this->getTypeElementHtml()
                . Mage::helper('amlanding')->__($this->getDefaultLabel() . ' %s %s:', $this->getOperatorElementHtml(), $this->getValueElementHtml())
                . $this->getRemoveLinkHtml();
        }
        
        public function collectValidatedAttributes($productCollection)
        {
            if (!$this->_checkJoin('amlanding_qty', $productCollection)) {
                $productCollection->joinField('amlanding_qty',
                     'cataloginventory/stock_item',
                     'qty',
                     'product_id=entity_id',
                     '{{table}}.stock_id=1',
                     'left');
            }
        }
        
        protected function _checkJoin($alias, $collection){
            $from = $collection->getSelect()->getPart(Zend_Db_Select::FROM);
            return isset($from['at_' . $alias]);
        }
        
        public function collectConditionSql($collection)
        {
            
            $value     = $this->getValue();
            $operator  = $this->correctOperator($this->getOperator(), $this->getInputType());
                
            return $this->getOperatorCondition('at_amlanding_qty.qty', $operator, $value);
        }
        
        
    }
                    
?>