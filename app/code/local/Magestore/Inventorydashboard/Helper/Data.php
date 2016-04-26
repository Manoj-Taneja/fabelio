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
 * @package     Magestore_Inventorydashboard
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventorydashboard Helper
 * 
 * @category    Magestore
 * @package     Magestore_Inventorydashboard
 * @author      Magestore Developer
 */
class Magestore_Inventorydashboard_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getReportType()
    {        
        $resource = Mage::getSingleton('core/resource');        
        $readConnection = $resource->getConnection('core_read');
        $result = '';
        $sql = "SELECT * from ".$resource->getTableName('erp_inventory_dashboard_report_type');
        $result = $readConnection->fetchAll($sql);
        return $result;
    }
    
    //getDateRangeByDay
    public function getDateRangeByDay($days)
    {
        $dateEnd   = Mage::app()->getLocale()->date();
        $dateStart = clone $dateEnd;

        // go to the end of a day
        $dateEnd->setHour(23);
        $dateEnd->setMinute(59);
        $dateEnd->setSecond(59);

        $dateStart->setHour(0);
        $dateStart->setMinute(0);
        $dateStart->setSecond(0);
        $dateStart->subDay($days - 1);
        $dateStart->setTimezone('Etc/UTC');
        $dateEnd->setTimezone('Etc/UTC');
        return array('from' => $dateStart, 'to' => $dateEnd, 'datetime' => true);
    }
}