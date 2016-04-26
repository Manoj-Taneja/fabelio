<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
$this->startSetup();
$this->run("
    ALTER TABLE `{$this->getTable('amlanding/page')}`
    ADD COLUMN `conditions_serialized` text;
");


$operator = array();
$operator['eq']    = '==';
$operator['neq']   = '!=';
$operator['gt']    = '>=';
$operator['lt']    = '<=';
$operator['gteq']  = '>';
$operator['lteq']  = '<';
$operator['in']    = '()';
$operator['nin']   = '!()';
$operator['like']  = '{}';
$operator['nlike'] = '!{}';


foreach(Mage::getModel('amlanding/page')->getCollection() as $page){

    $page->load($page->getId());
    
    $conditions = array();

    if (is_array($page->getModifedAttributes())) {
        foreach ($page->getModifedAttributes() as $attribute){
            $conditions[] = array(
                'type' => 'amlanding/filter_condition_product',
                'attribute' => $attribute['attribute'],
                'operator' => $operator[$attribute['cond']],
                'value' => is_array($attribute[$attribute['cond']]) ? implode(',', $attribute[$attribute['cond']]) : $attribute[$attribute['cond']],
                'is_value_processed' => ''
            );
        }
    }

    $config = array(
        'type' => 'amlanding/filter_condition_combine',
        'attribute' => '',
        'operator' => '',
        'value' => '1',
        'is_value_processed' => '',
        'aggregator' => (int)$page->getAdvancedFilterCondition() === Amasty_Xlanding_Model_Page::FILTER_CONDITION_OR ? 'any' : 'all',
        'conditions' => $conditions
    );

    try{
        $page->setConditionsSerialized(serialize($config));
    
        $page->save();
    }
    catch (Exception $e){

    }
    
}

$this->endSetup();
?>
