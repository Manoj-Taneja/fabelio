<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */ 
class Amasty_Xlanding_Block_Adminhtml_Page_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('ruleGrid');
		$this->setDefaultSort('pos');
  	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel('amlanding/page')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
  	}

	protected function _prepareColumns()
	{
		$hlp =  Mage::helper('amlanding'); 
    
		$this->addColumn('pade_id', array(
			'header'    => $hlp->__('ID'),
			'align'     => 'right',
			'width'     => '50px',
			'index'     => 'page_id',
    	));
    
	    $this->addColumn('title', array(
			'header'    => $hlp->__('Title'),
	        'align'     => 'left',
	        'index'     => 'title',
		));

		$this->addColumn('identifier', array(
	    	'header'    => $hlp->__('URL Key'),
	        'align'     => 'left',
	        'index'     => 'identifier'
		));
		
		$this->addColumn('is_active', array(
            'header'    => Mage::helper('cms')->__('Status'),
            'index'     => 'is_active',
            'type'      => 'options',
            'options'   => $hlp->getAvailableStatuses()
        ));
 
		
		if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => Mage::helper('cms')->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback'
                                => array($this, '_filterStoreCondition'),
            ));
        }

        $this->addExportType('*/*/exportCsv', Mage::helper('amlanding')->__('CSV'));
	    return parent::_prepareColumns();
  	}

	public function getRowUrl($row)
	{
		return $this->getUrl('adminhtml/lpage/edit', array('id' => $row->getPageId()));
	}
  
 	protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addStoreFilter($value);
    }
    
    protected function _prepareMassaction()
    {
	    $this->setMassactionIdField('page_id');
	    $this->getMassactionBlock()->setFormFieldName('pages');
	    
	    $actions = array(
	        'massActivate'   => 'Activate',
	        'massInactivate' => 'Inactivate',
	        'massDelete'     => 'Delete',
	    );
	    foreach ($actions as $code => $label){
	        $this->getMassactionBlock()->addItem($code, array(
	             'label'    => Mage::helper('amlanding')->__($label),
	             'url'      => $this->getUrl('adminhtml/lpage/' . $code),
	             'confirm'  => ($code == 'massDelete' ? Mage::helper('amlanding')->__('Are you sure?') : null),
	        ));        
	    }
	    return $this; 
	}
}