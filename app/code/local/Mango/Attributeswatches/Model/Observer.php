<?php
class Mango_Attributeswatches_Model_Observer {
    /**
     * Apply after style section is saved....
     */
    public function makeAttributeVisible(Varien_Event_Observer $observer) {
        $section = Mage::app()->getRequest()->getParam('section');
        if ($section == 'attributeswatches') {
            //SELECT * FROM eav_attribute WHERE attribute_code = 'hover_image'
            $_resource = Mage::getSingleton('core/resource');
            $_catalog_eav_attribute_table = $_resource->getTableName("catalog/eav_attribute");
            $_eav_attribute_table = $_resource->getTableName("eav/attribute");
            //Mage::log(Mage::app()->getRequest());
            
            $_values = Mage::app()->getRequest()->getParam('groups');
            
            
            if(isset($_values['productlist']['fields']['alternate_image_source']['value'])){
                $_field = trim( $_values['productlist']['fields']['alternate_image_source']['value'] );
            }
            if ($_field) {
                $query = "UPDATE ". $_eav_attribute_table ." ea 
                INNER JOIN ". $_catalog_eav_attribute_table ." cea 
                ON ea.attribute_id = cea.attribute_id 
                SET used_in_product_listing = 1 
                WHERE attribute_code =  :attribute_code;";
                $connection = $_resource->getConnection('core_write');
                $connection->beginTransaction();
                $connection->query($query, array("attribute_code"=>$_field));
                $connection->commit();
            }
        }
    }
    
    
    public function swatchesForLayeredNavigationFilter(Varien_Event_Observer $observer){
        
        $block = $observer->getBlock();
        if ($block instanceof Mage_Catalog_Block_Layer_View){
            $_attributes_with_swatches = Mage::getStoreConfig("attributeswatches/layerednavigation/attributes") . "," . Mage::getStoreConfig("attributeswatches/layerednavigation/hidelabel");
            $_attributes_with_swatches = array_unique(explode(",", $_attributes_with_swatches));
            foreach($_attributes_with_swatches as $_attribute){
                if($block->getChild( $_attribute . '_filter'))
                $block->getChild( $_attribute .  '_filter')->setTemplate("attributeswatches/catalog_layer_filter_swatches.phtml");
                
            }
        }
        return;
    }
    
}
