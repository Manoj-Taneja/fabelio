<?php

class Magestore_Inventoryshipment_Block_Adminhtml_Inventoryshipment_Renderer_Action extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $orderStatus = $row->getStatus();
        $orderId = $row->getId();
        $shipped = 0;
        $shipmentCollection = Mage::getResourceModel('sales/order_shipment_grid_collection')
                                    ->addFieldToFilter('order_id',$orderId);
        if($shipmentSize = $shipmentCollection->getSize()){
            if($shipmentSize == 1){
                $shipped = 1;//only 1 shipment
            }else{
                $shipped = 2;//> 1 shipment
            }
        }   
        $html = '';
        if ($row->getShippingProgress() == 2) {
            if($shipped != 0){
                if($shipped == 1){
                    $shipmentId = $shipmentCollection->getFirstItem()->getId();
                    $html = '<p><a title="'.Mage::helper('inventoryshipment')->__('View shipment of this order').'" href="' . $this->getUrl('inventoryshipmentadmin/adminhtml_shipment/view', array('shipment_id' => $shipmentId)) . '">'.Mage::helper('inventoryshipment')->__('View Shipment').'</a></p>';
                }
                else
                    $html = '<p><a title="'.Mage::helper('inventoryshipment')->__('View shipment of this order').'" href="' . $this->getUrl('inventoryshipmentadmin/adminhtml_order/view', array('order_id' => $orderId,'active'=>'order_shipments')) . '">'.Mage::helper('inventoryshipment')->__('View Shipment').'</a></p>';
            }
        } else {
            if ($orderStatus == 'canceled' || $orderStatus == 'closed') {
                if($shipped != 0){
                    if($shipped == 1){
                        $shipmentId = $shipmentCollection->getFirstItem()->getId();
                        $html = '<p><a title="'.Mage::helper('inventoryshipment')->__('View shipment of this order').'" href="' . $this->getUrl('inventoryshipmentadmin/adminhtml_shipment/view', array('shipment_id' => $shipmentId)) . '">'.Mage::helper('inventoryshipment')->__('View Shipment').'</a></p>';
                    }
                    else
                        $html = '<p><a title="'.Mage::helper('inventoryshipment')->__('View shipment of this order').'" href="' . $this->getUrl('inventoryshipmentadmin/adminhtml_order/view', array('order_id' => $orderId,'active'=>'order_shipments')) . '">'.Mage::helper('inventoryshipment')->__('View Shipment').'</a></p>';
                        
                }
            } else {
                $html .= '<p>';
                if($shipped != 0){
                   if($shipped == 1){
                        $shipmentId = $shipmentCollection->getFirstItem()->getId();
                        $html = '<p><a title="'.Mage::helper('inventoryshipment')->__('View shipment of this order').'" href="' . $this->getUrl('inventoryshipmentadmin/adminhtml_shipment/view', array('shipment_id' => $shipmentId)) . '">'.Mage::helper('inventoryshipment')->__('View Shipment').'</a></p>';
                    }
                    else
                        $html .= '<a title="'.Mage::helper('inventoryshipment')->__('View shipment of this order').'" href="' . $this->getUrl('inventoryshipmentadmin/adminhtml_order/view', array('order_id' => $orderId,'active'=>'order_shipments')) . '">'.Mage::helper('inventoryshipment')->__('View Shipment').'</a>&nbsp;/&nbsp;';
                        
                }
                $html = '<a title="'.Mage::helper('inventoryshipment')->__('Create shipment of this order').'" href="' . $this->getUrl('inventoryshipmentadmin/adminhtml_shipment/new', array('order_id' => $orderId)) . '">'.Mage::helper('inventoryshipment')->__('Ship').'</a>';
                $html .= '</p>';
            }
        }
        return $html;
    }

}

?>
