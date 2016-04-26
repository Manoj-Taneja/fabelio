<?php
    class Magestore_Inventoryplus_Block_Adminhtml_Adjuststock_Listadjuststock_Renderer_Action
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $html = '';
        $permission = Mage::helper('inventoryplus')->getPermission($row->getWarehouseId(),'can_adjust');
        if($row->getAdjustStatus() ==  0){
            $html = '<a href="'.$this->getUrl('inventoryplusadmin/adminhtml_adjuststock/edit',array('id'=>$row->getId())).'">'.Mage::helper('inventoryplus')->__('Edit').'</a>';
        } else {
            $html = '<a href="'.$this->getUrl('inventoryplusadmin/adminhtml_adjuststock/edit',array('id'=>$row->getId())).'">'.Mage::helper('inventoryplus')->__('View').'</a>';
        }
        return $html;
    }
}