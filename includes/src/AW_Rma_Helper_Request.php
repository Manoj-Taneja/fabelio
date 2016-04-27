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


class AW_Rma_Helper_Request extends Mage_Core_Helper_Abstract
{
    public static function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    /**
     * Validate RMA request and adds it to database when all is good
     *
     * @param AW_Rma_Model_Entity $request
     * @param boolean             $guestMode
     *
     * @return boolean
     */
    public static function save($request, $guestMode = false)
    {
        $_data = array();
        $_addNewEntityFlag = true;

        $_data['order_id'] = $request->getParam('order');
        //Checking OrderID
        if ($_data['order_id']) {
            //Trying to load order
            $_order = Mage::getModel('sales/order')->loadByIncrementId($_data['order_id']);
            if (!($_order->getData() == array())) {
                $customerSession = Mage::getSingleton('customer/session');
                if ($guestMode) {
                    $_guestOrderId = $customerSession->getData('awrma_guest_order');
                    $_orderIncrementId = Mage::getModel('sales/order')->load($_guestOrderId)->getIncrementId();
                    if (($_guestOrderId) && ($_orderIncrementId != $_order->getIncrementId())) {
                        $_addNewEntityFlag = false;
                        self::_getSession()->addError(
                            Mage::helper('awrma')->__('You are not authorized to request RMA for specified order')
                        );
                    }
                } else {
                    if ($_order->getCustomerId() != $customerSession->getId()) {
                        $_addNewEntityFlag = false;
                        self::_getSession()->addError(
                            Mage::helper('awrma')->__('Customer isn\'t owner of the given order')
                        );
                    }
                }
                if (!Mage::helper('awrma')->isAllowedForOrder($_order)) {
                    $_addNewEntityFlag = false;
                    self::_getSession()->addError(
                        Mage::helper('awrma')->__('You can\'t request RMA for the given order')
                    );
                }
                //Getting order items
                $_orderItems = array();
                $_orderItemsCount = $request->getParam('orderitemscount');
                foreach ($request->getParam('orderitems', array()) as $_orderItemId) {
                    if (isset($_orderItemsCount[$_orderItemId])) {
                        $_orderItems[$_orderItemId] = $_orderItemsCount[$_orderItemId];
                    }
                }

                if ($_addNewEntityFlag) {
                    if ((Mage::helper('awrma/config')->getAllowPerOrderRMA() && count($_orderItems))
                        || !Mage::helper('awrma/config')->getAllowPerOrderRMA()) {
                        //Gets order items from post if per-order item RMA is allowed
                        //and gets it directly from order otherwise
                        if (!Mage::helper('awrma/config')->getAllowPerOrderRMA()) {
                            $_orderItems = array();
                            foreach ($_order->getItemsCollection() as $_item) {
                                $_orderItems[$_item->getId()] = Mage::helper('awrma')->getItemMaxCount($_item);
                            }
                        } else {
                            //Checking items count and order items
                            $_oifio = false;
                            foreach ($_order->getItemsCollection() as $_item) {
                                if (array_key_exists($_item->getId(), $_orderItems)) {
                                    $_count = $_orderItems[$_item->getId()];
                                    if (
                                        isset($_count)
                                        && ($_count < 1 || $_count > Mage::helper('awrma')->getItemMaxCount($_item))
                                    ) {
                                        $_addNewEntityFlag = false;
                                        self::_getSession()->addError(
                                            Mage::helper('awrma')->__('Wrong quantity for ' . $_item->getName())
                                        );
                                    }
                                }
                                if (!$_oifio && isset($_orderItems[$_item->getId()])) {
                                    $_oifio = true;
                                }
                            }
                            if (!$_oifio) {
                                $_addNewEntityFlag = false;
                                self::_getSession()->addError(
                                    Mage::helper('awrma')->__('No items for request specified')
                                );
                            }
                        }

                        if ($_addNewEntityFlag) {
                            $_data['order_items'] = $_orderItems;
                            //Checking package opened and request type values
                            $packageOpenedOption = Mage::getModel('awrma/source_packageopened')
                                ->getOption($request->getParam('packageopened'))
                            ;
                            if (!($packageOpenedOption === false)) {
                                $_data['rma_id'] = $request->getParam('rma_id');
                                $_data['package_opened'] = $request->getParam('packageopened');
                                $_data['request_type'] = $request->getParam('requesttype');
                                if (!$_data['request_type']) {
                                    $_data['request_type'] = null;
                                }

                                $_data['created_at'] = date(AW_Rma_Model_Mysql4_Entity::DATETIMEFORMAT, time());
                                $_data['status'] = Mage::helper('awrma/status')->getPendingApprovalStatusId();
                                $_data['external_link'] = Mage::helper('awrma')->getExtLink();
                                if ($guestMode) {
                                    $_data['customer_email'] = $_order->getCustomerEmail();
                                    $_data['customer_name'] = $_order->getBillingAddress()->getFirstname() . ' '
                                        . $_order->getBillingAddress()->getLastname()
                                    ;
                                } else {
                                    $_data['customer_name'] = self::_getSession()->getCustomer()->getFirstname() . ' '
                                        . self::_getSession()->getCustomer()->getLastname()
                                    ;
                                    $_data['customer_email'] = self::_getSession()->getCustomer()->getEmail();
                                    $_data['customer_id'] = self::_getSession()->getCustomer()->getId();
                                }

                                $_data['reason_id'] = $request->getParam('reason_id');
                                if ($_data['reason_id'] === '0') {
                                    $_data['reason_details'] = $request->getParam('reason_details');
                                }

                                $rmaEntity = Mage::getModel('awrma/entity');
                                $rmaEntity->setData($_data);
                                $rmaEntity->save();

                                if ($request->getParam('additionalinfo')) {
                                    //save comment
                                    $_data['owner'] = AW_Rma_Model_Source_Owner::CUSTOMER;
                                    Mage::helper('awrma/comments')->postComment(
                                        $rmaEntity->getId(), $request->getParam('additionalinfo'), $_data, false
                                    );
                                }

                                Mage::getModel('awrma/notify')->notifyNew(
                                    $rmaEntity, $request->getParam('additionalinfo')
                                );

                                //Clear form data stored in session
                                self::_getSession()->getAWRMAFormData(true);
                                self::_getSession()->addSuccess(
                                    Mage::helper('awrma')->__('New RMA request has been successfully added')
                                );
                                self::_getSession()->addNotice(
                                    Mage::helper('awrma')->__('Your RMA is currently waiting for approval')
                                );
                                return $guestMode ? $rmaEntity->getExternalLink() : $rmaEntity->getId();
                            } else {
                                $_addNewEntityFlag = false;
                                self::_getSession()->addError(Mage::helper('awrma')->__('Wrong form data'));
                            }
                        }
                    } else {
                        $_addNewEntityFlag = false;
                        self::_getSession()->addError(Mage::helper('awrma')->__('No items for request specified'));
                    }
                }
            } else {
                $_addNewEntityFlag = false;
                self::_getSession()->addError(Mage::helper('awrma')->__('Wrong order ID'));
            }
        } else {
            $_addNewEntityFlag = false;
            self::_getSession()->addError(Mage::helper('awrma')->__('Wrong form data'));
        }

        self::_getSession()->setAWRMAFormData($request->getParams());

        return $_addNewEntityFlag;
    }

    public static function getApprovementCode()
    {
        return strtoupper(uniqid());
    }

    public static function getDefaultPrintLabelData($order)
    {
        if ($order->getBillingAddress()) {
            $_printLabelData = array(
                'firstname'        => $order->getBillingAddress()->getData('firstname'),
                'lastname'         => $order->getBillingAddress()->getData('lastname'),
                'company'          => $order->getBillingAddress()->getData('company'),
                'telephone'        => $order->getBillingAddress()->getData('telephone'),
                'fax'              => $order->getBillingAddress()->getData('fax'),
                'streetaddress'    => explode("\n", $order->getBillingAddress()->getData('street')),
                'city'             => $order->getBillingAddress()->getData('city'),
                'stateprovince_id' => $order->getBillingAddress()->getData('region_id'),
                'stateprovince'    => $order->getBillingAddress()->getData('region'),
                'postcode'         => $order->getBillingAddress()->getData('postcode'),
                'country_id'       => $order->getBillingAddress()->getData('country_id')
            );
            return $_printLabelData;
        }
        return null;
    }

    public static function getPrintlabelLink($request) {
        $url = $request->getPrintLabelUrl();
        return empty($url) ? $url : "<a href='{$url}'>{$url}</a>";
    }
}