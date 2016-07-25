<?php
class MyCalender_Calender_Adminhtml_HolidayController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Instantiate our grid container block and add to the page content.
     * When accessing this admin index page, we will see a grid of all
     * holidays currently available in our Magento instance, along with
     * a button to add a new one if we wish.
     */
    public function indexAction()
    {
        // instantiate the grid container
        $holidayBlock = $this->getLayout()
            ->createBlock('mycalender_calender_adminhtml/holiday');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($holidayBlock)
            ->renderLayout();
    }

    /**
     * This action handles both viewing and editing existing holidays.
     */
    public function editAction()
    {
        /**
         * Retrieve existing holiday data if an ID was specified.
         * If not, we will have an empty holiday entity ready to be populated.
         */
        $holiday = Mage::getModel('mycalender_calender/holiday');
        if ($holidayId = $this->getRequest()->getParam('id', false)) {
            $holiday->load($holidayId);

            if ($holiday->getId() < 1) {
                $this->_getSession()->addError(
                    $this->__('This holiday no longer exists.')
                );
                return $this->_redirect(
                    'mycalender_calender_admin/holiday/index'
                );
            }
        }

        // process $_POST data if the form was submitted
        if ($postData = $this->getRequest()->getPost('holidayData')) {
            try {
                $holiday->addData($postData);
                $holiday->save();

                $this->_getSession()->addSuccess(
                    $this->__('The holiday has been saved.')
                );
				$redirectBack   = $this->getRequest()->getParam('back', false);
				$storeId        = $this->getRequest()->getParam('store');
				if ($redirectBack) {
           
				} else {
					return $this->_redirect('*/*/', array('store'=>$storeId));
				}
                // redirect to remove $_POST data from the request
				//return $this->_redirect('*/*/', array('store'=>$storeId));
                /*return $this->_redirect(
                    'mycalender_calender_admin/holiday/edit',
                    array('id' => $holiday->getId())
                );/**/
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

            /**
             * If we get to here, then something went wrong. Continue to
             * render the page as before, the difference this time being
             * that the submitted $_POST data is available.
             */
        }

        // Make the current holiday object available to blocks.
        Mage::register('current_holiday', $holiday);

        // Instantiate the form container.
        $holidayEditBlock = $this->getLayout()->createBlock(
            'mycalender_calender_adminhtml/holiday_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($holidayEditBlock)
            ->renderLayout();
    }

    public function deleteAction()
    {
        $holiday = Mage::getModel('mycalender_calender/holiday');

        if ($holidayId = $this->getRequest()->getParam('id', false)) {
            $holiday->load($holidayId);
        }

        if ($holiday->getId() < 1) {
            $this->_getSession()->addError(
                $this->__('This holiday no longer exists.')
            );
            return $this->_redirect(
                'mycalender_calender_admin/holiday/index'
            );
        }

        try {
            $holiday->delete();

            $this->_getSession()->addSuccess(
                $this->__('The holiday has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'mycalender_calender_admin/holiday/index'
        );
    }

    /**
     * Thanks to Ben for pointing out this method was missing. Without
     * this method the ACL rules configured in adminhtml.xml are ignored.
     */
    protected function _isAllowed()
    {
        /**
         * we include this switch to demonstrate that you can add action
         * level restrictions in your ACL rules. The isAllowed() method will
         * use the ACL rule we have configured in our adminhtml.xml file:
         * - acl
         * - - resources
         * - - - admin
         * - - - - children
         * - - - - - mycalender_calender
         * - - - - - - children
         * - - - - - - - holiday
         *
         * eg. you could add more rules inside holiday for edit and delete.
         */
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
                // intentionally no break
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('mycalender_calender/holiday');
                break;
        }

        return $isAllowed;
    }
	
	public function massDeleteAction()
    {
		
		if ($holidayIds = $this->getRequest()->getParam('holiday', false)) {
			$holiday = Mage::getModel('mycalender_calender/holiday');
			foreach($holidayIds as $holidayId){
			   $holiday->load($holidayId);
			   $holiday->delete();
			}
        }
		$this->_getSession()->addSuccess(
            $this->__('The holidays has been deleted.')
        );
		return $this->_redirect(
            'mycalender_calender_admin/holiday/index'
        );
	}
	
}
?>