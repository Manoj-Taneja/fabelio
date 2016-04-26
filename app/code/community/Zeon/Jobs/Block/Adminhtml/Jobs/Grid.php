<?php

/**
 * zeonsolutions inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.zeonsolutions.com/shop/license-community.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * This package designed for Magento COMMUNITY edition
 * =================================================================
 * zeonsolutions does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * zeonsolutions does not provide extension support in case of
 * incorrect edition usage.
 * =================================================================
 *
 * @category   Zeon
 * @package    Zeon_Jobs
 * @version    0.0.1
 * @copyright  @copyright Copyright (c) 2013 zeonsolutions.Inc. (http://www.zeonsolutions.com)
 * @license    http://www.zeonsolutions.com/shop/license-community.txt
 */
class Zeon_Jobs_Block_Adminhtml_Jobs_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set defaults
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('jobsGrid');
        $this->setDefaultSort('job_id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
    /**
     * Instantiate and prepare collection
     *
     * @return Zeon_Jobs_Block_Adminhtml_Jobs_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('zeon_jobs/jobs_collection');
        $collection->getSelect()->distinct()
            ->joinLeft(
                array('zjc' => Mage::getResourceModel('zeon_jobs/category')->getTable('zeon_jobs/category')), 
                'main_table.category_id = zjc.category_id',
                array('category_name'=>'title')
            );
        if (!Mage::app()->isSingleStoreMode()) {
            $collection->addStoresVisibility();
        }		
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    /**
     * Define grid columns
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'job_id', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Job ID'),
                'type'  => 'number',
                'width' => '1',
                'index' => 'job_id',
            )
        );

        $this->addColumn(
            'job_code', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Job Code'),
                'type'  => 'text',
                'width' => '1',
                'index' => 'job_code',
            )
        );

        $this->addColumn(
            'job_title', 
            array(
                'header' => Mage::helper('zeon_jobs')->__('Job Title'),
                'type'   => 'text',
                'index'  => 'title',
            )
        );

        $this->addColumn(
            'job_category', 
            array(
                'header'   => Mage::helper('zeon_jobs')->__('Job Department'),
                'type'     => 'text',
                'index'    => 'category_name',
            )
        );

        $this->addColumn(
            'job_update_time', 
            array(
                'header' => Mage::helper('zeon_jobs')->__('Last Updated'),
                'type'   => 'datetime',
                'index'  => 'update_time',
            )
        );

        $this->addColumn(
            'job_status', 
            array(
                'header'  => Mage::helper('zeon_jobs')->__('Status'),
                'align'   => 'center',
                'width'   => 1,
                'index'   => 'status',
                'type'    => 'options',
                'options' => Mage::getModel('zeon_jobs/status')->getAllOptions()
            )
        );

        /**
         * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn(
                'visible_in', 
                array(
                    'header'     => Mage::helper('zeon_jobs')->__('Visible In'),
                    'type'       => 'store',
                    'index'      => 'stores',
                    'sortable'   => false,
                    'store_view' => true,
                    'width'      => 200
                )
            );
        }

        $this->addColumn(
            'action',
            array(
                'header'  => Mage::helper('zeon_jobs')->__('Action'),
                'width'   => '50',
                'type'    => 'action',
                'align'   => 'center',
                'getter'  => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('zeon_jobs')->__('Edit'),
                        'url'     => array('base'=> '*/*/edit'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'is_system' => true,
            )
        );
        return parent::_prepareColumns();
    }
    /**
     * Prepare mass action options for this grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('job_id');
        $this->getMassactionBlock()->setFormFieldName('jobs');

        $this->getMassactionBlock()->addItem(
            'delete', 
            array(
                'label'        => Mage::helper('zeon_jobs')->__('Delete'),
                'url'        => $this->getUrl('*/*/massDelete'),
                'confirm'    => Mage::helper('zeon_jobs')->__('Are you sure you want to delete these job(s)?')
            )
        );
        return $this;
    }
    /**
     * Grid row URL getter
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    /**
     * Define row click callback
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    /**
     * Add store filter
     *
     * @param Mage_Adminhtml_Block_Widget_Grid_Column  $column
     * @return Zeon_News_Block_Adminhtml_News_Grid
     */
    protected function _addColumnFilterToCollection($column)
    {
        if ($column->getIndex() == 'stores') {
            $this->getCollection()->addStoreFilter($column->getFilter()->getCondition(), false);
        } elseif ($column->getIndex() == 'category_name') {
            $this->getCollection()->addCategoryFilter($column->getFilter()->getCondition());
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }
}