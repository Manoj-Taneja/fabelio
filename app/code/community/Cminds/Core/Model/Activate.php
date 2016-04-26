<?php
class Cminds_Core_Model_Activate extends Cminds_Core_Model_Core {
    protected function _beforeSave() { 
        if ($this->isValueChanged() && (substr($this->getOldValue(), 0, -10) != substr($this->getValue(), 0, -10))) {
            $this->before($this->getValue(), $this->getGroupId());
            $this->activateLicense();
        }
    }
}