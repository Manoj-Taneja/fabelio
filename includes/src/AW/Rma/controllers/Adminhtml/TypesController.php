<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Rma
 * @version    1.5.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


require_once 'AbstractController.php';

class AW_Rma_Adminhtml_TypesController extends AW_Rma_Adminhtml_AbstractController
{
    private function hasErrors()
    {
        return (bool)$this->_getSession()->getMessages()->count();
    }

    protected function _initAction()
    {
        return $this->loadLayout()->_setActiveMenu('sales/awrma');
    }

    protected function editAction()
    {
        $this->_setTitle('Sales')
            ->_setTitle('RMA')
            ->_setTitle('Edit Type');
        $this->_initAction();
        if ($this->getRequest()->getParam('id')) {
            $_type = Mage::getModel('awrma/entitytypes')->load($this->getRequest()->getParam('id'));
            if ($_type->getData() != array()) {
                Mage::register('awrmaformdatatype', $_type, true);
            } else {
                $this->_getSession()->addError($this->__('Can\'t load type by given ID'));
            }
        } else {
            $this->_getSession()->addError($this->__('No ID specified'));
        }

        if ($this->hasErrors()) {
            return $this->_redirect('*/*/list');
        }

        $this->_addContent($this->getLayout()->createBlock('awrma/adminhtml_types_edit'));
        $this->renderLayout();
        return $this;
    }

    protected function newAction()
    {
        $this->_setTitle('Sales')
            ->_setTitle('RMA')
            ->_setTitle('New Type')
        ;
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('awrma/adminhtml_types_edit'));
        $this->renderLayout();
    }

    protected function saveAction()
    {
        if ($this->getRequest()->isPost()) {
            $_type = Mage::getModel('awrma/entitytypes');
            if ($this->getRequest()->getParam('id')) {
                # Edit existing
                $_type->load($this->getRequest()->getParam('id'));
                if ($_type->getData() == array()) {
                    $this->_getSession()->addError($this->__('Can\'t load type by given ID'));
                }
            }

            if (!preg_match("/^[0-9]*$/", $this->getRequest()->getParam('sort'))) {
                $this->_getSession()->addError($this->__('Sort value must be integer'));
            }

            if (!$this->hasErrors()) {
                $store = $this->getRequest()->getParam('store');
                $sort = !is_null($this->getRequest()->getParam('sort'))
                && !($this->getRequest()->getParam('sort') == '') ? $this->getRequest()->getParam('sort') : 1;
                $_data = array(
                    'id'      => $_type->getId(),
                    'name'    => $this->getRequest()->getParam('name'),
                    'store'   => (reset($store) != '') ? $store : Mage::app()->getStore()->getId(),
                    'sort'    => $sort,
                    'enabled' => $this->getRequest()->getParam('enabled')
                );

                $_type->setData($_data);
                $_type->save();

                $this->_getSession()->addSuccess($this->__('Type has been successfully saved'));
                $this->_getSession()->getAWRMATypesFormData(true);
                if ($this->getRequest()->getParam('continue')) {
                    return $this->_redirect('*/*/edit', array('id' => $_type->getId()));
                } else {
                    return $this->_redirect('*/*/list');
                }
            }
        } else {
            $this->_getSession()->addError($this->__('This action can be called only via post'));
        }

        if ($this->hasErrors()) {
            $this->_getSession()->setAWRMATypesFormData($this->getRequest()->getParams());
            if ($this->getRequest()->getParam('id')) {
                return $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } else {
                return $this->_redirect('*/*/new');
            }
        }
        return $this;
    }

    protected function indexAction()
    {
        $this->_redirect('*/*/list');
    }

    protected function listAction()
    {
        $this->_setTitle('Sales')
            ->_setTitle('RMA')
            ->_setTitle('Types')
        ;
        $this->_initAction();
        $this->renderLayout();
    }

    protected function deleteAction()
    {
        if ($this->getRequest()->getParam('id')) {
            Mage::getModel('awrma/entitytypes')
                ->load($this->getRequest()->getParam('id'))
                ->setRemoved(1)
                ->save()
            ;
        }
        $this->_redirect('*/*/list');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sales/awrma/types');
    }
}