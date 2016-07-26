<?php
class MyCalender_Calender_Model_Resource_Holiday extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        /**
         * Tell Magento the database name and primary key field to persist
         * data to. Similar to the _construct() of our model, Magento finds
         * this data from config.xml by finding the <resourceModel/> node
         * and locating children of <entities/>.
         *
         * In this example:
         * - mycalender_calender is the model alias
         * - holiday is the entity referenced in config.xml
         * - holiday_id is the name of the primary key column
         *
         * As a result, Magento will write data to the table
         * 'mycalender_calender_holiday' and any calls
         * to $model->getId() will retrieve the data from the
         * column named 'holiday_id'.
         */
        $this->_init('mycalender_calender/holiday', 'holiday_id');
    }
}
?>