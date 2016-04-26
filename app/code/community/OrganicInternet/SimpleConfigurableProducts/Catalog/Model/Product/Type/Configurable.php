<?php class OrganicInternet_SimpleConfigurableProducts_Catalog_Model_Product_Type_Configurable
    extends Mage_Catalog_Model_Product_Type_Configurable
{
    #Copied from Magento v1.3.1 code.
    #Only need to comment out addFilterByRequiredOptions but there's no
    #nice way of doing that without cutting and pasting the method into my own
    #derived class. Boo.
    public function getUsedProducts($requiredAttributeIds = null, $product = null)
    {
        Varien_Profiler::start('CONFIGURABLE:'.__METHOD__);
        if (!$this->getProduct($product)->hasData($this->_usedProducts)) {
            if (is_null($requiredAttributeIds)
                and is_null($this->getProduct($product)->getData($this->_configurableAttributes))) {
                // If used products load before attributes, we will load attributes.
                $this->getConfigurableAttributes($product);
                // After attributes loading products loaded too.
                Varien_Profiler::stop('CONFIGURABLE:'.__METHOD__);
                return $this->getProduct($product)->getData($this->_usedProducts);
            }

            $usedProducts = array();
            $collection = $this->getUsedProductCollection($product)
                ->addAttributeToSelect('*');
            // ->addFilterByRequiredOptions();

            if (is_array($requiredAttributeIds)) {
                foreach ($requiredAttributeIds as $attributeId) {
                    $attribute = $this->getAttributeById($attributeId, $product);
                    if (!is_null($attribute))
                        $collection->addAttributeToFilter($attribute->getAttributeCode(), array('notnull'=>1));
                }
            }

            foreach ($collection as $item) {
                $usedProducts[] = $item;
            }

            $this->getProduct($product)->setData($this->_usedProducts, $usedProducts);
        }
        Varien_Profiler::stop('CONFIGURABLE:'.__METHOD__);
        return $this->getProduct($product)->getData($this->_usedProducts);
    }

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
        $message = 'Delivery time';
        if ($_deliverytime) {
            return ($message.': '. $_deliverytime);
        } else {
            return;
        }
    }
}
