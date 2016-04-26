<?php
/**
 * @author     Karazey Sergey <karazey.sergey@gmail.com>
 * @copyright  2014 Karazey Sergey
 * @created    10:00 27/06/2014
 * @license    http://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 */

/**
 * Class SliRx_GoogleTagManager_Block_Remarketing
 */
class SliRx_GoogleTagManager_Block_Remarketing extends Mage_Core_Block_Template
{
    public function getRemarketingData()
    {
        $result = array(
            'event'             => 'fireRemarketingTag',
            'google_tag_params' => array()
        );

        $pageType = $this->getPageType();

        switch ($pageType) {
            case 'home':
                $result['google_tag_params'] = array(
                    'ecomm_pagetype' => $pageType
                );

                break;

            case 'category':
                $products = Mage::getBlockSingleton('catalog/product_list')->getLoadedProductCollection();

                $ids = '';

                foreach ($products as $item) {
                    if ($ids !== '') {
                        $ids .= ', ';
                    }

                    $ids .= "'" . $item->getSku() . "'";
                }

                if ($ids === '') {
                    return false;
                }

                $result['google_tag_params'] = array(
                    'ecomm_prodid'   => '[' . $ids . ']',
                    'ecomm_pagetype' => $pageType
                );

                break;

            case 'product':
                $product = Mage::registry('current_product');

                $price = $product->getPrice();

                // if bundled product - get minimal price
                if ($product->getTypeId() === Mage_Catalog_Model_Product_Type::TYPE_BUNDLE) {
                    $price = Mage::getModel('bundle/product_price')->getTotalPrices($product, 'min', 1);
                }

                $result['google_tag_params'] = array(
                    'ecomm_prodid'     => $product->getSku(),
                    'ecomm_pagetype'   => $pageType,
                    'ecomm_totalvalue' => round($price, 2),
                );

                break;

            case 'cart':
                $quote = Mage::getSingleton('checkout/cart')->getQuote();
                $grandTotal = $quote->getGrandTotal();
                $products = $quote->getAllItems();
                $ids = '';

                foreach ($products as $item) {
                    if ($ids !== '') {
                        $ids .= ', ';
                    }

                    $ids .= "'" . $item->getSku() . "'";
                }

                if ($ids === '') {
                    return false;
                }

                $result['google_tag_params'] = array(
                    'ecomm_prodid'     => '[' . $ids . ']',
                    'ecomm_pagetype'   => $pageType,
                    'ecomm_totalvalue' => round($grandTotal, 2),
                );

                break;

            case 'purchase':
                $orderId = Mage::getSingleton('checkout/session')->getLastRealOrderId();

                if ($orderId) {
                    $order = Mage::getModel('sales/order')->loadByAttribute('increment_id', $orderId);
                    $items = $order->getAllItems();

                    $ids = array();

                    foreach ($items as $item) {
                        $ids[] = $item->getProductId();
                    }

                    $products = Mage::getModel('catalog/product')
                        ->getCollection()
                        ->addAttributeToSelect('sku')
                        ->addIdFilter($ids);

                    $ids = '';

                    foreach ($products as $item) {
                        if ($ids !== '') {
                            $ids .= ', ';
                        }

                        $ids .= "'" . $item->getSku() . "'";
                    }

                    if ($ids === '') {
                        return false;
                    }

                    $result['google_tag_params'] = array(
                        'ecomm_prodid'     => '[' . $ids . ']',
                        'ecomm_pagetype'   => $pageType,
                        'ecomm_totalvalue' => round($order->getGrandTotal(), 2),
                    );
                }

                break;

            default:
                return false;
        }

        return json_encode($result);
    }
}
