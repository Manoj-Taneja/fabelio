<?php

class Cminds_Marketplace_SettingsController extends Cminds_Marketplace_Controller_Action {
    public function preDispatch() {
        parent::preDispatch();
        $hasAccess = $this->_getHelper()->hasAccess();

        if(!$hasAccess) {
            $this->getResponse()->setRedirect($this->_getHelper('supplierfrontendproductuploader')->getSupplierLoginPage());
        }
    }
    public function shippingAction() {
        if(!Mage::getStoreConfig('marketplace_configuration/presentation/change_shipping_costs')) {
            $this->getResponse()->setHeader('HTTP/1.1','404 Not Found');
            $this->getResponse()->setHeader('Status','404 File not found');
            $this->_forward('defaultNoRoute');
        }

        $this->_renderBlocks();
    }

    public function shippingSaveAction() {
        $postData = $this->getRequest()->getPost();

        if(!Mage::getStoreConfig('marketplace_configuration/presentation/change_shipping_costs')) {
            $this->getResponse()->setHeader('HTTP/1.1','404 Not Found');
            $this->getResponse()->setHeader('Status','404 File not found');
            $this->_forward('defaultNoRoute');
        }

        try {
            $transaction = Mage::getModel('core/resource_transaction');
            $shipping = Mage::getModel('marketplace/methods')->load(Mage::helper('marketplace')->getSupplierId(), 'supplier_id');

            $shipping->setSupplierId(Mage::helper('marketplace')->getSupplierId());
            $shipping->setFlatRateFee(0);
            $shipping->setFlatRateAvailable(0);
            $shipping->setTableRateAvailable(0);
            $shipping->setTableRateCondition(0);
            $shipping->setTableRateFee(0);
            $shipping->setFreeShipping(0);

            if(isset($postData['shipping_method']) && $postData['shipping_method'] == "flat_rate") {
                $shipping->setFlatRateAvailable(1);
                $shipping->setFlatRateFee($postData['flat_rate_fee']);
            } else {
                $shipping->setFlatRateFee(0);
                $shipping->setFlatRateAvailable(0);
            }
            if(isset($postData['shipping_method']) && $postData['shipping_method'] == "table_rate") {
                $shipping->setTableRateAvailable(1);
                $shipping->setTableRateFee($postData['table_rate_fee']);
                $shipping->setTableRateCondition($postData['table_rate_condition']);
                $this->_parseUploadedCsv();
            } else {
                $shipping->setTableRateFee(0);
                $shipping->setTableRateAvailable(0);
            }
            if(isset($postData['shipping_method']) && $postData['shipping_method'] == "free_shipping") {
                $shipping->setFreeShipping(1);
            } else {
                $shipping->setFreeShipping(0);
            }
            $transaction->addObject($shipping);
            $transaction->save();

            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getBaseUrl() . 'marketplace/settings/shipping/');
        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getBaseUrl() . 'marketplace/settings/shipping/');
            Mage::log($e->getMessage());
        }
    }

    public function profileAction() {
        if(!Mage::getStoreConfig('marketplace_configuration/presentation/supplier_page_enabled')) {
            $this->getResponse()->setHeader('HTTP/1.1','404 Not Found');
            $this->getResponse()->setHeader('Status','404 File not found');
            $this->_forward('defaultNoRoute');
        }

        $this->_renderBlocks(true, true);
    }

    public function profileSaveAction() {
        $postData = $this->getRequest()->getPost();

        if(!Mage::getStoreConfig('marketplace_configuration/presentation/supplier_page_enabled')) {
            $this->getResponse()->setHeader('HTTP/1.1','404 Not Found');
            $this->getResponse()->setHeader('Status','404 File not found');
            $this->_forward('defaultNoRoute');
        }

        try {
            $transaction = Mage::getModel('core/resource_transaction');
            $customerData = false;
            
            if(Mage::getSingleton('customer/session')->isLoggedIn()) {
                $customerData = Mage::getModel('customer/customer')->load(Mage::getSingleton('customer/session')->getId());
            }

            if(!$customerData) {
                throw new ErrorException('Supplier does not exists');
            }

            $waitingForApproval = false;

            if(isset($postData['submit'])) {
                $changed = false;
                $forceChange = false;

                if(htmlentities($postData['name'], ENT_QUOTES, "UTF-8") != $customerData->getSupplierName()) {
                    $changed = true;
                    $forceChange = true;
                    $customerData->setSupplierNameNew(htmlentities($postData['name'], ENT_QUOTES, "UTF-8"));
                }

                if(strip_tags($postData['description'], '<ol><li><b><span><a><i><u><p><br><h1><h2><h3><h4><h5><div>') != $customerData->getSupplierDescription() || $forceChange) {
                    $customerData->setSupplierDescriptionNew(strip_tags($postData['description'], '<ol><li><b><span><a><i><u><p><br><h1><h2><h3><h4><h5><div>'));

                    if(!$changed) {
                        $customerData->setSupplierNameNew(htmlentities($postData['name'], ENT_QUOTES, "UTF-8"));
                    }

                    $changed = true;
                }

                if(isset($postData['profile_enabled'])) {
                    $customerData->setSupplierProfileVisible(1);
                } else {
                    $customerData->setSupplierProfileVisible(0);
                }

                if($customerData->hasDataChanges() && $changed) {
                    $customerData->setData('rejected_notfication_seen', 2);
                    $waitingForApproval = true;

                }

                $customFieldsCollection = Mage::getModel('marketplace/fields')->getCollection();
                $customFieldsValues = array();
                $oldCustomFieldsValues = unserialize($customerData->getCustomFieldsValues());

                foreach($customFieldsCollection AS $field) {
                    if(isset($postData[$field->getName()])) {
                        if($field->getIsRequired() && $postData[$field->getName()] == '') {
                            throw new Exception("Field ".$field->getName()." is required");
                        }
                        
                        if($field->getType() == 'date' && !strtotime($postData[$field->getName()])) {
                            throw new Exception("Field ".$field->getName()." is not valid date");
                        }

                        $oldValue = $this->_findValue($field->getName(), $oldCustomFieldsValues);

                        if($oldValue != $postData[$field->getName()] && $field->getMustBeApproved()) { 
                            $waitingForApproval = true;
                        }

                        $customFieldsValues[] = array('name' => $field->getName(), 'value' => $postData[$field->getName()]);
                    }
                }

                if($waitingForApproval) {
                    $customerData->setNewCustomFieldsValues(serialize($customFieldsValues));
                } else {
                    $customerData->setCustomFieldsValues(serialize($customFieldsValues));
                }
            
            } elseif(isset($postData['clear'])) {
                $customerData->setSupplierNameNew(null);
                $customerData->setSupplierDescriptionNew(null);
                $customerData->setNewCustomFieldsValues(null);
            }

            $transaction->addObject($customerData);
            $transaction->save();
    
            if($waitingForApproval) {   
                Mage::helper('marketplace/email')->notifyAdminOnProfileChange($customerData); 
                Mage::getSingleton('core/session')->addSuccess($this->_getHelper()->__('Profile was changed and waiting for admin approval'));
            } else {
                Mage::getSingleton('core/session')->addSuccess($this->_getHelper()->__('Your profile was changed'));
            }

            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getBaseUrl() . 'marketplace/settings/profile/');
        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getBaseUrl() . 'marketplace/settings/profile/');
            Mage::log($e->getMessage());
        }
    }

    private function _parseUploadedCsv() {
        $changed = false;
        $parsedData = array();
        if (isset($_FILES["table_rate_file"])) {
            $changed = true;
            if(file_exists($_FILES["table_rate_file"]["tmp_name"])) {
                if (($handle = fopen($_FILES["table_rate_file"]["tmp_name"], "r")) !== FALSE) {
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

    private function _findValue($name, $data) {
        if(!is_array($data)) return false;
        
        foreach($data AS $value) {
            if($value['name'] == $name) {
                return $value['value'];
            }
        }

        return false;
    }
}
