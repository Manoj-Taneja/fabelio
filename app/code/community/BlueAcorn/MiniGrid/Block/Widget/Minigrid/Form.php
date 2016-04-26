<?php
/**
 * Form that utilizes a minigrid. Good as an alternative
 * to a grid
 *
 * @package     BlueAcorn\MiniGrid
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_Minigrid_Block_Widget_Minigrid_Form extends Mage_Adminhtml_Block_Abstract {
    
    protected $_formId = "ba-minigrid-form";
    protected $_formClass = "";
    protected $_formAction = "";
    protected $_gridFields = array();
    protected $_gridRowData = array();
    
    /**
     * It was decided to use the overwritable _toHtml instead of a template
     * to be consistent with magento renderers and to increase portability
     * 
     * @return string
     */
    protected function _toHtml() {
        $html = parent::_toHtml();
        $html .= "<form id='{$this->getFormId()}' action='{$this->getFormAction()}' method='post' class='{$this->getFormClass()}' enctype='multipart/form-data'>";
        $minigrid = new BlueAcorn_MiniGrid_Block_System_Config_Form_Field_Minigrid();
        $html .= $minigrid->getElementHtml("ba-minigrid-form-grid", $this->getFieldName(), $this->getGridFields(), $this->getGridRowData());
        $html .= "
            </form>
            <script type='text/javascript'>
                function submitMinigridForm() {
                    $('{$this->getFormId()}').submit();
                }
            </script>

";
        return $html;
    }
    
    
    /**
     * Public return for form id
     * 
     * @return string 
     */
    public function getFormId() {
        return $this->_formId;
    }
    
    /**
     * Public set for form id
     *
     * @param string $formId
     * @return Blueacorn_Minigrid_Block_Widget_Minigrid_Form 
     */
    public function setFormId($formId) {
        $this->_formId = $formId;
        return $this;
    }
    
    /**
     * Public return for form class
     * 
     * @return string
     */
    public function getFormClass() {
        return $this->_formClass;
    }
    
    /**
     * Public set for form class
     *
     * @param string $formClass
     * @return Blueacorn_Minigrid_Block_Widget_Minigrid_Form 
     */
    public function setFormClass($formClass) {
        $this->_formClass = $formClass;
        return $this;
    }
    /**
     * Public return for form class
     * 
     * @return string
     */
    public function getFormAction() {
        return $this->_formAction;
    }
    
    /**
     * Public set for form class
     *
     * @param string $url
     * @return Blueacorn_Minigrid_Block_Widget_Minigrid_Form 
     */
    public function setFormAction($url) {
        $this->_formAction = $url;
        return $this;
    }
    
    /**
     * Public return for grid fields
     * 
     * @return string
     */
    public function getGridFields() {
        return $this->_gridFields;
    }
    
    /**
     * Public set for grid fields
     *
     * @param array $gridFields
     * @return Blueacorn_Minigrid_Block_Widget_Minigrid_Form 
     */
    public function setGridFields(array $gridFields) {
        $this->_gridFields = $gridFields;
        return $this;
    }
    
    /**
     * Public return for grid row data
     * 
     * @return string
     */
    public function getGridRowData() {
        return $this->_gridRowData;
    }
    
    /**
     * Public set for grid row data
     *
     * @param array $gridRowData
     * @return Blueacorn_Minigrid_Block_Widget_Minigrid_Form 
     */
    public function setGridRowData(array $gridRowData) {
        $this->_gridRowData = $gridRowData;
        return $this;
    }
  
}