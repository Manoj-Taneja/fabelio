<?php
/**
 * Ptech Multi Select Layer Navigation
 *  
 * @category     Ptech
 * @package      Ptech_Multilayer 
 * @copyright    Copyright (c) 2014-2015 Ptech
 * @author       Ptech (Brijesh Kumar)  
 * @version      Release: 1.0.0
 * @Class        Ptech_Multilayer_Block_Rewrite_RewriteCatalogsearchResult
 * @Overwrite    Mage_CatalogSearch_Block_Result
 */ 
 
class Ptech_Multilayer_Block_Rewrite_RewriteCatalogsearchResult extends Mage_CatalogSearch_Block_Result
{   
    /**
     * Retrieve Search result list HTML output, wrapped with <div>
     * @return string
     */
    public function getProductListHtml()
    {
        $html = parent::getProductListHtml();
        $html = Mage::helper('multilayer')->wrapProducts($html);
        return $html;
    }
	
	/**
     * Set Search Result collection
     *
     * @return Mage_CatalogSearch_Block_Result
     */
    public function setListCollection()
    {
        
        $this->getListBlock()
           ->setCollection($this->_getProductCollection());
       return $this;
    }
    /**
     * Retrieve loaded category collection
     *
     * @return Mage_CatalogSearch_Model_Mysql4_Fulltext_Collection
     */
    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {            
            $this->_productCollection = Mage::getSingleton('catalogsearch/layer')->getProductCollection();
        }
        
        return $this->_productCollection;
    }
	
} 
