<?php
class Cminds_Supplierfrontendproductuploader_Block_Navbar extends Mage_Core_Block_Template {
	private $_markedProductIds = null;

	public function getMarkedProductCount() {
		if($this->_markedProductIds == NULL) {
			$this->_markedProductIds = $this->getMarkedProduct();
		}

		return count($this->_markedProductIds);
	}

	public function hasMarkedProducts() {
		return ($this->getMarkedProductCount() > 0);
	}

	public function getMarkedProduct() {
		$count = array();

		$collection = Mage::getModel('catalog/product')
		->getCollection()
		->addAttributeToSelect('creator_id')
		->addAttributeToFilter(array(array('attribute' => 'creator_id', 'eq' => Mage::helper('supplierfrontendproductuploader')->getSupplierId())));

		foreach($collection AS $product) {
			$count[] = $product->getId();
		}

		return $count;
	}		
}