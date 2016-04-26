<?php
class Cminds_Supplierfrontendproductuploader_Block_Sales_Order extends Mage_Core_Block_Template
{
    public function _construct()
    {
        parent::_construct();
    }

    public function getItems() {
        $collection = $this->_prepareCollection();
        return $collection;

    }

    private function _prepareCollection() {
        $eavAttribute   = new Mage_Eav_Model_Mysql4_Entity_Attribute();
        $supplier_id    = Mage::helper('supplierfrontendproductuploader')->getSupplierId();
        $code           = $eavAttribute->getIdByCode('catalog_product', 'creator_id');
        $table          = "catalog_product_entity_int";
        $tableName      = Mage::getSingleton("core/resource")->getTableName($table);
        $orderTable     = Mage::getSingleton('core/resource')->getTableName('sales/order');
        $collection     = Mage::getModel('sales/order_item')->getCollection();
        $page           = Mage::app()->getRequest()->getParam('p', 1);

        $collection->setPageSize(10)->setCurPage($page)->addExpressionFieldToSelect('item_count', 'SUM({{qty_ordered}})', 'qty_ordered');

        $collection->getSelect()
            ->joinInner(array('o' => $orderTable), 'o.entity_id = main_table.order_id', array())
            ->joinInner(array('e' => $tableName), 'e.entity_id = main_table.product_id AND e.attribute_id = ' . $code, array() )
            ->where('main_table.parent_item_id is null')
            ->where('e.value = ?', $supplier_id)
            ->where('o.state != ?', 'canceled');

        if($this->getFilter('from') && strtotime($this->getFilter('from'))) {
            $datetime = new DateTime($this->getFilter('from'));
            $collection->getSelect()->where('main_table.created_at >= ?', $datetime->format('Y-m-d'));
        }
        if($this->getFilter('to') && strtotime($this->getFilter('to'))) {
            $datetime = new DateTime($this->getFilter('to'));
            $collection->getSelect()->where('main_table.created_at <= ?', $datetime->format('Y-m-d'));
        }

        $collection->getSelect()->group('main_table.product_id');

        return $collection;
    }

    private function getFilter($key) {
        return $this->getRequest()->getPost($key);
    }
}
