<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

class Amasty_Xlanding_Model_Resource_Cms_Page extends Mage_Sitemap_Model_Resource_Cms_Page 
{
    public function getCollection($storeId)
    {
        $pages = parent::getCollection($storeId);

        $select = Mage::getModel('amlanding/page')->getCollection()
                ->addFieldToFilter('is_active', 1)
                ->getSelect()
                ->join(
        array('amlanding_page_store' => $this->getTable('amlanding/page_store')),
        'main_table.page_id = amlanding_page_store.page_id',
        array())
        ->where('amlanding_page_store.store_id IN (?)', array($storeId));

        $query = $this->_getWriteAdapter()->query($select);

        $urlSuffix  = Mage::helper('catalog/category')->getCategoryUrlSuffix($storeId);
        $urlSuffix  = ($urlSuffix) ? $urlSuffix : '';
        
        while ($row = $query->fetch()) {
            $object = new Varien_Object();
            $object->setId($row['page_id']);
            $object->setUrl($row['identifier'] . $urlSuffix);
            $object->setTitle($row['title']);
            $pages[] = $object;
        }	

        return $pages;
    }
}
