<?php
class Magestore_Inventoryplus_Block_Adminhtml_Stock_Renderer_Warehouse extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $product_id = $row->getId();
        $content = '';
        $totalWarehouse = 0;
        $warehouse_products = Mage::getModel('inventoryplus/warehouse_product')
                ->getCollection()
                ->addFieldToFilter('product_id', $product_id);
        $check = 0;
        foreach ($warehouse_products as $warehouse_product) {
			$totalWarehouse++;
            $warehouse_id = $warehouse_product->getWarehouseId();
            $url = Mage::helper('adminhtml')->getUrl('inventoryplusadmin/adminhtml_warehouse/edit', array('id' => $warehouse_id));
            $warehouse = Mage::getModel('inventoryplus/warehouse')
                    ->getCollection()
                    ->addFieldToFilter('warehouse_id', $warehouse_id)
                    ->getFirstItem();
            $name = $warehouse->getWarehouseName();
            if (in_array(Mage::app()->getRequest()->getActionName(), array('exportCsv', 'exportXml'))) {
                if ($check)
                    $content.=', ' . $name .'(' . $warehouse_product->getTotalQty() . '/' . $warehouse_product->getAvailableQty() . ')';
                else
                    $content.=$name.'(' . $warehouse_product->getTotalQty() . '/' . $warehouse_product->getAvailableQty() . ')';
            }
            else
                $content .= "<a href=" . $url . ">$name</a>" . "<br/>" . '(' . $warehouse_product->getTotalQty() . '/' . $warehouse_product->getAvailableQty() . ')' . "<br/>";
            $check++;
        }
        if ($totalWarehouse > 5) {
            $contentScroll = '<div style="overflow-y:scroll; height: 110px;">' . $content . '</div>';
            return $contentScroll;
        }
        return $content;
    }

}

?>
