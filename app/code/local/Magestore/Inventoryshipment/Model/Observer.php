<?php

/**
 * Magestore
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category    Magestore
 * @package     Magestore_Inventoryshipment
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventoryshipment Observer Model
 * 
 * @category    Magestore
 * @package     Magestore_Inventoryshipment
 * @author      Magestore Developer
 */
class Magestore_Inventoryshipment_Model_Observer {

    /**
     * process controller_action_predispatch event
     *
     * @return Magestore_Inventoryshipment_Model_Observer
     */
    public function controllerActionPredispatch($observer) {
        $action = $observer->getEvent()->getControllerAction();
        return $this;
    }

    //add Menu
    public function addMenu($observer) {
        $menu = $observer->getEvent()->getMenus()->getMenu();

        $menu['shiment'] = array('label' => Mage::helper('inventoryshipment')->__('Shipments'),
            'sort_order' => 300,
            'url' => Mage::helper("adminhtml")->getUrl("inventoryshipmentadmin/adminhtml_inventoryshipment/", array("_secure" => Mage::app()->getStore()->isCurrentlySecure())),
            'active' => (in_array(Mage::app()->getRequest()->getControllerName(), array('adminhtml_inventoryshipment', 'adminhtml_shipment', 'adminhtml_order'))) ? true : false,
            'level' => 0,
        );
        $observer->getEvent()->getMenus()->setData('menu', $menu);
    }

    public function salesOrderView($observer) {
        if (Mage::getModel('admin/session')->getData('need_to_view_order')) {
            Mage::getModel('admin/session')->setData('need_to_view_order', null);
            $orderId = Mage::app()->getRequest()->getParam('order_id');
            $url = Mage::helper('adminhtml')->getUrl('inventoryshipmentadmin/adminhtml_order/view', array('_secure' => true, 'order_id' => $orderId));
            header('Location: ' . $url);
            exit;
        }
    }

    //save shipping progress
    public function saveOrderSaveAfter($observer) {
        /* Edit by Magnus - 08/04/2015 - Fix cancel by mass action ko change shipping proccess */
        $order = $observer->getOrder();
        $order_id = $order->getId();
        if (Mage::registry('INVENTORY_SHIPMENT_PLUGIN_ORDER_SAVE_' . $order_id)){
            return;
        }
        Mage::register('INVENTORY_SHIPMENT_PLUGIN_ORDER_SAVE_' . $order_id, true);
        /* Endl Magnus 08/04/2015 */
        $status = $order->getStatus();
        $shipment = $order->hasShipments();
        if ($status == 'complete') {
            $shipping_progress = 2; //shipped
        } elseif ($status == 'canceled') {
            $shipping_progress = 3; //canceled
        } elseif ($status == 'closed') {
            $shipping_progress = 4; //closed
        } else {
            $shipping_progress = 2;
            foreach ($order->getAllItems() as $item) {
                if ($item->getQtyToShip() > 0 && !$item->getIsVirtual() && !$item->getLockedDoShip()) {
                    if ($shipment) {
                        $shipping_progress = 1; //partial
                        break;
                    } else {
                        $shipping_progress = 0; //not ship
                        break;
                    }
                }
            }
        }
        try {
            $order->setData('shipping_progress', $shipping_progress)
                    ->save();
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'inventory_management.log');
        }
    }

    //remove and change button on order/shipment view
    public function changeButton($observer) {
        $block = $observer->getEvent()->getBlock();
        if (get_class($block) == 'Mage_Adminhtml_Block_Sales_Order_Shipment_View' && $block->getRequest()->getControllerName() == 'adminhtml_shipment') {
            $shipmentId = $block->getRequest()->getParam('shipment_id');           
            $shipment = Mage::getModel('sales/order_shipment')->load($shipmentId);
            $orderId = $shipment->getOrderId();
            //$block->removeButton('print');
            //$block->removeButton('back');
            $block->removeButton('save');
            $block->removeButton('delete');
            $block->updateButton('save', 'onclick', 'setLocation(\'' . $block->getUrl('adminhtml/sales_order_shipment/email', array('shipment_id' => $shipmentId)) . '\')');
            $block->updateButton('back', 'onclick', 'setLocation(\'' . $block->getUrl('inventoryshipmentadmin/adminhtml_order/view', array('order_id' => $orderId, 'active' => 'order_shipments')) . '\')');
            $block->addButton('view_order', array(
                'label' => Mage::helper('inventoryshipment')->__('View Order Info'),
                'onclick' => 'setLocation(\'' . Mage::helper('adminhtml')->getUrl('inventoryshipmentadmin/adminhtml_order/view', array('order_id' => $orderId, 'active' => 'order_info')) . '\')'
            ));            
        }
        if (get_class($block) == 'Mage_Adminhtml_Block_Sales_Order_Shipment_Create' && $block->getRequest()->getControllerName() == 'adminhtml_shipment') {
            $orderId = $block->getRequest()->getParam('order_id');
            $block->removeButton('back');
            $block->removeButton('reset');
            $block->addButton('view_order', array(
                'label' => Mage::helper('inventoryshipment')->__('View Order Info'),
                'onclick' => 'setLocation(\'' . Mage::helper('adminhtml')->getUrl('inventoryshipmentadmin/adminhtml_order/view', array('order_id' => $orderId, 'active' => 'order_info')) . '\')'
            ));
        }
        if (get_class($block) == 'Mage_Adminhtml_Block_Sales_Order_View' && $block->getRequest()->getControllerName() == 'adminhtml_order') {
            $orderId = $block->getRequest()->getParam('order_id');
            $block->removeButton('print');
            $block->removeButton('save');
            $block->removeButton('delete');
            $block->removeButton('back');
            $block->removeButton('send_notification');
            $block->removeButton('void_payment');
//            $block->removeButton('order_creditmemo');
//            $block->removeButton('order_hold');
//            $block->removeButton('order_unhold');
//            $block->removeButton('order_invoice');
            $block->removeButton('order_reorder');
            $block->removeButton('order_edit');
            $block->removeButton('order_cancel');
            $block->updateButton('order_creditmemo', 'onclick', 'setLocation(\'' . $block->getUrl('adminhtml/sales_order_creditmemo/new', array('order_id' => $orderId)) . '\')');
            $block->updateButton('order_creditmemo', 'onclick', 'setLocation(\'' . $block->getUrl('adminhtml/sales_order_creditmemo/new', array('order_id' => $orderId)) . '\')');
            $block->updateButton('order_creditmemo', 'onclick', 'setLocation(\'' . $block->getUrl('adminhtml/sales_order_creditmemo/new', array('order_id' => $orderId)) . '\')');
            $block->updateButton('order_creditmemo', 'onclick', 'setLocation(\'' . $block->getUrl('adminhtml/sales_order_creditmemo/new', array('order_id' => $orderId)) . '\')');
            $block->updateButton('order_creditmemo', 'onclick', 'setLocation(\'' . $block->getUrl('adminhtml/sales_order_creditmemo/new', array('order_id' => $orderId)) . '\')');
            $block->updateButton('order_invoice', 'onclick', 'setLocation(\'' . $block->getUrl('adminhtml/sales_order_invoice/new', array('order_id' => $orderId)) . '\')');
            $block->updateButton('order_creditmemo', 'onclick', 'setLocation(\'' . $block->getUrl('adminhtml/sales_order_creditmemo/new', array('order_id' => $orderId)) . '\')');
            $block->updateButton('order_ship', 'onclick', 'setLocation(\'' . $block->getUrl('inventoryshipmentadmin/adminhtml_shipment/new', array('order_id' => $orderId)) . '\')');
        }
    }

    public function salesOrderAddress($observer) {
        $addressId = Mage::app()->getRequest()->getParam('address_id');
        $url = Mage::helper('adminhtml')->getUrl('adminhtml/sales_order/address', array('_secure' => true, 'address_id' => $addressId));
        header('Location: ' . $url);
        exit;
    }

    public function changeSalesOrderAddress($observer) {
        $orderId = Mage::app()->getRequest()->getParam('order_id');
        $url = Mage::helper('adminhtml')->getUrl('inventoryshipmentadmin/adminhtml_order/view', array('order_id' => $orderId, 'active' => 'order_info'));
        header('Location: ' . $url);
        exit;
    }

    public function changeCustomerEdit($observer) {
        $id = Mage::app()->getRequest()->getParam('id');
        $url = Mage::helper('adminhtml')->getUrl('adminhtml/customer/edit', array('id' => $id));
        header('Location: ' . $url);
        exit;
    }

}
