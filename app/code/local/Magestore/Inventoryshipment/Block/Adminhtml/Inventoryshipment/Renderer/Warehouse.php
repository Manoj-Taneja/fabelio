<?php

class Magestore_Inventoryshipment_Block_Adminhtml_Inventoryshipment_Renderer_Warehouse extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $inventoryShipments = Mage::getModel('inventoryplus/warehouse_shipment')
            ->getCollection()
            ->addFieldToFilter('order_id', $row->getId())
        ;
        $inventoryShipments->getSelect()->group('warehouse_id');
        $html = '';
        $htmlExport = '';
        $whs = Mage::helper('inventoryshipment')->getAllWarehouseName();
        if ($inventoryShipments->getSize() > 0) {
            foreach ($inventoryShipments as $inventoryShipment) {
                if($inventoryShipment->getWarehouseId() != 0){
                $html .= '<a href="' . $this->getUrl('inventoryplusadmin/adminhtml_warehouse/edit', array('id' => $inventoryShipment->getWarehouseId())) . '" >' . $whs[$inventoryShipment->getWarehouseId()] . '</a><br/>';
                $htmlExport .= $whs[$inventoryShipment->getWarehouseId()].',';
                }
            }
        } else {
            $html .= 'None';
        }
        $htmlExport = rtrim($htmlExport, ',');
        if(in_array(Mage::app()->getRequest()->getActionName(),array('exportCsv','exportExcel')))
            return $htmlExport;
        return $html;
    }

}