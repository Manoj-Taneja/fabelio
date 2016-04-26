<?php
/**
 * Zeon Solutions, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Zeon Solutions License
 * that is bundled with this package in the file LICENSE_ZE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.zeonsolutions.com/license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zeonsolutions.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * versions in the future. If you wish to customize this extension for your
 * needs please refer to http://www.zeonsolutions.com for more information.
 *
 * @category    Zeon
 * @package     Zeon_Jobs
 * @copyright   Copyright (c) 2012 Zeon Solutions, Inc. All Rights Reserved.(http://www.zeonsolutions.com)
 * @license     http://www.zeonsolutions.com/license/
 */

class Zeon_Jobs_Block_Adminhtml_Category_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set defaults
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('categoryGrid');
        $this->setDefaultSort('category_id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
    /**
     * Instantiate and prepare collection
     *
     * @return Zeon_Jobs_Block_Adminhtml_Category_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('zeon_jobs/category_collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    /**
     * Define grid columns
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'category_id', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('ID'),
                'type'  => 'number',
                'width'    => '1',
                'index'    => 'category_id',
            )
        );

        $this->addColumn(
            'category_title', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Department Name'),
                'type'   => 'text',
                'index'    => 'title',
            )
        );

        $this->addColumn(
            'category_update_time', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Last Updated'),
                'type'    => 'datetime',
                'index'    => 'update_time',
            )
        );

        $this->addColumn(
            'category_status', 
            array(
                'header'=> Mage::helper('zeon_jobs')->__('Status'),
                'align'    => 'center',
                'width'    => 1,
                'index'    => 'status',
                'type'    => 'options',
                'options'=> Mage::getModel('zeon_jobs/status')->getAllOptions(),
            )
        );

        $this->addColumn(
            'action', 
            array(
                'header'    =>  Mage::helper('zeon_jobs')->__('Action'),
                'width'     => '50',
                'type'      => 'action',
                'align'     => 'center',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('zeon_jobs')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
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
        $this->setMassactionIdField('category_id');
        $this->getMassactionBlock()->setFormFieldName('category');

        $this->getMassactionBlock()->addItem(
            'delete', 
            array(
                'label'        => Mage::helper('zeon_jobs')->__('Delete'),
                'url'        => $this->getUrl('*/*/massDelete'),
                'confirm'    => Mage::helper('zeon_jobs')->__('Are you sure you want to delete these category?')
            )
        );
        return $this;
    }
    /**
     * Grid row URL getter
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getCategoryId()));
    }
    /**
     * Define row click callback
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}