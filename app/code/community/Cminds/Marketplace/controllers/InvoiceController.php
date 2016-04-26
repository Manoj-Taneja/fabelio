<?php

class Cminds_Marketplace_InvoiceController extends Cminds_Marketplace_Controller_Action {
    public function preDispatch() {
        parent::preDispatch();
        $hasAccess = $this->_getHelper()->hasAccess();

        if(!$hasAccess) {
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::helper('customer')->getLoginUrl());
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

                if($itemModel->getQtyOrdered() < ($itemModel->getQtyInvoiced() + intval($qty))) {
                    throw new Exception('You cannot ship more products than it was ordered');
                }

            }

            if($order->getState() == 'canceled') {
                throw new Exception('You cannot create shipment for canceled order');
            }

            $invoice = Mage::getModel('marketplace/invoice', $order)->prepareInvoice($post['product']);

/*            $invoice->sendEmail((isset($post['notify_customer']) && $post['notify_customer'] == '1'))
                ->setEmailSent(false)
                ->register()
                ->save();*/

            $invoice->register();

            $invoice->getOrder()->setIsInProcess(true);

            foreach($invoice->getAllItems() AS $item) {
                $orderItem = Mage::getModel('sales/order_item')->load($item->getOrderItemId());
                $orderItem->setQtyInvoiced($item->getQty() + $orderItem->getQtyInvoiced());
            }


            $loggedUser = Mage::getSingleton('customer/session', array('name' => 'frontend') );
            $customer = $loggedUser->getCustomer();

            $comment = $customer->getFirstname() .' '.$customer->getLastname() . ' (#'.$customer->getId().') created invoice for ' . count($post['product']) . ' item(s)';

            $order->addStatusHistoryComment($comment);

            $fullyInvoiced = true;

            foreach ($order->getAllItems() as $item) {
                if ($item->getQtyToInvoiced() > 0) {
                    $fullyInvoiced = false;
                }
            }

            if($fullyInvoiced) {
                if($order->getState() != Mage_Sales_Model_Order::STATE_PROCESSING) {
                    $state = Mage_Sales_Model_Order::STATE_PROCESSING;
                    $order->setState($state, true);

                } elseif($order->getState() == Mage_Sales_Model_Order::STATE_PROCESSING) {
//                    $state = Mage_Sales_Model_Order::STATE_COMPLETE;
                }

            }

            $transaction->addObject($invoice);
            $transaction->addObject($orderItem);
            $transaction->addObject($order);

            $transaction->save();
            Mage::getSingleton('core/session')->addSuccess('Invoice for order #'.$order->getIncrementId().' was created');
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('*/order/view/', array('id' => $post['order_id'], 'tab' => 'invoice')));
        } catch (Exception $e) {
            if (null !== $order->getIncrementId()) {
                $order->addStatusHistoryComment('Failed to create invoice - '. $e->getMessage())
                    ->save();
            }
            Mage::getSingleton('core/session')->addError($e->getMessage());
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('*/invoice/create/', array('id' => $post['order_id'], 'tab' => 'invoice')));
        }
    }

    public function printAction()
    {
        if ($invoiceId = $this->getRequest()->getParam('id')) {
            if ($invoice = Mage::getModel('sales/order_invoice')->load($invoiceId)) {
                $pdf = Mage::getModel('sales/order_pdf_invoice')->setIsSupplier(true)->getPdf(array($invoice));
                $this->_prepareDownloadResponse('invoice'.Mage::getSingleton('core/date')->date('Y-m-d_H-i-s').
                    '.pdf', $pdf->render(), 'application/pdf');
            }
        }
        else {
            $this->_forward('noRoute');
        }
    }
}
