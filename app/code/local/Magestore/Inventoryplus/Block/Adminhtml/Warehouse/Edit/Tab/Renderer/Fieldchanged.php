<?php 
class Magestore_Inventoryplus_Block_Adminhtml_Warehouse_Edit_Tab_Renderer_Fieldchanged
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $warehouseHistoryId = $row->getWarehouseHistoryId();
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $sql = 'SELECT distinct(`field_name`) from ' . $resource->getTableName("erp_inventory_warehouse_history_content") . ' WHERE (warehouse_history_id = '.$warehouseHistoryId.')';
        $results = $readConnection->fetchAll($sql);
        $content = '';
        foreach ($results as $result) {
            $content .= $result['field_name'].'<br />';
        }
        return $content;
    }
}