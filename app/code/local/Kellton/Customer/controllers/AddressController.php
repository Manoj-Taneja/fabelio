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
                    $this->_getSession()->addSuccess($this->__('The address has been saved.'));
                    //$this->_redirectSuccess(Mage::getUrl('*/*/index', array('_secure'=>true)));
                    $result['error'] = false;
                    $result['success'] = true;
                    
                    $customer = Mage::getSingleton('customer/session')->getCustomer();
                    $block_html .= '';
                    foreach ($customer->getAddresses() as $address):
                        $data = $address->toArray();
                    //echo "<pre>"; print_r($data); echo "</pre>";
                    
                    $block_html .= '<div class="checkout-box-inner-address" id="inner_address_'.$data['entity_id'].'">';
                    $block_html .= '<div class="checkout-address-fill">
                          <label>'.$data['firstname']. " ". $data['lastname'].'</label>
                          <img width="25" data-target="#myAddress-'.$data['entity_id'].'" data-toggle="modal" src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/smartwave/porto/images/card-edit.svg">
                          <img width="25" data-target="#deleteaddress" data-toggle="modal" src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/smartwave/porto/images/card-delete.svg">
                        </div>

                        <div class="checkout-address-fill">
                          <label>'.$data['street'].','.$data['region'].', '.$data['city'].'</label>
                        </div>
                        <div class="checkout-address-fill">
                          <label>'.$data['telephone'].'</label>
                        </div>'; 
                    $block_html .= '</div>';
                    $block_html .= '<div class="modal fade checkout-address-main" id="myAddress-'.$data['entity_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <form name="address_form_'.$data['entity_id'].'" id="address_form_'.$data['entity_id'].'" method="post" action="javascript://">
                        <div class="modal-body">
                          <button type="button" id="close-'.$data['entity_id'].'" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h3>Masukkan alamat baru Anda!</h3>
                          <div class="checkout-form-popup-main">


                          <div class="checkout-form-popup">
                              <label>Name Depan</label>
                              <input type="text" name="billing[firstname]" id="first_name_'.$data['entity_id'].'" placeholder="Masukkan Nama Depan" value="'.$data['firstname'].'" />
                          </div>
                          <div class="checkout-form-popup">
                              <label>Nama Belakang</label>
                              <input type="text" name="billing[lastname]" id="first_name_'.$data['entity_id'].'" placeholder="Masukkan nama Belakang" value="'.$data['lastname'].'" />
                          </div>
                          </div>

                          <div class="checkout-form-popup-main">


                          <div class="checkout-form-popup">
                              <label>Alamat</label>
                              <input type="text" name="billing[street]" placeholder="Alamat" value="'.$data['street'].'"/>
                          </div>';
                    $block_html .= '<div class="checkout-form-popup">
                              <label>Negara</label>';

                              $_countries = Mage::getResourceModel('directory/country_collection')->loadByStore()->toOptionArray(false);
                            if (count($_countries) > 0):
                              $block_html .=  '<select name="billing[country_id]" id="billing:country_id" class="validate-select"><option value="">Please choose a country...</option>';
                                    foreach($_countries as $_country):
                                        
                                    if($data['country_id']==$_country['value']){ $selected = "selected='selected'";}
                                      $block_html .= '  <option value="'.$_country['value'].'" '.$selected.'>'.$_country['label'].'</option>';
                                    endforeach;
                               $block_html .= ' </select>';
                             endif; 
                             
                             
                             
                             
                          $block_html .= '</div>
                          <div class="checkout-form-popup custom-select-icon">
                              <label>Provinsi</label>';
                              $regionCollection = Mage::getModel('directory/region_api')->items('ID');
                             $block_html.='<select name="billing[region_id]" id="region_'.$data['entity_id'].'" >
                                  <option value="">Pilih provinsi</option>';
                             foreach($regionCollection as $region):
                                 $region_obj =  Mage::getModel('directory/region')->load($region['region_id']);
                                 $region_name = $region_obj->getName();
                                  if($region['region_id']==$data['region_id']){
                                      $region_selected = "selected='selected'";
                                  }else{
                                      $region_selected = "";
                                  }
                             $block_html .= '<option value="'.$region['region_id'].'" '.$region_selected.'>'.$region_name.'</option>';     
                             endforeach;
                         $block_html .=' </div>
                          <div class="checkout-form-popup custom-select-icon">
                              <label>Kota</label>
                              <input type="text" name="billing[city]" id="city_'.$data['entity_id'].'" placeholder="Kota" value="'.$data['city'].'" />
                          </div>
                          </div>

                          <div class="checkout-form-popup-main">


                          <div class="checkout-form-popup">
                              <label>Nomor HP</label>
                              <input type="text" placeholder="Nomor HP" name="billing[telephone]" id="phone_'.$data['entity_id'].'" value="'.$data['telephone'].'"/>
                          </div>

                          </div>



                      </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="address_no_'.$data['entity_id'].'" value="'.$data['entity_id'].'" />
                            <input type="hidden" value="'.Mage::getSingleton('core/session')->getFormKey().'" name="form_key">
                            <input type="hidden" id="billing:address_id" value="'.$data['entity_id'].'" name="billing[address_id]">
                            <input type="hidden" name="billing[use_for_shipping]" value="1" />
                        <input name="context" type="hidden" value="checkout" />
                          <button type="button" class="btn btn-default save-address" rel="'.$data['entity_id'].'" >Simpan Alamat Ini</button>
                        </div>
                          </form>
                      </div>
                    </div>
                  </div>';
                      endforeach;
                      $block_html .= '<div class="checkout-box-inner">
                      <div class="checkout-plus-icon-main">
                      <div class="checkout-plus-icon checkout-plus-icon-new">
                          <img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/smartwave/porto/images/icon-add-white.svg" data-toggle="modal" data-target="#myAddress">
                      </div>
                    </div>
                      <label>Tambah Alamat Baru </label>

                    </div>';
                    $result['block_html']=$block_html;
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
                    $block_html .= '';
                    foreach ($customer->getAddresses() as $address):
                        $data = $address->toArray();
                    //echo "<pre>"; print_r($data); echo "</pre>";
                    
                    $block_html .= '<div class="checkout-box-inner-address" id="inner_address_'.$data['entity_id'].'">';
                    $block_html .= '<div class="checkout-address-fill">
                          <label>'.$data['firstname']. " ". $data['lastname'].'</label>
                          <img width="25" data-target="#myAddress-'.$data['entity_id'].'" data-toggle="modal" src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/smartwave/porto/images/card-edit.svg">
                          <img width="25" data-target="#deleteaddress" rel='.$data['entity_id'].' data-toggle="modal" src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/smartwave/porto/images/card-delete.svg">
                        </div>

                        <div class="checkout-address-fill">
                          <label>'.$data['street'].','.$data['region'].', '.$data['city'].'</label>
                        </div>
                        <div class="checkout-address-fill">
                          <label>'.$data['telephone'].'</label>
                        </div>'; 
                    $block_html .= '</div>';
                    $block_html .= '<div class="modal fade checkout-address-main" id="myAddress-'.$data['entity_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <form name="address_form_'.$data['entity_id'].'" id="address_form_'.$data['entity_id'].'" method="post" action="javascript://">
                        <div class="modal-body">
                          <button type="button" id="close-'.$data['entity_id'].'" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h3>Masukkan alamat baru Anda!</h3>
                          <div class="checkout-form-popup-main">


                          <div class="checkout-form-popup">
                              <label>Name Depan</label>
                              <input type="text" name="billing[firstname]" id="first_name_'.$data['entity_id'].'" placeholder="Masukkan Nama Depan" value="'.$data['firstname'].'" />
                          </div>
                          <div class="checkout-form-popup">
                              <label>Nama Belakang</label>
                              <input type="text" name="billing[lastname]" id="first_name_'.$data['entity_id'].'" placeholder="Masukkan nama Belakang" value="'.$data['lastname'].'" />
                          </div>
                          </div>

                          <div class="checkout-form-popup-main">


                          <div class="checkout-form-popup">
                              <label>Alamat</label>
                              <input type="text" name="billing[street]" placeholder="Alamat" value="'.$data['street'].'"/>
                          </div>';
                    $block_html .= '<div class="checkout-form-popup">
                              <label>Negara</label>';

                              $_countries = Mage::getResourceModel('directory/country_collection')->loadByStore()->toOptionArray(false);
                            if (count($_countries) > 0):
                              $block_html .=  '<select name="billing[country_id]" id="billing:country_id" class="validate-select"><option value="">Please choose a country...</option>';
                                    foreach($_countries as $_country):
                                        
                                    if($data['country_id']==$_country['value']){ $selected = "selected='selected'";}
                                      $block_html .= '  <option value="'.$_country['value'].'" '.$selected.'>'.$_country['label'].'</option>';
                                    endforeach;
                               $block_html .= ' </select>';
                             endif; 
                          $block_html .= '</div>
                          <div class="checkout-form-popup custom-select-icon">
                              <label>Provinsi</label>
                              <input type="text" name="billing[region]" id="region_'.$data['entity_id'].'" placeholder="Provinsi" value="'.$data['region'].'" />
                          </div>
                          <div class="checkout-form-popup custom-select-icon">
                              <label>Kota</label>
                              <input type="text" name="billing[city]" id="city_'.$data['entity_id'].'" placeholder="Kota" value="'.$data['city'].'" />
                          </div>
                          </div>

                          <div class="checkout-form-popup-main">


                          <div class="checkout-form-popup">
                              <label>Nomor HP</label>
                              <input type="text" placeholder="Nomor HP" name="billing[telephone]" id="phone_'.$data['entity_id'].'" value="'.$data['telephone'].'"/>
                          </div>

                          </div>



                      </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="address_no_'.$data['entity_id'].'" value="'.$data['entity_id'].'" />
                            <input type="hidden" value="'.Mage::getSingleton('core/session')->getFormKey().'" name="form_key">
                            <input type="hidden" id="billing:address_id" value="'.$data['entity_id'].'" name="billing[address_id]">
                            <input type="hidden" name="billing[use_for_shipping]" value="1" />
                        <input name="context" type="hidden" value="checkout" />
                          <button type="button" class="btn btn-default save-address" rel="'.$data['entity_id'].'" >Simpan Alamat Ini</button>
                        </div>
                          </form>
                      </div>
                    </div>
                  </div>';
                      endforeach;
                      $block_html .= '<div class="checkout-box-inner">
                      <div class="checkout-plus-icon-main">
                      <div class="checkout-plus-icon checkout-plus-icon-new">
                          <img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/smartwave/porto/images/icon-add-white.svg" data-toggle="modal" data-target="#myAddress">
                      </div>
                    </div>
                      <label>Tambah Alamat Baru </label>

                    </div>';
                    $result['block_html']=$block_html;
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
            $customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultBilling();
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
            }catch (Exception $e){
                $result['success']=false;
                $result['error']=true;
                $result['error_msg'] = $this->__('An error occurred while deleting the address.');
            }
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
    
    
}
