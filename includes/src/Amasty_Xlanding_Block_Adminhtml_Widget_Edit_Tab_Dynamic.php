<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
class Amasty_Xlanding_Block_Adminhtml_Widget_Edit_Tab_Dynamic extends Mage_Adminhtml_Block_Widget_Form
{
    protected $_fields = array();
    protected $_buttons = array();
    protected $_model   = 'amlanding_page';
    
    public function __construct()
    {
        parent::__construct();
    } 
    
    public function getDynamicJs($code)
    {
        $js = '
            function addDynamic'.$code.'() {
                Element.insert($("'.$code.'_container"), {bottom: $("'.$code.'_template").innerHTML});
            }
            
            function removeDynamic'.$code.'(button){
                Element.remove(button.up(".field-row"));
            }
            
            function getXMLRowFormat(){
                var ret = "";
                switch($("insert_type").value){
                    case "4":
                        ret = $$("#xml_image_format #insert_image_format")[0].value;
                        break;
                    default:
                        ret = $$("#xml_image_format #insert_format")[0].value;
                        break;
                }
                
                return ret;
            }
            
            function addDynamicXmlRow() {
                var insertAttr = "insert_attr_" + $("insert_type").value;
                $("xml_body").value = $("xml_body").value
                    + "<" + $("xml_tag").value + ">"
                    + $("xml_before").value
                    + "{" + $("insert_type").value + "|"
                    + $(insertAttr).value + "|"
                    + getXMLRowFormat() + "|"
                    + $("insert_length").value + "|"
                    + $("insert_optional").value + "}"
                    + $("xml_after").value
                    + "</" + $("xml_tag").value + ">\n"
            }        
        ';
        return $js;
    }
    
    public function getRemoveDynamicButtonHtml($code)
    {
        if (empty($this->_buttons['rm'.$code])) {
            $this->_buttons['rm'.$code] = $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setType('button')
                ->setClass('delete')->setLabel($this->__(''))
                ->setOnClick("removeDynamic$code(this)")->toHtml();
        }
        return $this->_buttons['rm'.$code];
    }    
    
    public function getAddDynamicButtonHtml($code)
    {
        if (empty($this->_buttons['add'.$code])) {
            $this->_buttons['add'.$code] = $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setType('button')
                ->setClass('add')->setLabel($this->__('Add ' . $code))
                ->setOnClick("addDynamic$code()")->toHtml();
        }
        return $this->_buttons['add'.$code];
    }
    
    public function getInsertDynamicButtonHtml()
    {
        if (empty($this->_buttons['insertXmlRow'])) {
            $this->_buttons['insertXmlRow'] = $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setType('button')
                ->setClass('add')->setLabel($this->__('Insert'))
                ->setOnClick("addDynamicXmlRow()")->toHtml();
        }
        return $this->_buttons['insertXmlRow'];
    }
    
    public function getDynamicValue($code)
    {
        $res = array();
        
        $map = Mage::registry($this->_model)->getData($code);
        $firstEl = current($this->_fields);
        if ($map){
            foreach ($map[$firstEl] as $k => $v){
                $line = array();
                foreach ($this->_fields as $field){
                    $line[$field] = isset($map[$field][$k]) ? $map[$field][$k] : '';
                }
                $res[] = $line;
            }
            $last = count($res)-1;
            if (isset($res[$last]) && !$res[$last][$firstEl])
                unset($res[$last]);
        }
        return $res;
    } 

    public function getSelectedHtml($key, $val)
    {
        $html = '';
        if ($val == Mage::registry($this->_model)->getData($key)){
            $html = 'selected="true"';
        }
        return $html;
    }
    
    public function getSelectedHtmlMultiselect($key, $val)
    {
        $html = '';
        if ($temp = Mage::registry($this->_model)->getData($key)) {
            if (is_array($temp)) {
                $arr = $temp;
            } else {
                $arr = explode(',', Mage::registry($this->_model)->getData($key));
            }
            if (in_array($val, $arr)) {
                $html = 'selected="true"';
            }
        }
        return $html;
    }
    
    public function getValueHtml($key, $defVal='')
    {
        $val = Mage::registry($this->_model)->getData($key);
        if (!$val){
            $val = $defVal;
        }
        return $this->htmlEscape($val);
    }  
      
    public function getHideHtml($key, $val)
    {
        $html = 'display:';
        $isBlock = FALSE;
        
        if (is_array($val)){
            foreach($val as $v){
                $isBlock = (Mage::registry($this->_model)->getData($key) == $v);
                
                if($isBlock)
                    break;
            }
        } else {
            $isBlock = (Mage::registry($this->_model)->getData($key) == $val);
        }
        
            
        if ($isBlock){
            $html .= 'block';
        }
        else {
            $html .= 'none';
        }
            
        return $html;
    }       
}