<?php

class Magestore_Inventorypurchasing_Block_Adminhtml_Renderer_Selectnew extends Varien_Data_Form_Element_Select {

    /**
     * Retrieve Element HTML
     *
     * @return string
     */
    public function getElementHtml()
    {
       
        
        $this->addClass('select');
        $html = '<select id="'.$this->getHtmlId().'" name="'.$this->getName().'" '.$this->serialize($this->getHtmlAttributes()).'>'."\n";
        
        $value = $this->getValue();
        
        if(!$value){
            $supplierId = Mage::app()->getRequest()->getParam('supplier_id');
            $supplier = Mage::getModel('inventorypurchasing/supplier')->load($supplierId);
            $value = $supplier->getData($this->getName());            
        }
        if (!is_array($value)) {
            $value = array($value);
        }
         
        

        if ($values = $this->getValues()) {
            foreach ($values as $key => $option) {
                if (!is_array($option)) {
                    $html.= $this->_optionToHtml(array(
                        'value' => $key,
                        'label' => $option),
                        $value
                    );
                }
                elseif (is_array($option['value'])) {
                    $html.='<optgroup label="'.$option['label'].'">'."\n";
                    foreach ($option['value'] as $groupItem) {
                        $html.= $this->_optionToHtml($groupItem, $value);
                    }
                    $html.='</optgroup>'."\n";
                }
                else {
                    $html.= $this->_optionToHtml($option, $value);
                }
            }
        }

        $html.= '</select>'."\n";
        $html.= '<input type="text" name="'.$this->getName().'_new" class="input-text" id="'.$this->getName().'_new" value="" style="display:none; margin: 5px 0;"/>'."\n";
        $html.= $this->getAfterElementHtml();
        return $html;
    }

}


