<?php
  require_once('simple_html_dom.php');
  error_reporting(E_ALL);
  require_once(getcwd() . '/../app/Mage.php');
  //Mage::setIsDeveloperMode(true);
  Mage::app();

  $product_collection = Mage::getResourceModel('catalog/product_collection')
    ->addAttributeToSelect('*')
    ->addAttributeToFilter(array(
      array(
        'attribute' => 'dimensions_image',
        'neq'       => NULL,
      ),  
    ))  
    //->addAttributeToFilter('type_id', @$_GET['prod_type'])
    //->setPageSize(10)
    //->addAttributeToFilter('name', array('like' => '%'. $productName .'%'))
    ->load();

  $products = $product_collection->toArray();
  //echo json_encode($products, JSON_PRETTY_PRINT);
  //die;


  $nodimensionsku = array(
    "success" => array(),
    "error"   => array(),
  );

  foreach($products as $product) {

    if(!$product['sku']) continue;
    if($product['dimension_length'] && $product['dimension_width'] && $product['dimension_height']) continue;

    $dim = str_get_html($product['dimensions_image']);
    $dimTxt = ''; 

    /*if($ul = $dim->find(".prod-dimension-list", 0)){
      if($li = $ul->find('li', 0)){
        if($span = $li->find('span', 0)){
          switch(strtolower($span->innertext)){
            case 'height':
              
              break;
            case 'height':
              break;
          }
        }
      }
    }*/

    if($li = $dim->find("li", 0)){
      if($span = $li->find("span", 1)){
        $dimTxt = $span->innertext;
      }
    }

  if($dimTxt){
      $dimension_piece=explode("x", $dimTxt);
      if(count($dimension_piece) > 2) {

        /*$l = trim($dimension_piece[0]);
        $w = trim($dimension_piece[1]);
        $h = trim($dimension_piece[2]);

        $model = Mage::getResourceModel('catalog/product_collection')->load($product['sku']);

        if(!$product['dimension_length']){
          $model->setDimensionLength(str_replace("cm" ,"" , $l));
        }

        if(!$product['dimension_width']){
          $model->setDimensionWidth(str_replace("cm" ,"" , $w));
        }

        if(!$product['dimension_height']){
          $model->setDimensionHeight(str_replace("cm" ,"" , $h));
        }*/

        //$model->save();


       $nodimensionsku['success'][] = array(
          "product" => $product,
          "dim" => array(
            "w" => $w,
            "h" => $h,
            "l" => $l,
          ),
        );
        continue;
      }
    }

    $nodimensionsku['error'][] = $product;


  }
  // uncommnet  this line to get errored sku count 
  foreach($nodimensionsku['error'] as $prod) {
    echo $prod['sku'];
    echo '<br>';
  }
  die;

  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title></title>
    <style>
    table {
      border-collapse: collapse;
    }
    td, th {
      border: 1px solid #ccc;
      padding: 2px 5px;
    }
    </style>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <td>SKU</td>
          <td>Dimension</td>
          <td>URL</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach($products as $product) {
          $dim = str_get_html($product['dimensions_image']);
          $dimTxt = $dim->find("li", 0)->find("span", 1)->innertext;
        ?>
        <tr>
  <td><?php echo $product['sku']; ?></td>
          <td><?php echo $dimTxt;
              $dimension_piece=explode("x",$dimTxt);
            ?></td>
          <td><a href="/index.php/an2/catalog_product/edit/store/0/id/<?php echo $product['id']; ?>">Edit</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <table>
      <thead>
        <tr>
          <td>Sku with No dimension</td>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </body>
  </html>


