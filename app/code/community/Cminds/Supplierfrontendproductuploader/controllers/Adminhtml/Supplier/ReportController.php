<?php
class Cminds_Supplierfrontendproductuploader_Adminhtml_Supplier_ReportController extends Mage_Adminhtml_Controller_Action
{
    public function preDispatch() {
        parent::preDispatch();

        $this->_getHelper()->validateModule();
    }
    
    protected function _initAction() {
        $this->loadLayout();
        return $this;
    }

    public function indexAction() {
        $this->_title($this->__('Manage Supplier Products'));
        $this->loadLayout();
        $this->_setActiveMenu('report');
        $block = $this->getLayout()->createBlock('supplierfrontendproductuploader/adminhtml_report_items_ordered');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function exportCsvAction() {
        $fileName = 'supplier_items_ordered.csv';
        $content = $this->getLayout()->createBlock('supplierfrontendproductuploader/adminhtml_report_items_ordered')
            ->getCsv();
        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction() {
        $fileName = 'supplier_items_ordered.xml';
        $content = $this->getLayout()->createBlock('supplierfrontendproductuploader/adminhtml_report_items_ordered')
            ->getXml();
        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream') {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK', '');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename=' . $fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
    
    public function _getHelper($helper = 'supplierfrontendproductuploader') {
        return Mage::helper($helper);
    }
}
