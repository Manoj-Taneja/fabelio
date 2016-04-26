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
 * @package    AW_Storecredit
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Storecredit_Block_Adminhtml_Customer_Edit_Tabs_Storecredit_BalanceUpdate extends Mage_Adminhtml_Block_Widget_Form
{
    public function initForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('aw_');

        $fieldset = $form->addFieldset(
            'storecredit_fieldset', array('legend' => Mage::helper('aw_storecredit')->__('Update Store Credit Balance'))
        );

        $fieldset->addField(
            'update_storecredit',
            'text',
            array(
                 'label' => Mage::helper('aw_storecredit')->__('Update Store Credit'),
                 'name'  => 'aw_update_storecredit',
                 'note'  => Mage::helper('aw_storecredit')->__('Enter a negative number to subtract from the balance'),
                 'class'    => 'validate-number',
            )
        );

        $fieldset->addField(
            'comment',
            'text',
            array(
                 'label' => Mage::helper('aw_storecredit')->__('Comment'),
                 'name'  => 'aw_update_storecredit_comment',
                 'note'     => Mage::helper('aw_storecredit')->__('Visible to customer')
            )
        );

        $this->setForm($form);
        return $this;
    }
}