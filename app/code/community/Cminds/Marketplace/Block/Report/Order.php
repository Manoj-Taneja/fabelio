<?php
class Cminds_Marketplace_Block_Report_Order extends Mage_Core_Block_Template {
    private $_errors = array();
    public function getCollection() {
        $collection = $this->_prepareCollection();

        return $collection;
    }

    private function _prepareCollection() {
        $eavAttribute   = new Mage_Eav_Model_Mysql4_Entity_Attribute();
        $supplier_id    = Mage::helper('marketplace')->getSupplierId();
        $code           = $eavAttribute->getIdByCode('catalog_product', 'creator_id');
        $intEntityName  = Mage::getSingleton("core/resource")->getTableName('catalog_product_entity_int');
        $orderItemTable = Mage::getSingleton('core/resource')->getTableName('sales/order_item');

        $collection = Mage::getModel('sales/order')->getCollection();
        $collection->getSelect()
            ->distinct()
            ->joinInner(array('i' => $orderItemTable), 'i.order_id = main_table.entity_id', array('SUM(qty_ordered) AS sold_count', 'SUM(i.row_total) AS sum_price', 'SUM(row_total-(row_total*((i.vendor_fee)/100))) AS vendor_income', 'product_id'))
            ->joinInner(array('e' => $intEntityName), 'e.entity_id = i.product_id AND e.attribute_id = ' . $code, array() )
            ->where('e.value = ?', $supplier_id);

        if($this->getFilter('from') && strtotime($this->getFilter('from'))) {
            $datetime = new DateTime($this->getFilter('from'));
            $collection->getSelect()->where('main_table.created_at >= ?', $datetime->format('Y-m-d') . " 00:00:00");
        }
        if($this->getFilter('to') && strtotime($this->getFilter('to'))) {
            $datetime = new DateTime($this->getFilter('to'));
            $collection->getSelect()->where('main_table.created_at <= ?', $datetime->format('Y-m-d') . " 23:59:59");
        }

        switch($this->getFilter('period_type')) {
            case 'day':
                $collection->getSelect()->group('DAY(main_table.created_at)');
            break;
            case 'month':
                $collection->getSelect()->group('MONTH(main_table.created_at)');
            break;
            case 'year':
                $collection->getSelect()->group('YEAR(main_table.created_at)');
            break;
            default :
                $collection->getSelect()->group('DAY(main_table.created_at)');
                break;
        }

        return $collection;
    }

    private function getFilter($key) {
        return $this->getRequest()->getPost($key);
    }

    public function getPeriodString($dateString) {
        $date = new DateTime($dateString);

        switch($this->getFilter('period_type')) {
            case 'day':
                return $date->format('D, F d');
                break;
            case 'month':
                return $date->format('F Y');
                break;
            case 'year':
                return $date->format('Y');
                break;
            default :
                return $date->format('m/d/Y');
                break;
        }
    }
}