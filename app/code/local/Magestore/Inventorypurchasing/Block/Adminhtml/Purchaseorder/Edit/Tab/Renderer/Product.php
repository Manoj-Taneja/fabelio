<?php 

class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Edit_Tab_Renderer_Product
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) 
    {
        $productId = $row->getProductId();  
        $product = Mage::getModel('catalog/product')->load($productId);        
        if(!$product->getId()){
            return $row->getProductName().'<br/><p class="item-msg error">* This product is not in stock!</p>';
        }else{
            return parent::render($row);
        }
    }
}