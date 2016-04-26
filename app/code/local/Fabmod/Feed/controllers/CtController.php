<?php
class Fabmod_Feed_CtController extends Mage_Core_Controller_Front_Action {        

  private $products = Array();
  private $headers = Array(
    'id' => 'id',
    'bigimage' => 'image_link',
    'price' => 'price',
    'retailprice' => 'sale_price',
    'name' => 'title',
    'brand' => 'brand',
    'producturl' =>  'link',
    'description' => 'description',
    'extracolor' => 'color',
    'additional_image_link' => 'additional_image_link',
    'availability' => 'availability',
    'categoryid1'  => 'categoryid1',
    'condition' => 'condition',
  );
  private function getProducts(){
    if(count($this->products) == 0){
      $feedModel = Mage::getModel('feed/feed');
      $feedHelper = Mage::helper('feed');
      $products = $feedModel->getProducts();
      $mediaUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product';
      foreach($products as $key=>$product){
         $cats=$product->getCategoryIds();
         $a=array();
         $first="";
         $second="";
         $categorynames=array();
         $i=0;
         $categorynamesfin="";
         $categoryid1='';
	      foreach ($cats as $category_id) {
	          $_cat = Mage::getModel('catalog/category')->load($category_id);
        	  $catnames = array();
        		foreach ($_cat->getParentCategories() as $parent) {
		         	$catnames[] = $parent->getName();
			        $catnamesstring = implode('/', $catnames);	
	        		array_push($categorynames,$catnamesstring); 
		  	    }
    		$categorynamesfin = implode ('|',$categorynames);
	      array_push($a,$_cat->getName()); 
	    }
	  
	      for($i=0;$i<sizeof($a);$i++){
	   	    	if($i+2<sizeof($a)){
	   	    		$second=$a[$i+2];
	   			$first=$a[$i+1];
	   		}
	   		else if($i+1<sizeof($a))	{
	   			$first=$a[$i+1];
	   		
	   		}else {
	   			$first=$a[$i];
		   	}
        }
        if($second!=""){
            $categoryid1=trim($second);
        }
        else{
            $categoryid1=trim($first);
        } 
        $description = preg_replace("/[\r\n]+/", " ", strip_tags($product->getDescription()));
        $price = $product->getPrice();
        $sale_price = $product->getFinalPrice();
        if(!$description || !$price || !$sale_price) continue;
        if($product->isSalable()){
            $availability = 1;
        }else{
          $availability = 0;
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

        $this->products[] = Array(
          'id'           => '"'.$product->getId().'"',
          'name'         => '"'.$title.'"',
          'producturl'          => '"'.$product->getProductUrl().'"',
          'brand'        =>'"'. $feedHelper->getBrand($product).'"',
          'bigimage'        =>'"'. $mediaUrl . $product->getImage().'"',
          'additional_image_link' => '"'.join(",", $arrayImages).'"',
          'price'        => $price,
          'retailprice'   => $sale_price,
          'sku'          => '"'.$product->getSku().'"',
          'extracolor'        => '"'.$product->getAttributeText('color').'"',
          'description'  => '"'.$description.'"',
          'availability' => $availability,
          'categoryid1'  => '"'.$categoryid1.'"',
          'condition'    => '"new"',
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
    $tsvStr = Array(join("|", $headers));
    foreach($this->getProducts() as $product){
      $row = Array();
      foreach($headers as $key=>$h){
        $row[] = $product[$key];
      }
      $tsvStr[] = join("|", $row);
    }
    $this->getResponse()->setHeader('Content-type', 'text/comma-separated-values');
    $this->getResponse()->setBody(trim(join("\n", $tsvStr)));
  }

}

