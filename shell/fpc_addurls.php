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



require_once 'abstract.php';

class Mirasvit_Shell_Fpc_Add_Urls extends Mage_Shell_Abstract
{
    public function run()
    {
        if (Mage::helper('mstcore/version')->getEdition() == 'ee') {
            echo 'Only for Community Edition.'.PHP_EOL;
            die;
        }
        $storesData = array();
        $storeCollection = Mage::getModel('core/store')->getCollection();
        foreach ($storeCollection as $store) {
            if (!isset($storesData[$store->getGroupId()])) {
                $storesData[$store->getGroupId()] = $store->getStoreId();
            }
        }

        $urlsCount = 0;
        $collection = Mage::getModel('core/url_rewrite')->getCollection()
                    ->addFieldToSelect('id_path')
                    ->addFieldToSelect('store_id')
                    ->addFieldToSelect('request_path')
                    ->addFieldToFilter('is_system', '1') //we don't add custom type, because there is magento bug with broken urls of custom type
                    ->addFieldToFilter('store_id', array('in' => $storesData)); //only first store view if it is multilanguage store
                    ;
        foreach ($collection as $item) {
            $storeId = $item->getStoreId();
            $actionType = (strpos($item->getIdPath(), 'category') !== false) ? 'catalog/category_view' : 'catalog/product_view';
            $url = Mage::app()->getStore($storeId)->getBaseUrl().$item->getRequestPath();
            $content = '';
            if (function_exists('curl_multi_init')) {
                $adapter = new Varien_Http_Adapter_Curl();
                $options = array(
                    CURLOPT_USERAGENT => Mirasvit_Fpc_Model_Crawler_Crawl::USER_AGENT,
                    CURLOPT_HEADER => true,
                );

                $content = $adapter->multiRequest(array($url), $options);
                $content = $content[0];
            } else {
                $content = implode(PHP_EOL, get_headers($url));
            }
            if (strpos($content, '404 Not Found') === false) {
                preg_match('/Fpc-Cache-Id: ('.Mirasvit_Fpc_Model_Processor::REQUEST_ID_PREFIX.'[a-z0-9]{32})/', $content, $matches);
                if (count($matches) == 2) {
                    $cacheId = $matches[1];
                    $line = '||'.trim($url).'|'.$cacheId.'|'.$actionType.'|1000';
                    $line = explode('|', $line);
                    Mage::getSingleton('fpc/crawler_url')->saveUrl($line, 0);
                    $urlsCount++;
                    echo $url.PHP_EOL;
                }
            }
            if ($urlsCount % 100 == 0) {
                echo  '------ Was added '.$urlsCount.' urls ------'.PHP_EOL;
            }
        }

        echo 'Total number of added URLs: '.$urlsCount.PHP_EOL;
    }

    // public function _validate()
    // {
    // }
}

$shell = new Mirasvit_Shell_Fpc_Add_Urls();
$shell->run();
