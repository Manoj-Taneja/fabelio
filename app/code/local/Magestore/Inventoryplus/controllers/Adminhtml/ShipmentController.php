<?php

class Magestore_Inventoryplus_Adminhtml_ShipmentController extends Mage_Adminhtml_Controller_action {

    public function checkavailablebyeventAction() {
        $warehouseId = $this->getRequest()->getParam('warehouse_id');
        $productId = $this->getRequest()->getParam('product_id');
        $qty = $this->getRequest()->getParam('qty');
        $orderItemId = $this->getRequest()->getParam('order_item_id');
        $orderId = $this->getRequest()->getParam('order_id');
        $totalQtyOfProductRequest = $this->getRequest()->getParam('total_qty');
        $availableProduct = Mage::helper('inventoryplus/warehouse')
                ->checkWarehouseAvailableProduct($warehouseId, $productId, $totalQtyOfProductRequest);
        $result = array();
        if(Mage::helper('core')->isModuleEnabled('Magestore_Inventorybarcode')){
            $result['barcode'] = Mage::helper('inventorybarcode')->selectboxBarcodeByPid($productId, $orderItemId, $orderId, $warehouseId);
        }
    
        if ($availableProduct == true || $qty == 0) {
            $result['avaiable'] = true;            
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        } else {   
            $result['avaiable'] = false;
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
    
    public function checkbarcodeAction(){
        if(!Mage::helper('core')->isModuleEnabled('Magestore_Inventorybarcode')){
            return;
        }
        $barcodeId = $this->getRequest()->getParam('barcode_id');
        $barcode = Mage::getModel('inventorybarcode/barcode')->load($barcodeId);
        
        $result = array();
        if ($barcode->getQty()>0) {
            $result['avaiable'] = true;                        
        } else {   
            $result['avaiable'] = false;            
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }

}
