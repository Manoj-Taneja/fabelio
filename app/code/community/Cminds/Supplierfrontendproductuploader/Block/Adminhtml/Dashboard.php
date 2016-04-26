<?php
class Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Dashboard extends Mage_Adminhtml_Block_Dashboard {

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('supplierfrontendproductuploader/dashboard/index.phtml');

    }
	protected function _prepareLayout()
    {
        $this->setChild('lastSupplierProducts',
                $this->getLayout()->createBlock('supplierfrontendproductuploader/adminhtml_dashboard_supplier_products')
        );
        parent::_prepareLayout();
    }
}