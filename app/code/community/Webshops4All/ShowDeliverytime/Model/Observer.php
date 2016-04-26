<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 26-09-14
 * Time: 13:23
 */

class Webshops4All_ShowDeliverytime_Model_Observer {

    public function showOutOfStock($observer) {
        Mage::helper('catalog/product')->setSkipSaleableCheck(true);
    }
}