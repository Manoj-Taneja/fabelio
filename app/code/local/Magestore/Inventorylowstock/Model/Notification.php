<?php

class Magestore_Inventorylowstock_Model_Notification {

    const CRON_STRING_PATH = 'crontab/jobs/magestore_inventorylowstock/schedule/cron_expr';
    const CRON_STRING_PATH_RUN = 'crontab/jobs/magestore_inventorylowstock/run/model';

    public function notification() {
        if(!Mage::getStoreConfig('inventoryplus/notice/stock_notice',Mage::app()->getStore()->getStoreId())){
            return;
        }
        if (Mage::getModel('core/cookie')->get('save_inventory_notification_log')) {
            return;
        }
        $notificationLog = Mage::getModel('inventorylowstock/notificationlog')->getCollection()->getLastItem();
        if ($notificationLog->getId() && $notificationLog->getStatus() == 0) {
            $enable = Mage::getStoreConfig('inventoryplus/notice/stock_notice', Mage::app()->getStore()->getStoreId());
            $qty_notice = Mage::getStoreConfig('inventoryplus/notice/qty_notice', Mage::app()->getStore()->getStoreId());
            $emailNoticeAdmin = Mage::getStoreConfig('inventoryplus/notice/email_notice', Mage::app()->getStore()->getStoreId());
            $notice_for = Mage::getStoreConfig('inventoryplus/notice/notice_for', Mage::app()->getStore()->getStoreId());
            
            $oldEmailLogs = Mage::getModel('inventorylowstock/sendemaillog')->getCollection()
                                                                        ->addFieldToFilter('status',0);
                foreach($oldEmailLogs as $oldEmailLog){
                    $oldEmailLog->setData('status',1)->save();
                }
            // notify low stock for warehouse
            if ($notice_for == 1 || $notice_for == 3) {
                $warehouses = Mage::getModel('inventoryplus/warehouse')->getCollection();
                foreach ($warehouses as $warehouse) {
                    $warehouseProducts = Mage::getModel('inventoryplus/warehouse_product')->getCollection()
                            ->addFieldToFilter('warehouse_id', $warehouse->getId())
                            ->addFieldToFilter('available_qty', array('lteq' => (int) $qty_notice));

                    if ($warehouseProducts->getSize()) {
                        if ($enable)
                            Mage::helper('inventorylowstock')->sendWarehouseEmail($warehouse,$warehouseProducts);
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
                if(!isset($timeUpdates[$i])){
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

            if ($dailyUpdate == 1) {
                $setDay = '*';
            } else {
                for ($i = $positionDay ; $i < count($dayList); $i++) {
                    if ((int) $dayList[$i] == (int) date('d', $now) && (int) $time >= (int) date('H', $now)) {
                        $setDay = $dayList[$i];
                        break;
                    } else {
                        if(!isset($dayList[$i])){
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

//set month

            $oldMonth = $notificationLog->getCurrentMonth();
            $monthList = explode(',', $months);
            $positionMonth = array_search($notificationLog->getCurrentMonth(), explode(',', $months));
            if ($monthUpdate == 1) {
                $setMonth = '*';
            } else {
                for ($i = $positionMonth ; $i < count($monthList); $i++) {
                    if ((int) $monthList[$i] == (int) date('m', $now) && (int) $setDay >= (int) date('m', $now)) {
                        $setMonth = $monthList[$i];
                        break;
                    } else {
                        if(!isset($monthList[$i])){
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

        Mage::getModel('core/cookie')->set('save_inventory_notification_log', '1', 300);
    }

}
