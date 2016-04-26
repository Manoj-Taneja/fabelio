<?php
class Kontenta_Status_Adminhtml_Statuses_IndexController extends Mage_Adminhtml_Controller_Action {
    public function indexAction(){
        $order = Mage::getModel('sales/order');

        $postData = $this->getRequest()->getPost();
        $id = $this->getRequest()->getParam('order_id');
        try{
            if($postData['status']){
                $find = false;
                $statusValue = $postData['status'];
                foreach($order->getConfig()->getStates() as $state=>$label){
                    foreach($order->getConfig()->getStateStatuses($state) as $status=>$statusLabel){
                        if($status == $statusValue){
                            $find = true;
                            break(2);
                        }
                    }
                }
                if($find)
                    Mage::getModel('statuses/sales_order')->load($id)->setPrimaryState($state, $status, '', null, false)->save();
                else{
                    $this->_getSession()->addError("Please assign status ".$postData['status']." to state.");
                }
            }
        }catch(Exception $e){
            $this->_getSession()->addError($e->getMessage());
        }

        Mage::app()->getResponse()->setRedirect(Mage::helper('adminhtml')->getUrl("adminhtml/sales_order/view", array('order_id'=> $id)));
    }
} 