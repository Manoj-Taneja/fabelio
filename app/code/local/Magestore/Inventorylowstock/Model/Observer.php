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
 * @package     Magestore_Inventorypurchasing
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventorypurchasing Observer Model
 * 
 * @category    Magestore
 * @package     Magestore_Inventorypurchasing
 * @author      Magestore Developer
 */
class Magestore_Inventorylowstock_Model_Observer {

    const CRON_STRING_PATH = 'crontab/jobs/magestore_inventorylowstock/schedule/cron_expr';
    const CRON_STRING_PATH_RUN = 'crontab/jobs/magestore_inventorylowstock/run/model';

    public function updatelowstock($observer) {
        if (Mage::app()->getRequest()->getParam('section') != 'inventoryplus')
            return;
        
        $configData = $observer->getEvent()->getConfigData();        
        $useCron = $configData->getData('groups/notice/fields/use_cron');	
        if ($useCron['value']!=1) {
            return;
        }        
        $now = Mage::getModel('core/date')->timestamp(time());
        $daylyUpdates = $configData->getData('groups/notice/fields/daily_updates/value');
        $specificDays = $configData->getData('groups/notice/fields/specificdays/value');
        $monthlyUpdates = $configData->getData('groups/notice/fields/monthly_updates/value');
        $specificMonths = $configData->getData('groups/notice/fields/specificmonths/value');
        $times = $configData->getData('groups/notice/fields/time_updates/value');
        $oldTime = 0;
        $i = 0;

        foreach ($times as $time) {
            if ((int) $time > (int) date('H', $now)) {		//If hour for cronning bigger than current hour.
                if ($i == 0) {
                    $oldTime = (int) $time;
                }
                $i++;
                if (((int) $time - (int) date('H', $now) <= (int) $oldTime - (int) date('H', $now))) {
                    $oldTime = (int) $time;
                }
            }
            if ((int) $times[count($times) - 1] <= (int) date('H', $now)) {
                if ($i == 0) {
                    $oldTime = (int) $time;
                }
                $i++;
                if (((int) $time - (int) date('H', $now) <= (int) $oldTime - (int) date('H', $now))) {
                    $oldTime = (int) $time;
                }
            }
        }
        if ((int) $oldTime < (int) date('H', $now)) {
            $oldTime = (int) $times[0];
        }
        $setTime = $oldTime;
        //set day
        if ($daylyUpdates == 1) {
            $setDay = '*';
        } else {
            $j = 0;
            $oldDay = 0;
            foreach ($specificDays as $specificDay) {
                if ((int) $specificDay == (int) date('d', $now) && (int) $setTime >= (int) date('H', $now)) {
                    $oldDay = $specificDay;
                    break;
                }
                if ((int) $specificDay >= (int) date('d', $now)) {
                    if ($j == 0) {
                        $oldDay = (int) $specificDay;
                    }
                    $j++;
                    if (((int) $specificDay - (int) date('d', $now) <= (int) $oldDay - (int) date('d', $now))) {
                        $oldDay = (int) $specificDay;
                    }
                }

                if ((int) $specificDays[count($specificDays) - 1] <= (int) date('d', $now)) {
                    if ($j == 0) {
                        $oldDay = (int) $specificDay;
                    }
                    $j++;
                    if (((int) $specificDay - (int) date('d', $now) <= (int) $oldDay - (int) date('d', $now))) {
                        $oldDay = (int) $specificDay;
                    }
                }
            }

            $setDay = $oldDay;
        }
//set month        
        if ($monthlyUpdates == 1) {
            $setMonth = '*';
        } else {
            $k = 0;
            $oldMonth = 0;
            foreach ($specificMonths as $specificMonth) {
                if ((int) $specificMonth == (int) date('m', $now) && (int) $setDay >= (int) date('d', $now)) {
                    $oldMonth = $specificMonth;
                    break;
                }
                if ((int) $specificMonth >= (int) date('m', $now)) {
                    if ($j == 0) {
                        $oldMonth = (int) $specificMonth;
                    }
                    $j++;
                    if (((int) $specificMonth - (int) date('m', $now) <= (int) $oldMonth - (int) date('m', $now))) {
                        $oldMonth = (int) $specificMonth;
                    }
                }

                if ((int) $specificMonths[count($specificMonths) - 1] <= (int) date('m', $now)) {
                    if ($j == 0) {
                        $oldMonth = (int) $specificMonth;
                    }
                    $j++;
                    if (((int) $specificMonth - (int) date('m', $now) <= (int) $oldMonth - (int) date('m', $now))) {
                        $oldMonth = (int) $specificMonth;
                    }
                }
            }
            $setMonth = $oldMonth;
        }
		/* Changed by Magnus - Re-change setTime */
		$times = $configData->getData('groups/notice/fields/time_updates/value');
		if(count($times)>=24){$setTime='*';}
		else{
			$setTime = implode(',',$times);
		}
        $cronExprArray = array(
            intval(2),
            $setTime,
            $setDay,
            $setMonth,
            '*',
        );
		/* End changed by Magnus */
        $cronExprString = join(' ', $cronExprArray);
        $session = Mage::getSingleton('adminhtml/session');
        $session->setData('inventory_notification_time', $setTime);
        $session->setData('inventory_notification_day', $setDay);
        $session->setData('inventory_notification_month', $setMonth);
        try {
            Mage::getModel('core/config')->saveConfig(self::CRON_STRING_PATH, $cronExprString);
            Mage::getModel('core/config')->saveConfig(self::CRON_STRING_PATH_RUN, 'inventorylowstock/notification::notification');
        } catch (Exception $e) {
            throw new Exception(Mage::helper('cron')->__('Unable to save the cron expression.'));
        }
    }

    public function adminSystemSave($observer) {
        $session = Mage::getSingleton('adminhtml/session');
        $setTime = $session->getData('inventory_notification_time');
        $setDay = $session->getData('inventory_notification_day');
        $setMonth = $session->getData('inventory_notification_month');

        $notificationLog = Mage::getModel('inventorylowstock/notificationlog')
                ->setData('current_time', $setTime)
                ->setData('current_day', $setDay)
                ->setData('current_month', $setMonth)
                ->setData('status', 0)
                ->setData('last_update', now())
                ->save();
        $session->unsetData('inventory_notification_time');
        $session->unsetData('inventory_notification_day');
        $session->unsetData('inventory_notification_month');
    }

    public function inventorylowstockMenu($observer) {
        $menu = $observer->getEvent()->getMenus()->getMenu();

        $menu['lowstock'] = array('label' => Mage::helper('inventoryplus')->__('Low Stock Notifications'),
            'sort_order' => 600,
            'url' => '',
            'active' => (in_array(Mage::app()->getRequest()->getControllerName(), array('adminhtml_notificationlog'))) ? true : false,
            'level' => 0,
            'children' => array(
                'notificationlog' => array('label' => Mage::helper('inventoryplus')->__('Notification Logs'),
                    'sort_order' => 100,
                    'url' => Mage::helper("adminhtml")->getUrl("inventorylowstockadmin/adminhtml_notificationlog/", array("_secure" => Mage::app()->getStore()->isCurrentlySecure())),
                    'active' => false,
                    'level' => 1),
                'settings' => array('label' => Mage::helper('inventoryplus')->__('Settings'),
                    'sort_order' => 110,
                    'url' => Mage::helper("adminhtml")->getUrl("adminhtml/system_config/edit/section/inventoryplus", array("_secure" => Mage::app()->getStore()->isCurrentlySecure())),
                    'active' => (Mage::app()->getRequest()->getControllerName() == 'system_config') ? true : false,
                    'level' => 0)
            )
        );
        $observer->getEvent()->getMenus()->setData('menu', $menu);
    }

    public function controllerActionPredispatch($observer) {
        if (Mage::registry('INVENTORY_UPDATE_NOTIFICATION'))
            return;
        Mage::register('INVENTORY_UPDATE_NOTIFICATION', true);

        if (!Mage::getStoreConfig('inventoryplus/notice/stock_notice')) {
            return;
        }
        if (Mage::getStoreConfig('inventoryplus/notice/use_cron')) {
            return;
        }

        $now = Mage::getModel('core/date')->timestamp(time());
        $hour = date('H', $now);
        $day = date('d', $now);
        $month = date('m', $now);
        $notificationLog = Mage::getModel('inventorylowstock/notificationlog')->getCollection()
                ->addFieldToFilter('status', 0)
                ->getLastItem();

        if (strtotime(now()) >= strtotime($notificationLog->getLastUpdate()) + 86400) {


            $oldEmailLogs = Mage::getModel('inventorylowstock/sendemaillog')->getCollection()
                    ->addFieldToFilter('status', 0);
            foreach ($oldEmailLogs as $oldEmailLog) {
                $oldEmailLog->setData('status', 1)->save();
            }

            $qty_notice = Mage::getStoreConfig('inventoryplus/notice/qty_notice');
            $emailNoticeAdmin = Mage::getStoreConfig('inventoryplus/notice/email_notice');
            $notice_for = Mage::getStoreConfig('inventoryplus/notice/notice_for');
            // notify low stock for warehouse
            if ($notice_for == 1 || $notice_for == 3) {
                $warehouses = Mage::getModel('inventoryplus/warehouse')->getCollection();
                foreach ($warehouses as $warehouse) {
                    $warehouseProducts = Mage::getModel('inventoryplus/warehouse_product')->getCollection()
                            ->addFieldToFilter('warehouse_id', $warehouse->getId())
                            ->addFieldToFilter('total_qty', array('lteq' => (int) $qty_notice));

                    if ($warehouseProducts->getSize()) {
                        Mage::helper('inventorylowstock')->sendWarehouseEmail($warehouse, $warehouseProducts);
                    }
                }
            }

            // notify low stock for admin
            if ($notice_for == 2 || $notice_for == 3) {
                $stockProducts = Mage::getModel('cataloginventory/stock_item')->getCollection()
                        ->addFieldToFilter('qty', array('lteq' => (int) $qty_notice))
                        ->addFieldToFilter('type_id', array('nin' => array('configurable', 'bundle', 'grouped')));
                if ($stockProducts->getSize()) {
                    if ($emailNoticeAdmin)
                        Mage::helper('inventorylowstock')->sendSystemEmail($stockProducts);
                }
            }

            $times = Mage::getStoreConfig('inventoryplus/notice/time_updates');
            $dailyUpdate = Mage::getStoreConfig('inventoryplus/notice/daily_updates');
            $dates = Mage::getStoreConfig('inventoryplus/notice/specificdays');
            $monthUpdate = Mage::getStoreConfig('inventoryplus/notice/monthly_updates');
            $months = Mage::getStoreConfig('inventoryplus/notice/specificmonths');

            $now = Mage::getModel('core/date')->timestamp(time());

//set time
            $oldTime = $notificationLog->getCurrentTime();
            $timeUpdates = explode(',', $times);
            $positionTime = array_search($notificationLog->getCurrentTime(), $timeUpdates);

            $time = $timeUpdates[0];
            for ($i = $positionTime + 1; $i < count($timeUpdates); $i++) {
                if (!isset($timeUpdates[$i])) {
                    $time = $timeUpdates[0];
                }
                if ($timeUpdates[$i] >= date('H', $now)) {
                    $time = $timeUpdates[$i];
                    break;
                } else {
                    $time = $timeUpdates[0];
                }
            }


//set day
            $oldDay = $notificationLog->getCurrentDay();
            $dayList = explode(',', $dates);
            $positionDay = array_search($notificationLog->getCurrentDay(), explode(',', $dates));
            $setDay = $notificationLog->getCurrentDay();
            if ($dailyUpdate == 1) {
                $setDay = '*';
            } else {
                if ($notificationLog->getCurrentDay() <= $day) {
                    for ($i = $positionDay; $i < count($dayList); $i++) {
                        if (count($timeUpdates) == 1) {
                            if (isset($dayList[$i + 1])) {
                                $setDay = $dayList[$i + 1];
                                break;
                            } else {
                                $setDay = $dayList[0];
                                break;
                            }
                        }
                        if ((int) $dayList[$i] == (int) date('d', $now) && (int) $time >= (int) date('H', $now)) {
                            $setDay = $dayList[$i];
                            break;
                        } else {
                            if (!isset($dayList[$i])) {
                                $setDay = $dayList[0];
                            }
                            if ($dayList[$i] >= date('d', $now)) {
                                $setDay = $dayList[$i];
                                break;
                            } else {
                                $setDay = $dayList[0];
                            }
                        }
                    }
                }
            }

//set month

            $oldMonth = $notificationLog->getCurrentMonth();
            $monthList = explode(',', $months);
            $positionMonth = array_search($notificationLog->getCurrentMonth(), explode(',', $months));
            $setMonth = $notificationLog->getCurrentMonth();
            if ($monthUpdate == 1) {
                $setMonth = '*';
            } else {
                if ($notificationLog->getCurrentMonth() <= $month) {
                    for ($i = $positionMonth; $i < count($monthList); $i++) {
                        if (count($dayList) == 1) {
                            if (isset($monthList[$i + 1])) {
                                $setMonth = $monthList[$i + 1];
                                break;
                            } else {
                                $setMonth = $monthList[0];
                                break;
                            }
                        }
                        if ((int) $monthList[$i] == (int) date('m', $now) && (int) $setDay >= (int) date('m', $now)) {
                            $setMonth = $monthList[$i];
                            break;
                        } else {
                            if (!isset($monthList[$i])) {
                                $setMonth = $dayList[0];
                            }
                            if ($monthList[$i] >= date('m', $now)) {
                                $setMonth = $monthList[$i];
                                break;
                            } else {
                                $setMonth = $dayList[0];
                            }
                        }
                    }
                }
            }

            $cronExprArray = array(
                intval(2),
                intval($time),
                $setDay,
                $setMonth,
                '*',
            );
            $cronExprString = join(' ', $cronExprArray);
            $notificationLog->setData('status', 1)->save();
            Mage::getModel('inventorylowstock/notificationlog')
                    ->setData('current_time', $time)
                    ->setData('current_day', $setDay)
                    ->setData('current_month', $setMonth)
                    ->setData('status', 0)
                    ->setData('last_update', now())
                    ->save();
            try {
                Mage::getModel('core/config')->saveConfig(self::CRON_STRING_PATH, $cronExprString);
            } catch (Exception $e) {
                throw new Exception(Mage::helper('cron')->__('Unable to save the cron expression.'));
            }
        }
    }

}
