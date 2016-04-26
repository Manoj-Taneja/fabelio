<?php 
$installer = $this;
$installer->startSetup();
$resource = Mage::getModel('core/resource');

$installer->run("
     ALTER TABLE {$resource->getTableName('inventoryplus/warehouse')} 
         ADD `is_root` tinyint(1) NOT NULL DEFAULT '0';
     ALTER TABLE {$resource->getTableName('inventoryplus/warehouse')} 
         ADD `manager` varchar(255) NOT NULL;
     ALTER TABLE ".$resource->getTableName('erp_inventory_checkupdate')."
        ADD `is_insert_data` smallint(6) NOT NULL DEFAULT '0';    
");
     
//set permission for created user
foreach(Mage::getModel('inventoryplus/warehouse')
        ->getCollection() as $warehouse){
    $createdBy = $warehouse->getCreatedBy();
    $userId = Mage::getModel('admin/user')->loadByUsername($createdBy)->getUserId();
    $permissionCollection = Mage::getModel('inventoryplus/warehouse_permission')
            ->getCollection()
            ->addFieldToFilter('warehouse_id',$warehouse->getWarehouseId())
            ->addFieldToFilter('admin_id',$userId);
    if(count($permissionCollection) > 0){
        $permission = $permissionCollection->getFirstItem();
        $permission->setData('can_edit_warehouse', 1)
                ->setData('can_adjust', 1)
                ->setData('can_physical', 1)    
                ->setData('can_send_request_stock', 1)
                ->save()
                ;
    } else {
        Mage::getModel('inventoryplus/warehouse_permission')
                ->setData('warehouse_id', $warehouse->getWarehouseId())
                ->setData('admin_id', $userId)
                ->setData('can_edit_warehouse', 1)
                ->setData('can_adjust', 1)
                ->setData('can_physical', 1)    
                ->setData('can_send_request_stock', 1)
                ->save()
            ;
    }
}
//set root warehouse
Mage::getModel('inventoryplus/warehouse')
        ->getCollection()
        ->getFirstItem()
        ->setIsRoot(1)
        ->save();
$installer->endSetup();