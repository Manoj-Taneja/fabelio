<?php
class Fabmod_Feed_Model_Feed extends Mage_Core_Model_Abstract {

  private $_productCollection = null;
  private function getProductCollection($limit = null){
    if(!$this->_productCollection){
      $this->_productCollection = Mage::getModel('catalog/product')->getCollection();
      $this->_productCollection->addAttributeToSelect('*')
        //->setPageSize(5)
        ->addAttributeToFilter('visibility', 4)
        ->addAttributeToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
        ->setOrder('created_at', 'desc');
      if($limit){
        $this->_productCollection->setPageSize($limit);
      }
    }
    return $this->_productCollection;
  }

  public function getProducts(){
    return $this->getProductCollection();
  }
}
