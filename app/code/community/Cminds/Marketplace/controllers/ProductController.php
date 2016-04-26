<?php

class Cminds_Marketplace_ProductController extends Cminds_Marketplace_Controller_Action {
    public function preDispatch() {
        parent::preDispatch();
        $hasAccess = $this->_getHelper()->hasAccess();

        if(!$hasAccess) {
            $this->getResponse()->setRedirect($this->_getHelper('supplierfrontendproductuploader')->getSupplierLoginPage());
        }
    }
    public function chooseTypeAction() {
        if($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if($postData['type'] == Mage_Catalog_Model_Product_Type::TYPE_SIMPLE) {
                $this->getResponse()->setRedirect(Mage::getUrl('supplierfrontendproductuploader/product/create', array('attribute_set_id' => $postData['attribute_set_id'])));
            } elseif($postData['type'] == Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE) {
                $this->getResponse()->setRedirect(Mage::getUrl('marketplace/product/createConfigurable', array('attribute_set_id' => $postData['attribute_set_id'])));
            } else {
                Mage::getSingleton('core/session')->addError($this->__("Unsupported Product Type"));
                $this->getResponse()->setRedirect(Mage::getUrl('marketplace/product/chooseType'));
            }
        }
        $this->_renderBlocks(true);
    }
    public function createConfigurableAction() {
        $params = $this->getRequest()->getParams();

        if(!isset($params['attribute_set_id'])) {
            $this->getResponse()->setRedirect(Mage::getUrl('marketplace/product/chooseType'));
            Mage::getSingleton('core/session')->addError($this->__("Missing Attribute Set ID"));
            return;
        }

        Mage::register('is_configurable', false);
        Mage::register('cminds_configurable_request', $params);
        $this->_renderBlocks(true, true);
    }

    public function editConfigurableAction() {
        $params = $this->getRequest()->getParams();
        if(isset($params['id'])) {
            $product = Mage::getModel('catalog/product')->load($params['id']);

            if($product->getData('creator_id') != $this->_getHelper()->getSupplierId()) {
                throw new Exception('No product');
            }

            Mage::register('cminds_configurable_request', $params);

        }
        $this->_renderBlocks(true, true);
    }

    public function associatedProductsAction() {
        $id = $this->getRequest()->getParam('id');
        $product = Mage::getModel('catalog/product')->load($id);
        
        if(!$product->getId()) {
            throw new Exception($this->__('Super Product Not Found'));
        }

        Mage::register('product_object', $product);
        $this->_renderBlocks(true);
    }
    public function editAction() {
        $id = $this->_request->getParam('id', null);

        if($id == null) {
            throw new Exception('No product id');
        }

        $p = Mage::getModel('catalog/product')->load($id);

        if($p->getData('creator_id') != $this->_getHelper()->getSupplierId()) {
            throw new Exception('No product');
        }

        Mage::register('supplier_product_id', $id);


        $this->_renderBlocks(true);
    }

    public function saveAction() {
        if($this->_request->isPost()) {
            $postData = $this->_request->getPost();
            $editMode = false;

            try {
                if(isset($postData['product_id']) && $postData['product_id'] != NULL) {
                    $product = Mage::getModel('catalog/product')->load($postData['product_id']);
                    
                    if(!$product->getId()) {
                        throw new Exception('Product does not exists');
                    }
                    
                    if($product->getData('creator_id') != $this->_getHelper()->getSupplierId()) {
                        throw new Exception('Product does not belongs to this supplier');
                    }
                    $editMode = true;
                } else {
                    $product = Mage::getModel('catalog/product');
                }

                $productValidator = Mage::getModel('supplierfrontendproductuploader/product');
                $productValidator->setData($postData);
                $productValidator->validate();

                $product->setName($postData['name']);
                $product->setDescription($postData['description']);
                $product->setShortDescription($postData['short_description']);
                
                if($postData['special_price'] != '' && number_format($postData['special_price']) != 0) {
                    $product->setSpecialPrice($postData['special_price']);
                    
                    if($postData['special_price_from_date'] != NULL && $postData['special_price_from_date'] != '') {
                        $product->setSpecialFromDate($postData['special_price_from_date']);
                        $product->setSpecialFromDateIsFormated(true);
                    }
                    if($postData['special_price_to_date'] != NULL && $postData['special_price_to_date'] != '') { 
                        $product->setSpecialToDate($postData['special_price_to_date']);
                        $product->setSpecialToDateIsFormated(true);
                    }
                }
                
                if(!$editMode) {
                    if(!isset($postData['sku']) || $postData['sku'] == NULL) {
                        $product->setSku($this->_getSupplierHelper()->generateSku());
                    } else {
                        $cProduct = Mage::getModel('catalog/product')->loadByAttribute('sku', $postData['sku']);

                        if($cProduct) {
                            throw new Exception('Product with this SKU already exists in catalog');
                        }

                        $product->setSku($postData['sku']);
                    }
                    if(!isset($postData['attribute_set_id']) || empty($postData['attribute_set_id'])) {
                        throw new Exception('Missing Attribute Set ID');
                    }

                    $product->setTypeId(Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE);
                    $product->setAttributeSetId($postData['attribute_set_id']);
                    $product->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED);
                    $product->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE);
                    $product->setTaxClassId(Mage::getStoreConfig('supplierfrontendproductuploader_products/supplierfrontendproductuploader_catalog_config/tax_class_id'));
                    $product->setData('admin_product_note', null);
                }

                if(isset($postData['weight'])) {
                    $product->setWeight($postData['weight']);
                }
                $product->setPrice($postData['price']);

                if(isset($postData['qty'])) {
                    $product->setStockData(array(
                        'is_in_stock' => ($postData['qty'] > 0) ? 1 : 0,
                        'qty' => $postData['qty']
                    ));
                }

                $product->setCategoryIds($postData['category']);
                $product->setWebsiteIDs(array(Mage::app()->getStore()->getWebsiteId()));
                $product->setCreatedAt(strtotime('now'));

                if(isset($postData['attributes'])) {
                    foreach($postData['attributes'] as $attrCode){

                        $super_attribute= Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product',$attrCode);
                        $configurableAtt = Mage::getModel('catalog/product_type_configurable_attribute')->setProductAttribute($super_attribute);

                        $newAttributes[] = array(
                            'id'             => $configurableAtt->getId(),
                            'label'          => $configurableAtt->getLabel(),
                            'position'       => $super_attribute->getPosition(),
                            'values'         => $configurableAtt->getPrices() ? $product->getPrices() : array(),
                            'attribute_id'   => $super_attribute->getId(),
                            'attribute_code' => $super_attribute->getAttributeCode(),
                            'frontend_label' => $super_attribute->getFrontend()->getLabel(),
                        );
                    }
                }

                if(!empty($newAttributes)){
                    $product->setCanSaveConfigurableAttributes(true);
                    $product->setConfigurableAttributesData($newAttributes);
                }

                Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
                $product->save();

                unset($postData['name'], $postData['description'], $postData['short_description'], $postData['sku'], $postData['weight'], $postData['price'], $postData['qty'], $postData['category']);

                $product = Mage::getModel('catalog/product')->load($product->getId());

                if(!isset($postData['image'])) {
                    $postData['image'] = array();
                }
                
                $existingImages = array();
                
                if($product->getId() && $editMode) {
                    $mediaApi = Mage::getModel("catalog/product_attribute_media_api");
                    $mediaGalleryAttribute = Mage::getModel('catalog/resource_eav_attribute')->loadByCode($product->getEntityTypeId(), 'media_gallery');
                    $gallery = $product->getMediaGalleryImages();
                    
                    foreach ($gallery as $image) {
                        if(!in_array($image->getFile(), $postData['image'])) {
                            $mediaApi->remove($product->getId(), $image->getFile());
                            $mediaGalleryAttribute->getBackend()->removeImage($product, $image->getFile());

                        } else {
                            $existingImages[] = $image->getFile();
                            
                            if($postData['main_photo'] == $image->getFile()) {
                                Mage::getSingleton('catalog/product_action')->updateAttributes(array($product->getId()), array('image'=>$image->getFile()), 0);
                            }
                        }
                    }
                }

                foreach($postData['image'] AS $image) {
                    if($image != '' && $image && $image != NULL && !in_array($image, $existingImages)) {
                        $attrs = null;

                        if($image == $postData['main_photo']) {
                            $attrs = array('image','small_image','thumbnail');
                        }
                        $product->addImageToMediaGallery($this->_getSupplierHelper()->getImageCacheDir($postData) . $image, $attrs, true, false);
                    }
                }

                $ommitIndex = array('submit', 'main_photo', 'image', 'product_id', 'special_price', 'special_price_to_date', 'special_price_from_date', 'notify_admin_about_change');

                foreach($postData AS $index => $value) {
                    if(!in_array($index, $ommitIndex) && $value != '') {
                        $product->setData($index, $value);
                    }
                }

                if($editMode) {
                    $product->setSmallImage($postData['main_photo']);
                    $product->setImage($postData['main_photo']);
                    $product->setThumbnail($postData['main_photo']);
                } else {
                    $product->setData('frontendproduct_product_status', Cminds_Supplierfrontendproductuploader_Model_Product::STATUS_PENDING);
                    $product->setData('creator_id', $this->_getHelper()->getSupplierId());
                }

                $product->save();

                if(!$editMode) {
                    Mage::log($this->_getHelper()->__('Supplier '. $this->_getHelper()->getSupplierId() .' created product : ' . $product->getId()));
                    $this->_getHelper('supplierfrontendproductuploader/email')->notifyOnSupplierAddNew($product);
                } else {
                    if(isset($postData['notify_admin_about_change']) && $postData['notify_admin_about_change'] == 1) {
                        $this->_getHelper('supplierfrontendproductuploader/email')->notifyAdminOnProductChange($product);
                    }
                }

                Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('supplierfrontendproductuploader/product/list'));
            } catch (Exception $ex) {
                Mage::getSingleton('core/session')->addError($ex->getMessage());
                Mage::log($ex->getMessage());
                Mage::getSingleton("supplierfrontendproductuploader/session")->setProductData($postData);
                
                if($editMode) {
                    Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('marketplace/product/editConfigurable/', array('id' =>  $postData['product_id'])));
                } else {
                    Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('marketplace/product/createConfigurable/', array('attribute_set_id' =>  $postData['attribute_set_id'])));
                }
            }
        }
    }

    public function saveAssociatedProductAction() {
        if($this->_request->isPost()) {
            $post = $this->_request->getPost();

            try {
                $transaction = Mage::getModel('core/resource_transaction');
                $configurableProduct = Mage::getModel('catalog/product')
                    ->setStoreId(Mage_Core_Model_App::ADMIN_STORE_ID)
                    ->load($post['super_product_id']);

                if (!$configurableProduct->isConfigurable()) {
                    $this->_redirect('*/*/');
                    return;
                }
                $transaction->addObject($configurableProduct);
                if(!isset($post['product_id']) || $post['product_id'] == 0) {
                    $product = Mage::getModel('catalog/product')
                        ->setStoreId(0)
                        ->setTypeId(Mage_Catalog_Model_Product_Type::TYPE_SIMPLE)
                        ->setAttributeSetId($configurableProduct->getAttributeSetId());

                    $transaction->addObject($product);
                    $product->setStockData(array(
                        'is_in_stock' => ($post['qty'] > 0) ? 1 : 0,
                        'qty' => $post['qty']
                    ));

                    foreach ($product->getTypeInstance()->getEditableAttributes() as $attribute) {
                        if ($attribute->getIsUnique()
                            || $attribute->getAttributeCode() == 'url_key'
                            || $attribute->getFrontend()->getInputType() == 'gallery'
                            || $attribute->getFrontend()->getInputType() == 'media_image'
                            || !$attribute->getIsVisible()) {
                            continue;
                        }

                        $product->setData(
                            $attribute->getAttributeCode(),
                            $configurableProduct->getData($attribute->getAttributeCode())
                        );
                    }

                    $product->addData($this->getRequest()->getPost());
                    $product->setWebsiteIds($configurableProduct->getWebsiteIds());

                    $result['attributes'] = array();

                    foreach ($configurableProduct->getTypeInstance()->getConfigurableAttributes() as $attribute) {
                        $value = $product->getAttributeText($attribute->getProductAttribute()->getAttributeCode());
                        $result['attributes'][] = array(
                            'label'         => $value,
                            'value_index'   => $product->getData($attribute->getProductAttribute()->getAttributeCode()),
                            'attribute_id'  => $attribute->getProductAttribute()->getId()
                        );
                    }
                    $values = array();
                    foreach($post['options'] AS $index => $option) {
                        $values[] = $post[$index];
                    }

                    foreach($post AS $name => $value) {
                        $product->setData($name, $value);
                    }

                    $product->setName($post['name']);
                    $product->setSku($configurableProduct->getSku() . '-' . Mage::getModel('catalog/product_url')->formatUrlKey(implode('-', $values)));

                    $product->validate();
                    $product->save();
                } else {
                    $product = Mage::getModel('catalog/product')->load($post['product_id']);

                    if(!$product->getId()) {
                        throw new Exception($this->__("Product doesn't not exists"));
                    }

                    if(!Mage::helper('marketplace')->isOwner($product->getId())) {
                        throw new Exception($this->__("Product doesn't belongs to you"));
                    }
                }
                $configurableModel = Mage::getModel('marketplace/product_configurable');
                $configurableModel->setProduct($configurableProduct);
                $configurableProductsData = $configurableModel->getConfigurableProductValues();

                $additionalPrice = 0;

                if(!isset($post['product_id']) || $post['product_id'] == 0) {
                    if(!$this->_validateValues($configurableProductsData, $post)) {
                        throw new Exception(Mage::helper('marketplace')->__("Simple product with this options is already created."));
                    }

                    foreach($post['options'] AS $index => $option) {
                        if(!isset($post[$index]) || $post[$index] == '') continue;

                        $configurableProductsData[$product->getId()][] = array(
                            'attribute_id' => $option['attribute_id'],
                            'value_index' => $post[$index],
                            'is_percent' => '0',
                            'pricing_value' => $option['price']
                        );
                        $additionalPrice = $additionalPrice + $option['price'];
                    }
                }else{
                    $superAttributes = $configurableModel->getSuperAttributes();
                    foreach($superAttributes AS $attribute) {
                        $simpleProductData = $product->getData($attribute['attribute_code']);
                        $configurableProductsData[$product->getId()][] = array(
                            'attribute_id' => $option['attribute_id'],
                            'value_index' => $simpleProductData,
                            'is_percent' => '0',
                            'pricing_value' => $product->getPrice()
                        );
                    }
                    
                }

                $configurableProduct->setCanSaveConfigurableAttributes(true);
                $product->setPrice($configurableProduct->getPrice() + $additionalPrice);

                $configurableProduct->setConfigurableProductsData($configurableProductsData);
                $configurableProduct->save();

                $p = Mage::getModel('catalog/product')->load($product->getId());
                $p->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE)->save();

                Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('marketplace/product/associatedProducts', array('id' => $post['super_product_id'])));
            } catch (Exception $e) {
                if(!isset($post['product_id']) || $post['product_id'] == 0) {
                    Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
                    $product->delete();
                }
                Mage::getSingleton('core/session')->addError($e->getMessage());
                Mage::logException($e);
                $this->getResponse()->setRedirect(Mage::getUrl('marketplace/product/associatedProducts', array('id' => $post['super_product_id'])));
            }
        }
    }

    private function _validateValues($configurable_values, $values_selected) {
        $isValid = true;

        foreach($values_selected['options'] AS $index => $value) {
            foreach($configurable_values as $product) {
                $matchedProductValues = 0;
                $countValues = count($product);

                foreach($product AS $confValue) {
                    if($confValue['attribute_id'] == $value['attribute_id'] &&
                     $confValue['value_index'] == $values_selected[$index]) {
                        $matchedProductValues++;
                    }
                }

                if($matchedProductValues >= $countValues) {
                    $isValid = false;
                }
            }
        }

        return $isValid;
    }

    public function deleteAssociatedAction() {
        $id = $this->_request->getParam('id', null);

        try {
            if($id == null) {
                throw new Exception('No product id');
            }

            $p = Mage::getModel('catalog/product')->load($id);
            $ids = Mage::getModel('catalog/product_type_configurable')
                ->getParentIdsByChild( $p->getId() );

            if(count($ids) == 0) {
                throw new Exception($this->__('Product is not associated to any configurable products'));
            }

            if($p->getData('creator_id') != $this->_getHelper()->getSupplierId()) {
                throw new Exception('No product');
            }

            Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

            $p->delete();
            Mage::getSingleton('core/session')->addSuccess($this->__("Product %s was successfully deleted", $p->getName()));
        } catch(Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            Mage::logException($e);
        }
        $this->getResponse()->setRedirect(Mage::getUrl('supplierfrontendproductuploader/product/list'));
    }

    public function attachToConfigurableAction() {
        $id = $this->_request->getParam('id', null);
        $configurableId = $this->_request->getParam('configurable', null);

        try {
            if($id == null) {
                throw new Exception($this->__('No product id'));
            }

            if($configurableId == null) {
                throw new Exception($this->__('No product id'));
            }

            $configurableProduct = Mage::getModel('catalog/product')->load($configurableId);
            $product = Mage::getModel('catalog/product')->load($id);

            $configurableModel = Mage::getModel('marketplace/product_configurable');
            $configurableModel->setProduct($configurableProduct);
            $configurableProductsData = $configurableModel->getConfigurableProductValues();

            $additionalPrice = 0;
            $configurableProductsData[$product->getId()][] = array(
                'is_percent' => '0',
            );

            $configurableProduct->setCanSaveConfigurableAttributes(true);
            $product->setPrice($configurableProduct->getPrice() + $additionalPrice);

            $configurableProduct->setConfigurableProductsData($configurableProductsData);
            $configurableProduct->save();
            Mage::getSingleton('core/session')->addSuccess($this->__("Product %s was successfully attached", $product->getName()));
        } catch(Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            Mage::logException($e);
        }

        $this->getResponse()->setRedirect(Mage::getUrl('marketplace/product/associatedProducts', array('id' => $configurableId)));
    }

    public function changeAssociatedStatusAction() {
        $id = $this->_request->getPost('product_id', null);
        $configurableId = $this->_request->getPost('configurable_id', null);

        try {
            if($id == null) {
                throw new Exception($this->__('No product id'));
            }

            if($configurableId == null) {
                throw new Exception($this->__('No product id'));
            }

            $configurableProduct = Mage::getModel('catalog/product')->load($configurableId);
            $product = Mage::getModel('catalog/product')->load($id);

            $configurableModel = Mage::getModel('marketplace/product_configurable');
            $configurableModel->setProduct($configurableProduct);
            $configurableProductsData = $configurableModel->getConfigurableProductValues();

            $additionalPrice = 0;

            if($this->_request->getPost('status') == 'true') {
                $configurableProductsData[$product->getId()][] = array(
                    'is_percent' => '0',
                );

                $configurableProduct->setCanSaveConfigurableAttributes(true);
                $product->setPrice($configurableProduct->getPrice() + $additionalPrice);
            } else {
                if(isset($configurableProductsData[$product->getId()])) {
                    unset($configurableProductsData[$product->getId()]);
                }
            }

            Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

            $configurableProduct->setConfigurableProductsData($configurableProductsData);
            $configurableProduct->save();
        } catch(Exception $e) {
            Mage::logException($e);
        }
    }
}