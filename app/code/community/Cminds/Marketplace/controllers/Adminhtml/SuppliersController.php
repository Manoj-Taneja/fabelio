<?php
class Cminds_Marketplace_Adminhtml_SuppliersController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction() {
        $this->_title($this->__('Suppliers'));
        $this->loadLayout();
        $this->_setActiveMenu('suppliers');
        $this->_addContent($this->getLayout()->createBlock('marketplace/adminhtml_supplier_list'));
        $this->renderLayout();
    }
    public function soldProductsAction() {
        $this->_title($this->__('Customers'))->_title($this->__('Manage Customers'));

        $customerId = $this->getRequest()->getParam('id');
        $customer = Mage::getModel('customer/customer');

        if ($customerId) {
            $customer->load($customerId);
        }

        Mage::register('current_customer', $customer);

        $this->loadLayout();
        $this->getLayout()->getBlock('admin.customer.view.edit.cart');
        $this->renderLayout();
    }
    public function assignedCategoriesAction() {
        $this->_title($this->__('Customers'))->_title($this->__('Manage Customers'));
        $customerId = (int) $this->getRequest()->getParam('id');
        $customer = Mage::getModel('customer/customer');

        if ($customerId) {
            $customer->load($customerId);
        }

        Mage::register('current_customer', $customer);

        $this->loadLayout();
        $this->getLayout()->getBlock('admin.customer.view.edit.cart');
        $this->renderLayout();
    }
    public function shippingCostsAction() {
        $this->_title($this->__('Customers'))->_title($this->__('Manage Customer Shipping Fees'));

        $customerId = (int) $this->getRequest()->getParam('id');
        $customer = Mage::getModel('customer/customer');

        if ($customerId) {
            $customer->load($customerId);
        }

        Mage::register('current_customer', $customer);
        $supplier = Mage::getModel('marketplace/methods')->load($customer->getId(), 'supplier_id');
        Mage::register('customer_shipping_costs', $supplier);

        $this->loadLayout();
        $this->getLayout()->getBlock('admin.customer.view.edit.cart');
        $this->renderLayout();
    }
    
    public function profileAction() {
        $this->_title($this->__('Customers'))->_title($this->__('Manage Supplier Profile'));

        $customerId = (int) $this->getRequest()->getParam('id');
        $customer = Mage::getModel('customer/customer');

        if ($customerId) {
            $customer->load($customerId);
        }

        Mage::register('current_customer', $customer);

        $this->loadLayout();
        $this->getLayout()->getBlock('admin.customer.view.edit.cart');
        $this->getLayout()->getBlock('head')
            ->setCanLoadExtJs(true);
        $this->renderLayout();
    }

    public function fieldsAction() {
        $this->loadLayout();
        $this->_setActiveMenu('suppliers');
        $this->_addContent($this->getLayout()->createBlock('marketplace/adminhtml_supplier_customfields'))
            ->renderLayout();
    }

    public function createCustomFieldAction() {
        $this->_forward('editCustomField');
    }

    public function editCustomFieldAction()
    {
        $field = Mage::getModel('marketplace/fields');
        if ($fieldId = $this->getRequest()->getParam('id', false)) {
            $field->load($fieldId);

            if (!$field->getId()) {
                $this->_getSession()->addError(
                    $this->__('This field no longer exists.')
                );

                return $this->_redirect(
                    '*/*/fields'
                );
            }
        }

        if ($postData = $this->getRequest()->getPost('fieldData')) {
            try {
                if (!$field->getId()) {
                    $postData['created_at'] = date('Y-m-d H:i:s');
                }
                $nameExists = Mage::getModel('marketplace/fields')->load($postData['name'], 'name');

                if($nameExists->getId() && !$this->getRequest()->getParam('id', false)) {
                    throw new Exception(
                        $this->__('Field with this name already exists.')
                    );
                }

                $field->addData($postData);
                $field->save();

                $this->_getSession()->addSuccess(
                    $this->__('The field has been saved.')
                );

                return $this->_redirect(
                    '*/*/fields',
                    array('id' => $field->getId())
                );
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }
        }

        Mage::register('current_field', $field);

        if(isset($postData)) {
            Mage::register('current_field_post_data', $postData);
        }

        $editBlock = $this->getLayout()->createBlock(
            'marketplace/adminhtml_supplier_customfields_form'
        );

        $this->loadLayout()
            ->_addContent($editBlock)
            ->renderLayout();
    }

    public function deleteCustomFieldAction() {
        if ($fieldId = $this->getRequest()->getParam('id', false)) {
            $field = Mage::getModel('marketplace/fields');
            $field->load($fieldId);

            if (!$field->getId()) {
                $this->_getSession()->addError(
                    $this->__('This field no longer exists.')
                );
            }

            try {
                $field->delete();
            } catch(Exception $e) {
                $this->_getSession()->addError(
                    $this->__('Can not delete this field.')
                );
            }
        }

        return $this->_redirect(
            '*/*/fields'
        );
    }

    public function ratesAction() {
        $this->_title($this->__('Customers'))->_title($this->__('Customer Rates'));

        $customerId = (int) $this->getRequest()->getParam('id');
        $customer = Mage::getModel('customer/customer');

        if ($customerId) {
            $customer->load($customerId);
        }

        Mage::register('current_customer', $customer);

        $this->loadLayout();
        $this->renderLayout();
    }

    public function removeRateAction() {
        $id = $this->getRequest()->getParam('rate', false);
        $customer_id = $this->getRequest()->getParam('customer_id', false);
        if($id) {
            $rating = Mage::getModel('marketplace/rating')->load($id);

            if($rating->getId()) {
                try {
                    $rating->delete();
                    Mage::getSingleton('adminhtml/session')->addSuccess($this->__("Rating has been canceled"));
                } catch(Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
            }
        }
        $this->_redirect('*/customer/edit', array('id' => $customer_id));
    }
}
