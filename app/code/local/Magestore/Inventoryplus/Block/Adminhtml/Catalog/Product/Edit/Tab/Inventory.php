<?php
class  Magestore_Inventoryplus_Block_Adminhtml_Catalog_Product_Edit_Tab_Inventory extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Inventory
{
    public function __construct()
    {
        parent::__construct();        
        if($this->getRequest()->getParam('id')){
            $product = Mage::getModel('catalog/product')->load($this->getRequest()->getParam('id'));
            if(in_array($product->getTypeId(),array('configurable', 'bundle', 'grouped')))
                return;
        }else{
            $productType = $this->getRequest()->getParam('type');
            if(in_array($productType,array('configurable', 'bundle', 'grouped')))
                return;
        }
        $this->setTemplate('inventoryplus/catalog/product/tab/inventory.phtml');
    }
}
	

