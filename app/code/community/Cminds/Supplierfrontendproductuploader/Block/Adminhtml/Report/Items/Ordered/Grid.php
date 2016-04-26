<?php
class Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Report_Items_Ordered_Grid extends Mage_Adminhtml_Block_Report_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('supplierItemsOrderedGrid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setSubReportSize(false);
    }

    protected function _prepareCollection() {
        parent::_prepareCollection();
        $this->getCollection()->initReport('supplierfrontendproductuploader/report_items_ordered');
        return $this;
    }

    protected function _prepareColumns() {
        $this->addColumn('qty_ordered', array(
            'header'    =>Mage::helper('reports')->__('Quantity Ordered'),
            'align'     =>'right',
            'sortable' => false,
            'type'      =>'number',
            'index' => 'ordered_qty'
        ));

        $this->addExportType('*/*/export-csv', Mage::helper('supplierfrontendproductuploader')->__('CSV'));
        $this->addExportType('*/*/export-xml', Mage::helper('supplierfrontendproductuploader')->__('XML'));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return false;
    }

    public function getReport($from, $to) {
        if ($from == '') {
            $from = $this->getFilter('report_from');
        }
        if ($to == '') {
            $to = $this->getFilter('report_to');
        }

        $totalObj = Mage::getModel('reports/totals');
        $totals = $totalObj->countTotals($this, $from, $to);
        $this->setTotals($totals);
        $this->addGrandTotals($totals);

        return $this->getCollection()->getReport($from, $to);
    }
}
