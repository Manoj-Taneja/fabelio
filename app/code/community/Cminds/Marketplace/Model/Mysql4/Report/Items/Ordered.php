<?php
class Cminds_Marketplace_Model_Mysql4_Report_Items_Ordered extends Mage_Reports_Model_Mysql4_Order_Collection
{
    function __construct() {
        parent::__construct();
        $this->setResourceModel('sales/order_item');
        $this->_init('sales/order_item','item_id');
    }

    public function setDateRange($from, $to) {
        $eavAttribute = new Mage_Eav_Model_Mysql4_Entity_Attribute();
        $code = $eavAttribute->getIdByCode('catalog_product', 'creator_id');
        $table = "catalog_product_entity_int";
        $tableName = Mage::getSingleton("core/resource")->getTableName($table);

        $this->_reset();
        $this->getSelect()
            ->joinInner(array(
                'i' => $this->getTable('sales/order_item')),
                'i.order_id = main_table.entity_id'
            )
            ->joinInner(array(
                'e' => $tableName),
                'e.entity_id = i.product_id AND e.attribute_id = ' . $code
            )
            ->where('i.parent_item_id is null')
            ->where("i.created_at BETWEEN '".$from."' AND '".$to."'")
            ->where('main_table.state = \'complete\'')
            ->columns(array('ordered_qty' => 'count(distinct `main_table`.`entity_id`)'));

        return $this;
    }

    public function setStoreIds($storeIds)
    {
        return $this;
    }
}
