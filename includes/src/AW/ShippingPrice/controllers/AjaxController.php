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
 * @package    AW_ShippingPrice
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_ShippingPrice_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function loadAction()
    {
        $result = array(
            'success' => true,
        );

        $productsIds = Mage::helper('aw_shippingprice')->getDecodedProductIds(Mage::app()->getRequest()->get('ids'));
        if ($productsIds) {
            try {
                $result['content'] = $this->_getShippingRates($productsIds);
            } catch (Exception $e) {
                $result['success'] = false;
                $result['error'] = $e->getMessage();
            }
        }
        $this->_ajaxResponse($result);
    }

    protected function _getShippingRates($productsIds = array())
    {
        $rates = array();

        if ($productsIds) {
            $_helper = Mage::helper('aw_shippingprice');

            $address = $_helper->getShippingAddress();
            $method = $_helper->getShippingMethod();

            foreach ($productsIds as $productId) {

                $price = $_helper->getShippingPriceFromCache($productId, $address, $method);

                if ($price === false) { /* cache expired */
                    $price = $_helper->getShippingPrice($productId, $address, $method);
                    $_helper->saveShippingPriceToCache($price, $productId, $address, $method);
                }

                if (!($price === null)) { /* shipping method is not applicable */
                    $rates[$productId] = Mage::helper('core')->currency($price);
                }
            }
        }
        return $rates;
    }

    protected function _ajaxResponse($result = array())
    {
        $this->getResponse()->setBody(Zend_Json::encode($result));
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}