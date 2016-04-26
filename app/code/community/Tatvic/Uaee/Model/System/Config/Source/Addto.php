<?php
/**
 * @package
 * @author Dvs.spy (divyesh@tatvic.com)
 * @license Tatvic Enhanced Ecommerce
 */
class Tatvic_Uaee_Model_System_Config_Source_Addto
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'head', 'label'=>Mage::helper('tatvic_uaee')->__('Head')),
          //  array('value' => 'before_body_end', 'label'=>Mage::helper('tatvic_uaee')->__('Before Body End')),
        );
    }
}