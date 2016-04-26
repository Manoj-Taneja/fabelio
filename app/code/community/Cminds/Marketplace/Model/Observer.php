<?php 
class Cminds_Marketplace_Model_Observer extends Mage_Core_Model_Abstract
{
    public function onOrderPlaced($observer) {
        if(!Mage::helper('supplierfrontendproductuploader')->isEnabled()) {
            return;
        }

        $orderId = $observer->getEvent()->getOrder()->getId();
        $order = Mage::getModel('sales/order')->load($orderId);
        $items = $order->getAllItems();
        $data = array();
        $datas = array();

        foreach ($items as $item)
        {
            $data = array();
            $product = Mage::getModel('catalog/product')->load($item->getProductId());

            if($product->getData('creator_id') != NULL && $product->getData('creator_id') != 0) {
                $i = Mage::getModel('sales/order_item')->load($item->getId());

                if($i) {
                    $fee = Mage::helper('marketplace/profits')->getStoreProfit($product->getData('creator_id'));
                    
                    if($fee) {
                        $i->setVendorFee($fee);
                        $i->save();
                    }
                }
            }
        }
    }

    public function onOrderSave($observer) {

        if(!Mage::helper('supplierfrontendproductuploader')->isEnabled()) {
            return;
        }
        $order = $observer->getOrder();
        if($order->getState() == Mage_Sales_Model_Order::STATE_COMPLETE){
            $orderId = $order->getId();
            $order = Mage::getModel('sales/order')->load($orderId);
            $items = $order->getAllItems();

            if(!$order->getCustomerId()) return;

            foreach ($items as $item) {
                $product = Mage::getModel('catalog/product')->load($item->getProductId());

                if($product->getData('creator_id') != NULL) {
                    if($product->getData('creator_id') == $order->getCustomerId()) continue;

                    $s = Mage::getModel('marketplace/torate')->getCollection()
                        ->addFieldToFilter('supplier_id', $product->getData('creator_id'))
                        ->addFieldToFilter('customer_id', $order->getCustomerId());

                    if($s->count() <= 0) {
                        Mage::getModel('marketplace/torate')
                            ->setData('supplier_id', $product->getData('creator_id'))
                            ->setData('order_id', $orderId)
                            ->setData('product_id', $item->getProductId())
                            ->setData('customer_id', $order->getCustomerId()) ->save();
                    }
                }
            }
        }
    }
}