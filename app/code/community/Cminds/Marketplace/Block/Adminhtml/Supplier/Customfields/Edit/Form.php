<?php
class Cminds_Marketplace_Block_Adminhtml_Supplier_Customfields_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                '*/*/editCustomField',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
        ));
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Details')
            )
        );

        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
                'class' => 'validate-code'
            ),
        ));

        $this->_addFieldsToFieldset($fieldset, array(
            'label' => array(
                'label' => $this->__('Label'),
                'input' => 'text',
                'required' => true,
            ),
        ));

        $this->_addFieldsToFieldset($fieldset, array(
            'description' => array(
                'label' => $this->__('Description'),
                'input' => 'textarea',
            ),
        ));

        $fieldset = $form->addFieldset(
            'options',
            array(
                'legend' => $this->__('Options')
            )
        );

        $this->_addFieldsToFieldset($fieldset, array(
            'is_required' => array(
                'label' => $this->__('Required'),
                'input' => 'select',
                'required' => true,
                'values' => array(
                    0 => 'No',
                    1 => 'Yes'
                )
            ),
        ));

        $this->_addFieldsToFieldset($fieldset, array(
            'is_system' => array(
                'label' => $this->__('Is System'),
                'input' => 'select',
                'required' => true,
                'values' => array(
                    0 => 'No',
                    1 => 'Yes'
                )
            ),
        ));

        $this->_addFieldsToFieldset($fieldset, array(
            'type' => array(
                'label' => $this->__('Type'),
                'input' => 'select',
                'required' => true,
                'values' => array(
                    'text' => 'Text',
                    'textarea' => 'Textarea',
                )
            ),
        ));

        $this->_addFieldsToFieldset($fieldset, array(
            'is_wysiwyg' => array(
                'label' => $this->__('Wysiwyg'),
                'input' => 'select',
                'required' => true,
                'values' => array(
                    0 => 'No',
                    1 => 'Yes'
                )
            ),
        ));

        $this->_addFieldsToFieldset($fieldset, array(
            'must_be_approved' => array(
                'label' => $this->__('Must be approved'),
                'input' => 'select',
                'required' => true,
                'values' => array(
                    0 => 'No',
                    1 => 'Yes'
                )
            ),
        ));

        return $this;
    }

    protected function _addFieldsToFieldset(
        Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()
            ->getPost());

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            $_data['name'] = "fieldData[$name]";

            $_data['title'] = $_data['label'];

            if (!array_key_exists('value', $_data)) {
                if($this->_getField()) {
                    $_data['value'] = $this->_getField()->getData($name);
                }
            }

            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    protected function _getField()
    {
        if (!$this->hasData('field')) {
            $data = Mage::registry('current_field');

            $this->setData('field', $data);
        }

        if (!$this->hasData('field')) {
            $data = Mage::registry('current_field_post_data');
            $this->setData('field', $data);
        }

        return $this->getData('field');
    }
}