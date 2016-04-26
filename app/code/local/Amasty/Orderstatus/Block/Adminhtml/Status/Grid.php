<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Block_Adminhtml_Status_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('order_status_grid');
        $this->setDefaultSort('status');
        $this->setDefaultDir('ASC');
    }
    
    protected function _getCollectionClass()
    {
        return 'amorderstatus/status_collection';
    }
    
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass())->addFieldToFilter('is_system', array('eq' => 0));
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    protected function _prepareColumns()
    {
        $this->addColumn('status', array(
            'header'    => Mage::helper('amorderstatus')->__('Status Name'),
            'index'     => 'status',
        ));
        
        $this->addColumn('is_active', array(
            'header'    =>Mage::helper('amorderstatus')->__('Enabled'),
            'sortable'  =>true,
            'index'     =>'is_active',
            'type'      => 'options',
            'options'   => array(
                '1' => Mage::helper('amorderstatus')->__('Yes'),
                '0' => Mage::helper('amorderstatus')->__('No'),
            ),
            'align'     => 'center',
        ));
        
        $this->addColumn('notify_by_email', array(
            'header'    =>Mage::helper('amorderstatus')->__('E-mail Notification'),
            'sortable'  =>true,
            'index'     =>'notify_by_email',
            'type'      => 'options',
            'options'   => array(
                '1' => Mage::helper('amorderstatus')->__('Enabled'),
                '0' => Mage::helper('amorderstatus')->__('Disabled'),
            ),
            'align'     => 'center',
        ));

        $this->addColumn('action',
            array(
                'header'    => Mage::helper('amorderstatus')->__('Action'),
                'width'     => '80px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('amorderstatus')->__('Edit'),
                        'url'     => array(
                            'base'=>'*/*/edit',
                        ),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
        ));

        return parent::_prepareColumns();
    }
    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}