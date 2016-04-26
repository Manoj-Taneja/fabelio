<?php
class Cminds_Marketplace_Block_Order_List extends Mage_Core_Block_Template {
    public function _construct() {
        $this->setTemplate('marketplace/order/list.phtml');
    }

    public function getFlatCollection() {
        $eavAttribute   = new Mage_Eav_Model_Mysql4_Entity_Attribute();
        $supplier_id    = Mage::helper('marketplace')->getSupplierId();
        $code           = $eavAttribute->getIdByCode('catalog_product', 'creator_id');
        $table          = "catalog_product_entity_int";
        $tableName      = Mage::getSingleton("core/resource")->getTableName($table);
        $orderTable = Mage::getSingleton('core/resource')->getTableName('sales/order');

        $collection = Mage::getModel('sales/order_item')->getCollection();
        $collection->getSelect()
            ->joinInner(array('o' => $orderTable), 'o.entity_id = main_table.order_id', array())
            ->joinInner(array('e' => $tableName), 'e.entity_id = main_table.product_id AND e.attribute_id = ' . $code, array() )
            ->where('main_table.parent_item_id is null')
            ->where('e.value = ?', $supplier_id)
            ->group('o.entity_id')
            ->order('o.entity_id DESC');

        if($this->getFilter('autoincrement_id')) {
            $collection->getSelect()->where('o.increment_id LIKE ?', "%".$this->getFilter('autoincrement_id')."%");
        }
        if($this->getFilter('status')) {
            $collection->getSelect()->where('o.status = ?', $this->getFilter('status'));
        }

        if($this->getFilter('from') && strtotime($this->getFilter('from'))) {
            $datetime = new DateTime($this->getFilter('from'));
            $collection->getSelect()->where('main_table.created_at >= ?', $datetime->format('Y-m-d') . " 00:00:00");
        }
        if($this->getFilter('to') && strtotime($this->getFilter('to'))) {
            $datetime = new DateTime($this->getFilter('to'));
            $collection->getSelect()->where('main_table.created_at <= ?', $datetime->format('Y-m-d') . " 23:59:59");
        }

        return $collection;
    }

    private function getFilter($key) {
        return $this->getRequest()->getPost($key);
    }

    public function isFullyShipped($orderId) {
        $order = Mage::getModel('sales/order')->load($orderId);
        $orderItems = $order->getItemsCollection();
        $allOrderItemIds = array();
        $shipments = $order->getShipmentsCollection();
        $shippedItemIds = array();

        foreach($orderItems As $item) {
            if(Mage::helper('marketplace')->isOwner($item->getProductId())) {
                $allOrderItemIds[$item->getItemId()] = $item->getQtyOrdered();
            }
        }

        foreach ($shipments as $shipment) {
            $shippedItems = $shipment->getItemsCollection();
            foreach ($shippedItems as $item) {
                if(Mage::helper('marketplace')->isOwner($item->getOrderItem()->getProductId())) {
                    if(!isset($shippedItemIds[$item->getOrderItemId()])) {
                        $shippedItemIds[$item->getOrderItemId()] = 0;
                    }
                    $shippedItemIds[$item->getOrderItemId()] = $shippedItemIds[$item->getOrderItemId()] + $item->getQty();
                }
            }
        }
        return (count($shippedItemIds) == count($allOrderItemIds) && array_sum($allOrderItemIds) == array_sum($shippedItemIds));
    }

    public function calculateSubtotal($order) {
        $subtotal = 0;
        foreach($order->getAllItems() AS $item) {
            if(Mage::helper('marketplace')->isOwner($item->getProductId())) {
                $subtotal += $item->getPrice() * $item->getQtyOrdered();
            }
        }
        return $subtotal;
    }
}