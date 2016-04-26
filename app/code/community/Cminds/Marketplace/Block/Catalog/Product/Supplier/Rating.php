<?php
class Cminds_Marketplace_Block_Catalog_Product_Supplier_Rating extends Cminds_Marketplace_Block_Catalog_Product_Supplier
{
    public function _construct() {
        $this->setTemplate('marketplace/catalog/product/supplier/rating.phtml');
    }

    public function isEnabled() {
        return Mage::getStoreConfig("marketplace_configuration/presentation/rating");
    }

    public function getSupplierRating() {
        $supplierId = $this->getSupplierId();

        if(!$this->isCreatedBySupplier()) return false;

        $rating = Mage::getModel('marketplace/rating')->getCollection();
        $rating->addExpressionFieldToSelect('rating_avg', 'AVG(main_table.rate)', 'main_table.rate');
        $rating->getSelect()->where('main_table.supplier_id = ?', $supplierId);

        $ratingAvg = $rating->getFirstItem()->getData('rating_avg');

        return ceil($ratingAvg) * 20;
    }
}
