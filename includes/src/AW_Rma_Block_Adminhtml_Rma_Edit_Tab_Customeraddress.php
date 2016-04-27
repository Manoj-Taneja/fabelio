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


class AW_Rma_Block_Adminhtml_Rma_Edit_Tab_Customeraddress extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $rmaRequest = Mage::registry('awrmaformdatarma');
        if ($rmaRequest->getPrintLabel()) {
            $formData = $rmaRequest->getPrintLabel();
        } else {
            $formData = Mage::helper('awrma/request')->getDefaultPrintLabelData($rmaRequest->getOrder());
        }

        $contactInfo = $form->addFieldset(
            'contactinformation',
            array(
            'legend' => $this->__('Contact Information')
            )
        );

        $contactInfo->addField(
            'firstname', 'text',
            array(
                'name'     => 'printlabel[firstname]',
                'label'    => $this->__('First Name'),
                'required' => true
            )
        );

        $contactInfo->addField(
            'lastname', 'text',
            array(
                'name'     => 'printlabel[lastname]',
                'label'    => $this->__('Last Name'),
                'required' => true
            )
        );

        $contactInfo->addField(
            'company', 'text',
            array(
                'name'  => 'printlabel[company]',
                'label' => $this->__('Company')
            )
        );

        $contactInfo->addField(
            'telephone', 'text',
            array(
                'name'     => 'printlabel[telephone]',
                'label'    => $this->__('Telephone'),
                'required' => true
            )
        );

        $contactInfo->addField(
            'fax', 'text',
            array(
                'name'  => 'printlabel[fax]',
                'label' => $this->__('Fax')
            )
        );

        $returnAddress = $form->addFieldset(
            'return_address',
            array(
                'legend' => $this->__('Return Address')
            )
        );

        $returnAddress->addField(
            'streetaddress', 'multiline',
            array(
                'name'     => 'printlabel[streetaddress]',
                'label'    => $this->__('Street Address'),
                'required' => true
            )
        )->setLineCount(Mage::getStoreConfig('customer/address/street_lines', $this->getStoreId()));

        $returnAddress->addField(
            'city', 'text',
            array(
                'name'     => 'printlabel[city]',
                'label'    => $this->__('City'),
                'required' => true
            )
        );

        $returnAddress
            ->addField(
                'country_id', 'select',
                array(
                    'name'     => 'printlabel[country_id]',
                    'label'    => $this->__('Country'),
                    'required' => true
                )
            )
            ->setValues(
                Mage::getSingleton('directory/country')->getResourceCollection()
                    ->loadByStore()
                    ->toOptionArray()
            )
        ;

        $formData['region'] = isset($formData['stateprovince']) ? $formData['stateprovince'] : '';
        $formData['region_id'] = isset($formData['stateprovince_id']) ? $formData['stateprovince_id'] : null;

        $returnAddress
            ->addField(
                'region', 'text',
                array(
                    'name'     => 'printlabel[stateprovince]',
                    'label'    => $this->__('State/Province'),
                    'required' => true,
                )
            )
            ->setRenderer($this->getLayout()->createBlock('adminhtml/customer_edit_renderer_region'))
            ->setEntityAttribute(new Varien_Object(array('store_id' => Mage::app()->getStore()->getId())))
        ;

        $returnAddress->addField(
            'region_id', 'select',
            array(
                'name'     => 'printlabel[stateprovince_id]',
                'label'    => $this->__('State/Province'),
                'required' => true
            )
        )->setNoDisplay(true);

        $returnAddress->addField(
            'postcode', 'text',
            array(
                'name'     => 'printlabel[postcode]',
                'label'    => $this->__('Zip/Postal Code'),
                'required' => true
            )
        );

        $additionalInfo = $form->addFieldset(
            'addinfo',
            array(
                'legend' => $this->__('Additional Information')
            )
        );

        $formData['additionalinfo'] = isset($formData['additionalinfo']) ? $formData['additionalinfo'] : '';
        $additionalInfo->addField(
            'additionalinfo', 'textarea',
            array(
                'name' => 'printlabel[additionalinfo]'
            )
        );
        $form->setValues($formData);
    }
}