<?php
class Fabmod_Feed_FbController extends Mage_Core_Controller_Front_Action {        

  private $products = Array();
  private $headers = Array(
    'id' => 'id',
    'sku' => 'sku',
    'image' => 'image_link',
    'price' => 'price',
    'sale_price' => 'sale_price',
    'name' => 'title',
    'brand' => 'brand',
    'url' =>  'link',
    'description' => 'description',
    'color' => 'color',
    'additional_image_link' => 'additional_image_link',
    'availability' => 'availability',
    'condition' => 'condition',
    'google_product_category' => 'google_product_category',
    'custom_label_0' => 'custom_label_0',
    'discount_amount' => 'discount_amount',
    'discount_percent' => 'discount_percent',
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
          'brand'        => $feedHelper->getBrand($product),
          'image'        => $mediaUrl . $product->getImage(),
          'additional_image_link' => join(",", $arrayImages),
          'price'        => ($price + 0) . ' ' . $currency_code,
          'sale_price'   => ($sale_price + 0) . ' ' . $currency_code,
          'sku'          => $product->getSku(),
          'color'        => $product->getAttributeText('color'),
          'description'  => $description,
          'availability' => $availability,
          'condition' => 'new',
          'custom_label_0' => $custom_label_0,
          'google_product_category'    => $product->getAttributeText('reporting_category'),
          'discount_amount' => ($discount_amount + 0). ' ' . $currency_code,
          'discount_percent' => $discount_percent,
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
    $tsvStr = Array(join("\t", $headers));
    foreach($this->getProducts() as $product){
      $row = Array();
      foreach($headers as $key=>$h){
        $row[] = $product[$key];
      }
      $tsvStr[] = join("\t", $row);
    }
    $this->getResponse()->setHeader('Content-type', 'text/tab-separated-values');
    $this->getResponse()->setBody(trim(join("\n", $tsvStr)));
  }

}

