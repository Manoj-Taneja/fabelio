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
                echo "<pre>"; print_r($_POST); echo "</pre>";
                exit;
                /**
                 * Perform any actions you want here
                 *
                 */
                $customFieldValue =  $this->_getRequest()->getPost('custom_field');

                /**
                 * Uncomment the line below to save the product
                 *
                 */
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