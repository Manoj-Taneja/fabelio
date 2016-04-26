<?php

/**
 * Magestore
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventory Shipping Method Grid Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventorypurchasing_Block_Adminhtml_Shippingmethod_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('shippingmethodGrid');
        $this->setDefaultSort('shipping_method_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * prepare collection for block to display
     *
     * @return Magestore_Inventory_Block_Adminhtml_Shippingmethod_Grid
     */
    protected function _prepareCollection() {
        $collection = Mage::getModel('inventorypurchasing/shippingmethod')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare columns for this grid
     *
     * @return Magestore_Inventory_Block_Adminhtml_Shippingmethod_Grid
     */
    protected function _prepareColumns() {
        $this->addColumn('shipping_method_id', array(
            'header' => Mage::helper('inventorypurchasing')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'type' => 'number',
            'index' => 'shipping_method_id',
        ));

        $this->addColumn('shipping_method_name', array(
            'header' => Mage::helper('inventorypurchasing')->__('Shipping Method Name'),
            'align' => 'left',
            'width' => '250px',
            'index' => 'shipping_method_name',
        ));

        $this->addColumn('description', array(
            'header' => Mage::helper('inventorypurchasing')->__('Description'),
            'index' => 'description',
        ));

        $this->addColumn('shipping_method_status', array(
            'header' => Mage::helper('inventorypurchasing')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'shipping_method_status',
            'type' => 'options',
            'options' => array(
                1 => Mage::helper('inventorypurchasing')->__('Active'),
                0 => Mage::helper('inventorypurchasing')->__('Inactive'),
            ),
        ));

        $this->addColumn('created_by', array(
            'header' => Mage::helper('inventorypurchasing')->__('Created By'),
            'align' => 'left',
            'index' => 'created_by',
            'width' => '100px',
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('inventorypurchasing')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('inventorypurchasing')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
            )),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('inventorypurchasing')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('inventorypurchasing')->__('XML'));

        return parent::_prepareColumns();
    }

    /**
     * prepare mass action for this grid
     *
     * @return Magestore_Inventory_Block_Adminhtml_Supplier_Grid
     */
    protected function _prepareMassaction() {
        $this->setMassactionIdField('shipping_method_id');
        $this->getMassactionBlock()->setFormFieldName('shippingmethod_ids');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('inventorypurchasing')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('inventorypurchasing')->__('Are you sure?')
        ));

        $statuses = array(
            1 => Mage::helper('inventorypurchasing')->__('Active'),
            0 => Mage::helper('inventorypurchasing')->__('Inactive')
        );

//        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('inventorypurchasing')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('inventorypurchasing')->__('Status'),
                    'values' => $statuses
            ))
        ));
        return $this;
    }

    /**
     * get url for each row in grid
     *
     * @return string
     */
    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}