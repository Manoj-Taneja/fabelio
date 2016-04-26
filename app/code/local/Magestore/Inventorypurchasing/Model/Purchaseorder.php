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
 * @category 	Magestore
 * @package 	Magestore_Inventorysupplier
 * @copyright 	Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license 	http://www.magestore.com/license-agreement.html
 */

/**
 * Inventorysupplier Model
 * 
 * @category 	Magestore
 * @package 	Magestore_Inventorysupplier
 * @author  	Magestore Developer
 */
class Magestore_Inventorypurchasing_Model_Purchaseorder extends Mage_Core_Model_Abstract {

    protected $_eventPrefix = 'inventorypurchasing_purchaseorder';
    protected $_eventObject = 'inventorypurchasing_purchaseorder';
    
    public function _construct() {
        parent::_construct();
        $this->_init('inventorypurchasing/purchaseorder');
    }

    public function getPurhcaseOrderHistory($id) {
        return Mage::getModel('inventorypurchasing/purchaseorder_history')->load($id);
    }
    
    public function getPurchaseOrderContentByHistoryId($id) {
        $collection = Mage::getModel('inventorypurchasing/purchaseorder_historycontent')
                ->getCollection()
                ->addFieldToFilter('purchase_order_history_id', $id);
        return $collection;
    }

}
