<?php
class Cminds_Marketplace_Block_Adminhtml_Supplier_Customfields_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('id');
        $this->setId('supplier_list_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('marketplace/fields')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('marketplace')->__('ID'),
            'width'     => '50px',
            'index'     => 'id',
            'type'  => 'number',
        ));
        $this->addColumn('name', array(
            'header'    => Mage::helper('marketplace')->__('Name'),
            'index'     => 'name',
        ));
        $this->addColumn('label', array(
            'header'    => Mage::helper('marketplace')->__('Label'),
            'index'     => 'label',
        ));
        $this->addColumn('type', array(
            'header'    => Mage::helper('marketplace')->__('Type'),
            'index'     => 'type',
        ));
        $this->addColumn('is_required', array(
            'header'    => Mage::helper('marketplace')->__('Required'),
            'index'     => 'is_required',
            'type'  => 'options',
            'options' => array(
                0 => 'No',
                1 => 'Yes',
            )
        ));
        $this->addColumn('must_be_approved', array(
            'header'    => Mage::helper('marketplace')->__('Must be Approved'),
            'index'     => 'must_be_approved',
            'type'  => 'options',
            'options' => array(
                0 => 'No',
                1 => 'Yes',
            )
        ));
        $this->addColumn('is_system', array(
            'header'    => Mage::helper('marketplace')->__('Is System'),
            'index'     => 'is_system',
            'type'  => 'options',
            'options' => array(
                0 => 'No',
                1 => 'Yes',
            )
        ));
        $this->addColumn('created_at', array(
            'header'    => Mage::helper('marketplace')->__('Created At'),
            'index'     => 'created_at',
        ));

        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('marketplace')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('marketplace')->__('Edit'),
                        'url'       => array('base'=> '*/suppliers/editCustomField'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
            ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/suppliers/editCustomField', array('id' => $row->getId()));
    }
}