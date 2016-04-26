<?php
class Cminds_Marketplace_Block_Report_Bestsellers extends Cminds_Marketplace_Block_Report_Abstract {
    protected $_resourceModel = "marketplace/report_bestsellers_collection";
    protected $_columns = array('Period', 'Qty Ordered', 'Product ID' ,'Products Name', 'Price');
    protected $_removeIndexes = array('value');

    public $title = 'Products Bestsellers Report';
}