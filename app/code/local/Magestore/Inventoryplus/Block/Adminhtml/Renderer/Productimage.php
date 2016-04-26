<?php
    class Magestore_Inventoryplus_Block_Adminhtml_Renderer_Productimage
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract{
        public function render(Varien_Object $row) 
        {
            if($row->getEntityId()){
                $id  = $row->getEntityId();
            }else{
                $id  = $row->getProductId();
            }
            $html = '';
            $_product = Mage::getModel('catalog/product')->load($id);
            try{
                $src1 = Mage::helper('catalog/image')->init($_product, 'small_image')->resize(90);
                $html .= '<img src="'.$src1->__toString().'" />';
            }catch(Exception $e){
                
            }
            return $html;
        }
    }
?>
