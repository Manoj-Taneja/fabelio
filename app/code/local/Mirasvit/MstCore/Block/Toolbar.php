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


class Mirasvit_MstCore_Block_Toolbar extends Mage_Core_Block_Template
{
    protected $_panels = array();

    public function _construct()
    {
        $this->addPanel('mstcore/toolbar_panel_timer');
        $this->addPanel('mstcore/toolbar_panel_sql');

        return parent::_construct();
    }

    public function _prepareLayout()
    {
        $this->setTemplate('mstcore/toolbar.phtml');
        
        Mage::dispatchEvent('mstcore_toolbar_prepare', array('toolbar' => $this));
    }

    public function getPanels()
    {
        $result = array();
        foreach ($this->_panels as $panel) {
            $panel = Mage::app()->getLayout()->createBlock($panel);
            $result[] = $panel;
        }
        
        return $result;
    }

    public function addPanel($name)
    {
        $this->_panels[$name] = $name;
    }
}