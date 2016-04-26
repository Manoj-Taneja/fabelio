<?php
class Fabmod_Feed_MwController extends Mage_Core_Controller_Front_Action {        

    private $products = Array();
    private $headers = Array(
      'Product id',
      'Product image',
      'Price of product',
      'Name of the product',
      'Category',
      'Brand',
      'Product URL',
      'Description',
      'Color',
    );
    private function getProducts(){
      if(count($this->products) == 0){
        $feedModel = Mage::getModel('feed/feed');
        $feedHelper = Mage::helper('feed');
        $products = $feedModel->getProducts();
        $mediaUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product';
        foreach($products as $key=>$product){
          $_catIds = $product->getCategoryIds();
          $categories = Mage::getModel('catalog/category')
              ->getCollection()
              ->addAttributeToSelect('name')
              ->addAttributeToFilter('entity_id', array('in'=>$_catIds));
          $_cats = Array(); 
          foreach($categories as $cat){
            $_cats[] = $cat->getName();
          }
          $description = preg_replace("/[\r\n]+/", " ", strip_tags($product->getDescription()));
          $price = $product->getFinalPrice();
          if(!$description || !$price) continue;
          $this->products[] = Array(
            'id'          => $product->getId(),
            'name'        => $product->getName(),
            'url'         => $product->getProductUrl(),
            'brand'       => $feedHelper->getBrand($product),
            'category'    => join('|', array_unique($_cats)),
            'image'       => $mediaUrl . $product->getImage(),
            'price'       => $price,
            'sku'         => $product->getSku(),
            'color'       => $product->getAttributeText('color'),
            'description' => $description,
          );
        }
      }
      return $this->products;
    }

    public function xmlAction(){
      echo '';
    }

    public function tsvAction(){
      $tsvStr = Array(join("\t", $this->headers));
      foreach($this->getProducts() as $product){
        $tsvStr[] = join("\t", Array(
          $product['id'],
          $product['image'],
          $product['price'],
          $product['name'],
          $product['category'],
          $product['brand'],
          $product['url'],
          $product['description'],
          $product['color'],
        ));
      }
      $this->getResponse()->setHeader('Content-type', 'text/comma-separated-values');
      $this->getResponse()->setBody(trim(join("\n", $tsvStr)));
    }
}

