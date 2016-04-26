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



class Mirasvit_Fpc_Model_Storage extends Varien_Object
{
    public function save()
    {
        $cache = Mirasvit_Fpc_Model_Cache::getCacheInstance();
        $cache->save(serialize($this->getData()), $this->getCacheId(), $this->getCacheTags(), $this->getCacheLifetime());

        return $this;
    }

    public function load()
    {
        $cache = Mirasvit_Fpc_Model_Cache::getCacheInstance();
        $content = $cache->load($this->getCacheId());
        if ($content) {
            $data = unserialize($content);
            $this->setData($data);

            return $this;
        }

        return false;
    }
}
