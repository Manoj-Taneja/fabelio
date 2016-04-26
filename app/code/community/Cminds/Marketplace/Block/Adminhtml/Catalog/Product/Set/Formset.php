<?php
class Cminds_Marketplace_Block_Adminhtml_Catalog_Product_Set_Formset extends Mage_Adminhtml_Block_Catalog_Product_Attribute_Set_Main_Formset
{
    
    public function __construct() {
        parent::__construct();

    }

    protected function _prepareForm() {
        $data = Mage::getModel('eav/entity_attribute_set')
            ->load($this->getRequest()->getParam('id'));

        parent::_prepareForm();
        $fieldset = $this->getForm()->getElement('set_name');
        $fieldset->addField('available_for_supplier', 'select', array(
            'label' => Mage::helper('marketplace')->__('Available for supplier'),
            'name' => 'available_for_supplier',
            'required' => true,
            'class' => 'required-entry',
            'options' => Mage::getModel('adminhtml/system_config_source_yesno')->toArray(),
            'value' => $data->getAvailableForSupplier()
        ));
    }

}
