<?php

class Cminds_Marketplace_OrderController extends Cminds_Marketplace_Controller_Action {
    public function preDispatch() {
        parent::preDispatch();
//        $this->_getHelper()->validateModule();
        $hasAccess = $this->_getHelper()->hasAccess();

        if(!$hasAccess) {
            $this->getResponse()->setRedirect($this->_getHelper('supplierfrontendproductuploader')->getSupplierLoginPage());
        }
    }
    public function indexAction() {
        $this->_renderBlocks(false, true);
    }
    public function viewAction() {
        // @todo: add validation if products from orders belongs to the supplier
        $id = $this->getRequest()->getParam('id');
        Mage::register('order_id', $id);
        $this->_renderBlocks();
    }
}
