<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Rma
 * @version    1.5.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Rma_Block_Adminhtml_Status_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('awrma_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($this->__('RMA Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'status_information',
            array(
                'label'  => $this->__('Main Settings'),
                'title'  => $this->__('Main Settings'),
                'content' => $this->getLayout()->createBlock('awrma/adminhtml_status_edit_tab_settings')->toHtml(),
            )
        );

        $this->addTab(
            'stores',
            array(
                'label'  => $this->__('Store Templates'),
                'title'  => $this->__('Store Templates'),
                'content' => $this->getLayout()->createBlock('awrma/adminhtml_status_edit_tab_templates')->toHtml(),
            )
        );
        return parent::_beforeToHtml();
    }
}