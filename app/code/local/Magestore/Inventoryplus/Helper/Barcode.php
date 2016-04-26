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
 * Inventory Helper
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Helper_Barcode extends Mage_Core_Helper_Abstract {

    public function getBarcodeNameByShipmentIdAndOrderitemId($orderId, $orderItemId, $productId) {
        $inventoryShipmentModel = Mage::getModel('inventorybarcode/barcode_shipment');
        $barcodeShipment = $inventoryShipmentModel->getCollection()
                ->addFieldToFilter('order_id', $orderId)
                ->addFieldToFilter('item_id', $orderItemId)
                ->addFieldToFilter('product_id', $productId)
                ->getFirstItem();

        if ($barcodeShipment->getQtyShipped()) {
            $barcode = Mage::getModel('inventorybarcode/barcode')->load($barcodeShipment->getBarcodeId());
            return $barcode->getBarcode();
        }
    }

}
