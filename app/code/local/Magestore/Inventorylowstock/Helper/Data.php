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
 * @package     Magestore_Inventorylowstock
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventorylowstock Helper
 * 
 * @category    Magestore
 * @package     Magestore_Inventorylowstock
 * @author      Magestore Developer
 */
class Magestore_Inventorylowstock_Helper_Data extends Mage_Core_Helper_Abstract {
    
    const XML_PATH_WAREHOUSE_EMAIL = 'inventoryplus/notice/warehouse_email';
    const XML_PATH_SYSTEM_EMAIL = 'inventoryplus/notice/system_email';
    
    
    public function sendWarehouseEmail($warehouse,$warehouseProducts) {
        $qty_notice = Mage::getStoreConfig('inventoryplus/notice/qty_notice');
        $str = 'total_qty%5Bto%5D=' . "$qty_notice";
        $filter = base64_encode($str);
        $link = Mage::helper('adminhtml')->getUrl("inventoryplusadmin/adminhtml_warehouse/edit", array('filter' => $filter, 'id' => $warehouse->getId(), 'loadptab' => true,'uncheck_url_key' => true));
        $storeId = Mage::app()->getStore()->getId();
        $template = Mage::getStoreConfig(self::XML_PATH_WAREHOUSE_EMAIL, $storeId);
        $mailTemplate = Mage::getModel('core/email_template');

        $translate = Mage::getSingleton('core/translate');
        $from_email = Mage::getStoreConfig('trans_email/ident_general/email'); //fetch sender email Admin
        $from_name = Mage::getStoreConfig('trans_email/ident_general/name'); //fetch sender name Admin
        if(!$from_email || !$warehouse->getManagerEmail()){
            return;
        }
        $sender = array('email' => $from_email, 'name' => $from_name);
        $mailTemplate
                ->setTemplateSubject($this->__('Warehouse products are low'))
                ->sendTransactional(
                        $template, $sender, $warehouse->getManagerEmail(), $warehouse->getManagerName(), array(
                    'warehouse_name' => $warehouse->getWarehouseName(),
                    'manager_name' => $warehouse->getManagerName(),
                    'qty_notice' => $qty_notice,
                    'link' => $link
                        )
        );
        $translate->setTranslateInline(true);
        
        
        $sendEmailLog = Mage::getModel('inventorylowstock/sendemaillog');
        $now = Mage::getModel('core/date')->timestamp(time());
        try{
            
            
            $model = $sendEmailLog->setData('sent_at',date('Y-m-d H:i:s', $now))
                    ->setData('type',$this->__('Warehouse'))
                    ->setData('email_received',$warehouse->getManagerEmail())
                    ->setData('warehouse_name',$warehouse->getWarehouseName())
                    ->setData('manager_name',$warehouse->getManagerName())
                    ->setData('link',$link)
                    ->setData('status',0)
                    ->save();
        }catch(Exception $e){
            
        }
       
        $logId = $model->getId();
        
        foreach($warehouseProducts as $warehouseProduct){
            try{
            Mage::getModel('inventorylowstock/notificationlog_product')->setData('product_id',$warehouseProduct->getProductId())
                                    ->setData('send_email_log_id',$logId)
                                    ->setData('qty_notify',$warehouseProduct->getTotalQty())
                                    ->setData('time_notify',date('Y-m-d H:i:s', $now))
                                    ->save();
            }catch(Exception $e){
               
            }
        }
    }
    
    public function sendSystemEmail($stockProducts) {
        $qty_notice = Mage::getStoreConfig('inventoryplus/notice/qty_notice',Mage::app()->getStore()->getStoreId());
        $str = 'qty%5Bto%5D=' . "$qty_notice";
        $filter = base64_encode($str);
        $link = Mage::helper('adminhtml')->getUrl('adminhtml/catalog_product/index', array('product_filter' => $filter,'uncheck_url_key' => true));
        $storeId = Mage::app()->getStore()->getId();
        $template = Mage::getStoreConfig(self::XML_PATH_SYSTEM_EMAIL, $storeId);
        $mailTemplate = Mage::getModel('core/email_template');
        $translate = Mage::getSingleton('core/translate');
        $from_email = Mage::getStoreConfig('trans_email/ident_general/email'); //fetch sender email Admin
        $from_name = Mage::getStoreConfig('trans_email/ident_general/name'); //fetch sender name Admin
        $sender = array('email' => $from_email, 'name' => $from_name);
        
        $adminEmails = Mage::getStoreConfig('inventoryplus/notice/admin_email',Mage::app()->getStore()->getStoreId());
        $adminEmails = str_replace(' ','',$adminEmails);
        if(!$adminEmails)
            return;
        $emails = explode(';',$adminEmails);
        
        
        if(!$emails[0]){
            return;
        }

        

        $receipientName = $this->__('Managers');
        $mailTemplate
            ->setTemplateSubject($this->__('Products of system are low'))
            ->sendTransactional(
                $template, $sender, $emails, $receipientName, array(
                'manager_name' => $receipientName,
                'qty_notice' => $qty_notice,
                'link' => $link
                )
        );
        $translate->setTranslateInline(true);
        
        $sendEmailLog = Mage::getModel('inventorylowstock/sendemaillog');
        $now = Mage::getModel('core/date')->timestamp(time());
        try{
            
            
            $model = $sendEmailLog->setData('sent_at',date('Y-m-d H:i:s', $now))
                    ->setData('type',$this->__('System'))
                    ->setData('email_received',$adminEmails)                    
                    ->setData('manager_name',$receipientName)
                    ->setData('link',$link)
                    ->setData('status',0)                    
                    ->save();
        }catch(Exception $e){
            
        }
        $logId = $model->getId();
        
       
        foreach($stockProducts as $stockProduct){
            try{
            Mage::getModel('inventorylowstock/notificationlog_product')->setData('product_id',$stockProduct->getProductId())
                                    ->setData('send_email_log_id',$logId)
                                    ->setData('qty_notify',$stockProduct->getQty())
                                    ->setData('time_notify',date('Y-m-d H:i:s', $now))
                                    ->save();
            }catch(Exception $e){
                
            }
        }
        
    }
    
    public function getTypeList(){
        $options = array();
       
                $options[$this->__('System')] = $this->__('System');
                $options[$this->__('Warehouse')] = $this->__('Warehouse');
            
       
        return $options;    
    }

}
