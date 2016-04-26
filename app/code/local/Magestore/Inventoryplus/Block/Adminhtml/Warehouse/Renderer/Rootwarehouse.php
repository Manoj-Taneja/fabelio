<?php
    class Magestore_Inventoryplus_Block_Adminhtml_Warehouse_Renderer_Rootwarehouse extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $html = '';
        $isRoot = $row->getIsRoot();
        
        if($isRoot){
            $html .= '<div style="text-transform: uppercase;font:bold 10px/16px Arial, Helvetica, sans-serif;background-color:#3CB861;color:#fff;width:100%;height:100%"> '.$this->__('yes').' </div>';
        } else {
            $html .= '<div style="text-transform: uppercase;font:bold 10px/16px Arial, Helvetica, sans-serif;background-color:#E41101;color:#fff;width:100%;height:100%"> '.$this->__('no').' </div>';
        }
        return $html;
    }
}
?>
