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



class Mirasvit_Fpc_Helper_Data extends Mage_Core_Helper_Abstract
{
    public $_ignoredUrlParams = array(
        'gclid',
        'utm_source',
        'utm_medium',
        'utm_term',
        'utm_content',
        'utm_campaign',
        '___SID',
    );

    public function setVariable($key, $value)
    {
        $variable = Mage::getModel('core/variable');
        $variable = $variable->loadByCode('fpc_'.$key);

        $variable->setPlainValue($value)
            ->setHtmlValue(Mage::getSingleton('core/date')->gmtTimestamp())
            ->setName($key)
            ->setCode('fpc_'.$key)
            ->save();

        return $variable;
    }

    public function getVariable($key)
    {
        $variable = Mage::getModel('core/variable')->loadByCode('fpc_'.$key);

        return $variable->getPlainValue();
    }

    protected function _getCacheInfo()
    {
        $info = array('size' => 0, 'number' => 0);

        $cache = Mage::getSingleton('fpc/cache')->getCacheInstance();
        $frontend = $cache->getFrontend();
        $backend = $frontend->getBackend();

        $cacheDir = Mage::getBaseDir('cache');
        if (Mirasvit_Fpc_Model_Cache::$cacheDir) {
            $cacheDir = Mirasvit_Fpc_Model_Cache::$cacheDir;
        }
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($cacheDir), RecursiveIteratorIterator::SELF_FIRST);
        foreach ($objects as $name => $object) {
            if ($object->isFile()) {
                $info['size'] += $object->getSize();
                $info['number']++;
            }
        }

        return $info;
    }

    public function getCacheSize()
    {
        $info = $this->_getCacheInfo();

        return $info['size'];
    }

    public function getCacheNumber()
    {
        $info = $this->_getCacheInfo();

        return $info['number'];
    }

    public function getNormlizedUrl($protocol = false)
    {
        $uri = false;

        if (isset($_SERVER['HTTP_HOST'])) {
            $uri = $_SERVER['HTTP_HOST'];
        } elseif (isset($_SERVER['SERVER_NAME'])) {
            $uri = $_SERVER['SERVER_NAME'];
        }

        if ($uri) {
            if (isset($_SERVER['REQUEST_URI'])) {
                $uri .= $_SERVER['REQUEST_URI'];
                $uri = strtok($uri, '?');
            } elseif (!empty($_SERVER['IIS_WasUrlRewritten']) && !empty($_SERVER['UNENCODED_URL'])) {
                $uri .= $_SERVER['UNENCODED_URL'];
            } elseif (isset($_SERVER['ORIG_PATH_INFO'])) {
                $uri .= $_SERVER['ORIG_PATH_INFO'];
            }

            $query = $_GET;
            foreach ($this->_ignoredUrlParams as $param) {
                if (isset($query[$param])) {
                    unset($query[$param]);
                }
            }
            ksort($query);
            $query = http_build_query($query);
            if ($query) {
                $uri .= '?'.$query;
            }
        }

        if ($protocol) {
            $ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? true : false;
            $sp = strtolower($_SERVER['SERVER_PROTOCOL']);
            $protocol = substr($sp, 0, strpos($sp, '/')).(($ssl) ? 's' : '');
            $uri = $protocol.'://'.$uri;
        }

        return $uri;
    }

    public function getOrderSql($orderByAttribute = false)
    {
        $order = array();
        $actions = array();
        foreach (Mage::getSingleton('fpc/config')->getSortByPageType() as $action) {
            $actions[] = "'".$action->getActionOption()."'";
        }
        krsort($actions);
        $order[] = new Zend_Db_Expr('FIELD(sort_by_page_type, '.implode(',', $actions).') desc');
        if ($orderByAttribute) {
            $order[] = 'sort_by_product_attribute asc';
        }
        $order[] = 'rate desc';

        return $order;
    }
}
