<?php

class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Editdelivery_Renderer_Warehouse extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {       
        $productId = $row->getId();
        $purchaseorderId = $this->getRequest()->getParam('purchaseorder_id');
        $warehouse_ids = explode("warehouse_", $this->getColumn()->getData('name'));
        $warehouse_id = $warehouse_ids[1];

        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $installer = Mage::getModel('core/resource');
        $sql = 'SELECT qty_received FROM ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE purchase_order_id = ' . $purchaseorderId . ' AND product_id = '.$productId.' AND warehouse_id = '.$warehouse_id;
        $result = $readConnection->fetchRow($sql);
        $qty = 0;
        if($result['qty_received'])
            $qty = $result['qty_received'];
        $str = Mage::helper('inventorypurchasing')->__('Received: ').$qty;
        $sql = 'SELECT qty_received, qty_order FROM ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE purchase_order_id = ' . $purchaseorderId . ' AND product_id = '.$productId.' AND warehouse_id = '.$warehouse_id;
        $result = $readConnection->fetchRow($sql);
        $qty = 0;
        if(isset($result['qty_received'])){
            $qty = $result['qty_order'] - $result['qty_received'];
        }                    
        if($qty > 0){            
            $str .= '<input type="text" class="input-text '
                . $this->getColumn()->getValidateClass()
                . '" name="' . $this->getColumn()->getId()
                . '" value="' . $qty . '"/>';
        }
        return $str;
    } 
}
?>
