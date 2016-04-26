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


class AW_Storecredit_Block_Adminhtml_Transactions_Add_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $helper = Mage::helper('aw_storecredit');

        $form = new Varien_Data_Form(
            array(
                 'id'      => 'transaction_add_form',
                 'action'  => $this->getUrl('*/*/save'),
                 'method'  => 'post',
                 'enctype' => 'multipart/form-data',
            )
        );

        $fieldset = $form->addFieldset('main_group', array('legend' => Mage::helper('aw_storecredit')->__('Fields')));

        $fieldset->addField(
            'balance_change',
            'text',
            array(
                'label'     => $helper->__('Store Credit Balance Change'),
                'required'  => true,
                'name'      => 'balance_change',
                'class'     => 'validate-number',
                'note'      => Mage::helper('aw_storecredit')->__('Enter a negative number to subtract from the balance')
            )
        );

        $fieldset->addField(
            'comment',
            'text',
            array(
                 'label'    => $helper->__('Comment'),
                 'required' => true,
                 'name'     => 'comment',
                 'note'     => Mage::helper('aw_storecredit')->__('Visible to customer')
            )
        );

        $fieldset->addField(
            'selected_customers',
            'hidden',
            array(
                 'name' => 'selected_customers',
            )
        );

        $fieldset->addField(
            'internal_customer',
            'hidden',
            array(
                'name' => 'internal_customer',
            )
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}