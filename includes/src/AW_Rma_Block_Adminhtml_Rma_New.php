<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Rma
 * @version    1.5.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Rma_Block_Adminhtml_Rma_New extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_rma';
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'awrma';

        $this->_updateButton('save', 'onclick', 'validate()');
        $this->_updateButton('save', 'id', 'awrma-save-button');
        $this->_updateButton('save', 'label',  Mage::helper('awrma')->__('Next'));
        $this->_removeButton('delete');

        $this->_formScripts[] = "
            function validate() {
                var dataForm = new varienForm('new_form', '');
                dataForm.submit();
            }

            function suggestOrder(text) {
                var options = '';
                var url='" . Mage::getSingleton('adminhtml/url')->getUrl('awrma_admin/adminhtml_rma/ordersuggest') . "';
                new Ajax.Request(url, {
                    method: 'post',
                    parameters: {'text':text},
                    onSuccess: function(transport) {
                        try {
                            var orders = transport.responseText;
                            orders = orders.evalJSON();
                            orders.each(function(item) {
                                options += '<option value=\"' + item.value +'\">' + item.text + '</option>';
                            });
                        } catch(e) {}
                        $('order-selector').update(options);
                    }
                });
            }

            Event.observe(window, 'load', function() {

            Event.observe($('order_input'), 'click', function() {
                var orderField = $('order_input');
                if(orderField.hasClassName('awrma-tip')) {
                    orderField.setValue('');
                    orderField.removeClassName('awrma-tip');
                }
            });

            Event.observe($('order_input'), 'keyup', function() {
                var orderField = $('order_input');
                if(orderField.getValue().length > 2)
                    suggestOrder(orderField.getValue());
            });

            Event.observe($('order-selector'), 'change', function() {
                var selector = $('order-selector');
                if(selector.getValue()) {
                    $('order_input').setValue(\"" . $this->__("start type order's id") . "\");
                    $('order_input').addClassName('awrma-tip');
                }
            });
        });";
    }

    public function getHeaderText()
    {
        return $this->__('Add New RMA');
    }
}