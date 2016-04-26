<?php

class Cminds_Marketplace_ImportController extends Cminds_Marketplace_Controller_Action {
    private $_setMainPhoto = false;
    private $_usedImagesPaths = array();

    public function preDispatch() {
        parent::preDispatch();
        $hasAccess = $this->_getHelper()->hasAccess();

        if(!$hasAccess) {
            $this->getResponse()->setRedirect($this->_getHelper('supplierfrontendproductuploader')->getSupplierLoginPage());
        }
    }
    public function indexAction() {
        $this->_renderBlocks();
    }
    public function productsAction() {
        if(Mage::getStoreConfig('marketplace_configuration/csv_import/csv_import_enabled') == 1) {
            $this->_handleUpload();
            $this->_renderBlocks( false, false, true);
        } else {
            $this->force404();
        }
    }
    public function downloadProductCsvAction() {
        $avoidAttributes = array('created_at', 'updated_at', 'sku_type', 'price_type', 'weight_type', 'shipment_type', 'links_purchased_separately', 'links_title', 'price_view', 'url_key', 'url_path', 'creator_id', 'tax_class_id', 'visibility', 'status', 'admin_product_note', 'supplier_actived_product', 'frontendproduct_product_status', );
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=products_schema.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        $api = Mage::getModel('catalog/product_attribute_api');
        $attributes = $api->items(Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/attribute_set'));
        $attributesCollection = array();
        $attributesCollection[] = 'ID';
        foreach($attributes as $_attribute){
            if(in_array($_attribute['code'], $avoidAttributes)) continue;

            if($_attribute['code'] == 'sku') {
                if(!Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/can_define_sku') == 2) {
                    continue;
                }
            }

            if($_attribute['required'] == 1) {
                $str = trim($_attribute['code']);
                $str .= ($_attribute['required'] == 1) ? ' (*)' : '';

                $attributesCollection[] = '"'.$str.'"';
            } else {
                try {
                    $model = Mage::getResourceModel('catalog/eav_attribute')
                        ->setEntityTypeId(Mage::getModel('eav/entity')->setType('catalog_product')->getTypeId())
                        ->load($_attribute['code'], 'attribute_code');

                    if($model->getData('is_user_defined') && (strstr($model->getData('apply_to'), 'simple') || !$model->getData('apply_to'))) {
                        $str = trim($_attribute['code']);
                        $attributesCollection[] = '"'.$str.'"';
                    }
                } catch(Exception $e) {

                }
            }
        }
        $attributesCollection[] = '"category (*)"';
        $attributesCollection[] = '"qty (*)"';

        for($i = 0; $i < Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/images_count'); $i++) {
            $attributesCollection[] = '"image"';
        }

        echo implode(',', $attributesCollection);
    }

    private function _handleUpload() {
        if(isset($_FILES['file']['name']) && ($_FILES['file']['tmp_name'] != NULL)) {
             if(!$this->_validateSalt()) return false;

            $importResponse = array();
            $successCount = 0;
            $i = 0;
            $headers = array();
            if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
                if(is_int(Mage::getStoreConfig('marketplace_configuration/csv_import/product_limit')) &&
                    Mage::getStoreConfig('marketplace_configuration/csv_import/product_limit') > 0 &&
                    count(file($_FILES['file']['tmp_name'])) > Mage::getStoreConfig('marketplace_configuration/csv_import/product_limit')+1) {
                    Mage::getSingleton('core/session')->addError(Mage::helper('marketplace')->__("Too many products added to import."));
                } else {
                    while (($data = fgetcsv($handle)) !== FALSE) {
                        if($i != 0){
                            $res = $this->_parseCsv($data, $headers);
                            if($res['success']) {
                                $successCount++;
                            }
                            $res['line'] = $i;
                            $importResponse[] = $res;
                        } else {
                            $s = $this->validateHeaders($data);
                            if(count($s) > 0) {
                                Mage::getSingleton('core/session')->addError(Mage::helper('marketplace')->__("Attributes doesn't match all required attributes. Missing attribute : " . $s[0]));
                                break;
                            }
                            $headers = $data;
                        }
                        $i++;
                    }
                    fclose($handle);
                }
            }   
            Mage::register('import_data', $importResponse);
            $customer  = Mage::getModel('customer/customer')->load(Mage::helper('supplierfrontendproductuploader')->getSupplierId());

            $this->_getHelper('marketplace/email')->notifyAdminOnUploadingProducts($customer, $successCount);
        }
    }

    private function _parseCsv($line, $headers) {
        try {
            $this->_setMainPhoto = false;
            $productModel = $this->_findProduct($headers, $line);
            $isNew = false;
            if(!$productModel) {
                $isNew = true;
                $productModel = Mage::getModel("catalog/product");
                $productModel->setTypeId('simple');
                $productModel->setWebsiteIDs(array(Mage::app()->getStore()->getWebsiteId()));
                $productModel->setAttributeSetId(Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/attribute_set'));
                $productModel->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED);
                $productModel->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE);
                $productModel->setTaxClassId(Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/tax_class_id'));
                $productModel->setData('frontendproduct_product_status', Cminds_Supplierfrontendproductuploader_Model_Product::STATUS_PENDING);
                $productModel->setData('creator_id', Mage::helper('supplierfrontendproductuploader')->getSupplierId());

                if (!Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/can_define_sku') == 2) {
                    $productModel->setSku(Mage::helper('supplierfrontendproductuploader')->generateSku());
                }
            }
            Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

            $foundCategories = false;

            foreach($headers AS $i => $header) {
                $missLine = false;
                $attributeCode = trim($this->_prepareHeader($header));

                if(isset($line[$i])) {
                    if(strtolower($attributeCode) == 'category' && $line[$i] != "") {
                        $foundCategories = true;
                        $missLine = true;
                        $categories = $this->_validateCategories($line[$i]);
                        $productModel->setCategoryIds($categories);
                    }

                    $this->_validateAttributeValue($attributeCode, $line[$i]);

                    if(strtolower($attributeCode) == 'qty') {
                        $productModel->setStockData(array(
                            'is_in_stock' => ($line[$i] > 0) ? 1 : 0,
                            'qty' => $line[$i]
                        ));
                    }

                    if(strtolower($attributeCode) == 'image') {

                        $key = $this->_findImageFileName($line[$i]);
                        $path = $this->_uploadImage($key);

                        if($path && file_exists($path)) {
                            $attrs = null;

                            if(!$this->_setMainPhoto) {
                                $attrs = array('image','small_image','thumbnail');
                                $this->_setMainPhoto = true;
                            }
                            $productModel->addImageToMediaGallery($path, $attrs, true, false);
                        }
                    }
                    if(!$missLine) {
                        $productModel->setData($attributeCode, $line[$i]);
                    }
                } else {
                    if($this->_isRequired($attributeCode)) {
                        throw new Exception("Value for attribute : " . $attributeCode ." is not valid");
                    }
                }
            }

            if(!$foundCategories) {
                throw new Exception('No categories found');
            }
            $productModel->save();

            if($isNew) {
                $mediaGallery = $productModel->getMediaGallery();
                if (isset($mediaGallery['images'])){
                    foreach ($mediaGallery['images'] as $image){
                        Mage::getSingleton('catalog/product_action')->updateAttributes(array($productModel->getId()), array('image'=>$image['file']), 0);
                        break;
                    }
                }
            }
            $this->_removeUsedImages();

            return array('success' => true, 'product_id' => $productModel->getId(), 'sku' => $productModel->getSku(), 'product_name' => $productModel->getName());
        } catch(Exception $e) {
            Mage::log($line, null, 'marketplace_import_data.log');

            $this->_removeUsedImages();

            if(method_exists($e, 'getAttributeCode')) {
                return array('success' => false, 'message' => $e->getMessage(), 'attribute_code' => $e->getAttributeCode());
            } else {
                return array('success' => false, 'message' => $e->getMessage(), 'attribute_code' => 'unknown');
            }
        }
    }

    protected function _findProduct($headers, $line) {

        $foundIdValue = false;
        foreach($headers AS $i => $header) {
            if(strtolower($header) == 'id') {
                $foundIdValue = $line[$i];
                break;
            }
        }

        if(!$foundIdValue || !is_numeric($foundIdValue)) return false;
        $product = Mage::getModel('catalog/product')->load($foundIdValue);

        if(!$product->getId()) throw new Exception($this->__("Product does not exists"));

        if($product->getCreatorId() != Mage::helper('supplierfrontendproductuploader')->getSupplierId()) throw new Exception($this->__("Product does not exists"));

        return $product;
    }

    private function _validateCategories($categories_ids) {
        $categories = explode(';', $categories_ids);
        $validCategoriesIds = array();

        $isValid = false;
        foreach($categories AS $category) {
            $categoryModel = Mage::getModel('catalog/category')->loadByAttribute('name', $category);
            if($categoryModel && $categoryModel->getId()) {
                $isValid = true;
                $validCategoriesIds[] = $categoryModel->getId();
            }
        }

        if(!$isValid) {
            throw new Exception('No valid category');
        }

        return $validCategoriesIds;
    }

    private function _prepareHeader($header) {
        return str_replace(' (*)', '', $header);
    }

    private function _isRequired($attribute_code) {
        $attributeModel = Mage::getSingleton("eav/config")->getAttribute('catalog_product', $attribute_code);
        return $attributeModel->getIsRequired();
    }

    private function _validateAttributeValue($attribute_code, $value) {
        $attributeModel = Mage::getSingleton("eav/config")->getAttribute('catalog_product', $attribute_code);

        if($attributeModel->getIsRequired() && $value == '') {
            throw new Exception("Attribute " . $attribute_code . " is required");
        }

        if($attributeModel->getFrontendInput() == 'select') {
            $attribute = Mage::getModel('catalog/resource_eav_attribute')->load($attributeModel->getId());
            $attributeOptions = $attribute ->getSource()->getAllOptions(false);
            $availableValues = array();
            
            foreach($attributeOptions AS $attributeOption) {
                $availableValues[] = $attributeOption['value'];    
            }

            if(count($availableValues) > 0 || $value != '') {
                if(!in_array($value, $availableValues)) {
                    throw new Exception("Value of attribute " . $attribute_code . " is not valid");
                }
            }
        }

        if($attributeModel->getBackendType() == 'decimal') {
            if(!is_numeric($value)) {
                throw new Exception("Value of attribute " . $attribute_code . " is not valid. Should be numeric.");
            }
        }
    }

    public function validateHeaders($headers) {
        $attributes = Mage::getModel('catalog/product_attribute_api')->items(Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/attribute_set'));

        $required = array();

        /**
         * Internal
         */
        $headers[] = 'created_at';
        $headers[] = 'sku';
        $headers[] = 'sku_type';
        $headers[] = 'status';
        $headers[] = 'tax_class_id';
        $headers[] = 'updated_at';
        $headers[] = 'visibility';
        $headers[] = 'shipment_type';
        $headers[] = 'weight_type';
        $headers[] = 'price_type';
        $headers[] = 'price_view';
        $headers[] = 'weight_type';
        $headers[] = 'links_purchased_separately';
        $headers[] = 'links_title';

        foreach ($attributes as $attribute){
            if($attribute['required']) {
                $required[] = $attribute['code'];
            }
        }

        foreach($headers AS $k => $header) {
            $headers[$k] = $this->_prepareHeader($header);
        }

        return array_values(array_diff($required, $headers));
    }

    private function downloadImage($url) {
        set_time_limit(0);
        $dir = $this->_getHelper('supplierfrontendproductuploader')->getImageCacheDir();
        $lfile = fopen($dir . '/' . basename($url), "w");

        $ch = curl_init($url);

        curl_setopt_array($ch, array(
            CURLOPT_URL            => $url,
            CURLOPT_BINARYTRANSFER => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FILE           => $lfile,
            CURLOPT_TIMEOUT        => 50,
            CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'
        ));

        $results = curl_exec($ch);
        if($results) {
            return $dir . '/' . basename($url);
        }
        return false;
    }

    private function _uploadImage($key) {
        if(count($_FILES['files']['name']) == 0) return false;

        $file = array(
            'name' => $_FILES['files']['name'][$key],
            'type' => $_FILES['files']['type'][$key],
            'tmp_name' => $_FILES['files']['tmp_name'][$key],
            'error' => $_FILES['files']['error'][$key],
            'size' => $_FILES['files']['size'][$key]
        );

        $path = $this->_getHelper('supplierfrontendproductuploader')->getImageCacheDir(null);

        try {
            $uploader = new Varien_File_Uploader($file);
            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
            $res = $uploader->save($path, $file['name']);
            $this->_usedImagesPaths[] = $path . DS . $res['file'];

            return $path . DS . $res['file'];
        } catch(Exception $e) {
            return false;
        }
    }

    private function _removeUsedImages() {
        foreach($this->_usedImagesPaths AS $path) {
            if(file_exists($path)) {
                unlink($path);
            }
        }
    }

    private function _findImageFileName($name) {
        foreach($_FILES['files']['name'] AS $key => $file) {
            if($name == $file) {
                return $key;
            }
        }

        return false;
    }

    private function _validateSalt() {
        $salt = $this->getRequest()->getPost('salt');
        $sessionSalt = Mage::getSingleton('core/session')->getMarketplaceImportSalt();

        if($salt != $sessionSalt) {
            Mage::getSingleton('core/session')->setMarketplaceImportSalt($salt);
            return true;
        }
        return false;
    }
}