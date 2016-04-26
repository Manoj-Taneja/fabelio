<?php
require_once 'Mage/Adminhtml/controllers/Catalog/ProductController.php';

class Cminds_Supplierfrontendproductuploader_Override_Adminhtml_Catalog_ProductController extends Mage_Adminhtml_Catalog_ProductController
{
    public function saveAction()
    {
        $storeId        = $this->getRequest()->getParam('store');
        $redirectBack   = $this->getRequest()->getParam('back', false);
        $productId      = $this->getRequest()->getParam('id');
        $isSupplier     = $this->getRequest()->getParam('supplier', false);
        $isEdit         = (int)($this->getRequest()->getParam('id') != null);

        $data = $this->getRequest()->getPost();
        if ($data) {
            $this->_filterStockData($data['product']['stock_data']);

            $product = $this->_initProductSave();

            try {
                $product->save();
                $productId = $product->getId();

                if (isset($data['copy_to_stores'])) {
                   $this->_copyAttributesBetweenStores($data['copy_to_stores'], $product);
                }

                $this->_getSession()->addSuccess($this->__('The product has been saved.'));
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage())
                    ->setProductData($data);
                $redirectBack = true;
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            }
        }

        if ($redirectBack) {
            $this->_redirect('*/*/edit', array(
                'id'    => $productId,
                '_current'=>true
            ));
        } elseif($this->getRequest()->getParam('popup')) {
            $this->_redirect('*/*/created', array(
                '_current'   => true,
                'id'         => $productId,
                'edit'       => $isEdit
            ));
        } else {
    		if($isSupplier) {
    			$this->_redirect('adminhtml/supplier_product', array('store'=>$storeId));
    		} else {
	            $this->_redirect('*/*/', array('store'=>$storeId));
    		}
        }
    }

    public function deleteAction() {
    	$isSupplier     = $this->getRequest()->getParam('supplier', false);
        if ($id = $this->getRequest()->getParam('id')) {
            $product = Mage::getModel('catalog/product')
                ->load($id);
            $sku = $product->getSku();
            try {
                $product->delete();
                $this->_getSession()->addSuccess($this->__('The product has been deleted.'));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }

		if($isSupplier) {
			$this->getResponse()
        		->setRedirect($this->getUrl('adminhtml/supplier_product', array('store'=>$this->getRequest()->getParam('store'))));
		} else {
            $this->getResponse()
        		->setRedirect($this->getUrl('*/*/', array('store'=>$this->getRequest()->getParam('store'))));
		}

        
    }

    public function duplicateAction()
    {
    	$isSupplier     = $this->getRequest()->getParam('supplier', false);
        $product = $this->_initProduct();
        try {
            $newProduct = $product->duplicate();
            $this->_getSession()->addSuccess($this->__('The product has been duplicated.'));
			
			if($isSupplier) {
    			$this->_redirect('adminhtml/supplier_product', array('store'=>$this->getRequest()->getParam('store')));
    		} else {
	            $this->_redirect('*/*/', array('store'=>$this->getRequest()->getParam('store')));
    		}

            $this->_redirect('adminhtml/catalog_product/edit', array('_current'=>true, 'id'=>$newProduct->getId(), 'supplier' => true));
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
            
            if($isSupplier) {
    			$this->_redirect('adminhtml/supplier_product', array('store'=>$this->getRequest()->getParam('store')));
    		} else {
	            $this->_redirect('*/*/', array('store'=>$this->getRequest()->getParam('store')));
    		}
        }
    }
}