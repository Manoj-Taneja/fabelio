<?php
  
class Kellton_Customtabs_Model_Observer
{
    /**
     * Flag to stop observer executing more than once
     *
     * @var static bool
     */
    static protected $_singletonFlag = false;

    /**
     * This method will run when the product is saved from the Magento Admin
     * Use this function to update the product model, process the 
     * data or anything you like
     *
     * @param Varien_Event_Observer $observer
     */
    public function saveProductTabData(Varien_Event_Observer $observer)
    {
        if (!self::$_singletonFlag) {
            self::$_singletonFlag = true;
             
            $product = $observer->getEvent()->getProduct();
         
            try {
                $write = Mage::getSingleton('core/resource')->getConnection('core_write');
                $table = Mage::getSingleton('core/resource')->getTableName('matrixrate_shipping/matrixrate');
                //if()
                
                /**
                 * Perform any actions you want here
                 *
                 */
                $fee_enabled =  $this->_getRequest()->getPost('fee_enabled');
                $express_number_of_days = $this->_getRequest()->getPost('express_number_of_days');
                $express_fees =  $this->_getRequest()->getPost('express_fees');
                $standard_number_of_days = $this->_getRequest()->getPost('standard_number_of_days');
                $standard_fees = $this->_getRequest()->getPost('standard_fees');
                $sku = $this->_getRequest()->getPost('sku');
                //echo "<pre>"; print_r($_POST); echo "</pre>";
                //exit;
                
                $matrixrate_helper = Mage::helper('matrixrate');
                //var_dump($matrixrate_helper);
                $sku_data = $matrixrate_helper->get_sku_data($sku);
                $product_id = Mage::registry('current_product')->getId();
                $_product= Mage::getModel('catalog/product')->load($product_id);
                if(!empty($sku) && count($sku_data) > 0){
                    $query_express = 'update '.$table.' set express_fee_enabled = '.$fee_enabled.' , express_number_of_days = '.$express_number_of_days.' , price = '.$express_fees.' where sku = "'.$sku.'" and delivery_type = "Express"';
                    $write->query($query_express);
                    
                    $query_standard = 'update '.$table.' set express_fee_enabled = 0 , standard_number_of_days = '.$standard_number_of_days.' , price = '.$standard_fees.' where sku = "'.$sku.'" and delivery_type = "Standard"';                    
                    $write->query($query_standard);
                }else{
                    
                    $sku = $_product->getSku();
                    $query_express = 'insert into '.$table.' set website_id = "1", dest_country_id = "IN",  express_fee_enabled = '.$fee_enabled.' , standard_number_of_days = '.$express_number_of_days.' , price = '.$express_fees.' , sku = "'.$sku.'" , delivery_type = "Express" ';
                    $write->query($query_express);
                    
                    
                    $query_standard = 'insert into '.$table.' set website_id = "1", dest_country_id = "IN", express_fee_enabled = 0 , standard_number_of_days = '.$standard_number_of_days.' , price = '.$standard_fees.' , sku = "'.$sku.'" , delivery_type = "Standard" ';
                    $write->query($query_standard);
                }
                
                
                /**
                 * Uncomment the line below to save the product
                 *
                 */
                //$_product->setDeliveryTime($express_number_of_days);
                //$product->save();
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
    }
      
    /**
     * Retrieve the product model
     *
     * @return Mage_Catalog_Model_Product $product
     */
    public function getProduct()
    {
        return Mage::registry('product');
    }
     
    /**
     * Shortcut to getRequest
     *
     */
    protected function _getRequest()
    {
        return Mage::app()->getRequest();
    }
}