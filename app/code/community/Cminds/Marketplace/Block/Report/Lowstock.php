<?php
class Cminds_Marketplace_Block_Report_Lowstock extends Cminds_Marketplace_Block_Report_Abstract {
    protected $_resourceModel = 'reports/product_lowstock_collection';
    protected $_columns = array('Product Name', 'Product SKU', 'Stock Qty');

    public $title = 'Low Stock';

    protected function _prepareCollection() {
        $collection = Mage::getResourceModel($this->_resourceModel)
            ->addAttributeToSelect('*')
            ->setStoreId(1)
            ->filterByIsQtyProductTypes()
            ->joinInventoryItem('qty')
            ->useManageStockFilter(1)
            ->useNotifyStockQtyFilter(1)
            ->addAttributeToFilter('creator_id', $this->_getSupplierId())
            ->setOrder('qty', Varien_Data_Collection::SORT_ORDER_ASC);

        return $collection->load();
    }
}