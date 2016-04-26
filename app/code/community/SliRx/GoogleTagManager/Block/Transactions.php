<?php
/**
 * @author     Karazey Sergey <karazey.sergey@gmail.com>
 * @copyright  2014 Karazey Sergey
 * @created    10:00 27/06/2014
 * @license    http://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 */

/**
 * Class SliRx_GoogleTagManager_Block_Transactions
 */
class SliRx_GoogleTagManager_Block_Transactions extends Mage_Checkout_Block_Success
{
    protected $_orderId = 0;

    function __construct()
    {
        $this->_orderId = Mage::getSingleton('checkout/session')->getLastRealOrderId();
    }

    public function getTransactionsData()
    {
        $helper = Mage::helper('slirx_google_tag_manager');
        $data = array();

        if ($this->_orderId) {
            $order = Mage::getModel('sales/order')->loadByAttribute('increment_id', $this->_orderId);
            $items = $order->getAllVisibleItems();
            $products = $this->_getProducts($items);

            // calculation price of all products
            $priceAll = 0;
            foreach ($products as $item) {
                $priceAll += $item['price'] * $item['quantity'];
            }

            $data = array(
                'transactionId'          => $order->getIncrementId(),
                'transactionAffiliation' => $helper->getTransactionAffiliation(),
                'transactionTotal'       => $priceAll,
                'transactionTax'         => '',
                'transactionShipping'    => round($order->getShippingAmount(), 2),
                'transactionProducts'    => $products
            );
        }

        $data = json_encode($data);

        return $data;
    }

    protected function _getProducts($items)
    {
        $products = array();

        foreach ($items as $orderItem) {
            if (intval($orderItem->getPrice()) === 0) {
                continue;
            }

            /*
             * todo implement in future releases: if in configuration selected "send to GA only earnings"
             * but for product must be set cost
             */
            // $price = $orderItem->getPrice() - $orderItem->getCost();
            $price = $orderItem->getPrice();

            $product = Mage::getModel('catalog/product')->load($orderItem->getProductId());

            $categoryIds = $product->getCategoryIds();
            $category = Mage::getModel('catalog/category')->load($categoryIds[0]);

            $products[] = array(
                'sku'      => $orderItem->getSku(),
                'name'     => $orderItem->getName(),
                'category' => $category->getName(),
                'price'    => round($price, 2),
                'quantity' => (int)$orderItem->getQty_ordered()
            );
        }

        return $products;
    }
}
