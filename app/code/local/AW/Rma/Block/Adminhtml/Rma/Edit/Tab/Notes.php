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


class AW_Rma_Block_Adminhtml_Rma_Edit_Tab_Notes extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $formData = Mage::registry('awrmaformdatarma');

        $adminnotes = $form->addFieldset(
            'admin_notes_container',
            array(
                'legend' => $this->__('Admin Notes')
            )
        );

        $adminnotes->addField(
            'admin_notes', 'textarea',
            array(
                'name'  => 'admin_notes',
                'label' => $this->__('Notes')
            )
        );

        $formData->setAdminNotes($this->escapeHtml($formData->getAdminNotes()));
        $form->setValues($formData);
    }
}