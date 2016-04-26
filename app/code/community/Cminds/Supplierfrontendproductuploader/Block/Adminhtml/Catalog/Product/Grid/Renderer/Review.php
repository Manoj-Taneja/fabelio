<?php
class Cminds_Supplierfrontendproductuploader_Block_Adminhtml_Catalog_Product_Grid_Renderer_Review extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }
    protected function _getValue(Varien_Object $row)
    {
        $p = Mage::getModel('catalog/product')->load($row->getEntityId());
        
        if($p->getData('supplier_price_change') == 1) {
            $label = $this->__('Accept');
            $str = '<a href="' .  $this->getUrl('*/*/review', array('id' => $row->getEntityId())) . '">'.$label.'</a>';
        }

        return $str;
    }
}
