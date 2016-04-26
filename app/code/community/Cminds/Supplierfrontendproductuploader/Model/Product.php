<?php
class Cminds_Supplierfrontendproductuploader_Model_Product extends Mage_Core_Model_Abstract {
    protected $_valid;
    
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DISAPPROVED = 2;
    const STATUS_NONACTIVE = 3;

    public function validate($isConfigurable = false) {
        $this->_valid = true;

        $data = $this->getData();

        $error = '';
        if (!Zend_Validate::is($data['name'], 'NotEmpty')) {
            $error = 'Name is empty';
        }
        if (!Zend_Validate::is($data['price'], 'NotEmpty')) {
            $error = 'Price is empty';
        }
        if (!Zend_Validate::is($data['short_description'], 'NotEmpty')) {
            $error = 'Short description is empty';
        }
        if (!Zend_Validate::is($data['description'], 'NotEmpty')) {
            $error = 'Description is empty';
        }
        if ($isConfigurable && ((isset($data['weight']) && !Zend_Validate::is($data['weight'], 'NotEmpty')))) {
            $error = 'Weight is empty';
        }
        if ($isConfigurable && ((isset($data['qty']) && !Zend_Validate::is($data['qty'], 'NotEmpty')))) {
            $error = 'Qty is empty';
        }
        
        $isStartDate = false;
        if (Zend_Validate::is($data['special_price_from_date'], 'NotEmpty')) {
            $isStartDate = true;
        }
        
        $isStartDate = false;
        if (Zend_Validate::is($data['special_price_to_date'], 'NotEmpty')) {
            if($isStartDate) {
                $endDate = new DateTime($data['special_price_to_date']);
                $startDate = new DateTime($data['special_price_from_date']);

                if($startDate > $endDate) {
                    $error = 'Special Price start date can not be higher than special price start date';
                }
            }
        }

        if(!isset($data['category']) || count($data['category']) < 1) {
            $error = 'Please select category';
        }

        if ($error != '') {
            throw new Exception($error);
        }
    }

    public function isValid() {
        return $this->_valid;
    }
}
