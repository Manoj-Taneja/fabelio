<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Full Page Cache
 * @version   1.0.1
 * @build     360
 * @copyright Copyright (C) 2015 Mirasvit (http://mirasvit.com/)
 */



class Mirasvit_Fpc_Block_Adminhtml_System_SortByPageType extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    protected $_optionsRenderer;

    protected function _getOptionsRenderer()
    {
        if (!$this->_optionsRenderer) {
            $this->_optionsRenderer = Mage::app()->getLayout()->createBlock(
                'fpc/adminhtml_system_actionOption', '',
                array('is_render_to_js_template' => true)
            );
            $this->_optionsRenderer->setClass('customer_options_select');
            $this->_optionsRenderer->setExtraParams('style="width:160px"');
        }

        return $this->_optionsRenderer;
    }

    public function __construct()
    {
        $select = $this->_getOptionsRenderer();
        $this->addColumn('action_option', array(
            'label' => __('Cachable Actions'),
            'renderer' => $select,
        ));

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');

        parent::__construct();
    }

    public function getArrayRows()
    {
        $result = parent::getArrayRows();

        foreach ($result as $key => $row) {
            $this->prepareArrayRow($row);
        }

        return $result;
    }

    protected function prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_'.$this->_getOptionsRenderer()->calcOptionHash($row->getData('action_option')),
            'selected="selected"'
        );
    }

    protected function _getToggleRowElementId($element)
    {
        return 'row_'.$element->getId();
    }

    protected function _getDependsElementId()
    {
        return 'fpc_crawler_sort_crawler_urls';
    }

    protected function _getHideElementId()
    {
        return 'custom_order';
    }

    /**
     * Override method to output our custom HTML with JavaScript.
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        $html = $this->_toHtml();
        $this->_arrayRowsCache = null; // doh, the object is used as singleton!
        $javaScript = "
            <script type=\"text/javascript\">
                Event.observe(window, 'load', function() {
                    enabled=$('{$this->_getDependsElementId()}').value;
                    if (!enabled || enabled!='{$this->_getHideElementId()}') {
                        $('{$this->_getToggleRowElementId($element)}').hide();
                    } else {
                        $('{$this->_getToggleRowElementId($element)}').show();
                    }
                });
                Event.observe('{$this->_getDependsElementId()}', 'change', function(){
                    enabled=$('{$this->_getDependsElementId()}').value;
                    $('{$this->_getToggleRowElementId($element)}').disabled = (!enabled || enabled!='{$this->_getHideElementId()}');
                    if (!enabled || enabled!='{$this->_getHideElementId()}') {
                        $('{$this->_getToggleRowElementId($element)}').hide();
                    } else {
                        $('{$this->_getToggleRowElementId($element)}').show();
                    }
                });
            </script>";

        $html .= $javaScript;

        return $html;
    }
}
