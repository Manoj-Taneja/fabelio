<?php

class Cminds_Marketplace_ShipmentController extends Cminds_Marketplace_Controller_Action {
    public function preDispatch() {
        parent::preDispatch();
        $hasAccess = $this->_getHelper()->hasAccess();

        if(!$hasAccess) {
            $this->getResponse()->setRedirect($this->_getHelper('supplierfrontendproductuploader')->getSupplierLoginPage());
        }
    }
    public function createAction() {
        $id = $this->getRequest()->getParam('id');
        Mage::register('order_id', $id);
        $this->_renderBlocks();
    }
    public function viewAction() {
        $id = $this->getRequest()->getParam('id');
        Mage::register('shipment_id', $id);
        $this->_renderBlocks();
    }
    public function saveAction() {
        $post = $this->_request->getPost();

        try {
            $transaction = Mage::getModel('core/resource_transaction');
            $order = Mage::getModel('sales/order')->load($post['order_id']);

            foreach($post['product'] AS $product_id => $qty) {

                if($qty <= 0) {
                    unset($post['product'][$product_id]);
                }
                $itemModel = Mage::getModel('sales/order_item')->load($product_id);

                if(!$itemModel->getProductId() || !Mage::helper('marketplace')->isOwner($itemModel->getProductId())) {
                    throw new Exception('You cannot ship non-owning products');
                }

                if($itemModel->getQtyOrdered() < ($itemModel->getQtyShipped() + intval($qty))) {
                    throw new Exception('You cannot ship more products than it was ordered');
                }

            }

            if($order->getState() == 'canceled') {
                throw new Exception('You cannot create shipment for canceled order');
            }
            $shipment = $order->prepareShipment($post['product']);

            $shipment->sendEmail((isset($post['notify_customer']) && $post['notify_customer'] == '1'))
                ->setEmailSent(false)
                ->register()
                ->save();

            foreach($shipment->getAllItems() AS $item) {
                $orderItem = Mage::getModel('sales/order_item')->load($item->getOrderItemId());
                $orderItem->setQtyShipped($item->getQty() + $orderItem->getQtyShipped());
                $orderItem->save();
            }

            $sh = Mage::getModel('sales/order_shipment_track')
                ->setShipment($shipment)
                ->setData('title', $post['title'])
                ->setData('number', $post['number'])
                ->setData('carrier_code', $post['carrier_code'])
                ->setData('order_id', $shipment->getData('order_id'));

            $transaction->addObject($sh);

            $loggedUser = Mage::getSingleton( 'customer/session', array('name' => 'frontend') );
            $customer = $loggedUser->getCustomer();

            $comment = $customer->getFirstname() .' '.$customer->getLastname() . ' (#'.$customer->getId().') created shipment for ' . count($post['product']) . ' item(s)';

            $order->addStatusHistoryComment($comment);

            $fullyShipped = true;

            foreach ($order->getAllItems() as $item) {
                if ($item->getQtyToShip()>0 && !$item->getIsVirtual()
                    && !$item->getLockedDoShip())
                {
                    $fullyShipped = false;
                }
            }

            if($fullyShipped) {
                if($order->getState() != Mage_Sales_Model_Order::STATE_PROCESSING) {
                    $state = Mage_Sales_Model_Order::STATE_PROCESSING;
                    $status = $order->getConfig()->getStateDefaultStatus($state);
                } elseif($order->getState() == Mage_Sales_Model_Order::STATE_PROCESSING) {
                    $state = Mage_Sales_Model_Order::STATE_COMPLETE;
                    $status = 'processing_shipped';
                }

                if($state) {
                    $order->setData('state', $state);
                    $order->setStatus($status);
                    $history = $order->addStatusHistoryComment($comment, false);
                }
            }

            $transaction->addObject($order);

            $transaction->save();
            Mage::getSingleton('core/session')->addSuccess('Shipment for order #'.$order->getIncrementId().' was created');
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('*/order/view/', array('id' => $post['order_id'], 'tab' => 'shipment')));
        } catch (Exception $e) {
            if (null !== $order->getIncrementId()) {
                $order->addStatusHistoryComment('Failed to create shipment - '. $e->getMessage())
                    ->save();
            }
            Mage::getSingleton('core/session')->addError($e->getMessage());
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('*/shipment/create/', array('id' => $post['order_id'], 'tab' => 'shipment')));
        }
    }

    public function printLabelAction() {
        $id = $this->getRequest()->getParam('id');
        try {
            $track = Mage::getModel('sales/order_shipment_track')->load($id);

            $model = Mage::getModel('marketplace/pdf');
             if ($track) {
                $model->setOrderId($track->getOrderId());
                $model->setCarrier($track->getCarrierCode());
                $pdf = $model->getPdf();
                return $this->_prepareDownloadResponse('label-'.Mage::getSingleton('core/date')->date('Y-m-d_H-i-s').'.pdf', $pdf->render(), 'application/pdf');
             }
        } catch(Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
        }
        $this->_redirect('*/order');
    }
}
