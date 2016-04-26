<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */ 
class Amasty_Xlanding_Block_Adminhtml_Page_Edit_Tab_Filter
    extends Mage_Adminhtml_Block_Widget_Form {
    
    protected $_path = array();
    
    protected function _prepareForm()
    {
        $helper = Mage::helper('amlanding');
        $model = Mage::registry('amlanding_page');
        
        $form = new Varien_Data_Form();
        
        
        $fieldset = $form->addFieldset('state_fieldset', array('legend'=>$helper->__('State')));
        
        $fieldset->addField('is_new', 'select', array(
            'name'      => 'is_new',
            'label'     => $helper->__('Is New'),
            'title'     => $helper->__('Is New'),
            'options'   => array(
                0 => $this->__('Does not matter'),
                1 => $this->__('No'),
                2 => $this->__('Yes')
            )
        ));
        
        $fieldset->addField('is_sale_by_rule', 'select', array(
            'name'      => 'is_sale_by_rule',
            'label'     => $helper->__('Is on Sale'),
            'title'     => $helper->__('Is on Sale'),
            'options'   => array(
                0 => $this->__('Does not matter'),
                1 => $this->__('No'),
                2 => $this->__('Yes')
            )
        ));
        
        $fieldset = $form->addFieldset('category_fieldset', array('legend'=>$helper->__('Category')));
        $fieldset->addField('category', 'select', array(
            'name'      => 'category',
            'label'     => $helper->__('Category Is'),
            'title'     => $helper->__('Category Is'),
            'options'   => $this->getOptionsForFilter()
        ));
        
        $fieldset = $form->addFieldset('stock_fieldset', array('legend'=>$helper->__('Stock')));
        $fieldset->addField('stock_status', 'select', array(
            'name'      => 'stock_status',
            'label'     => $helper->__('Status'),
            'title'     => $helper->__('Status'),
            'options'   => array(
                0 => $this->__('Does not matter'),
                2 => $this->__('In Stock')
            )
        ));
        
        
        $renderer = Mage::getBlockSingleton('adminhtml/widget_form_renderer_fieldset')
            ->setTemplate('promo/fieldset.phtml')
            ->setNewChildUrl($this->getUrl('*/lpage/newConditionHtml/form/conditions_conditions_fieldset'));

        $fieldset = $form->addFieldset('conditions_conditions_fieldset', array(
            'legend' => Mage::helper('amlanding')->__('Advanced Filter (leave blank for all products)')
        ))->setRenderer($renderer);

        $fieldset->addField('conditions', 'text', array(
            'name' => 'conditions',
            'label' => Mage::helper('amlanding')->__('Conditions'),
            'title' => Mage::helper('amlanding')->__('Conditions'),
        ))->setRule($model)->setRenderer(Mage::getBlockSingleton('rule/conditions'));

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
        
    }
    
        public function getOptionsForFilter()
        {
            
            $parentId       = Mage_Catalog_Model_Category::TREE_ROOT_ID;

            $category       = Mage::getModel('catalog/category');
            $parentCategory = $category->load($parentId);

            $this->_buildPath($parentCategory);

            $options = array();
            $options[0] = $this->__('');
            foreach ($this->_path as $i => $path)
            {
                $string = str_repeat(". ", max(0, ($path['level'] - 1) * 3)) . $path['name'];
                $options[$path['id']] = $string;
            }
            return $options;
        }
        
        protected function _buildPath($category)
        {
            if ($category->getName() && $category->getId() != Mage_Catalog_Model_Category::TREE_ROOT_ID) // main root category will have no name, so we'll not add it
            {
                $this->_path[] = array(
                    'id'    => $category->getId(),
                    'level' => $category->getLevel(),
                    'name'  => $category->getName(),
                );
            }
            if ($category->hasChildren())
            {
                foreach ($this->getChildrenCategories($category) as $child)
                {
                    $this->_buildPath($child);
                }
            }
        }
        
        public function getChildrenCategories($category)
        {
    //        var_dump(get_class($category->getResource()));
    //        $ids = implode(',', $category->getResource()->getChildren($category, FALSE, FALSE));

            $collection = $category->getCollection();
            /* @var $collection Mage_Catalog_Model_Resource_Category_Collection */
            $collection->addAttributeToSelect('url_key')
                ->addAttributeToSelect('name')
                ->addAttributeToSelect('all_children')
                ->addAttributeToSelect('is_anchor')
    //            ->addAttributeToFilter('is_active', 1)
                ->addFieldToFilter('parent_id', $category->getId())
                ->setOrder('position', Varien_Db_Select::SQL_ASC)
                ->joinUrlRewrite()
                ->load();

            return $collection;
        }
}
?>