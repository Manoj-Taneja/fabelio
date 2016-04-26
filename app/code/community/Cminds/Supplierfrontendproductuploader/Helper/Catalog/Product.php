<?php
class Cminds_Supplierfrontendproductuploader_Helper_Catalog_Product extends Mage_Catalog_Helper_Product {
    /*public function canShow($product, $where = 'catalog')
    {
        if (is_int($product)) {
            $product = Mage::getModel('catalog/product')->load($product);
        }

        if (!$product->getId()) {
            return false;
        }

        $ret = $product->isVisibleInCatalog() && $product->isVisibleInSiteVisibility();


        if(!$ret) {
            $oldRet = $ret;
            $ret = ($product->getData('creator_id') == Mage::helper('supplierfrontendproductuploader')->getSupplierId());
            if($ret && !$oldRet) {
                Mage::getSingleton('core/session')->addError($this->__('This is preview mode !'));
            }   
        } else {
            if($product->getData('creator_id') && $product->getFrontendproductProductStatus() == 0) {
                $ret = false;

                $ret = ($product->getData('creator_id') === Mage::helper('supplierfrontendproductuploader')->getSupplierId());

                if($ret) {
                    Mage::getSingleton('core/session')->addError($this->__('This is preview mode !'));
                }
            }
        }

        return $ret;
    }*/
}
