<?php
class Kta_Emi_Block_Form_Emi extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
              parent::_construct();
              $this->setTemplate('emi/form/emi.phtml');
        }
}
