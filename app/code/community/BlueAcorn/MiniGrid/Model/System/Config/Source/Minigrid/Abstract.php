<?php
/**
 * Minigrid system config field type source model abstract
 * Provides base functionality for minigrid source models
 * as the toOptionArray is specialized to the minigrid type
 *
 * @package     BlueAcorn\MiniGrid
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
abstract class BlueAcorn_MiniGrid_Model_System_Config_Source_Minigrid_Abstract {

    /**
     * Default values of field array. Field array defines
     * the fields on the grid.
     *
     * @return array
     */
    abstract protected function _getFields();

    /**
     * Add the additional grid type as a viable type on the form
     *
     * Note: Have to add value and label to each field array because
     * the frontend renderer requires value and label to be set
     * when under score scope.
     *
     * @return array
     */
    public function toOptionArray() {
        $fields = $this->_getFields();
        foreach($fields as $key => $field) {
            $fields[$key]['value'] = 1;
            $fields[$key]['label'] = 1;
        }

        return $fields;
    }

}
