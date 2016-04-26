<?php
class Cminds_Supplierfrontendproductuploader_Block_Dashboard extends Mage_Core_Block_Template {
    protected $_product;

    private function _prepareCollection() {
        $eavAttribute   = new Mage_Eav_Model_Mysql4_Entity_Attribute();
        $supplier_id    = Mage::helper('supplierfrontendproductuploader')->getSupplierId();
        $code           = $eavAttribute->getIdByCode('catalog_product', 'creator_id');
        $table          = "catalog_product_entity_int";
        $tableName      = Mage::getSingleton("core/resource")->getTableName($table);
        $orderItemTable = Mage::getSingleton('core/resource')->getTableName('sales/order_item');

        $collection = Mage::getModel('sales/order')->getCollection();
        $collection->getSelect()
            ->joinInner(array('i' => $orderItemTable), 'i.order_id = main_table.entity_id', array())
            ->joinInner(array('e' => $tableName), 'e.entity_id = i.product_id AND e.attribute_id = ' . $code, array() )
            ->where('i.parent_item_id is null')
            ->where('e.value = ?', $supplier_id)
            ->where('main_table.state = \'complete\'');

        return $collection;
    }

    public function getSupplierSaleAmount() {
        $collection = $this->_prepareCollection();
        $collection->addExpressionFieldToSelect('sale_amount', 'SUM(i.price*i.qty_ordered)', 'i.price');

        return $collection->getFirstItem()->getData('sale_amount');
    }

    public function getSupplierSaleAvg() {
        $collection = $this->_prepareCollection();
        $collection->addExpressionFieldToSelect('sale_avg', 'AVG(i.price*i.qty_ordered)', 'i.price');
        return $collection->getFirstItem()->getData('sale_avg');
    }

    public function getSupplierSaleCount() {
        $collection = $this->_prepareCollection();
        $collection->addExpressionFieldToSelect('sale_count', 'SUM(i.qty_ordered)', 'i.qty_ordered');
        return $collection->getFirstItem()->getData('sale_count');
    }

    public function getSaleDailyEarnings() {
        $collection = $this->_prepareCollection();
        $collection->addExpressionFieldToSelect('sale_amount', 'SUM(i.price*i.qty_ordered)', 'i.price');
        $collection->getSelect()->group('MONTH(main_table.created_at), YEAR(main_table.created_at)');
        return $collection->getData();
    }

    public function getSaleDailyItemsCount() {
        $collection = $this->_prepareCollection();
        $collection->addExpressionFieldToSelect('sale_count', 'SUM(i.qty_ordered)', 'i.qty_ordered');
        $collection->getSelect()->group('MONTH(main_table.created_at), YEAR(main_table.created_at)');

        return $collection->getData();
    }
}
