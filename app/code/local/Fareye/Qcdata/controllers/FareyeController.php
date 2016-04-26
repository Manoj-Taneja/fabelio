<?php
class Fareye_Qcdata_FareyeController extends Mage_Core_Controller_Front_Action {
  public function indexAction() {

    if(Mage::getStoreConfig("fareye_qcdata/api/key") != $this->getRequest()->getParam('api_key')) {
      $this->norouteAction();
      return;
    }

    $post=Mage::app()->getRequest()->getParams();
    $json = file_get_contents('php://input'); 


    if(empty($post)) {
      $this->norouteAction();
      return;
    }

    $data=json_encode($json);

    $write = Mage::getSingleton("core/resource")->getConnection("core_write");
    $write->insert(
      "fareye_qcdata_data", 
      array("data" => $data)
    );
    Mage::log("----We have inserted into fareye_qcdata_data table---------------");
    Mage::log($data);
//    Mage::log(Mage::getModel('inventorypurchasing/purchaseorder')->load(342)->getData());

     $this->postProcess($json); 

  }

  public function postProcess($json)
  {
    //  Mage::log("-----we are post process---"); 
      $postjson = json_decode($json,true);
      $poid =  explode("_", $postjson['referenceNumber'])[0];
      $pomodel = Mage::getModel('inventorypurchasing/purchaseorder')->load($poid);
//      $pomodel->setStatus(8)->save();       
      //----This  'if statement' is for inserting data of QC3 stage only---- 
      if($postjson['jobType'] == "quality check 3")
      {
          Mage::log("-----we are post process---");
          $write = Mage::getSingleton("core/resource")->getConnection("core_write");
          $sku  =  explode("_", $postjson['referenceNumber'])[1];
          //$poid =  explode("_", $postjson['referenceNumber'])[0];
          Mage::log($poid);
          Mage::log($postjson['referenceNumber']);
          Mage::log($sku);
          Mage::log($postjson['status']);
        /*  $write->insert(
                  "fareye_qcdata_postdata", 
                  array
                   (
                    "purchaseorder_id"  => $poid ,
                    "fareye_refernceno" => $postjson['referenceNumber'],
                    "sku"               => $sku , 
                    "qc_status"         => $postjson['status'] 
                //    "comment"           => $postjson['comments']
                    )
                      );
         */
          $write->insert(
            "fareye_qcdata_postdata", 
            array 
            ( 
              "purchaseorder_id"  => $poid ,  
              "fareye_referenceno" => $postjson['referenceNumber'],
              "sku"               => $sku , 
              "qc_status"         => $postjson['status'] 
            ) 
             ); 
          Mage::log("----successfully inserted QC3 data into fareye_qcdata_postdata------");   
          
          
          //--get the count of sku in a PO
          $poitemlist= Mage::getModel('inventorypurchasing/purchaseorder_product')
              ->getCollection()
              ->addFieldToFilter('purchase_order_id', $poid)
              ->toArray(); 
          $totalItemsInPO=count($poitemlist['items']);
         
          //--get the count of QC3  passed sku
          $read = Mage::getSingleton('core/resource')->getConnection('core_read'); 
          $query = 'SELECT count(distinct sku) from fareye_qcdata_postdata where purchaseorder_id ='.$poid ;
          $qc3SkuCount = $read->fetchOne($query);

          //--load PO_model--

      //    $pomodel = Mage::getModel('inventorypurchasing/purchaseorder')->load($poid);
        //  Mage::log(get_class_methods($pomodel));

         //--update the  status of PO
          if(  $totalItemsInPO   ==  $qc3SkuCount)
          {
            //update "Awaiting delivery" status
            $pomodel->setStatus(5)->save();
          }
          elseif( $totalItemsInPO  >  $qc3SkuCount)
          {
            //update "Partially Qced"" status
            $pomodel->setStatus(9)->save();

          }
       


          Mage::log('----------Successfully reached--------------');

      }
  }

}
