<?php 

class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Edit_Tab_Renderer_Delivery_Warehouse
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $columnName = $this->getColumn()->getName();
        $columnName = explode('_',$columnName);
        if($columnName[1]){
            $resource = Mage::getSingleton('core/resource');
            $readConnection = $resource->getConnection('core_read');
            $installer = Mage::getModel('core/resource');
            $warehouseId = $columnName[1];
            $purchase_order_id = $this->getRequest()->getParam('id');
            $sql = 'SELECT qty_delivery from '.$installer->getTableName("erp_inventory_delivery_warehouse").' WHERE (purchase_order_id = '.$purchase_order_id.') AND (product_id = '.$row->getProductId().') AND (warehouse_id = '.$warehouseId.') AND (sametime = '.$row->getSametime().')';
            $results = $readConnection->fetchAll($sql);
            $haveDelivery = 0;
            foreach($results as $result){
                if($result['qty_delivery']){
                    $haveDelivery = 1;
                    echo $result['qty_delivery'];
                }
            }
            if($haveDelivery == '0')
                echo 0;
        }else{
            parent::render($row);
        }
    }
}