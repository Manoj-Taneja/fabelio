<?php

class Cminds_Marketplace_Block_Adminhtml_Customer_Edit_Tabs extends Mage_Adminhtml_Block_Customer_Edit_Tabs
{
    protected function _beforeToHtml()
    {
        if(Mage::helper('marketplace')->isSupplier(Mage::registry('current_customer')->getId())) {
            $this->addTabAfter('shipping_data', array(
                'label'     => Mage::helper('marketplace')->__('Shipping Costs'),
                'class'     => 'ajax',
                'url'       => $this->getUrl('*/suppliers/shippingCosts', array('_current' => true)),
            ),'account');

            $this->addTabAfter('sold_products', array(
                'label'     => Mage::helper('marketplace')->__('Sold Products'),
                'class'     => 'ajax',
                'url'       => $this->getUrl('*/suppliers/soldProducts', array('_current' => true)),
            ),'shipping_data');

            $this->addTabAfter('supplier_profile', array(
                'label'     => Mage::helper('marketplace')->__('Supplier Profile'),
                'class'     => 'ajax',
                'url'       => $this->getUrl('*/suppliers/profile', array('_current' => true)),
            ),'sold_products');

            $this->addTabAfter('supplier_rates', array(
                'label'     => Mage::helper('marketplace')->__('Customer Rates'),
                'class'     => 'ajax',
                'url'       => $this->getUrl('*/suppliers/rates', array('_current' => true)),
            ),'supplier_profile');

            $this->addTabAfter('assigned_categories', array(
                'label'     => Mage::helper('marketplace')->__('Allowed Categories'),
                'class'     => 'ajax',
                'url'       => $this->getUrl('*/suppliers/assignedCategories', array('_current' => true)),
            ),'supplier_profile');
        }

        parent::_beforeToHtml();
    }
}
