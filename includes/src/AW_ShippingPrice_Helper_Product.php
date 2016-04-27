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


class AW_ShippingPrice_Helper_Product extends Mage_Core_Helper_Abstract
{
    const BUY_REQUEST_QTY = 1;

    public function getProductFakeBuyRequest($product)
    {
        $request = array(
            'product'         => $product->getId(),
            'related_product' => '',
        );

        if ($product->getStockItem()) {
            $request['qty'] = max(
                array(
                     self::BUY_REQUEST_QTY,
                     $product->getStockItem()->getMinSaleQty(),
                     $product->getStockItem()->getQtyIncrements(),
                )
            );
        }

        switch ($product->getTypeId()) {
            case Mage_Catalog_Model_Product_Type::TYPE_BUNDLE:
                $request['bundle_option'] = $this->_getBundleOptions($product);
                break;
            case Mage_Catalog_Model_Product_Type::TYPE_GROUPED:
                $request['super_group'] = $this->_getGroupedOptions($product);
                break;
            case Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE:
                $request['super_attribute'] = $this->_getConfigurableOptions($product);
                break;
            default:
                break;
        }

        $request['options'] = $this->_getProductOptions($product);

        $buyRequest = new Varien_Object($request);
        return $buyRequest;
    }

    private function _getBundleOptions($product)
    {
        $options = array();
        $product = Mage::getModel('catalog/product')->load($product->getId());
        $bundleOptions = Mage::app()->getLayout()
            ->createBlock('bundle/catalog_product_view_type_bundle')
            ->setProduct($product)
            ->getOptions()
        ;

        foreach ($bundleOptions as $_option) {
            if ($_option->getRequired()) {
                $_selections = $_option->getSelections();
                $options[$_option->getId()] = array($_selections[0]->getSelectionId());
            }
        }

        return $options;
    }

    private function _getGroupedOptions($product)
    {
        $options = array();
        $associatedProducts = $product->getTypeInstance(true)->getAssociatedProducts($product);

        foreach ($associatedProducts as $item) {
            if ($item->isSaleable()) {
                $options[$item->getId()] = self::BUY_REQUEST_QTY;
                break;
            }
        }
        return $options;
    }

    private function _getProductOptions($product)
    {
        $options = array();
        $viewOptions = Mage::app()->getLayout()
            ->createBlock('catalog/product_view_options')
            ->setProduct($product)
            ->getJsonConfig()
        ;

        $productOptions = Mage::helper('core')->jsonDecode($viewOptions);
        foreach ($productOptions as $key => $optionValues) {
            foreach ($optionValues as $optionKey => $optionData) {
                $options[$key] = $optionKey;
                break;
            }
        }
        return $options;
    }

    private function _getConfigurableOptions($product)
    {
        $options = array();
        $configurableOptions = Mage::app()->getLayout()
            ->createBlock('catalog/product_view_type_configurable')
            ->setProduct($product)
            ->getJsonConfig()
        ;

        $configurable = Mage::helper('core')->jsonDecode($configurableOptions);
        foreach ($configurable['attributes'] as $attribute) {
            $attrId = $attribute['id'];
            $attrValue = $attribute['options'][0]['id'];
            $options[$attrId] = $attrValue;
        }
        return $options;
    }
}