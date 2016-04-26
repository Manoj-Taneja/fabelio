<?php
    class Magestore_Inventoryplus_Block_Adminhtml_Warehouse_Renderer_Action
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $warehouseId = $row->getId();
        $adminId = Mage::getModel('admin/session')->getUser()->getId();
        $canEdit = 0;
        $assignment = Mage::getModel('inventoryplus/warehouse_permission')->getCollection()
                                    ->addFieldToFilter('warehouse_id',$warehouseId)
                                    ->addFieldToFilter('admin_id',$adminId)
                                    ->addFieldToFilter('can_edit_warehouse',1)
                                    ->getFirstItem();
        if($assignment->getId())
            $canEdit = 1;
        if($canEdit == 1){
            $html = '<a href="'.$this->getUrl('inventoryplusadmin/adminhtml_warehouse/edit',array('id'=>$warehouseId)).'">'.Mage::helper('inventoryplus')->__('Edit').'</a>';
        }else{
            $html = '<a href="'.$this->getUrl('inventoryplusadmin/adminhtml_warehouse/edit',array('id'=>$warehouseId)).'">'.Mage::helper('inventoryplus')->__('View').'</a>';
        }
        return $html;
    }
}

