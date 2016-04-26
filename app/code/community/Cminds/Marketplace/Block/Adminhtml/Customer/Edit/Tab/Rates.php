<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml customer orders grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Cminds_Marketplace_Block_Adminhtml_Customer_Edit_Tab_Rates extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('customer_rates_grid');
        $this->setDefaultSort('created_at', 'desc');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $supplier_id    = Mage::registry('current_customer')->getId();

        $collection = Mage::getModel('marketplace/rating')->getCollection()->addFieldtoFilter('supplier_id', $supplier_id);

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('customer_id', array(
            'header'    => Mage::helper('marketplace')->__('Customer ID'),
            'index'     => 'customer_id',
        ));

        $this->addColumn('customer_name', array(
            'header'    => Mage::helper('marketplace')->__('Customer Name'),
            'index'     => 'customer_id',
            'renderer'     => 'Cminds_Marketplace_Block_Adminhtml_Customer_Edit_Tab_Grid_Customername',
        ));

        $this->addColumn('rate', array(
            'header'    => Mage::helper('marketplace')->__('Rate'),
            'index'     => 'rate',
        ));

        $this->addColumn('created_on', array(
            'header'    => Mage::helper('marketplace')->__('Voted On'),
            'index'     => 'created_on',
            'type'      => 'datetime',
        ));

        $this->addColumn('action', array(
            'header'    => Mage::helper('customer')->__('Action'),
            'index'     => 'order_id',
            'renderer'  => 'adminhtml/customer_grid_renderer_multiaction',
            'filter'    => false,
            'sortable'  => false,
            'actions'   => array(
                array(
                    'caption'   => Mage::helper('customer')->__('Cancel'),
                    'url'       => $this->getUrl('*/suppliers/removeRate/rate/$id/customer_id/$customer_id'),
                    'confirm'   => $this->__("Are you sure to cancel this rate ? This action can not be reverted !"),
                    'id'        => 'id',
                    'customer_id'        => 'customer_id',
                )
            )
        ));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/rates', array('_current' => true));
    }

    public function getRowUrl($row)
    {
        return false;
    }
}
