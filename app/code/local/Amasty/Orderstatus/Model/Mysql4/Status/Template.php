<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Model_Mysql4_Status_Template extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('amorderstatus/status_template', 'entity_id');
    }
    
    public function removeStatusTemplates($statusId)
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
        $sql = 'DELETE FROM `' . $this->getTable('amorderstatus/status_template') . '` WHERE `status_id` = "' . $statusId . '" ' ;
        $connection->query($sql);
    }
    
    public function loadTemplateId($statusId, $storeId)
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        $sql = 'SELECT template_id FROM `' . $this->getTable('amorderstatus/status_template') . '` WHERE `status_id` = "' . $statusId . '" AND `store_id` = "' . $storeId . '" ' ;
        return $connection->fetchOne($sql);
    }
}