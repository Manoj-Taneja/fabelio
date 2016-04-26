<?php 
class Magestore_Inventorylowstock_Block_Adminhtml_Notificationlog_Renderer_Link
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {        
        $html = '<a href="'.$row->getLink().'" target="_blank">'.$row->getLink().'</a>';
        return $html;
    }
}