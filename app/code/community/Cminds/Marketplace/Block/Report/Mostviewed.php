<?php
class Cminds_Marketplace_Block_Report_Mostviewed extends Cminds_Marketplace_Block_Report_Abstract {
    protected $_resourceModel = "marketplace/report_viewed_collection";
    public $title = 'Most Viewed Products Report';
    protected $_lastColumnHeader = 'Number of Views';
}