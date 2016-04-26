<?php

class Cminds_Supplierfrontendproductuploader_IndexController extends Cminds_Supplierfrontendproductuploader_Controller_Action {
    public function preDispatch() {
        parent::preDispatch();

        $this->_getHelper()->validateModule();
        
        $hasAccess = $this->_getHelper()->hasAccess();

        if(!$hasAccess) {
            $this->getResponse()->setRedirect($this->_getHelper()->getSupplierLoginPage());
        }
    }
    public function indexAction() {
        $this->_renderBlocks();
    }
}
