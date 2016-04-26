<?php
class Fareye_Potrack_Model_Observer  {

    public  function call_fareye($base_url, $api_key, $method = 'GET', $json_data) {
      echo "Calling URL:<br>".$base_url.'?api_key='.$api_key."<br>".$method;
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); 
      curl_setopt($curl, CURLOPT_URL, $base_url.'?api_key='.$api_key); 
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      if (strcmp($method, 'POST')==0) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
      }
      $result = curl_exec($curl);
      curl_close($curl);
      var_dump($result);
      $response = json_decode($result,true);
      return $response;
    }
  
    public function postpodatafareye($observer) {
  
      Mage::log('We just made an Observer!');
      $event = $observer->getEvent();
      $action=$event->getAction();
      $poid=$event->getPurchaseOrderId();
      $_po = Mage::getModel('inventorypurchasing/purchaseorder')->load($poid);
      $purchaseorderProductItem = Mage::getModel('inventorypurchasing/purchaseorder_product')
        ->getCollection()
        ->addFieldToFilter('purchase_order_id', $poid)
        ->toArray();
      $supplierModel = Mage::getModel('inventorypurchasing/supplier')->load($_po->getData('supplier_id'));

      $baseUrl=Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
      if($_po->getData('comments') == NULL){
          $finalcomment= " ";
      }else{
        $finalcomment = $_po->getData('comments');
      }
      $poSup = array(
        "supplier_name"   => $supplierModel->getData('supplier_name'),
        "supplier_address"=> $supplierModel->getData('street').', '.$supplierModel->getData('city').', '.$supplierModel->getData('state'),
        "supplier_contact"=> $supplierModel->getData('telephone'),
        "comments"        => $finalcomment,
        "city"            => $supplierModel->getData('city'),
        "branch"          => $supplierModel->getData('city'),
        "order_number"    => $poid,
        "po_date"         => date('Y-M-d', strtotime($_po->getData('purchase_on'))),
      );

      $fareyeResult = array();
      foreach($purchaseorderProductItem['items'] as $item){
        $_product = Mage::getModel('catalog/product')->load($item['product_id']);
        $processData = array_merge($poSup, array(
          "item_name"       => $_product->getName(),
          "quantity"        => $item['qty'],
          "item_image"      => $baseUrl.'catalog/product'.$_product->getImage(),
          "item_dimension"  => $_product->getData('dimension_height') . '(H) X ' . $_product->getData('dimension_width') . '(W) X ' . $_product->getData('dimension_length') . '(L)',
        ));
    //    for($i=1; $i <= $item['qty']; $i++) {
          $fareyeResult[] = array(
            'referenceNumber' => $poid.'_'.$item['product_sku'],
            "processDefinitionCode"=> "quality_check",
            "processData" => $processData,
            "processUserMappings" => array(
              array (
                "flowCode"=> "qc1",
                "cityCode"=> "Delhi",
                "branchCode"=> "dels",
                "employeeCode"=> "9300_fareye",
              ),
              array (
                "flowCode"=> "qc2",
                "cityCode"=> "Delhi",
                "branchCode"=> "dels",
                "employeeCode"=> "9300_fareye",
              ),
              array (
                "flowCode"=> "qc3",
                "cityCode"=> "Delhi",
                "branchCode"=> "dels",
                "employeeCode"=> "9300_fareye",
              ),
            ),
          );
      //  }
      }

      /*
      echo '<pre>';
      print_r($fareyeResult);
      echo '</pre>';

      die;
      */

      $po_json_data=json_encode($fareyeResult); 

   

      $fareye_base_url="https://www.fareye.co";
      $fareye_api_key="KwB1JuWgGJMpZ1UQD75Ez0WGXaad4vlI";
     
      switch($action){
          //$case==0  call the add API of fareye
       case 0:
          $response_from_fareye =$this->call_fareye($fareye_base_url.'/api/v1/process', $fareye_api_key, 'POST', $po_json_data);
         break;
          ///case== 1 call the edit API of fareye
       case 1:
         $response_from_fareye =$this->call_fareye($fareye_base_url.'/api/v1/process/update', $fareye_api_key, 'POST', $po_json_data);
          break;
       }
      Mage::log($po_json_data);
      Mage::log($response_from_fareye); 
    }  
}
