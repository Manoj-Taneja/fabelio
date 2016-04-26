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



class Mirasvit_Fpc_Model_Crawler_Crawl extends Varien_Object
{
    const USER_AGENT = 'FpcCrawler';

    protected $_status = array();
    protected $_lockFile = null;

    public function checkFpcStatus()
    {
        $cacheType = Mage::app()->getCacheInstance()->getTypes();
        if (isset($cacheType['fpc']) && $cacheType['fpc']->getStatus() == 0) { // if 0 FPC disabled
            return false;
        }

        return true;
    }

    public function run($verbose = false)
    {
        if ((Mage::getSingleton('fpc/config')->getCrawlerEnabled() && !$this->isLocked() && $this->checkFpcStatus())
            || ($verbose && !$this->isLocked() && $this->checkFpcStatus())) {
            if (Mage::getSingleton('fpc/config')->getRunAsApacheUser()) {
                $this->_request('run');
            } else {
                $this->doRun($verbose);
            }
        }
    }

    public function doRun($verbose = false)
    {
        $this->lock();
        $this->addStatusMessage('start', sprintf(__('Started at: %s'), Mage::getSingleton('core/date')->date()));
        $config = Mage::getSingleton('fpc/config');
        $collection = $this->getUrlCollection();

        $totalCount = 0;
        while ($row = $collection->fetch()) {
            $urlModel = Mage::getModel('fpc/crawler_url')->load($row['url_id']);

            if (!$urlModel->isCacheExist()) {
                $urlModel->warmCache();

                $this->_removeDublicates($urlModel);

                $totalCount++;
                $this->addStatusMessage('process', sprintf(__('Crawled %d urls', $totalCount)));
                if ($totalCount >= $config->getCrawlerMaxUrlsPerRun()) {
                    break;
                }
            }
        }

        $this->addStatusMessage('process', sprintf(__('Crawled %d urls', $totalCount)))
            ->addStatusMessage('finish', sprintf(__('Finished at: %s'), Mage::getSingleton('core/date')->date()));
        $this->unlock();
    }

    /**
     * Отправляет http запрос на контроллер расширения
     * Таким образом все действия кравлера выполняються от apache пользователя.
     *
     * @param string $command комманда (run)
     *
     * @return string
     */
    protected function _request($command)
    {
        $httpClient = new Zend_Http_Client();
        $httpClient->setConfig(array('timeout' => 60000));

        $store = Mage::app()->getStore(0);
        $url = $store->getUrl('fpc/action/'.$command, array('_query' => array('rand' => microtime(true))));
        $result = $httpClient->setUri($url)->request()->getBody();

        return $result;
    }

    public function addStatusMessage($key, $message)
    {
        $this->_status[$key] = $message;

        Mage::helper('fpc')->setVariable('status', implode(PHP_EOL, $this->_status));

        return $this;
    }

    public function getUrlCollection()
    {
        $sortByPageTypeCount = count(Mage::getSingleton('fpc/config')->getSortByPageType());
        $sortByProductAttributeCount = count(Mage::getSingleton('fpc/config')->getSortByProductAttribute());
        $sortCrawlerUrls = Mage::getSingleton('fpc/config')->getSortCrawlerUrls();
        $resource = Mage::getSingleton('core/resource');
        $read = $resource->getConnection('core_read');
        $select = $read->select()
            ->from($resource->getTableName('fpc/crawler_url', array('*')));
        if ($sortCrawlerUrls == 'custom_order' && $sortByPageTypeCount > 0 && $sortByProductAttributeCount > 0) {
            $select->order(Mage::helper('fpc')->getOrderSql(true));
        } elseif ($sortCrawlerUrls == 'custom_order' && $sortByPageTypeCount > 0) {
            $select->order(Mage::helper('fpc')->getOrderSql(false));
        } elseif ($sortCrawlerUrls == 'custom_order' && $sortByProductAttributeCount > 0) {
            $select->order(array('sort_by_product_attribute asc', 'rate desc'));
        } else {
            $select->order('rate desc');
        }
        $select->limit(200000);

        return $read->query($select);
    }

    protected function _removeDublicates($urlModel)
    {
        $collection = Mage::getModel('fpc/crawler_url')->getCollection()
            ->addFieldToFilter('url_id', array('neq' => $urlModel->getId()))
            ->addFieldToFilter('url', $urlModel->getUrl());

        foreach ($collection as $url) {
            $url->delete();
        }

        $collection = Mage::getModel('fpc/crawler_url')->getCollection()
            ->addFieldToFilter('url_id', array('neq' => $urlModel->getId()))
            ->addFieldToFilter('cache_id', $urlModel->getCacheId());

        foreach ($collection as $url) {
            $url->delete();
        }

        return $this;
    }

    protected function _getLockFile()
    {
        if ($this->_lockFile === null) {
            $varDir = Mage::getConfig()->getVarDir('locks');
            $file = $varDir.DS.'fpc_crawler.lock';

            if (is_file($file)) {
                $this->_lockFile = fopen($file, 'w');
            } else {
                $this->_lockFile = fopen($file, 'x');
            }
            fwrite($this->_lockFile, date('r'));
        }

        return $this->_lockFile;
    }

    public function lock()
    {
        flock($this->_getLockFile(), LOCK_EX | LOCK_NB);

        return $this;
    }

    public function lockAndBlock()
    {
        flock($this->_getLockFile(), LOCK_EX);

        return $this;
    }

    public function unlock()
    {
        flock($this->_getLockFile(), LOCK_UN);

        return $this;
    }

    public function isLocked()
    {
        $fp = $this->_getLockFile();
        if (flock($fp, LOCK_EX | LOCK_NB)) {
            flock($fp, LOCK_UN);

            return false;
        }

        return true;
    }

    public function __destruct()
    {
        if ($this->_lockFile) {
            fclose($this->_lockFile);
        }
    }
}
