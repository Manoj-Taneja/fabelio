<?php
class Cminds_Marketplace_Model_Order_Item extends Mage_Sales_Model_Order_Item {
    public function isDummy($shipment = false) {
        if (!Mage::app()->getStore()->isAdmin()) {
            $productSupplierId = Mage::helper('marketplace')->getProductSupplierId($this->getProduct());

            if($productSupplierId != Mage::helper('marketplace')->getSupplierId()) {
                return true;
            }
        }

        if ($shipment) {
            if ($this->getHasChildren() && $this->isShipSeparately()) {
                return true;
            }

            if ($this->getHasChildren() && !$this->isShipSeparately()) {
                return false;
            }

            if ($this->getParentItem() && $this->isShipSeparately()) {
                return false;
            }

            if ($this->getParentItem() && !$this->isShipSeparately()) {
                return true;
            }
        } else {
            if ($this->getHasChildren() && $this->isChildrenCalculated()) {
                return true;
            }

            if ($this->getHasChildren() && !$this->isChildrenCalculated()) {
                return false;
            }

            if ($this->getParentItem() && $this->isChildrenCalculated()) {
                return false;
            }

            if ($this->getParentItem() && !$this->isChildrenCalculated()) {
                return true;
            }
        }
        return false;
    }
}