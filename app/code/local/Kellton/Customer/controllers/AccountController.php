<?php

require_once 'Mage/Customer/controllers/AccountController.php';

    class Kellton_Customer_AccountController extends Mage_Customer_AccountController{
        
        
       /* public function indexAction(){
            echo "TEST";
            exit;
        }
        
        public function checkAction(){
            echo " !! I am called !!";
            exit;
        }
        
        public function loginAction(){
            echo "Login Action";
            exit;
        }*/
        
        public function loginPostAjaxAction(){
            
            if (!$this->_validateFormKey()) {
                $this->_redirect('*/*/');
                return;
            }
            
            $session = $this->_getSession();
            if ($this->getRequest()->isPost()) {
            $login = $this->getRequest()->getPost('login');
            if (!empty($login['username']) && !empty($login['password'])) {
                try {
                    $session->login($login['username'], $login['password']);
                    if ($session->getCustomer()->getIsJustConfirmed()) {
                        parent::_welcomeCustomer($session->getCustomer(), true);
                    }
                    $result['error']=false;
                    $result['success']=true;
                    $result['message']='logged in';
                    
                } catch (Mage_Core_Exception $e) {
                    switch ($e->getCode()) {
                        case Mage_Customer_Model_Customer::EXCEPTION_EMAIL_NOT_CONFIRMED:
                            $value = parent::_getHelper('customer')->getEmailConfirmationUrl($login['username']);
                            $message = parent::_getHelper('customer')->__('This account is not confirmed. <a href="%s">Click here</a> to resend confirmation email.', $value);
                             $result['error'] = true;
                             $result['success']=flase;
                            $result['message'] = 'email not confirmed';
                            break;
                        case Mage_Customer_Model_Customer::EXCEPTION_INVALID_EMAIL_OR_PASSWORD:
                            $result['error'] = true;
                            $result['success']=false;
                            $result['message'] = 'invalid password';
                            $message = $e->getMessage();
                            break;
                        default:
                            $message = $e->getMessage();
                    }
                    $session->addError($message);
                    $session->setUsername($login['username']);
                } catch (Exception $e) {
                    // Mage::logException($e); // PA DSS violation: this exception log can disclose customer password
                }
            } else {
                $session->addError($this->__('Login and password are required.'));
            }
        }
       // echo "Message : ".$message;
       // exit;
        
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
        
        
    public function forgotPasswordPostAjaxAction(){
                
        $email = (string) $this->getRequest()->getPost('email');
        if ($email) {
            if (!Zend_Validate::is($email, 'EmailAddress')) {
                $this->_getSession()->setForgottenEmail($email);
                $result['error'] = true;
                $result['success'] = false;
                $result['message'] = 'Invalid email address.';
            }

            /** @var $customer Mage_Customer_Model_Customer */
            $customer = $this->_getModel('customer/customer')
                ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                ->loadByEmail($email);

            if ($customer->getId()) {
                try {
                    $newResetPasswordLinkToken =  $this->_getHelper('customer')->generateResetPasswordLinkToken();
                    $customer->changeResetPasswordLinkToken($newResetPasswordLinkToken);
                    $customer->sendPasswordResetConfirmationEmail();
                    $result['error'] = false;
                     $result['success'] = true;
                     $result['message'] =  $this->_getHelper('customer')
                ->__('If there is an account associated with %s you will receive an email with a link to reset your password.',
                    $this->_getHelper('customer')->escapeHtml($email));
                } catch (Exception $exception) {
                    $this->_getSession()->addError($exception->getMessage());
                     $result['error'] = true;
                     $result['success'] = false;
                     $result['message'] = $exception->getMessage();
                    
                }
            }
                     
        } else {
                $result['error'] = true;
                $result['success'] = false;
                $result['message'] = 'Please enter your email.';
           
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
                
    }

        
    }
