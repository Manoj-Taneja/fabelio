<?php
class MyCalender_Calender_Block_Adminhtml_Holiday_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // Instantiate a new form to display our holiday for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'mycalender_calender_admin/holiday/edit',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
        ));
        $form->setUseContainer(true);
        $this->setForm($form);

        // Define a new fieldset. We need only one for our simple entity.
        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Holiday Details')
            )
        );

        $holidaySingleton = Mage::getSingleton(
            'mycalender_calender/holiday'
        );

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'holiday_start_date' => array(
                'label' => $this->__('Holiday Start Date'),
                'input' => 'date',
				'onchange' => "document.getElementById('holiday_end_date').value=this.value;",
                'tabindex' => 1,
				'image' => $this->getSkinUrl('images/grid-cal.gif'),
				'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            ),
            'holiday_end_date' => array(
                'label' => $this->__('Holiday End Date'),
                'input' => 'date',
                'tabindex' => 1,
				'image' => $this->getSkinUrl('images/grid-cal.gif'),
				'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            ),
            'holiday_description' => array(
                'label' => $this->__('Description'),
                'input' => 'textarea',
                'required' => true,
            ),

            /**
             * Note: we have not included created_at or updated_at.
             * We will handle those fields ourself in the model
       * before saving.
             */
        ));

        return $this;
    }

    /**
     * This method makes life a little easier for us by pre-populating
     * fields with $_POST data where applicable and wrapping our post data
     * in 'holidayData' so that we can easily separate all relevant information
     * in the controller. You could of course omit this method entirely
     * and call the $fieldset->addField() method directly.
     */
    protected function _addFieldsToFieldset(
        Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()
            ->getPost('holidayData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with holidayData group.
            $_data['name'] = "holidayData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing holiday data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getHoliday()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing holiday for pre-populating the form fields.
     * For a new holiday entry, this will return an empty holiday object.
     */
    protected function _getHoliday()
    {
        if (!$this->hasData('holiday')) {
            // This will have been set in the controller.
            $holiday = Mage::registry('current_holiday');

            // Just in case the controller does not register the holiday.
            if (!$holiday instanceof
                    MyCalender_Calender_Model_Holiday) {
                $holiday = Mage::getModel(
                    'mycalender_calender/holiday'
                );
            }

            $this->setData('holiday', $holiday);
        }

        return $this->getData('holiday');
    }
}
?>