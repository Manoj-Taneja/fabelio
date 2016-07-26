<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Customer
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Customer address controller
 *
 * @category   Mage
 * @package    Mage_Customer
 * @author      Magento Core Team <core@magentocommerce.com>
 */

require_once 'Mage/Customer/controllers/AddressController.php';
class Kellton_Customer_AddressController extends Mage_Customer_AddressController
{
    /**
     * Retrieve customer session object
     *
     * @return Mage_Customer_Model_Session
     */
    protected function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    public function preDispatch()
    {
        parent::preDispatch();

        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->setFlag('', 'no-dispatch', true);
        }
    }

    /**
     * Customer addresses list
     */
    public function indexAction()
    {
        if (count($this->_getSession()->getCustomer()->getAddresses())) {
            $this->loadLayout();
            $this->_initLayoutMessages('customer/session');
            $this->_initLayoutMessages('catalog/session');

            $block = $this->getLayout()->getBlock('address_book');
            if ($block) {
                $block->setRefererUrl($this->_getRefererUrl());
            }
            $this->renderLayout();
        } else {
            $this->getResponse()->setRedirect(Mage::getUrl('*/*/new'));
        }
    }

    public function editAction()
    {
        $this->_forward('form');
    }

    public function newAction()
    {
        $this->_forward('form');
    }

    /**
     * Address book form
     */
    public function formAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $navigationBlock = $this->getLayout()->getBlock('customer_account_navigation');
        if ($navigationBlock) {
            $navigationBlock->setActive('customer/address');
        }
        $this->renderLayout();
    }

    public function addressFormPostAction()
    {
       
        if (!$this->_validateFormKey()) {
           // return $this->_redirect('*/*/');
           $result['error'] = true;
        }
        // Save data
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest();
          // echo "<pre>"; print_r($data); echo "</pre>";
          //  var_dump($data);
           // exit;
            $customer = $this->_getSession()->getCustomer();
            /* @var $address Mage_Customer_Model_Address */
            $address  = Mage::getModel('customer/address');
            $addressId = $this->getRequest()->getParam('id');
            if ($addressId) {
                $existsAddress = $customer->getAddressById($addressId);
                if ($existsAddress->getId() && $existsAddress->getCustomerId() == $customer->getId()) {
                    $address->setId($existsAddress->getId());
                }
            }

            $errors = array();
            //var_dump($address);
            /* @var $addressForm Mage_Customer_Model_Form */
            $addressForm = Mage::getModel('customer/form');
            $addressForm->setFormCode('customer_address_edit')
                ->setEntity($address);
            $addressData    = $addressForm->extractData($this->getRequest());
           // echo "<pre>"; print_r($addressData); echo "</pre>";
            $addressData = $this->getRequest()->getPost('billing', array());
           // echo "<pre>"; print_r($addressData); echo "</pre>";
            $addressErrors  = $addressForm->validateData($addressData);
            
            if ($addressErrors !== true) {
                $result['error'] = true;
                $errors = $addressErrors;
            }
           

            try {
                $addressForm->compactData($addressData);
                $address->setCustomerId($customer->getId())
                    ->setIsDefaultBilling($this->getRequest()->getParam('default_billing', false))
                    ->setIsDefaultShipping($this->getRequest()->getParam('default_shipping', false));

                $addressErrors = $address->validate();
                if ($addressErrors !== true) {
                    $errors = array_merge($errors, $addressErrors);
                }
                
                if (count($errors) === 0) {
                    $address->save();
                    //$this->_getSession()->addSuccess($this->__('The address has been saved.'));
                    //$this->_redirectSuccess(Mage::getUrl('*/*/index', array('_secure'=>true)));
                    $result['error'] = false;
                    $result['success'] = true;
                    
                    $customer = Mage::getSingleton('customer/session')->getCustomer();
                    foreach ($customer->getAddresses() as $address):
                        $data = $address->toArray();
                    $address_array[]=$data;
                    endforeach;
                    $cart_response_template = Mage::getConfig()->getBlockClassName('core/template');
                $cart_response_template = new $cart_response_template;

                $cart_response_template->setTemplate('checkout/onepage/address_response_customer.phtml');
                      //echo "<pre>"; print_r($address_array); echo "</pre>";
                      //exit;
                      $no_of_addresses = count($address_array);
                      
                      $entity_id = $address_array[$no_of_addresses-1];
                      
                    $result['entity_id'] = $entity_id;   
                    $result['block_html']=$cart_response_template->toHtml();
                   // return;
                } else {
                    $this->_getSession()->setAddressFormData($this->getRequest()->getPost());
                    foreach ($errors as $errorMessage) {
                        $this->_getSession()->addError($errorMessage);
                    }
                }
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->setAddressFormData($this->getRequest()->getPost())
                    ->addException($e, $e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->setAddressFormData($this->getRequest()->getPost())
                    ->addException($e, $this->__('Cannot save address.'));
            }
        }
        
       // echo "<pre>"; print_r($errors); echo "</pre>";
        
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
       // return $this->_redirectError(Mage::getUrl('*/*/edit', array('id' => $address->getId())));
    }

    public function deleteAjaxAction()
    {
        $addressId = $this->getRequest()->getParam('id', false);
       // var_dump($addressId);
       // exit;
        if ($addressId) {
            $address = Mage::getModel('customer/address')->load($addressId);

            // Validate address_id <=> customer_id
            if ($address->getCustomerId() != $this->_getSession()->getCustomerId()) {
                //$this->_getSession()->addError($this->__('The address does not belong to this customer.'));
                $result['error']=true;
                $result['erroe_msg'] = $this->__('The address does not belong to this customer.');
                //$this->getResponse()->setRedirect(Mage::getUrl('*/*/index'));
                //return;
            }

            try {
                $address->delete();
                $result['error']=false;
                $result['success']=true;
                $result['success_msg']=$this->__('The address has been deleted.');
                $customer = Mage::getSingleton('customer/session')->getCustomer();
                
                
                 $cart_response_template = Mage::getConfig()->getBlockClassName('core/template');
                $cart_response_template = new $cart_response_template;

                $cart_response_template->setTemplate('checkout/onepage/address_response_customer.phtml');
                $result['block_html']=$cart_response_template->toHtml();
            } catch (Exception $e){
                $this->_getSession()->addException($e, $this->__('An error occurred while deleting the address.'));
            }
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
       
    }
    
    public function getAddressAjaxAction(){
        $addressId = $this->getRequest()->getParam('id', false);
        if($addressId){
            $address = Mage::getModel('customer/address')->load($addressId);
             if ($address->getCustomerId() != $this->_getSession()->getCustomerId()) {
                $result['error']=true;
                $result['erroe_msg'] = $this->__('The address does not belong to this customer.');
            }
            try{
             //   var_dump($address);
            $data = $address->toArray();
            //echo "<pre>"; print_r($data); echo "</pre>";
            $customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultBilling($customerAddressId);
            
            $result['success']=true;
            $result['error']=false;
            $result['address_id'] = $customerAddressId;
            $result['firstname'] = $data['firstname'];
            $result['lastname'] = $data['lastname'];
            $result['city'] = $data['city'];
            $result['country_id'] = $data['country_id'];
            $result['telephone'] = $data['telephone'];
            $result['region'] = $data['region'];
            $result['region_id'] = $data['region_id'];
            $result['street'] = $data['street'];
            $result['entity_id'] = $data['entity_id'];  
            $customer_address_selected = Mage::getSingleton('core/session')->setCustomerAddressSelected($data['entity_id']);
            }catch (Exception $e){
                $result['success']=false;
                $result['error']=true;
                $result['error_msg'] = $this->__('An error occurred while deleting the address.');
            }
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
    
    
}
