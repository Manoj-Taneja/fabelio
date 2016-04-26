<?php
class Kontenta_Status_Model_Sales_Order extends Mage_Sales_Model_Order
{
	public function setPrimaryState($state, $status = false, $comment = '', $isCustomerNotified = null)
	{
		return $this->_setState($state, $status, $comment, $isCustomerNotified, false);
	}

    protected function _checkState()
    {
        return $this;
    }
}