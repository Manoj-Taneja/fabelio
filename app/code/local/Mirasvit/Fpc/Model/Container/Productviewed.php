<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Full Page Cache
 * @version   1.0.1
 * @build     360
 * @copyright Copyright (C) 2015 Mirasvit (http://mirasvit.com/)
 */



class Mirasvit_Fpc_Model_Container_Productviewed extends Mirasvit_Fpc_Model_Container_Abstract
{
    const COOKIE_NAME = 'FPC_PRODUCT_VIEWED';

    public static function registerViewedProduct($params)
    {
        if ($params->getId()) {
            $cookie = Mage::app()->getCookie();

            $productId = $params->getId();
            $ids = explode(',', $cookie->get(self::COOKIE_NAME));

            if (!in_array($productId, $ids)) {
                array_unshift($ids, $productId);
            }
            $ids = array_slice(
                array_unique($ids),
                0,
                Mage::getStoreConfig(Mage_Reports_Block_Product_Viewed::XML_PATH_RECENTLY_VIEWED_COUNT)
            );

            $cookie->set(self::COOKIE_NAME, implode(',', $ids));
        }

        return true;
    }

    protected function _getProductIds()
    {
        $result = Mage::app()->getCookie()->get(self::COOKIE_NAME, array());
        $result = explode(',', $result);

        foreach ($result as $idx => $value) {
            if (intval($value) == 0) {
                unset($result[$idx]);
            }
        }

        //remove current product
        if (Mage::registry('current_product') && in_array(Mage::registry('current_product')->getId(), $result)) {
            $productId = Mage::registry('current_product')->getId();
            foreach ($result as $key => $value) {
                if ($value == $productId) {
                    unset($result[$key]);
                    break;
                }
            }
        }

        return $result;
    }

    protected function _getIdentifier()
    {
        $productIds = $this->_getProductIds();
        if ($productIds) {
            return implode('_', $productIds);
        }

        return self::EMPTY_VALUE;
    }

    public function applyToContent(&$content)
    {
        $pattern = '/'.preg_quote($this->_getStartReplacerTag(), '/').'(.*?)'.preg_quote($this->_getEndReplacerTag(), '/').'/ims';
        $html = $this->_renderBlock();

        if ($html !== false) {
            ini_set('pcre.backtrack_limit', 100000000);
            $content = preg_replace($pattern, str_replace('$', '\\$', $html), $content, 1);

            return true;
        }

        return false;
    }

    protected function _renderBlock()
    {
        $layout = new Mage_Core_Model_Layout($this->_definition['layout']);
        $layout->generateBlocks();
        $block = $layout->getBlock($this->_definition['block_name']);

        if ($block) {
            $block->setProductIds($this->_getProductIds());
            $collection = $block->getItemsCollection();

            // set correct order
            if (is_object($collection)) {
                foreach ($this->_getProductIds() as $productId) {
                    $item = $collection->getItemById($productId);
                    $collection->removeItemByKey($productId);
                    if ($item) {
                        $collection->addItem($item);
                    }
                }
            }

            $html = $block->toHtml();
        } else {
            $html = self::EMPTY_VALUE;
        }

        return $html;
    }
}
