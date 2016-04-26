<?php

class Cminds_Marketplace_SupplierController extends Cminds_Marketplace_Controller_Action {
    
    public function viewAction() {
        $id = $this->getRequest()->getParam('id');

        if(!Mage::getStoreConfig('marketplace_configuration/presentation/supplier_page_enabled')) {
			$this->force404();
    		return;
        }

        $customer = Mage::getModel('customer/customer')->load($id);

        if(!$customer->getSupplierProfileVisible()) {
            $this->force404();
            return;
        }

        if(!$customer->getSupplierProfileApproved()) {
    		$this->force404();
    		return;
        }

        Mage::register('customer', $customer);

        $this->loadLayout();
        $this->renderLayout();
    }

    public function ratelistAction() {
        $request = $this->getRequest();
        
        if($request->isPost()) {
            $transaction = Mage::getSingleton('core/resource')->getConnection('core_write');
            $postData = $request->getPost();

            try {
                $transaction->beginTransaction();

                foreach($postData['ratings'] AS $supplier_id => $rate) {
                $loggedCustomer = Mage::getModel('customer/customer')->load(Mage::getSingleton('customer/session')->getId());

                $collection = Mage::getModel('marketplace/torate')
                    ->getCollection()
                    ->addFieldToFilter('main_table.customer_id', $loggedCustomer->getId());

                foreach($collection AS $item) {
                    $item->delete();
                }

                Mage::getModel('marketplace/rating')
                    ->setSupplierId($supplier_id)
                    ->setCustomerId($loggedCustomer->getId())
                    ->setRate($rate)
                    ->setCreatedOn(date('Y-m-d H:i:s'))
                    ->save();
                }

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollback();
            }
        }

        $this->loadLayout();
        $this->getLayout()->getBlock('head')->addCss('css/marketplace/rate.css');
        $this->renderLayout();
    }

    public function ratesAction() {
        $request = $this->getRequest();

        if($request->isPost()) {
            $transaction = Mage::getModel('core/resource_transaction');
            $postData = $request->getPost();

            try {
                foreach($postData['ratings'] AS $rate_id => $rate) {
                    $rating = Mage::getModel('marketplace/rating')->load($rate_id);

                    if($rating->getCustomerId() == Mage::getSingleton('customer/session')->getId()) {
                        $rating->setRate($rate);
                    } else {
                        throw new Exception('You can not change rating which does not belongs to you');
                    }

                    $transaction->addObject($rating);
                }
                $transaction->save();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__("Rating has been changed"));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__($e->getMessage()));
            }
        }

        $this->loadLayout();
        $this->getLayout()->getBlock('head')->addCss('css/marketplace/rate.css');
        $this->renderLayout();
    }
}
