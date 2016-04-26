<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

class Amasty_Xlanding_Block_Adminhtml_Page_Grid_Column_Renderer_Store
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Store
{

    public function render(Varien_Object $row)
    {
        $out = '';
        $skipAllStoresLabel = $this->_getShowAllStoresLabelFlag();
        $skipEmptyStoresLabel = $this->_getShowEmptyStoresLabelFlag();
        $origStores = $row->getData($this->getColumn()->getIndex());

        if (is_null($origStores) && $row->getStoreName()) {
            $scopes = array();
            foreach (explode("\n", $row->getStoreName()) as $k => $label) {
                $scopes[] = str_repeat('&nbsp;', $k * 3) . $label;
            }
            $out .= implode('<br/>', $scopes) . $this->__(' [deleted]');
            return $out;
        }

        if (empty($origStores) && !$skipEmptyStoresLabel) {
            return '';
        }
        if (!is_array($origStores)) {
            $origStores = array($origStores);
        }

        if (empty($origStores)) {
            return '';
        }
        elseif (in_array(0, $origStores) && count($origStores) == 1 && !$skipAllStoresLabel) {
            return Mage::helper('adminhtml')->__('All Store Views');
        }

        $data = $this->_getStoreModel()->getStoresStructure(false, $origStores);

        foreach ($data as $website) {
            $out .= $website['label'] . '<br/>';
            foreach ($website['children'] as $group) {
                $out .= str_repeat('&nbsp;', 3) . $group['label'] . '<br/>';
                foreach ($group['children'] as $store) {

                    $href = Mage::app()->getStore($store['value'])->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK) . $row->getIdentifier();

                    $out .= str_repeat('&nbsp;', 6) . '<a target="blank" href="' . $href . '">' .  $store['label'] . '</a><br/>' ;
                }
            }
        }

        return $out;
    }
}
