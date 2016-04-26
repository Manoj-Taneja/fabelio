<?php
/**
 * Minigrid backend model
 * Serializes and unserializes the grid data to
 * the config data
 *
 * @package     BlueAcorn\MiniGrid
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_MiniGrid_Model_System_Config_Backend_Minigrid extends Mage_Core_Model_Config_Data {

    /**
     * In the event of a minigrid with file, get the local tmp location of the
     * image file that was uploaded by the font minigrid
     *
     * @return string|false
     */
    protected function _getTmpFileNames() {
        if (isset($_FILES['groups']['tmp_name']) && is_array($_FILES['groups']['tmp_name'])) {
            if (isset($_FILES['groups']['tmp_name']["{$this->getGroupId()}"])) {
                $field = $_FILES['groups']['tmp_name']["{$this->getGroupId()}"]['fields'][$this->getField()];
                if (isset($field['value'])) {
                    return $field['value'];
                }
            }
        }
        return false;
    }

    /**
     * In the event that a file was uploaded,
     * this array will contain the filenames as they appear
     * on the uploaded file.
     *
     * @return array
     */
    protected function _getFileNames() {
        $groups = $this->getData('groups');
        $values = $groups["{$this->getGroupId()}"]['fields'][$this->getField()]['value'];

        return $values;
    }

    /**
     * Serialize
     */
    protected function _beforeSave() {
        parent::_beforeSave();
        $groups = $this->getData('groups');
        $values = $groups["{$this->getGroupId()}"]['fields'][$this->getField()]['value'];

        if (is_array($values)) {
            $this->setValue(serialize(array_values($values)));
        }
        else {
            $this->setValue(serialize($values));
        }
    }

    /**
     * Unserialize
     */
    protected function _afterLoad() {
        parent::_afterLoad();
        $this->setValue(unserialize($this->getValue()));
    }

}
