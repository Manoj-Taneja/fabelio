<?php
class Mage_Shipping_Model_Carrier_Flatrate
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
 
    protected $_code = 'flatrate';
    protected $_isFixed = true;
 
    /**
     * Enter description here...
     *
     * @param Mage_Shipping_Model_Rate_Request $data
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request, $id=array())
    {
        //echo $id;
        if (!$this->getConfigFlag('active')) {
            return false;
        }
       
        $freeBoxes = 0;
        if ($request->getAllItems()) {
            foreach ($request->getAllItems() as $item) {
 
                if ($item->getProduct()->isVirtual() || $item->getParentItem()) {
                    continue;
                }
 
                if ($item->getHasChildren() && $item->isShipSeparately()) {
                    foreach ($item->getChildren() as $child) {
                        if ($child->getFreeShipping() && !$child->getProduct()->isVirtual()) {
                            $freeBoxes += $item->getQty() * $child->getQty();
                        }
                    }
                } elseif ($item->getFreeShipping()) {
                    $freeBoxes += $item->getQty();
                }
            }
        }
        $this->setFreeBoxes($freeBoxes);
 
        $result = Mage::getModel('shipping/rate_result');
        if ($this->getConfigData('type') == 'O') { // per order
           
        } elseif ($this->getConfigData('type') == 'I') { // per item
          
        } else {
          
        }
        if ($shippingPrice !== false) {
            $method = Mage::getModel('shipping/rate_result_method');
             if(isset($id) && !empty($id)){
            $shippingPrice = $this->get_pro_ship($id);
            $this->setConfig("carriers/{$this->_code}/price", $shippingPrice);
            
        }else if($shippingPrice == ""){
            
           $shippingPrice_array = Mage::getSingleton('core/session')->getShippingAmount();
           $shippingPrice = array_sum($shippingPrice_array);
          
        }
        
            $method->setCarrier('flatrate');
            $method->setCarrierTitle($this->getConfigData('title'));
 
            $method->setMethod('flatrate');
            $method->setMethodTitle($this->getConfigData('name'));
 
            if ($request->getFreeShipping() === true || $request->getPackageQty() == $this->getFreeBoxes()) {
              //  $shippingPrice = '0.00';
            }
            
            $method->setPrice($shippingPrice);
            $method->setCost($shippingPrice); 
                       
            $result->append($method);
            
            $address = Mage::getSingleton('checkout/session')->getQuote()->getShippingAddress();
            $address_id = $address->getID();
            
            Mage::getSingleton('checkout/session')->getQuote()->getShippingAddress()->setShippingAmount($method->getPrice());
            Mage::getSingleton('checkout/session')->getQuote()->save();
            
            
        }
       
        return $result;
    }
 
    public function getAllowedMethods()
    {
        return array('flatrate'=>$this->getConfigData('name'));
    }
     
    public function get_pro_ship($id)
    {
       // echo "<pre>"; print_r($id); echo "</pre>";
        //exit;
        $matrixrate_helper = Mage::helper('matrixrate');
        Mage::getSingleton('core/session', array('name'=>'frontend'));
        $session = Mage::getSingleton('checkout/session');
        
       /// $shipping_amount_session = Mage::getSingleton('core/session')->getShippingAmount();
        //$shipping_description = Mage::getSingleton('core/session')->getShippingDescription();
        $shipping_amount_session = array();
        $shipping_description = array();
        $cart_items = $session->getQuote()->getAllItems();
        $_helper = Mage::helper('catalog/output');
        $read = Mage::getSingleton('core/resource')->getConnection('core_read');
        $table = Mage::getSingleton('core/resource')->getTableName('matrixrate_shipping/matrixrate');
        //$select = "SELECT  * from {$table} where pk =".$id;
        //$row = $read->fetchAll($select);
        $custom_ship=0;
        
       /* $id_rev=array();
        foreach($id as $key=>$val){
           $id_rev[$val] = $key; 
        }*/
       // echo "<pre>"; print_r($id); echo "</pre>";
       // exit;
        foreach( $cart_items as $items ){
            $item_id = $items->getID();
            $product_id = $items->getProductID();
           $custom_ship =0;
            if(array_key_exists($product_id,$id)){
                $data =  $matrixrate_helper->give_option_array($id[$product_id]);
                
               //echo "<pre>"; print_r($data); echo "</pre>";
                if(count($data) > 0){
                    $custom_ship =$custom_ship + (($items->getQty())*($data['0']['price'])); 
                    $shipping_amount_session[$product_id]=$custom_ship;
                    $shipping_description[$items->getID()] = $data['0']['pk'];
                }else{
                     $shipping_amount_session[$product_id]=0;
                    $shipping_description[$items->getID()] = '';
                }
            }
            
           /* if($items->getSku()==$row['0']['sku']){
                $custom_ship +=($items->getQty())*($row['0']['price']); 
               
                $shipping_amount_session[$items->getID()]=$custom_ship;
                $shipping_description[$items->getID()] = $row['0']['pk'];
                
            }else{
                $shipping_description[$items->getID()] = 0;
            }*/

        }
        
       // echo "<pre>"; print_r($shipping_amount_session); echo "</pre>";
       // exit;
        Mage::getSingleton('core/session')->setShippingAmount($shipping_amount_session);
        Mage::getSingleton('core/session')->setShippingDescription($shipping_description);
        $shippingPrice_array = Mage::getSingleton('core/session')->getShippingAmount();
        $shippingPrice = array_sum($shippingPrice_array);
        return $shippingPrice ;
    }
    
    
    
    
    public function get_pro_ship_two()
    {
        Mage::getSingleton('core/session', array('name'=>'frontend'));
        $session = Mage::getSingleton('checkout/session');
        $cart_items = $session->getQuote()->getAllItems();
        $_helper = Mage::helper('catalog/output');
        $read = Mage::getSingleton('core/resource')->getConnection('core_read');
        $table = Mage::getSingleton('core/resource')->getTableName('matrixrate_shipping/matrixrate');
        
        $custom_ship=0;
        foreach( $cart_items as $items ){
            $select = "SELECT  * from {$table} where sku ='{$items->getSku()}' and delivery_type='Express'";
            $row = $read->fetchAll($select);
            if($items->getSku()==$row['0']['sku']){
                $custom_ship +=($items->getQty())*($row['0']['price']);       
            }

        }
        return $custom_ship ;
    }
}
