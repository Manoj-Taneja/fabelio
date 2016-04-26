<?php

/**
 * Magestore
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventory Supplier Edit Tabs Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('supplier_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('inventorypurchasing')->__('Supplier Information'));
    }

    /**
     * prepare before render block to html
     *
     * @return Magestore_Inventory_Block_Adminhtml_Inventory_Edit_Tabs
     */
    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('inventorypurchasing')->__('General Information'),
            'title' => Mage::helper('inventorypurchasing')->__('General Information'),
            'content' => $this->getLayout()
                    ->createBlock('inventorypurchasing/adminhtml_supplier_edit_tab_form')
                    ->toHtml(),
        ));

        $this->addTab('products_section', array(
            'label' => Mage::helper('inventorypurchasing')->__('Products'),
            'title' => Mage::helper('inventorypurchasing')->__('Products'),
            'url' => $this->getUrl('*/*/product', array(
                '_current' => true,
                'id' => $this->getRequest()->getParam('id'),
                'store' => $this->getRequest()->getParam('store')
            )),
            'class' => 'ajax',
        ));
        if ($this->getRequest()->getParam('id')) {
            $this->addTab('purchaseorder_section', array(
                'label' => Mage::helper('inventorypurchasing')->__('Purchase Orders'),
                'title' => Mage::helper('inventorypurchasing')->__('Purchase Orders'),
                'url' => $this->getUrl('*/*/purchaseorder', array(
                    '_current' => true,
                    'id' => $this->getRequest()->getParam('id'),
                    'store' => $this->getRequest()->getParam('store')
                )),
                'class' => 'ajax',
            ));
            $this->addTab('returnorder_section', array(
                'label' => Mage::helper('inventorypurchasing')->__('Return Orders'),
                'title' => Mage::helper('inventorypurchasing')->__('Return Orders'),
                'url' => $this->getUrl('*/*/returnorder', array(
                    '_current' => true,
                    'id' => $this->getRequest()->getParam('id'),
                    'store' => $this->getRequest()->getParam('store')
                )),
                'class' => 'ajax',
            ));
            
             Mage::dispatchEvent('add_supplier_tabs', array('tabs' => $this));

            $this->addTab('history_section', array(
                'label' => Mage::helper('inventorypurchasing')->__('Change History'),
                'title' => Mage::helper('inventorypurchasing')->__('Change History'),
                'url' => $this->getUrl('*/*/history', array(
                    '_current' => true,
                    'id' => $this->getRequest()->getParam('id'),
                    'store' => $this->getRequest()->getParam('store')
                )),            
                'class' => 'ajax',
            ));
        }
        return parent::_beforeToHtml();
    }

}