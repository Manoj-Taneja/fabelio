<?php

class Cminds_Marketplace_Block_Adminhtml_Supplier_List_Renderer_Waiting
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $waiting = $row->getData('rejected_notfication_seen');

        return $waiting == 2 ? "<span style='color:red;'>".$this->__('Yes')."</span>" : $this->__('No');
    }
}

?>