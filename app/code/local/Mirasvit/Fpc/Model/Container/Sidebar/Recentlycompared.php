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



class Mirasvit_Fpc_Model_Container_Sidebar_Recentlycompared extends Mirasvit_Fpc_Model_Container_Abstract
{
    /**
     * Get identifier from cookies.
     *
     * @return string
     */
    protected function _getIdentifier()
    {
        // return $this->_getCookieValue(Mirasvit_Fpc_Model_Cookie::COOKIE_RECENTLY_COMPARED, '')
        //     . $this->_getCookieValue(Mirasvit_Fpc_Model_Cookie::COOKIE_CUSTOMER, '');
    }

    /**
     * Get cache identifier.
     *
     * @return string
     */
    protected function _getCacheId()
    {
        return 'CONTAINER_RECENTLYCOMPARED_'.$this->_getIdentifier();
    }

    /**
     * Render block content.
     *
     * @return string
     */
    protected function _renderBlock()
    {
        $block = $this->_placeholder->getAttribute('block');
        $template = $this->_placeholder->getAttribute('template');

        $block = new $block();
        $block->setTemplate($template);

        return $block->toHtml();
    }
}
