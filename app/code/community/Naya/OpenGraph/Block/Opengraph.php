<?php
class Naya_OpenGraph_Block_Opengraph extends Mage_Core_Block_Template
{
    public function getAppId(){
        return Mage::getStoreConfig('naya_opengraph/general/site_id');
    }
    
    public function getAdminId(){
        return Mage::getStoreConfig('naya_opengraph/general/admin_id');
    }
}