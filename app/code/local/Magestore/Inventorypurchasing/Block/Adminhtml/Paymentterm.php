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
 * Supplier Adminhtml Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventorypurchasing_Block_Adminhtml_Paymentterm extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_paymentterm';
        $this->_blockGroup = 'inventorypurchasing';
        $this->_headerText = Mage::helper('inventorypurchasing')->__('Payment Term Manager');
        $this->_addButtonLabel = Mage::helper('inventorypurchasing')->__('Add Payment Term');
        parent::__construct();
    }

    public function getPaymentTermHistory($id) {
        return Mage::getModel('inventorypurchasing/paymentterm_history')->load($id);
    }

    public function getPaymentTermContentByHistoryId($id) {
        $collection = Mage::getModel('inventorypurchasing/paymentterm_historycontent')
                ->getCollection()
                ->addFieldToFilter('payment_term_history_id', $id);
        return $collection;
    }

}