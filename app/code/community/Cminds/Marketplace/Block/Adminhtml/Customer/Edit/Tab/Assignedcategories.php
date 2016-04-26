<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml customer orders grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Cminds_Marketplace_Block_Adminhtml_Customer_Edit_Tab_Assignedcategories extends Mage_Adminhtml_Block_Widget_Grid
{
    private $_selectedCategories;
    private $_selectedAllCategories;

    public function __construct()
    {
        parent::__construct();
        $this->setId('supplier_assigned_categories');
        $this->setDefaultSort('name');
        $this->setDefaultDir('asc');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('catalog/category')->getCollection()
            ->addFieldToFilter('level', array('neq' => 0))
            ->addFieldToFilter('level', array('neq' => 1))
            ->addFieldToFilter('available_for_supplier', 1)
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('available_for_supplier');

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('in_products', array(
            'header_css_class' => 'a-center',
            'type'      => 'checkbox',
            'field_name' => 'categories_ids[]',
            'values'    => $this->_getSelectedCategories(),
            'align'     => 'center',
            'index'     => 'entity_id'
        ));
        $this->addColumn('all_categories', array(
            'type'      => 'checkbox',
            'field_name' => 'all_categories_ids[]',
            'values'    => $this->_getSelectedAllCategories(),
            'align'     => 'center',
            'column_css_class' => 'no-display',
            'header_css_class' => 'no-display',
            'index'     => 'entity_id'
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('catalog')->__('Category Name'),
            'index'     => 'name',
        ));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/assignedCategories', array('_current' => true));
    }

    public function getRowUrl($row)
    {
        return false;
    }

    private function _getSelectedCategories() {
        $supplier_id = Mage::app()->getRequest()->getParam('id');

        if(!$this->_selectedCategories) {
            $categories = Mage::getModel('marketplace/categories')->getCollection()->addFilter('supplier_id', $supplier_id);
            $_selectedCategories = array();

            foreach($categories AS $link) {
                $_selectedCategories[] = $link->getCategoryId();
            }

            $allCategories = $this->_getSelectedAllCategories();

            foreach($allCategories AS $category_id) {
                if(!in_array($category_id, $_selectedCategories)) {
                    $this->_selectedCategories[] = $category_id;
                }
            }
        }

        return $this->_selectedCategories;
    }

    private function _getSelectedAllCategories() {
        if(!$this->_selectedAllCategories) {
            $categories = Mage::getModel('catalog/category')->getCollection();
            $this->_selectedAllCategories = array();

            foreach($categories AS $link) {
                $this->_selectedAllCategories[] = $link->getId();
            }
        }
        return $this->_selectedAllCategories;
    }
}
