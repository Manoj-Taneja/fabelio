<?php

/**
 * Product View block
 *
 * @category Mage
 * @package  Mage_Catalog
 * @module   Catalog
 * @author   Kamal Kumar <kamal.kumar@kelltontech.com>
 */
class MyCalender_Catalog_Block_Product_View extends Mage_Catalog_Block_Product_View
{
    public function __construct() {
        parent::__construct();
    }
	public function getDeliveryDateOptions($deliveryDays=0){
		$return=array();
		$return['totalSundays']=0;
		$return['totalSaturdays']=0;
		$return['totalHolidaysWithoutSatSun']=0;
		$return['deliveryDate']='NA';
		$return['deliveryDays']=$deliveryDays;
		$return['differenceInSeconds']=0;
		$currentTime=date("H:i:s");
		$cutOffTime="12:00:00";
		$currentDateTime=date("Y-m-d H:i:s");
		$currentDate=date("Y-m-d");
		$datetime = DateTime::createFromFormat('Y-m-d H:i:s', $currentDateTime);
		$currentDayName=$datetime->format('D');
		$counterFromDate=$currentDate;
		$dayAdd=0;
		if( strtotime($cutOffTime)<strtotime($currentTime) ){
			$dayAdd++;
		}
		$i=strtotime($counterFromDate);
		$counterToDate=date('Y-m-d', strtotime("+".$dayAdd." days"));
		$counterFromDateDayAdder=1;
		$resource = Mage::getSingleton('core/resource');
		$readConnection = $resource->getConnection('core_read');
		while(strtotime($counterFromDate)<=strtotime($counterToDate)){
			$query = 'SELECT * FROM ' . $resource->getTableName('mycalender_calender_holiday')." WHERE (holiday_start_date<'".$counterFromDate."' OR holiday_start_date<'".$counterFromDate."') AND (holiday_end_date>'".$counterFromDate."' OR holiday_end_date='".$counterFromDate."')";
			$results = $readConnection->fetchAll($query);
	
			if(date("w",$i) == 6) {
				$dayAdd++;
		
			}else if(date("w",$i) == 0) {
				$dayAdd++;
		
			}else if(count($results)>0){
				$dayAdd++;
			}
			$counterFromDate=date('Y-m-d', strtotime("+".$counterFromDateDayAdder." days"));
			$counterToDate=date('Y-m-d', strtotime("+".$dayAdd." days"));
			$counterFromDateDayAdder++;
			$i=$i+86400;
		}
		$return['differenceInSeconds'] = strtotime($counterToDate." 12:00:00") - strtotime($currentDateTime);
		//echo "Current DateTime : ".$currentDateTime." Current Date : ".$currentDate." Current Time : ".$currentTime." Current DayName : ".$currentDayName;
		if($deliveryDays >0){
			$counterDate=$currentDate;
			$toDate=date('Y-m-d', strtotime("+".$deliveryDays." days"));
			$deliveryDate=$toDate;
			$countDayAdder=1;
			$i=strtotime($counterDate);
			$deliveryDateDayAdder=$deliveryDays;
			$cutoffDay=0;
			if( strtotime($cutOffTime)<strtotime($currentTime) ){
				$deliveryDateDayAdder++;
				$cutoffDay++;
			}
			$totalSaturdays=0;
			$totalSundays=0;
			$totalHolidays=0;
			while(strtotime($counterDate)<=strtotime($deliveryDate)){
				$query1 = 'SELECT * FROM ' . $resource->getTableName('mycalender_calender_holiday')." WHERE (holiday_start_date<'".$counterDate."' OR holiday_start_date<'".$counterDate."') AND (holiday_end_date>'".$counterDate."' OR holiday_end_date='".$counterDate."')";
				$results1 = $readConnection->fetchAll($query1);
				if(date("w",$i) == 6) {
					$deliveryDateDayAdder++;
					$totalSaturdays++;
				}else if(date("w",$i) == 0) {
					$deliveryDateDayAdder++;
					$totalSundays++;
				}else if(count($results1)>0){
					$deliveryDateDayAdder++;
					$totalHolidays++;
				}
				$counterDate=date('Y-m-d', strtotime("+".$countDayAdder." days"));
				$deliveryDate=date('Y-m-d', strtotime("+".$deliveryDateDayAdder." days"));
				$countDayAdder++;
				$i=$i+86400;
			}
			$return['totalSundays']=$totalSaturdays;
			$return['totalSaturdays']=$totalSaturdays;
			$return['totalHolidaysWithoutSatSun']=$totalHolidays;
			$return['deliveryDate']=$deliveryDate;
			return $return;
		}
	}
}
