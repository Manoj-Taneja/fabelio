<?php

class Cminds_Marketplace_Block_Adminhtml_Customer_Edit_Tab_Profile_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                'id'      => 'edit_form',
                'method'  => 'post',
            )
        );
        $form->setUseContainer(true);
        $this->setForm($form);

        $customer = Mage::registry('current_customer');

        $fieldset = $form->addFieldset(
            'configuration_fieldset',
            array(
                'legend' => Mage::helper('marketplace')->__('Supplier Profile Configuration'),
            )
        );

        $fieldset->addField(
            'supplier_profile_approved',
            'select',
            array(
                'label'    => Mage::helper('marketplace')->__('Approved'),
                'class'    => 'required-entry',
                'required' => true,
                'name'     => 'supplier_profile_approved',
                'options'   => Mage::getModel('adminhtml/system_config_source_yesno')->toArray(),
                'value'     => $customer->getData('supplier_profile_approved')
            )
        );

        $fieldset->addField(
            'supplier_remark',
            'textarea',
            array(
                'label'    => Mage::helper('marketplace')->__('Remark'),
                'name'     => 'supplier_remark',
                'value'     => $customer->getData('supplier_remark')
            )
        );

        $fieldset = $form->addFieldset(
            'customer_profile_data',
            array(
                'legend' => Mage::helper('marketplace')->__('Supplier Profile Info'),
            )
        );
        
        $fieldset->addField(
            'supplier_profile_visible',
            'select',
            array(
                'label'    => Mage::helper('marketplace')->__('Profile Enabled'),
                'class'    => 'required-entry',
                'required' => true,
                'name'     => 'supplier_profile_visible',
                'options'   => Mage::getModel('adminhtml/system_config_source_yesno')->toArray(),
                'value'     => $customer->getData('supplier_profile_visible')
            )
        );

        $fieldset->addField(
            'supplier_profile_name',
            'text',
            array(
                'label'    => Mage::helper('marketplace')->__('Name'),
                'name'     => 'supplier_name',
                'value'     => $customer->getData('supplier_name')
            )
        );
        $fieldset->addField(
            'supplier_profile_description',
            'textarea',
            array(
                'label'     => Mage::helper('marketplace')->__('Description'),
                'name'      => 'supplier_description',
                'value'     => $customer->getData('supplier_description'),
                'wysiwyg'   => true,
                'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
            )
        );

        $fieldset = $form->addFieldset(
            'customfields_fieldset',
            array(
                'legend' => Mage::helper('marketplace')->__('Supplier Profile Custom Fields'),
            )
        );
        $customFieldsCollection = Mage::getModel('marketplace/fields')->getCollection();
        $oldCustomFieldsValues = unserialize($customer->getCustomFieldsValues());

        foreach($customFieldsCollection AS $customField) {
            $fieldConfig['label'] = Mage::helper('marketplace')->__($customField->getLabel());
            $fieldConfig['name'] = $customField->getName();
            $fieldConfig['value'] = $this->_findValue($customField->getName(), $oldCustomFieldsValues);

            if($customField->getType() == 'textarea' && $customField->getWysiwyg()) {
                $fieldConfig['wysiwyg'] = true;
                $fieldConfig['config'] = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
            }

            $fieldset->addField(
                $customField->getName(),
                $customField->getType(),
                $fieldConfig
            );
        }

        $fieldset = $form->addFieldset(
            'customer_profile_data_new',
            array(
                'legend' => Mage::helper('marketplace')->__('Supplier Profile Info Waiting for Approval'),
            )
        );
        $fieldset->addField(
            'supplier_profile_name_new',
            'text',
            array(
                'label'    => Mage::helper('marketplace')->__('Name'),
                'name'     => 'supplier_name_new',
                'value'     => $customer->getData('supplier_name_new')
            )
        );
        $fieldset->addField(
            'supplier_profile_description_new',
            'textarea',
            array(
                'label'     => Mage::helper('marketplace')->__('Description'),
                'name'      => 'supplier_description_new',
                'value'     => $customer->getData('supplier_description_new'),
                'wysiwyg'   => true,
                'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
            )
        );

        $fieldset = $form->addFieldset(
            'customfields_waiting_for_approval_fieldset',
            array(
                'legend' => Mage::helper('marketplace')->__('Supplier Profile Custom Fields Waiting for Approval'),
            )
        );
        $customFieldsCollection = Mage::getModel('marketplace/fields')->getCollection();
        $customFieldsValues = unserialize($customer->getNewCustomFieldsValues());
        foreach($customFieldsCollection AS $customField) {
            $fieldConfig['label'] = Mage::helper('marketplace')->__($customField->getLabel());
            $fieldConfig['name'] = $customField->getName().'_new';
            $fieldConfig['value'] = $this->_findValue($customField->getName(), $customFieldsValues);

            if($customField->getType() == 'textarea' && $customField->getWysiwyg()) {
                $fieldConfig['wysiwyg'] = true;
                $fieldConfig['config'] = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
            }

            $fieldset->addField(
                $customField->getName().'_new',
                $customField->getType(),
                $fieldConfig
            );
        }

        return parent::_prepareForm();
    }

    private function _findValue($name, $data) {
        if(!is_array($data)) return false;

        foreach($data AS $value) {
            if($value['name'] == $name) {
                return $value['value'];
            }
        }

        return false;
    }
}