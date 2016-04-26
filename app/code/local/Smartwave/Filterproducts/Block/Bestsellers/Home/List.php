<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of List
 *
 * @author om
 */
class Smartwave_Filterproducts_Block_Bestsellers_Home_List extends Smartwave_Filterproducts_Block_Bestsellers_List
{

	protected function _getProductCollection()
    {
        
        $storeId = Mage::app()->getStore()->getId();
        $category_id = $this->getCategoryId();
        
        if($category_id) {
        
            $category = Mage::getModel('catalog/category')->load($category_id);
        
            $products = Mage::getResourceModel('reports/product_collection')
                ->addCategoryFilter($category)
                ->addAttributeToSelect('*')
                ->addOrderedQty()
                ->setStoreId($storeId)
                ->addStoreFilter($storeId)
                ->setOrder('ordered_qty', 'desc')
                ->setPageSize($this->getProductCount());
        }
        else {
            
            $products = Mage::getResourceModel('reports/product_collection')
                ->addAttributeToSelect('*')
                ->addOrderedQty()
                ->setStoreId($storeId)
                ->addStoreFilter($storeId)
                ->setOrder('ordered_qty', 'desc')
                ->setPageSize($this->getProductCount());         
        }

		$productFlatData = Mage::getStoreConfig('catalog/frontend/flat_catalog_product');
		if($productFlatData == "1")
		{
			$products->getSelect()->joinLeft(
	                array('flat' => 'catalog_product_flat_'.$storeId),
	                "(e.entity_id = flat.entity_id ) ",
	                //array(
//	                   'flat.name AS name','flat.image AS small_image','flat.price AS price','flat.minimal_price as minimal_price','flat.special_price as special_price','flat.special_from_date AS special_from_date','flat.special_to_date AS special_to_date'
//	                )
					array(
	                   'flat.name AS name','flat.small_image AS small_image','flat.price AS price','flat.special_price as special_price','flat.special_from_date AS special_from_date','flat.special_to_date AS special_to_date'
					)
	            );
		}

        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
        $store = Mage::app()->getStore();
        $code  = $store->getCode();
        if(!Mage::getStoreConfig("cataloginventory/options/show_out_of_stock", $code))
            Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($products); 
        $this->_productCollection = $products;

        return $this->_productCollection;
    	}

		public function getToolbarHtml()
    	{

    	}
}