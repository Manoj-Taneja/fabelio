<?php

class Kta_Emi_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract
{ 
    protected $_code  = 'emi';
    protected $_formBlockType = 'emi/form_emi';
    protected $_infoBlockType = 'emi/info_emi';
    public function getInstructions()
    {
      return trim($this->getMethod()->getConfigData('instructions'));
    }

}
