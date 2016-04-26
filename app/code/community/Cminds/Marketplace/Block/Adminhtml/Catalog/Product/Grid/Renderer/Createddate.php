<?php
class Cminds_Marketplace_Block_Adminhtml_Catalog_Product_Grid_Renderer_Createddate extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }
    protected function _getValue(Varien_Object $row)
    {
        $date = $row->getCreatedAt();
        $datetime = new DateTime($date);
        return $datetime->format('m/d/Y H:i:s');
    }
}
