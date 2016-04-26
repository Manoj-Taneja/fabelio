<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

/**
 * Created by PhpStorm.
 * User: sumrak
 * Date: 18.12.2014
 * Time: 15:41
 */

class Amasty_Xlanding_Block_Adminhtml_Renderer_Condition extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {
    protected function _getValue(Varien_Object $row)
    {
        $value = parent::_getValue($row);
        $value = Mage::helper('amlanding/import')->encodeConditionForCsv($value);
        return $value;
    }


}