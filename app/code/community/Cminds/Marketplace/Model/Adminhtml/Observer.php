<?php
class Cminds_Marketplace_Model_Adminhtml_Observer {
    public function onCustomerSave($observer) {
        $request = $observer->getRequest();
        $customer = $observer->getCustomer();
        $postData = $request->getPost();

        if(!Mage::helper('marketplace')->isSupplier($customer->getId())) {
            return false;
        }

        try {

            if(isset($postData['all_categories_ids']) && is_array($postData['all_categories_ids'])) {
                $supplierId = $customer->getId();
                foreach($postData['all_categories_ids'] AS $category) {
                    Mage::getModel('marketplace/categories')
                        ->getCollection()
                            ->addFilter('supplier_id', $supplierId)
                            ->addFilter('category_id', $category)
                            ->getFirstItem()
                            ->delete();

                    if(!is_array($postData['categories_ids']) || (is_array($postData['categories_ids']) && !in_array($category, $postData['categories_ids']))) {
                        Mage::getModel('marketplace/categories')
                            ->setData('supplier_id', $supplierId)
                            ->setData('category_id', $category)
                            ->save();
                    }
                }
            }

            $transaction = Mage::getModel('core/resource_transaction');
            $shipping = Mage::getModel('marketplace/methods')->load($customer->getId(), 'supplier_id');

            $shipping->setSupplierId($customer->getId());
            $shipping->setFlatRateFee(0);
            $shipping->setFlatRateAvailable(0);
            $shipping->setTableRateAvailable(0);
            $shipping->setTableRateCondition(0);
            $shipping->setTableRateFee(0);
            $shipping->setFreeShipping(0);

            if(isset($postData['flatrate_enabled']) && $postData['flatrate_enabled'] == 1) {
                $shipping->setFlatRateAvailable(1);
                $shipping->setFlatRateFee($postData['flatrate_fee']);
            } else {
                $shipping->setFlatRateFee(0);
                $shipping->setFlatRateAvailable(0);
            }
            if(isset($postData['tablerate_enabled']) && $postData['tablerate_enabled'] == "1") {
                $shipping->setTableRateAvailable(1);
                $shipping->setTableRateFee($postData['tablerate_fee']);
                $shipping->setTableRateCondition($postData['tablerate_condition']);
                $this->_parseUploadedCsv($customer->getId());
            } else {
                $shipping->setTableRateFee(0);
                $shipping->setTableRateAvailable(0);
            }
            if(isset($postData['freeshipping_enabled']) && $postData['freeshipping_enabled'] == 1) {
                $shipping->setFreeShipping(1);
            } else {
                $shipping->setFreeShipping(0);
            }
            $transaction->addObject($shipping);
            $approved = false;

            if(isset($postData['supplier_name'])) {
                if($postData['supplier_profile_approved'] == 1) {

                    $newCustomFieldsValues =  $this->_prepareCustomFieldsValues($postData);

                    if($customer->getData('supplier_name') != $postData['supplier_name_new'] ||
                        $customer->getData('supplier_description') != $postData['supplier_description_new'] ||
                        (count($newCustomFieldsValues) > 0 && serialize($newCustomFieldsValues) != $customer->getCustomFieldsValues())
                    ) {
                        $approved = true;
                        $customer->setData('supplier_remark', NULL);

                        $postData['supplier_name'] =  $postData['supplier_name_new'];
                        $postData['supplier_description'] =  $postData['supplier_description_new'];
                        
                        $customer->setData('supplier_name_new', '');
                        $customer->setData('supplier_description_new', '');
                        $customer->setCustomFieldsValues(serialize($newCustomFieldsValues));
                        $customer->setNewCustomFieldsValues(NULL);
                    }
                } else {
                    $customer->setData('supplier_remark', $postData['supplier_remark']);
                    $customer->setData('rejected_notfication_seen', 0);
                }
                
                $customer->setData('supplier_name', htmlentities($postData['supplier_name'], ENT_QUOTES, "UTF-8"));
                $customer->setData('supplier_description', $postData['supplier_description']);
                $customer->setData('supplier_profile_visible', $postData['supplier_profile_visible']);
                $customer->setData('supplier_profile_approved', $postData['supplier_profile_approved']);

                if($customer->getData('rejected_notfication_seen') == 1 && $postData['supplier_profile_approved'] == 0) {
                    $customer->setData('rejected_notfication_seen', 0);
                } elseif($postData['supplier_profile_approved'] == 1) {
                    $customer->setData('rejected_notfication_seen', 1);     
                }
            }

            $transaction->addObject($customer);

            $transaction->save();

            if($approved) {
                Mage::helper('marketplace/email')->notifySupplier($customer);
            }
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getBaseUrl() . 'marketplace/settings/shipping/');
        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getBaseUrl() . 'marketplace/settings/shipping/');
            Mage::log($e->getMessage());
        }
    }
    public function onAttributeSetSave($observer) {
        $attributeSet = $observer->getObject();
        $postData = Mage::app()->getRequest()->getPost();
        if(is_array($postData)) {
            $data = (object) $postData;
        } else {
            $data = json_decode($postData['data']);
        }

        if(isset($data->data)) {
            $data = json_decode($data->data);
        }

        $attributeSet->setData('available_for_supplier', $data->available_for_supplier);
    }

    private function _parseUploadedCsv($supplier_id) {
        $changed = false;
        $parsedData = array();
        if (isset($_FILES["tablerate_file"])) {
            $changed = true;
            if(file_exists($_FILES["tablerate_file"]["tmp_name"])) {
                if (($handle = fopen($_FILES["tablerate_file"]["tmp_name"], "r")) !== FALSE) {
                    while (($row = fgetcsv($handle)) !== FALSE) {
                        $parsedData[] = $row;
                    }
                    fclose($handle);
                } else {
                    throw new ErrorException('Cannot handle uploaded CSV');
                }
            }
            if(count($parsedData) < 1) return;
            if($parsedData[0][0] == 'Country') {
                unset($parsedData[0]);
            }

            $supplierRate = Mage::getModel("marketplace/rates")
                ->load($supplier_id, 'supplier_id');

            if(!$supplierRate->getId()) {
                $supplierRate->setSupplierId($supplier_id);
            }

            $supplierRate->setRateData(serialize($parsedData));
            $supplierRate->save();
        }
    }

    private function _prepareCustomFieldsValues($postData) {
        $customFieldsCollection = Mage::getModel('marketplace/fields')->getCollection();

        $customFieldsValues = array();

        foreach($customFieldsCollection AS $field) {
            if(isset($postData[$field->getName().'_new'])) {
                if($field->getIsRequired() && $postData[$field->getName().'_new'] == '') {
                    throw new Exception("Field ".$field->getName()." is required");
                }

                if($field->getType() == 'date' && !strtotime($postData[$field->getName().'_new'])) {
                    throw new Exception("Field ".$field->getName()." is not valid date");
                }

                $customFieldsValues[] = array('name' => $field->getName(), 'value' => $postData[$field->getName().'_new']);
            }
        }
        return $customFieldsValues;

    }
}