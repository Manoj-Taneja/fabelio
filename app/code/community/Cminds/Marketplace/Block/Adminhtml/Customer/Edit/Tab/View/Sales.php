<?php

class Cminds_Marketplace_Block_Adminhtml_Customer_Edit_Tab_View_Sales extends Mage_Adminhtml_Block_Template
{
    private function _prepareCollection() {
        $eavAttribute   = new Mage_Eav_Model_Mysql4_Entity_Attribute();
        $supplier_id    = Mage::registry('current_customer')->getId();
        $code           = $eavAttribute->getIdByCode('catalog_product', 'creator_id');
        $table          = "catalog_product_entity_int";
        $tableName      = Mage::getSingleton("core/resource")->getTableName($table);
        $orderItemTable = Mage::getSingleton('core/resource')->getTableName('sales/order_item');

        $collection = Mage::getModel('sales/order')->getCollection();
        $collection->getSelect()
            ->joinInner(array('i' => $orderItemTable), 'i.order_id = main_table.entity_id', array())
            ->joinInner(array('e' => $tableName), 'e.entity_id = i.product_id AND e.attribute_id = ' . $code, array() )
            ->where('i.parent_item_id is null')
            ->where('e.value = ?', $supplier_id);

        return $collection;
    }

    public function getSupplierId()
    {
        return Mage::registry('current_customer')->getId();
    }

    public function isSupplier() {
        $customerGroupConfig = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/supplier_group_id');
        $editorGroupConfig = Mage::getStoreConfig('supplierfrontendproductuploader_catalog/supplierfrontendproductuploader_supplier_config/editor_group_id');

        $allowedGroups = array();

        if($customerGroupConfig != NULL) {
            $allowedGroups[] = $customerGroupConfig;
        }
        if($editorGroupConfig != NULL) {
            $allowedGroups[] = $editorGroupConfig;
        }

        $groupId = Mage::registry('current_customer')->getGroupId();
        return in_array($groupId, $allowedGroups);
    }

    public function getItemCount() {
        $collection = $this->_prepareCollection();
        $collection->addExpressionFieldToSelect('qty_ordered', 'SUM(i.qty_ordered)', 'i.price');
        return $collection->getFirstItem()->getData('qty_ordered');
    }

    public function getCanceledItemCount() {
        $collection = $this->_prepareCollection();
        $collection->addExpressionFieldToSelect('qty_canceled', 'SUM(i.qty_canceled)', 'i.price');
        return $collection->getFirstItem()->getData('qty_canceled');
    }

    public function getRefundedItemCount() {
        $collection = $this->_prepareCollection();
        $collection->addExpressionFieldToSelect('qty_refunded', 'SUM(i.qty_refunded)', 'i.price');
        return $collection->getFirstItem()->getData('qty_refunded');
    }

    public function getPendingItemCount() {
        return $this->getItemCount() - ($this->getCanceledItemCount() + $this->getRefundedItemCount() + $this->getCompletedItemCount());
    }

    public function getCompletedItemCount() {
        $collection = $this->_prepareCollection();
        $collection->addExpressionFieldToSelect('qty_shipped', 'SUM(i.qty_shipped)', 'i.price');
        return $collection->getFirstItem()->getData('qty_shipped');
    }

    public function getGrandTotal() {
        $collection = $this->_prepareCollection();
        $collection->addExpressionFieldToSelect('row_total', 'SUM(i.row_total)', 'i.price');
        return $collection->getFirstItem()->getData('row_total');
    }
}
