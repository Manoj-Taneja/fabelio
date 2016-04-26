<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */


class Amasty_Xlanding_Model_Page extends Mage_Rule_Model_Rule
{
    /**
     * Page's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    const ON_SALE_BY_RULE_YES = 2;
    const ON_SALE_BY_RULE_NO = 1;

    const IS_NEW_YES = 2;
    const IS_NEW_NO = 1;

    const IS_INSTOCK_YES = 2;

    protected $_attributeCache;

    const FILTER_CONDITION_AND = 1;
    const FILTER_CONDITION_OR = 0;

    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('amlanding/page');
    }

    /**
     * Check if page identifier exist for specific store
     * return page id if page exists
     *
     * @param string $identifier
     * @param int $storeId
     * @return int
     */
    public function checkIdentifier($identifier, $storeId)
    {
        return $this->_getResource()->checkIdentifier($identifier, $storeId);
    }

    public function applyPageRules()
    {
    	$layer = Mage::getSingleton('catalog/layer');

        $collection = $layer->getProductCollection();  
        
        if ($this->getCategory()) {
          $category = Mage::getModel('catalog/category')->load($this->getCategory());
	   if ($category) {
              $layer->setCurrentCategory($category);
              $collection = $category->getProductCollection();
              $layer->prepareProductCollection($collection);
          }
   	}
        
        $this->prepareCollection($layer->getProductCollection());

        if (isset($_GET['xlanding_debug_page'])) {
//            var_dump(get_class($layer->getProductCollection()));
            echo $layer->getProductCollection()->getSelect();
//            exit(1);
        }
    }
    
    public function prepareCollection($collection){
        $collection->distinct(true);
                
        $collection->addStoreFilter();
        
        $this->applyAttributesFilter($collection);

        $this->applyStockStatusFilter($collection);

        $this->applyNewCriteriaFilter($collection);

        $this->applyIsSaleByRuleFilter($collection);
    }

    function applyCategoryFilter(&$collection){
        if ($this->getCategory()) {
            $fromPart = $collection->getSelect()->getPart(Zend_Db_Select::FROM);
            if (isset($fromPart["cat_index"]) && isset($fromPart["cat_index"]['joinCondition'])){
                $fromPart["cat_index"]['joinCondition'] = 'cat_index.product_id=e.entity_id AND cat_index.store_id=' . Mage::app()->getStore()->getId() . ' AND cat_index.visibility IN(2, 4) AND cat_index.category_id = ' . $this->getCategory();
                $collection->getSelect()->setPart(Zend_Db_Select::FROM, $fromPart);
            }            
        }
    }

    function applyNewCriteriaFilter(&$collection){
        $newCriteriaDays = Mage::getStoreConfig('amlanding/advanced/new_criteria');
        if ($isNew = $this->getIsNew()) {
            if ($isNew == self::IS_NEW_YES) {
                if ($newCriteriaDays) {
                    $threshold = Mage::getStoreConfig('amlanding/advanced/new_threshold');
                    $collection->getSelect()->where('datediff(now(), created_at) < ?', $threshold);
                } else {
                    $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATE_INTERNAL_FORMAT);
                    
                    $collection
                            ->addAttributeToFilter('news_from_date', array('date'=>true, 'to'=> $todayDate))
                            ->addAttributeToFilter(array(
                                    array(
                                        'attribute'=>'news_to_date', 
                                        'date'=>true, 
                                        'from'=>$todayDate
                                    ), 
                                    array(
                                        'attribute'=>'news_to_date', 
                                        'is' => new Zend_Db_Expr('null')
                                    )
                            ),'','left');
                }
            }

            if ($isNew == self::IS_NEW_NO) {
                if ($newCriteriaDays) {
                    $threshold = Mage::getStoreConfig('amlanding/advanced/new_threshold');
                    $collection->getSelect()->where('datediff(now(), created_at) > ?', $threshold);
                } else {
                    $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATE_INTERNAL_FORMAT);
                    
                    $collection
                            ->addAttributeToFilter(array(
                                    array(
                                        'attribute'=>'news_from_date', 
                                        'date'=>true, 
                                        'gt'=>$todayDate
                                    ), 
                                    array(
                                        'attribute'=>'news_from_date', 
                                        'is' => new Zend_Db_Expr('null')
                                    )
                            ), '','left')
                            ->addAttributeToFilter(array(
                                    array(
                                        'attribute'=>'news_to_date', 
                                        'date'=>true, 
                                        'lt'=>$todayDate
                                    ), 
                                    array(
                                        'attribute'=>'news_to_date', 
                                        'is' => new Zend_Db_Expr('null')
                                    )
                            ),'','left');
                }
            }
        }
    }

    function applyIsSaleByRuleFilter(&$collection){
        if ($sale = $this->getIsSaleByRule()){
            $collection->addFinalPrice();
            
            if ($sale == self::ON_SALE_BY_RULE_YES) {
                $collection->getSelect()->where('price_index.final_price < price_index.price');
            } else if ($sale == self::ON_SALE_BY_RULE_NO) {
                $collection->getSelect()->where('price_index.final_price >= price_index.price');
            }
        }
    }

    function applyStockStatusFilter(&$collection){
        if ($stock = $this->getStockStatus()){
            if ($stock == self::IS_INSTOCK_YES) {
                Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($collection);
            }
        }
    }
        

  	public function massChangeStatus($ids, $status)
    {
        return $this->getResource()->massChangeStatus($ids, $status);
    }
    
    public function getUploadPath()
    {
        return  'amasty' . DS .'amxlanding';
    }
    
    public function getLayoutFileUrl(){
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . $this->getLayoutFile();
    }
    
    protected function _beforeSave(){
        
        if(isset($_FILES['layout_file']) &&
                $_FILES['layout_file']['name'] != '') {
        
            try{
                $uploader = new Varien_File_Uploader('layout_file');
                $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);

                $this->setLayoutFileName($uploader->getCorrectFileName($_FILES['layout_file']['name']));
                $ext = pathinfo($_FILES['layout_file']['name'], PATHINFO_EXTENSION);

                $result = $uploader->save(
                    Mage::getBaseDir('media') . DS . $this->getUploadPath(), uniqid().".".$ext
                );

                $this->setLayoutFile($this->getUploadPath() . $result['file']); 
            } catch (Exception $e){
                Mage::throwException($this->__('Invalid image format'));
            }
            
        } else {
            
            $layoutFile = $this->getLayoutFile();
            
            if (isset($layoutFile['delete']) &&
                    $layoutFile['delete'] == 1
            ) {
                $this->setLayoutFile(NULL);
            } else {
                $this->setLayoutFile($this->layout_file["value"]);
            }
            
        }
        return parent::_beforeSave(); 
    }
    
    public function getAvailableSortBy()
    {
        $available = $this->getData('available_sort_by');
        if (empty($available)) {
            return array();
        }
        if ($available && !is_array($available)) {
            $available = explode(',', $available);
        }
        return $available;
    }

    public function getAvailableSortByOptions() {
        $availableSortBy = array();
        $defaultSortBy   = Mage::getSingleton('catalog/config')
            ->getAttributeUsedForSortByArray();
        if ($this->getAvailableSortBy()) {
            foreach ($this->getAvailableSortBy() as $sortBy) {
                if (isset($defaultSortBy[$sortBy])) {
                    $availableSortBy[$sortBy] = $defaultSortBy[$sortBy];
                }
            }
        }

        if (!$availableSortBy) {
            $availableSortBy = $defaultSortBy;
        }

        return $availableSortBy;
    }

    public function getDefaultSortBy() {
        if (!$sortBy = $this->getData('default_sort_by')) {
            $sortBy = Mage::getSingleton('catalog/config')
                ->getProductListDefaultSortBy();
        }
        
        $available = $this->getAvailableSortByOptions();
        if (!isset($available[$sortBy])) {
            $sortBy = array_keys($available);
            $sortBy = $sortBy[0];
        }

        return $sortBy;
    }
    
    public function getActionsInstance()
    {
        return Mage::getModel('rule/action_collection');
    }
    
    public function getConditionsInstance()
    {
        return Mage::getModel('amlanding/filter_condition_combine');
    }
    
    public function applyAttributesFilter($productCollection){
        $conditions = $this->getConditions();
        
        if ($conditions instanceof Amasty_Xlanding_Model_Filter_Condition_Combine){
            $this->getConditions()->collectValidatedAttributes($productCollection);
            $condition = $this->getConditions()->collectConditionSql($productCollection);  
            
            if (!empty($condition))
                $productCollection->getSelect()->where($condition);
        }
    }
    
    public function getAttributesAsArray()
    {
    	$array = array();
    	$attributes = $this->getData('attributes');
    	if (!empty($attributes)) {
    		$array = unserialize($attributes);
    	}
    	return $array;
    }
    
    function getModifedAttributes(){
        $attributes = $this->getAttributesAsArray();
        $filters = array();
        if ($attributes){
            foreach ($attributes as $value) {
                $filter = $this->getAttributeFilter($value);
                
                if ($filter) {
                    
                    if ($value['cond'] == 'like' && count($filter['like']) > 1){
                        
                        foreach($filter['like'] as $like){
                            $filters[] = array_merge($filter, array(
                                "like" => array($like)
                            ));
                        }
                        
                    } else if (($value['cond'] == 'in' || $value['cond'] == 'nin') 
                            && $filter['type'] != 'text') {
                        
                        $found = false;
                        foreach ($filters as $ind => $exist){
                            if ($exist['attribute'] == $filter['attribute']){
                                
                                $filters[$ind][$value['cond']][] = $value['value'];
                                
                                $found = true;
                                break;
                            }
                        }
                        if (!$found){
                            $filters[] = array(
                                'attribute' => $filter['attribute'],
                                'cond' => $value['cond'],
                                $value['cond'] => array(
                                    $value['value']
                                )
                            );
                        }
                    } else {
                        $filters[] = $filter;
                    }
                }
                
            }
        }
        
        foreach($filters as &$filter){
            if ($filter['cond'] == 'like' && strpos($filter['like'], "%") === FALSE){
                $filter['like'] = "%" . $filter['like'] . "%";
            }
        }
        
        return $filters;
    }
    
    function getAttributeFilter($param)
    {
    	$code  = $param['code'];
    	$value = $this->_prepareValue($param);
    	$cond  = $param['cond'];
    	
    	if (!isset($this->_attributeCache[$code])) {
    		$attribute = Mage::getModel('catalog/product')->getResource()->getAttribute($code);
    		$this->_attributeCache[$code] = $attribute;
    	}

    	$attribute = $this->_attributeCache[$code];
    	
       $code = $attribute->getAttributeCode();
                
        $ret = array(
            "attribute" => $code,
            'cond' => $cond,
            'type' => $attribute->getBackendType(),
            $cond => $value
        ); 
       return $ret; 
    }
    
    protected function _prepareValue($param){
        $value = $param['value'];
    	$cond  = $param['cond'];
        
        if ($cond == "like"){
            if (is_array($value)){
                foreach($value as $index => $el){
                    if (strpos($el, "%") === FALSE){
                        $value[$index] = "%" . $el . "%";
                    }
                    
                }
            }
        }
        
        return $value;
    }
    
}
