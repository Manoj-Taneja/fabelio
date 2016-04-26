<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Full Page Cache
 * @version   1.0.1
 * @build     360
 * @copyright Copyright (C) 2015 Mirasvit (http://mirasvit.com/)
 */



class Mirasvit_Fpc_Model_Validator
{
    protected $_dataChangeDependency = array(
        'Mage_Catalog_Model_Product',
        'Mage_Catalog_Model_Category',
        'Mage_Catalog_Model_Resource_Eav_Attribute',
        'Mage_Tag_Model_Tag',
        'Mage_Review_Model_Review',
        'Enterprise_Cms_Model_Hierarchy_Node',
        'Enterprise_Banner_Model_Banner',
        'Mage_Core_Config_Backend_Design_Exception',
        'Mage_Core_Model_Store_Group',
    );
    protected $_dataDeleteDependency = array(
        'Mage_Catalog_Model_Category',
        'Mage_Catalog_Model_Resource_Eav_Attribute',
        'Mage_Tag_Model_Tag',
        'Mage_Review_Model_Review',
        'Enterprise_Cms_Model_Hierarchy_Node',
        'Enterprise_Banner_Model_Banner',
        'Mage_Core_Model_Store_Group',
        'Mage_Core_Config_Backend_Design_Exception',
    );

    /**
     * Mark full page cache as invalidated.
     */
    protected function _invalidateCache()
    {
        Mage::app()->getCacheInstance()->invalidateType('fpc');
    }

    /**
     * Get list of all classes related with object instance.
     *
     * @param $object
     *
     * @return array
     */
    protected function _getObjectClasses($object)
    {
        $classes = array();
        if (is_object($object)) {
            $classes[] = get_class($object);
            $parent = $object;
            while ($parentClass = get_parent_class($parent)) {
                $classes[] = $parentClass;
                $parent = $parentClass;
            }
        }

        return $classes;
    }

    /**
     * Check if duering data change was used some model related with page cache and invalidate cache.
     *
     * @param mixed $object
     *
     * @return Enterprise_PageCache_Model_Validator
     */
    public function checkDataChange($object)
    {
        $classes = $this->_getObjectClasses($object);
        $intersect = array_intersect($this->_dataChangeDependency, $classes);

        if (!empty($intersect)) {
            // $this->_invalidateCache();
        }

        return $this;
    }

    /**
     * Check if duering data delete was used some model related with page cache and invalidate cache.
     *
     * @param mixed $object
     *
     * @return Enterprise_PageCache_Model_Validator
     */
    public function checkDataDelete($object)
    {
        $classes = $this->_getObjectClasses($object);
        $intersect = array_intersect($this->_dataDeleteDependency, $classes);

        if (!empty($intersect)) {
            // $this->_invalidateCache();
        }

        return $this;
    }
}
