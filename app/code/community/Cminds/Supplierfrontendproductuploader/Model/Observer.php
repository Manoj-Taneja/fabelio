<?php 
class Cminds_Supplierfrontendproductuploader_Model_Observer extends Mage_Core_Model_Abstract
{
    public function onOrderPlaced($observer) {
        $orderId = $observer->getEvent()->getOrder()->getId();
        $order = Mage::getModel('sales/order')->load($orderId);
        $items = $order->getAllItems();
        $data = array();
        $datas = array();

        foreach ($items as $item)
        {
            $data = array();
            $product = Mage::getModel('catalog/product')->load($item->getProductId());

            if($product->getData('creator_id') != NULL) {
                $data['name'] = $item->getName();
                $data['price'] = $item->getPrice();
                $data['sku'] = $item->getSku();
                $data['supplier_id'] = $product->getData('creator_id');
                $data['id'] = $item->getProductId();
                $data['qty'] = $item->getQtyToInvoice();

                if($order->getShippingAddress()) {
                    $data['firstname'] = $order->getShippingAddress()->getFirstname();
                    $data['lastname'] = $order->getShippingAddress()->getLastname();
                    $data['street'] = $order->getShippingAddress()->getStreet();
                    $data['city'] = $order->getShippingAddress()->getCity();
                    $data['email'] = $order->getShippingAddress()->getEmail();
                    $data['postcode'] = $order->getShippingAddress()->getPostcode();
                    $data['region'] = $order->getShippingAddress()->getRegion();
                    $data['getCountryId'] = $order->getShippingAddress()->getCountryId();
                } else {
                    $data['firstname'] = NULL;
                    $data['lastname'] = NULL;
                    $data['street'] = NULL;
                    $data['city'] = NULL;
                    $data['email'] = NULL;
                    $data['postcode'] = NULL;
                    $data['region'] = NULL;
                    $data['getCountryId'] = NULL;
                }
                
                $data['order_id'] = $orderId;
                $datas[] = $data;
            }
        }
//        $this->_indexOrder($datas);
        $this->_notifySupplieries($datas);

    }
    
    public function onCustomerSaveBefore($observer) {
        try {
			$customer = $observer->getCustomer();
            $postData = Mage::getSingleton('core/app')->getRequest()->getPost();
            
			if( isset($postData['group_id']) ) {
				$customer->setData( 'group_id', $postData['group_id'] );
			}
		} catch ( Exception $e ) {
			Mage::log( "Failed setting customer group id: " . $e->getMessage() );
		}
    }

    public function onAttributeSaveAfter($observer) {
        $attributeData = $observer->getEvent()->getDataObject()->getData();

        if(!isset($attributeData['frontend_label'])) return;
        if(!isset($attributeData['frontend_label_marketplace'])) return;

        $marketplaceLabel = $attributeData['frontend_label_marketplace'];
        $attributeId = $attributeData['attribute_id'];
        $attributeCode = $attributeData['attribute_code'];
        $marketplaceLabels = Mage::getModel('supplierfrontendproductuploader/labels')->load($attributeId, 'attribute_id');
        $marketplaceLabels->setLabel($marketplaceLabel);

        if($marketplaceLabels->getId() == null) {
            $marketplaceLabels->setAttributeId($attributeId);
            $marketplaceLabels->setAttributeCode($attributeCode);
        }

        $marketplaceLabels->save();
    }

    private function _indexOrder($items) {
        foreach($items AS $item) {
            $report = Mage::getModel('supplierfrontendproductuploader/order');
            $report->setSupplierId($item['supplier_id']);
            $report->setEntityId($item['id']);
            $report->setOrderId($item['order_id']);
            $report->setQty($item['qty']);
            $report->setPrice($item['price']);
            $report->setOrderDate(date('Y-m-d H:i:s'));
            $report->save();
        }

    }

    private function _notifySupplieries($items) {
        foreach($items AS $item) {
            $customer = Mage::getModel('customer/customer')->load($item['supplier_id']);
            $product = Mage::getModel('catalog/product')->load($item['id']);
            Mage::helper('supplierfrontendproductuploader/email')->productPurchased($customer, $product, $item);
        }
    }
}
