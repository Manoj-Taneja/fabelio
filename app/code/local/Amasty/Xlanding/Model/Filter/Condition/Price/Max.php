<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

    class Amasty_Xlanding_Model_Filter_Condition_Price_Max extends Amasty_Xlanding_Model_Filter_Condition_Abstract
    {
        protected $_inputType = 'numeric';

        public function __construct()
        {
            parent::__construct();
            $this->setType('amlanding/filter_condition_price_max');
            $this->setValue(null);
        }

        public function getNewChildSelectOptions()
        {
            return array('value' => $this->getType(),
                'label' => Mage::helper('amlanding')->__($this->getDefaultLabel()),
            );
        }

        static function getDefaultLabel() {
             return 'Max Price';
        }

        public function asHtml()
        {
            return $this->getTypeElementHtml()
                . Mage::helper('amlanding')->__($this->getDefaultLabel() . ' %s %s:', $this->getOperatorElementHtml(), $this->getValueElementHtml())
                . $this->getRemoveLinkHtml();
        }

        public function collectValidatedAttributes($productCollection)
        {
            $productCollection->addPriceData();
        }

        public function collectConditionSql($collection)
        {

            $value     = $this->getValue();
            $operator  = $this->correctOperator($this->getOperator(), $this->getInputType());

            return $this->getOperatorCondition('price_index.max_price', $operator, $value);
        }


    }

?>