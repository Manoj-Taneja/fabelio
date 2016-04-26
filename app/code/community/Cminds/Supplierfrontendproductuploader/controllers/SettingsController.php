<?php

class Cminds_Supplierfrontendproductuploader_SettingsController extends Cminds_Supplierfrontendproductuploader_Controller_Action {
    public function preDispatch() {
        parent::preDispatch();
//        $this->_getHelper()->validateModule();
        $hasAccess = $this->_getHelper()->hasAccess();

        if(!$hasAccess) {
            $this->getResponse()->setRedirect(Mage::helper('customer')->getLoginUrl());
        }
    }
    public function notificationsAction() {
        $this->_renderBlocks();
    }

    public function saveNotificationSettingsAction() {
        $postData = $this->getRequest()->getPost();

        try {
            $loggedUser = Mage::getSingleton( 'customer/session', array('name' => 'frontend') );
            $customer = Mage::getModel('customer/customer')->load($loggedUser->getCustomer()->getEntityId());
            if(isset($postData['send_notification_after_product_purchased']) && $postData['send_notification_after_product_purchased'] == 1) {
                $customer->setData('notification_product_ordered', 1);
            } else {
                $customer->setData('notification_product_ordered', 0);
            }
            if(isset($postData['send_notification_when_product_approved']) && $postData['send_notification_when_product_approved'] == 1) {
                $customer->setData('notification_product_approved', 1);
            } else {
                $customer->setData('notification_product_approved', 0);
            }

            $customer->save();
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('*/*/notifications/'));
        } catch (Exception $e) {

            Mage::getSingleton('core/session')->addError($e->getMessage());
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('*/*/notifications/'));
            Mage::log($e->getMessage());
        }
    }

    private function _parseUploadedCsv() {
        $changed = false;
        $parsedData = array();

        if (isset($_FILES["table_rate_file"])) {
            $changed = true;
            if(file_exists($_FILES["table_rate_file"]["name"])) {
                if (($handle = fopen($_FILES["table_rate_file"]["name"], "r")) !== FALSE) {
                    while (($row = fgetcsv($handle)) !== FALSE)
                    {
                        $parsedData[] = $row;
                    }
                    fclose($handle);
                } else {
                    throw new ErrorException('Cannot handle uploaded CSV');
                }
            }
        }

        if($parsedData[0][0] == 'Country') {
            unset($parsedData[0]);
        }

        if($changed) {
            $supplierRate = Mage::getModel("marketplace/rates")
                ->load(Mage::helper('marketplace')->getSupplierId(), 'supplier_id');

            if(!$supplierRate->getId()) {
                $supplierRate->setSupplierId(Mage::helper('marketplace')->getSupplierId());
            }

            $supplierRate->setRateData(serialize($parsedData));
            $supplierRate->save();
        }
    }
}
