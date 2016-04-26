<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2010-2013 Amasty (http://www.amasty.com)
*/
class Amasty_Number_Model_Eav_Entity_Type extends Mage_Eav_Model_Entity_Type
{
    /**
     * Retreive new incrementId
     *
     * @param int $storeId
     * @return string
     */
    public function fetchNewIncrementId($storeId = null)
    {
        $incrementId = parent::fetchNewIncrementId($storeId);
        // save in store table default numbers
        if (!$incrementId) {
            return false;
        }
        
        if (!Mage::getStoreConfig('amnumber/general/enabled', $storeId)){
            return $incrementId;
        }
        
        $type = $this->getEntityTypeCode();
        if (!in_array($type, array('order', 'shipment', 'invoice', 'creditmemo'))){
            return $incrementId;
        }
        
        // same mumber as order
        if (Mage::getStoreConfig('amnumber/'. $type .'/same', $storeId)){
            return $incrementId;
        }
        
        $timeOffset = trim(Mage::getStoreConfig('amnumber/general/offset', $storeId));
        if (!preg_match('/^[+\-]\d+$/', $timeOffset)){
            $timeOffset = 0;
        }
        $now = 3600*$timeOffset + time();
        
        $cfg = Mage::getStoreConfig('amnumber/' . $type, $storeId);
        
        //get last counter value and update it
        $start = max(intVal($cfg['start']), 0);

        $oldDate = $this->_getNotCachedConfig('date', $storeId); 
        
        $last = $this->_getNotCachedConfig('counter', $storeId);
        if ($last->getValue() > 0 ){ // not first time
            if ($cfg['reset']){ //we track date change 
                // date has changed 
                if (!$oldDate->getValue() || date($cfg['reset'], $now) != date($cfg['reset'], strtotime($oldDate->getValue()))){
                     $last->setValue($start);   
                }
            }    
        }
//         else {
//             $last->setValue($start);
//         }

        $oldDate->setValue(date('Y-m-d', $now));
        $oldDate->save();

        $counter = max(intVal($last->getValue()), $start) + max(intVal($cfg['increment']), 1);

        $last->setValue($counter);
        $last->save();
        
        if (intVal($cfg['pad'])){
            $counter = str_pad($counter, intVal($cfg['pad']), '0', STR_PAD_LEFT);
        }
        $vars = array(
            'store_id' => $storeId, 
            'store'    => $storeId, 
            'yy'       => date('y', $now), 
            'yyyy'     => date('Y', $now), 
            'mm'       => date('m', $now), 
            'm'        => date('n', $now), 
            'dd'       => date('d', $now), 
            'd'        => date('j', $now), 
            'hh'       => date('H', $now), 
            'rand'     => rand(1000,9999), 
            'counter'  => $counter, 
        );        
        
        $incrementId = $cfg['format'];

        foreach ($vars as $k => $v){
            $incrementId = str_replace('{'. $k .'}', $v, $incrementId);
        }

        return $incrementId;
    }
    
    
    /**
     * Gets not cached config row as object.
     *
     * @param string $path
     * @param int $storeId
     * @return Mage_Core_Model_Config_Data
     */
    protected function _getNotCachedConfig($path, $storeId)
    {
        $type = $this->getEntityTypeCode();
        $cfg = Mage::getStoreConfig('amnumber/' . $type, $storeId);
        
        $scope   = 'default';
        $scopeId = 0;
        if ($cfg['per_store']){
            $scope   = 'stores';
            $scopeId = $storeId;
        } 
        elseif ($cfg['per_website']){
            $scope   = 'websites';
            $scopeId = Mage::app()->getStore($storeId)->getWebsite()->getId();
        }
        
        $collection = Mage::getResourceModel('core/config_data_collection');
        $collection->addFieldToFilter('scope', $scope);
        $collection->addFieldToFilter('scope_id', $scopeId);
        $collection->addFieldToFilter('path', 'amnumber/' . $type . '/' . $path);        
        $collection->setPageSize(1);  
        
        $v = Mage::getModel('core/config_data');
        if (count($collection)){
            $v = $collection->getFirstItem();    
        } 
        else {
            $v->setScope($scope);    
            $v->setScopeId($scopeId);    
            $v->setPath('amnumber/' . $type . '/' . $path);    
        }
        
        return $v;       
    }
}