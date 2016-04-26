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
 * @package     Magestore_Inventory
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventory Resource Collection Model
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Model_Mysql4_Warehouse_Permission_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('inventoryplus/warehouse_permission');
    }
    
    public function joinAdminUser(){
        $resource = Mage::getSingleton('core/resource');
        $this->getSelect()
            ->joinLeft(array('admin_user'=>$resource->getTableName('admin/user')), 'main_table.admin_id = admin_user.user_id',array('username'=>'admin_user.username'))
        ;
        return $this;
    }
    /**
     * get admin id that can edit warehouse
     * @return array of admin id
     */
    public function getAllCanEditAdmins(){
        $idsSelect = clone $this->getSelect();
        $idsSelect->reset(Zend_Db_Select::ORDER);
        $idsSelect->reset(Zend_Db_Select::LIMIT_COUNT);
        $idsSelect->reset(Zend_Db_Select::LIMIT_OFFSET);
        $idsSelect->reset(Zend_Db_Select::COLUMNS);
        $idsSelect->where('main_table.can_edit_warehouse=?',1);
        $idsSelect->columns('main_table.admin_id');
        $idsSelect->resetJoinLeft();
        return $this->getConnection()->fetchCol($idsSelect);
    }
    
    /**
     * get admin id that can adjust stock of warehouse
     * @return array of admin id
     */
    public function getAllCanAdjustAdmins(){
        $idsSelect = clone $this->getSelect();
        $idsSelect->reset(Zend_Db_Select::ORDER);
        $idsSelect->reset(Zend_Db_Select::LIMIT_COUNT);
        $idsSelect->reset(Zend_Db_Select::LIMIT_OFFSET);
        $idsSelect->reset(Zend_Db_Select::COLUMNS);
        $idsSelect->where('main_table.can_adjust=?',1);
        $idsSelect->columns('main_table.admin_id');
        $idsSelect->resetJoinLeft();
        return $this->getConnection()->fetchCol($idsSelect);
    }   
    
    /**
     * get admin id that can send/request stock of warehouse
     * @return array of admin id
     */
    public function getAllCanSendRequestAdmins(){
        $idsSelect = clone $this->getSelect();
        $idsSelect->reset(Zend_Db_Select::ORDER);
        $idsSelect->reset(Zend_Db_Select::LIMIT_COUNT);
        $idsSelect->reset(Zend_Db_Select::LIMIT_OFFSET);
        $idsSelect->reset(Zend_Db_Select::COLUMNS);
        $idsSelect->where('main_table.can_send_request_stock=?',1);
        $idsSelect->columns('main_table.admin_id');
        $idsSelect->resetJoinLeft();
        return $this->getConnection()->fetchCol($idsSelect);
    }  
}