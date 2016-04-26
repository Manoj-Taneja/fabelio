<?php
class Cminds_Core_Block_Adminhtml_System_Config_Fieldset_License
    extends Mage_Adminhtml_Block_System_Config_Form_Fieldset {	

    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $confExtensions = Cminds_Core_Model_Core::$confExtensions;
        $model = Mage::getModel('cminds/core');
        if(!isset($confExtensions[$element->getId()])) return;
        if(isset($confExtensions[$element->getId()]['related_to'])) {
            if($model->isExtensionInstalled($confExtensions[$element->getId()]['related_to'])) return;
            if($model->isExtensionEnabled($confExtensions[$element->getId()]['related_to'])) return;
        }

        if(!$model->isExtensionInstalled($confExtensions[$element->getId()]['extension_name'])) return;

        $this->setElement($element);
        $html = $this->_getHeaderHtml($element);

        foreach ($element->getSortedElements() as $field) {
            $html.= $field->toHtml();
        }

        $html .= $this->_getFooterHtml($element);

        return $html;
    }
}