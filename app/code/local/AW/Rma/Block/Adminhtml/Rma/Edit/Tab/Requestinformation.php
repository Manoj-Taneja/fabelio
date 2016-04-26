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


class AW_Rma_Block_Adminhtml_Rma_Edit_Tab_Requestinformation extends Mage_Adminhtml_Block_Widget_Form
{
    public function getFormHtml()
    {
        return parent::getFormHtml() . $this->_getInitJs();
    }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $formData = Mage::registry('awrmaformdatarma');

        $details = $form->addFieldset(
            'details_form',
            array(
                'legend' => $this->__('Request Details')
            )
        );

        $details->addField(
            'rma_id', 'text',
            array(
                'name'  => 'rma_id',
                'label' => $this->__('ID')
            )
        );

        $formData->setOrderIdUrl('#' . $formData->getOrderId());
        $details->addField(
            'order_id_url', 'awlink',
            array(
                'name'  => 'order_id_url',
                'label' => $this->__('Order ID'),
                'href'  => Mage::helper('awrma')->getOrderUrl($formData->getOrderId()),
            )
        );

        if ($formData->getCustomerId()) {
            $formData->setCustomerIdUrl($formData->getCustomerName());
            $customerUrl = Mage::helper('awrma')->getCustomerUrl(
                $formData->getCustomerId(), $this->getRequest()->getParam('key')
            );
            $details->addField(
                'customer_id_url', 'awlink',
                array(
                    'name'  => 'customer_id_url',
                    'label' => $this->__('Customer Name'),
                    'href'  => $customerUrl
                )
            );
        } else {
            $details->addField(
                'customer_name', 'label',
                array(
                    'name'  => 'customer_name',
                    'label' => $this->__('Customer Name')
                )
            );
        }

        if ($formData->getApprovementCode()) {
            $details->addField(
                'approvement_code', 'label',
                array(
                    'name'  => 'approvement_code',
                    'label' => $this->__('Approvement Code')
                )
            );
        }

        if ($formData->getExternalLink()) {
            $guestViewUrl = Mage::app()->getStore($formData->getStoreId())->getUrl(
                'awrma/guest_rma/view', array('id' => $formData->getExternalLink())
            );
            $details->addField(
                'external_link', 'awlink',
                array(
                    'name'   => 'external_link',
                    'label'  => $this->__('External URL'),
                    'href'   => $guestViewUrl,
                    'target' => '_blank'
                )
            );
        }

        $requestoptions = $form->addFieldset(
            'options_form',
            array(
                'legend' => $this->__('Request Options')
            )
        );

        $requestoptions->addField(
            'package_opened', 'select',
            array(
                'name'   => 'package_opened',
                'label'  => $this->__('Package Opened'),
                'values' => Mage::getModel('awrma/source_packageopened')->toOptionArray()
            )
        );

        $requestoptions->addField(
            'status', 'select',
            array(
                'name'   => 'status',
                'label'  => $this->__('Set status to'),
                'values' => $this->_getStatusOptions($formData)
            )
        );

        $requestoptions->addField(
            'request_type', 'select',
            array(
                'name'   => 'request_type',
                'label'  => $this->__('Request type'),
                'values' => $this->_getTypesOptions($formData)
            )
        );

        $requestoptions->addField(
            'tracking_code', 'text',
            array(
                'name'  => 'tracking_code',
                'label' => $this->__('Post tracking code')
            )
        );

        if (Mage::helper('awrma/config')->getReasonsEnabled()) {
            $reasonDetails = $form->addFieldset(
                'reason', array(
                    'legend' => $this->__('Reason Details')
                )
            );

            $reasonOptions = $this->_getReasonOptions($formData);
            if (Mage::helper('awrma/config')->getReasonsOtherOptionEnabled()) {
                $reasonOptions[0] = $this->__('Other');
            }

            $reasonDetails->addField(
                'reason_id', 'select',
                array(
                    'name'   => 'reason_id',
                    'label'  => $this->__('Reason'),
                    'values' => $reasonOptions
                )
            );

            if (Mage::helper('awrma/config')->getReasonsOtherOptionEnabled()) {
                $reasonDetails->addField(
                    'reason_details', 'textarea',
                    array(
                        'name'  => 'reason_details',
                        'label' => $this->__('Details')
                    )
                );
            }
        }

        $addcomment = $form->addFieldset(
            'add_comment',
            array(
                'legend' => $this->__('Add Comment')
            )
        );

        $addcomment->addField(
            'comment_text', 'textarea',
            array(
                'name'  => 'comment_text',
                'label' => $this->__('Message')
            )
        );

        $addcomment->addField(
            'comment_file', 'file',
            array(
                'name'  => 'comment_file',
                'label' => $this->__('File (%skb)', Mage::helper('awrma/config')->getMaxAttachmentsSizeKb())
            )
        );

        $comments = $form->addFieldset('comments_list_container', array());
        $comments->addField(
            'comments_list', 'note',
            array(
                'name' => 'comments_list',
                'text' => Mage::getSingleton('core/layout')
                        ->createBlock('awrma/adminhtml_rma_edit_tab_requestinformation_comments')
                        ->setRmaRequest($formData)->toHtml()
            )
        );
        $form->setValues($formData);
    }

    protected function _getStatusOptions($rmaRequest)
    {
        return $_statuses = Mage::getModel('awrma/entitystatus')->getCollection()
            ->setRemovedFilter()
            ->setStoreFilter($rmaRequest->getStoreId())
            ->setDefaultSort()
            ->getOptions()
        ;
    }

    protected function _getTypesOptions($rmaRequest)
    {
        return Mage::getModel('awrma/entitytypes')->getCollection()
            ->setRemovedFilter()
            ->setStoreFilter($rmaRequest->getStoreId())
            ->setDefaultSort()
            ->setActiveFilter()
            ->getOptions()
        ;
    }

    protected function _getReasonOptions($rmaRequest)
    {
        return Mage::getModel('awrma/entityreason')->getCollection()
            ->setRemovedFilter()
            ->setStoreFilter($rmaRequest->getStoreId())
            ->setDefaultSort()
            ->setActiveFilter()
            ->getOptions()
        ;
    }

    protected function _getInitJs()
    {
        return
            '<script type="text/javascript">
                Event.observe(document, "dom:loaded", function(e) {
                    new awRMAFieldDependence({
                        available         : [0],
                        mainFieldId       : "reason_id",
                        dependenceFieldId : "reason_details"
                    });
                });
            </script>';
    }
}