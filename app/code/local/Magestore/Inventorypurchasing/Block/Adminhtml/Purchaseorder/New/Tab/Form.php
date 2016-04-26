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
 * Inventory Supplier Edit Form Content Tab Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_New_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareLayout() {
        if (count(Mage::helper('inventorypurchasing/purchaseorder')->getWarehouseOption()) > 0) {
            $this->setChild('continue_button', $this->getLayout()->createBlock('adminhtml/widget_button')
                            ->setData(array(
                                'label' => Mage::helper('inventorypurchasing')->__('Continue'),
                                'onclick' => "setSettings('" . $this->getContinueUrl() . "','supplier_id')",
                                'class' => 'save'
                            ))
            );
        }
        return parent::_prepareLayout();
    }

    /**
     * prepare tab form's information
     *
     * @return Magestore_Inventory_Block_Adminhtml_Purchaseorder_Edit_Tab_Form
     */
    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        if (count(Mage::helper('inventorypurchasing/purchaseorder')->getWarehouseOption()) <= 0) { // Add by Magnus
            $fieldset = $form->addFieldset('purchaseorder_form', array(
                'legend' => Mage::helper('inventorypurchasing')->__('Select Supplier & Warehouses')
            ));
            $fieldset->addField('pinput_hidden', 'hidden', array(
                'name' => 'pinput_hidden',
                'after_element_html' => '<div id="messages"><ul class="messages"><li class="error-msg"><ul><li><span>' . $this->__("You don't have permission to create purchase orders for any warehouses.") . '</span></li></ul></li></ul></div>'
            ));
            return parent::_prepareForm();
        }

        $data = '';
        if (Mage::getSingleton('adminhtml/session')->getPurchaseorderData()) {
            $data = Mage::getSingleton('adminhtml/session')->getPurchaseorderData();
            Mage::getSingleton('adminhtml/session')->setPurchaseorderData(null);
        } elseif (Mage::registry('purchaseorder_data')) {
            $data = Mage::registry('purchaseorder_data')->getData();
        }
        if (is_null($data)) {
            $post = $this->getRequest()->getPost();

            Mage::dispatchEvent('purchaseorder_new_tab_form_prepare', array('product_list' => $post['product_list']));

            if (isset($post['warehouse_select'])) {
                if ($post['warehouse_select'] != '') {
                    $data['warehouse_ids'] = $post['warehouse_select'];
                }
            }
            if (isset($post['supplier_select']))
                $data['supplier_id'] = $post['supplier_select'];
        }
        $fieldset = $form->addFieldset('purchaseorder_form', array(
            'legend' => Mage::helper('inventorypurchasing')->__('Select Supplier')
        ));

        //add Field to form

        $fieldset->addField('supplier_id', 'select', array(
            'label' => Mage::helper('inventorypurchasing')->__('Supplier'),
            'class' => 'required-entry',
            'name' => 'supplier_id',
            'disabled' => false,
            'values' => Mage::helper('inventorypurchasing/supplier')->returnArrAllRowOfcolumnOftableSupplier('supplier_name'),
            'after_element_html' => '<script type="text/javascript">
                var productTemplateSyntax = /(^|.|\r|\n)({{(\w+)}})/;                   
                    function setSettings(urlTemplate, setElement) {
                        var supplier_id = $("supplier_id").value;
                        var currency = $("currency").value;                        
                        var change_rate = $("change_rate").value;
                        
                        var select1 = document.getElementById("warehouse_ids");
                        var wSelected = "";
                        var j = 0;
                        for (var i = 0; i < select1.length; i++) {
                            if (select1.options[i].selected){
                                if(j!=0) wSelected += ",";
                                wSelected += select1.options[i].value;
                                j++;
                            }
                        }

                        if(!change_rate){
                            alert("Please fill Currency Change Rate to continue!");
                            return false;
                        }

                        var warehouse_ids = wSelected;
                        if(!warehouse_ids)
                            warehouse_ids = select1.value;
                        if(!warehouse_ids){
                            alert("Please select warehouse to continue!");
                            return false;
                        }
                        
                        setLocation(urlTemplate+"supplier_id/"+supplier_id+"/warehouse_ids/"+warehouse_ids+"/currency/"+currency+"/change_rate/"+change_rate);
                    } 
                </script>'
        ));

        $fieldset->addField('currency', 'select', array(
            'label' => Mage::helper('inventorypurchasing')->__('Currency'),
            'class' => 'required-entry',
            // 'required'    => true,
            'name' => 'currency',
            'values' => Mage::app()->getLocale()->getOptionCurrencies(),
            'after_element_html' => '<script type="text/javascript">$("currency").value=\'' . Mage::app()->getStore()->getBaseCurrencyCode() . '\'</script>',
        ));

        $fieldset->addField('change_rate', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Currency Exchange Rate'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'change_rate',
            'after_element_html' => '<br /><div id="change_rate_comment"></div>
                                    <script type="text/javascript">
                                            var base_currency = \'' . Mage::app()->getStore()->getBaseCurrencyCode() . '\';
                                            var select_currency = $("currency").value;
                                            var change_rate = $("change_rate").value;
                                            if(!change_rate){
                                                $("change_rate").value = 1;
                                            }
                                            var comment = "(1 "+ base_currency +" = "+ $("change_rate").value +" "+select_currency +")";
                                            $("change_rate_comment").innerHTML = comment;
                                    </script>',
        ));
        if (Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse')) {
            $fieldset->addField('warehouse_ids', 'multiselect', array(
                'label' => Mage::helper('inventorypurchasing')->__('Warehouse(s)'),
                'class' => 'required-entry',
                'name' => 'warehouse_ids',
                'disabled' => false,
                'required' => true,
                'values' => Mage::helper('inventorypurchasing/purchaseorder')->getWarehouseOption()
            ));
        } else {
            $fieldset->addField('warehouse_ids', 'hidden', array(
                'name' => 'warehouse_ids'
            ));
        }

        $fieldset->addField('continue_button', 'note', array(
            'text' => $this->getChildHtml('continue_button'),
        ));

        $form->setValues($data);
        $form->addValues(array('warehouse_ids' => Mage::getModel('inventoryplus/warehouse')->getCollection()->getFirstItem()->getId()));
        return parent::_prepareForm();
    }

    public function getContinueUrl() {
        return $this->getUrl('*/*/new', array(
                    '_current' => true,
        ));
    }

}
