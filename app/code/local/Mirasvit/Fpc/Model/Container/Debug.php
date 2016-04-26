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



class Mirasvit_Fpc_Model_Container_Debug extends Mirasvit_Fpc_Model_Container_Abstract
{
    protected function _getCacheId()
    {
        if (Mirasvit_Fpc_Model_Config::isDebug()) {
            return 'CONTAINER_FPC_DEBUG_'.microtime(true);
        }

        return false;
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
        $block->setLayout(Mage::app()->getLayout());

        return $block->toHtml();
    }
}
