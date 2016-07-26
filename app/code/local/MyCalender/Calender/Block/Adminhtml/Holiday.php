<?php
class MyCalender_Calender_Block_Adminhtml_Holiday extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {	
        
		$this->_addButtonLabel = $this->__('Add Holiday');
        
        /**
         * The $_blockGroup property tells Magento which alias to use to
         * locate the blocks to be displayed in this grid container.
         * In our example, this corresponds to Calender/Block/Adminhtml.
         */
        $this->_blockGroup = 'mycalender_calender_adminhtml';

        /**
         * $_controller is a slightly confusing name for this property.
         * This value, in fact, refers to the folder containing our
         * Grid.php and Edit.php - in our example,
         * Calender/Block/Adminhtml/Holiday. So, we'll use 'holiday'.
         */
        $this->_controller = 'holiday';

        /**
         * The title of the page in the admin panel.
         */
        $this->_headerText = Mage::helper('mycalender_calender')
            ->__('Holiday Calender');
    }

    public function getCreateUrl()
    {
        /**
         * When the "Add" button is clicked, this is where the user should
         * be redirected to - in our example, the method editAction of
         * HolidayController.php in Calender module.
         */
        return $this->getUrl(
            'mycalender_calender_admin/holiday/edit'
        );
    }
	
	
}
?>