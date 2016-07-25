<?php
class MyCalender_Calender_Block_Adminhtml_Holiday_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        /**
         * Tell Magento which collection to use to display in the grid.
         */
        $collection = Mage::getResourceModel(
            'mycalender_calender/holiday_collection'
        );
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {
        /**
         * When a grid row is clicked, this is where the user should
         * be redirected to - in our example, the method editAction of
         * HolidayController.php in Calender module.
         */
        return $this->getUrl(
            'mycalender_calender_admin/holiday/edit',
            array(
                'id' => $row->getId()
            )
        );
    }

    protected function _prepareColumns()
    {
        /**
         * Here, we'll define which columns to display in the grid.
         */
        $this->addColumn('holiday_id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'holiday_id',
        ));

        

        $this->addColumn('holiday_start_date', array(
            'header' => $this->_getHelper()->__('Holiday Start Date'),
            'type' => 'date',
            'index' => 'holiday_start_date',
        ));

        $this->addColumn('holiday_end_date', array(
            'header' => $this->_getHelper()->__('Holiday End Date'),
            'type' => 'date',
            'index' => 'holiday_end_date',
        ));
		$this->addColumn('holiday_description', array(
            'header' => $this->_getHelper()->__('Description'),
            'type' => 'text',
            'index' => 'holiday_description',
        ));
		$this->addColumn('created_at', array(
            'header' => $this->_getHelper()->__('Created'),
            'type' => 'datetime',
            'index' => 'created_at',
        ));

        $this->addColumn('updated_at', array(
            'header' => $this->_getHelper()->__('Updated'),
            'type' => 'datetime',
            'index' => 'updated_at',
        ));
        $holidaySingleton = Mage::getSingleton(
            'mycalender_calender/holiday'
        );
        /*$this->addColumn('visibility', array(
            'header' => $this->_getHelper()->__('Visibility'),
            'type' => 'options',
            'index' => 'visibility',
            'options' => $holidaySingleton->getAvailableVisibilies()
        ));/**/

        /**
         * Finally, we'll add an action column with an edit link.
         */
        $this->addColumn('action', array(
            'header' => $this->_getHelper()->__('Action'),
            'width' => '50px',
            'type' => 'action',
            'actions' => array(
                array(
                    'caption' => $this->_getHelper()->__('Edit'),
                    'url' => array(
                        'base' => 'mycalender_calender_admin'
                                  . '/holiday/edit',
                    ),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'holiday_id',
        ));

        return parent::_prepareColumns();
    }

    protected function _getHelper()
    {
        return Mage::helper('mycalender_calender');
    }
	
	protected function _prepareMassaction()
    {
        $this->setMassactionIdField('holiday_id');
        $this->getMassactionBlock()->setFormFieldName('holiday');
 
        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => $this->_getHelper()->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => $this->_getHelper()->__('Are you sure?')
        ));
 
       
        return $this;
    }
}
?>