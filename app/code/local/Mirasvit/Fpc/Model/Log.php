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



class Mirasvit_Fpc_Model_Log extends Mage_Core_Model_Abstract
{
    const LOG_FILE = 'fpc.log';

    protected function _construct()
    {
        $this->_init('fpc/log');
    }

    protected function _getActionType($normalizedUrl)
    {
        $request = Mage::app()->getRequest();
        $type = $request->getModuleName().'/'.$request->getControllerName().'_'.$request->getActionName();
        if (strpos($normalizedUrl, '?') !== false) {
            $type .= '+';
        }

        return $type;
    }

    protected function _getOrder($type)
    {
        $order = 1000;
        if ($type == 'catalog/product_view' || $type == 'catalog/product_view+') {
            $attributeValue = array();
            if ($product = Mage::registry('current_product')) {
                foreach (Mage::getSingleton('fpc/config')->getSortByProductAttribute() as $record) {
                    if ($product->offsetExists($record->getAttributeOptionCode())) {
                        if (trim($record->getAttributeValue()) != '') {
                            $attribute = $product->getAttributeText($record->getAttributeOptionCode());
                            if (!$attribute) {
                                $attribute = $product->getData($record->getAttributeOptionCode());
                            }
                            $attributeValue[$record->getAttributeOptionCode()] = $attribute;
                            if (count($attributeValue) > 0) {
                                $attributeArray = explode(',', $record->getAttributeValue());
                                $attributeArray = array_map('trim', $attributeArray);
                                if (is_array($attributeValue[$record->getAttributeOptionCode()])) { //multiselect
                                    if (array_intersect($attributeValue[$record->getAttributeOptionCode()], $attributeArray)) {
                                        $order = $record->getCounter();
                                        break;
                                    }
                                } elseif (in_array($attributeValue[$record->getAttributeOptionCode()], $attributeArray)) {
                                    $order = $record->getCounter();
                                    break;
                                }
                            }
                        } else {
                            $order = $record->getCounter();
                        }
                    }
                }
            } else {
                $order = false;
            }
        }

        return $order;
    }

    public function log($cacheId, $isHit = 1)
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            return true;
        }

        if (Mage::helper('core/http')->getHttpUserAgent() == Mirasvit_Fpc_Model_Crawler_Crawl::USER_AGENT) {
            if ($product = Mage::registry('current_product')
                && Mage::getSingleton('fpc/config')->getSortCrawlerUrls() == 'custom_order'
                && count(Mage::getSingleton('fpc/config')->getSortByProductAttribute()) > 0) {
                $normalizedUrl = Mage::helper('fpc')->getNormlizedUrl(true);
                $type = $this->_getActionType($normalizedUrl);
                $order = $this->_getOrder($type);

                $line = array(
                            0, //not use
                            0, //not use
                            $normalizedUrl,
                            $cacheId,
                            $type,
                        );

                if ($order !== false) {
                    array_push($line, $order);
                }

                Mage::getSingleton('fpc/crawler_url')->saveUrl($line, 0);
            }

            return true;
        }

        $logPath = Mage::getBaseDir('var').DS.'log'.DS.'fpc.log';
        $time = microtime(true) - $_SERVER['FPC_TIME'];

        $normalizedUrl = Mage::helper('fpc')->getNormlizedUrl(true);
        $type = $this->_getActionType($normalizedUrl);
        $order = $this->_getOrder($type);

        $data = array(
            $isHit,
            round($time, 5),
            $normalizedUrl,
            $cacheId,
            $type,
        );

        if ($order !== false) {
            array_push($data, $order);
        }

        Mage::log(implode('|', $data), null, self::LOG_FILE, true);

        return true;
    }

    public function importFileLog()
    {
        $logPath = Mage::getBaseDir('var').DS.'log';
        $filePath = $logPath.DS.self::LOG_FILE;

        if (!file_exists($filePath)) {
            return true;
        }

        @rename($filePath, $logPath.DS.'fpc_.log');

        $filePath = $logPath.DS.'fpc_.log';

        if (!file_exists($filePath)) {
            return true;
        }

        $handle = fopen($filePath, 'r');
        if ($handle) {
            $resource = Mage::getSingleton('core/resource');
            $connection = $resource->getConnection('core_write');
            $tableName = Mage::getSingleton('core/resource')->getTableName('fpc/log');
            $rows = array();
            $importLimit = 1000; //import limit from one file
            $totalRowsNumber = 0;
            while (($line = fgets($handle)) !== false) {
                $line = explode('):', $line);
                $line = explode('|', $line[1]);

                $rows[] = array(
                    'response_time' => $line[1],
                    'from_cache' => $line[0],
                    'created_at' => date('Y-m-d H:i:s'),
                );

                if (count($rows) > 100) {
                    $totalRowsNumber += count($rows);
                    $connection->insertArray($tableName, array('response_time', 'from_cache', 'created_at'), $rows);
                    $rows = array();
                }
                if ($totalRowsNumber >= $importLimit) {
                    break;
                }

                Mage::getSingleton('fpc/crawler_url')->saveUrl($line);
            }

            if (count($rows) > 0) {
                $connection->insertArray($tableName, array('response_time', 'from_cache', 'created_at'), $rows);
            }

            unlink($filePath);
        }

        $this->getResource()->aggregate();

        return true;
    }
}
