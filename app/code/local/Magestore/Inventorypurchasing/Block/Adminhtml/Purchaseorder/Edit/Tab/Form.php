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
class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * prepare tab form's information
     *
     * @return Magestore_Inventory_Block_Adminhtml_Purchaseorder_Edit_Tab_Form
     */
    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $purchaseOrderId = $this->getRequest()->getParam('id');
        $supplierId = $this->getRequest()->getParam('supplier_id');
        $warehouseIds = $this->getRequest()->getParam('warehouse_ids', null);
       
        if (Mage::getSingleton('adminhtml/session')->getPurchaseorderData()) {
            $data = Mage::getSingleton('adminhtml/session')->getPurchaseorderData();
            Mage::getSingleton('adminhtml/session')->setPurchaseorderData(null);
        } elseif (Mage::registry('purchaseorder_data')) {
            $data = Mage::registry('purchaseorder_data')->getData();
        }
        $fieldset = $form->addFieldset('purchaseorder_form', array(
            'legend' => Mage::helper('inventorypurchasing')->__('General information')
                ));
        
        $id = $this->getRequest()->getParam('id');
        $disabled = false;
        if ($id)
            $disabled = true;

        if ($supplierId) {
            $supplierInfo = Mage::helper('inventorypurchasing/supplier')->getSupplierInfoBySupplierId($supplierId);
        }
        if (!$supplierId) {
            $supplierInfo = Mage::helper('inventorypurchasing/purchaseorder')->getSupplierInfoByPurchaseOrderId($purchaseOrderId);
        }
        $warehouseInfo = $this->getWarehouse($warehouseIds);
       
        if ($this->getRequest()->getParam('warehouse_ids'))
            $data['warehouse_id'] = $this->getRequest()->getParam('warehouse_ids');

        if ($this->getRequest()->getParam('id'))
            $fieldset->addField('created_by', 'label', array(
                'label' => Mage::helper('inventorypurchasing')->__('Create by'),
            ));

        if ($this->getRequest()->getParam('id')) {
            $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('id'));
        }

        $fieldset->addField('purchase_on', 'date', array(
            'label' => Mage::helper('inventorypurchasing')->__('Order Created On'),
            'class' => 'required-entry validate-date',
            'required' => true,
            'name' => 'purchase_on',
            'time' => true,
            'disabled' => $disabled,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format' => Mage::app()->getLocale()->getDatetimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));

        $fieldset->addField('supplier_id', 'hidden', array(
            'label' => Mage::helper('inventorypurchasing')->__('Supplier Id'),
            'name' => 'supplier_id',
        ));
        $fieldset->addField('supplier_name', 'link', array(
            'label' => Mage::helper('inventorypurchasing')->__('Supplier'),
            'name' => 'supplier_name',
            'style' => "color:blue",
            'href' => Mage::helper("adminhtml")->getUrl('inventorypurchasingadmin/adminhtml_supplier/edit', array('id' => Mage::helper('inventorypurchasing/purchaseorder')->getDataByPurchaseOrderId($purchaseOrderId, 'supplier_id'))),
            'after_element_html' => $supplierInfo,
        ));

        $fieldset->addField('bill_name', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Billing Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'bill_name',
        ));
        $fieldset->addField('warehouse_ids', 'label', array(
            'label' => Mage::helper('inventorypurchasing')->__('Warehouse'),
            'class' => 'required-entry required',
            'required' => true,
            'disabled' => true,
            'after_element_html' => $warehouseInfo
        ));

        $fieldset->addField('order_placed', 'select', array(
            'label' => Mage::helper('inventorypurchasing')->__('Order placed via'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'order_placed',
            'values' => Mage::helper('inventorypurchasing/purchaseorder')->getOrderPlaced(),
        ));

        $fieldset->addField('started_date', 'date', array(
            'label' => Mage::helper('inventorypurchasing')->__('Start shipping date'),
            'class' => 'required-entry validate-date',
            'required' => true,
            'name' => 'started_date',
            'disabled' => $disabled,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));

        $fieldset->addField('canceled_date', 'date', array(
            'label' => Mage::helper('inventorypurchasing')->__('Cancellation date'),
            'class' => 'required-entry validate-date',
            'required' => true,
            'name' => 'canceled_date',
            'disabled' => $disabled,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'note' => Mage::helper('inventorypurchasing')->__('If an "Awaiting delivery" purchase order has no delivery created, you can cancel it before this date.'),
        ));

        $fieldset->addField('expected_date', 'date', array(
            'label' => Mage::helper('inventorypurchasing')->__('Expected delivery date'),
            'class' => 'required-entry validate-date',
            'required' => true,
            'name' => 'expected_date',
            'disabled' => $disabled,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));

        $fieldset->addField('payment_date', 'date', array(
            'label' => Mage::helper('inventorypurchasing')->__('Payment date'),
            'class' => 'required-entry validate-date',
            'required' => true,
            'name' => 'payment_date',
            'disabled' => $disabled,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));
        
        $fieldset->addType('select_new', 'Magestore_Inventorypurchasing_Block_Adminhtml_Renderer_Selectnew');
        
        $fieldset->addField('ship_via', 'select_new', array(
            'label' => Mage::helper('inventorypurchasing')->__('Shipping via'),
            'name' => 'ship_via',
            'values' => Mage::helper('inventorypurchasing/purchaseorder')->getShippingMethod(),
        ));

        $fieldset->addField('payment_term', 'select_new', array(
            'label' => Mage::helper('inventorypurchasing')->__('Payment terms'),
            'name' => 'payment_term',
            'values' => Mage::helper('inventorypurchasing/purchaseorder')->getPaymentTerms(),
        ));

        $fieldset->addField('comments', 'textarea', array(
            'label' => Mage::helper('inventorypurchasing')->__('Comment'),
            'required' => false,
            'name' => 'comments',
        ));

        if ($this->getRequest()->getParam('id')) {
            $currency = $purchaseOrder->getCurrency();
            if (!$currency) {
                $fieldset->addField('currency', 'select', array(
                    'label' => Mage::helper('inventorypurchasing')->__('Currency'),
                    'class' => 'required-entry',
                    // 'required'    => true,
                    'name' => 'currency',
                    'values' => Mage::app()->getLocale()->getOptionCurrencies(),
                    'after_element_html' => '<script type="text/javascript">$("currency").value=\'' . Mage::app()->getStore($storeId)->getBaseCurrencyCode() . '\'</script>',
                ));
            } else {
                $fieldset->addField('currency', 'select', array(
                    'label' => Mage::helper('inventorypurchasing')->__('Currency'),
                    'class' => 'required-entry',
                    'disabled' => true,
                    'name' => 'currency',
                    'values' => Mage::app()->getLocale()->getOptionCurrencies(),
                ));
            }
        } else {
            $fieldset->addField('currency', 'select', array(
                'label' => Mage::helper('inventorypurchasing')->__('Currency'),
                'class' => 'required-entry',
                // 'required'    => true,
                'name' => 'currency',
                'disabled' => true,
                'values' => Mage::app()->getLocale()->getOptionCurrencies(),
                'after_element_html' => '<script type="text/javascript">$("currency").value=\'' . $this->getRequest()->getParam('currency') . '\'</script>',
            ));
        }
        if (!$this->getRequest()->getParam('id')) {
            $fieldset->addField('change_rate', 'label', array(
                'label' => Mage::helper('inventorypurchasing')->__('Currency Exchange Rate'),
                // 'class'        => 'required-entry',
                // 'required'    => true,
                // 'name'        => 'change_rate',				
                'after_element_html' => '<div id="change_rate_comment"></div>
                                            <script type="text/javascript">
                                                    var base_currency = \'' . Mage::app()->getStore()->getBaseCurrencyCode() . '\';
                                                    var select_currency = $("currency").value;
                                                    var comment = "(1 "+ base_currency +" = ' . $this->getRequest()->getParam('change_rate') . ' " +select_currency +")";
                                                    $("change_rate_comment").innerHTML = comment;
                                            </script>',
            ));
        } else {
            if(!isset($data['change_rate']))
                $data['change_rate'] = '';
            $fieldset->addField('change_rate', 'label', array(
                'label' => Mage::helper('inventorypurchasing')->__('Currency Exchange Rate'),
                // 'class'        => 'required-entry',
                // 'required'    => true,
                // 'name'        => 'change_rate',				
                'after_element_html' => '<div id="change_rate_comment"></div>
                                            <script type="text/javascript">
                                                    var base_currency = \'' . Mage::app()->getStore()->getBaseCurrencyCode() . '\';
                                                    var select_currency = $("currency").value;
                                                    var comment = "(1 "+ base_currency +" = ' . $data['change_rate'] . ' " +select_currency +")";
                                                    $("change_rate_comment").innerHTML = comment;
                                            </script>',
            ));
        }

        $fieldset->addField('tax_rate', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Tax Rate'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'tax_rate',
        ));

        if ($this->getRequest()->getParam('id')) {
            $currency = $purchaseOrder->getCurrency();
        } else {
            $currency = $this->getRequest()->getParam('currency');
        }
        $store = $this->_getStore();
        $storeId = $store->getStoreId();
        $fieldset->addField('shipping_cost', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Shipping Cost'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'shipping_cost',
            'after_element_html' => ' <br /><div id="shipping_cost_comment"></div>
                                        <script type="text/javascript">									
                                                var select_currency = $("currency").value;									
                                                $("shipping_cost_comment").innerHTML = select_currency;
                                        </script>',
        ));


//        $fieldset->addField('paid', 'label', array(
//            'label'        => Mage::helper('inventory')->__('Money Paid'),
//            'required'    => false,
//            'name'        => 'paid',
//            'type'  => 'price',
//            'currency_code' => $store->getBaseCurrency()->getCode(),
//            'after_element_html' => ' '.$store->getBaseCurrency()->getCode(),  
//        ));
        
        if(isset($data['paid'])){            
        }else{
            $data['paid'] = 0;
        }
        
        $fieldset->addField('paid', 'note', array(
            'label' => Mage::helper('inventorypurchasing')->__('Money Paid'),
//            'text' => Mage::app()->getStore($storeId)->getBaseCurrency()->format($data['paid'])
            'text' => Mage::app()->getStore($storeId)->setCurrentCurrency(Mage::getModel('directory/currency')->load($currency))->formatPrice($data['paid']),
        ));

        $fieldset->addField('paid_more', 'text', array(
            'label' => Mage::helper('inventorypurchasing')->__('Last paid payment'),
            'required' => false,
            'name' => 'paid_more',
//            'after_element_html' => ' '.$store->getBaseCurrency()->getCode(),  
            'after_element_html' => ' <br /><div id="paid_more_comment"></div>
                                        <script type="text/javascript">									
                                                var select_currency = $("currency").value;									
                                                $("paid_more_comment").innerHTML = select_currency;
                                        </script>',
        ));

        $fieldset->addField('delivery_process', 'label', array(
            'label' => Mage::helper('inventorypurchasing')->__('Delivery Process'),
            'required' => false,
            'name' => 'delivery_process',
            'after_element_html' => '%',
        ));

        $fieldset->addField('send_mail', 'checkbox', array(
            'label' => Mage::helper('inventorypurchasing')->__('Send email to supplier'),
            'required' => false,
            'name' => 'send_mail',
            'after_element_html' => '<script>
                                    var b=$("bill_name");
                                    if(b.value)
                                    {
                                            $("send_mail").disabled="disabled";
                                    }
                                    if($("send_mail").value==1)
                                    {
                                            $("send_mail").checked=true;
                                    }
            </script>',
        ));
        
        $fieldset->addType('purchase_status', 'Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Edit_Tab_Renderer_Purchasestatus');
        $fieldset->addField('status', 'purchase_status', array(
            'label' => Mage::helper('inventorypurchasing')->__('Status'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'status',
            'values' => array(
                8 => Mage::helper('inventorypurchasing')->__('PO raised'),
                5 => Mage::helper('inventorypurchasing')->__('Awaiting delivery'),
                6 => Mage::helper('inventorypurchasing')->__('Complete'),
	        			7 => Mage::helper('inventorypurchasing')->__('Canceled'),
			        	9 => Mage::helper('inventorypurchasing')->__('Partially QCed')
            ),
            'disabled' => $disabled,
//            'values'        => Mage::helper('inventory/purchaseorder')->getReturnOrderStatus(),
        ));

        if ($this->getRequest()->getParam('id')) {
            //$purchaseOrder = Mage::getModel('inventory/purchaseorder')->load($this->getRequest()->getParam('id'));
            $currency = $purchaseOrder->getCurrency();
            if (!$currency)
                $currency = Mage::app()->getStore($storeId)->getBaseCurrencyCode();
            $changeRate = $purchaseOrder->getChangeRate();
            if (!$changeRate)
                $changeRate = 1;
            $totalBase = $purchaseOrder->getTotalAmount();
            $taxRate = $purchaseOrder->getTaxRate();
            $shippingCost = $purchaseOrder->getShippingCost();
            $totalWithTaxBase = (1 + $taxRate / 100) * ($totalBase);
            $totalCurrency = $totalBase;
          
            $totalWithTaxCurrency = $totalWithTaxBase;
            
            $fieldset->addField('total', 'label', array(
                'required' => false,
                'class' => 'required-entry',
                'after_element_html' => '
                        <table id="checkout-review-table" class="data-table" style="float:right;">
                            <colgroup>
                                <col>
                                <col width="1">
                                <col width="1">
                                <col width="1">
                            </colgroup>
                            <tfoot>
                                <tr class="first">
                                    <td colspan="3" class="a-right" style="padding-right:10px;">' . Mage::helper('inventorypurchasing')->__('Subtotal') . '</td>
                                    <td class="a-right last" style=""><span class="price">' . Mage::getModel('directory/currency')->load($currency)->formatTxt($totalCurrency) . '</span></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="a-right" style="padding-right:10px;">' . Mage::helper('inventorypurchasing')->__('Shipping Cost') . '</td>
                                    <td class="a-right last" style=""><span class="price">' . Mage::getModel('directory/currency')->load($currency)->formatTxt($shippingCost) . '</span></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="a-right" style="padding-right:10px;">' . Mage::helper('inventorypurchasing')->__('Tax') . '</td>
                                    <td class="a-right last" style=""><span class="price">' . $purchaseOrder->getTaxRate() . '%</span></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="a-right" style="padding-right:10px;"><strong>' . Mage::helper('inventorypurchasing')->__('Grand Total (excl. Tax)') . '</strong></td>
                                    <td class="a-right last" style=""><strong><span class="price">' . Mage::getModel('directory/currency')->load($currency)->formatTxt($totalCurrency + $shippingCost) . '</span></strong></td>
                                </tr>
                                <tr class="last">
                                    <td colspan="3" class="a-right" style="padding-right:10px;"><strong>' . Mage::helper('inventorypurchasing')->__('Grand Total (incl. Tax)') . '</strong></td>
                                    <td class="a-right last" style=""><strong><span class="price">' . Mage::getModel('directory/currency')->load($currency)->formatTxt($totalWithTaxCurrency + $shippingCost) . '</span></strong></td>
                                </tr>
                            </tfoot>        
                        </table>         
                                    <!--<br />                                        
                                        <div style="float:right;font-size:14px;">' . Mage::helper('inventorypurchasing')->__('Subtotal: ') . Mage::getModel('directory/currency')->load($currency)->formatTxt($totalCurrency) . '</div><br />
                                        <div style="float:right;font-size:14px;">' . Mage::helper('inventorypurchasing')->__('Shipping Cost: ') . Mage::getModel('directory/currency')->load($currency)->formatTxt($shippingCost) . '</div><br />
                                        <div style="float:right;font-size:14px;">' . Mage::helper('inventorypurchasing')->__('Tax: ') . $purchaseOrder->getTaxRate() . '%</div><br />
                                        <div style="float:right;font-weight:bold;font-size:18px;">' . Mage::helper('inventorypurchasing')->__('Total: ') . Mage::getModel('directory/currency')->load($currency)->formatTxt($totalCurrency + $shippingCost) . '</div><br />
                                        <div style="float:right;font-weight:bold;font-size:18px;">' . Mage::helper('inventorypurchasing')->__('Total(incl Tax): ') . Mage::getModel('directory/currency')->load($currency)->formatTxt($totalWithTaxCurrency + $shippingCost) . '</div>
                                            -->
                                        ',
            ));
        }

        $form->setValues($data);
        return parent::_prepareForm();
    }

    protected function _getStore() {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

    public function getWarehouse($warehouseIds) {
        if (!$warehouseIds) {
            $warehouseIds = Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('id'))->getWarehouseId();
        }
        $warehouseIds = explode(',', $warehouseIds);
        $warehouseNames = '';
        foreach ($warehouseIds as $warehouseId) {
            $warehouseNames .= "<a href='". Mage::helper("adminhtml")->getUrl('inventoryplusadmin/adminhtml_warehouse/edit', array('id' => $warehouseId)) ."'>". Mage::getModel('inventoryplus/warehouse')->load($warehouseId)->getWarehouseName() . "</a><br />";
        }
        return "<b>".$warehouseNames . "</b>";
    }

}
