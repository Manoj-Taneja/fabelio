<?php
/**
 * Creates the select values in the configuration by pulling all catalog product
 * attributes from the Magento DB.
 *
 * @package     BlueAcorn\Optimizely
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_Optimizely_Model_System_Config_Source_Minigrid_Attribute
    extends BlueAcorn_MiniGrid_Model_System_Config_Source_Minigrid_Abstract {

    /**
     * Minigrid field source. One column with a list of product attributes
     *
     * @return array
     */
    protected function _getFields() {

        $options = Mage::getModel('blueacorn_optimizely/system_config_source_attribute')->toOptionArray();

        $opts = array();
        foreach ($options as $opt) {
            $opts[$opt['value']] = $opt['label'];
        }

        return array(
            "attribute" => array(
                "width" => "100%",
                "type" => "select",
                "options" => $opts,
            )
        );
    }

}
