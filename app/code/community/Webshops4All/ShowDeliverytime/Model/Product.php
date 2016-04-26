<?php

class Webshops4All_ShowDeliverytime_Model_Product extends Mage_Catalog_Model_Product {

    public function getDeliverytime() {
        $_deliverytime = false;

        // Check type of product first
        $productType = $this->getTypeId();
        if ($productType == 'simple') {
            // Check if product is in stock
            $stock = $this->getStockItem();
            if (($stock->getIsInStock() && $stock->getQty() > 0) || (!$stock->getManageStock())) {
                $_deliverytime = $this->getData('deliverytime');
            } else {
                $_deliverytime = $this->getData('deliverytime_backorder');
            }
        } elseif ($this->isConfigurable()) {
            // Check in stock status for all simple products within the configurable product
            $allProductsInStock = true;
            $associatedProducts = $this->getTypeInstance(true)->getUsedProducts(null,$this);

            // Now check for all associatedproducts if they are in stock.
            foreach ($associatedProducts as $associatedProduct) {
                if ($associatedProduct->isSaleable()) {
                    $_deliverytime = $associatedProduct->getData('deliverytime');
                }
            }
        }
        $message = Mage::helper('showdeliverytime')->__('Delivery time');
        if ($_deliverytime) {
            return ($message.': '. $_deliverytime);
        } else {
            return;
        }
    }
}