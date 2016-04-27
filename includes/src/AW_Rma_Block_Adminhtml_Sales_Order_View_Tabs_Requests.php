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


class AW_Rma_Block_Adminhtml_Sales_Order_View_Tabs_Requests
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
        $id = $this->getRequest()->getParam('order_id');
        $order = Mage::getModel('sales/order')->load($id);

        $grid = $this->getLayout()->createBlock('awrma/adminhtml_sales_order_view_tabs_requests_grid');
        $grid->setOrderMode($order->getIncrementId());

        $resultHtml = '';
        if (Mage::getSingleton('admin/session')->isAllowed('admin/sales/awrma/createrequest')) {
            $createRequestRule = $this->getUrl(
                'awrma_admin/adminhtml_rma/createrequest', array('order' => $order->getIncrementId())
            );
            $button = $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setClass('add')
                ->setType('button')
                ->setStyle('margin:10px 0;')
                ->setOnClick('window.location.href=\'' . $createRequestRule . '\'')
                ->setLabel('Create request from this order')
            ;
            $resultHtml .= $button->toHtml();
        }
        $resultHtml .= $grid->toHtml();
        return $resultHtml;
    }
}