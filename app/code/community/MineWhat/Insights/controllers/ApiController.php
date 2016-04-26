<?php

/**
 * @category    MineWhat
 * @package     MineWhat_Insights
 * @copyright   Copyright (c) MineWhat
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class MineWhat_Insights_ApiController extends Mage_Core_Controller_Front_Action {

    const CONFIG_API_KEY = 'minewhat_insights/settings/api_key';

    public function _authorise() {

        $API_KEY = Mage::getStoreConfig(self::CONFIG_API_KEY);

        // Check for api access
        if(!$API_KEY && strlen($API_KEY) === 0) {
            // Api access disabled
            $this->getResponse()
                    ->setBody(json_encode(array('status' => 'error', 'message' => 'API access disabled', 'version' => 2)))
                    ->setHttpResponseCode(403)
                    ->setHeader('Content-type', 'application/json', true);
            return false;
        }

        $authHeader = $this->getRequest()->getHeader('mwauth');

        // fallback
        if (!$authHeader || strlen($authHeader) == 0) {
          $authHeader = $this->getRequest()->getParam('mwauth');
        }

        if (!$authHeader) {
            Mage::log('Unable to extract authorization header from request', null, 'minewhat.log');
            // Internal server error
            $this->getResponse()
                   ->setBody(json_encode(array('status' => 'error', 'message' => 'Internal server error, Authorization header not found', 'version' => 2)))
                   ->setHttpResponseCode(500)
                   ->setHeader('Content-type', 'application/json', true);
            return false;
        }

        if(trim($authHeader) !== trim($API_KEY)) {
            // Api access denied
            $this->getResponse()
                    ->setBody(json_encode(array('status' => 'error', 'message' => 'Api access denied', 'version' => 2)))
                    ->setHttpResponseCode(401)
                    ->setHeader('Content-type', 'application/json', true);
            return false;
        }

        return true;

    }

    public function ordersAction() {

        try {

            if(!$this->_authorise()) {
                return $this;
            }

            $sections = explode('/', trim($this->getRequest()->getPathInfo(), '/'));

            if(isset($sections[3])) {
                // Looking for a specific order
                $orderId = $sections[3];

                $order = Mage::getModel('sales/order')->load($orderId, 'increment_id');

                $extras = $this->getRequest()->getParam('extras');
                $debug = $this->getRequest()->getParam('debug', 'false') === 'true';
                if($extras && strlen($extras)) {
                    $extras = explode(',', $extras);
                    for($i = 0;$i < sizeof($extras);$i++) {
                        $extras[$i] = trim($extras[$i]);
                    }
                }

                $items = array();

                $orderItems = $order->getItemsCollection()->load();

                foreach($orderItems as $key => $orderItem) {
                    $items[] = array(
                            'name'  =>  $orderItem->getName(),
                            'pid'   =>  $orderItem->getProductId(),
                            'sku'   =>  $orderItem->getSku(),
                            'qty'   =>  $orderItem->getQtyOrdered(),
                            'price' =>  $orderItem->getPrice()
                        );
                }

                $responseObj = array(
                  'order_id' => $orderId,
                  'items' => $items,
                  'ip' => $order->getRemoteIp()
                );

                $attributes = $order->debug();
                if($debug) {
                  $responseObj['extras'] = $attributes;
                } else {
                  foreach($extras as $key) {
                      $responseObj['extras'][$key] = $attributes[$key];
                  }
                }

                $responseObj['version'] = 2;
                $this->getResponse()
                    ->setBody(json_encode($responseObj))
                    ->setHttpResponseCode(200)
                    ->setHeader('Content-type', 'application/json', true);
            } else {
                // Looking for a list of orders
                $currentTime = time();
                $fromDate = $this->getRequest()->getParam('fromDate', date('Y-m-d', ($currentTime - 86400)));
                $toDate = $this->getRequest()->getParam('toDate', date('Y-m-d', $currentTime));

                $orders = array();

                $ordersCollection = Mage::getModel('sales/order')->getCollection()
                    //->addFieldToFilter('status', 'complete')
                    ->addAttributeToSelect('customer_email')
                    ->addAttributeToSelect('created_at')
                    ->addAttributeToSelect('increment_id')
                    ->addAttributeToSelect('status')
                    ->addAttributeToFilter('created_at', array('from' => $fromDate, 'to' => $toDate))
                ;

                foreach ($ordersCollection as $order) {
                    $orders[] = array(
                        'order_id'      =>  $order->getIncrementId(),
                        'status'        =>  $order->getStatus(),
                        'email'         =>  $order->getCustomerEmail(),
                        'created_at'    =>  $order->getCreatedAt()
                        );
                }

                $this->getResponse()
                    ->setBody(json_encode(array('orders' => $orders, 'fromDate' => $fromDate, 'toDate' => $toDate, 'version' => 2)))
                    ->setHttpResponseCode(200)
                    ->setHeader('Content-type', 'application/json', true);

            }

        } catch(Exception $e) {
            $this->getResponse()
                ->setBody(json_encode(array('status' => 'error', 'message' => 'Internal server error', 'version' => 2)))
                ->setHttpResponseCode(500)
                ->setHeader('Content-type', 'application/json', true);
        }

        return this;

    }

    public function productsAction() {

        try {

            if(!$this->_authorise()) {
                return $this;
            }

            $sections = explode('/', trim($this->getRequest()->getPathInfo(), '/'));
            $products = array();

            $attributes = array(
               'name',
               'sku',
               'image',
               'manufacturer',
               'price',
               'final_price',
               'special_price',
               'short_description'
            );

            $extras = $this->getRequest()->getParam('extras');
            $debug = $this->getRequest()->getParam('debug', 'false') === 'true';

            if($extras && strlen($extras)) {
                $extras = explode(',', $extras);
                for($i = 0;$i < sizeof($extras);$i++) {
                    $extras[$i] = trim($extras[$i]);
                    $attributes[] = $extras[$i];
                }
            }

            if(isset($sections[3])) {
                // Looking for a specific product
                $productId = $sections[3];

                $product = Mage::getModel('catalog/product')->load($productId);

                $product = $this->getFormattedProduct($product, $extras, $debug);
                if($product !== null) {
                    $products[] = $product;
                }

            } else {
                // Looking for a list of products
                $limit = $this->getRequest()->getParam('limit', 100);
                $offset = $this->getRequest()->getParam('offset', 1);

                $productsCollection = Mage::getModel('catalog/product')->getCollection();
                $productsCollection
                ->addAttributeToSelect($attributes)
                ->getSelect()->limit($limit, $offset)   //we can specify how many products we want to show on this page
                ;

                foreach($productsCollection as $product) {
                    $product = $this->getFormattedProduct($product, $extras, $debug);
                    if($product !== null) {
                        $products[] = $product;
                    }
                }

            }

            $currency = Mage::app()->getStore()->getCurrentCurrencyCode();

            $this->getResponse()
                ->setBody(json_encode(array('products' => $products, 'currency' => $currency, 'version' => 2)))
                ->setHttpResponseCode(200)
                ->setHeader('Content-type', 'application/json', true);


        } catch(Exception $e) {
            $this->getResponse()
                ->setBody(json_encode(array('status' => 'error', 'message' => 'Internal server error', 'version' => 2)))
                ->setHttpResponseCode(500)
                ->setHeader('Content-type', 'application/json', true);
        }

        return $this;

    }


    public function categoriesAction() {

        try {

            if(!$this->_authorise()) {
                return $this;
            }

            $attributes = array(
               'id',
               'name',
               'image',
               'url',
               'level',
               'is_active',
               'created_at',
               'updated_at'
            );

            $sections = explode('/', trim($this->getRequest()->getPathInfo(), '/'));
            $categories = array();

            $level = $this->getRequest()->getParam('level');
            $active = $this->getRequest()->getParam('active', 'false') === 'true';

            if($level && strlen($level)) {
                $level = intval($level);
            } else {
                $level = null;
            }

            if(isset($sections[3])) {
                // Looking for a specific category
                $categoryId = $sections[3];

                $category = Mage::getModel('catalog/category')->load($categoryId);

                $category = $this->getFormattedCategory($category);
                if($category !== null) {
                    $categories[] = $category;
                }

            } else {
                // Looking for a list of categories
                $limit = $this->getRequest()->getParam('limit', 100);
                $offset = $this->getRequest()->getParam('offset', 1);

                $categoriesCollection = Mage::getModel('catalog/category')->getCollection();

                if($level != null) {
                    $categoriesCollection
                    ->addAttributeToFilter('level', $level) //we can specify the level of categories to be fetched
                    ;
                }

                if($active != null) {
                    $categoriesCollection
                    ->addAttributeToFilter('is_active', 1) //if you want only active categories
                    ;
                }

                $categoriesCollection
                ->addAttributeToSelect($attributes)
                ->getSelect()->limit($limit, $offset)   //we can specify how many categories we want to show on this page
                ;

                foreach($categoriesCollection as $category) {
                    $category = $this->getFormattedCategory($category);
                    if($category !== null) {
                        $categories[] = $category;
                    }
                }

            }

            $this->getResponse()
                ->setBody(json_encode(array('categories' => $categories, 'version' => 2)))
                ->setHttpResponseCode(200)
                ->setHeader('Content-type', 'application/json', true);


        } catch(Exception $e) {
            $this->getResponse()
                ->setBody(json_encode(array('status' => 'error', 'message' => 'Internal server error', 'version' => 2)))
                ->setHttpResponseCode(500)
                ->setHeader('Content-type', 'application/json', true);
        }

        return $this;

    }


    public function stockAction() {

       try {

           if(!$this->_authorise()) {
               return $this;
           }

           $productId = $this->getRequest()->getParam('pid');
           $sku = $this->getRequest()->getParam('sku', 'false') === 'true';


           if(!$productId || strlen($productId) <= 0) {

               $this->getResponse()
               ->setBody(json_encode(array('status' => 'error', 'message' => 'product id required', 'version' => 2)))
               ->setHttpResponseCode(500)
               ->setHeader('Content-type', 'application/json', true);

           } else {

               // load product if sku is given
               if($sku) {
                 $product = Mage::getModel('catalog/product')->loadByAttribute('sku', $productId);
                 if($product == null) {
                    $this->getResponse()
                      ->setBody(json_encode(array('status' => 'error', 'message' => 'invalid sku', 'version' => 2)))
                      ->setHttpResponseCode(500)
                      ->setHeader('Content-type', 'application/json', true);
                      return $this;
                 }
                 $productId = $product->getId();
               }

               // get stock info
               $stockObj = Mage::getModel('cataloginventory/stock_item')->loadByProduct($productId);

               $stock = $stockObj->getQty();

               $this->getResponse()
                   ->setBody(json_encode(array('id' => $productId, 'stock' => $stock, 'version' => 2)))
                   ->setHttpResponseCode(200)
                   ->setHeader('Content-type', 'application/json', true);

           }

       } catch(Exception $e) {
           $this->getResponse()
               ->setBody(json_encode(array('status' => 'error', 'message' => 'Internal server error', 'version' => 2)))
               ->setHttpResponseCode(500)
               ->setHeader('Content-type', 'application/json', true);
       }

       return $this;

    }


    private function getFormattedProduct($product, $extras, $debug) {

        $formattedProduct = null;

        try {
            $formattedProduct = array(
                'id'            =>  $product->getId(),
                'sku'           =>  $product->getSku(),
                'name'          =>  $product->getName(),
                'cat'           =>  array(),
                'manufacturer'  =>  $product->getAttributeText('manufacturer'),
                'price'         =>  $product->getPrice(),
                'final_price'   =>  $product->getFinalPrice(),
                'special_price' =>  $product->getSpecialPrice(),
                'image'         =>  $product->getImageUrl(),
                'url'           =>  $product->getProductUrl(),
                'info'          =>  $product->getShortDescription(),
                'status'        =>  $product->getStatus(),
                'type'          =>  $product->getTypeId(),
                'created_at'    =>  $product->getCreatedAt(),
                'updated_at'    =>  $product->getUpdatedAt()
            );
            if(!$formattedProduct['manufacturer'] || strlen($formattedProduct['manufacturer']) === 0) {
                $product = Mage::getModel('catalog/product')->load($product->getId());
                $formattedProduct['manufacturer'] = $product->getAttributeText('manufacturer');
            }

            if($formattedProduct['type'] == "configurable") {
               // get associated product ids
               $associatedProducts = Mage::getModel('catalog/product_type_configurable')->getChildrenIds($formattedProduct['id']);
               $formattedProduct['associated_products'] = $associatedProducts;
            }

            // get stock info
            $stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);
            $formattedProduct['stock'] = $stock->getQty();

            if($debug) {
                $attributes = $product->getAttributes();
                foreach($attributes as $key => $value) {
                    $formattedProduct['extras'][$key] = $product->getAttributeText($key);
                }
            } else {
                foreach($extras as $key) {
                    $formattedProduct['extras'][$key] = $product->getAttributeText($key);
                }
            }

            $categories = $product->getCategoryCollection()
                            ->addAttributeToSelect('id')
                            ->addAttributeToSelect('name')
                            ->addAttributeToSelect('path')
                            ->addAttributeToSelect('level');
            foreach($categories as $category) {
                $formattedCategory = array();
                $formattedCategory['id'] = $category->getId();
                $formattedCategory['name'] = $category->getName();
                $formattedCategory['level'] = $category->getLevel();
                $formattedCategory['path'] = $category->getPath();
                $formattedProduct['cat'][$formattedCategory['id']] = $formattedCategory;
            }

        } catch(Exception $e) {}

        return $formattedProduct;

    }

    private function getFormattedCategory($category) {

        $formattedCategory = null;

        try {

                $formattedCategory = array(
                    'id'            =>  $category->getId(),
                    'name'          =>  $category->getName(),
                    'image'         =>  $category->getImageUrl(),
                    'url'           =>  $category->getUrl(),
                    'level'         =>  $category->getLevel(),
                    'is_active'         =>  $category->getIsActive(),
                    'created_at'    =>  $category->getCreatedAt(),
                    'updated_at'    =>  $category->getUpdatedAt()
                );

        } catch(Exception $e) {}

        return $formattedCategory;

    }

}