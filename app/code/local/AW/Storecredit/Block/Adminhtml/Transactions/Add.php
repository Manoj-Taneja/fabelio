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


class AW_Storecredit_Block_Adminhtml_Transactions_Add extends Mage_Adminhtml_Block_Widget
{
    public function getHeaderText()
    {
        return Mage::helper('aw_storecredit')->__('Add Transaction');
    }

    protected function _prepareLayout()
    {
        $this->setChild(
            'back_button',
            $this->getLayout()
                ->createBlock('adminhtml/widget_button')
                ->setData(
                    array(
                         'label'   => Mage::helper('aw_storecredit')->__('Back'),
                         'onclick' => "window.location.href = '" . $this->getUrl('*/*') . "'",
                         'class'   => 'back'
                    )
                )
        );

        $this->setChild(
            'save_button',
            $this->getLayout()
                ->createBlock('adminhtml/widget_button')
                ->setData(
                    array(
                         'label'   => Mage::helper('aw_storecredit')->__('Save Transaction'),
                         'onclick' => "transactionAddForm.submit();",
                         'class'   => 'save'
                    )
                )
        );

        return parent::_prepareLayout();
    }

    public function getSaveButtonHtml()
    {
        return $this->getChildHtml('save_button');
    }

    public function getBackButtonHtml()
    {
        return $this->getChildHtml('back_button');
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save');
    }

    public function getForm()
    {
        return $this->getLayout()
            ->createBlock('aw_storecredit/adminhtml_transactions_add_form')
            ->toHtml();
    }

    public function getCustomersGrid()
    {
        return $this->getLayout()
            ->createBlock('aw_storecredit/adminhtml_transactions_add_customer_grid')
            ->setUseAjax(true)
            ->toHtml();
    }
}