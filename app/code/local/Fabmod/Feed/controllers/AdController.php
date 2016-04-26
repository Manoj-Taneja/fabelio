<?php
class Fabmod_Feed_AdController extends Mage_Core_Controller_Front_Action {        

  private $products = Array();
  private $headers = Array(
    'id' => 'ID',
    'sku' => 'ID2',
    'image' => 'Image URL',
    'price' => 'Price',
    'sale_price' => 'Sale Price',
    'name' => 'Item Title',
    'url' =>  'Final URL',
    'google_product_category' => 'Item Category',
  );
  private function getProducts(){
    if(count($this->products) == 0){
      $feedModel = Mage::getModel('feed/feed');
      $feedHelper = Mage::helper('feed');
      $products = $feedModel->getProducts();
      $mediaUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product';
      foreach($products as $key=>$product){
        $custom_label_0 = 0;
        $description = preg_replace("/[\r\n]+/", " ", strip_tags($product->getDescription()));
        $price = $product->getPrice();
        $sale_price = $product->getFinalPrice();
        if($sale_price < $price){ $custom_label_0 = 1 ; }
        if(!$description || !$price || !$sale_price) continue;
        if($product->isSalable()){
          $stock = $product->getStockItem();
          if ($stock->getIsInStock()) {
            $availability = 'in stock';
          }else{
            $availability = 'available for order';
          }
        }else{
          $availability = 'preorder';
        }
        $arrayImages = Array();
        $_images = Mage::getModel('catalog/product')->load($product->getId())->getMediaGalleryImages();
        foreach ($_images as $image) {
          $img = $image->toArray();
          $arrayImages[] = $img['url'];
        }
        $title = $product->getName();
        $title = strlen($title) > 100 ? substr($title,0,97)."..." : $title;
        $description = strlen($description) > 5000 ? substr($description,0,4997)."..." : $description;

        $currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();
        $discount_amount = $price - $sale_price;
        $discount_percent = round($discount_amount/$price*100);
        $this->products[] = Array(
          'id'           => $product->getId(),
          'name'         => $title,
          'url'          => $product->getProductUrl(),
          'image'        => $mediaUrl . $product->getImage(),
          'price'        => ($price + 0) . ' ' . $currency_code,
          'sale_price'   => ($sale_price + 0) . ' ' . $currency_code,
          'sku'          => $product->getSku(),
          'google_product_category'    => $product->getAttributeText('reporting_category'),
        );
      }
    }
    return $this->products;
  }

  public function xmlAction() {
    echo '';
  }

  public function tsvAction(){
    $headers = $this->headers;
    $tsvStr = Array(join(",", $headers));
    foreach($this->getProducts() as $product){
      $row = Array();
      foreach($headers as $key=>$h){
        $row[] = $product[$key];
      }
      $tsvStr[] = join(",", $row);
    }
    $this->getResponse()->setHeader('Content-type', 'text/csv');
    $this->getResponse()->setHeader("Content-Disposition: attachment; filename=adwords.csv");
    $this->getResponse()->setBody(trim(join("\n", $tsvStr)));
  }

}

