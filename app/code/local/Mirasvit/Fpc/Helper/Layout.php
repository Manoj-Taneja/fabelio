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



class Mirasvit_Fpc_Helper_Layout
{
    public static $_layoutXml = null;

    public function generateBlockLayoutXML($blockName)
    {
        if (self::$_layoutXml == null) {
            self::$_layoutXml = Mage::app()->getLayout()->getUpdate()->asSimplexml();
        }

        $xpathes = array();
        $xpathes[] = "//block[@name='{$blockName}']";
        $xpathes[] = "//reference[@name='{$blockName}']";
        $xpathes[] = "//block[@type='custommenu/toggle']";
        $xpathes[] = "//block[@name='head']";

        $sections = self::$_layoutXml->xpath(implode('|', $xpathes));

        $layoutXml = '';
        foreach ($sections as $section) {
            $layoutXml .= $this->_generateSubBlockLayoutXml($section);
        }

        $layout = new Mage_Core_Model_Layout();
        $layout->getUpdate()->addUpdate($layoutXml);
        $layout->generateXml();
        $layoutXml = $layout->getXmlString();

        return $layoutXml;
    }

    protected function _generateSubBlockLayoutXml($section)
    {
        $layoutXml = $section->asXML();
        foreach ($section->xpath('block') as $block) {
            foreach (self::$_layoutXml->xpath("//reference[@name='{$block->getBlockName()}']") as $subSection) {
                $layoutXml .= self::_generateSubBlockLayoutXml($subSection);
            }
        }

        return $layoutXml;
    }

    public function renderBlock($definition)
    {
        Mage::getSingleton('core/layout');

        $layout = new Mage_Core_Model_Layout($definition['layout']);

        Mage::unregister('_singleton/core/layout');
        Mage::register('_singleton/core/layout', $layout, true);

        $layout->setBlock('head', new Varien_Object());
        $layout->generateBlocks();

        $block = $layout->getBlock($definition['block_name']);
        $html = '';
        if ($block) {
            $html = $block->toHtml();
        }

        return $html;
    }
}
