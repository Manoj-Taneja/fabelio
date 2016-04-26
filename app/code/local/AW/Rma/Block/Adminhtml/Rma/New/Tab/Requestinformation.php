<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Rma
 * @version    1.5.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Rma_Block_Adminhtml_Rma_New_Tab_Requestinformation extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $details = $form->addFieldset(
            'order_form',
            array(
                'legend' => $this->__('Request Details')
            )
        );

        $afterElementHtml = '<div id="orders-list">'
            . '<select id="order-selector" name="order" class="required-entry"></select>'
            . '</div>'
        ;
        $details->addField(
            'order_input', 'text',
            array(
                'name'               => 'order_input',
                'label'              => $this->__('Order ID'),
                'class'              => 'awrma-tip',
                'value'              => $this->__("start type order's id"),
                'after_element_html' => $afterElementHtml
            )
        );

        $details->addField(
            'packageopened', 'select',
            array(
                'name'   => 'packageopened',
                'label'  => $this->__('Package Opened'),
                'values' => Mage::getModel('awrma/source_packageopened')->toOptionArray(),
            )
        );
    }
}