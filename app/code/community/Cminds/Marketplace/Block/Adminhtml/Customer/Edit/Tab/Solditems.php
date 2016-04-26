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
class Cminds_Marketplace_Block_Adminhtml_Customer_Edit_Tab_Solditems extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('customer_orders_grid');
        $this->setDefaultSort('created_at', 'desc');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $eavAttribute   = new Mage_Eav_Model_Mysql4_Entity_Attribute();
        $supplier_id    = Mage::registry('current_customer')->getId();
        $code           = $eavAttribute->getIdByCode('catalog_product', 'creator_id');
        $table          = "catalog_product_entity_int";
        $tableName      = Mage::getSingleton("core/resource")->getTableName($table);
        $orderTable = Mage::getSingleton('core/resource')->getTableName('sales/order');

        $collection = Mage::getModel('sales/order_item')->getCollection();
        $collection->getSelect()
            ->joinInner(array('o' => $orderTable), 'o.entity_id = main_table.order_id', array("CONCAT(`customer_firstname`, ' ', `customer_lastname`) AS customer_name",""))
            ->joinInner(array('e' => $tableName), 'e.entity_id = main_table.product_id AND e.attribute_id = ' . $code, array() )
            ->where('main_table.parent_item_id is null')
            ->where('e.value = ?', $supplier_id)
            ->group('o.entity_id');

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('name', array(
            'header'    => Mage::helper('marketplace')->__('Product name'),
            'width'     => '100',
            'index'     => 'name',
        ));
        $this->addColumn('quantity', array(
            'header'    => Mage::helper('marketplace')->__('Quantity'),
            'width'     => '100',
            'index'     => 'qty_ordered',
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('marketplace')->__('Purchase On'),
            'index'     => 'created_at',
            'filter_index'  => 'o.created_at',
            'type'      => 'datetime',
        ));

        $this->addColumn('customer_name', array(
            'header'    => Mage::helper('marketplace')->__('Shipped to Name'),
            'index'     => 'customer_name',
        ));

        $this->addColumn('sub_total', array(
            'header'    => Mage::helper('marketplace')->__('Subtotal'),
            'index'     => 'row_total',
            'type'      => 'currency',
            'currency'  => 'order_currency_code',
        ));

        $this->addColumn('net_income', array(
            'header'    => Mage::helper('marketplace')->__('Net Income'),
            'index'     => 'row_total',
            'renderer' => 'Cminds_Marketplace_Block_Adminhtml_Customer_Edit_Tab_Grid_Net'

        ));

// @todo : add order_id to the link
        $this->addColumn('action', array(
            'header'    => Mage::helper('customer')->__('Action'),
            'index'     => 'order_id',
            'renderer'  => 'adminhtml/customer_grid_renderer_multiaction',
            'filter'    => false,
            'sortable'  => false,
            'actions'   => array(
                array(
                    'caption'   => Mage::helper('customer')->__('View Order'),
                    'url'       => $this->getUrl('*/sales_order/view/order_id/$order_id'),
                    'order_id'   => 'order_id'
                )
            )
        ));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/soldProducts', array('_current' => true));
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/sales_order/view', array('order_id' => $row->getOrderId()));
    }
}
