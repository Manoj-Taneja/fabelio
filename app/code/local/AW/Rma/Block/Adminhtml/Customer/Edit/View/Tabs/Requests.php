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


class AW_Rma_Block_Adminhtml_Customer_Edit_View_Tabs_Requests
    extends Mage_Adminhtml_Block_Widget
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Reference to product objects that is being edited
     *
     * @var Mage_Catalog_Model_Product
     */
    protected $_product = null;
    protected $_config = null;

    protected function _construct()
    {
        parent::_construct();
        $this->setAfter('tags');
    }

    /**
     * Get tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('awrma')->__('RMA Requests');
    }

    public function getTabTitle()
    {
        return Mage::helper('awrma')->__('RMA Requests');
    }

    public function canShowTab()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/sales/awrma/edit');
    }

    /**
     * Check if tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        $id = intval($this->getRequest()->getParam('id'));
        $grid = $this->getLayout()->createBlock('awrma/adminhtml_customer_edit_view_tabs_requests_grid');
        $grid->setCustomerMode($id);

        return $grid->toHtml();
    }
}