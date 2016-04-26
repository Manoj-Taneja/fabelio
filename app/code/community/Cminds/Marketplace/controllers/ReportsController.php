<?php

class Cminds_Marketplace_ReportsController extends Cminds_Marketplace_Controller_Action {
    public function preDispatch() {
        parent::preDispatch();

        $hasAccess = $this->_getHelper()->hasAccess();

        if(!$hasAccess) {
            $this->getResponse()->setRedirect($this->_getHelper('supplierfrontendproductuploader')->getSupplierLoginPage());
        }
    }
    public function ordersAction() {
        $this->_renderBlocks(false, true);
    }

    public function mostViewedAction() {
        $this->_renderBlocks(false, true);
    }

    public function bestsellersAction() {
        $postData = $this->getRequest()->getPost();

        if(isset($postData['submit']) && $postData['submit'] == 'export' ) {
            $this->_redirect('*/*/exportBestsellers');
        }

        $this->_renderBlocks(false, true);
    }

    public function exportBestsellersAction() {
        $fileName   = 'bestsellers-' . gmdate('YmdHis') . '.csv';
        $grid       = $this->getLayout()->createBlock('marketplace/report_bestsellers');

        $this->_prepareDownloadResponse($fileName, $grid->getCsvFileEnhanced());
    }

    public function lowStockAction() {
        $this->_renderBlocks(false, true);
    }
}
