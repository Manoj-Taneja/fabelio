<?php

class Cminds_Supplierfrontendproductuploader_RegisterController extends Cminds_Supplierfrontendproductuploader_Controller_Action {
    protected $forceHeader = true;
    protected $forceFooter = true;
    public function preDispatch() {
        parent::preDispatch();
    }

    protected function _getSession(){
        return Mage::getSingleton('customer/session');
    }

    public function indexAction() {
        if(!Mage::getSingleton('customer/session')->isLoggedIn()) {
            if ($this->_getHelper()->canRegister()) {
                $this->_renderBlocks(true);
            } else {
                $this->getResponse()->setHeader('HTTP/1.1', '404 Not Found');
                $this->getResponse()->setHeader('Status', '404 File not found');
                $this->_forward('defaultNoRoute');
                return;
            }
        } else {
            $this->_redirect('*/index/');
            return;
        }
    }

    public function createPostAction()
    {
        if(!$this->_getHelper()->canRegister()) {
            $this->getResponse()->setHeader('HTTP/1.1','404 Not Found');
            $this->getResponse()->setHeader('Status','404 File not found');
            $this->_forward('defaultNoRoute');
            return;
        }

        $session = Mage::getSingleton('customer/session');
        if ($session->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
        $session->setEscapeMessages(true); // prevent XSS injection in user input
        if (!$this->getRequest()->isPost()) {
            $errUrl = Mage::getUrl('*/*/index', array('_secure' => true));
            $this->_redirectError($errUrl);
            return;
        }

        $customer = $this->_getCustomer();

        try {
            $errors = $this->_getCustomerErrors($customer);

            if (empty($errors)) {
                if(method_exists($customer, 'cleanPasswordsValidationData')) {
                    $customer->cleanPasswordsValidationData();
                }
                $customer->save();
                Mage::dispatchEvent('customer_register_success',
                    array('account_controller' => $this, 'customer' => $customer)
                );
                $this->_successProcessRegistration($customer);
                return;
            } else {
                $this->_addSessionError($errors);
            }
        } catch (Mage_Core_Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost());
            if ($e->getCode() === Mage_Customer_Model_Customer::EXCEPTION_EMAIL_EXISTS) {
                $url = Mage::getUrl('customer/account/forgotpassword');
                $message = $this->__('There is already an account with this email address. If you are sure that it is your email address, <a href="%s">click here</a> to get your password and access your account.', $url);
                $session->setEscapeMessages(false);
            } else {
                $message = $e->getMessage();
            }
            $session->addError($message);
        } catch (Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost())
                ->addException($e, $this->__('Cannot save the supplier.'));
        }
        $errUrl = Mage::getUrl('*/*/index', array('_secure' => true));
        $this->_redirectError($errUrl);
    }

    protected function _getCustomer()
    {
        $customer = Mage::registry('current_customer');
        if (!$customer) {
            $customer = Mage::getModel('customer/customer')->setId(null);
        }
        $customer->getGroupId();

        return $customer;
    }

    protected function _getCustomerErrors($customer)
    {
        $errors = array();
        $request = $this->getRequest();
        if ($request->getPost('create_address')) {
            $errors = $this->_getErrorsOnCustomerAddress($customer);
        }
        $customerForm = $this->_getCustomerForm($customer);
        $customerData = $customerForm->extractData($request);
        $customerErrors = $customerForm->validateData($customerData);
        if ($customerErrors !== true) {
            $errors = array_merge($customerErrors, $errors);
        } else {
            $customerForm->compactData($customerData);
            $customer->setPassword($request->getPost('password'));
            $customer->setPasswordConfirmation($request->getPost('confirmation'));
            $customerErrors = $customer->validate();
            if (is_array($customerErrors)) {
                $errors = array_merge($customerErrors, $errors);
            }
        }
        return $errors;
    }

    protected function _getCustomerForm($customer)
    {
        $customerForm = Mage::getModel('customer/form');
        $customerForm->setFormCode('customer_account_create');
        $customerForm->setEntity($customer);
        return $customerForm;
    }

    protected function _addSessionError($errors)
    {
        $session = $this->_getSession();
        $session->setCustomerFormData($this->getRequest()->getPost());

        if (is_array($errors)) {
            foreach ($errors as $errorMessage) {
                $session->addError($errorMessage);
            }
        } else {
            $session->addError($this->__('Invalid customer data'));
        }
    }

    protected function _successProcessRegistration(Mage_Customer_Model_Customer $customer)
    {
        $session = $this->_getSession();
        if ($customer->isConfirmationRequired()) {
            $store = Mage::app()->getStore();
            $customer->sendNewAccountEmail(
                'confirmation',
                $session->getBeforeAuthUrl(),
                $store->getId()
            );
            $customerHelper = $this->_getHelper('customer');
            $session->addSuccess($this->__('Account confirmation is required. Please, check your email for the confirmation link. To resend the confirmation email please <a href="%s">click here</a>.',
                $customerHelper->getEmailConfirmationUrl($customer->getEmail())));
            $url = Mage::getUrl('*/index/index', array('_secure' => true));
        } else {
            $session->setCustomerAsLoggedIn($customer);
            $url = $this->_welcomeCustomer($customer);
        }
        $this->_redirectSuccess($url);
        return $this;
    }

    protected function _welcomeCustomer(Mage_Customer_Model_Customer $customer, $isJustConfirmed = false)
    {
        $this->_getSession()->addSuccess(
            $this->__('Thank you for registering with %s.', Mage::app()->getStore()->getFrontendName())
        );

        $customer->sendNewAccountEmail(
            $isJustConfirmed ? 'confirmed' : 'registered',
            '',
            Mage::app()->getStore()->getId()
        );

        $successUrl = Mage::getUrl('*/index/index', array('_secure' => true));
        if ($this->_getSession()->getBeforeAuthUrl()) {
            $successUrl = $this->_getSession()->getBeforeAuthUrl(true);
        }
        return $successUrl;
    }

}
