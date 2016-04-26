<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */ 
class Amasty_Xlanding_Block_Catalog_Pager extends Mage_Page_Block_Html_Pager
{
    public function getPagerUrl($params=array())
    {
        return $this->getParentBlock()->getPagerUrl($params);
    }
    
    public function getModuleName()
    {
        return "Mage_Catalog";
    }
}