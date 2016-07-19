<?php
/**
 * Ptech Multi Select Layer Navigation
 *  
 * @category     Ptech
 * @package      Ptech_Multilayer 
 * @copyright    Copyright (c) 2014-2015 Ptech
 * @author       Ptech (Brijesh Kumar)  
 * @version      Release: 1.0.0
 * @Class        Ptech_Multilayer_Model_Layer_Filter_Category
 * @Overwrite    Mage_Catalog_Model_Layer_Filter_Category
 */
class Ptech_Multilayer_Model_Layer_Filter_Category extends Mage_Catalog_Model_Layer_Filter_Category {

    protected $cat = null;

    public function apply(Zend_Controller_Request_Abstract $request, $filterBlock) {
        $catId = (int) Mage::helper('multilayer')->getParam($this->getRequestVar());
        if ($catId) {
            $request->setParam($this->getRequestVar(), $catId);
            parent::apply($request, $filterBlock);
        }
        return $this;
    }

    public function getRootCategory() {
        if (is_null($this->cat)) {
            $this->cat = Mage::getModel('catalog/category')
                    ->load($this->getLayer()->getCurrentStore()->getRootCategoryId());
        }
        return $this->cat;
    }

    protected function _getItemsData() {
        $key = $this->getLayer()->getStateKey() . '_SUBCATEGORIES';
        $key .= Mage::helper('multilayer')->getCacheKey('cat');
        $pageKey = Mage::getBlockSingleton('page/html_pager')->getPageVarName();
        $queryStr = Mage::helper('multilayer')->getParams(true, $pageKey);
        $data = $this->getLayer()->getAggregator()->getCacheData($key);

        if ($data === null) {
            $category = null;
            $showTopCategories = Mage::getStoreConfig('multilayer/multilayer/top_cats');
            if ($showTopCategories)
                $category = $this->getRootCategory();
            else
                $category = $this->getCategory();
            Mage::register('selected_cat_id', $category->getId());
            /** @var $categoty Mage_Catalog_Model_Categeory */
            $categories = $category->getChildrenCategories();
            $data = array();
            $level = 0;
            $parent = null;
            if ($category->getLevel() > 1) { // current category is not root
                $parent = $category->getParentCategory();

                ++$level;
                if ($parent->getLevel() > 1) {
                    $data[] = array(
                        'label' => $parent->getName(),
                        'value' => $parent->getUrl(),
                        'level' => $level,
                        'category_id' => $parent->getId(),
                        'uri' => $queryStr,
                    );
                }
                //always include current category
                ++$level;
                $data[] = array(
                    'label' => $category->getName(),
                    'value' => '',
                    'level' => $level,
                    'is_current' => true,
                    'category_id' => $category->getId(),
                    'uri' => $queryStr,
                );
            }

            if (!$showTopCategories) {
                $this->getLayer()->getProductCollection()
                        ->addCountToCategories($categories);
            }


            ++$level;
            foreach ($categories as $cat) {
                if ($cat->getIsActive() && ($showTopCategories || $cat->getProductCount())) {
                    $data[] = array(
                        'label' => $cat->getName(),
                        'value' => $cat->getId(),
                        'count' => $cat->getProductCount(),
                        'level' => $level,
                        'category_id' => $cat->getId(),
                        'uri' => $cat->getUrl(),
                    );
                }
            }



            if (Mage::getStoreConfig('multilayer/multilayer/reset_filters')) {
                $queryStr = '';
            }

            for ($i = 0, $n = sizeof($data); $i < $n; ++$i) {
                $url = $data[$i]['uri'];
                $pos = strpos($url, '?');
                if ($pos)
                    $url = substr($url, 0, $pos);
                $data[$i]['uri'] = $url . $queryStr;
            }
            $tags = $this->getLayer()->getStateTags();
            $this->getLayer()->getAggregator()->saveCacheData($data, $key, $tags);
        }        
        return $data;
    }

    protected function _initItems() {
        $data = $this->_getItemsData();
        $items = array();
        foreach ($data as $itemData) {
            $obj = new Varien_Object();
            $obj->setData($itemData);
            $obj->setUrl($itemData['value']);

            $items[] = $obj;
        }
        $this->_items = $items;
        return $this;
    }

}
