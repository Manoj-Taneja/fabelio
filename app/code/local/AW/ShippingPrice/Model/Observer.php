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


class AW_ShippingPrice_Model_Observer
{
    protected $_showPrice = null;

    protected function _showPrice()
    {
        if ($this->_showPrice === null) {
            $this->_showPrice = Mage::helper('aw_shippingprice')->showPriceEnabled();
        }
        return $this->_showPrice;
    }

    public function appendBlock($observer)
    {
        if (!$this->_showPrice()) {
            return false;
        }

        $block = $observer->getBlock();
        if ($block instanceof Mage_Catalog_Block_Product_Price) {
            $skipTemplates = array(
                'catalog/product/view/tierprices.phtml',
                'catalog/product/price_msrp.phtml',
                'catalog/product/price_msrp_item.phtml',
                'catalog/product/price_msrp_noform.phtml',
            );

            if (in_array($block->getTemplate(), $skipTemplates)) {
                return false;
            }

            $product = $block->getProduct();
            if (!$product->isVirtual() && $product->isSaleable()) {
                $address = Mage::helper('aw_shippingprice')->getShippingAddress();
                $shippingMethod = Mage::helper('aw_shippingprice')->getShippingMethod();

                $price = Mage::helper('aw_shippingprice')->getShippingPriceFromCache(
                    $product->getId(), $address, $shippingMethod
                );

                if ($price === '') {
                    /* not applicable */
                    return false;
                }

                if ($price === false) { /* cache expired */
                    Mage::helper('aw_shippingprice')->addProductId($product->getId());
                }

                $shippingPriceBlock = Mage::app()->getLayout()->createBlock("core/template");

                $shippingPriceBlock
                    ->setTemplate("aw_shippingprice/div.phtml")
                    ->setProductId($product->getId())
                    ->setPrice($price)
                ;

                $html = $observer->getTransport()->getHtml() . $shippingPriceBlock->toHtml();
                $observer->getTransport()->setHtml($html);
            }
        }
        return $this;
    }
}