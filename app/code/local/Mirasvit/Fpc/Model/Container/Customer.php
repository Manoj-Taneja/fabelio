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



class Mirasvit_Fpc_Model_Container_Customer extends Mirasvit_Fpc_Model_Container_Abstract
{
    /**
     * Save data to cache storage and set cache lifetime equal with customer session lifetime.
     *
     * @param string $data
     * @param string $id
     * @param array  $tags
     */
    protected function _saveCache($data, $id, $tags = array(), $lifetime = null)
    {
        $lifetime = Mage::getConfig()->getNode(Mage_Core_Model_Session_Abstract::XML_PATH_COOKIE_LIFETIME);

        return parent::_saveCache($data, $id, $tags, $lifetime);
    }
}
