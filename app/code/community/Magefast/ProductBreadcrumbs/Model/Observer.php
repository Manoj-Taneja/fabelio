<?php

class Magefast_ProductBreadcrumbs_Model_Observer
{
    protected $_categoriesLevel4 = null;


    public function refreshCache($observer)
    {
//        $tags = $observer->getEvent()->getData('tags');
//
//        if (is_array($tags) && count($tags) == 0) {
//            Mage::app()->getCache()->clean('all', array(Magefast_ProductBreadcrumbs_Helper_Data::CACHE_TAG));
//        }
    }


    public function updateBreadcrumbs($observer)
    {
        $layout = $observer->getLayout();

        /**
         * Return, if have not Bradcrubs block
         */
        if (!$layout->getBlock('breadcrumbs')) {
            return $this;
        }

        /**
         * Return, if exist current category - go to Standart logic
         */
        $currentCategory = Mage::registry('current_category');

        if ($currentCategory) {
            return $this;
        }

        /**
         * Return, if have not product, not product page
         */
        $currentProduct = Mage::registry('current_product');

        if (!$currentProduct) {
            return $this;
        }


        if ($catIds = $currentProduct->getCategoryIds()) {
            if (is_array($catIds) && count($catIds) > 0) {

                $cacheId = 'magefast_product_breadcrumbs_' . $currentProduct->getId() . '_' . Mage::app()->getStore()->getId();
                if (false !== ($data = Mage::app()->getCache()->load($cacheId))) {
                    $breadcrumbs = unserialize($data);
                } else {
                    $breadcrumbs = $this->_getDataForNewBreadcrumbs($catIds);
                    Mage::app()->getCache()->save(
                        serialize($breadcrumbs),
                        $cacheId,
                        array(
                            Mage_Core_Block_Abstract::CACHE_GROUP,
                            Mage_Core_Model_Store::CACHE_TAG,
                            Mage_Catalog_Model_Product::CACHE_TAG,
                            Mage_Catalog_Model_Category::CACHE_TAG,
                            Magefast_ProductBreadcrumbs_Helper_Data::CACHE_TAG
                        ),
                        999999
                    );
                }

                //$breadcrumbs = $this->_getDataForNewBreadcrumbs($catIds);

                if (isset($breadcrumbs) && count($breadcrumbs) > 0) {
                    if ($breadcrumbs_block = $layout->getBlock('breadcrumbs')) {

                        /**
                         * Remove crumb for Product
                         */
                        $breadcrumbs_block->removeCrumbs('product');

                        /**
                         * Add new crumbs,
                         * for Homepage
                         */
                        $breadcrumbs_block->addCrumb(
                            'home',
                            array(
                                'label' => Mage::helper('cms')->__('Home'),
                                'title' => Mage::helper('cms')->__('Go to Home Page'),
                                'link' => Mage::getBaseUrl()
                            )
                        );

                        /**
                         * For categories, where include product
                         */
                        foreach ($breadcrumbs as $b) {
                            $breadcrumbs_block->addCrumb('category' . $b['category'], array(
                                'label' => $b['name'],
                                'title' => $b['name'],
                                'link' => $b['url'],
                                'first' => true,
                            ));
                        }

                        /**
                         * And for current product
                         */
                        $breadcrumbs_block->addCrumb('product', array(
                            'label' => $currentProduct->getName(),
                            'readonly' => false,
                            'last' => true
                        ));
                    }
                }
            }
        }

        return $this;
    }


    /**
     * Get array with categories
     *
     * @return array
     */
    protected function _getCategoriesArray()
    {
        $skipCategoryIDsArray = Mage::helper('magefast_productbreadcrumbs')->getSkipCategoryIDs();

        $storeId = Mage::app()->getStore()->getId();
        $rootCategoryId = Mage::app()->getStore()->getRootCategoryId();
        $rootCategoryPath = Mage::getModel('catalog/category')->load($rootCategoryId)->getPath();

        $categoriesArray = Mage::getModel('catalog/category')
            ->setStoreId($storeId)
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('path')
            ->addAttributeToSelect('is_active')
            ->addAttributeToFilter('is_active', array('in' => array(1)))
            ->addAttributeToFilter('path', array("like" => $rootCategoryPath . "/" . "%"));;

        $categoryArray = array();
        foreach ($categoriesArray as $category) {
            if (isset($skipCategoryIDsArray[$category->getId()]) && $skipCategoryIDsArray[$category->getId()]) {
                continue;
            }
            $categoryData = $category->getData();
            $categoryArray[$categoryData['entity_id']] = $categoryData;
            $categoryArray[$categoryData['entity_id']]['url'] = $category->getUrl();
        }
        unset($categoriesArray);

        return $categoryArray;
    }

    protected function _getDataForNewBreadcrumbs($catIds)
    {
        $breadcrumbs = array();
        $categories = $this->_getCategoriesArray();

        foreach ($catIds as $c) {
            if (isset($skipCategoryIDsArray[$c])) {
                continue;
            }
            if (isset($categories[$c]) && $categories[$c]['level'] == 4) {
                $productCategory = $categories[$c];
                break;
            }

            if (isset($categories[$c]) && $categories[$c]['level'] == 3) {
                $productCategory = $categories[$c];
                break;
            }

            if (isset($categories[$c]) && $categories[$c]['level'] == 2) {
                $productCategory = $categories[$c];
                break;
            }
        }

        if (!isset($productCategory)) {
            return $breadcrumbs;
        }

        $path = $productCategory['path'];
        $pathCategories = explode('/', $path);
        $rootCategoryId = Mage::app()->getStore()->getRootCategoryId();

        foreach ($pathCategories as $pc) {
            if ($pc == 1 || $pc == intval($rootCategoryId)) {
                continue;
            }
            $breadcrumbs[$pc]['name'] = $categories[$pc]['name'];
            $breadcrumbs[$pc]['url'] = $categories[$pc]['url'];
            $breadcrumbs[$pc]['category'] = $pc;
        }

        return $breadcrumbs;
    }
}