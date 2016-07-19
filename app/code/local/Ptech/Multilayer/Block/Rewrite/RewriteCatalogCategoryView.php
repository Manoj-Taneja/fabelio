<?php
/**
 * Ptech Multi Select Layer Navigation
 *  
 * @category     Ptech
 * @package      Ptech_Multilayer 
 * @copyright    Copyright (c) 2014-2015 Ptech
 * @author       Ptech (Brijesh Kumar)  
 * @version      Release: 1.0.0
 * @Class        Ptech_Multilayer_Block_Rewrite_RewriteCatalogCategoryView
 * @Overwrite    Mage_Catalog_Block_Category_View
 */ 

class Ptech_Multilayer_Block_Rewrite_RewriteCatalogCategoryView extends Mage_Catalog_Block_Category_View
{ 
    public function getProductListHtml()
    {
        $html = parent::getProductListHtml();
        if ($this->getCurrentCategory()->getIsAnchor()){
            $html = Mage::helper('multilayer')->wrapProducts($html);
        }
        return $html;
    }   
} 
